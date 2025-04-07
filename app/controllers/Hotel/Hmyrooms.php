<?php

class Hmyrooms  extends Controller {
    protected $roomTypeModel;

    public function __construct() {
        $this->roomTypeModel = new HotelRoomTypesModel();
    }

    // ** Read Room Types (index method) **
    public function index($hotel_id = null) {
       

        // Fetch room types for the specified hotel
        $roomTypes = $this->roomTypeModel->getHotelRoomTypesByHotelId(['hotel_id' => $_SESSION['hotel_id']]);
        $this->view('hotel/myrooms', $roomTypes);
       
         // Load the view to display room types
    }

    // ** Create Room Type **
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotel_id = $_POST['hotel_id'];
            $room_type_id = $_POST['room_type_id'];
            $customized_description = $_POST['customized_description'];
            $price_per_night = $_POST['price_per_night'];
            $max_occupancy = $_POST['max_occupancy'];
            $thumbnail_pic_path = $_FILES['thumbnail_pic']['name'] ?? null;

            // Handle file upload if necessary
            // move_uploaded_file(...);

            $this->roomTypeModel->insert_room_type($hotel_id, $room_type_id, $customized_description, $price_per_night, $max_occupancy, $thumbnail_pic_path);
            header('Location: /hmyrooms/index/' . $hotel_id); // Redirect to room types list for the hotel
            exit();
        }

        include 'views/room_type_create.php'; // Load the view to create a room type
    }

    // ** Update Room Type **
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room_type_id = $_POST['room_type_id'];
            $customized_description = $_POST['customized_description'];
            $price_per_night = $_POST['price_per_night'];
            $max_occupancy = $_POST['max_occupancy'];
            $thumbnail_pic_path = $_FILES['thumbnail_pic']['name'] ?? null;

            // Handle file upload if necessary
            // move_uploaded_file(...);

            $this->roomTypeModel->update_room_type($id, $room_type_id, $customized_description, $price_per_night, $max_occupancy, $thumbnail_pic_path);
            header('Location: /hmyrooms/index/' . $hotel_id); // Redirect to room types list for the hotel
            exit();
        } else {
            $roomType = $this->roomTypeModel->get_room_types_by_hotel($id);
            include 'views/room_type_edit.php'; // Load the edit view
        }
    }

    // ** Delete Room Type **
    public function delete($id) {
        $this->roomTypeModel->delete_room_type($id);
        header('Location: /hmyrooms/index/' . $hotel_id); // Redirect to room types list for the hotel
        exit();
    }
}