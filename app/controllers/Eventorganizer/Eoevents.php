<?php
include '../app/models/Event.php';   


    class Eoevents extends Controller{
        private $model;
        private $event = [];

        public function index($a = '', $b = '', $c = ''){

           
            $this->event=$this->model->getEventsByOrganizerId();
            $this->view('eventorganizer/eoevents',["eventsdata"=>$this->event]);
            
        }

        public function __construct(){
            $this->model = new Event();
        }
        

        public function updateEvent(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // print_r($_POST);
                $id = $_POST['id'];
                $eventName = $_POST['eventName'];
                $eventDescription = $_POST['eventDescription'];
                $aboutEvent = $_POST['aboutEvent'];
                $eventDate = $_POST['eventDate'];
                $eventStartTime = $_POST['eventStartTime'];
                $eventEndTime = $_POST['eventEndTime'];
                $eventLocation = $_POST['eventLocation'];
                $ticketCount = $_POST['ticketCount'];
                $ticketPrice = $_POST['ticketPrice'];
                $this->model->update_event($id,$eventName,$eventDescription,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation,$ticketCount,$ticketPrice);
                redirect("eventorganizer/Eoevents");
            }
        }

        
        public function delete_event(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST["id"];
                $success = $this->model->delete_event($id);
                redirect("eventorganizer/Eoevents");
            }
        }


    }


