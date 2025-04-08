<?php
    class RoomsModel{

        use Model;
        
        protected $table = 'rooms';
        
        protected $allowedColumns = [
            'room_Id',
            'hotel_roomType_Id',
            'room_number'
        ];

        public function getRoomsByType($hotelRoomTypeId){
            $result = $this->where(['hotel_roomType_Id' => $hotelRoomTypeId]);
            return $result;
        }

    }