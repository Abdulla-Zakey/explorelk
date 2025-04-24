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
                    
                    // Handle file uploads if needed (only if basic data update worked)
                    if(isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] == 0) {
                        $this->handleLogoUpload($_SESSION['hotel_id']);
                    }
                    
                    if(isset($_FILES['hotel-photos']) && !empty($_FILES['hotel-photos']['name'][0])) {
                        $this->handleHotelPhotosUpload($_SESSION['hotel_id']);
                    }
                } else {
                    $_SESSION['error'] = "Failed to update profile. Please try again.";
                }
                
                // Redirect back to settings page
                redirect('Hotel/Hsettings');
            } else {
                // Handle GET request - redirect to settings page
                redirect('Hotel/Hsettings');
            }
        }
        
      
        
    }