<?php

    class ViewAllEvents extends Controller{

        private $eventModel;

        public function __construct(){

            $this->eventModel = new Event();

        } 

        public function index(){

            $result = $this->eventModel->getAllAprovedEvents();

            $data['eventDetails'] = $result;

            $this->view('traveler/viewAllEvents', $data);
            
        }

        // Add new method to handle AJAX search
        public function search() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $searchTerm = isset($_POST['search']) ? trim($_POST['search']) : '';
                
                // Only process search if there's a valid search term
                if (strlen($searchTerm) > 0) {
                    $results = $this->eventModel->getAllAprovedEvents();
            
                    // Filter results based on search term
                    if (!empty($searchTerm)) {
                        $searchTerm = strtolower($searchTerm);
                        $results = array_filter($results, function($event) use ($searchTerm) {
                            return  strpos(strtolower($event->eventName), $searchTerm) !== false ||
                                    strpos(strtolower($event->eventLocation), $searchTerm) !== false;
                        });
                    }

                    // Create HTML for search results
                    $html = '
                        <div class = "main-container" style = "margin: 0; width: 100%;">
                            <span class="heading">Event Search Results</span>
                            <span class = "subHeading">Explore Curated Activities Tailored to Your Interests by Trusted Local Hosts</span>
                    ';

                    $counter = 0;
            
                    foreach ($results as $event) {
                        if ($counter % 3 == 0) {
                            $html .= '<div class="events-grid">';
                        }

                        $animationDelay = ($counter % 3) * 0.2;
                
                        $html .= '

                        <div class="event-container new-event" style="animation-delay:' . $animationDelay . 's;">

                            <div class="event-banner">
                                <img src="' . IMAGES . '/events/eventThumbnailPics/' . htmlspecialchars($event->eventThumnailPic) . '" alt="' . htmlspecialchars($event->eventName) . '">
                            </div>

                            <div class="event-name">' . htmlspecialchars($event->eventName) . '</div>

                            <div class="dateAndLocation-container">

                                <div class="eventLocation-container">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>' . htmlspecialchars($event->eventLocation) . '</span>
                                </div>

                                <div class="eventDate-container">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span>' . htmlspecialchars($event->eventDate) . '</span>
                                </div>

                            </div>

                            <div class="btn-container">
                                <a href="' . ROOT . '/traveler/ViewParticularEvent/index/' . htmlspecialchars($event->event_Id) . '">
                                    <button class="btn">View Details</button>
                                </a>
                            </div>

                        </div>
                    
                        ';

                        $counter++;
                
                        if ($counter % 3 == 0 || $counter == count($results)) {
                            $html .= '</div>';
                        }
                    }

                    if (empty($results)) {
                        $html .= '
                
                        <div class="no-events-container">

                            <div class="no-events-content">

                                <div class="calendar-icon">
                                    <div class="calendar-top"></div>
                                    <div class="calendar-body">
                                        <div class="cross">×</div>
                                    </div>
                                </div>

                                <h3>No events found matching your search</h3>
                                <p class = "para">Try Searching with Different Keywords</p>
        
                            </div>

                        </div>
                
                        ';
                    }

                    // Return JSON response
                    header('Content-Type: application/json');
                    echo json_encode(['html' => $html]);
                    exit;
                }
            }

        }
    }