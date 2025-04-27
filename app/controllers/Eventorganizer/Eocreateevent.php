<?php

    include '../app/models/Event.php'; 
    include '../app/models/EventTicketType.php';   

class Eocreateevent extends Controller{
        private $eventModel;
        private $eventTicketTypeModel;


        public function index($a = '', $b = '', $c = ''){
            // Start session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }   
            
            if (!isset($_SESSION['organizer_id'])) {
                error_log("Session Error: organizer_id not set in session. Redirecting to login.");
                header("Location: " . ROOT . "/traveler/Login");
                exit();
            }


            $this->view('eventorganizer/eocreateevent');
        }

        public function __construct(){
            $this->eventModel = new Event();
            $this->eventTicketTypeModel = new EventTicketType();
        }

        private function handleEventBannerUpload() {
            if (isset($_FILES['eventWebBanner']) && $_FILES['eventWebBanner']['error'] === UPLOAD_ERR_OK) {
                // Use absolute server path instead of ROOT constant
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/assets/images/events/eventWebBannerPics/';
                
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


        // public function create(){

        //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //         $organizer_Id = $_SESSION['organizer_id'];
        //         $eventWebBannerPath = $this->handleEventBannerUpload();
        //         $eventName = $_POST['eventName'];
        //         $eventType = $_POST['eventType'];
        //         $aboutEvent = $_POST['aboutEvent'];
        //         // $eventType = $_POST['eventType'];
        //         $eventDate = $_POST['eventDate'];
        //         $eventStartTime = $_POST['eventStartTime'];
        //         $eventEndTime = $_POST['eventEndTime'];
        //         $eventLocation = $_POST['eventLocation'];
        //         // $this->eventModel->insert_event($organizer_Id,$eventName,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation);
        //         // redirect("eventorganizer/Eoevents");

        //         // Insert event and get the event_Id
        //         $event_Id = $this->eventModel->insert_event(
        //             $organizer_Id,
        //             $eventWebBannerPath,
        //             $eventName,
        //             $eventType,
        //             $aboutEvent,
        //             // $eventType,
        //             $eventDate,
        //             $eventStartTime,
        //             $eventEndTime,
        //             $eventLocation
        //         );

        //         // Process ticket types
        //         $ticketCount = count(array_filter(array_keys($_POST), function($key) {
        //             return strpos($key, 'ticket-type-') === 0;
        //         }));
            
        //         // Insert each ticket type
        //         for($i = 1; $i <= $ticketCount; $i++) {
        //             $ticketType = $_POST["ticket-type-$i"];
        //             $typeDesc = $_POST["type-desc-$i"];
        //             $price = $_POST["price-$i"];
        //             $count = $_POST["count-$i"];
                
        //             $this->eventTicketTypeModel->insert([
        //                 'event_Id' => $event_Id,
        //                 'ticketTypeName' => $ticketType,
        //                 'ticketTypeDescription' => $typeDesc,
        //                 'pricePerTicket' => $price,
        //                 'totalTickets' => $count,
        //                 'availableTickets' => $count  // Initially, available tickets equals total tickets
        //             ]);
        //         }
            
        //         redirect("eventorganizer/ViewPendingEvents");
        
        //     }
        // }
        public function create(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $organizer_Id = $_SESSION['organizer_id'];
                $eventName = trim($_POST['eventName'] ?? '');
                $eventType = trim($_POST['eventType'] ?? '');
                $aboutEvent = trim($_POST['aboutEvent'] ?? '');
                $eventDate = $_POST['eventDate'] ?? '';
                $eventStartTime = $_POST['eventStartTime'] ?? '';
                $eventEndTime = $_POST['eventEndTime'] ?? '';
                $eventLocation = trim($_POST['eventLocation'] ?? '');
        
                // Server-side validation
                if (empty($eventName)) {
                    error_log("Validation failed: Event name is empty");
                    redirect("eventorganizer/Eocreateevent?error=Event name is required");
                    return;
                }
        
                if (empty($eventType)) {
                    error_log("Validation failed: Event type is empty");
                    redirect("eventorganizer/Eocreateevent?error=Event type is required");
                    return;
                }
        
                if (empty($aboutEvent)) {
                    error_log("Validation failed: About event is empty");
                    redirect("eventorganizer/Eocreateevent?error=Event description is required");
                    return;
                }
        
                if (strlen($aboutEvent) > 350) {
                    error_log("Validation failed: About event exceeds 350 characters");
                    redirect("eventorganizer/Eocreateevent?error=Event description cannot exceed 350 characters");
                    return;
                }
        
                if (empty($eventDate)) {
                    error_log("Validation failed: Event date is empty");
                    redirect("eventorganizer/Eocreateevent?error=Event date is required");
                    return;
                }
        
                if (empty($eventStartTime) || empty($eventEndTime)) {
                    error_log("Validation failed: Event times are empty");
                    redirect("eventorganizer/Eocreateevent?error=Start and end times are required");
                    return;
                }
        
                if (empty($eventLocation)) {
                    error_log("Validation failed: Event location is empty");
                    redirect("eventorganizer/Eocreateevent?error=Event location is required");
                    return;
                }
        
                // Validate image upload
                if (!isset($_FILES['eventWebBanner']) || $_FILES['eventWebBanner']['error'] === UPLOAD_ERR_NO_FILE) {
                    error_log("Validation failed: No image uploaded");
                    redirect("eventorganizer/Eocreateevent?error=Event banner image is required");
                    return;
                }
        
                if ($_FILES['eventWebBanner']['error'] !== UPLOAD_ERR_OK) {
                    error_log("Image upload error: " . $_FILES['eventWebBanner']['error']);
                    redirect("eventorganizer/Eocreateevent?error=Failed to upload image");
                    return;
                }
        
                $file = $_FILES['eventWebBanner'];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                $maxSize = 5 * 1024 * 1024; // 5MB
        
                if (!in_array($file['type'], $allowedTypes)) {
                    error_log("Validation failed: Invalid image type");
                    redirect("eventorganizer/Eocreateevent?error=Image must be JPEG, JPG, or PNG");
                    return;
                }
        
                if ($file['size'] > $maxSize) {
                    error_log("Validation failed: Image size exceeds 5MB");
                    redirect("eventorganizer/Eocreateevent?error=Image size must not exceed 5MB");
                    return;
                }
        
                $eventWebBannerPath = $this->handleEventBannerUpload();
        
                if (!$eventWebBannerPath) {
                    error_log("Failed to handle image upload");
                    redirect("eventorganizer/Eocreateevent?error=Failed to process image upload");
                    return;
                }
        
                // Log for debugging
                error_log("Inserting event with eventType: " . $eventType);
        
                // Insert event and get the event_Id
                $event_Id = $this->eventModel->insert_event(
                    $organizer_Id,
                    $eventWebBannerPath,
                    $eventName,
                    $eventType,
                    $aboutEvent,
                    $eventDate,
                    $eventStartTime,
                    $eventEndTime,
                    $eventLocation
                );
        
                if (!$event_Id) {
                    error_log("Failed to insert event");
                    redirect("eventorganizer/Eocreateevent?error=Failed to create event");
                    return;
                }
        
                // Process ticket types
                $ticketCount = count(array_filter(array_keys($_POST), function($key) {
                    return strpos($key, 'ticket-type-') === 0;
                }));
        
                // Validate ticket types
                if ($ticketCount === 0) {
                    error_log("Validation failed: No ticket types provided");
                    redirect("eventorganizer/Eocreateevent?error=At least one ticket type is required");
                    return;
                }
        
                // Insert each ticket type
                for($i = 1; $i <= $ticketCount; $i++) {
                    $ticketType = trim($_POST["ticket-type-$i"] ?? '');
                    $typeDesc = trim($_POST["type-desc-$i"] ?? '');
                    $price = $_POST["price-$i"] ?? 0;
                    $count = $_POST["count-$i"] ?? 0;
        
                    if (empty($ticketType) || empty($typeDesc) || $price <= 0 || $count < 1) {
                        error_log("Validation failed: Invalid ticket details for ticket $i");
                        redirect("eventorganizer/Eocreateevent?error=Invalid ticket details");
                        return;
                    }
        
                    $this->eventTicketTypeModel->insert([
                        'event_Id' => $event_Id,
                        'ticketTypeName' => $ticketType,
                        'ticketTypeDescription' => $typeDesc,
                        'pricePerTicket' => $price,
                        'totalTickets' => $count,
                        'availableTickets' => $count
                    ]);
                }
        
                // Set success message in session
                $_SESSION['success_message'] = "Event is created, waiting for admin approval";
        
                // Redirect back to the create event page to show the popup
                redirect("eventorganizer/Eocreateevent");
            }
        }

    }






    