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
                'emailVerified' => 0, // Not verified by default
                'verificationToken' => bin2hex(random_bytes(32)), // Generate random token
                'tokenExpiry' => date('Y-m-d H:i:s', strtotime('+24 hours')), // Token expires in 24 hours
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Create an instance of the Traveler model
            $traveler = new Traveler;

            // Validate the data
            if ($traveler->validate($data)) {
                // Hash the password
                $hashedPassword = password_hash($data['travelerPassword'], PASSWORD_DEFAULT);
                $data['travelerPassword'] = $hashedPassword;

                // Insert data
                $traveler_Id = $traveler->insert($data);

                if ($traveler_Id) {
                    
                    // Send verification email
                    $this->sendVerificationEmail($data);

                    // Redirect to a "verification pending" page
                    redirect('traveler/VerificationPending');
                    exit();

                } else {
                    
                    redirect("traveler/Signup?error=Failed to create account. Please try again later.");
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

    private function sendVerificationEmail($data)
    {
        $to = $data['travelerEmail'];
        $subject = "ExploreLK - Verify Your Email Address";
        
        // Create verification URL
        $verificationUrl = ROOT . "/traveler/VerifyEmail?token=" . $data['verificationToken'];
        
        // Email content
        $message = "
        <html>
        <head>
            <title>Email Verification</title>
        </head>
        <body>
            <h2>Welcome to ExploreLK!</h2>
            <p>Thank you for creating an account. To complete your registration, please verify your email address by clicking the link below:</p>
            <p>
                <a href='{$verificationUrl}'>
                    Verify My Email
                </a>
            </p>
            <p>If you did not create an account, please ignore this email.</p>
            <p>This link will expire in 24 hours.</p>
            <p>Verification Link: '{$verificationUrl}'</p>
            <p>Best regards,<br>The ExploreLK Team</p>
        </body>
        </html>
        ";
        
        // Set email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: noreply@explorelk.com" . "\r\n";
        
        // Send email
        mail($to, $subject, $message, $headers);
    }

}

