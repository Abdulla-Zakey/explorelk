<?php

    class Eodashboard extends Controller{

        public function index(){
            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }   
            
            if (!isset($_SESSION['organizer_id'])) {
                error_log("Session Error: organizer_id not set in session. Redirecting to login.");
                header("Location: " . ROOT . "/traveler/Login");
                exit();
            }

            $this->view('eventorganizer/eodashboard');

            
        }
    }

    