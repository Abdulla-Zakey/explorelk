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

    // Method to edit trip
    public function editTrip($trip_Id)
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

        // Handle form submission for editing
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Prepare updated trip data
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

            // Validate trip data
            if ($tripModel->validate($data)) {
                // Update trip in database
                $result = $tripModel->update($trip_Id, $data, 'trip_Id');

                if ($result) {
                    // Fetch the updated trip to ensure we have the latest data
                    $updatedTrip = $tripModel->first(['trip_Id' => $trip_Id, 'traveler_Id' => $_SESSION['traveler_id']]);

                    // Redirect to trips list with success message
                    header("Location: " . ROOT . "/traveler/MyTrips?success=Trip updated successfully");
                    exit();
                } else {
                    // Handle update error
                    $data['error'] = "Failed to update trip. Please try again.";
                    $data['trip'] = $trip;
                    $this->view('traveler/viewTrip', $data);
                }
            } else {
                // Validation failed
                $data['errors'] = $tripModel->errors;
                $data['trip'] = $trip;
                $this->view('traveler/viewTrip', $data);
            }
        } else {
            // Load view trip view with existing trip data
            $data = [
                'trip' => $trip
            ];
            $this->view('traveler/viewTrip', $data);
        }
    }
}