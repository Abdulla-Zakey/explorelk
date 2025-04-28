<?php
class RegisteredTravelerHome extends Controller
{
    private $eventModel;
    private $tourPackagesModel;

    // This model is to get unread notifications 
    private $notificationsModel;

    public function __construct(){
        $this->eventModel = new Event();
        $this->tourPackagesModel = new TourPackages();
        $this->notificationsModel = new NotificationsModel();

    }

    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Fetch user details
        $traveler = new Traveler();
        $user = $traveler->first(['traveler_Id' => $_SESSION['traveler_id']]);

        $topUpComingEvents = $this->eventModel->getUpcomingEvents();

        $data = [
            'userData' => $user,
            'eventData' => $topUpComingEvents
        ];

        $notifications = $this->notificationsModel->getNotifications('traveler', $_SESSION['traveler_id']);
        $unreadNotifications = 0;

        foreach ($notifications as $notification) {
            if($notification->is_read == 0){
                $unreadNotifications++;
            }
        }

        $data['unreadNotifications'] = $unreadNotifications;

        // Pass user data to the view
        $this->view('traveler/registeredTravelerHome', $data);
    }

    
}
