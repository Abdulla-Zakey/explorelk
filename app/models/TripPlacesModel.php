<?php
    class TripPlacesModel{
        use Model;

        protected $table = 'trip_places';

        protected $allowedColumns = [
            'place_Id',
            'day_Id',
            'place_name',
            'place_order',
            'arrival_time',
            'departure_time'
        ];
    }