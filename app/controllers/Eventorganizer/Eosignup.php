<?php

class Eosignup extends Controller
{
    public function index()
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }   
        
        if (!isset($_SESSION['organizer_id'])) {
            error_log("Session Error: organizer_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $error = [];
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'company_Name' => $_POST['company_Name'] ?? '',
                'company_Email' => $_POST['company_Email'] ?? '',
                'company_MobileNum' => $_POST['company_MobileNum'] ?? '',
                'company_Address' => $_POST['company_Address'] ?? '',
                'company_Password' => $_POST['company_Password'] ?? '',
                'confirm_Password' => $_POST['confirm_Password'] ?? '',
            ];

            $eventOrganizer = new Eventorganizer;

            // Validate the data
            if ($eventOrganizer->validate($data)) {
                // Hash the password
                $hashedPassword = password_hash($data['company_Password'], PASSWORD_DEFAULT);
                $data['company_Password'] = $hashedPassword;

                // Remove confirm password before inserting
                unset($data['confirm_Password']);

                // Insert data
                try {
                    $isInserted = $eventOrganizer->insert($data);

                    if ($isInserted) {
                        // Start a session for the new organizer
                        session_start();

                        // Get the newly inserted organizer's details
                        $newEventOrganizer = $eventOrganizer->where([
                            'company_Email' => $data['company_Email']
                        ])[0];

                        // Set session variables
                        $_SESSION['organizer_id'] = $newEventOrganizer->organizer_Id;

                        // Redirect to the organizer dashboard
                        header('Location: ' . ROOT . '/eventorganizer/eodashboard');
                        exit();
                    } else {
                        // Log more detailed error information
                        error_log('Database insertion failed for: ' . print_r($data, true));
                        $error['database'] = 'Failed to create account. Database insertion error.';
                    }
                } catch (Exception $e) {
                    // Catch any exceptions during insertion
                    error_log('Exception during account creation: ' . $e->getMessage());
                    $error['database'] = 'An unexpected error occurred. Please try again.';
                }
            } else {
                // Validation failed, get the errors
                $error = $eventOrganizer->errors;
            }
        }

        // Render the view with errors and data
        $this->view('eventorganizer/eoregister', [
            'error' => $error,
            'data' => $data
        ]);
    }
}