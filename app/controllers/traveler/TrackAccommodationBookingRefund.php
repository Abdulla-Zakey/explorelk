<?php 

    class TrackAccommodationBookingRefund extends Controller{

        private $roomBookingFinalModel;
        private $hotelModel;
        private $hotelRoomTypesModel;
        private $commonRoomTypesModel;
        private $roomBookingCancellationModel;
        private $roomBookingRefundBankDetailsModel;
        private $roomBookingRefundsModel;
    
        public function __construct()
        {
            $this->roomBookingFinalModel = new RoomBookingsFinalModel();
            $this->hotelModel = new Hotel();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->commonRoomTypesModel = new CommonRoomTypesModel();
            $this->roomBookingCancellationModel = new RoomBookingCancellationsModel();
            $this->roomBookingRefundBankDetailsModel = new RoomBookingRefundBankDetails();
            $this->roomBookingRefundsModel = new RoomBookingRefundsModel();
        }

    
        public function index($roomBookingId){

             // Check if user is logged in
            if (!isset($_SESSION['traveler_id'])) {
                header("Location: " . ROOT . "/traveler/Login");
                exit();
            }

            // Verify that the booking belongs to the logged-in traveler
            $booking = $this->roomBookingFinalModel->getRoomBookingByBookingId($roomBookingId);

            if (!$booking) {
                header("Location: " . ROOT . "/traveler/MyBookings?error=there_is_no_booking_exist_with_the_booking_id");
                exit();
            }

            if ($booking->traveler_Id != $_SESSION['traveler_id']) {
                header("Location: " . ROOT . "/traveler/MyBookings?error=unauthorized_access");
                exit();
            }

            $hotel = $this->hotelModel->getDetailsByHotelId($booking->hotel_Id);

            $bookedRoomTypeDetails = $this->hotelRoomTypesModel->getHotelRoomTypeDetailsById($booking->hotel_roomType_Id);

            $genericRoomTypeDetails = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($bookedRoomTypeDetails->roomType_Id);
            
            $roomTypeName = $genericRoomTypeDetails->roomType_name;

            $bookedRoomTypeDetails->roomTypeName = $roomTypeName;

            $refundBankAccountDetails = $this->roomBookingRefundBankDetailsModel->first(['traveler_Id' => $_SESSION['traveler_id']]);

            $bookingcancellationDetails = $this->roomBookingCancellationModel->first(['room_booking_Id' => $roomBookingId]);
            
            $refundDetails = $this->roomBookingRefundsModel->first(['cancellation_Id' => $bookingcancellationDetails->cancellation_Id]);

            $data['bookingData'] = $booking;
            $data['hotelData'] = $hotel;
            $data['bookedRoomTypeDetails'] = $bookedRoomTypeDetails;
            $data['refundBankAccountDetails'] = $refundBankAccountDetails;
            $data['bookingcancellationDetails'] = $bookingcancellationDetails;
            $data['refundDetails'] = $refundDetails;

            $this->view('traveler/trackAccommodationBookingRefund', $data);
        }
    }