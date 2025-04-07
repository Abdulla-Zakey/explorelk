<?php
class Test extends Controller {

    private $hotelRoomTypesModel;
    private $commonRoomTypesModel;
    private $commonRoomAmenitiesModel;
    private $hotelRoomTypeAmenitiesModel;
    private $roomsModel;
    private $data;
    

    public function __construct(){
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->commonRoomTypesModel = new CommonRoomTypesModel();
        $this->commonRoomAmenitiesModel = new commonRoomAmenitiesModel();
        $this->hotelRoomTypeAmenitiesModel = new HotelRoomTypeAmenitiesModel();
        $this->roomsModel = new RoomsModel();
    }

    public function index(){

        if(!isset($_SESSION['hotel_id'])) {
            // Redirect to login or handle unauthorized access
            redirect('traveler/Login');
            exit;
        }
    
        $data['hotelRoomTypes'] = $this->hotelRoomTypesModel->getHotelRoomTypesByHotelId($_SESSION['hotel_id']);

        $data['commonlyAvailableRoomTypesForAllHotels'] = $this->commonRoomTypesModel->getAllRoomTypes();

        $data['commonRoomAmenities'] = $this->commonRoomAmenitiesModel->getAllAmenities();

        $i = 0;
        foreach( $data['hotelRoomTypes'] as $hotelRoomType){
            $data['hotelRoomTypesNames'][$i] = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($hotelRoomType->roomType_Id);
            $i++;
        }

        $this->view('hotel/test', $data);
    }

    public function addRoomType() {
        $hotel_Id = $_SESSION['hotel_id'];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];
    
            // Validate required fields
            $requiredFields = ['roomType_Id', 'pricePer_night', 'max_occupancy'];
            foreach ($requiredFields as $field) {
                if (!isset($_POST[$field]) || empty($_POST[$field])) {
                    $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
                }
            }

            if (!isset($_POST['amenities']) || empty($_POST['amenities'])) {
                $errors[] = "Please select at least one amenity.";
            }
    
            // Handle file upload using new method
            $thumbnailPath = $this->handleRoomTypeImageUpload($hotel_Id);

            if (!$thumbnailPath) {
                $errors[] = "Failed to upload room type image.";
            }
    
