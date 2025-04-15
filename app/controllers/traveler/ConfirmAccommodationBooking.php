<?php

    class ConfirmAccommodationBooking extends Controller{

        private $roomBookingFinalModel;
        private $hotelModel;
        private $hotelRoomTypesModel;
        private $commonRoomTypesModel;
        private $hotelGuestModel;

        public function __construct(){
            $this->roomBookingFinalModel = new RoomBookingsFinalModel();
            $this->hotelModel = new Hotel();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->commonRoomTypesModel = new CommonRoomTypesModel();
            $this->hotelGuestModel = new HotelGuestsModel();
        }
        public function index($roomBookingId){
        
            $booking = $this->roomBookingFinalModel->getRoomBookingByBookingId($roomBookingId);
            $hotel = $this->hotelModel->getDetailsByHotelId($booking->hotel_Id);
            $bookedRoomTypeDetails = $this->hotelRoomTypesModel->getHotelRoomTypeDetailsById($booking->hotel_roomType_Id);
            $guestDetails = $this->hotelGuestModel->getGuestByBookingId($roomBookingId);

            $genericRoomTypeDetails = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($bookedRoomTypeDetails->roomType_Id);
            $roomTypeName = $genericRoomTypeDetails->roomType_name;

            $bookedRoomTypeDetails->roomTypeName = $roomTypeName;

            $data['bookingData'] = $booking;
            $data['hotelData'] = $hotel;
            $data['bookedRoomTypeDetails'] = $bookedRoomTypeDetails;
            $data['guestData'] = $guestDetails;
            $this->view('traveler/confirmAccommodationBooking', $data);
        
        }
    }