<?php
class Rdashboard extends Controller {

    public function index($a = '', $b = '', $c = '') {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if restaurant_id is set in session
        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Debug - No restaurant_id in session, redirecting to Login");
            redirect('traveler/Login');
            exit();
        }

        // Load the RestaurantStatus and Restaurant models
        $restaurantStatus = new RestaurantStatus();
        $restaurantModel = new Restaurant();

        // Default message
        $message = '';

        // Handle form submission (POST request)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $status = $_POST['status'] ?? 'open';
            $open_time = $_POST['open_time'] ?? '09:00';
            $close_time = $_POST['close_time'] ?? '22:00';

            // Debug: Log the form data
            error_log("Debug - Form data: restaurant_id={$_SESSION['restaurant_id']}, status=$status, open_time=$open_time, close_time=$close_time");

            // Validate inputs
            if (empty($open_time) || empty($close_time)) {
                $message = "Open time and close time are required";
            } elseif (!in_array($status, ['open', 'closed'])) {
                $message = "Invalid status value";
            } else {
                // Update status in the database for the specific restaurant
                $result = $restaurantStatus->updateStatus($_SESSION['restaurant_id'], $status, $open_time, $close_time);
                $message = $result ? "Status updated successfully" : "Failed to update status";
            }
        }

        // Fetch the current (or updated) status data for the specific restaurant
        $statusData = $restaurantStatus->getStatus($_SESSION['restaurant_id']);

        // Fetch the restaurant name from the Restaurant model
        $restaurantData = $restaurantModel->where(['restaurant_id' => $_SESSION['restaurant_id']]);
        $restaurantName = $restaurantData ? $restaurantData[0]->restaurantName : 'Unknown Restaurant';

        // Prepare data for the view
        $data = [
            'restaurant_name' => $restaurantName,
            'status' => $statusData ? $statusData->status : 'open',
            'open_time' => $statusData ? $statusData->open_time : '09:00',
            'close_time' => $statusData ? $statusData->close_time : '22:00',
            'message' => $message
        ];

        // Render the view
        $this->view('restaurant/rdashboard', $data);
    }

    public function logout() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Unset restaurant-specific session variables
        unset($_SESSION['restaurant_id']);

        // Destroy the session
        session_destroy();

        // Redirect to login page
        redirect('Login');
        exit();
    }
}