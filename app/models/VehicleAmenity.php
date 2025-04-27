<?php

class VehicleAmenity
{
    use Model;

    protected $table = 'vehicle_amenities';

    protected $allowedColumns = [
        'amenity_name',
        'icon_class',
        'created_at'
    ];
}