            // If no errors, proceed with database insertion
            if (empty($errors)) {
                $roomTypeData = [
                    'hotel_Id' => $hotel_Id,
                    'roomType_Id' => $_POST['roomType_Id'],
                    'pricePer_night' => $_POST['pricePer_night'],
                    'max_occupancy' => $_POST['max_occupancy'],
                    'customized_description' => $_POST['customized_description'] ?? null,
                    'thumbnail_picPath' => $thumbnailPath
                ];
    
                $hotelRoomTypeId = $this->hotelRoomTypesModel->insert($roomTypeData);

                if ($hotelRoomTypeId) {
                    // Insert the amenities
                    $amenitiesSuccess = true;
                    foreach ($_POST['amenities'] as $amenityId) {
                        $amenityData = [
                            'hotelRoomType_Id' => $hotelRoomTypeId,
                            'amenity_Id' => $amenityId
                        ];
                        
                        if (!$this->hotelRoomTypeAmenitiesModel->insert($amenityData)) {
                            $amenitiesSuccess = false;
                            break;
                        }
                    }

                    if ($amenitiesSuccess) {
                        $_SESSION['success'] = ["Room type and amenities successfully added."];
                    } 
                    else {
                        // If amenities insertion fails, we should ideally rollback the room type insertion
                        $this->hotelRoomTypeAmenitiesModel->delete($hotelRoomTypeId, 'hotel_roomType_Id');
                        $_SESSION['errors'] = ["Failed to add room amenities."];
                    }
                } 
                else {
                    $_SESSION['errors'] = ["Failed to add room type."];
                }
            } 
            else {
                $_SESSION['errors'] = $errors;
            }
        }
    
        redirect('Hotel/Test');
    }

    private function handleRoomTypeImageUpload($hotel_Id) {
        if (isset($_FILES['roomTypeImage']) && $_FILES['roomTypeImage']['error'] === UPLOAD_ERR_OK) {
            // Use absolute server path
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/uploads/hotels/' . $hotel_Id . '/roomTypesImages/';
            
            // Generate a unique filename
            $fileName = uniqid('roomtype_') . '_' . basename($_FILES['roomTypeImage']['name']);
            
            // Full path for the uploaded file
            $uploadPath = $uploadDir . $fileName;
    
            // Ensure upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            // Move uploaded file
            if (move_uploaded_file($_FILES['roomTypeImage']['tmp_name'], $uploadPath)) {
                // Return relative path for database storage
                return 'uploads/hotels/' . $hotel_Id . '/roomTypesImages/' . $fileName;
            } else {
                // Add error logging
                error_log("File upload failed. Temp path: " . $_FILES['roomTypeImage']['tmp_name'] . ", Destination: " . $uploadPath);
            }
        }
    
        // Return null if no upload
        return null;
    }

    public function addRooms() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('Hotel/Test');
            return;
        }
    
        $errors = [];
        $hotel_roomType_Id = $_POST['hotel_roomType_Id'] ?? null;
        $room_numbers = $_POST['room_numbers'] ?? [];
    
        // Validate hotel_roomType_Id
        if (!$hotel_roomType_Id) {
            $errors[] = "Hotel Room type ID is missing";
        }
    
        // Validate room numbers
        if (empty($room_numbers)) {
            $errors[] = "At least one room number is required.";
        }
    
        // Verify that the hotel_roomType_Id belongs to the current hotel
        if ($hotel_roomType_Id) {
            $roomType = $this->hotelRoomTypesModel->first(['hotel_roomType_Id' => $hotel_roomType_Id]);
            if (!$roomType || $roomType->hotel_Id != $_SESSION['hotel_id']) {
                $errors[] = "Invalid room type selected.";
            }
        }
    
        // Check for duplicate room numbers within the hotel
        $existingRooms = $this->roomsModel->where(['hotel_roomType_Id' => $hotel_roomType_Id]);
        
        if(!empty($existingRooms)){
            $existingRoomNumbers = array_column($existingRooms, 'room_number');
            $duplicates = array_intersect($room_numbers, $existingRoomNumbers);

            if (!empty($duplicates)) {
                $errors[] = "Room numbers " . implode(', ', $duplicates) . " already exist.";
            }
        }
       
        if (empty($errors)) {
            $success = true;
            
            foreach ($room_numbers as $room_number) {
                $roomData = [
                    'hotel_roomType_Id' => $hotel_roomType_Id,
                    'room_number' => $room_number
                ];
    
                if (!$this->roomsModel->insert($roomData)) {
                    $success = false;
                    break;
                }
            }
            
    
            if ($success) {
                // Update total_rooms count in hotel_room_types table
                $currentRoomType = $this->hotelRoomTypesModel->first(['hotel_roomType_Id' => $hotel_roomType_Id]);
                $newTotalRooms = ($currentRoomType->total_rooms ?? 0) + count($room_numbers);
                
                $updateData = [
                    'total_rooms' => $newTotalRooms
                ];
                
                if ($this->hotelRoomTypesModel->update($hotel_roomType_Id, $updateData, 'hotel_roomType_Id')) {
                    $_SESSION['success'] = ["Successfully added " . count($room_numbers) . " room(s)."];
                } else {
                    $_SESSION['errors'] = ["Rooms added but failed to update total room count."];
                }
            } else {
                $_SESSION['errors'] = ["Failed to add rooms."];
            }
        } else {
            $_SESSION['errors'] = $errors;
        }
    
        redirect('Hotel/Test');
    }
    

    public function getRoomTypeDetails($hotelRoomTypeId) {
        // Set headers first
        header('Content-Type: application/json');
        
        try {
            // Verify that the room type belongs to the current hotel
            $hotelRoomTypeDetails = $this->hotelRoomTypesModel->getHotelRoomTypeDetailsById($hotelRoomTypeId);
            
            if (!$hotelRoomTypeDetails || $hotelRoomTypeDetails->hotel_Id != $_SESSION['hotel_id']) {
                throw new Exception('Room type not found or access denied');
            }
            
            $roomTypeDetails = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($hotelRoomTypeDetails->roomType_Id);

            $amenities = [];
            $i = 0;
            $tempAmenities = $this->hotelRoomTypeAmenitiesModel->getRoomTypeAmenities($hotelRoomTypeId);
            foreach($tempAmenities as $amenity) {
                $amenities[$i] = $this->commonRoomAmenitiesModel->getAmenityDetailsById($amenity->amenity_Id);
                $i++;
            }
            $rooms = $this->roomsModel->getRoomsByType($hotelRoomTypeId);
            
            $response = [
                'roomType_name' => $roomTypeDetails->roomType_name,
                'pricePer_night' => floatval($hotelRoomTypeDetails->pricePer_night),
                'max_occupancy' => intval($hotelRoomTypeDetails->max_occupancy),
                'customized_description' => $hotelRoomTypeDetails->customized_description,
                'image_url' => $hotelRoomTypeDetails->thumbnail_picPath,
                'amenities' => $amenities,
                'rooms' => $rooms
            ];
            
            echo json_encode($response);
            
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;
    }
    

    // New method to handle room type deletion
    // public function deleteRoomType($hotel_roomType_Id) {
    //     Check if the room type belongs to the current hotel
    //     $roomType = $this->hotelRoomTypesModel->first(['hotel_roomType_Id' => $hotel_roomType_Id]);
        
    //     if (!$roomType) {
    //         Room type not found
    //         $_SESSION['errors'] = "Room type not found.";
    //         redirect('Hotel/Test');
    //     }

    //     Perform the deletion
    //     $result = $this->hotelRoomTypesModel->delete($hotel_roomType_Id, 'hotel_roomType_Id');

    //     if ($result) {
    //         Successful deletion
    //         $_SESSION['success'] = "Room type successfully deleted.";
    //     } else {
    //         Deletion failed
    //         $_SESSION['errors'] = "Failed to delete room type.";
            
    //     }

    //     Redirect back to the room types page
    //     redirect('Hotel/Test');
    // }

    public function deleteRoomType($hotel_roomType_Id) {
        try {
            // Check if the room type belongs to the current hotel
            $roomType = $this->hotelRoomTypesModel->first(['hotel_roomType_Id' => $hotel_roomType_Id]);
            
            if (!$roomType || $roomType->hotel_Id != $_SESSION['hotel_id']) {
                $_SESSION['errors'] = "Room type not found or access denied.";
                redirect('Hotel/Test');
                return;
            }
    
            // Start with deleting child records
            // 1. Delete associated rooms
            $this->roomsModel->delete($hotel_roomType_Id, 'hotel_roomType_Id');
            
            // 2. Delete associated amenities
            $this->hotelRoomTypeAmenitiesModel->delete($hotel_roomType_Id, 'hotelRoomType_Id');
    
            // 3. Delete the room type image if it exists
            if ($roomType->thumbnail_picPath) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/' . $roomType->thumbnail_picPath;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            // Finally, delete the room type itself
            $result = $this->hotelRoomTypesModel->delete($hotel_roomType_Id, 'hotel_roomType_Id');
    
            if ($result) {
                $_SESSION['success'] = "Room type and all associated data successfully deleted.";
            } else {
                throw new Exception("Failed to delete room type.");
            }
    
        } catch (Exception $e) {
            $_SESSION['errors'] = "Error occurred while deleting room type: " . $e->getMessage();
        }
    
        redirect('Hotel/Test');
    }
}