<?php

    class RoomBookingRefundBankDetails{

        use Model;

        protected $table = 'room_booking_refund_bank_details';

        protected $allowedColumns = [
            'bank_detail_Id',
            'traveler_Id',
            'traveler_accountNum',
            'account_holder_name',
            'traveler_bankName',
            'traveler_bankBranch'
        ];
    }