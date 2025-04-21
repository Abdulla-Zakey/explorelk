<?php
class RoomBookingController extends Controller
{

    private $hotelRoomTypesModel;
    private $roomsModel;
    private $roomBookingsFinalModel;

    public function __construct()
    {
        $this->hotelRoomTypesModel = new HotelRoomTypesModel();
        $this->roomsModel = new RoomsModel();
        $this->roomBookingsFinalModel = new RoomBookingsFinalModel;
    }

    public function checkAvailability($hotelRoomTypeId, $checkInDate, $checkOutDate)
    {
        // Validate date format
        if (!strtotime($checkInDate) || !strtotime($checkOutDate)) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid date format']);
            return;
        }

        // Get all rooms of this type
        $rooms = $this->roomsModel->getRoomsByType($hotelRoomTypeId);
        $totalRooms = count($rooms);

        $confirmedBookings = $this->roomBookingsFinalModel->getConfirmedRoomBookingByHotelRoomType($hotelRoomTypeId, $checkInDate, $checkOutDate);
        $bookedRoomCount = 0;

        foreach($confirmedBookings as $confirmedBooking){
            $bookedRoomCount += $confirmedBooking->total_rooms;
        }

        $pendingBookings = $this->roomBookingsFinalModel->getPendingRoomBookingByHotelRoomType($hotelRoomTypeId, $checkInDate, $checkOutDate);
        $pendingRoomCount = 0;

        foreach($pendingBookings as $pendingBooking){
            $pendingRoomCount += $pendingBooking->total_rooms;
        }

        $approvedBookings = $this->roomBookingsFinalModel->getApprovedRoomBookingByHotelRoomType($hotelRoomTypeId, $checkInDate, $checkOutDate);
        $approvedRoomCount = 0;

        foreach($approvedBookings as $approvedBooking){
            $approvedRoomCount += $approvedBooking->total_rooms;
        }

        $totalReservedRooms =  $pendingRoomCount + $approvedRoomCount;
        $availableRooms = $totalRooms - $totalReservedRooms - $bookedRoomCount;
        

        // $availableRooms = [];
        // foreach ($rooms as $room) {
        //     // Check bookings for each room
        //     $isAvailable = $this->roomBookingModel->checkRoomAvailability(
        //         $room->room_Id,
        //         $checkInDate,
        //         $checkOutDate
        //     );

        //     if ($isAvailable) {
        //         $availableRooms[] = $room;
        //     }
        // }

        $result = [
            'available' => !empty($availableRooms),
            'total_rooms' => $totalRooms,
            'available_rooms' => $availableRooms,
            'booked_rooms' => $bookedRoomCount,
            'reserved_rooms' => $totalReservedRooms,
            'check_in' => $checkInDate,
            'check_out' => $checkOutDate
        ];

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}