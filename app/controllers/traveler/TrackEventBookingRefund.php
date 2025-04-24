<?php

    class TrackEventBookingRefund extends Controller{
        private $eventModel;        
        private $eventBookingModel;
        private $eventCancellationModel;
        private $eventRefundsModel;

        public function __construct(){
            $this->eventModel = new Event();
            $this->eventBookingModel = new EventBookingModel();
            $this->eventCancellationModel = new EventCancellationsModel();
            $this->eventRefundsModel = new EventRefundsModel();
        }

        public function index($bookingId){
            $booking = $this->eventBookingModel->first(['booking_Id' => $bookingId]);
            $event = $this->eventModel->first(['event_Id' => $booking->event_Id]);
            $cancellation = $this->eventCancellationModel->first(['event_Id' => $booking->event_Id]);
            $refund = $this->eventRefundsModel->first(['booking_Id' => $bookingId]);

            $data = [
                'bookingData' => $booking,
                'eventData' => $event,
                'cancellationData' => $cancellation,
                'refundData' => $refund
            ];

            $this->view('traveler/trackEventBookingRefund', $data);
 
        }
    }