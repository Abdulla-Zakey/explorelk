<?php

    class HotelGuestsModel{
        
        use Model;
        protected $table = 'hotel_guests';
        protected $allowedColumns = [
            'guest_Id',
            'room_booking_Id',
            'guest_full_name',
            'guest_nic',
            'guest_email',
            'guest_mobile_num'
        ]; 

        public function getGuestByBookingId($bookingId){
            $result = $this->first(['room_booking_Id' => $bookingId]);
            return $result;
        }
    }
