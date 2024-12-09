<?php
class RegisteredTravelerHome extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Fetch user details
        $traveler = new Traveler();
        $results = $traveler->where(['traveler_Id' => $_SESSION['traveler_id']]);

        // Check if user was found
        /* if (empty($results)) {
            // Logout user if no matching record found
            session_destroy();
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        } */

        // Get the first (and should be only) result
        $user = $results[0];

        // Pass user data to the view
        $this->view('traveler/registeredTravelerHome', $user);
    }
}