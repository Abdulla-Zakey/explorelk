<?php

class MyBookings extends Controller{

    // Accommodation booking related models
    private $roomBookingFinalModel;
    private $hotelModel;
    private $hotelPicsModel;
    private $roomBookingCancellationModel;
    private $hotelCommissionsModel;

    // This models for generate notifications 
    private $notificationsModel;
    private $accommodationBookingNotificationsModel;
    
    // Event booking related Models
    private $eventModel;
    private $eventBookingModel;
    private $eventTicketTypesModel;
    private $soldEventTicketsModel;

    //Tour booking related models
    private $tourBookingModel;
    private $tourPackageModel;
    

    public function __construct(){
        // Accommodation booking related models
        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();
        $this->hotelPicsModel = new HotelPicsModel();
        $this->roomBookingCancellationModel = new RoomBookingCancellationsModel();
        $this->hotelCommissionsModel = new HotelCommissionsModel();
        
        // This models for generate notifications 
        $this->notificationsModel = new NotificationsModel();
        $this->accommodationBookingNotificationsModel = new AccommodationBookingNotifications();
        
        // Event booking related Models
        $this->eventModel = new Event();
        $this->eventBookingModel = new EventBookingModel();
        $this->eventTicketTypesModel = new EventTicketType();
        $this->soldEventTicketsModel = new SoldEventTicketsModel();

        ////Tour booking related models
        $this->tourBookingModel = new TourBookings();
        $this->tourPackageModel = new TourPackageModel();
    }

    public function index(){

        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        
        $data['archivedBookingsData'] = [];
        $data['accommodationBookingsData'] = [];
        $data['eventBookingsData'] = [];
        $data['tourBookingsData'] = [];
        $data['vehicleBookingsData'] = [];

        $accommodationBookings = $this->roomBookingFinalModel->getRoomBookingByTravelerId($_SESSION['traveler_id']);

        foreach($accommodationBookings as $booking){
            
            $hotelInfo = $this->hotelModel->getDetailsByHotelId($booking->hotel_Id);
            $hotelPics = $this->hotelPicsModel->getImagesByHotelId($booking->hotel_Id);
            $hotelPic = $hotelPics[0]->image_path;

            $refundStatus = "";
            if($booking->booking_status == "Cancelled"){
                $cancellationRecord = $this->roomBookingCancellationModel->first(['room_booking_Id' => $booking->room_booking_Id]);
                $refundStatus = $cancellationRecord->refund_status;
            }
            
            // Create a complete booking record with all related data
            $bookingData = $booking;
            $bookingData->hotelInfo = $hotelInfo;
            $bookingData->hotelPic = $hotelPic;
            $bookingData->refund_status = $refundStatus;

            if($bookingData->is_archived == 1){
                $data['archivedBookingsData'][] = $bookingData;
            }
            else{
                 // Add this complete booking to our data array
                $data['accommodationBookingsData'][] = $bookingData;
            }
            
        }

        //Event related
        $eventBookings = $this->eventBookingModel->getEventBookingsByTravelerId($_SESSION['traveler_id']);

        if($eventBookings){
           
            foreach($eventBookings as $booking){

                $bookingData = $booking;
                
                $eventInfo = $this->eventModel->getAnEventByEventId( $booking->event_Id);
                $bookingData->eventInfo = $eventInfo;

                $data['eventBookingsData'][] = $bookingData;
                
            }
        }

       //Tour related
        $tourBookings = $this->tourBookingModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
        if($tourBookings){

            foreach($tourBookings as $booking){

                $bookingData = $booking;
                
                $tourInfo = $this->tourPackageModel->first( ['package_id' => $booking->package_id]);
                $bookingData->tourInfo = $eventInfo;

                $data['tourBookingsData'][] = $bookingData;
                
            }

        }


        $notifications = $this->notificationsModel->getNotifications('traveler', $_SESSION['traveler_id']);
        $unreadNotifications = 0;

        foreach ($notifications as $notification) {
            if($notification->is_read == 0){
                $unreadNotifications++;
            }
        }

        $data['unreadNotifications'] = $unreadNotifications;

        

        $this->view('traveler/myBookings', $data);
    }

    public function deleteAccommodationBooking($bookingId){
        $booking = $this->roomBookingFinalModel->first(['room_booking_Id' => $bookingId]);
        if ($booking) {
            if($booking->traveler_Id == $_SESSION['traveler_id']) {

                $accommodationBookingNotification = $this->accommodationBookingNotificationsModel->first(['room_booking_Id' => $bookingId]);
                $notificationId = $accommodationBookingNotification->notification_Id;

                $result = $this->roomBookingFinalModel->delete($bookingId, 'room_booking_Id');

                if($result){

                    $result = $this->hotelCommissionsModel->delete($bookingId, 'room_booking_Id');
                    
                    if($result){
                        
                        $result = $this->notificationsModel->delete($notificationId, 'notification_Id');

                        if($result){
                            redirect('traveler/MyBookings?success=booking_request_deleted&booking_id=' . $bookingId);
                        }
                        else{
                            redirect('traveler/MyBookings?error=booking_request_deleted_but_failed_to_delete_notification&booking_id=' . $bookingId);
                        }
                        
                    }
                    else{
                        redirect('traveler/MyBookings?error=booking_request_deleted_but_failed_to_delete_commission_record&booking_id=' . $bookingId);
                    }
                    
                }
                else{
                    redirect('traveler/MyBookings?error=booking_request_deletion_failed&booking_id=' . $bookingId);
                }
            }
            else{
                redirect('traveler/MyBookings?error=booking_request_does_not_belongs_to_the_current_user&booking_id=' . $bookingId);
            }
        }
        else{
            redirect('traveler/MyBookings?error=booking_request_not_found&booking_id=' . $bookingId);
        }
    }

    public function archiveAccommodationBooking($bookingId){
        $result = $this->roomBookingFinalModel->update($bookingId, ['is_archived' => 1], 'room_booking_Id');
        if($result){
            header("Location: " . ROOT . "/traveler/MyBookings?success=booking_archived_successfully");
        }
        else{
            header("Location: " . ROOT . "/traveler/MyBookings?error=failed_to_archive_booking");
        }
    }

    public function unarchiveAccommodationBooking($bookingId){
        $result = $this->roomBookingFinalModel->update($bookingId, ['is_archived' => 0], 'room_booking_Id');
        if($result){
            header("Location: " . ROOT . "/traveler/MyBookings?success=booking_unarchived_successfully");
        }
        else{
            header("Location: " . ROOT . "/traveler/MyBookings?error=failed_to_unarchive_booking");
        }
    }

   
}