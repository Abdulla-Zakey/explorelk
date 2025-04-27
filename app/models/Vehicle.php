<?php
class Vehicle
{
    use Model;

    protected $table = 'vehicles';

    protected $allowedColumns = [
        'vehicleType_Id',
        'registration_number',
        'status',
        'created_at'
    ];
}