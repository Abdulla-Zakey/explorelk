<?php 

    class ViewEventBooking extends Controller{

        private $eventModel;
        private $eventOrganizerModel;
        private $eventBookingModel;
        private $eventTicketTypesModel;
        private $soldEventTicketsModel;
        private $eventCancellationModel;
        private $eventRefundsModel;

        public function __construct(){
            $this->eventModel = new Event();
            $this->eventOrganizerModel = new EventOrganizer();
            $this->eventBookingModel = new EventBookingModel();
            $this->eventTicketTypesModel = new EventTicketType();
            $this->soldEventTicketsModel = new SoldEventTicketsModel();
            $this->eventCancellationModel = new EventCancellationsModel();
            $this->eventRefundsModel = new EventRefundsModel();
        }

        public function index($bookingId){
            $booking = $this->eventBookingModel->first(['booking_Id' => $bookingId]);
            $event = $this->eventModel->first(['event_Id' => $booking->event_Id]);
            $eventOrganizer = $this->eventOrganizerModel->first(['organizer_Id' => $event->organizer_Id]);

            if($event->eventStatus == 'cancelled'){
                $cancellation = $this->eventCancellationModel->first(['event_Id' => $booking->event_Id]);
                $refund = $this->eventRefundsModel->first(['booking_Id' => $bookingId]);

                if($cancellation && $refund){
                    $data['cancellationInfo'] = $cancellation;
                    $data['refundInfo'] = $refund;
                }
            }

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
                            'ticketTypeQuantity' => $purchasedTicketTypeQuantity
                        ];
                        
                    }
                }
            }

            $purchasedEventTicketTypes = $booking->purchasedTicketTypes;
            unset($booking->purchasedTicketTypes);

            $data = [
                'eventInfo' => $event,
                'eventOrganizerInfo' => $eventOrganizer,
                'bookingInfo' => $booking,
                'purchasedEventTicketTypes' => $purchasedEventTicketTypes
            ];

            

            $this->view('traveler/viewEventBooking', $data);
        }

    }