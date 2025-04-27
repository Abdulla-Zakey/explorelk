<?php

class TourBookings {
    use Model;

    protected $table = 'tourbookings';

    protected $allowedColumns = [
        'booking_id',
        'traveler_Id',
        'package_id',
        'guide_id',
        'booking_date',
        'tour_date',
        'start_time',
        'num_guests',
        'special_instructions',
        'status',
        'request_status',
        'total_price',
        'payment_status',
    ];
}