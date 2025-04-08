<?php

class MyBookings extends Controller{

    private $roomBookingFinalModel;
    private $hotelModel;
    private $hotelPicsModel;

    public function __construct(){
        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();
        $this->hotelPicsModel = new HotelPicsModel();
    }

    public function index(){

        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $bookings = $this->roomBookingFinalModel->getRoomBookingByTravelerId($_SESSION['traveler_id']);
        $data['accommodationBookingsData'] = [];

        foreach($bookings as $booking){
            
            $hotelInfo = $this->hotelModel->getDetailsByHotelId($booking->hotel_Id);
            $hotelPics = $this->hotelPicsModel->getImagesByHotelId($booking->hotel_Id);
            $hotelPic = $hotelPics[0]->image_path;
            
            // Create a complete booking record with all related data
            $bookingData = $booking;
            $bookingData->hotelInfo = $hotelInfo;
            $bookingData->hotelPic = $hotelPic;
            
            // Add this complete booking to our data array
            $data['accommodationBookingsData'][] = $bookingData;
        }

        $this->view('traveler/myBookings', $data);
    }

    public function deleteAccommodationBooking($bookingId){
        $booking = $this->roomBookingFinalModel->first(['room_booking_Id' => $bookingId]);
        if ($booking) {
            if($booking->traveler_Id == $_SESSION['traveler_id']) {

                $result = $this->roomBookingFinalModel->delete($bookingId, 'room_booking_Id');

                if($result){
                    redirect('traveler/MyBookings?success=booking_request_deleted&booking_id=' . $bookingId);
                }
                else{
                    redirect('traveler/MyBookings?error=booking_request_deletion_failed&booking_id=' . $bookingId);
                }
            }
            else{
                redirect('traveler/MyBookings?error=booking_request_does_not_belongs_to_the_current_user&booking_id=' . $bookingId);
            }
        }
        else{
            redirect('traveler/MyBookings?error=booking_request_not_found&booking_id=' . $bookingId);
        }
    }
}