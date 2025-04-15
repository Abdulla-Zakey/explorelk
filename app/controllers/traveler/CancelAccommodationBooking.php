<?php

class CancelAccommodationBooking extends Controller
{
    private $roomBookingFinalModel;
    private $hotelModel;
    private $hotelRoomTypesModel;
    private $commonRoomTypesModel;
    private $hotelGuestModel;

    private $roomBookingRefundBankDetailsModel;
    private $travelerBankAccountModel;

    private $roomBookingCancellationModel;

    public function __construct()
    {
        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->commonRoomTypesModel = new CommonRoomTypesModel();
        $this->hotelGuestModel = new HotelGuestsModel();
        $this->travelerBankAccountModel = new TravelerBankAccount();
        $this->roomBookingRefundBankDetailsModel = new RoomBookingRefundBankDetails();
        $this->roomBookingCancellationModel = new RoomBookingCancellationsModel();
    }

    public function index($roomBookingId)
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Verify that the booking belongs to the logged-in traveler
        $booking = $this->roomBookingFinalModel->getRoomBookingByBookingId($roomBookingId);
        if (!$booking || $booking->traveler_Id != $_SESSION['traveler_id']) {
            header("Location: " . ROOT . "/traveler/MyBookings?error=unauthorized_access");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validate required fields

            if($_POST['refundAmount'] > 0){
                
                $requiredFields = ['bankAccountNumber', 'bankAccountHolderName', 'bankName', 'bankBranch', 'cancellationReason', 'refundAmount'];
                
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || empty($_POST[$field])) {
                        header("Location: " . ROOT . "/traveler/CancelAccommodationBooking/index/" . $roomBookingId . "?error=missing_required_fields");
                        exit();
                    }
                }

                $refundBankData = [
                    'traveler_Id' => $_SESSION['traveler_id'],
                    'account_number' => $_POST['bankAccountNumber'],
                    'account_holder_name' => $_POST['bankAccountHolderName'],
                    'bank_name' => $_POST['bankName'],
                    'bank_branch' => $_POST['bankBranch']
                ];

                $existingBankAccountData = $this->roomBookingRefundBankDetailsModel->first([
                    'traveler_Id' => $_SESSION['traveler_id'], 
                    'account_number' => $_POST['bankAccountNumber']
                ]);

                if(!$existingBankAccountData){
                
                    $bankDetailsId = $this->roomBookingRefundBankDetailsModel->insert($refundBankData);
                
                    if(!$bankDetailsId){
                        header("Location: " . ROOT . "/traveler/CancelAccommodationBooking/" . $roomBookingId . "?error=failed_to_save_bank_details");
                        exit();
                    }
                }

            }
            
            $refundStatus = '';
            if($_POST['refundAmount'] > 0){
                $refundStatus = "Processing";
            }
            else{
                $refundStatus = "Not Eligible";
            }

            $cancellationData = [
                'room_booking_Id' => $roomBookingId,
                'cancellation_reason' => $_POST['cancellationReason'],
                'refund_amount' => $_POST['refundAmount'],
                'refund_status' => $refundStatus
            ];

            $cancellationId = $this->roomBookingCancellationModel->insert($cancellationData);

            if($cancellationId){
                $result = $this->roomBookingFinalModel->update($roomBookingId, ['booking_status' => 'Cancelled'], 'room_booking_Id');
                
                if($result){
                    header("Location: " . ROOT . "/traveler/MyBookings?success=booking_cancelled_successfully&refund_status=" . urlencode($refundStatus));
                    exit();
                }
                else{
                    header("Location: " . ROOT . "/traveler/CancelAccommodationBooking/index/" . $roomBookingId . "?error=failed_to_update_booking_status");
                    exit();
                }
            }
            else{
                header("Location: " . ROOT . "/traveler/CancelAccommodationBooking/index/" . $roomBookingId . "?error=failed_to_create_cancellation_record");
                exit();
            }
        } 
        else {
            $hotel = $this->hotelModel->getDetailsByHotelId($booking->hotel_Id);
            $bookedRoomTypeDetails = $this->hotelRoomTypesModel->getHotelRoomTypeDetailsById($booking->hotel_roomType_Id);
            $guestDetails = $this->hotelGuestModel->getGuestByBookingId($roomBookingId);

            $genericRoomTypeDetails = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($bookedRoomTypeDetails->roomType_Id);
            $roomTypeName = $genericRoomTypeDetails->roomType_name;

            $bookedRoomTypeDetails->roomTypeName = $roomTypeName;

            $travelerBankAccountDetails = $this->roomBookingRefundBankDetailsModel->first(['traveler_Id' => $_SESSION['traveler_id']]);

            if (!$travelerBankAccountDetails) {
                $travelerBankAccountDetails = $this->travelerBankAccountModel->first(['traveler_Id' => $_SESSION['traveler_id']]);
            }

            $data['bookingData'] = $booking;
            $data['hotelData'] = $hotel;
            $data['bookedRoomTypeDetails'] = $bookedRoomTypeDetails;
            $data['guestData'] = $guestDetails;
            $data['travelerBankAccountDetails'] = $travelerBankAccountDetails;

            $this->view('traveler/CancelAccommodationBooking', $data);
        }
    }
}