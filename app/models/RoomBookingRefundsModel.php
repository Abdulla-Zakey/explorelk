<?php

    class RoomBookingRefundsModel{
        use Model;

        protected $table = 'room_booking_refunds';

        protected $allowedColumns = [
            'refund_Id',
            'cancellation_Id',
            'bank_detail_Id',
            'refund_amount',
            'refund_status',
            'refund_initiated_date'
        ];
    }