<?php

    class ViewEventBookingTickets extends Controller{
        private $eventModel;        
        private $eventBookingModel;
        private $eventTicketTypesModel;
        private $soldEventTicketsModel;

        public function __construct(){
            $this->eventModel = new Event();
            $this->eventBookingModel = new EventBookingModel();
            $this->eventTicketTypesModel = new EventTicketType();
            $this->soldEventTicketsModel = new SoldEventTicketsModel();
        }

        public function index($bookingId){
            $booking = $this->eventBookingModel->first(['booking_Id' => $bookingId]);
           
            $event = $this->eventModel->first(['event_Id' => $booking->event_Id]);

            $eventTicketTypes = $this->eventTicketTypesModel->where(['event_Id' =>  $event->event_Id]);
            $purchasedEventTicketTypes = $this->soldEventTicketsModel->where(['booking_Id' => $booking->booking_Id]);

            foreach($eventTicketTypes as $eventTicketType){

                foreach($purchasedEventTicketTypes as $purchasedEventTicketType){

                    if($eventTicketType->eventTicketType_Id == $purchasedEventTicketType->eventTicketType_Id){
                        $purchasedTicketTypeName = $eventTicketType->ticketTypeName;
                        $purchasedTicketTypeDesc = $eventTicketType->ticketTypeDescription;
                        $purchasedTicketTypePrice = $eventTicketType->pricePerTicket;
                        $purchasedTicketTypeQuantity = $purchasedEventTicketType->quantity;

                        $booking->purchasedTicketTypes[] = [
                            'ticketTypeName' => $purchasedTicketTypeName,
                            'ticketTypeDesc' => $purchasedTicketTypeDesc,
                            'ticketTypePrice' => $purchasedTicketTypePrice,
                            'quantity' => $purchasedTicketTypeQuantity
                        ];
                        
                    }
                }
            }

            
            
            $data['ticket_info'] = [
                'event_name' => $event->eventName,
                'booking_id' => $booking->referenceNum,
                'purchase_date' => $booking->purchasedDate,
                'event_date' => $event->eventDate,
                'event_time' => $event->eventStartTime,
                'event_location' => $event->eventLocation,
                'total_amount' => $booking->totalAmount,
            ];

            

            $data['ticketTypes'] = $booking->purchasedTicketTypes;

            $data['qr_image'] = $booking->pathToQR;

            $data['success'] = true;  // I have set this because view checks this to verify is the payment is success

            

            $this->view('traveler/ticketPurchaseConfirmation', $data);
        }
    }