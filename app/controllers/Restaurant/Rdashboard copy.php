<?php
class Rdashboard extends Controller {

    public function index($a = '', $b = '', $c = '') {
        // Load the RestaurantStatus model
        $restaurantStatus = new RestaurantStatus();

        // Default message
        $message = '';

        // Handle form submission (POST request)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data
            $status = $_POST['status'] ?? 'open';
            $open_time = $_POST['open_time'] ?? '09:00';
            $close_time = $_POST['close_time'] ?? '22:00';

            // Debug: Log the form data
            error_log("Debug - Form data: status=$status, open_time=$open_time, close_time=$close_time");

            // Validate inputs
            if (empty($open_time) || empty($close_time)) {
                $message = "Open time and close time are required";
            } elseif (!in_array($status, ['open', 'closed'])) {
                $message = "Invalid status value";
            } else {
                // Update status in the database
                $result = $restaurantStatus->updateStatus($status, $open_time, $close_time);
                $message = $result ? "Status updated successfully" : "Failed to update status";
            }
        }

        // Fetch the current (or updated) status data
        $statusData = $restaurantStatus->getStatus();

        // Prepare data for the view
        $data = [
            'restaurant_name' => 'Royal Bakery',
            'status' => $statusData ? $statusData->status : 'open',
            'open_time' => $statusData ? $statusData->open_time : '09:00',
            'close_time' => $statusData ? $statusData->close_time : '22:00',
            'message' => $message
        ];

        // Render the view (refresh the page)
        $this->view('restaurant/rdashboard', $data);
    }
}