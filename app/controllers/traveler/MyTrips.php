<?php

class MyTrips extends Controller
{

    public function index()
    {
        //session_start();

        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Create a new Trip model instance
        $tripModel = new Trip();

        /* // Debug: Print the traveler ID
        echo "Traveler ID: " . $_SESSION['traveler_id'] . "<br>"; */

        // Fetch trips for the logged-in traveler
        $trips = $tripModel->where(['traveler_Id' => $_SESSION['traveler_id']]);

        // Debug: Print the trips
        //echo "Trips found: ";
        //var_dump($trips);

        // Ensure $data is always an array
        $data = [
            'trips' => $trips ?? []
        ];

        // Load the myTrips view with trip data
        //var_dump($data);
        $this->view('traveler/myTrips', $data);
    }

    // Method to view a specific trip details
    public function viewTrip($trip_Id)
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $tripModel = new Trip();

        // Fetch the specific trip
        $trip = $tripModel->first(['trip_Id' => $trip_Id, 'traveler_Id' => $_SESSION['traveler_id']]);

        if (!$trip) {
            // Redirect if trip not found or doesn't belong to the user
            header("Location: " . ROOT . "/traveler/MyTrips");
            exit();
        }

        $data = [
            'trip' => $trip
        ];

        $this->view('traveler/viewTrip', $data);
    }

    // Method to delete a trip
    public function deleteTrip($trip_Id)
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $tripModel = new Trip();

        // Attempt to delete the trip
        $result = $tripModel->delete($trip_Id, 'trip_Id', [
            'traveler_Id' => $_SESSION['traveler_id']
        ],);

        if ($result) {
            // Redirect with success message
            header("Location: " . ROOT . "/traveler/MyTrips?success=Trip deleted successfully");
        } else {
            // Redirect with error message
            header("Location: " . ROOT . "/traveler/MyTrips?error=Failed to delete trip");
        }
        exit();
    }

    public function editTrip($trip_Id)
    {
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $tripModel = new Trip();
        $trip = $tripModel->first(['trip_Id' => $trip_Id, 'traveler_Id' => $_SESSION['traveler_id']]);

        if (!$trip) {
            header("Location: " . ROOT . "/traveler/MyTrips");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'tripName' => htmlspecialchars(trim($_POST['tripName'])),
                'startingLocation' => htmlspecialchars(trim($_POST['startLocation'])),
                'destination' => htmlspecialchars(trim($_POST['destination'])),
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'departureTime' => $_POST['departureTime'],
                'transportationMode' => $_POST['transportation'] ?? $trip->transportationMode,
                'numberOfTravelers' => !empty($_POST['travelersCount']) ? intval($_POST['travelersCount']) : null,
                'budgetPerPerson' => !empty($_POST['budgetPerPerson']) ? floatval($_POST['budgetPerPerson']) : null
            ];

            if ($tripModel->validate($data)) {
                $result = $tripModel->update($trip_Id, $data, 'trip_Id');
                
                if ($result) {
                    header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id . "?success=Trip Updated Successfully!");
                    exit();
                } else {
                    header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id . "?error=Failed to Update Trip");
                    exit();
                }
            } else {
                $errors = $tripModel->errors;
                header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id . "?error=" . urlencode(implode(', ', $errors)));
                exit();
            }
        }

        $this->view('traveler/viewTrip', ['trip' => $trip]);
    }
}
