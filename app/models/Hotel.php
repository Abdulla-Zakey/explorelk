<?php

    class Hotel{

        use Model;

        protected $table = 'hotel';

        protected $allowedColumns = [
            'hotel_Id'
            'hotelName',
            'hotelEmail',
            'hotelPassword',
            'hotelMobileNum',
            'hotelAddress',
            'district',
            'province',
            'totalRooms',
            'hotelDescription',
            'serviceProviderName',
            'BRNum',
            'yearStarted'
        ];


        public function validate($data) {

            $this->errors = [];
        
            // Validate email
            if (empty($data['travelerEmail'])) {
                $this->errors['travelerEmail'] = "Email is required.";
            } 
            elseif (!filter_var($data['travelerEmail'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['travelerEmail'] = "Email is not valid.";
            }
        
            // Validate username
            if (empty($data['username'])) {
                $this->errors['username'] = "Username is required.";
            } 
            elseif (strlen($data['username']) < 4) {
                $this->errors['username'] = "Username must be at least 4 characters long.";
            } 
            elseif (strlen($data['username']) > 12) {
                $this->errors['username'] = "Username cannot exceed 20 characters.";
            }
        
            // Validate password
            if (empty($data['travelerPassword'])) {
                $this->errors['travelerPassword'] = "Password is required.";
            } 
            elseif (strlen($data['travelerPassword']) < 8) {
                $this->errors['travelerPassword'] = "Password must be at least 8 characters long.";
            }
        
            // Validate confirm password
            if (empty($data['confirmPassword'])) {
                $this->errors['confirmPassword'] = "Confirm Password is required.";
            } 
            elseif ($data['travelerPassword'] !== $data['confirmPassword']) {
                $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
            }
        
            //var_dump($this->empty);
            // Return validation result
            return empty($this->errors);

        }

    }
