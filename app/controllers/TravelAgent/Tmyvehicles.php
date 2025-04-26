<?php
class Tmyvehicles extends Controller
{
    private $travelAgentModel;
    private $vehicleTypeModel;
    private $vehicleModel;
    private $vehicleAmenityModel;
    private $vehicleTypeAmenityModel;
    private $vehicleBookingModel;

    public function __construct()
    {
        $this->travelAgentModel = $this->loadModel('TravelAgent');
        $this->vehicleTypeModel = $this->loadModel('VehicleType');
        $this->vehicleModel = $this->loadModel('Vehicle');
        $this->vehicleAmenityModel = $this->loadModel('VehicleAmenity');
        $this->vehicleTypeAmenityModel = $this->loadModel('VehicleTypeAmenity');
        $this->vehicleBookingModel = $this->loadModel('VehicleBooking');
    }

    public function index()
    {
        
        if (!isset($_SESSION['travelagent_Id'])) {
            redirect('traveler/Login');
            exit;
        }

        $data['providerBasic'] = $this->travelAgentModel->first(['travelagent_Id' => $_SESSION['travelagent_Id']]);
        $data['vehicleTypes'] = $this->vehicleTypeModel->where(['travelagent_Id' => $_SESSION['travelagent_Id']]);
        $data['commonVehicleAmenities'] = $this->vehicleAmenityModel->selectALL();
        $data['vehicleTypeNames'] = array_map(function ($vehicleType) {
            return (object) ['vehicleType_name' => $vehicleType->vehicleType_name];
        }, $data['vehicleTypes']);

        $this->view('travelagent/myvehicles', $data);
    }

    public function addVehicleType()
    {
        if (!isset($_SESSION['travelagent_Id'])) {
            redirect('traveler/Login');
            exit;
        }

        $providerId = $_SESSION['travelagent_Id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];

            // Validate required fields
            $requiredFields = ['vehicleType_name', 'pricePer_day', 'max_capacity'];
            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                    $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
                }
            }

            if (!isset($_POST['amenities']) || empty($_POST['amenities'])) {
                $errors[] = "Please select at least one amenity.";
            }

            // Handle file upload
            $imagePath = $this->handleVehicleTypeImageUpload($providerId);

            if (!$imagePath) {
                $errors[] = "Failed to upload vehicle type image.";
            }

