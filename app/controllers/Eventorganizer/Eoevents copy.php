<?php
include '../app/models/Event.php';

class Eoevents extends Controller {
    private $model;
    private $event = [];

    public function __construct() {
        $this->model = new Event();
    }

    public function index($a = '', $b = '', $c = '') {
        $this->event = $this->model->getEventsByOrganizerId();

        if (!isset($_SESSION['organizer_id'])) {
            error_log("Session Error: organizer_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        // Debug: Log events data
        error_log("Events fetched: " . print_r($this->event, true));
        $this->view('eventorganizer/eoevents', ["eventsdata" => $this->event]);
    }

    public function updateEvent() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $eventName = filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING);
            $eventType = filter_input(INPUT_POST, 'eventType', FILTER_SANITIZE_STRING);
            $aboutEvent = filter_input(INPUT_POST, 'aboutEvent', FILTER_SANITIZE_STRING);
            $eventDate = filter_input(INPUT_POST, 'eventDate', FILTER_SANITIZE_STRING);
            $eventStartTime = filter_input(INPUT_POST, 'eventStartTime', FILTER_SANITIZE_STRING);
            $eventEndTime = filter_input(INPUT_POST, 'eventEndTime', FILTER_SANITIZE_STRING);
            $eventLocation = filter_input(INPUT_POST, 'eventLocation', FILTER_SANITIZE_STRING);
            $ticketCount = filter_input(INPUT_POST, 'ticketCount', FILTER_SANITIZE_NUMBER_INT);
            $ticketPrice = filter_input(INPUT_POST, 'ticketPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            if ($id && $eventName && $eventType && $aboutEvent && $eventDate && $eventStartTime && $eventEndTime && $eventLocation) {
                $success = $this->model->update_event(
                    $id,
                    $eventName,
                    $eventType,
                    $aboutEvent,
                    $eventDate,
                    $eventStartTime,
                    $eventEndTime,
                    $eventLocation,
                    $ticketCount,
                    $ticketPrice
                );
                if ($success) {
                    $_SESSION['message'] = "Event updated successfully!";
                } else {
                    $_SESSION['error'] = "Failed to update event.";
                }
            } else {
                $_SESSION['error'] = "All required fields must be filled.";
            }
            redirect("eventorganizer/Eoevents");
        }
    }

    public function delete_event() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            error_log("Attempting to delete event with ID: $id");
            if ($id) {
                $success = $this->model->delete_event($id);
                if ($success) {
                    $_SESSION['message'] = "Event deleted successfully!";
                    error_log("Event deleted successfully: $id");
                } else {
                    $_SESSION['error'] = "Failed to delete event.";
                    error_log("Failed to delete event: $id");
                }
            } else {
                $_SESSION['error'] = "Invalid event ID.";
                error_log("Invalid event ID received");
            }
            redirect("eventorganizer/Eoevents");
        } else {
            $_SESSION['error'] = "Invalid request method.";
            error_log("Invalid request method for delete_event");
            redirect("eventorganizer/Eoevents");
        }
    }
}