<?php

    class BookedRoomsModel{
        use Model;
        protected $table = 'booked_rooms';

        protected $allowedColumn = [
            'booked_room_Id',
            'room_booking_Id',
            'room_Id'
        ];

    }