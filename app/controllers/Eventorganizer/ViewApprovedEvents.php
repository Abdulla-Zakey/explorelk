<?php

class ViewApprovedEvents extends Controller{

    private $eventModel;
    private $eventTicketTypesModel;
    private $eventBookingModel;
    private $eventTicketPurchasersModel;
    private $eventCancellationModel;

    public function __construct(){
        $this->eventModel = new Event();
        $this->eventTicketTypesModel = new EventTicketType();
        $this->eventBookingModel = new EventBookingModel();
        $this->eventTicketPurchasersModel = new EventTicketPurchasersModel();
        $this->eventCancellationModel = new EventCancellationsModel();
    }

    public function index(){

        if(!isset($_SESSION['organizer_id'])){
            header("Location: " . ROOT . '/traveler/Login');
            exit();
        }

        $data['approvedEvents'] = [];
        $data['eventTicketTypes'] = [];

        $currentDate = date('Y-m-d');
        $approvedEvents = $this->eventModel->where(['organizer_Id' => $_SESSION['organizer_id'], 'eventStatus' => 'approved']);

        if ($approvedEvents) {
            foreach($approvedEvents as $key => $event) {
                // Get ticket types for this event
                if($event->eventDate > $currentDate){
                    $eventTicketTypes = $this->eventTicketTypesModel->where(['event_Id' => $event->event_Id]);
                    $data['approvedEvents'][] = $event;
                    $data['eventTicketTypes'][] = $eventTicketTypes;
                }
                
            }
        }

        $this->view('eventorganizer/approvedEvents', $data);
    }

    // Method to handle event canellations
    public function cancel_event() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $eventId = $_POST['id'] ?? 0;
            $cancellationReason = $_POST['cancellation_reason'] ?? '';
            
            // Validate input
            if (!$eventId) {
                $_SESSION['message'] = "Invalid event selected";
                $_SESSION['message_type'] = "error";
                redirect('Eventorganizer/ViewApprovedEvents');
                return;
            }
            
            if (empty($cancellationReason)) {
                $_SESSION['message'] = "Please provide a reason for cancellation";
                $_SESSION['message_type'] = "error";
                redirect('Eventorganizer/ViewApprovedEvents');
                return;
            }
            
            // Get event details first to verify organizer owns this event
            $event = $this->eventModel->first(['event_Id' => $eventId, 'organizer_Id' => $_SESSION['organizer_id']]);
            
            if (!$event) {
                $_SESSION['message'] = "You don't have permission to cancel this event";
                $_SESSION['message_type'] = "error";
                redirect('Eventorganizer/ViewApprovedEvents');
                return;
            }
            
            // Create cancellation record
            $cancellationData = [
                'event_Id' => $eventId,
                'organizer_Id' => $_SESSION['organizer_id'],
                'cancellation_reason' => $cancellationReason,
                'cancellation_date' => date('Y-m-d H:i:s'),
                'admin_approval_status' => 'pending' // Admin needs to approve and process refunds
            ];
            
            $cancellationId = $this->eventCancellationModel->insert($cancellationData);
            
            if ($cancellationId) {
                // Update event status to 'cancellation_pending'
                $this->eventModel->update($eventId, ['eventStatus' => 'cancellation_pending'], 'event_Id');
                
                $_SESSION['message'] = "Event cancellation request submitted. Admin will process refunds for ticket purchasers.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to submit cancellation request. Please try again.";
                $_SESSION['message_type'] = "error";
            }
        }
        
        redirect('Eventorganizer/ViewApprovedEvents');
    }


    // Method to fetch participants data via AJAX
    public function getParticipants($eventId = 0) {
        // Check if it's an AJAX request
        if (!$eventId) {
            echo json_encode(['error' => 'Invalid event ID']);
            return;
        }
        
        // Get event details first to verify organizer owns this event
        $event = $this->eventModel->first(['event_Id' => $eventId, 'organizer_Id' => $_SESSION['organizer_id']]);
        
        if (!$event) {
            echo json_encode(['error' => 'You do not have permission to view this data']);
            return;
        }
        
        // Get all bookings for this event
        $bookings = $this->eventBookingModel->where(['event_Id' => $eventId]);
        
        $participants = [];
        $bookingIds = [];
        
        // Get all booking IDs
        if ($bookings) {
            foreach ($bookings as $booking) {
                $bookingIds[] = $booking->booking_Id;
            }
        }
        
        // Get purchaser details for these bookings
        if (!empty($bookingIds)) {
            // Get ticket purchasers info
            foreach ($bookingIds as $bookingId) {
                $purchaser = $this->eventTicketPurchasersModel->first(['booking_Id' => $bookingId]);
                
                if ($purchaser) {
                    // Get booking details for additional info
                    $booking = $this->eventBookingModel->first(['booking_Id' => $bookingId]);
                    
                    // Add booking related info to the participant
                    $purchaser->quantity = 1; // Default
                    $purchaser->totalAmount = $booking->totalAmount ?? 0;
                    $purchaser->purchaseDate = $booking->purchasedDate ?? '';
                    
                    $participants[] = $purchaser;
                }
            }
        }
        
        // Get ticket types for breakdown
        $ticketTypes = $this->eventTicketTypesModel->where(['event_Id' => $eventId]);
        
        $ticketBreakdown = [];
        if ($ticketTypes) {
            foreach ($ticketTypes as $ticket) {
                // Calculate sold tickets
                $soldCount = $ticket->totalTickets - $ticket->availableTickets;
                
                $ticketBreakdown[] = [
                    'ticketTypeName' => $ticket->ticketTypeName,
                    'pricePerTicket' => $ticket->pricePerTicket,
                    'totalTickets' => $ticket->totalTickets,
                    'availableTickets' => $ticket->availableTickets,
                    'soldCount' => $soldCount,
                    'revenue' => $soldCount * $ticket->pricePerTicket
                ];
            }
        }
        
        echo json_encode([
            'participants' => $participants,
            'ticketBreakdown' => $ticketBreakdown
        ]);
    }
}