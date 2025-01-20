<?php

class Signup extends Controller
{

    public function index()
    {
        // Initialize an empty error array
        $error = [];

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $data = [
                'username' => $_POST['travelerUserName'],
                'travelerEmail' => $_POST['travelerEmail'],
                'travelerPassword' => $_POST['travelerPassword'],
                'confirmPassword' => $_POST['confirmTravelerPassword'],
                'fName' => $_POST['firstName'],
                'lName' => $_POST['lastName'],
                'homeDistrict' => $_POST['homeDistrict'],
                'travelerMobileNum' => $_POST['travelerMobileNum'] ?? null, // Optional mobile number
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Create an instance of the Traveler model
            $traveler = new Traveler;

            // Validate the data
            if ($traveler->validate($data)) {
                // Hash the password
                $hashedPassword = password_hash($data['travelerPassword'], PASSWORD_DEFAULT);
                $data['travelerPassword'] = $hashedPassword;

                // Insert data
                $isInserted = $traveler->insert($data);

                if ($isInserted) {
                    // Start a session for the new traveler

                    // Get the newly inserted traveler's details
                    $newTraveler = $traveler->where([
                        'travelerEmail' => $data['travelerEmail']
                    ])[0];

                    // Set session variables
                    // $_SESSION['traveler_id'] = $newTraveler->traveler_Id;
                    // $_SESSION['username'] = $newTraveler->username;
                    // $_SESSION['email'] = $newTraveler->travelerEmail;

                    // Redirect to traveler home page
                    // $this->view('traveler/registeredTravelerHome');
                    redirect('traveler/Login');
                    exit();
                } else {
                    //$error['database'] = 'Failed to create account. Please try again later.';
                    // $this->view('traveler/login');
                    $this->redirectWithError("Failed to create account. Please try again later.");
                }
            } else {
                // Validation failed, get the errors
                $error = $traveler->errors;
            }
        }

        // Render the view with errors (if any)
        $this->view('traveler/signup', [
            'error' => $error
        ]);
    }
}

