<?php

class DistrictsPicsModel {
    
    use Model;

    protected $table = 'district_pics';
    protected $allowedColumns = [
        'district_id',
        'image_location'
    ];

    public function getPicturesForDistrict($district_id) {
        return $this->where([
            'district_id' => $district_id
        ]);
        
    }
}