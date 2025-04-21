<?php

class TourPackageImages
{
    use Model;

    protected $table = 'tourpackage_images';

    protected $allowedColumns = [
        'image_id',
        'package_id',
        'image_path',
        'is_primary',
        'upload_date',
    ];
}