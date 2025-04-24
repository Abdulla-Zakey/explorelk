<?php

    class Rpaymentdetails extends Controller{

        public function index($a = '', $b = '', $c = ''){

            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Check if restaurant_id is set in session
            if (!isset($_SESSION['restaurant_id'])) {
                // Redirect to login page if session is not set
                error_log("Debug - No restaurant_id in session, redirecting to Login");
                redirect('traveler/Login');
                exit();
            }

           

            $this->view('restaurant/rpaymentdetails');;
            
        }
    }

    