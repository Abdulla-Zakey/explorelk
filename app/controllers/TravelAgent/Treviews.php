<?php

class Treviews extends Controller
{
    private $reviewsModel;
    private $TravelAgentModel;

    public function __construct()
    {
        $this->reviewsModel = $this->loadModel('TravelAgentReviewModel');
        $this->TravelAgentModel = $this->loadModel('travelprovider');
    }

    public function index($a = '', $b = '', $c = '')
    {
        // Get hotel ID from session
        $travelAgent_Id = isset($_SESSION['travelAgent_Id']) ? (int)$_SESSION['travelAgent_Id'] : 0;

        // Initialize data array
        $data = [
            'reviews' => [],
            'errors' => [],
            'average_rating' => 0,
            'total_reviews' => 0,
            'hotelBasic' => null
        ];

        // Validate hotel ID
        if ($travelAgent_Id <= 0) {
            $data['errors']['travelAgent_Id'] = 'Invalid hotel ID. Please log in again.';
            error_log("Treviews::index - Invalid hotel ID: $travelAgent_Id");
            $this->view('travelagent/reviews', $data);
            return;
        }

        // Fetch hotel basic details
        try {
            $data['hotelBasic'] = $this->TravelAgentModel->first(['id' => $travelAgent_Id]);
            if (!$data['hotelBasic']) {
                $data['errors']['hotel_id'] = 'Hotel not found for the given ID.';
                error_log("Treviews::index - Hotel not found for ID: $travelAgent_Id");
            }
        } catch (Exception $e) {
            $data['errors']['db'] = 'An error occurred while fetching hotel details. Please try again later.';
            error_log('Treviews::index - Error fetching hotel details: ' . $e->getMessage());
        }

        // Fetch reviews and stats if no hotel ID error
        if (empty($data['errors']['hotel_id'])) {
            try {
                $data['reviews'] = $this->reviewsModel->getReviewsByHotelId($travelAgent_Id);
                $stats = $this->reviewsModel->getReviewStats($travelAgent_Id);
                $data['average_rating'] = $stats['average_rating'];
                $data['total_reviews'] = $stats['total_reviews'];
            } catch (Exception $e) {
                $data['errors']['db'] = 'An error occurred while fetching reviews. Please try again later.';
                error_log('Treviews::index - Error fetching reviews: ' . $e->getMessage());
            }
        }

        // Log final data for debugging
        error_log("Treviews::index - Data sent to view: " . json_encode($data));

        $this->view('travelagent/reviews', $data);
    }
}