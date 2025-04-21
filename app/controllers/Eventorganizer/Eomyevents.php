<?php
class Eomyevents extends Controller {
    public function index($a = '', $b = '', $c = '') {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Debug: Check if organizer_id is set
        if (!isset($_SESSION['organizer_id'])) {
            error_log("Session Error: organizer_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/Eventorganizer/Login");
            exit();
        }

        $organizerId = $_SESSION['organizer_id'];
        error_log("Debug - Organizer ID from session: " . $organizerId);

        // Instantiate the Event model
        $eventModel = new Event();

        // Fetch events for the logged-in organizer
        $events = $eventModel->getEventsByOrganizerId();

        // Debug: Log the fetched events
        if (empty($events)) {
            error_log("No events found for organizer ID: " . $organizerId);
        } else {
            error_log("Events fetched for organizer ID " . $organizerId . ": " . json_encode($events));
        }

        // Prepare the data to pass to the view
        $data = [
            'events' => $events
        ];

        // Debug: Log the data being passed to the view
        error_log("Debug - Data passed to view: " . json_encode($data));

        // Pass the data to the view
        $this->view('eventorganizer/eomyevents', $data);
    }
}