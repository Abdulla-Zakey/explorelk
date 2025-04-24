<?php

class ViewCompletedEvents extends Controller{

    private $eventModel;
    private $eventTicketTypesModel;
    private $eventBookingModel;
    private $eventTicketPurchasersModel;
    private $eventBookingCommissionModel;

    public function __construct(){
        $this->eventModel = new Event();
        $this->eventTicketTypesModel = new EventTicketType();
        $this->eventBookingModel = new EventBookingModel();
        $this->eventTicketPurchasersModel = new EventTicketPurchasersModel();
        $this->eventBookingCommissionModel = new EventBookingCommissionModel();
    }

    public function index(){
        // Check if organizer is logged in
        if(!isset($_SESSION['organizer_id'])){
            redirect('eventOrganizer/login');
            exit();
        }

        $data['completedEvents'] = [];
        $data['eventTicketTypes'] = [];
        
        // Get current date for comparison
        $currentDate = date('Y-m-d');
        
        // Get all events for this organizer
        $allEvents = $this->eventModel->where(['organizer_Id' => $_SESSION['organizer_id']]);

        if ($allEvents) {
            foreach($allEvents as $key => $event) {
                // Check if event date has passed AND event is approved
                if($event->eventDate < $currentDate && ($event->eventStatus == 'approved' || $event->eventStatus == 'approved')) {
                    // Get ticket types for this event
                    $eventTicketTypes = $this->eventTicketTypesModel->where(['event_Id' => $event->event_Id]);
                    $data['completedEvents'][] = $event;
                    $data['eventTicketTypes'][] = $eventTicketTypes;
                }
            }
        }

        $this->view('eventorganizer/temp', $data);
    }

    // Method to fetch participants data via AJAX
    public function getEventParticipants($eventId = 0) {
        // Set content type for JSON response
        header('Content-Type: application/json');

        // Check if the event ID is valid
        if (!$eventId) {
            echo json_encode(['error' => 'Invalid event ID']);
            return;
        }
        
        // Check for authentication
        if(!isset($_SESSION['organizer_id'])){
            echo json_encode(['error' => 'Authentication required']);
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
        $totalSales = 0;
        
        // Process all bookings and get participant details
        if ($bookings) {
            foreach ($bookings as $booking) {
                // Add to total sales
                $totalSales += floatval($booking->totalAmount ?? 0);
                
                // Get purchaser details for this booking
                $purchasers = $this->eventTicketPurchasersModel->where(['booking_Id' => $booking->booking_Id]);
                
                if ($purchasers) {
                    foreach ($purchasers as $purchaser) {
                        $participants[] = [
                            'name' => $purchaser->fullName,
                            'email' => $purchaser->email,
                            'phone' => $purchaser->mobileNum,
                            'purchaseDate' => $booking->purchasedDate ?? date('Y-m-d', strtotime($booking->created_at ?? 'now')),
                            'amount' => floatval($booking->totalAmount ?? 0)
                        ];
                    }
                }
            }
        }
        
        // Get ticket types for breakdown
        $ticketTypes = $this->eventTicketTypesModel->where(['event_Id' => $eventId]);
        
        // Calculate commission (8% of total sales)
        $commissionAmount = $totalSales * 0.08;
        $receivableAmount = $totalSales - $commissionAmount;
        
        echo json_encode([
            'participants' => $participants,
            'ticketTypes' => $ticketTypes,
            'financialSummary' => [
                'totalSales' => $totalSales,
                'commissionAmount' => $commissionAmount,
                'receivableAmount' => $receivableAmount
            ]
        ]);
    }
    
    // Method to fetch payment information for an event
    public function getEventPaymentInfo($eventId = 0) {
        // Set content type for JSON response
        header('Content-Type: application/json');
        
        // Check if the event ID is valid
        if (!$eventId) {
            echo json_encode(['error' => 'Invalid event ID']);
            return;
        }
        
        // Check for authentication
        if(!isset($_SESSION['organizer_id'])){
            echo json_encode(['error' => 'Authentication required']);
            return;
        }
        
        // Get event details first to verify organizer owns this event
        $event = $this->eventModel->first(['event_Id' => $eventId, 'organizer_Id' => $_SESSION['organizer_id']]);
        
        if (!$event) {
            echo json_encode(['error' => 'You do not have permission to view this data']);
            return;
        }
        
        // Get commission record for this event
        $commission = $this->eventBookingCommissionModel->first([
            'event_Id' => $eventId, 
            'organizer_Id' => $_SESSION['organizer_id']
        ]);
        
        // If no commission record exists yet, calculate it on the fly
        if (!$commission) {
            // Get all bookings for this event to calculate total sales
            $bookings = $this->eventBookingModel->where(['event_Id' => $eventId]);
            $totalSales = 0;
            
            if ($bookings) {
                foreach ($bookings as $booking) {
                    $totalSales += floatval($booking->totalAmount ?? 0);
                }
            }
            
            // Calculate commission amount (8%)
            $commissionAmount = $totalSales * 0.08;
            $payableAmount = $totalSales - $commissionAmount;
            
            $paymentInfo = [
                'eventId' => $eventId,
                'eventDate' => $event->eventDate,
                'totalSales' => $totalSales,
                'commissionAmount' => $commissionAmount,
                'payableAmount' => $payableAmount,
                'paymentStatus' => 'Pending', // Default status when no record exists
                'paymentDate' => null
            ];
        } else {
            // Use existing commission record
            $paymentInfo = [
                'eventId' => $eventId,
                'eventDate' => $event->eventDate,
                'totalSales' => $commission->totalSalesAmount,
                'commissionAmount' => $commission->commissionAmount,
                'payableAmount' => $commission->payableAmount,
                'paymentStatus' => $commission->paymentStatus,
                'paymentDate' => $commission->paymentDate
            ];
        }
        
        echo json_encode($paymentInfo);
    }
}