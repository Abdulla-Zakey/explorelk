<?php 
    class TripDaysModel{
        use Model;

        protected $table = 'trip_days';
        
        protected $allowedColumn = [
            'day_Id',
            'trip_Id',
            'day_number'
        ];
    }