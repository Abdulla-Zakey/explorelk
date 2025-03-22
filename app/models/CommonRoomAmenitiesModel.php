<?php
    class CommonRoomAmenitiesModel{
        use Model;
        protected $table = 'common_room_amenities';
        protected $allowedColumns = [
          'amenity_Id',
          'amenity_name',
          'icon_class'
        ];

        public function getAllAmenities(){
            $result = $this->selectAll();
            return $result;
        }

        public function getAmenityDetailsById($amenityId){
            $result = $this->first(['amenity_Id' => $amenityId]);
            return $result;
        }
    }