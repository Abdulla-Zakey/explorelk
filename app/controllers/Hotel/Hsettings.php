<?php

    class Hsettings extends Controller {

        private $hotelModel;
        public function __construct() {
            $this->hotelModel = new Hotel();
        }
       
        public function index($a = '', $b = '', $c = ''){

            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);

            $this->view('hotel/settings', $data);
            
        }
      
        public function update() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // For debugging
                error_log('Update method called with POST data: ' . print_r($_POST, true));
                
                // Process the form data
                $hotelData = [
                    'hotelName' => $_POST['hotel-name'],
                    'hotelEmail' => $_POST['email'],
                    'serviceProviderName' => $_POST['owner-name'],
                    'hotelMobileNum' => $_POST['phone-number'],
                    'hotelAddress' => $_POST['address-line-1'],
                    'hotelLogo' => $this->handleProfilePicUpload($_SESSION['hotel_id']),
                    'district' => $_POST['district'],
                    'province' => $_POST['province'],
                    'description_para1' => $_POST['description'][0],
                    'description_para2' => $_POST['description'][1],
                    'description_para3' => $_POST['description'][2]
                ];
                
                // Debug data being sent to update method
                error_log('Hotel data being sent to update: ' . print_r($hotelData, true));
                error_log('Hotel ID being used: ' . $_SESSION['hotel_id']);
                
                // Update hotel data in database
                $updated = $this->hotelModel->update($_SESSION['hotel_id'], $hotelData, 'hotel_Id');
                
                // Debug update result
                error_log('Update result: ' . ($updated ? 'true' : 'false'));
                
                if($updated) {
                    $_SESSION['success'] = "Your profile has been updated successfully!";
                    
                    // Redirect back to settings page
                    redirect('Hotel/Hsettings?success=Your profile has been updated successfully!');
                    
                } else {
                    $_SESSION['error'] = "Failed to update profile. Please try again.";
                    redirect('Hotel/Hsettings');
                }
                
                
            } else {
                redirect('Hotel/Hsettings');
                
            }
        }

        private function handleProfilePicUpload($hotelId) {
            if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
                // Use absolute server path instead of ROOT constant
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/uploads/hotels/' . $hotelId . '/logo/';
                
                // Generate a unique filename
                $fileName = uniqid() . '_' . basename($_FILES['profilePicture']['name']);
                
                // Full path for the uploaded file
                $uploadPath = $uploadDir . $fileName;
        
                // Ensure upload directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
        
                // Move uploaded file
                if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
                    // Return just the filename to be stored in the database
                    return $fileName;
                } else {
                    // Add error logging
                    error_log("File upload failed. Temp path: " . $_FILES['profilePicture']['tmp_name'] . ", Destination: " . $uploadPath);
                }
            }
        
            // Return existing profile picture if no new upload
            return $_POST['existingProfilePic'] ?? null;
        }
        
      
        
    }