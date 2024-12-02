<?php

class Signup extends Controller {
    
    public function index(){
        $this->view('signup/signUp');
    }


    public function submit() {
        // Initialize an empty error array
        $error = [];
        
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //var_dump($_POST)
            $username = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];

            $service = $_POST['servicetype'];

            if($service === 'Hotels'){

                $hotel = new Hotel;

                $data = [
                    'username' => $username,
                    'travelerEmail' => $email,
                    'travelerPassword' => $password,
                    'confirmPassword' => $confirmPassword
                ];

                // Validate the data
                if ($hotel->validate($data)) {
                    // Check if the email already exists
                    $existingTraveler = $hotel->where(['hotelEmail' => $_POST['email']]);
                    var_dump(!empty($existingTraveler));
                //     if (!empty($existingTraveler)) {
                //         // If email exists, add an error
                //         $error['email'] = 'This email address is already in use. Please use a different one.';
                //     } else {
                //         // Hash the password
                //         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                //         $data['travelerPassword'] = $hashedPassword;
                
                //         // Insert data
                //         $isInserted = $hotel->insert($data);
                
                //         $inserted = $hotel->where(['travelerEmail' => $data['travelerEmail']]);
                //         if (!empty($inserted)) {
                //             $_SESSION['success_message'] = 'Your account has been successfully created! You can now log in.';
                //             header("Location: " . ROOT . "/traveler/login");
                //             exit();
                //         } else {
                //             $error['database'] = 'Failed to create account. Please try again later.';
                //         }
                //     }
                // } else {
                //     // Handle validation errors
                //     $error = $hotel->errors;
                // } 
            }    
            else if($service === 'Resturants'){
                $resturant = new Resturant;

                $data = [
                    'username' => $username,
                    'travelerEmail' => $email,
                    'travelerPassword' => $password,
                    'confirmPassword' => $confirmPassword
                ];

                // Validate the data
                if ($resturant->validate($data)) {
                    // Check if the email already exists
                    $existingTraveler = $resturant->where(['hotelEmail' => $_POST['email']]);
                
                    if (!empty($existingTraveler)) {
                        // If email exists, add an error
                        $error['email'] = 'This email address is already in use. Please use a different one.';
                    } else {
                        // Hash the password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $data['travelerPassword'] = $hashedPassword;
                
                        // Insert data
                        $isInserted = $resturant->insert($_POST);
                
                        $inserted = $resturant->where(['travelerEmail' => $data['travelerEmail']]);
                        if (!empty($inserted)) {
                            $_SESSION['success_message'] = 'Your account has been successfully created! You can now log in.';
                            header("Location: " . ROOT . "/traveler/login");
                            exit();
                        } else {
                            $error['database'] = 'Failed to create account. Please try again later.';
                        }
                    }
                } else {
                    // Handle validation errors
                    $error = $resturant->errors;
                } 
            }
            else if($service === 'Travel Agent'){
                $agent = new Travel_Agent;

                $data = [
                    'username' => $username,
                    'travelerEmail' => $email,
                    'travelerPassword' => $password,
                    'confirmPassword' => $confirmPassword
                ];

                // Validate the data
                if ($agent->validate($data)) {
                    // Check if the email already exists
                    $existingTraveler = $agent->where(['hotelEmail' => $_POST['email']]);
                
                    if (!empty($existingTraveler)) {
                        // If email exists, add an error
                        $error['email'] = 'This email address is already in use. Please use a different one.';
                    } else {
                        // Hash the password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $data['travelerPassword'] = $hashedPassword;
                
                        // Insert data
                        $isInserted = $agent->insert($_POST);
                
                        $inserted = $agent->where(['travelerEmail' => $data['travelerEmail']]);
                        if (!empty($inserted)) {
                            $_SESSION['success_message'] = 'Your account has been successfully created! You can now log in.';
                            header("Location: " . ROOT . "/traveler/login");
                            exit();
                        } else {
                            $error['database'] = 'Failed to create account. Please try again later.';
                        }
                    }
                } else {
                    // Handle validation errors
                    $error = $agent->errors;
                } 
            }
            else if($service === 'Tour Guide'){
                $guide = new TourGuide_M;

                $data = [
                    'username' => $username,
                    'travelerEmail' => $email,
                    'travelerPassword' => $password,
                    'confirmPassword' => $confirmPassword
                ];

                // Validate the data
                if ($guide->validate($data)) {
                    // Check if the email already exists
                    $existingTraveler = $guide->where(['hotelEmail' => $_POST['email']]);
                
                    if (!empty($existingTraveler)) {
                        // If email exists, add an error
                        $error['email'] = 'This email address is already in use. Please use a different one.';
                    } else {
                        // Hash the password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $data['travelerPassword'] = $hashedPassword;
                
                        // Insert data
                        $isInserted = $guide->insert($_POST);
                
                        $inserted = $guide->where(['travelerEmail' => $data['travelerEmail']]);
                        if (!empty($inserted)) {
                            $_SESSION['success_message'] = 'Your account has been successfully created! You can now log in.';
                            header("Location: " . ROOT . "/traveler/login");
                            exit();
                        } else {
                            $error['database'] = 'Failed to create account. Please try again later.';
                        }
                    }
                } else {
                    // Handle validation errors
                    $error = $guide->errors;
                } 
            }
        }

        $this->view('Signup/signup', [
            'error' => $error,
            'success' => $_SESSION['success_message'] ?? null,
        ]);
    }
    }
}
