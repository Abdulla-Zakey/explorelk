<?php

class ViewCancelledEvents extends Controller {

    private $eventModel;
    private $eventCancellationModel;

    public function __construct() {
        $this->eventModel = new Event();
        $this->eventCancellationModel = new EventCancellationsModel();
    }

    public function index() {
        if (!isset($_SESSION['organizer_id'])) {
            header("Location: " . ROOT . '/traveler/Login');
            exit();
        }

        $data['cancellationPendingEvents'] = [];
        $data['cancelledEvents'] = [];
        
        // Get events with cancellation pending status
        $pendingCancellations = $this->eventModel->where([
            'organizer_Id' => $_SESSION['organizer_id'], 
            'eventStatus' => 'cancellation_pending'
        ]);
        
        // Get events with cancelled status
        $cancelledEvents = $this->eventModel->where([
            'organizer_Id' => $_SESSION['organizer_id'], 
            'eventStatus' => 'cancelled'
        ]);
        
        // Fetch cancellation details for each event and merge them
        if (!empty($pendingCancellations)) {
            foreach ($pendingCancellations as &$event) {
                $cancellationDetails = $this->eventCancellationModel->first(['event_Id' => $event->event_Id]);
                if ($cancellationDetails) {
                    // Merge cancellation details with event object
                    foreach ($cancellationDetails as $key => $value) {
                        $event->$key = $value;
                    }
                    
                    // Set default values for properties that might be missing
                    if (!isset($event->refund_processed)) {
                        $event->refund_processed = false;
                    }
                    if (!isset($event->admin_notes)) {
                        $event->admin_notes = '';
                    }
                    if (!isset($event->reason)) {
                        $event->reason = $cancellationDetails->cancellation_reason ?? 'No reason provided';
                    }
                }
            }
        }
        
        // Do the same for cancelled events
        if (!empty($cancelledEvents)) {
            foreach ($cancelledEvents as &$event) {
                $cancellationDetails = $this->eventCancellationModel->first(['event_Id' => $event->event_Id]);
                if ($cancellationDetails) {
                    // Merge cancellation details with event object
                    foreach ($cancellationDetails as $key => $value) {
                        $event->$key = $value;
                    }
                    
                    // Set default values for properties that might be missing
                    if (!isset($event->refund_processed)) {
                        $event->refund_processed = false;
                    }
                    if (!isset($event->admin_notes)) {
                        $event->admin_notes = '';
                    }
                    if (!isset($event->reason)) {
                        $event->reason = $cancellationDetails->cancellation_reason ?? 'No reason provided';
                    }
                }
            }
        }
        
        $data['cancellationPendingEvents'] = $pendingCancellations;
        $data['cancelledEvents'] = $cancelledEvents;
        
        $this->view('eventorganizer/cancelledEvents', $data);
    }
}