<?php

    class RoomBookingCancellationsModel{
        use Model;
        protected $table = 'room_booking_cancellations';
        protected $allowedColumns = [
            'cancellation_Id',
            'room_booking_Id',
            'cancellation_reason',
            'cancellation_date',
            'refund_amount',
            'refund_status'
        ];
    }