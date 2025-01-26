<?php

    class AdvancedHotelModel{

        use Model;

        protected $table = 'advanced_hotel_details';

        protected $allowedColumns = [
            'detail_Id',
            'hotel_Id',
            'latitude',
            'longtitude',
            'description_para1',
            'description_para2',
            'description_para3'
        ];

        public function getDetailsByHotelId($hotel_Id){
            $result = $this->where(['hotel_Id' => $hotel_Id]);
            return $result;

        }
    }