<?php

class VehicleType
{
    use Model;

    protected $table = 'vehicle_types';

    protected $allowedColumns = [
        'travelprovider_Id',
        'vehicleType_name',
        'pricePer_day',
        'max_capacity',
        'customized_description',
        'standard_description',
        'total_vehicles',
        'image_path',
        'created_at'
    ];
}