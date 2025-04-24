<?php

    class ViewProfile extends Controller {

        private $notificationsModel;

        public function __construct(){
            
            $this->notificationsModel = new NotificationsModel();
        }

        public function index() {
            // Check if user is logged in (assuming you have a session management system)
            if(!isset($_SESSION['traveler_id'])) {
                // Redirect to login if not logged in
                redirect('traveler/Login');
            }
    
            // Create an instance of the Traveler model and TravelerBankAccount model
            $travelerModel = new Traveler();
            $travelerBankAccountModel = new TravelerBankAccount();
    
            // Fetch the current logged-in traveler's details
            $travelerData = $travelerModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
            $bankAccountData = $travelerBankAccountModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
    
            // If traveler found, pass the data to the view
            if(!empty($travelerData)) {
                $data['traveler'] = $travelerData[0]; // Assuming first result
                
                // Check if bank account data exists before accessing
                $data['accountDetails'] = !empty($bankAccountData) ? $bankAccountData[0] : null;

                $notifications = $this->notificationsModel->getNotifications('traveler', $_SESSION['traveler_id']);
                $unreadNotifications = 0;

                foreach ($notifications as $notification) {
                    if($notification->is_read == 0){
                        $unreadNotifications++;
                    }  
                }

                $data['unreadNotifications'] = $unreadNotifications;
                
                $this->view('traveler/viewProfile', $data);
            } 
            else {
                // Handle case where traveler is not found
                redirect('traveler/Login');
            }
        }
    }