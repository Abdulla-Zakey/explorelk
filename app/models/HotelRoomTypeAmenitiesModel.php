<?php
    class HotelRoomTypeAmenitiesModel{
        use Model;
        protected $table = 'hotel_room_type_amenities';

        protected $allowedColumns = [
            'hotelRoomTypeAmenitie_Id',
            'hotelRoomType_Id',
            'amenity_Id'
        ];

        public function getRoomTypeAmenities($hotelRoomTypeId){
            $result = $this->where(['hotelRoomType_Id' => $hotelRoomTypeId]);
            return $result;
        }
    }