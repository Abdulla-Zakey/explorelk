<?php
class Eopayments extends Controller {

    
    public function index($a = '', $b = '', $c = '') {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if organizer_id is set
        if (!isset($_SESSION['organizer_id'])) {
            error_log("Session Error: organizer_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/Eventorganizer/Login");
            exit();
        }

        // Instantiate the EventOrganizerBank model
        $bankModel = new EventOrganizerBank();

        // Fetch bank details for the logged-in organizer
        $bankDetails = $bankModel->getBankDetailsByOrganizerId($_SESSION['organizer_id']);
        $eventCommissionsModel = new EventCommissions();
        $eventCommissions = $eventCommissionsModel->selectALL();
// show($eventCommissions);
        // Pass data to the view
        $data = [
            'bankDetails' => $bankDetails,
            'eventCommissions' => $eventCommissions,
        ];

        $this->view('eventorganizer/eopayments', $data);
    }

    public function saveBankDetails() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if organizer_id is set
        if (!isset($_SESSION['organizer_id'])) {
            echo json_encode(['success' => false, 'message' => 'Organizer not logged in']);
            exit();
        }

        // Check if the request is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit();
        }

        // Get the POST data
        $postData = json_decode(file_get_contents('php://input'), true);
        if (!$postData || !isset($postData['accountName']) || !isset($postData['accountNumber']) || !isset($postData['bankName'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            exit();
        }

        // Prepare the data to insert
        $data = [
            'organizer_id' => $_SESSION['organizer_id'],
            'account_name' => $postData['accountName'],
            'account_number' => $postData['accountNumber'],
            'bank_name' => $postData['bankName']
        ];

        // Instantiate the EventOrganizerBank model
        $bankModel = new EventOrganizerBank();

        // Insert the bank details
        $result = $bankModel->insertBankDetails($data);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Bank details saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save bank details']);
        }
    }

    public function updateBankDetails() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if organizer_id is set
        if (!isset($_SESSION['organizer_id'])) {
            echo json_encode(['success' => false, 'message' => 'Organizer not logged in']);
            exit();
        }

        // Check if the request is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit();
        }

        // Get the POST data
        $postData = json_decode(file_get_contents('php://input'), true);
        if (!$postData || !isset($postData['id']) || !isset($postData['accountName']) || !isset($postData['accountNumber']) || !isset($postData['bankName'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            exit();
        }

        // Prepare the data to update
        $data = [
            'account_name' => $postData['accountName'],
            'account_number' => $postData['accountNumber'],
            'bank_name' => $postData['bankName']
        ];

        // Instantiate the EventOrganizerBank model
        $bankModel = new EventOrganizerBank();

        // Update the bank details
        $result = $bankModel->updateBankDetails($postData['id'], $data);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Bank details updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update bank details']);
        }
    }

    public function deleteBankDetails() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Check if organizer_id is set
        if (!isset($_SESSION['organizer_id'])) {
            echo json_encode(['success' => false, 'message' => 'Organizer not logged in']);
            exit();
        }
    
        // Check if the request is POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit();
        }
    
        // Get the POST data
        $postData = json_decode(file_get_contents('php://input'), true);
        if (!$postData || !isset($postData['id'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            exit();
        }
    
        // Instantiate the EventOrganizerBank model
        $bankModel = new EventOrganizerBank();
    
        // Attempt to delete the bank details
        $result = $bankModel->deleteBankDetails($postData['id']);
    
        // Verify deletion by checking if the record still exists
        $remainingDetails = $bankModel->getBankDetailsByOrganizerId($_SESSION['organizer_id']);
        $recordExists = false;
        foreach ($remainingDetails as $detail) {
            if ($detail->id == $postData['id']) {
                $recordExists = true;
                break;
            }
        }
    
        if (!$recordExists) {
            echo json_encode(['success' => true, 'message' => 'Bank details deleted successfully']);
        } else {
            error_log("Failed to delete bank details for ID: " . $postData['id']);
            echo json_encode(['success' => false, 'message' => 'Failed to delete bank details']);
        }
    }
}