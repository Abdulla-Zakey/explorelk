<?php

    class EventRefundsModel{
        use Model;
        protected $table = 'event_refunds';

        protected $allowedColumns = [
            'refund_Id',
            'booking_Id',
            'cancellation_Id',
            'traveler_Id',
            'refund_amount',
            'refund_status',
            'refund_initiated_date'
        ];
    }