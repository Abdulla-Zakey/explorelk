<?php

class Notifications extends Controller
{

    private $notificationsModel;

    //for hotels related
    private $accommodationBookingNotificationsModel;
    private $roomBookingFinalModel;
    private $hotelModel;

    // For event related
    private $eventBookingNotificationsModel;
    private $eventBookingModel;
    private $eventModel;
    private $eventOrganizerModel;

    //tour gudie related
    private $tourBookingNotificationModel;
    private $tourBookingModel;
    private $tourPackagesModel;
    private $tourGuideModel;

    public function __construct()
    {
        $this->notificationsModel = new NotificationsModel();
        $this->accommodationBookingNotificationsModel = new AccommodationBookingNotifications();
        $this->roomBookingFinalModel = new RoomBookingsFinalModel();
        $this->hotelModel = new Hotel();

        $this->eventBookingNotificationsModel =  new EventBookingNotificationModel();
        $this->eventBookingModel = new EventBookingModel();
        $this->eventModel = new Event();
        $this->eventOrganizerModel = new Eventorganizer();

        $this->tourBookingNotificationModel = new TourBookingNotificationModel();
        $this->tourBookingModel = new TourBookings();
        $this->tourPackagesModel = new TourPackages;
        $this->tourGuideModel = new TourGuide_M();
        
    }

    public function index()
    {
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $recipientType = 'traveler';
        $recipientId = $_SESSION['traveler_id'];

        $data = [
            'todayNotifications' => [],
            'thisWeekNotifications' => [],
            'thisMonthNotifications' => [],
        ];

        $today = date('Y-m-d');
        $thisWeekStart = date('Y-m-d', strtotime('monday this week'));
        $thisWeekEnd = date('Y-m-d', strtotime('sunday this week'));
        $thisMonth = date('Y-m');

        $unreadNotifications = 0;
        $notifications = $this->notificationsModel->getNotifications($recipientType, $recipientId);

        foreach ($notifications as $notification) {
            $createdAt = date('Y-m-d', strtotime($notification->created_at));
            $createdMonth = date('Y-m', strtotime($notification->created_at));

            // Default: no profile pic
            $notification->profilePic = null;

            if ($notification->notification_type == 'accommodation_related') {
                
                $accommodationNotification = $this->accommodationBookingNotificationsModel->first([
                    'notification_Id' => $notification->notification_Id
                ]);

                if ($accommodationNotification) {
                    $bookingDetails = $this->roomBookingFinalModel->getRoomBookingByBookingId($accommodationNotification->room_booking_Id);
                    $hotelData = $this->hotelModel->getDetailsByHotelId($bookingDetails->hotel_Id);

                    if ($hotelData) {
                        $notification->profilePic = $hotelData->hotelLogo;
                    }
                }

                $notification->buttonIconClass = 'fa-solid fa-eye';
                $notification->buttonAction = 'View Booking';
                $notification->buttonHyperLink = ROOT . '/traveler/ViewAccommodationBooking/index/' . $accommodationNotification->room_booking_Id;
            }
            else if($notification->notification_type == 'event_related'){
                
                $eventNotification = $this->eventBookingNotificationsModel->first([
                    'notification_Id' => $notification->notification_Id
                ]);

                if ($eventNotification) {
                    $booking = $this->eventBookingModel->first(['booking_Id' => $eventNotification->booking_Id]);
                    $event = $this->eventModel->first(['event_Id' => $booking->event_Id]);
                    
                    $eventOrganizer= $this->eventOrganizerModel->first(['organizer_Id' => $event->organizer_Id]);

                    if ($eventOrganizer) {
                        $notification->profilePic = $eventOrganizer->company_logo;
                    }

                    $notification->buttonIconClass = 'fa-solid fa-eye';
                    $notification->buttonAction = 'View Booking';
                    $notification->buttonHyperLink = ROOT . '/traveler/ViewEventBooking/index/' . $eventNotification->booking_Id;

                }

            }
            else if($notification->notification_type == 'tourguide_related'){
                $tourNotification = $this->tourBookingNotificationModel->first([
                    'notification_Id' => $notification->notification_Id
                ]);

                if($tourNotification){
                    $booking = $this->tourBookingModel->first(['booking_id' => $tourNotification->booking_Id]);
                    $tourPackage =  $this->tourPackagesModel->first(['package_id' => $booking->package_id]);

                    $guide = $this->tourGuideModel->first(['guide_Id' => $tourPackage->guide_id]);

                    if( $guide){
                        $notification->profilePic = 'assets/images/tourGuide/tourGuideProfilePhotos/' . $guide->profilePhoto;
                    }

                    $notification->buttonIconClass = 'fa-solid fa-eye';
                    $notification->buttonAction = 'View Booking';
                    $notification->buttonHyperLink = ROOT . '/traveler/ViewEventBooking/index/' . $tourNotification->booking_Id;

                }
            }

            // Categorize into today, this week, or this month
            if ($createdAt == $today) {
                $data['todayNotifications'][] = $notification;
            } elseif ($createdAt >= $thisWeekStart && $createdAt <= $thisWeekEnd) {
                $data['thisWeekNotifications'][] = $notification;
            } elseif ($createdMonth == $thisMonth) {
                $data['thisMonthNotifications'][] = $notification;
            }

            if($notification->is_read == 0){
                $unreadNotifications++;
            }
        }

        $data['unreadNotifications'] = $unreadNotifications;

        $this->view('traveler/notifications', $data);
        // $this->view('traveler/temp', $data);

    }

    public function markAsRead($notificationId){
        $result = $this->notificationsModel->update($notificationId, ['is_read' => 1], 'notification_Id');
        if($result){
            header("Location: " . ROOT . "/traveler/Notifications?success=notification_marked_as_read_success");
            exit();
        }
        else{
            header("Location: " . ROOT . "/traveler/Notifications?error=failed_to_mark_notification_as_read");
            exit();
        }
    }

    public function markAllAsRead($recipientType, $recipientId){
        $notifications = $this->notificationsModel->getNotifications($recipientType, $recipientId);
        foreach($notifications as $notification){
            $result = $this->notificationsModel->update($notification->notification_Id, ['is_read' => 1], 'notification_Id');
            if(!$result){
                header("Location: " . ROOT . "/traveler/Notifications?error=failed_to_mark_notifications_as_read");
                exit();
            }
        }

        if($result){
            header("Location: " . ROOT . "/traveler/Notifications?success=all_notifications_marked_as_read");
            exit();
        }
    }
}
