<?php

    class RoomBookingRefundBankDetails{

        use Model;

        protected $table = 'room_booking_refund_bank_details';

        protected $allowedColumns = [
            'bank_detail_Id',
            'traveler_Id',
            'account_number',
            'account_holder_name',
            'bank_name',
            'bank_branch'
        ];
    }