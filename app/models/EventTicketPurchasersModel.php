<?php

    class EventTicketPurchasersModel{

        use Model;

        protected $table = 'event_ticket_purchasers';

        protected $allowedColumns = [
           'purchaser_Id',
           'booking_Id',
           'fullName',
           'nic',
           'email',
           'mobileNum',
           'created_at'
        ];

    }