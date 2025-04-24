<?php 

    class HotelCommissionsModel{
        use Model;

        protected $table = 'hotel_commissions';

        protected $allowedColumns = [
            'commission_Id',
            'room_booking_Id',
            'hotel_Id',
            'batch_Id',
            'total_amount',
            'commission_rate',
            'commission_amount',
            'is_applicable_for_commission',
            'if_not_applicable_reason',
            'created_at'
        ];
        
    }