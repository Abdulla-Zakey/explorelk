<?php
class RegisteredTravelerHome extends Controller
{

    private $EventModel;

    public function __construct(){
        $this->EventModel = new Event();
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

        $topUpComingEvents = $this->EventModel->getUpcomingEvents();

        $data = [
            'userData' => $user,
            'eventData' => $topUpComingEvents
        ];

        // Pass user data to the view
        $this->view('traveler/registeredTravelerHome', $data);
    }

    
}
