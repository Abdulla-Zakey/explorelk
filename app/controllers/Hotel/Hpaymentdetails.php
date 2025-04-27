<?php
class Hpaymentdetails extends Controller {
    public function index($a = '', $b = '', $c = '') {
        // Get the logged-in hotel ID
        $hotelId = $this->getLoggedInHotelId();
        
        // Load the model
        $hotelCommissionsModel = new HotelCommissionsModel();
        
        // Get filter parameters
        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        
        // Get pagination parameters
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        
        // Get monthly data for chart
        $monthlyData = $hotelCommissionsModel->getMonthlyData($hotelId, 6);
        
        // Get payment summary data
        $data = [
            'totalRevenue' => $hotelCommissionsModel->getTotalRevenue($hotelId),
            'currentMonthRevenue' => $hotelCommissionsModel->getCurrentMonthRevenue($hotelId),
            'currentMonthCommission' => $hotelCommissionsModel->getCurrentMonthCommission($hotelId),
            'paymentHistory' => $hotelCommissionsModel->getFilteredPaymentHistory($hotelId, $month, $year),
            'currentMonth' => $month,
            'currentYear' => $year,
            'monthlyData' => $monthlyData
        ];
        
        // Pass data to the view
        $this->view('hotel/paymentdetails', $data);
    }
    
    /**
     * Get the logged-in hotel ID
     * You'll need to adapt this to your authentication system
     * 
     * @return int
     */
    private function getLoggedInHotelId() {
        // This is a placeholder - replace with your actual authentication logic
        if(isset($_SESSION['USER']) && isset($_SESSION['USER']->hotel_Id)) {
            return $_SESSION['USER']->hotel_Id;
        }
        
        // Fallback - you might want to redirect to login instead
        return 1; // Default hotel ID for testing
    }
    
    /**
     * View detailed information for a specific booking
     */
    public function viewBookingDetails($bookingId) {
        // Get the logged-in hotel ID
        $hotelId = $this->getLoggedInHotelId();
        
        // Load necessary models
        $hotelCommissionsModel = new HotelCommissionsModel();
        
        // Get booking details
        $bookingDetails = $hotelCommissionsModel->getBookingDetails($bookingId);
        
        // Verify the booking belongs to the logged-in hotel
        if (!$bookingDetails || $bookingDetails->hotel_Id != $hotelId) {
            // Unauthorized or non-existent booking
            $_SESSION['error'] = "You don't have permission to view this booking or it doesn't exist.";
            redirect('Hpaymentdetails');
            return;
        }
        
        // Pass data to a detailed view
        $this->view('hotel/paymentdetails', [
            'booking' => $bookingDetails
        ]);
    }
    
    /**
     * Export payment history to CSV
     */
    public function exportPaymentHistory() {
        // Get the logged-in hotel ID
        $hotelId = $this->getLoggedInHotelId();
        
        // Filter parameters
        $month = isset($_GET['month']) ? $_GET['month'] : null;
        $year = isset($_GET['year']) ? $_GET['year'] : null;
        
        // Load the model
        $hotelCommissionsModel = new HotelCommissionsModel();
        
        // Get data
        $payments = $hotelCommissionsModel->getFilteredPaymentHistory($hotelId, $month, $year);
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="payment_history_' . date('Y-m-d') . '.csv"');
        
        // Open output stream
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($output, [
            'Date', 
            'Booking ID', 
            'Total Amount', 
            'Commission Rate', 
            'Commission Amount', 
            'Status'
        ]);
        
        // Add data rows
        foreach ($payments as $payment) {
            fputcsv($output, [
                date('Y-m-d', strtotime($payment->created_at)),
                $payment->room_booking_Id,
                $payment->total_amount,
                $payment->commission_rate . '%',
                $payment->commission_amount,
                $payment->is_applicable_for_commission ? 'Active' : 'Not Applicable'
            ]);
        }
        
        // Close the file
        fclose($output);
        exit;
    }
}