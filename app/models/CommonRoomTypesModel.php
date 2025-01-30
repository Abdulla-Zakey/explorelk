<?php

    class CommonRoomTypesModel{
        use Model;

        protected $table = 'common_room_types';

        protected $allowedColumns = [
            'roomType_Id',
            'roomType_name',
            'standard_description',
            'defaultImage_path'
        ];

        public function getGenericRoomTypeDetailsByTypeId($roomType_Id){
            $result = $this->first(['roomType_Id' => $roomType_Id]);
            return $result;
        }

        public function getAllRoomTypes(){
            $result = $this->selectALL();
            return $result;
        }
    }