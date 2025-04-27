<?php


class Hdashboard extends Controller {
    private $hotelModel;
    private $roomsModel;
    private $hotelRoomTypesModel;
    private $travelerModel;
    private $hotelGuestsModel;
    private $bookedRoomsModel;
    private $hotelCommissionsModel;
    private $hotelReviewsModel;

    public function __construct() {
        try {
            // Initialize models by direct instantiation
            $this->hotelModel = new Hotel();
            $this->roomsModel = new Rooms();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->travelerModel = new Traveler();
            $this->hotelGuestsModel = new HotelGuestsModel();
            $this->bookedRoomsModel = new BookedRoomsModel();
            $this->hotelCommissionsModel = new HotelCommissionsModel();
            $this->hotelReviewsModel = new HotelReviewsModel();
        } catch (Exception $e) {
            // Handle model instantiation errors
            die('Error initializing models: ' . $e->getMessage());
        }
    }

    public function index() {

        if (!isset($_SESSION['hotel_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        // Assuming hotel_id is stored in session after login
        $hotelId = $_SESSION['hotel_id'] ?? 1; // Replace with actual session logic


        $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
        
        // Initialize default values
        $totalRooms = 0;
        $activeBookings = 0;
        $earnings = 0;
        $todayEarnings = 0;
        $recentBookings = [];
        $avgRating = '0.0/5';
        $recentReviews = [];

        try {
            // Fetch total rooms from Rooms model
            $hotelRoomTypes = $this->hotelRoomTypesModel->where(['hotel_Id' => $hotelId]);
            foreach($hotelRoomTypes as $hotelRoomType) {
                $totalRooms += $hotelRoomType->total_rooms;
            }

            // $rooms = $this->roomsModel->where(['hotel_Id' => $hotelId]);
            // $totalRooms = count($rooms);
        } catch (PDOException $e) {
            // Log error and continue with default value
            error_log('Database error (rooms): ' . $e->getMessage());
        }

        try {
            // Fetch active bookings (commissions applicable for commission)
            $activeBookingsResult = $this->hotelCommissionsModel->query(
                "SELECT * FROM hotel_commissions WHERE hotel_Id = ? AND is_applicable_for_commission = ?",
                [$hotelId, 1]
            );
            $activeBookings = count($activeBookingsResult);

            // Fetch total earnings (sum of total_amount)
            $earningsResult = $this->hotelCommissionsModel->query(
                "SELECT SUM(total_amount) as total_earnings FROM hotel_commissions WHERE hotel_Id = ?",
                [$hotelId]
            );
            $earnings = !empty($earningsResult) && isset($earningsResult[0]->total_earnings) ? $earningsResult[0]->total_earnings : 0;

            // Fetch today's earnings
            $todayEarningsResult = $this->hotelCommissionsModel->query(
                "SELECT SUM(total_amount) as today_earnings FROM hotel_commissions WHERE hotel_Id = ? AND DATE(created_at) = CURDATE()",
                [$hotelId]
            );
            $todayEarnings = !empty($todayEarningsResult) && isset($todayEarningsResult[0]->today_earnings) ? $todayEarningsResult[0]->today_earnings : 0;

            // Fetch recent bookings with traveler name
            $recentBookings = $this->hotelCommissionsModel->query(
                "SELECT hc.commission_Id, hc.created_at, CONCAT(t.fName, ' ', t.lName) as traveler_name 
                 FROM hotel_commissions hc 
                 JOIN room_bookings rb ON hc.room_booking_Id = rb.booking_id 
                 JOIN traveler t ON rb.traveler_Id = t.traveler_Id 
                 WHERE hc.hotel_Id = ? 
                 ORDER BY hc.created_at DESC 
                 LIMIT 2",
                [$hotelId]
            );
        } catch (PDOException $e) {
            // Log error and continue with default values
            error_log('Database error (hotel_commissions): ' . $e->getMessage());
        }

        try {
            // Fetch average rating from reviews
            $ratingResult = $this->hotelReviewsModel->query(
                "SELECT AVG(rating) as avg_rating FROM hotel_reviews WHERE hotel_Id = ?",
                [$hotelId]
            );
            $avgRating = !empty($ratingResult) && isset($ratingResult[0]->avg_rating) && $ratingResult[0]->avg_rating ? number_format($ratingResult[0]->avg_rating, 1) . '/5' : '0.0/5';

            // Fetch recent reviews with reviewer name and profile picture
            $recentReviews = $this->hotelReviewsModel->query(
                "SELECT hr.*, CONCAT(t.fName, ' ', t.lName) as reviewer_name, t.profilePicture 
                 FROM hotel_reviews hr 
                 JOIN traveler t ON hr.traveler_Id = t.traveler_Id 
                 WHERE hr.hotel_Id = ? 
                 ORDER BY hr.created_at DESC 
                 LIMIT 2",
                [$hotelId]
            );
        } catch (PDOException $e) {
            // Log error and continue with default values
            error_log('Database error (hotel_reviews): ' . $e->getMessage());
        }

        // Prepare data for the view
        $data = [
            'totalRooms' => $totalRooms,
            'activeBookings' => $activeBookings,
            'earnings' => number_format($earnings, 2),
            'todayEarnings' => number_format($todayEarnings, 2),
            'avgRating' => $avgRating,
            'recentBookings' => $recentBookings,
            'recentReviews' => $recentReviews,
            'hotelBasic'=> $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]),
        ];

        // Load the view with data
        $this->view('hotel/dashboard', $data);
    }
}