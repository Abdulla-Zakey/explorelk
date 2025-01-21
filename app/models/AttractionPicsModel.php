<?php

class AttractionPicsModel {
    
    use Model;

    protected $table = 'attraction_pics';
    protected $allowedColumns = [
        'attraction_id',
        'image_location'
    ];

    public function getPicturesForAttraction($attraction_id) {
        return $this->where([
            'attraction_id' => $attraction_id
        ]);
    }
}
