<?php

class VerifyEmail extends Controller
{
    public function index()
    {
        // Check if token is provided
        if (!isset($_GET['token']) || empty($_GET['token'])) {
            redirect('traveler/Login');
            exit();
        }

        $token = $_GET['token'];
        $traveler = new Traveler;
        
        // Find user with this token
        $user = $traveler->first([
            'verificationToken' => $token
        ]);

        if (empty($user)) {
            // Invalid token
            $this->view(
                'traveler/verificationFailed', 
                [
                    'message' => 'Invalid verification token. 
                    Please try signing up again.'
                ]
            );
            return;
        }
        
        // Check if token is expired
        if (strtotime($user->tokenExpiry) < time()) {
            $this->view(
                'traveler/verificationFailed', 
                [
                    'message' => 'Verification link has expired. 
                    Please request a new one.'
                ]
            );
            return;
        }

        // Token is valid, update user to verified status
        $traveler->update(
            $user->traveler_Id, 
            [
                'emailVerified' => 1,
                'verificationToken' => null,
                'tokenExpiry' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ],
            'traveler_Id'
            );

        // Show success message and redirect to login
        $this->view('traveler/verificationSuccess');
    }
    
    public function resend()
    {
        $error = [];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $email = $_POST['email'];
                $traveler = new Traveler;
                
                $user = $traveler->where([
                    'travelerEmail' => $email
                ]);
                
                if (!empty($user)) {
                    $user = $user[0];
                    
                    // Only resend if not verified yet
                    if ($user->email_verified == 0) {
                        // Generate new token
                        $token = bin2hex(random_bytes(32));
                        $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));
                        
                        // Update user with new token
                        $traveler->update(
                            $user->traveler_Id, 
                            [
                                'verificationToken' => $token,
                                'tokenExpiry' => $expiry,
                                'updated_at' => date('Y-m-d H:i:s')
                            ],
                            'traveler_Id'
                            );
                        
                        // Send new verification email
                        $this->sendVerificationEmail($email, $token);
                        
                        redirect('traveler/VerificationPending');
                        exit();
                    } else {
                        $error['email'] = 'This email is already verified. Please login.';
                    }
                } else {
                    $error['email'] = 'Email not found. Please sign up first.';
                }
            } else {
                $error['email'] = 'Please enter your email address.';
            }
        }
        
        $this->view('traveler/resendVerification', [
            'error' => $error
        ]);
    }
    
    private function sendVerificationEmail($email, $token)
    {
        $to = $email;
        $subject = "ExploreLK - Verify Your Email Address";
        
        // Create verification URL
        $verificationUrl = ROOT . "/traveler/VerifyEmail?token=" . $token;
        
        // Email content
        $message = "
        <html>
        <head>
            <title>Email Verification</title>
        </head>
        <body>
            <h2>Welcome to ExploreLK!</h2>
            <p>To complete your registration, please verify your email address by clicking the link below:</p>
            <p><a href='{$verificationUrl}'>Verify My Email</a></p>
            <p>If you did not create an account, please ignore this email.</p>
            <p>This link will expire in 24 hours.</p>
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