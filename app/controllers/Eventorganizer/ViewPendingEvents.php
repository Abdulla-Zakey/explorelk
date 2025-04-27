<?php

class ViewPendingEvents extends Controller
{
    private $eventModel;
    private $eventTicketTypesModel;

    public function __construct()
    {
        $this->eventModel = new Event();
        $this->eventTicketTypesModel = new EventTicketType();
    }

    public function index()
    {
        if (!isset($_SESSION['organizer_id'])) {
            header("Location: " . ROOT . '/traveler/Login');
            exit();
        }

        $data['pendingEvents'] = [];
        $data['eventTicketTypes'] = [];
        $pendingEvents = $this->eventModel->where(['organizer_Id' => $_SESSION['organizer_id'], 'eventStatus' => 'pending']);

        if ($pendingEvents) {
            foreach ($pendingEvents as $event) {
                $eventTicketTypes = $this->eventTicketTypesModel->where(['event_Id' => $event->event_Id]);
                $data['pendingEvents'][] = $event;
                $data['eventTicketTypes'][] = $eventTicketTypes;
            }
        }

        $this->view('eventorganizer/pendingEvents', $data);
    }

    public function updateEvent()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate required fields
        if (
            empty($_POST['eventName']) || empty($_POST['eventDate']) || empty($_POST['eventStartTime']) ||
            empty($_POST['eventEndTime']) || empty($_POST['eventLocation']) || empty($_POST['aboutEvent']) ||
            empty($_POST['eventType'])
        ) {
            $_SESSION['error'] = "All fields are required";
            header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
            exit();
        }

        // Validate event type
        $allowedEventTypes = ['Carnival', 'Music Concert', 'Magic Show', 'Sports', 'Other'];
        if (!in_array($_POST['eventType'], $allowedEventTypes)) {
            $_SESSION['error'] = "Invalid event type";
            header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
            exit();
        }

        // Validate event date (not in the past)
        $eventDate = new DateTime($_POST['eventDate']);
        $today = new DateTime(); // Current date
        $today->setTime(0, 0, 0); // Reset time to midnight for comparison
        if ($eventDate < $today) {
            $_SESSION['error'] = "Event date cannot be in the past";
            header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
            exit();
        }

        // Validate start and end time
        $startTime = new DateTime($_POST['eventDate'] . ' ' . $_POST['eventStartTime']);
        $endTime = new DateTime($_POST['eventDate'] . ' ' . $_POST['eventEndTime']);
        if ($endTime <= $startTime) {
            $_SESSION['error'] = "End time must be after start time";
            header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
            exit();
        }

        $eventData = [
            'eventName' => $_POST['eventName'],
            'aboutEvent' => $_POST['aboutEvent'],
            'eventType' => $_POST['eventType'],
            'eventDate' => $_POST['eventDate'],
            'eventStartTime' => $_POST['eventStartTime'],
            'eventEndTime' => $_POST['eventEndTime'],
            'eventLocation' => $_POST['eventLocation'],
            'eventStatus' => 'pending'
        ];

        // Update the event in the database
        $eventId = $_POST['id'];
        if ($this->eventModel->update($eventId, $eventData, 'event_Id')) {
            // Update ticket types if they exist
            if (isset($_POST['ticketIds']) && is_array($_POST['ticketIds'])) {
                $ticketIds = $_POST['ticketIds'];
                $ticketNames = $_POST['ticketNames'] ?? [];
                $ticketPrices = $_POST['ticketPrices'] ?? [];
                $ticketQuantities = $_POST['ticketQuantities'] ?? [];
                $ticketDescriptions = $_POST['ticketDescriptions'] ?? [];

                for ($i = 0; $i < count($ticketIds); $i++) {
                    if (
                        isset($ticketNames[$i]) && isset($ticketPrices[$i]) &&
                        isset($ticketQuantities[$i]) && isset($ticketDescriptions[$i])
                    ) {
                        $ticketData = [
                            'ticketTypeName' => $ticketNames[$i],
                            'pricePerTicket' => $ticketPrices[$i],
                            'totalTickets' => $ticketQuantities[$i],
                            'ticketTypeDescription' => $ticketDescriptions[$i]
                        ];
                        $this->eventTicketTypesModel->update($ticketIds[$i], $ticketData, 'eventTicketType_Id');
                    }
                }
            }

            $_SESSION['success'] = "Event updated successfully";
        } else {
            $_SESSION['error'] = "Failed to update event";
        }

        header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
        exit();
    }
}

    public function delete_event()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
            $eventId = $_POST['id'];
            $this->eventTicketTypesModel->delete($eventId, 'event_Id');
            if ($this->eventModel->delete($eventId, 'event_Id')) {
                $_SESSION['success'] = "Event deleted successfully";
            } else {
                $_SESSION['error'] = "Failed to delete event";
            }
            header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
            exit();
        }
    }
}