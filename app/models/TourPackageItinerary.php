<?php

class TourPackageItinerary
{
    use Model;

    protected $table = 'tourpackage_itinerary';

    protected $allowedColumns = [
        'day_id',
        'package_id',
        'day_number',
    ];
}