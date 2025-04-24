<?php

    class Messages extends Controller{

        private $notificationsModel;

        public function __construct(){
           
            $this->notificationsModel = new NotificationsModel();
        }

        public function index(){

            // Check if user is logged in
            if (!isset($_SESSION['traveler_id'])) {
                header("Location: " . ROOT . "/traveler/Login");
                exit();
            }

            $notifications = $this->notificationsModel->getNotifications('traveler', $_SESSION['traveler_id']);
            $unreadNotifications = 0;
    
            foreach ($notifications as $notification) {
                if($notification->is_read == 0){
                    $unreadNotifications++;
                }
            }
    
            $data['unreadNotifications'] = $unreadNotifications;

            $this->view('traveler/messages', $data);
            
        }
    }
