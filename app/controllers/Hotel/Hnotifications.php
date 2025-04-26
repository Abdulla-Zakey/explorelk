<?php

class Hnotifications extends Controller {

    private $hotelModel;
    private $roomBookingsFinalModel;
    private $hotelGuestsModel;
    private $hotelRoomTypesModel;
    private $commonRoomTypesModel;

    public function __construct() {
        $this->hotelModel = new Hotel();
        $this->roomBookingsFinalModel = new RoomBookingsFinalModel();
        $this->hotelGuestsModel = new HotelGuestsModel();
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->commonRoomTypesModel = new CommonRoomTypesModel();
    }

    public function index($a = '', $b = '', $c = '') {
        if (!isset($_SESSION['hotel_id'])) {
            // Redirect to login or handle unauthorized access
            redirect('traveler/Login');
            exit;
        }

        $data = [];
        
        try {
            // Fetch hotel basic data
            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
            
            if (!$data['hotelBasic']) {
                throw new Exception("Hotel information not found");
            }

            // Set default sorting
            $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
            $statusFilter = isset($_GET['status']) ? $_GET['status'] : 'all';
            
            // Build the query with optional filters
            $query = "
                SELECT 
                    rbf.room_booking_Id,
                    rbf.hotel_roomType_Id,
                    rbf.check_in,
                    rbf.check_out,
                    rbf.total_rooms,
                    rbf.special_requests,
                    rbf.total_amount,
                    rbf.advance_payment_amount,
                    rbf.advance_payment_status,
                    rbf.advance_payment_deadline,
                    rbf.booking_status,
                    rbf.requested_date,
                    hg.guest_full_name,
                    hg.guest_nic,
                    hg.guest_email,
                    hg.guest_mobile_num,
                    crt.roomType_name
                FROM 
                    room_bookings_final rbf
                LEFT JOIN 
                    hotel_guests hg ON rbf.room_booking_Id = hg.room_booking_Id
                LEFT JOIN 
                    hotel_room_types hrt ON rbf.hotel_roomType_Id = hrt.hotel_roomType_Id
                LEFT JOIN 
                    common_room_types crt ON hrt.roomType_Id = crt.roomType_Id
                WHERE 
                    rbf.hotel_Id = :hotel_Id
            ";
            
            // Add status filter if specified
            if ($statusFilter !== 'all') {
                $query .= " AND rbf.booking_status = :status";
            }
            
            // Add sorting
            if ($sortBy === 'newest') {
                $query .= " ORDER BY rbf.requested_date DESC";
            } elseif ($sortBy === 'oldest') {
                $query .= " ORDER BY rbf.requested_date ASC";
            } elseif ($sortBy === 'check-in') {
                $query .= " ORDER BY rbf.check_in ASC";
            }
            
            $query .= " LIMIT 50";
            
            $params = [':hotel_Id' => $_SESSION['hotel_id']];
            
            if ($statusFilter !== 'all') {
                $params[':status'] = $statusFilter;
            }
            
            $data['bookings'] = $this->roomBookingsFinalModel->query($query, $params);
            $data['currentSort'] = $sortBy;
            $data['currentStatus'] = $statusFilter;
            
        } catch (Exception $e) {
            // Log the error
            error_log("Error in Hnotifications::index: " . $e->getMessage());
            $data['error'] = "An error occurred while fetching booking notifications. Please try again later.";
            $data['bookings'] = [];
        }

        $this->view('hotel/notifications', $data);
    }
}