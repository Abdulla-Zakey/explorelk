<?php

class LeaveReviewForAccommodationBooking extends Controller
{
    private $roomBookingFinalModel;
    private $hotelModel;
    private $hotelPicsModel;
    private $hotelRoomTypesModel;
    private $commonRoomTypesModel;

    private $hotelReviewsModel;
    
    public function __construct()
    {
        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();
        $this->hotelPicsModel = new HotelPicsModel();
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->commonRoomTypesModel = new CommonRoomTypesModel();
        $this->hotelReviewsModel = new HotelReviewsModel();
    }

    public function index($roomBookingId)
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $existingReview = $this->checkExistingReviewForBooking($roomBookingId);

        if($existingReview){
            header("Location: " . ROOT . "/traveler/MyBookings?error=existing_review_found_for_the_booking");
            exit();
        }

        $booking = $this->roomBookingFinalModel->getRoomBookingByBookingId($roomBookingId);
        $hotel = $this->hotelModel->getDetailsByHotelId($booking->hotel_Id);
        $hotelPics = $this->hotelPicsModel->getImagesByHotelId($booking->hotel_Id);

        $hotel->thumbnail_picPath = $hotelPics[0]->image_path;

        $bookedRoomTypeDetails = $this->hotelRoomTypesModel->getHotelRoomTypeDetailsById($booking->hotel_roomType_Id);
        
        $genericRoomTypeDetails = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($bookedRoomTypeDetails->roomType_Id);
        $roomTypeName = $genericRoomTypeDetails->roomType_name;

        $bookedRoomTypeDetails->roomTypeName = $roomTypeName;

        $data['bookingData'] = $booking;
        $data['hotelData'] = $hotel;
        $data['bookedRoomTypeDetails'] = $bookedRoomTypeDetails;
        
        $this->view('traveler/leaveReviewForAccommodationBooking', $data);
    }

    private function checkExistingReviewForBooking($roomBookingId){
        $result = $this->hotelReviewsModel->first(['room_booking_Id' => $roomBookingId]);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    public function submitReview(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // echo '<pre>';
            // print_r($_POST);
            
            $data = [
                'hotel_Id' => $_POST['hotel_Id'],
                'traveler_Id' => $_SESSION['traveler_id'],
                'room_booking_Id' => $_POST['room_booking_Id'],
                'rating' => $_POST['overall_rating'],
                'review_text' => $_POST['review_text']
            ];

            // print_r($data);
            // echo'</pre>';
            // exit();

            $result = $this->hotelReviewsModel->insert($data);
            if($result){
                header("Location: " . ROOT . "/traveler/MyBookings?success=review_submitted_successfully");
            }
            else{
                header("Location: " . ROOT . "/traveler/MyBookings?error=review_submition_failed");
            }
        }
    }

}