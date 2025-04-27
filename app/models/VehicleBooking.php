<?php
class VehicleBooking
{
    use Model;

    protected $table = 'vehicle_bookings';

    protected $allowedColumns = [
        'vehicleType_Id',
        'travelprovider_Id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_nic',
        'start_date',
        'end_date',
        'vehicle_count',
        'total_amount',
        'special_requests',
        'booking_source',
        'payment_status',
        'advance_amount',
        'created_at'
    ];
}