            // If no errors, proceed with database insertion
            if (empty($errors)) {
                $vehicleTypeData = [
                    'travelagent_Id' => $providerId,
                    'vehicleType_name' => trim($_POST['vehicleType_name']),
                    'pricePer_day' => floatval($_POST['pricePer_day']),
                    'max_capacity' => intval($_POST['max_capacity']),
                    'customized_description' => $_POST['customized_description'] ?? null,
                    'image_path' => $imagePath
                ];

                $vehicleTypeId = $this->vehicleTypeModel->insert($vehicleTypeData);

                if ($vehicleTypeId) {
                    // Insert amenities
                    $amenitiesSuccess = true;
                    foreach ($_POST['amenities'] as $amenityId) {
                        $amenityData = [
                            'vehicleType_Id' => $vehicleTypeId,
                            'amenity_Id' => intval($amenityId)
                        ];

                        if (!$this->vehicleTypeAmenityModel->insert($amenityData)) {
                            $amenitiesSuccess = false;
                            break;
                        }
                    }

                    if ($amenitiesSuccess) {
                        $_SESSION['success'] = ["Vehicle type and amenities successfully added."];
                    } else {
                        $this->vehicleTypeAmenityModel->delete($vehicleTypeId, 'vehicleType_Id');
                        $_SESSION['errors'] = ["Failed to add vehicle amenities."];
                    }
                } else {
                    $_SESSION['errors'] = ["Failed to add vehicle type."];
                }
            } else {
                $_SESSION['errors'] = $errors;
            }
        }

        redirect('travelagent/Tmyvehicles');
        exit;
    }

    private function handleVehicleTypeImageUpload($providerId)
    {
        if (isset($_FILES['vehicleTypeImage']) && $_FILES['vehicleTypeImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/uploads/travelproviders/' . $providerId . '/vehicleTypesImages/';
            $fileName = uniqid('vehicletype_') . '_' . basename($_FILES['vehicleTypeImage']['name']);
            $uploadPath = $uploadDir . $fileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($_FILES['vehicleTypeImage']['tmp_name'], $uploadPath)) {
                return 'uploads/travelproviders/' . $providerId . '/vehicleTypesImages/' . $fileName;
            } else {
                error_log("File upload failed. Path: " . $_FILES['vehicleTypeImage']['tmp_name'] . ", Destination: " . $uploadPath);
            }
        }

        return null;
    }

    public function addVehicles()
    {
        if (!isset($_SESSION['travelagent_Id'])) {
            redirect('traveler/Login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('TravelProvider/Tmyvehicles');
            exit;
        }

        $errors = [];
        $vehicleTypeId = $_POST['vehicleType_Id'] ?? null;
        $vehicleNumbers = $_POST['vehicle_numbers'] ?? [];

        if (!$vehicleTypeId) {
            $errors[] = "Vehicle type ID is missing.";
        }

        if (empty($vehicleNumbers)) {
            $errors[] = "At least one vehicle registration number is required.";
        }

        if ($vehicleTypeId) {
            $vehicleType = $this->vehicleTypeModel->first(['vehicleType_Id' => $vehicleTypeId]);
            if (!$vehicleType || $vehicleType->travelagent_Id != $_SESSION['travelagent_Id']) {
                $errors[] = "Invalid vehicle type selected.";
            }
        }

        $existingVehicles = $this->vehicleModel->where(['vehicleType_Id' => $vehicleTypeId]);
        if (!empty($existingVehicles)) {
            $existingRegNumbers = array_column($existingVehicles, 'registration_number');
            $duplicates = array_intersect($vehicleNumbers, $existingRegNumbers);

            if (!empty($duplicates)) {
                $errors[] = "Registration numbers " . implode(', ', $duplicates) . " already exist.";
            }
        }

        if (empty($errors)) {
            $success = true;

            foreach ($vehicleNumbers as $number) {
                $vehicleData = [
                    'vehicleType_Id' => $vehicleTypeId,
                    'registration_number' => trim($number),
                    'status' => 'available'
                ];

                if (!$this->vehicleModel->insert($vehicleData)) {
                    $success = false;
                    break;
                }
            }

            if ($success) {
                $currentVehicleType = $this->vehicleTypeModel->first(['vehicleType_Id' => $vehicleTypeId]);
                $newTotalVehicles = ($currentVehicleType->total_vehicles ?? 0) + count($vehicleNumbers);

                $updateData = [
                    'total_vehicles' => $newTotalVehicles
                ];

                if ($this->vehicleTypeModel->update($vehicleTypeId, $updateData, 'vehicleType_Id')) {
                    $_SESSION['success'] = ["Successfully added " . count($vehicleNumbers) . " vehicle(s)."];
                } else {
                    $_SESSION['errors'] = ["Vehicles added but failed to update total vehicle count."];
                }
            } else {
                $_SESSION['errors'] = ["Failed to add vehicles."];
            }
        } else {
            $_SESSION['errors'] = $errors;
        }

        redirect('TravelProvider/Tmyvehicles');
        exit;
    }

    public function getVehicleTypeDetails($vehicleTypeId)
    {
        if (!isset($_SESSION['travelagent_Id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        header('Content-Type: application/json');

        try {
            $vehicleType = $this->vehicleTypeModel->first(['vehicleType_Id' => $vehicleTypeId]);

            if (!$vehicleType || $vehicleType->travelagent_Id != $_SESSION['travelagent_Id']) {
                throw new Exception('Vehicle type not found or access denied');
            }

            $amenities = [];
            $i = 0;
            $vehicleAmenities = $this->vehicleTypeAmenityModel->where(['vehicleType_Id' => $vehicleTypeId]);
            foreach ($vehicleAmenities as $amenity) {
                $amenities[$i] = $this->vehicleAmenityModel->first(['amenity_Id' => $amenity->amenity_Id]);
                $i++;
            }

            $vehicles = $this->vehicleModel->where(['vehicleType_Id' => $vehicleTypeId]);

            $response = [
                'vehicleType_name' => $vehicleType->vehicleType_name,
                'pricePer_day' => floatval($vehicleType->pricePer_day),
                'max_capacity' => intval($vehicleType->max_capacity),
                'customized_description' => $vehicleType->customized_description,
                'image_url' => $vehicleType->image_path,
                'amenities' => array_filter($amenities),
                'vehicles' => $vehicles
            ];

            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }

    public function deleteVehicleType($vehicleTypeId)
    {
        if (!isset($_SESSION['travelagent_Id'])) {
            redirect('traveler/Login');
            exit;
        }

        try {
            $vehicleType = $this->vehicleTypeModel->first(['vehicleType_Id' => $vehicleTypeId]);

            if (!$vehicleType || $vehicleType->travelagent_Id != $_SESSION['travelagent_Id']) {
                $_SESSION['errors'] = ["Vehicle type not found or access denied."];
                redirect('TravelProvider/Tmyvehicles');
                exit;
            }

            $vehicles = $this->vehicleModel->where(['vehicleType_Id' => $vehicleTypeId]);
            $bookings = $this->vehicleBookingModel->where(['vehicleType_Id' => $vehicleTypeId]);

            if (!empty($vehicles) || !empty($bookings)) {
                $_SESSION['errors'] = ["Cannot delete vehicle type with associated vehicles or bookings."];
                redirect('TravelProvider/Tmyvehicles');
                exit;
            }

            $this->vehicleTypeAmenityModel->delete($vehicleTypeId, 'vehicleType_Id');

            if ($vehicleType->image_path) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/' . $vehicleType->image_path;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $result = $this->vehicleTypeModel->delete($vehicleTypeId, 'vehicleType_Id');

            if ($result) {
                $_SESSION['success'] = ["Vehicle type and all associated data successfully deleted."];
            } else {
                throw new Exception("Failed to delete vehicle type.");
            }
        } catch (Exception $e) {
            $_SESSION['errors'] = ["Error occurred while deleting vehicle type: " . $e->getMessage()];
        }

        redirect('TravelProvider/Tmyvehicles');
        exit;
    }

    public function checkVehicleAvailability($vehicleTypeId, $startDate, $endDate)
    {
        if (!isset($_SESSION['travelagent_Id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }

        header('Content-Type: application/json');

        try {
            $vehicleType = $this->vehicleTypeModel->first(['vehicleType_Id' => $vehicleTypeId]);

            if (!$vehicleType || $vehicleType->travelagent_Id != $_SESSION['travelagent_Id']) {
                throw new Exception('Vehicle type not found or access denied');
            }

            $startDate = date('Y-m-d', strtotime($startDate));
            $endDate = date('Y-m-d', strtotime($endDate));

            if (!$startDate || !$endDate || strtotime($endDate) <= strtotime($startDate)) {
                throw new Exception('Invalid date range');
            }

            $totalVehicles = $vehicleType->total_vehicles ?? 0;

            $bookings = $this->vehicleBookingModel->where([
                'vehicleType_Id' => $vehicleTypeId,
                'start_date' => ['<=', $endDate],
                'end_date' => ['>=', $startDate]
            ]);

            $bookedVehicles = 0;
            foreach ($bookings as $booking) {
                $bookedVehicles += $booking->vehicle_count;
            }

            $availableVehicles = max(0, $totalVehicles - $bookedVehicles);

            echo json_encode([
                'available_vehicles' => $availableVehicles,
                'booked_vehicles' => $bookedVehicles,
                'total_vehicles' => $totalVehicles
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }

    public function recordDirectBooking()
    {
        if (!isset($_SESSION['travelagent_Id'])) {
            redirect('traveler/Login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('TravelProvider/Tmyvehicles');
            exit;
        }

        $vehicleTypeId = $_POST['vehicleTypeId'] ?? '';
        $startDate = $_POST['startDate'] ?? '';
        $endDate = $_POST['endDate'] ?? '';
        $vehicleCount = $_POST['bookedVehicleCount'] ?? '';
        $totalAmount = $_POST['totalAmount'] ?? '';
        $specialRequests = $_POST['specialRequests'] ?? '';
        $bookingSource = $_POST['bookingSource'] ?? 'manual';
        $paymentStatus = $_POST['paymentStatus'] ?? '';
        $advanceAmount = $_POST['advanceAmount'] ?? 0;

        $customerFullName = $_POST['customerFullName'] ?? '';
        $customerEmail = $_POST['customerEmail'] ?? '';
        $customerPhone = $_POST['customerMobileNum'] ?? '';
        $customerNIC = $_POST['customerNIC'] ?? '';

        $errors = [];
        $vehicleType = $this->vehicleTypeModel->first(['vehicleType_Id' => $vehicleTypeId]);
        if (!$vehicleType || $vehicleType->travelagent_Id != $_SESSION['travelagent_Id']) {
            $errors[] = "Invalid vehicle type.";
        }
        if (empty($customerFullName)) {
            $errors[] = "Customer name is required.";
        }
        if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required.";
        }
        if (empty($customerPhone)) {
            $errors[] = "Phone number is required.";
        }
        if (empty($customerNIC)) {
            $errors[] = "NIC or passport number is required.";
        }
        if ($vehicleCount <= 0) {
            $errors[] = "At least one vehicle must be booked.";
        }
        if ($totalAmount <= 0) {
            $errors[] = "Total amount must be greater than 0.";
        }
        if (!in_array($bookingSource, ['walk-in', 'phone', 'email', 'third-party', 'other'])) {
            $errors[] = "Invalid booking source.";
        }
        if (!in_array($paymentStatus, ['fully-paid', 'advance-paid', 'pending'])) {
            $errors[] = "Invalid payment status.";
        }
        if ($paymentStatus === 'advance-paid' && $advanceAmount <= 0) {
            $errors[] = "Advance amount must be greater than 0 for advance-paid status.";
        }

        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));
        $bookings = $this->vehicleBookingModel->where([
            'vehicleType_Id' => $vehicleTypeId,
            'start_date' => ['<=', $endDate],
            'end_date' => ['>=', $startDate]
        ]);

        $bookedVehicles = 0;
        foreach ($bookings as $booking) {
            $bookedVehicles += $booking->vehicle_count;
        }

        $totalVehicles = $vehicleType->total_vehicles ?? 0;
        $availableVehicles = max(0, $totalVehicles - $bookedVehicles);

        if ($vehicleCount > $availableVehicles) {
            $errors[] = "Requested number of vehicles exceeds available vehicles.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('TravelProvider/Tmyvehicles');
            exit;
        }

        $bookingData = [
            'travelagent_Id' => $_SESSION['travelagent_Id'],
            'vehicleType_Id' => $vehicleTypeId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'vehicle_count' => $vehicleCount,
            'special_requests' => $specialRequests,
            'total_amount' => $totalAmount,
            'advance_amount' => $advanceAmount,
            'paid_advance_amount' => in_array($paymentStatus, ['advance-paid', 'fully-paid']) ? $advanceAmount : 0,
            'payment_status' => in_array($paymentStatus, ['advance-paid', 'fully-paid']) ? 'Paid' : 'Pending',
            'booking_status' => 'Confirmed',
            'requested_date' => date('Y-m-d H:i:s'),
            'booking_source' => $bookingSource,
            'customer_name' => $customerFullName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_nic' => $customerNIC
        ];

        $bookingId = $this->vehicleBookingModel->insert($bookingData);

        if ($bookingId) {
            $_SESSION['success'] = ["Booking recorded successfully!"];
            redirect('TravelProvider/Tmyvehicles?success=Booking+added+successfully');
        } else {
            $_SESSION['errors'] = ["Failed to add booking"];
            redirect('TravelProvider/Tmyvehicles?error=failed_to_add_booking');
        }
        exit;
    }

    private function generateBookingReference()
    {
        $prefix = 'BK';
        $timestamp = date('YmdHis');
        $random = rand(1000, 9999);

        return $prefix . $timestamp . $random;
    }
}