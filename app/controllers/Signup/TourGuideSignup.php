<?php

class TourGuideSignup extends Controller
{
    public function index()
    {
        
    
        // Create model instance
        $tourGuide = new TourGuide_M;
        // show($_POST);
        // Check if it's a POST request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // echo 'hi';
            // Sanitize input data
            $data = [
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'nic' => trim($_POST['nic']),
                'mobileNum' => trim($_POST['mobileNum']),
                'email' => trim($_POST['email']),
                'licenseNum' => trim($_POST['licenseNum']),
                'experience' => trim($_POST['experience']),
                'gender' => trim($_POST['gender']),
                'age' => trim($_POST['age']),
                'username' => trim($_POST['username']),
                'password' => $_POST['password'],
                'confirmPassword' => $_POST['confirmPassword']
            ];
            show($data);

            // Validate the data
            if ($tourGuide->validate($data)) {
                // Prepare data for insertion (including password hashing)
                $preparedData = $tourGuide->prepareSignupData($data);
                // show($preparedData);
                // Attempt to insert the new tour guide
                try {
                    if ($tourGuide->insert($preparedData)) {
                        // Redirect to login or dashboard
                        redirect('traveler/login');
                        exit();
                    } else {
                        // If insertion fails, set a registration error
                        $data['errors']['registration'] = "Registration failed. Please try again.";
                        $this->view('signup/tourGuideSignup', $data);
                    }
                } catch (Exception $e) {
                    // Handle any database-related exceptions
                    $data['errors']['registration'] = "An error occurred. Please try again later.";
                    $this->view('signup/tourGuideSignup', $data);
                }
            } else {
                // If validation fails, return to the signup view with errors
                $data['errors'] = $tourGuide->errors;
                $this->view('signup/tourGuideSignup', $data);
            }
        } else {
            // If not a POST request, just show the signup form
            $this->view('signup/tourGuideSignup');
        }
    }
}