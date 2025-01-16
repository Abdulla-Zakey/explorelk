<?php 

class EventTicketType{

    use Model;

    protected $table = "event_ticket_type";

    protected $allowedColumns = [
        'event_Id',
        'ticketTypeName',
        'ticketTypeDescription',
        'pricePerTicket',
        'totalTickets',
        'availableTickets'
    ];

    public function getTicketInfoByEventId($event_Id){
        $data = $this->where(['event_Id' => $event_Id]);
        return $data;
    }

    

}