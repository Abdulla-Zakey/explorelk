<?php

    class EventBookingCommissionModel{

        use Model;

        protected $table = 'event_booking_commission';
        protected $allowedColumns = [
            'commission_Id',
            'event_Id',
            'organizer_Id',
            'totalSalesAmount',
            'commissionPercentage',
            'commissionAmount',
            'payableAmount',
            'paymentStatus',
            'paymentDate',
            'createdDate',
            'lastUpdated'
        ];
    }