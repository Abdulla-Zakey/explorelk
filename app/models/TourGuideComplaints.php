<?php

class TourGuideComplaints{
    use Model;

    protected $table = 'tourguidecomplaints';

    protected $allowedColumns = [
        'complaint_id',
        'guide_id',
        'date_submitted',
        'subject',
        'message',
        'booking_id',
        'status',
        'resolution_note',
        'resolution_details',
        'date_resolved',
    ];
}