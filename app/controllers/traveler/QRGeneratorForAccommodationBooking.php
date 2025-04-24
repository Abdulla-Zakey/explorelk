<?php

include '../app/views/traveler/vendor_qr/endroid/qr-code/TicketQRGenerator.php';
class QRGeneratorForAccommodationBooking extends Controller
{
    private $roomBookingFinalModel;
    private $hotelModel;
    private $hotelRoomTypesModel;
    private $commonRoomTypesModel;
    private $hotelGuestModel;
    private $notificationsModel;
    private $accommodationBookingNotificationsModel;

    public function __construct()
    {

        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->commonRoomTypesModel = new CommonRoomTypesModel();
        $this->hotelGuestModel = new HotelGuestsModel();
        $this->notificationsModel = new NotificationsModel();
        $this->accommodationBookingNotificationsModel = new AccommodationBookingNotifications();
    }

    public function index()
    {
        // Get the session ID from URL parameters
        $stripeSessionId = isset($_GET['session_id']) ? $_GET['session_id'] : null;

        if (!$stripeSessionId) {
            $this->showError(
                'Your payment was processed, but we encountered an issue generating your booking details. Please contact our support team with your Stripe payment reference.',
                null,
                true
            );
            return;
        }

        if (!isset($_SESSION['checkout_data'])) {
            $this->showError(
                'Your payment was processed, but we lost some session data needed to generate your booking confirmation. Please contact our support team with your Stripe payment reference: ' . $stripeSessionId,
                null,
                true
            );
            return;
        }

        try {
            // Get data from session
            $checkoutData = $_SESSION['checkout_data'];

            $bookingDetails = $checkoutData['bookingData'];
            $hotelDetails = $checkoutData['hotelData'];
            $bookedRoomTypeDetails = $checkoutData['bookedRoomTypeDetails'];
            $guestData = $checkoutData['guestData'];

            // Create ticket data array for QR code
            $ticketData = [
                'booking_id' => $bookingDetails->room_booking_Id,
                'requested_date' => $bookingDetails->requested_date,
                'check_in' => $bookingDetails->check_in,
                'check_out' => $bookingDetails->check_out,
                'total_nights' => (strtotime($bookingDetails->check_out) - strtotime($bookingDetails->check_in)) / (60 * 60 * 24),
                'total_rooms' => $bookingDetails->total_rooms,
                'advance_payment_amount' => $bookingDetails->advance_payment_amount,
                'advance_payment_paid_date' => date('Y-m-d H:i:s'),
                'special_request' => $bookingDetails->special_requests,

                'hotel_name' => $hotelDetails->hotelName,
                'hotel_address' => $hotelDetails->hotelAddress,

                'room_type_name' => $bookedRoomTypeDetails->roomTypeName,
                'max_occupancy' => $bookedRoomTypeDetails->max_occupancy,
                'price_per_night' => $bookedRoomTypeDetails->pricePer_night,

                'guest_name' => $guestData->guest_full_name,
                'guest_nic' => $guestData->guest_nic,
                'guest_email' => $guestData->guest_email,
                'guest_mobile_num' => $guestData->guest_mobile_num,

            ];

            // Generate QR code
            $qrGenerator = new TicketQRGenerator();
            $filename = 'generated_tickets/' . $ticketData['booking_id'] . '_ticket.png';

            // Ensure directory exists
            if (!file_exists('generated_tickets')) {
                if (!mkdir('generated_tickets', 0777, true)) {
                    throw new Exception('Failed to create directory for QR codes.');
                }
            }

            // Generate QR code
            $qrImage = $qrGenerator->generateTicketQR($ticketData, $filename);

            if (!file_exists($qrImage)) {
                throw new Exception('Failed to generate QR code image.');
            }

            $updateData = [
                'paid_advance_payment_amount' => $bookingDetails->advance_payment_amount,
                'advance_payment_paid_date' => date('Y-m-d H:i:s'),
                'path_to_payment_confirmation_QR' => $qrImage,
                'booking_status' => 'Confirmed',
                'advance_payment_status' => 'Paid'
            ];

            $result = $this->roomBookingFinalModel->update($bookingDetails->room_booking_Id, $updateData, 'room_booking_Id');

            if($result){
                $notificationData = [
                    'recipient_type' => 'traveler',
                    'recipient_Id' => $_SESSION['traveler_id'],
                    'notification_type' => 'accommodation_related',
                    'notification_title' => 'Advance Payment Received for ' . $hotelDetails->hotelName,
                    'notification_text' => 'We have received your advance payment for ' . $hotelDetails->hotelName . '. Your booking is now confirmed. Get ready for a memorable stay!'            
                ];

                $notificationId = $this->notificationsModel->insert($notificationData);

                if($notificationId){
                    $accommodationBookingNotificationData = [
                        'notification_Id' => $notificationId,
                        'room_booking_Id' => $bookingDetails->room_booking_Id
                    ];

                    $result = $this->accommodationBookingNotificationsModel->insert($accommodationBookingNotificationData);

                    if(!$result){
                        throw new Exception('Payment received, but failed to generate accommodationBookingNotification record');
                    }
                }
                else{
                    throw new Exception('Payment received, but we could not notify you due to a system issue. Please check your booking details or contact support.');
                }

            }

            if (!$result) {
                throw new Exception('Your payment was successful, but we encountered an issue while updating your booking status. Please contact our support team for assistance.');

            }

            // Pass data to view
            $viewData = [
                'bookingData' => $bookingDetails,
                'hotelData' => $hotelDetails,
                'bookedRoomTypeDetails' => $bookedRoomTypeDetails,
                'guestData' => $guestData,
                'qr_image' => $qrImage,
                'success' => true
            ];

            // Clear sensitive session data after successful generation
            unset($_SESSION['checkout_data']);

            $this->view('traveler/accommodationBookingAdvancePaymentTicket', $viewData);


        } catch (Exception $e) {
            error_log('QR Generation error: ' . $e->getMessage());

            // Show error view
            $this->view('traveler/accommodationBookingAdvancePaymentTicket', [
                'success' => false,
                'message' => $e->getMessage(),
                'booking_reference' => $bookingDetails->room_booking_Id ?? 'Unknown'
            ]);
        }
    }

    /**
     * Helper method to show an error for payment-related issues
     */
    private function showError($message, $redirectPath = null, $isPaymentRelated = false)
    {
        $viewData = [
            'success' => false,
            'message' => $message
        ];

        // If payment related, include payment reference if available
        if ($isPaymentRelated && isset($_GET['session_id'])) {
            $viewData['payment_reference'] = $_GET['session_id'];
        }

        $this->view('traveler/accommodationBookingAdvancePaymentTicket', $viewData);

        if ($redirectPath) {
            // Add JavaScript for delayed redirect
            echo "<script>
            setTimeout(function() {
                window.location.href = '" . ROOT . "/" . $redirectPath . "';
            }, 10000);
        </script>";
        }
    }

}