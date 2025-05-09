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
    private $hotelCommissionsModel;
    private $notificationsModel;
    private $accommodationBookingNotificationsModel;

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
        $this->hotelCommissionsModel = new HotelCommissionsModel();
        $this->notificationsModel = new NotificationsModel();
        $this->accommodationBookingNotificationsModel = new AccommodationBookingNotifications();
    }

    public function index($roomBookingId)
    {
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $booking = $this->roomBookingFinalModel->getRoomBookingByBookingId($roomBookingId);
        if (!$booking || $booking->traveler_Id != $_SESSION['traveler_id']) {
            header("Location: " . ROOT . "/traveler/MyBookings?error=unauthorized_access");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
                    'traveler_accountNum' => $_POST['bankAccountNumber'],
                    'account_holder_name' => $_POST['bankAccountHolderName'],
                    'traveler_bankName' => $_POST['bankName'],
                    'traveler_bankBranch' => $_POST['bankBranch']
                ];

                $existingRefundBankAccountData = $this->roomBookingRefundBankDetailsModel->first([
                    'traveler_Id' => $_SESSION['traveler_id'], 
                    'traveler_accountNum' => $_POST['bankAccountNumber']
                ]);

                if(!$existingRefundBankAccountData){
                
                    $bankDetailsId = $this->roomBookingRefundBankDetailsModel->insert($refundBankData);
                
                    if(!$existingRefundBankAccountData && !$bankDetailsId){
                        header("Location: " . ROOT . "/traveler/CancelAccommodationBooking/index/" . $roomBookingId . "?error=failed_to_save_bank_details");
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
                    $result  = $this->hotelCommissionsModel->update(
                                                                    $roomBookingId, 
                                                                    ['is_applicable_for_commission' => 0, 'if_not_applicable_reason' => 'Cancelled by traveler'], 
                                                                    'room_booking_Id'
                                                                );
                    if($result){

                        $hotelData = $this->hotelModel->first(['hotel_Id' => $booking->hotel_Id]);
                        
                        $notificationData = [
                            'recipient_type' => 'traveler',
                            'recipient_Id' => $_SESSION['traveler_id'],
                            'notification_type' => 'accommodation_related',
                            'notification_title' => 'Booking Canceled for ' . $hotelData->hotelName,
                            'notification_text' => 'Your booking at ' . $hotelData->hotelName . ' has been successfully canceled. If eligible, you can track your refund status in the "My Bookings" section.'
                        ];

                        $notificationId = $this->notificationsModel->insert($notificationData);

                        if($notificationId){
                            $accommodationBookingNotificationData = [
                                'notification_Id' => $notificationId,
                                'room_booking_Id' => $roomBookingId
                            ];

                            $result = $this->accommodationBookingNotificationsModel->insert($accommodationBookingNotificationData);

                            if($result){
                                header("Location: " . ROOT . "/traveler/MyBookings?success=booking_cancelled_successfully&refund_status=" . urlencode($refundStatus));
                                exit();
                            }
                            else{
                                header("Location: " . ROOT . "/traveler/MyBookings?error=booking_cancelled_successfully_but_failed_to_generate_accommodation_notification&refund_status=" . urlencode($refundStatus));
                                exit();
                            }
                        }
                        else{
                            header("Location: " . ROOT . "/traveler/MyBookings?error=booking_cancelled_successfully_but_failed_to_generate_notification&refund_status=" . urlencode($refundStatus));
                            exit();
                        }
                        
                    }
                    else{
                        header("Location: " . ROOT . "/traveler/MyBookings?error=booking_cancelled_successfully_failed_to_update_commission_status&refund_status=" . urlencode($refundStatus));
                        exit();
                    }
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