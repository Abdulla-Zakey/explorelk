<?php

    class HotelPicsModel{

        use Model;

        protected $table = 'hotel_pics';

        protected $allowedColumns = [
            'hotel_Id',
            'image_path'
        ];

        public function getImagesByHotelId($hotel_Id){
            $result = $this->where(['hotel_Id' => $hotel_Id]);
            return $result;
        }


    }