<?php

    class ViewTrip extends Controller {

        public function index($tripId = null) {
            // Ensure user is logged in and trip ID is provided
            // For now, using a hardcoded user ID - replace with actual session management
            // $userId = 100001; // This should come from the user's session
            $userId = $_SESSION['traveler_Id'];

            // Check if trip ID is provided
            if ($tripId === null) {
                // Redirect to MyTrips if no trip ID is provided
                header("Location: " . ROOT . "/traveler/MyTrips");
                exit();
            }

            // Instantiate the Trips model
            // $tripsModel = new Trips();
            $tripsModel = new Trip();


            // Fetch specific trip details
            // $tripDetails = $tripsModel->getTripById($tripId, $userId);
            $tripDetails = $tripsModel->first(['trip_Id' => $tripId, 'traveler_Id' => $userId]);

            // Check if trip exists and belongs to the user
            if (!$tripDetails) {
                // Redirect to MyTrips if trip not found or not authorized
                header("Location: " . ROOT . "/traveler/MyTrips");
                exit();
            }

            // Render the view with trip details
            $this->view('traveler/viewTrip', ['trip' => $tripDetails]);
        }
    }
