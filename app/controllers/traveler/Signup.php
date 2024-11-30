<?php

class Signup extends Controller {
    
    public function index() {
        // Initialize an empty error array
        $error = [];
        
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $username = $_POST['travelerUserName'];
            $email = $_POST['travelerEmail'];
            $password = $_POST['travelerPassword'];
            $confirmPassword = $_POST['confirmTravelerPassword'];

            // Create an instance of the Traveler model
            $traveler = new Traveler;

            // Data to validate and insert
            $data = [
                'username' => $username,
                'travelerEmail' => $email,
                'travelerPassword' => $password,
                'confirmPassword' => $confirmPassword
            ];

            // Validate the data
            if ($traveler->validate($data)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $data['travelerPassword'] = $hashedPassword;

                // Insert data
                $isInserted = $traveler->insert($data);

                if ($isInserted) {
                    $_SESSION['success_message'] = 'Your account has been successfully created! You can now log in.';
                    // header("Location: " . $ROOT . "/traveler/login");
                    $this->view('/traveler/login');
                    exit();
                } 
                else {
                    $error['database'] = 'Failed to create account. Please try again later.';
                }
            } 
            else {
                // Hash the password before storing
                $error = $traveler->errors;
            }
        }

        // Render the view with errors (if any)
        $this->view('traveler/signup', [
            'error' => $error,
            'success' => $_SESSION['success_message'] ?? null,
        ]);
    }
}
