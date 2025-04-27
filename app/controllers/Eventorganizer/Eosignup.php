<?php

class Eosignup extends Controller
{
    public function index()
    {
        $error = [];
        $data = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'company_Name' => $_POST['company_Name'] ?? '',
                'company_Email' => $_POST['company_Email'] ?? '',
                'company_MobileNum' => $_POST['company_MobileNum'] ?? '',
                'company_Address' => $_POST['company_Address'] ?? '',
                'company_Password' => $_POST['company_Password'] ?? '',
                'confirm_Password' => $_POST['confirm_Password'] ?? ''
            ];

            $eventOrganizer = new Eventorganizer;

            // Check if email already exists
            $existingOrganizer = $eventOrganizer->where(['company_Email' => $data['company_Email']]);
            if (!empty($existingOrganizer)) {
                $error['company_Email'] = 'Email already exists. Please use a different email or log in.';
            }

            // Validate mobile number (exactly 10 digits)
            if (!preg_match('/^\d{10}$/', $data['company_MobileNum'])) {
                $error['company_MobileNum'] = 'Mobile number must be exactly 10 digits.';
            }

            // Validate the data if no errors
            if (empty($error)) {
                $validationResult = $eventOrganizer->validate($data);
                if ($validationResult === true) {
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

                            // Set success flag
                            $success = true;
                        } else {
                            error_log('Database insertion failed for: ' . print_r($data, true));
                            $error['database'] = 'Failed to create account. Database insertion error.';
                        }
                    } catch (Exception $e) {
                        error_log('Exception during account creation: ' . $e->getMessage());
                        $error['database'] = 'An unexpected error occurred. Please try again.';
                    }
                } else {
                    // Validation failed, assume validate() returned errors
                    $error = array_merge($error, is_array($validationResult) ? $validationResult : []);
                }
            }
        }

        // Render the view with errors, data, and success flag
        $this->view('eventorganizer/eoregister', [
            'error' => $error,
            'data' => $data,
            'success' => $success
        ]);
    }
}