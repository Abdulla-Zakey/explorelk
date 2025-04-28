<?php
class Hreviews extends Controller {
    private $reviewsModel;
    private $hotelModel;

    public function __construct() {
        $this->reviewsModel = new HotelReviewsModel();
        $this->hotelModel = new Hotel();
    }

    public function index() {
        // Get hotel ID from session
        $hotelId = isset($_SESSION['hotel_id']) ? (int)$_SESSION['hotel_id'] : 0;

        if (!isset($_SESSION['hotel_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Initialize data array
        $data = [
            'reviews' => [],
            'errors' => [],
            'average_rating' => 0,
            'total_reviews' => 0,
            'hotelBasic' => null
        ];

        // Validate hotel ID
        if ($hotelId <= 0) {
            $data['errors']['hotel_id'] = 'Invalid hotel ID. Please log in again.';
            error_log("Hreviews::index - Invalid hotel ID: $hotelId");
            $this->view('hotel/reviews', $data);
            return;
        }

        // Fetch hotel basic details
        try {
            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $hotelId]);
            if (!$data['hotelBasic']) {
                $data['errors']['hotel_id'] = 'Hotel not found for the given ID.';
                error_log("Hreviews::index - Hotel not found for ID: $hotelId");
            }
        } catch (Exception $e) {
            $data['errors']['db'] = 'An error occurred while fetching hotel details. Please try again later.';
            error_log('Hreviews::index - Error fetching hotel details: ' . $e->getMessage());
        }

        // Fetch reviews and stats if no hotel ID error
        if (empty($data['errors']['hotel_id'])) {
            try {
                $data['reviews'] = $this->reviewsModel->getReviewsByHotelId($hotelId);
                $stats = $this->reviewsModel->getReviewStats($hotelId);
                $data['average_rating'] = $stats['average_rating'];
                $data['total_reviews'] = $stats['total_reviews'];
            } catch (Exception $e) {
                $data['errors']['db'] = 'An error occurred while fetching reviews. Please try again later.';
                error_log('Hreviews::index - Error fetching reviews: ' . $e->getMessage());
            }
        }

        // Log final data for debugging
        error_log("Hreviews::index - Data sent to view: " . json_encode($data));

        $this->view('hotel/reviews', $data);
    }
}