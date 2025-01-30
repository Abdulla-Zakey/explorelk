<?php

    class HotelRoomTypesModel{
        use Model;

        protected $table = 'hotel_room_types';

        protected $allowedColumns = [
            'hotel_roomType_Id',
            'hotel_Id',
            'roomType_Id',
            'customized_description',
            'pricePer_night',
            'max_occupancy',
            'thumbnail_picPath'
        ];

        public function getHotelRoomTypesByHotelId($hotel_Id){
            $result = $this->where(['hotel_Id' => $hotel_Id]);
            return $result;
        }
    }