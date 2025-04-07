<?php 
    class RoomBookingModel{
        use Model;

        protected $table = 'room_booking';
        protected $allowedColumns = [
            'roomBooking_Id',
            'room_Id',
            'traveler_Id',
            'bookedDate',
            'checkInDate',
            'checkOutDate',
            'bookingStatus'
        ];

        public function checkRoomAvailability($room_Id, $checkInDate, $checkOutDate) {
            // Find any overlapping bookings
            $result = $this->where([
                'room_Id' => $room_Id,
                'bookingStatus' => 'Confirmed',
                'checkOutDate>=' => $checkInDate,  // Booking ends on or after requested check-in
                'checkInDate<=' => $checkOutDate   // Booking starts on or before requested check-out
            ]);
        
            // If no overlapping bookings found, room is available
            return empty($result);
        }
    }