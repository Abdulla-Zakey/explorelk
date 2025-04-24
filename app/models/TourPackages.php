<?php

class TourPackages
{
    use Model;

    protected $table = 'tourpackages';

    protected $allowedColumns = [
        'package_id',
        'guide_id',
        'name',
        'location',
        'duration_days',
        'group_size',
        'package_price',
        'languages',
        'description',
        'tags',
        'inclusions',
        'exclusions',
        'created_at',
        'updated_at',
    ];

    public function getPackageId(){
        return $this->package_id;
    }
}