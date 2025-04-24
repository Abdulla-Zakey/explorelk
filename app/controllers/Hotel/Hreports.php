<?php

class Hreports extends Controller {
    private $hotelModel;
    private $reportsModel;
    private $attachmentsModel;

    public function __construct() {
        $this->hotelModel = new Hotel();
        $this->reportsModel = new Reports();
        $this->attachmentsModel = new Attachments();
    }

    public function index() {
        $data = [];
        if (isset($_SESSION['hotel_id'])) {
            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
        }
        $this->view('hotel/reports', $data);
    }

    public function submit() {
        $data = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('hotel/Hreports');
            return;
        }

        // Log session data
        error_log("Session hotel_id: " . ($_SESSION['hotel_id'] ?? 'not set'));

        // Collect and sanitize input data
        $reportData = [
            'category' => trim($_POST['category'] ?? ''),
            'subject' => htmlspecialchars(trim($_POST['subject'] ?? '')),
            'description' => htmlspecialchars(trim($_POST['description'] ?? '')),
            'email' => trim($_POST['email'] ?? ''),
            'priority' => trim($_POST['priority'] ?? ''),
            'status' => 'pending',
            'word_count' => !empty($_POST['description']) ? str_word_count($_POST['description']) : 0,
            'char_count' => !empty($_POST['description']) ? strlen($_POST['description']) : 0,
            'hotel_id' => $_SESSION['hotel_id'] ?? null
        ];

        // Validate hotel_id
        if (empty($reportData['hotel_id'])) {
            $errors['hotel_id'] = "Hotel ID is required. Please log in.";
        }

        // Validate report data
        if (empty($errors) && $this->reportsModel->validate($reportData)) {
            try {
                $report_id = $this->reportsModel->insert($reportData);
                error_log("Insert result: " . ($report_id ? $report_id : 'false'));

                if ($report_id) {
                    // Handle file uploads
                    if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
                        $uploadSuccess = $this->handleFileUploads($report_id);
                        if (!$uploadSuccess) {
                            $errors['files'] = "There was a problem uploading one or more files";
                        }
                    }

                    // Handle AJAX response
                    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Report submitted successfully',
                            'report_id' => $report_id
                        ]);
                        exit;
                    }

                    redirect('hotel/Hreports/success');
                    return;
                } else {
                    $errors['db'] = "Failed to save report to database.";
                    error_log("Failed to insert report: " . print_r($reportData, true));
                }
            } catch (Exception $e) {
                $errors['db'] = "Server error: " . $e->getMessage();
                error_log("Submit error: " . $e->getMessage());
            }
        } else {
            $errors = array_merge($errors, $this->reportsModel->getErrors());
        }

        // Handle AJAX error response
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            echo json_encode([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $errors
            ]);
            exit;
        }

        // Render form with errors
        $data = array_merge($reportData, ['errors' => $errors]);
        if (isset($_SESSION['hotel_id'])) {
            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
        }
        $this->view('hotel/reports', $data);
    }

    private function handleFileUploads($report_id) {
        $uploadDirectory = APPROOT . '/public/Uploads/reports/';
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB

        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $allUploadsSuccessful = true;
        $fileErrors = [];

        foreach ($_FILES['files']['name'] as $key => $name) {
            if (empty($name)) continue;

            $file_tmp = $_FILES['files']['tmp_name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_type = $_FILES['files']['type'][$key];
            $file_error = $_FILES['files']['error'][$key];

            $filename = uniqid() . '_' . preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $name);
            $file_path = $uploadDirectory . $filename;

            // Validate file
            if ($file_error !== 0) {
                $fileErrors[] = "Error uploading file: $name";
                $allUploadsSuccessful = false;
                continue;
            }

            if ($file_size > $maxFileSize) {
                $fileErrors[] = "File too large: $name";
                $allUploadsSuccessful = false;
                continue;
            }

            if (!in_array($file_type, $allowedTypes)) {
                $fileErrors[] = "Invalid file type: $name";
                $allUploadsSuccessful = false;
                continue;
            }

            // Move the file
            if (move_uploaded_file($file_tmp, $file_path)) {
                $attachmentData = [
                    'report_id' => $report_id,
                    'file_name' => $name,
                    'file_path' => $file_path,
                    'file_type' => $file_type,
                    'file_size' => $file_size
                ];

                if (!$this->attachmentsModel->insert($attachmentData)) {
                    $fileErrors[] = "Failed to save attachment: $name";
                    $allUploadsSuccessful = false;
                }
            } else {
                $fileErrors[] = "Failed to move file: $name";
                $allUploadsSuccessful = false;
            }
        }

        if (!empty($fileErrors)) {
            error_log("File upload errors: " . implode(', ', $fileErrors));
        }

        return $allUploadsSuccessful;
    }

    public function success() {
        $data = [];
        if (isset($_SESSION['hotel_id'])) {
            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
        }
        $this->view('hotel/report_success', $data);
    }
}