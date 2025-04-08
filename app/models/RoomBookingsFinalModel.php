<?php

class RoomBookingsFinalModel {
    use Model;

    protected $table = 'room_bookings_final';

    protected $allowedColumns = [
        'room_booking_Id',
        'traveler_Id',
        'hotel_Id',
        'hotel_roomType_Id',
        'check_in',
        'check_out',
        'total_rooms',
        'special_requests',
        'total_amount',
        'advance_payment_amount',
        'paid_advance_payment_amount',
        'advance_payment_status',
        'advance_payment_paid_date',
        'booking_status',
        'requested_date',
        'accepted_date',
        'advance_payment_deadline'
    ];

    public function getRoomBookingByTravelerId($traveler_id){
        $result = $this->where(
                            ['traveler_Id' => $traveler_id],   
                         [
                                    'order_by' => 'check_in',
                                    'order_type' => 'DESC',
                                    'limit' => 5
                                  ]
                            );
        return $result;
    }

    public function getRoomBookingByBookingId($booking_id){
        $result = $this->first(['room_booking_Id' => $booking_id]);
        return $result;
    }
}