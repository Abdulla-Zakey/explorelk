<?php
    class RoomBookingController extends Controller{
       
        private $hotelRoomTypesModel;
        private $roomsModel;
        private $roomBookingModel;

        public function __construct() {
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->roomsModel = new RoomsModel();
            $this->roomBookingModel = new RoomBookingModel();
        }

        // public function checkAvailability($hotelRoomTypeId, $checkInDate, $checkOutDate) {
            // Get all rooms of this type
            // $rooms = $this->roomsModel->getRoomsByType($hotelRoomTypeId);

            // $availableRooms = [];
            // foreach ($rooms as $room) {
                // Check bookings for each room
        //         $existingBookings = $this->roomBookingModel->checkRoomAvailability(
        //             $room['room_Id'],
        //             $checkInDate,
        //             $checkOutDate
        //         );
            
        //         if ($existingBookings) {
        //             $availableRooms[] = $room;
        //         }
        //     }
        
        //     return [
        //         'available' => !empty($availableRooms),
        //         'total_rooms' => count($rooms),
        //         'available_rooms' => count($availableRooms),
        //         'booked_rooms' => count($rooms) - count($availableRooms),
        //         'available_room_details' => $availableRooms,
        //         'check_in' => $checkInDate,
        //         'check_out' => $checkOutDate
        //     ];
    
        // }

        // Modify your RoomBookingController.php to add this method
public function checkAvailability($hotelRoomTypeId, $checkInDate, $checkOutDate) {
    // Validate date format
    if (!strtotime($checkInDate) || !strtotime($checkOutDate)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid date format']);
        return;
    }

    // Get all rooms of this type
    $rooms = $this->roomsModel->getRoomsByType($hotelRoomTypeId);

    $availableRooms = [];
    foreach ($rooms as $room) {
        // Check bookings for each room
        $isAvailable = $this->roomBookingModel->checkRoomAvailability(
            $room->room_Id,
            $checkInDate,
            $checkOutDate
        );
    
        if ($isAvailable) {
            $availableRooms[] = $room;
        }
    }

    $result = [
        'available' => !empty($availableRooms),
        'total_rooms' => count($rooms),
        'available_rooms' => count($availableRooms),
        'booked_rooms' => count($rooms) - count($availableRooms),
        'available_room_details' => $availableRooms,
        'check_in' => $checkInDate,
        'check_out' => $checkOutDate
    ];

    header('Content-Type: application/json');
    echo json_encode($result);
}
    }