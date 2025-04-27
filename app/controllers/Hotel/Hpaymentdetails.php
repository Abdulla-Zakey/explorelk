<?php
class Hpaymentdetails extends Controller {
    private $hotelModel;
    public function index($a = '', $b = '', $c = '') {
        // Get the logged-in hotel ID
        $hotelId = isset($_SESSION['hotel_id']) ? $_SESSION['hotel_id'] : null;
        
        // Load the model
        $hotelCommissionsModel = new HotelCommissionsModel();
        $hotelModel = new Hotel();

        // Get all commissions for this hotel
        $commissions = $hotelCommissionsModel->where(['hotel_id' => $_SESSION['hotel_id']]);
        
        // Since we can't filter by status in the database, let's do it in PHP
        // Initialize empty arrays for different status categories
        $approvedCommissions = $hotelCommissionsModel->where(['hotel_id' => $_SESSION['hotel_id'], 'status' => 'Approved']);
        $pendingCommissions = $hotelCommissionsModel->where(['hotel_id' => $_SESSION['hotel_id'], 'status' => 'Pending']);
        $rejectedCommissions = $hotelCommissionsModel->where(['hotel_id' => $_SESSION['hotel_id'], 'status' => 'Denied']);
        $totalCommission = 0; // Initialize total commission
        
        // If there's a field in your commissions that indicates status, you could do:
        // foreach ($commissions as $commission) {
        //     if ($commission->some_status_field == 'approved') {
        //         $approvedCommissions[] = $commission;
        //         $totalCommission += $commission->commission_amount;
        //     } else if ($commission->some_status_field == 'pending') {
        //         $pendingCommissions[] = $commission;
        //     } else if ($commission->some_status_field == 'rejected') {
        //         $rejectedCommissions[] = $commission;
        //     }
        // }
        
        // Get filter parameters
        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        // $hi = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
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
            'earningHistory' => $hotelCommissionsModel->getFilteredPaymentHistory($hotelId, $month, $year), // Assuming same data for earning
            'currentMonth' => $month,
            'currentYear' => $year,
            'monthlyData' => $monthlyData,
            'commissions' => $commissions,
            'approvedCommissions' => $approvedCommissions,
            'pendingCommissions' => $pendingCommissions,
            'rejectedCommissions' => $rejectedCommissions,
            'totalCommission' => $totalCommission
        ];
        
        // Pass data to the view
        $this->view('hotel/paymentdetails', $data);

    }    
    /**
     * Get the logged-in hotel ID
     * @return int
     */
    private function getLoggedInHotelId() {
        if (isset($_SESSION['USER']) && isset($_SESSION['USER']->hotel_Id)) {
            return $_SESSION['USER']->hotel_Id;
        }
        // Redirect to login if no hotel ID
        redirect('traveler/login');
        return 0;
    }
    
    /**
     * View detailed information for a specific booking
     */
    public function viewBookingDetails($bookingId) {
        // Get the logged-in hotel ID
        $hotelId = $this->getLoggedInHotelId();
        
        // Load necessary models
        $hotelCommissionsModel = new HotelCommissionsModel();
        $roomBookingsModel = new RoomBookingsFinalModel();
        
        // Get booking details
        $bookingDetails = $hotelCommissionsModel->getBookingDetails($bookingId);
        
        // Verify the booking belongs to the logged-in hotel
        if (!$bookingDetails || $bookingDetails->hotel_Id != $hotelId) {
            $_SESSION['error'] = "You don't have permission to view this booking or it doesn't exist.";
            redirect('Hpaymentdetails');
            return;
        }
        
        // Fetch additional room booking details
        $roomBooking = $roomBookingsModel->getRoomBookingByBookingId($bookingId);
        
        // Prepare data for the view
        $data = [
            'bookingDetails' => $bookingDetails,
            'roomBooking' => $roomBooking,
            'totalRevenue' => $hotelCommissionsModel->getTotalRevenue($hotelId),
            'currentMonthRevenue' => $hotelCommissionsModel->getCurrentMonthRevenue($hotelId),
            'currentMonthCommission' => $hotelCommissionsModel->getCurrentMonthCommission($hotelId),
            'paymentHistory' => $hotelCommissionsModel->getFilteredPaymentHistory($hotelId),
            'earningHistory' => $hotelCommissionsModel->getFilteredPaymentHistory($hotelId),
            'currentMonth' => date('m'),
            'currentYear' => date('Y')
        ];
        
        // Pass data to the view
        $this->view('hotel/paymentdetails', $data);
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