<?php
include '../app/views/traveler/vendor_qr/endroid/qr-code/TicketQRGenerator.php';
// QRGenerator Controller
class QRGenerator extends Controller {

    private $eventModel;
    private $eventBookingModel;
    private $SoldEventTicketsModel;
    private $EventTicketTypeModel;
    private $notificationsModel;
    private $eventBookingNotificationsModel;
    private $eventTicketPurchasersModel;
    private $eventBookingCommissionModel;


    public function __construct() {
        // Initialize the model in the constructor
        $this->eventModel = new Event();
        $this->eventBookingModel = new EventBookingModel();
        $this->SoldEventTicketsModel = new SoldEventTicketsModel();
        $this->EventTicketTypeModel = new EventTicketType();
        $this->notificationsModel = new NotificationsModel();
        $this->eventBookingNotificationsModel = new EventBookingNotificationModel();
        $this->eventTicketPurchasersModel = new EventTicketPurchasersModel();
        $this->eventBookingCommissionModel = new EventBookingCommissionModel;
    }

    public function index() {
        // Get the session ID from URL parameters
        $stripeSessionId = isset($_GET['session_id']) ? $_GET['session_id'] : null;
        
        if (!$stripeSessionId || !isset($_SESSION['checkout_data'])) {
            redirect('traveler/RegisteredTravelerHome');
            return;
        }

        try {
            // Get data from session
            $checkoutData = $_SESSION['checkout_data'];
            $eventDetails = $checkoutData['event_details'];

            // Create ticket data array for QR code
            $ticketData = [
                'booking_id' => uniqid('WWF-'),
                'event_name' => $eventDetails['eventName'],
                'event_date' => $eventDetails['eventDate'],
                'event_time' => $eventDetails['eventStartTime'],
                'event_location' => $eventDetails['eventLocation'],
                'purchase_date' => date('Y-m-d H:i:s'),
                'tickets' => $_SESSION['ticket_details'], // Use the ticket details from session
                'total_amount' => $_SESSION['total_amount'],
                // 'stripe_session_id' => $stripeSessionId
            ];

            // Generate QR code
            $qrGenerator = new TicketQRGenerator();
            $filename = 'generated_tickets/' . $ticketData['booking_id'] . '_ticket.png';
            
            // Ensure directory exists
            if (!file_exists('generated_tickets')) {
                mkdir('generated_tickets', 0777, true);
            }
            
            // Generate QR code
            $qrImage = $qrGenerator->generateTicketQR($ticketData, $filename);
            
            //This is to insert an event booking instance to the event_booking table
            $booking_Id = $this->eventBookingModel->insert_eventBooking( 
                $_SESSION['current_event']['eventId'], 
                $_SESSION['traveler_id'], 
                $ticketData['booking_id'], 
                $ticketData['purchase_date'], 
                $ticketData['total_amount'], 
                $qrImage, 
                'Completed'
            );

            if($booking_Id){

                $ticketPurchaserData = $_SESSION['purchaser_details'];
                $ticketPurchaserData['booking_Id'] = $booking_Id;

                //This will insert the ticket purchaser details to event_ticket_purchaser table
                $result = $this->eventTicketPurchasersModel->insert($ticketPurchaserData);
                if (!$result) {
                    throw new Exception('Payment received, but failed to store ticket purchaser details');
                }

                //This is to check are there any commission record created for the event.
                $existingCommissionRecord = $this->eventBookingCommissionModel->first(['event_Id' => $_SESSION['current_event']['eventId']]);
                $event = $this->eventModel->first(['event_Id' => $_SESSION['current_event']['eventId']]);

                //if not, it means this is the first booking for the event. So we will insert a new record
                if(!$existingCommissionRecord){

                    $eventCommissionData = [
                        'event_Id' => $event->event_Id,
                        'organizer_Id' => $event->organizer_Id,
                        'totalSalesAmount' => $_SESSION['total_amount'],
                        'commissionPercentage' => 8,
                        'commissionAmount' => $_SESSION['total_amount'] * 0.08,
                        'payableAmount' => $_SESSION['total_amount'] * 0.92,
    
                    ];

                    $result = $this->eventBookingCommissionModel->insert($eventCommissionData);
                }

                //If exixsts it means this is not the first booking for the event.
                //Therefor simply we update the total amount, commision amount and payable amount, which will ease the automated commission calculation process admins
                else {
                    $existingCommissionRecord->commissionAmount += $_SESSION['total_amount'] * 0.08;
                    $existingCommissionRecord->totalSalesAmount += $_SESSION['total_amount'];
                    $existingCommissionRecord->payableAmount = $existingCommissionRecord->totalSalesAmount -  $existingCommissionRecord->commissionAmount;

                    $result = $this->eventBookingCommissionModel->update(
                        $event->event_Id, 
                        [
                            'totalSalesAmount' => $existingCommissionRecord->totalSalesAmount, 
                            'commissionAmount' => $existingCommissionRecord->commissionAmount, 
                            'payableAmount' =>$existingCommissionRecord->payableAmount
                        ],
                        'event_Id'
                    );
                }

                $notificationData = [
                    'recipient_type' => 'traveler',
                    'recipient_Id' => $_SESSION['traveler_id'],
                    'notification_type' => 'event_related',
                    'notification_title' => 'Ticket Purchase Confirmed for ' . $eventDetails['eventName'],
                    'notification_text' => 'Your ticket purchase for ' . $eventDetails['eventName'] . ' was successful. We are excited to have you join us. Get ready for an unforgettable experience!'
                ];

                $notificationId = $this->notificationsModel->insert($notificationData);

                if($notificationId){
                    $eventBookingNotificationData = [
                        'notification_Id' => $notificationId,
                        'booking_Id' => $booking_Id
                    ];

                    $result = $this->eventBookingNotificationsModel->insert($eventBookingNotificationData);

                    if(!$result){
                        throw new Exception('Payment received, but failed to generate eventBookingNotification record');
                    }
                }
                else{
                    throw new Exception('Payment received, but we could not notify you due to a system issue. Please check your booking details or contact support.');
                }

            }

            foreach ($_SESSION['ticket_details'] as $ticket) {
                if ($ticket !== NULL) {

                    $parameters = [
                        'event_Id' => $_SESSION['current_event']['eventId'],
                        'ticketTypeName' => $ticket['ticketTypeName']
                    ];

                    // The where() method returns an array of results
                    $eventTicketType = $this->EventTicketTypeModel->where($parameters);
        
                    // Check if we got a result and get the ID from the first result
                    if (!empty($eventTicketType)) {
                        $eventTicketType_Id = $eventTicketType[0]->eventTicketType_Id;
                        $availableTickets = $eventTicketType[0]->availableTickets;
            
                        $insertResult = $this->SoldEventTicketsModel->insert_soldEventTickets(
                            $booking_Id, 
                            $eventTicketType_Id,
                            $ticket['quantity']
                        );

                        
                        $availableTickets -= $ticket['quantity'];

                        $updateResult = $this->EventTicketTypeModel->update(
                            $eventTicketType_Id, 
                            ['availableTickets' => $availableTickets],
                            'eventTicketType_Id'
                        );

                        if(!$updateResult){
                            throw new Exception("Could not update ticket count for: " . $ticket['ticketTypeName']);
                        }
                            
                    } else {
                        // Handle the case where no matching ticket type was found
                        throw new Exception("Ticket type not found for: " . $ticket['ticketTypeName']);
                    }
                }
            }
            
             // Pass data to view
             $viewData = [
                'ticket_info' => $ticketData,
                'ticketTypes' => $_SESSION['ticket_details'],
                'qr_image' => $qrImage,
                'success' => true
            ];

            // Clear sensitive session data after successful generation
            unset($_SESSION['checkout_data']);

            $this->view('traveler/ticketPurchaseConfirmation', $viewData);

        } catch (Exception $e) {
            error_log('QR Generation error: ' . $e->getMessage());
            $this->view('traveler/ticket_confirmation', [
                'success' => false,
                'message' => 'Error generating ticket. Please contact support.'
            ]);
        }
    }
}
