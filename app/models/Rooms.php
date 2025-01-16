<?php
    class Rooms {
        use Model;

        protected $table = 'room';
         public function insert_room($room_number,$room_description,$room_type,$room_price,)
         {
            $this->insert(['roomNumber'=>$room_number,'roomDescription'=>$room_description,'roomType'=>$room_type,'roomPrice'=>$room_price]);
         return true;
        }

        public function get_room(){
           $data = $this->selectALL();
            return $data;
        }

        public function update_room($id,$room_number, $room_description, $room_price){
            $success = $this->update(id: $id,data: [
                'roomNumber'=>$room_number,
                'roomDescription'=>$room_description,
                'roomPrice'=>$room_price
            ]);
            return $success;}



        public function delete_room($id){
            $success = $this->delete(id: $id);
            return true;
        }
        }

    