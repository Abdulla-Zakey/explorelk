<?php 

/**
 * New Registration Details class
 */
class C_events extends Controller
{
    private $eventModel;
    private $eventTicketTypeModel;
    private $eventOrganizerModel;

    public function __construct(){
        $this->eventModel = new Event;
        $this->eventTicketTypeModel = new EventTicketType;
        $this->eventOrganizerModel = new Eventorganizer;
    }

	public function index()
	{
        $pendingEvents = $this->eventModel->where(['eventStatus' => 'pending']);
        $approvedEvents = $this->eventModel->where(['eventStatus' => 'approved']);
        $completedEvents = $this->eventModel->where(['eventStatus' => 'completed']);
        $rejectedEvents = $this->eventModel->where(['eventStatus' => 'rejected']);
        // show($rejectedEvents);   

        $eventTicketTypes = $this->eventTicketTypeModel->SelectAll();

        $eventOrganizers = $this->eventOrganizerModel->selectAll();

        $data = [
            'pendingEvents' => $pendingEvents,
            'approvedEvents' => $approvedEvents,
            'completedEvents' => $completedEvents,
            'eventOrganizers' => $eventOrganizers,
            'eventTicketTypes' =>$eventTicketTypes,
            'rejectedEvents' => $rejectedEvents,
        ];

        // show($data);
        $this->view('admin/events', $data);
    }

    public function approveEvent($eventId) {    
        $data = [
            'eventStatus' => 'approved',
        ];
        $success = $this->eventModel->update($eventId, $data, 'event_Id');
    
        // 3. Redirect back with a success/error message
        if ($success) {
            $_SESSION['notification'] = "Event #{$eventId} approved successfully!";
        } else {
            $_SESSION['error'] = "Failed to approve event #{$eventId}";
        }
    
        header("Location: " . ROOT . "/admin/C_events"); // Redirect back to events page
        exit();
    }

    public function rejectEvent(){
        
        $data = [
            'eventStatus' => 'rejected',
            'rejection_reason' => $_POST['rejection_reason'],
        ];
        $eventId = $_POST['event_id'];
        // show($data);
        // echo 'hi';

        $success = $this->eventModel->update($eventId, $data, 'event_id');

        if ($success) {
            $_SESSION['notification'] = "Event #{$eventId} rejected successfully!";
        } else {
            $_SESSION['error'] = "Failed to reject event #{$eventId}";
        }
        show($success);
    
        header("Location: " . ROOT . "/admin/C_events"); // Redirect back to events page
        exit();
    }
}