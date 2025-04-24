<?php

    class ViewPendingEvents extends Controller{

        private $eventModel;
        private $eventTicketTypesModel;

        public function __construct(){
            $this->eventModel = new Event();
            $this->eventTicketTypesModel = new EventTicketType();
        }

        public function index(){

            if(!isset($_SESSION['organizer_id'])){
                header("Location: " . ROOT . '/traveler/Login');
                exit();
            }

            $data['pendingEvents'] = [];
            $data['eventTicketTypes'] = [];
            $pendingEvents = $this->eventModel->where(['organizer_Id' => $_SESSION['organizer_id'], 'eventStatus' => 'pending']);

            if ($pendingEvents) {

                foreach($pendingEvents as $event) {
                    $eventTicketTypes = $this->eventTicketTypesModel->where(['event_Id' => $event->event_Id]);
                    $data['pendingEvents'][] = $event;
                    $data['eventTicketTypes'][] = $eventTicketTypes;
                }

            }

            $this->view('eventorganizer/pendingEvents', $data);
        }

        public function updateEvent(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // Validate input
                if (empty($_POST['eventName']) || empty($_POST['eventDate']) || empty($_POST['eventStartTime']) || 
                    empty($_POST['eventEndTime']) || empty($_POST['eventLocation']) || empty($_POST['aboutEvent'])) {
                    
                    $_SESSION['error'] = "All fields are required";
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
                        
                        // Loop through each ticket and update
                        for ($i = 0; $i < count($ticketIds); $i++) {
                            $ticketId = $ticketIds[$i];
                            
                            // Only update if all necessary data is provided
                            if (isset($ticketNames[$i]) && isset($ticketPrices[$i]) && 
                                isset($ticketQuantities[$i]) && isset($ticketDescriptions[$i])) {
                                
                                $ticketData = [
                                    'ticketTypeName' => $ticketNames[$i],
                                    'pricePerTicket' => $ticketPrices[$i],
                                    'totalTickets' => $ticketQuantities[$i],
                                    'ticketTypeDescription' => $ticketDescriptions[$i]
                                ];
                                
                                // Update the ticket type
                                $this->eventTicketTypesModel->update($ticketId, $ticketData, 'eventTicketType_Id');
                            }
                        }
                    }
                    
                    // Set success message
                    $_SESSION['success'] = "Event updated successfully";
                } else {
                    // Set error message
                    $_SESSION['error'] = "Failed to update event";
                }
                
                // Redirect back to the pending events page
                header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
                exit();
            }
        }
        
        /**
         * Delete an event and its associated ticket types
         */
        public function delete_event() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
                $eventId = $_POST['id'];
                
                // First delete all associated ticket types
                $this->eventTicketTypesModel->delete($eventId, 'event_Id');
                
                // Then delete the event itself
                if ($this->eventModel->delete($eventId, 'event_Id')) {
                    $_SESSION['success'] = "Event deleted successfully";
                } else {
                    $_SESSION['error'] = "Failed to delete event";
                }
                
                // Redirect back to the pending events page
                header("Location: " . ROOT . "/Eventorganizer/ViewPendingEvents");
                exit();
            }
        }
    }