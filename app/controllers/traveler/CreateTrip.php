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

        $data = ['errors' => []];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $trip = new Trip();
            $tripDays = new TripDaysModel();
            $tripPlaces = new TripPlacesModel();

            // Remove ", Sri Lanka" from the start and end locations
            $startingLocation = htmlspecialchars(trim($_POST['startLocation']));
            $destination = htmlspecialchars(trim($_POST['destination']));

            $startingLocation = str_replace(", Sri Lanka", "", $startingLocation);
            $destination = str_replace(", Sri Lanka", "", $destination );

            // Prepare trip data
            $tripData = [
                'traveler_Id' => $_SESSION['traveler_id'],
                'tripName' => htmlspecialchars(trim($_POST['tripName'])),
                'startingLocation' => $startingLocation,
                'destination' => $destination,
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'departureTime' => $_POST['departureTime'],
                'transportationMode' => $_POST['transportation'],
                'numberOfTravelers' => !empty($_POST['travelersCount']) ? intval($_POST['travelersCount']) : null,
                'budgetPerPerson' => !empty($_POST['budgetPerPerson']) ? floatval($_POST['budgetPerPerson']) : null,
                'errors' => []
            ];

            // Validate trip data
            if ($trip->validate($tripData)) {
                // Insert trip and get the ID
                $tripId = $trip->insert($tripData);

                if ($tripId) {
                    // Process itinerary data
                    $success = $this->processItinerary($tripId, $_POST, $tripDays, $tripPlaces);

                    if ($success) {
                        // Redirect to trips list
                        header("Location: " . ROOT . "/traveler/MyTrips");
                        exit();
                    } else {
                        $data['error'] = "Failed to save itinerary details. Please try again.";
                        $this->view('traveler/createTrip', $data);
                    }
                } else {
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
            $this->view('traveler/createTrip', $data);
        }
    }

    /**Below function is used to process and save itinerary data*/
    private function processItinerary($tripId, $postData, $tripDays, $tripPlaces)
    {
        try {
            // Get the number of days from the form data
            $dayCount = $this->countDays($postData);

            for ($dayNumber = 1; $dayNumber <= $dayCount; $dayNumber++) {
                // Insert day record
                $dayData = [
                    'trip_Id' => $tripId,
                    'day_number' => $dayNumber
                ];
                
                $dayId = $tripDays->insert($dayData);

                if ($dayId) {
                    // Process places for this day
                    $placeCount = $this->countPlacesForDay($postData, $dayNumber);
                    
                    for ($placeOrder = 1; $placeOrder <= $placeCount; $placeOrder++) {
                        $placeKey = "day{$dayNumber}Place{$placeOrder}";
                        $arrivalTimeKey = "day{$dayNumber}Place{$placeOrder}ArrivalTime";
                        $departureTimeKey = "day{$dayNumber}Place{$placeOrder}DepartureTime";

                        // Only insert if place name exists
                        if (!empty($postData[$placeKey])) {

                            // Remove ", Sri Lanka" from the place name
                            $placeName = htmlspecialchars(trim($postData[$placeKey]));
                            $placeName = str_replace(", Sri Lanka", "", $placeName);

                            $placeData = [
                                'day_Id' => $dayId,
                                'place_name' => trim($placeName),
                                'place_order' => $placeOrder,
                                'arrival_time' => !empty($postData[$arrivalTimeKey]) ? $postData[$arrivalTimeKey] : null,
                                'departure_time' => !empty($postData[$departureTimeKey]) ? $postData[$departureTimeKey] : null
                            ];

                            if (!$tripPlaces->insert($placeData)) {
                                // If place insertion fails, return false
                                return false;
                            }
                        }
                    }
                } else {
                    // If day insertion fails, return false
                    return false;
                }
            }

            // If we got here, everything was inserted successfully
            return true;

        } catch (Exception $e) {
            // Log error if you have error logging
            // error_log($e->getMessage());
            return false;
        }
    }

    /**Count the number of days in the itinerary*/
    private function countDays($postData)
    {
        $dayCount = 1;
        while (isset($postData["day{$dayCount}Place1"])) {
            $dayCount++;
        }
        return $dayCount - 1;
    }

    /**Count the number of places for a specific day*/
    private function countPlacesForDay($postData, $dayNumber)
    {
        $placeCount = 1;
        while (isset($postData["day{$dayNumber}Place{$placeCount}"])) {
            $placeCount++;
        }
        return $placeCount - 1;
    }
}