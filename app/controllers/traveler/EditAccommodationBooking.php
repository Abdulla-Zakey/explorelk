<?php
class EditAccommodationBooking extends Controller
{
    private $roomBookingFinalModel;
    private $hotelModel;
    private $hotelRoomTypesModel;

    private $commonRoomTypesModel;

    private $hotelGuestModel;

    public function __construct()
    {
        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->commonRoomTypesModel = new CommonRoomTypesModel();
        $this->hotelGuestModel = new HotelGuestsModel();
    }
    public function index($roomBookingId)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $bokingData = [
                'check_in' => $_POST['check_in'],
                'check_out' => $_POST['check_out'],
                'total_rooms' => $_POST['total_rooms'],
                'special_requests' => $_POST['special_requests'],
                'total_amount' => $_POST['total_amount'],
                'advance_payment_amount' => $_POST['advance_payment_amount']

            ];

            $guestData = [
                'guest_full_name' => $_POST['guest_full_name'],
                'guest_nic' => $_POST['guest_nic'],
                'guest_email' => $_POST['guest_email'],
                'guest_mobile_num' => $_POST['guest_mobile_num']
            ];

            $result = $this->roomBookingFinalModel->update($roomBookingId, $bokingData, 'room_booking_Id');
            
            if ($result) {
                $result = $this->hotelGuestModel->update($roomBookingId, $guestData, 'room_booking_Id');
                if ($result) {
                    header("Location: " . ROOT . "/traveler/MyBookings?success=Accommodation_Booking_Updated_Successfully!&bookingId=" . $roomBookingId);
                    exit();
                }
                else{
                    header("Location: " . ROOT . "/traveler/MyBookings?success=Failed_to_Update_guest_details!&bookingId=" . $roomBookingId);
                    exit();
                }
                
            }
            else{
                header("Location: " . ROOT . "/traveler/MyBookings?error=Accommodation_Booking_Updation_Failed!&bookingId=" . $roomBookingId);
                exit();
            }
        } 
        else {
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
            $this->view('traveler/editAccommodationBooking', $data);
        }
    }

}