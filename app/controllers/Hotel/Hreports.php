<?php

class Hreports extends Controller {
    protected $complaintsModel;
    protected $hotelId;

    public function __construct() {
        $this->complaintsModel = new HotelComplaints();
        $this->hotelId = isset($_SESSION['hotel_id']) ? $_SESSION['hotel_id'] : null;
    }

    public function index() {
        if (!$this->hotelId) {
            error_log("HotelReportsController::index - No hotel_id in session");
            redirect('login');
        }

        $data = [
            'title' => 'Hotel Complaints',
            'hotel_id' => $this->hotelId,
            'complaints' => $this->complaintsModel->selectAllByHotel($this->hotelId),
            'errors' => [],
            'subject' => '',
            'booking_id' => '',
            'description' => ''
        ];

        error_log("HotelReportsController::index - Loaded complaints: " . count($data['complaints']));
        $this->view('hotel/reports', $data);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("HotelReportsController::create - Invalid request method");
            redirect('hotel/reports');
        }
    
        if (!$this->hotelId) {
            error_log("HotelReportsController::create - No hotel_id in session");
            redirect('login');
        }
    
        $data = [
            'hotel_Id' => $this->hotelId,
            'subject' => $_POST['subject'],
            'message' => $_POST['description'],
            'booking_id' => $_POST['booking_id'] ?? '',
        ];
    
        // Log received form data    
        $this->complaintsModel->insert($data);

        redirect('hotel/Hreports');
    
        // if ($response['status'] === 'success') {
        //     flash('complaint_success', 'Complaint submitted successfully');
        //     redirect('hotel/reports');
        // } else {
        //     $data = array_merge([
        //         'title' => 'Hotel Complaints',
        //         'hotel_id' => $this->hotelId,
        //         'complaints' => $this->complaintsModel->selectAllByHotel($this->hotelId),
        //         'errors' => $response['errors'] ?? [],
        //         'subject' => $data['subject'],
        //         'booking_id' => $data['booking_id'],
        //         'description' => $data['message']
        //     ], $response);
        //     error_log("HotelReportsController::create - Error: " . json_encode($response));
        //     $this->view('hotel/reports', $data);
        // }
    }
}