<?php

    class EventBookingNotificationModel{
        use Model;

        protected $table = 'event_booking_notifications';

        protected $allowedColumns = [
            'event_booking_notification_Id',
            'notification_Id',
            'booking_Id',
        ];
    }