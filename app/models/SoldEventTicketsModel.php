<?php

class SoldEventTicketsModel{

    use Model;

    protected $table = 'sold_event_tickets';

    public function insert_soldEventTickets($booking_Id, $eventTicketType_Id, $quantity){
        return $this->insert([
            'booking_Id' => $booking_Id,
            'eventTicketType_Id' => $eventTicketType_Id,
            'quantity' => $quantity
        ]);
    }

}