<?php

    include '../app/models/Event.php'; 
    include '../app/models/EventTicketType.php';   

class Eocreateevent extends Controller{
        private $eventModel;
        private $eventTicketTypeModel;


        public function index($a = '', $b = '', $c = ''){

            $this->view('eventorganizer/eocreateevent');
        }

        public function __construct(){
            $this->eventModel = new Event();
            $this->eventTicketTypeModel = new EventTicketType();
        }

        private function handleEventBannerUpload() {
            if (isset($_FILES['eventWebBanner']) && $_FILES['eventWebBanner']['error'] === UPLOAD_ERR_OK) {
                // Use absolute server path instead of ROOT constant
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/assets/images/events/';
                
                // Generate a unique filename
                $fileName = uniqid() . '_' . basename($_FILES['eventWebBanner']['name']);
                
                // Full path for the uploaded file
                $uploadPath = $uploadDir . $fileName;
        
                // Ensure upload directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
        
                // Move uploaded file
                if (move_uploaded_file($_FILES['eventWebBanner']['tmp_name'], $uploadPath)) {
                    // Return just the filename to be stored in the database
                    return $fileName;
                } else {
                    // Add error logging
                    error_log("File upload failed. Temp path: " . $_FILES['eventWebBanner']['tmp_name'] . ", Destination: " . $uploadPath);
                }
            }
        
            // Return existing profile picture if no new upload
            return $_POST['existingProfilePic'] ?? null;
        }


        public function create(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $organizer_Id = $_SESSION['organizer_id'];
                $eventWebBannerPath = $this->handleEventBannerUpload();
                $eventName = $_POST['eventName'];
                $aboutEvent = $_POST['aboutEvent'];
                $eventDate = $_POST['eventDate'];
                $eventStartTime = $_POST['eventStartTime'];
                $eventEndTime = $_POST['eventEndTime'];
                $eventLocation = $_POST['eventLocation'];
                // $this->eventModel->insert_event($organizer_Id,$eventName,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation);
                // redirect("eventorganizer/Eoevents");

                // Insert event and get the event_Id
                $event_Id = $this->eventModel->insert_event(
                    $organizer_Id,
                    $eventWebBannerPath,
                    $eventName,
                    $aboutEvent,
                    $eventDate,
                    $eventStartTime,
                    $eventEndTime,
                    $eventLocation
                );

                // Process ticket types
                $ticketCount = count(array_filter(array_keys($_POST), function($key) {
                    return strpos($key, 'ticket-type-') === 0;
                }));
            
                // Insert each ticket type
                for($i = 1; $i <= $ticketCount; $i++) {
                    $ticketType = $_POST["ticket-type-$i"];
                    $typeDesc = $_POST["type-desc-$i"];
                    $price = $_POST["price-$i"];
                    $count = $_POST["count-$i"];
                
                    $this->eventTicketTypeModel->insert([
                        'event_Id' => $event_Id,
                        'ticketTypeName' => $ticketType,
                        'ticketTypeDescription' => $typeDesc,
                        'pricePerTicket' => $price,
                        'totalTickets' => $count,
                        'availableTickets' => $count  // Initially, available tickets equals total tickets
                    ]);
                }
            
                redirect("eventorganizer/Eoevents");
        
            }
        }
    }






    