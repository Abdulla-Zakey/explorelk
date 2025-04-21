<?php

    class HotelPicsModel{

        use Model;

        protected $table = 'hotel_pics';

        protected $allowedColumns = [
            'hotel_pic_Id',
            'hotel_Id',
            'image_path'
        ];

        public function getImagesByHotelId($hotel_Id){
            $result = $this->where(
                [   
                    'hotel_Id' => $hotel_Id
                ],
                [
                    'order_by' => 'hotel_pic_Id',
                    'order_type' => 'ASC'
                ]
            );
            return $result;
        }


    }
