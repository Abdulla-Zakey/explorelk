<?php

class Hpaymentdetails extends Controller {

    private $hotelCommissionsModel;
    private $bookingsModel;
    private $hotelsModel;
    private $usersModel;

    public function __construct() {
        // Load all necessary models
        $this->hotelCommissionsModel = $this->loadModel('HotelCommissionsModel');
        $this->bookingsModel = $this->loadModel('RoomBookingModel');
        $this->hotelsModel = $this->loadModel('Hotel');
        $this->usersModel = $this->loadModel('HotelGuestsModel');
    }

    public function index() {
        // Ensure the user is logged in as a hotel owner
        $user_id = $_SESSION['user_id'] ?? 0;
        $hotel_id = $_SESSION['hotel_id'] ?? 0;

        if (!$user_id || !$hotel_id) {
            redirect("login");
        }

        // Get hotel information
        $hotel = $this->hotelsModel->first(['hotel_Id' => $hotel_id]);
        
        if (!$hotel) {
            redirect("login");
        }

        // Get financial statistics
        $totalRevenue = $this->getTotalRevenue($hotel_id);
        $pendingPayments = $this->getPendingPayments($hotel_id);
        $todaysEarnings = $this->getTodaysEarnings($hotel_id);
        
        // Get recent payments with pagination
        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $recentPayments = $this->getRecentPayments($hotel_id, $limit, $offset);
        
        // Prepare data for the view
        $data = [
            'hotel' => $hotel,
            'hotelBasic' => $hotel,
            'totalRevenue' => $totalRevenue,
            'pendingPayments' => $pendingPayments,
            'todaysEarnings' => $todaysEarnings,
            'recentPayments' => $recentPayments,
            'page' => $page
        ];

        // Load the view with data
        $this->view('hotel/paymentdetails', $data);
    }

    public function details($booking_id = null) {
        if (!$booking_id) {
            redirect("hpaymentdetails");
        }

        $hotel_id = $_SESSION['hotel_id'] ?? 0;
        
        // Get detailed booking information
        $booking = $this->bookingsModel->first(['roomBooking_Id' => $booking_id]);
        
        if (!$booking || $booking->hotel_Id != $hotel_id) {
            redirect("hpaymentdetails");
        }
        
        // Get commission information
        $commission = $this->hotelCommissionsModel->first(['room_booking_Id' => $booking_id]);
        
        // Get guest information
        $guest = $this->usersModel->getGuestByBookingId($booking_id);

        $data = [
            'booking' => $booking,
            'commission' => $commission,
            'guest' => $guest
        ];

        $this->view('hotel/paymentdetails', $data);
    }

    public function export() {
        $hotel_id = $_SESSION['hotel_id'] ?? 0;
        
        if (!$hotel_id) {
            redirect("login");
        }
        
        $start_date = $_GET['start_date'] ?? date('Y-m-01');
        $end_date = $_GET['end_date'] ?? date('Y-m-t');
        
        // Get all payments for the specified period
        $payments = $this->getPaymentsByDateRange($hotel_id, $start_date, $end_date);
        
        // Generate CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="payment_report_' . $start_date . '_to_' . $end_date . '.csv"');
        
        $output = fopen('php://output', 'w');
        
        // CSV Headers
        fputcsv($output, ['Booking ID', 'Guest Name', 'Room Number', 'Amount', 'Commission', 'Net Amount', 'Payment Date', 'Status']);
        
        // CSV Data
        foreach ($payments as $payment) {
            fputcsv($output, [
                $payment->booking_id,
                $payment->guest_name,
                $payment->room_number,
                $payment->amount,
                $payment->commission_amount,
                $payment->net_amount,
                $payment->payment_date,
                $payment->status
            ]);
        }
        
        fclose($output);
        exit;
    }

    /* Helper methods for data retrieval using the Database trait */

    private function getTotalRevenue($hotel_id) {
        $query = "SELECT SUM(total_amount) as total FROM room_booking 
                 WHERE hotel_Id = :hotel_id AND bookingStatus = 'Confirmed'";
        
        $result = $this->bookingsModel->query($query, [':hotel_id' => $hotel_id]);
        
        return $result[0]->total ?? 0;
    }

    private function getPendingPayments($hotel_id) {
        $query = "SELECT SUM(total_amount) as total FROM room_booking 
                 WHERE hotel_Id = :hotel_id AND bookingStatus = 'Pending'";
        
        $result = $this->bookingsModel->query($query, [':hotel_id' => $hotel_id]);
        
        return $result[0]->total ?? 0;
    }

    private function getTodaysEarnings($hotel_id) {
        $today = date('Y-m-d');
        $query = "SELECT SUM(total_amount) as total FROM room_booking 
                 WHERE hotel_Id = :hotel_id AND DATE(bookedDate) = :today AND bookingStatus = 'Confirmed'";
        
        $result = $this->bookingsModel->query($query, [
            ':hotel_id' => $hotel_id,
            ':today' => $today
        ]);
        
        return $result[0]->total ?? 0;
    }

    private function getRecentPayments($hotel_id, $limit, $offset) {
        $query = "SELECT rb.roomBooking_Id as booking_id, hg.guest_full_name as first_name, '' as last_name, 
                         rb.room_Id as room_number, rb.total_amount, rb.bookedDate as payment_date, 
                         rb.bookingStatus as payment_status, hc.commission_amount 
                  FROM room_booking rb
                  LEFT JOIN hotel_guests hg ON rb.roomBooking_Id = hg.room_booking_Id
                  LEFT JOIN hotel_commissions hc ON rb.roomBooking_Id = hc.room_booking_Id
                  WHERE rb.hotel_Id = :hotel_id
                  ORDER BY rb.bookedDate DESC
                  LIMIT :limit OFFSET :offset";
        
        return $this->bookingsModel->query($query, [
            ':hotel_id' => $hotel_id,
            ':limit' => (int)$limit,
            ':offset' => (int)$offset
        ]);
    }

    private function getPaymentsByDateRange($hotel_id, $start_date, $end_date) {
        $query = "SELECT rb.roomBooking_Id as booking_id, hg.guest_full_name as guest_name, 
                         rb.room_Id as room_number, rb.total_amount as amount, hc.commission_amount,
                         (rb.total_amount - IFNULL(hc.commission_amount, 0)) as net_amount,
                         rb.bookedDate as payment_date, rb.bookingStatus as status
                  FROM room_booking rb
                  LEFT JOIN hotel_guests hg ON rb.roomBooking_Id = hg.room_booking_Id
                  LEFT JOIN hotel_commissions hc ON rb.roomBooking_Id = hc.room_booking_Id
                  WHERE rb.hotel_Id = :hotel_id
                  AND rb.bookedDate BETWEEN :start_date AND :end_date
                  ORDER BY rb.bookedDate DESC";
        
        return $this->bookingsModel->query($query, [
            ':hotel_id' => $hotel_id,
            ':start_date' => $start_date,
            ':end_date' => $end_date . ' 23:59:59'
        ]);
    }
}