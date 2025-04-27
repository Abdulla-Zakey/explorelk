<?php
class Rsetting extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if restaurant_id is set in session
        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Debug - No restaurant_id in session, redirecting to Login");
            redirect('traveler/Login');
            exit();
        }

        // Log the restaurant_id for debugging
        error_log("Debug - restaurant_id from session: " . $_SESSION['restaurant_id']);

        // Load the Restaurant model
        $restaurantModel = new Restaurant();

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Define paths
            $basePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public';
            $profileRelativePath = '/Uploads/rprofile/';
            $imagesRelativePath = '/Uploads/rimages/';
            $profileUploadPath = $basePath . $profileRelativePath;
            $imagesUploadPath = $basePath . $imagesRelativePath;

            // Create directories if they don't exist
            if (!file_exists($profileUploadPath)) {
                mkdir($profileUploadPath, 0755, true);
            }
            if (!file_exists($imagesUploadPath)) {
                mkdir($imagesUploadPath, 0755, true);
            }

            // Initialize data array for database update
            $data = [
                'restaurantName' => $_POST['hotel-name'] ?? '',
                'ownerName' => $_POST['owner-name'] ?? '',
                'restaurantEmail' => $_POST['email'] ?? '',
                'restaurantMobileNum' => $_POST['phone-number'] ?? '',
                'district' => $_POST['district'] ?? '',
                'province' => $_POST['province'] ?? '',
                'restaurantAddress' => $_POST['address-line-1'] . ($_POST['address-line-2'] ? ', ' . $_POST['address-line-2'] : ''),
                'description' => $_POST['description'] ?? ''
            ];

            // Validate phone number
            $phoneNumber = $data['restaurantMobileNum'];
            if ($phoneNumber && !preg_match('/^\+94[0-9]{9}$/', $phoneNumber)) {
                error_log("Invalid phone number format: $phoneNumber");
                $_SESSION['error'] = 'Phone number must start with +94 followed by 9 digits (e.g., +94712345678).';
                redirect('restaurant/rsetting');
                exit();
            }

            // Handle profile photo upload
            if (isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] === UPLOAD_ERR_OK) {
                $profilePhoto = $_FILES['profile-photo'];
                $fileType = mime_content_type($profilePhoto['tmp_name']);
                if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $fileName = uniqid('profile_') . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '', $profilePhoto['name']);
                    $destination = $profileUploadPath . $fileName;
                    $dbPath = $profileRelativePath . $fileName;
                    if (move_uploaded_file($profilePhoto['tmp_name'], $destination)) {
                        $data['profilePhoto'] = $dbPath;
                    } else {
                        error_log("Failed to move profile photo to $destination");
                        $_SESSION['error'] = 'Failed to upload profile photo.';
                    }
                } else {
                    error_log("Invalid profile photo type: $fileType");
                    $_SESSION['error'] = 'Profile photo must be an image (JPEG, PNG, or GIF).';
                }
            }

            // Handle restaurant photos upload (multiple images)
            if (isset($_FILES['hotel-photos']) && !empty($_FILES['hotel-photos']['name'][0])) {
                $hotelPhotos = $_FILES['hotel-photos'];
                $photoPaths = [];
                for ($i = 0; $i < count($hotelPhotos['name']); $i++) {
                    if ($hotelPhotos['error'][$i] === UPLOAD_ERR_OK) {
                        $fileType = mime_content_type($hotelPhotos['tmp_name'][$i]);
                        if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                            $fileName = uniqid('hotel_') . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '', $hotelPhotos['name'][$i]);
                            $destination = $imagesUploadPath . $fileName;
                            $dbPath = $imagesRelativePath . $fileName;
                            if (move_uploaded_file($hotelPhotos['tmp_name'][$i], $destination)) {
                                $photoPaths[] = $dbPath;
                            } else {
                                error_log("Failed to move restaurant photo to $destination");
                                $_SESSION['error'] = 'Failed to upload one or more restaurant photos.';
                            }
                        } else {
                            error_log("Invalid restaurant photo type: $fileType");
                            $_SESSION['error'] = 'Restaurant photos must be images (JPEG, PNG, or GIF).';
                        }
                    }
                }
                if (!empty($photoPaths)) {
                    $data['hotelPhotos'] = json_encode($photoPaths);
                }
            }

            // Update the restaurant in the database
            try {
                $restaurantModel->update($_SESSION['restaurant_id'], $data);
                $_SESSION['success'] = 'Profile updated successfully!';
            } catch (Exception $e) {
                error_log("Failed to update restaurant: " . $e->getMessage());
                $_SESSION['error'] = 'Failed to update profile. Please try again.';
            }

            redirect('restaurant/rsetting');
            exit();
        }

        // Fetch restaurant data to prefill the form
        try {
            $restaurantData = $restaurantModel->find($_SESSION['restaurant_id']);
            if (!$restaurantData) {
                error_log("Debug - No restaurant found for restaurant_id: " . $_SESSION['restaurant_id']);
                $_SESSION['error'] = 'Restaurant not found.';
                redirect('traveler/Login');
                exit();
            }
            $this->view('restaurant/rsetting', ['restaurant' => $restaurantData]);
        } catch (Exception $e) {
            error_log("Failed to fetch restaurant: " . $e->getMessage());
            $_SESSION['error'] = 'Error loading restaurant data.';
            redirect('traveler/Login');
            exit();
        }
    }
}
?>