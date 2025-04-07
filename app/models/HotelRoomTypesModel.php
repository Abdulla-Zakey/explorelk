<?php

class HotelRoomTypesModel {
    use Model;

    protected $table = 'hotel_room_types';

    public function getHotelRoomTypesByHotelId($hotelId)
    {
        return $this->where('hotelId', []);
    }
    public function insert_room_type($hotel_id, $room_type_id, $customized_description, $price_per_night, $max_occupancy, $thumbnail_pic_path = null) {
        $this->insert([
            'hotel_Id' => $hotel_id,
            'roomType_Id' => $room_type_id,
            'customized_description' => $customized_description,
            'pricePer_night' => $price_per_night,
            'max_occupancy' => $max_occupancy,
            'thumbnail_picPath' => $thumbnail_pic_path
        ]);
        return true;
    }

    public function get_room_types_by_hotel($hotel_id) {
        $data = $this->where(['hotel_Id' => $hotel_id]);
        return $data;
    }

    public function update_room_type($id, $room_type_id, $customized_description, $price_per_night, $max_occupancy, $thumbnail_pic_path = null) {
        $success = $this->update($id, [
            'roomType_Id' => $room_type_id,
            'customized_description' => $customized_description,
            'pricePer_night' => $price_per_night,
            'max_occupancy' => $max_occupancy,
            'thumbnail_picPath' => $thumbnail_pic_path
        ]);
        return $success;
    }

    public function delete_room_type($id) {
        $success = $this->delete($id);
        return $success;
    }
}
