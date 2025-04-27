<?php
class VehicleTypeAmenity
{
    use Model;

    protected $table = 'vehicle_type_amenities';

    protected $allowedColumns = [
        'vehicleType_Id',
        'amenity_Id'
    ];
}