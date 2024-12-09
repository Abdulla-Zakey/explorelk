<?php

include '../app/models/Event.php';   

class Eocreateevent extends Controller{
         private $model;

        public function index($a = '', $b = '', $c = ''){

            $this->view('eventorganizer/eocreateevent');
        }

        public function __construct(){
            $this->model = new Event();
        }


        public function create(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                print_r($_POST);
                $eventName = $_POST['eventName'];
                $eventDescription = $_POST['eventDescription'];
                $aboutEvent = $_POST['aboutEvent'];
                $eventDate = $_POST['eventDate'];
                $eventStartTime = $_POST['eventStartTime'];
                $eventEndTime = $_POST['eventEndTime'];
                $eventLocation = $_POST['eventLocation'];
                $ticketCount = $_POST['ticketCount'];
                $ticketPrice = $_POST['ticketPrice'];
                $this->model->insert_event(1,$eventName,$eventDescription,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation,$ticketCount,$ticketPrice);
                redirect("eventorganizer/Eoevents");
        }
    }
}




    