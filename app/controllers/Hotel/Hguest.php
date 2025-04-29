<?php

class Hguest extends Controller {

    private $hotelModel;
    private $guestModel;
    private $bookingModel;

    public function __construct() {
        $this->hotelModel = new Hotel();
        $this->guestModel = $this->loadModel('HotelGuestsModel');
        $this->bookingModel = $this->loadModel('RoomBookingsFinalModel');
    }

    public function index($a = '', $b = '', $c = '') {

        if (!isset($_SESSION['hotel_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        // Fetch hotel basic data
        $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
        // Explicitly pass hotel name
        $data['hotel_name'] = $data['hotelBasic']->hotel_name ?? 'Unknown Hotel';

        // First, get all guests
        $query = "
            SELECT 
                guest_Id,
                guest_full_name,
                guest_nic,
                guest_email,
                guest_mobile_num,
                room_booking_Id
            FROM 
                hotel_guests
        ";
        $guests = $this->guestModel->query($query);
        
        // Now, for each guest, fetch the booking details
        if (!empty($guests)) {
            foreach ($guests as $guest) {
                if (!empty($guest->room_booking_Id)) {
                    // Fetch booking details using the correct column names
                    $bookingQuery = "
                        SELECT 
                            room_booking_Id,
                            check_in,
                            check_out,
                            booking_status,
                            total_rooms,
                            total_amount
                        FROM 
                            room_bookings_final 
                        WHERE 
                            room_booking_Id = :booking_id
                    ";
                    $bookingParams = [':booking_id' => $guest->room_booking_Id];
                    
                    try {
                        $bookingDetails = $this->bookingModel->query($bookingQuery, $bookingParams);
                        
                        if (!empty($bookingDetails)) {
                            $bookingDetails = $bookingDetails[0]; // Get the first result
                            
                            // Add booking details to the guest object
                            $guest->check_in = $bookingDetails->check_in;
                            $guest->check_out = $bookingDetails->check_out;
                            $guest->booking_status = $bookingDetails->booking_status;
                            $guest->total_rooms = $bookingDetails->total_rooms;
                            $guest->total_amount = $bookingDetails->total_amount;
                        }
                    } catch (Exception $e) {
                        // If there's an error fetching booking details, just continue
                    }
                }
            }
        }
        
        $data['guests'] = $guests;
        $this->view('hotel/guest', $data);
    }
}