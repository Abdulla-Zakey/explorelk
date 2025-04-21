<?php

    class HotelReviewsModel{

        use Model;
        protected $table = 'hotel_reviews';

        protected $allowedColumns = [
            'review_Id',
            'hotel_Id',
            'traveler_Id',
            'room_booking_Id',
            'rating',
            'review_text',
            'created_at'
        ];

    }