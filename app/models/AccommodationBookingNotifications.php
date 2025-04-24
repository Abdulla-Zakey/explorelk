<?php

    class AccommodationBookingNotifications{
        use Model;

        protected $table = 'accommodation_booking_notifications';

        protected $allowedColumns = [
            'accommodation_booking_notification_Id',
            'notification_Id',
            'room_booking_Id',
        ];
     
    }