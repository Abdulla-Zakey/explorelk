<?php

    class FindAHotel extends Controller{

        public function index(){

             // Check if the user is already logged in
        if (!isset($_SESSION['traveler_id'])) {
            redirect('traveler/Login');
            exit();
        }
        
        $this->view('traveler/findAHotel');
            
        }
    }
