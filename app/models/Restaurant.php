<?php 
    class Restaurant{
        use Model;
        protected $table = 'restaurant'; // Specify the table name
        protected $allowedColumns = [
            'restaurantName',
            'ownerName', 
            'restaurantEmail', 
            'restaurantPassword', 
            'restaurantMobileNum', 
            'restaurantAddress', 
            'district', 
            'province', 
            'BRNum', 
            'yearStarted'
        ];
    }