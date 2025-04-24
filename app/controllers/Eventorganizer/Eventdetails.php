<?php
class Eventdetails extends Controller {
    public function index($event_id = '', $b = '', $c = '') {

        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }   
        
        if (!isset($_SESSION['organizer_id'])) {
            error_log("Session Error: organizer_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        
        // Instantiate the Event model
        $eventModel = new Event();

        // Fetch the event details using the event_id
        $event = $eventModel->getAnEventByEventId($event_id);

        // Check if the event exists
        if (empty($event)) {
            error_log("Event not found for event_id: " . $event_id);
            $data = [
                'event' => null,
                'error' => 'Event not found'
            ];
        } else {
            // If $event is a stdClass object, convert it to an array
            if (is_object($event)) {
                $event = json_decode(json_encode($event), true);
            } else {
                // If $event is an array, take the first element
                $event = $event[0];
            }
            $data = [
                'event' => $event,
                'error' => null
            ];
        }

        // Pass the data to the view
        $this->view('eventorganizer/event-details', $data);
    }
}