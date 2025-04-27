<?php

class Eosettings extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if organizer is logged in
        if (!isset($_SESSION['organizer_id'])) {
            header('Location: ' . ROOT . '/eventorganizer/login');
            exit();
        }

        $eventOrganizer = new Eventorganizer();
        $organizerId = $_SESSION['organizer_id'];
        $errors = [];
        $data = [];

        // Fetch current organizer data
        $organizerData = $eventOrganizer->where(['organizer_Id' => $organizerId]);
        if (empty($organizerData)) {
            header('Location: ' . ROOT . '/eventorganizer/login');
            exit();
        }
        $organizerData = $organizerData[0];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formType = $_POST['form_type'] ?? '';

            if ($formType === 'profile') {
                // Sanitize inputs
                $data = [
                    'organizer_Id' => $organizerId,
                    'company_Email' => filter_var($_POST['company_email'] ?? '', FILTER_SANITIZE_EMAIL),
                    'company_MobileNum' => filter_var($_POST['company_mobile'] ?? '', FILTER_SANITIZE_STRING),
                    'company_Name' => filter_var($_POST['company_name'] ?? '', FILTER_SANITIZE_STRING),
                    'company_Address' => filter_var($_POST['company_address'] ?? '', FILTER_SANITIZE_STRING),
                ];

                // Clean mobile number
                $cleanMobile = preg_replace('/[\s-]+/', '', $data['company_MobileNum']);

                // Validate form fields
                if (empty($data['company_Name'])) {
                    $errors['company_name'] = 'Company name is required.';
                }

                if (!empty($data['company_Email']) && !filter_var($data['company_Email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['company_email'] = 'Invalid email format.';
                }

                if (!empty($cleanMobile) && !preg_match('/^0\d{9}$/', $cleanMobile)) {
                    $errors['company_mobile'] = 'Mobile number must start with 0 and have 10 digits (e.g., 0771234567).';
                }

                if (empty($data['company_Address'])) {
                    $errors['company_address'] = 'Company address is required.';
                }

                // Update mobile number with cleaned version
                $data['company_MobileNum'] = $cleanMobile;

                // Handle image upload
                if (!empty($_FILES['profile_image']['name'])) {
                    $uploadDir = 'Uploads/eventorganizer/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $fileName = $organizerId . '_' . time() . '_' . basename($_FILES['profile_image']['name']);
                    $uploadPath = $uploadDir . $fileName;
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $maxSize = 2 * 1024 * 1024; // 2MB

                    if (!in_array($_FILES['profile_image']['type'], $allowedTypes)) {
                        $errors['profile_image'] = 'Only JPEG, PNG, or GIF files are allowed.';
                    } elseif ($_FILES['profile_image']['size'] > $maxSize) {
                        $errors['profile_image'] = 'File size must be under 2MB.';
                    } elseif (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadPath)) {
                        $errors['profile_image'] = 'Failed to upload image.';
                    } else {
                        $data['company_logo'] = $uploadPath;
                    }
                }

                if (empty($errors) && $eventOrganizer->updateOrganizer($organizerId, $data)) {
                    $_SESSION['success_message'] = 'Profile updated successfully!';
                    header('Location: ' . ROOT . '/eventorganizer/eosettings');
                    exit();
                } else {
                    $errors = array_merge($errors, $eventOrganizer->getErrors());
                }
            }
        }

        $this->view('eventorganizer/eosettings', [
            'errors' => $errors,
            'data' => $organizerData,
            'success_message' => $_SESSION['success_message'] ?? null,
        ]);

        unset($_SESSION['success_message']);
    }
}