<?php

class TourPackageActivities
{
    use Model;

    protected $table = 'tourpackage_activities';

    protected $allowedColumns = [
        'activity_id',
        'day_id',
        'title',
        'description',
        'activity_time',
    ];
}