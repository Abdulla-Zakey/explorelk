<?php

    class TourBookingNotificationModel{
        use Model;

        protected $table = 'tour_booking_notifications';

        protected $allowedColumns = [
            'tour_booking_notification_Id',
            'notification_Id',
            'booking_Id',
        ];
    }