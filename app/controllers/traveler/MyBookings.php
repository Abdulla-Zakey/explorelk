<?php

    class MyBookings extends Controller{

        public function index(){

            // Check if user is logged in
            if (!isset($_SESSION['traveler_id'])) {
                header("Location: " . ROOT . "/traveler/Login");
                exit();
            }

            $this->view('traveler/myBookings');
            
        }
    }
