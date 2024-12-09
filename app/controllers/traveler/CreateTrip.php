<?php

class CreateTrip extends Controller
{

    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $trip = new Trip();

            // Prepare trip data
            $data = [
                'traveler_Id' => $_SESSION['traveler_id'],
                'tripName' => htmlspecialchars(trim($_POST['tripName'])),
                'startingLocation' => htmlspecialchars(trim($_POST['startLocation'])),
                'destination' => htmlspecialchars(trim($_POST['destination'])),
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'departureTime' => $_POST['departureTime'],
                'transportationMode' => $_POST['transportation'],
                'numberOfTravelers' => !empty($_POST['travelersCount']) ? intval($_POST['travelersCount']) : null,
                'budgetPerPerson' => !empty($_POST['budgetPerPerson']) ? floatval($_POST['budgetPerPerson']) : null
            ];

            // Validate trip data
            if ($trip->validate($data)) {
                // Insert trip into database
                $result = $trip->insert($data);

                if ($result) {
                    // Redirect to trips list or trip details
                    header("Location: " . ROOT . "/traveler/MyTrips");
                    exit();
                } else {
                    // Handle insertion error
                    $data['error'] = "Failed to create trip. Please try again.";
                    $this->view('traveler/createTrip', $data);
                }
            } else {
                // Validation failed
                $data['errors'] = $trip->errors;
                $this->view('traveler/createTrip', $data);
            }
        } else {
            // Load create trip view
            $this->view('traveler/createTrip');
        }
    }
}