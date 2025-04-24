<?php

class Eosettings extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        // Start session only if not already active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Ensure the user is logged in
        if (!isset($_SESSION['organizer_id'])) {
            header('Location: ' . ROOT . '/eventorganizer/login');
            exit();
        }

        $eventOrganizer = new Eventorganizer();
        $organizerId = $_SESSION['organizer_id'];
        $errors = [];
        $data = [];

        // Fetch current organizer data
        $organizerData = $eventOrganizer->where(['organizer_Id' => $organizerId])[0] ?? [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formType = $_POST['form_type'] ?? '';

            if ($formType === 'personal') {
                $data = [
                    'organizer_Id' => $organizerId,
                    'first_Name' => $_POST['first_name'] ?? '',
                    'last_Name' => $_POST['last_name'] ?? '',
                    'company_Email' => $_POST['company_email'] ?? '',
                    'company_MobileNum' => $_POST['company_mobile'] ?? '',
                    'company_Address' => $_POST['address'] ?? '',
                    'website' => $_POST['website'] ?? '',
                    'blog' => $_POST['blog'] ?? '',
                ];

                // Handle profile image upload
                if (!empty($_FILES['profile_image']['name'])) {
                    $uploadDir = 'Uploads/profile_images/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $fileName = $organizerId . '_' . time() . '_' . basename($_FILES['profile_image']['name']);
                    $uploadPath = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
                        $data['profile_Image'] = $uploadPath;
                    } else {
                        $errors['profile_image'] = 'Failed to upload profile image.';
                    }
                }

                if (empty($errors) && $eventOrganizer->updateOrganizer($organizerId, $data)) {
                    $_SESSION['success_message'] = 'Personal information updated successfully!';
                    header('Location: ' . ROOT . '/eventorganizer/eosettings');
                    exit();
                } else {
                    $errors = array_merge($errors, $eventOrganizer->errors);
                }

            } elseif ($formType === 'professional') {
                $data = [
                    'organizer_Id' => $organizerId,
                    'company_Name' => $_POST['company_name'] ?? '',
                    'job_Title' => $_POST['job_title'] ?? '',
                    'company_Address' => $_POST['company_address'] ?? '',
                    'event_Type' => $_POST['event_type'] ?? '',
                    'experience' => $_POST['experience'] ?? '',
                ];

                if ($eventOrganizer->updateOrganizer($organizerId, $data)) {
                    $_SESSION['success_message'] = 'Professional information updated successfully!';
                    header('Location: ' . ROOT . '/eventorganizer/eosettings');
                    exit();
                } else {
                    $errors = $eventOrganizer->errors;
                }
            }
        }

        // Render the settings view
        $this->view('eventorganizer/eosettings', [
            'errors' => $errors,
            'data' => $organizerData,
            'success_message' => $_SESSION['success_message'] ?? null,
        ]);

        // Clear success message
        unset($_SESSION['success_message']);
    }
}