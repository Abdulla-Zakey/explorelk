<?php 

    class EventCancellationsModel{
        use Model;

        protected $table = 'event_cancellations';

        protected $allowedColumns = [
            'cancellation_Id',
            'event_Id',
            'organizer_Id',
            'cancellation_reason',
            'cancellation_date',
            'admin_approval_status'
        ];

    }