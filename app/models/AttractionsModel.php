<?php

class AttractionsModel {
    
    use Model;

    protected $table = 'attractions';
    protected $allowedColumns = [
        'district_id',
        'attraction_name',
        'description_paragraph1',
        'description_paragraph2',
        'description_paragraph3',
        'iframe'
    ];

    public function getAttractionByNameAndDistrict($attractionName, $districtId) {
        return $this->first([
            'district_id' => $districtId,
            'attraction_name' => $attractionName
        ]);
    }

    public function getByDistrict($district_Id){
        return $this->where(['district_id' => $district_Id]);
    }
}
