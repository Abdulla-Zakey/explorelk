<?php

class ThingsToDoModel {
    
    use Model;

    protected $table = 'things_to_do';
    protected $allowedColumns = [
        'attraction_id',
        'icon_class',
        'activity_name',
        'activity_description'
    ];

    public function getThingsToDo($attraction_id) {
        return $this->where([
            'attraction_id' => $attraction_id
        ]);
    }
}