<?php

    class ViewParticularEvent extends Controller{

        

        public function index($event_Id){

            $eventModel = new Event();
            $eventTicketTypeModel = new EventTicketType();
            $termsAndConditionsModel = new EventTermsAndConds();
            
            
            $data['eventDetails'] = $eventModel->getAnEventByEventId($event_Id);

            $data['ticketsDetails'] = $eventTicketTypeModel->getTicketInfoByEventId($event_Id);

            $data['termsAndConditions'] = $termsAndConditionsModel->getTermsAndConditions();

            // Store event details in session before displaying the view
            $_SESSION['current_event'] = [
                'eventId' => $event_Id,
                'eventName' => $data['eventDetails'][0]->eventName,
                'eventDate' => $data['eventDetails'][0]->eventDate,
                'eventStartTime' => $data['eventDetails'][0]->eventStartTime,
                'eventLocation' => $data['eventDetails'][0]->eventLocation
            ];
            
            $this->view('traveler/particularEvent', $data);
            
        }


    }
