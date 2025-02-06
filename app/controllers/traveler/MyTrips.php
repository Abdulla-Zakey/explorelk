<?php

class MyTrips extends Controller
{

    public function index(){

        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        // Initialize models
        $tripModel = new Trip();
        $tripCollaboratorsModel = new TripCollaboratorsModel();
        $travelerModel = new Traveler();

        // Fetch user's own trips
        $userTrips = $tripModel->where(['traveler_Id' => $_SESSION['traveler_id']], ['order_by' => 'startDate', 'order_type' => 'DESC']);

        // Fetch trips shared with the user
        $acceptedSharedTrips = $tripCollaboratorsModel->where([
            'collaborator_traveler_Id' => $_SESSION['traveler_id'],
            'request_status' => 'accepted'
        ]);
        
        $pendingSharedTrips = $tripCollaboratorsModel->where([
            'collaborator_traveler_Id' => $_SESSION['traveler_id'],
            'request_status' => 'pending'
        ]);
        
        $sharedTripsBasic = array_merge($acceptedSharedTrips, $pendingSharedTrips);

        // Initialize array for shared trips with complete information
        $sharedTrips = [];

        // Process each shared trip to get complete information
        foreach ($sharedTripsBasic as $sharedTrip) {
            // Get trip details
            $tripDetails = $tripModel->first(['trip_Id' => $sharedTrip->trip_Id]);
        
            if ($tripDetails) {
                // Get trip owner details
                $tripOwner = $travelerModel->first(['traveler_Id' => $tripDetails->traveler_Id]);
            
                // Create comprehensive shared trip object
                $sharedTripInfo = (object)[
                    'collaborator_Id' => $sharedTrip->collaborator_Id,
                    'trip_Id' => $tripDetails->trip_Id,
                    'tripName' => $tripDetails->tripName,
                    'startingLocation' => $tripDetails->startingLocation,
                    'destination' => $tripDetails->destination,
                    'startDate' => $tripDetails->startDate,
                    'endDate' => $tripDetails->endDate,
                    'departureTime' => $tripDetails->departureTime,
                    'transportationMode' => $tripDetails->transportationMode,
                    'numberOfTravelers' => $tripDetails->numberOfTravelers,
                    'budgetPerPerson' => $tripDetails->budgetPerPerson,
                    'role' => $sharedTrip->role,
                    'request_status' => $sharedTrip->request_status ?? 'pending',
                    'ownerName' => ($tripOwner && $tripOwner->fName && $tripOwner->lName)  ? ($tripOwner->fName . ' ' . $tripOwner->lName) : $tripOwner->username,
                    'ownerId' => $tripDetails->traveler_Id
                ];
            
                $sharedTrips[] = $sharedTripInfo;
            }
        }

        // Sort shared trips by start date (newest first)
        usort($sharedTrips, function($a, $b) {
            return strtotime($b->startDate) - strtotime($a->startDate);
        });

        // Prepare data for the view
        $data = [
            'trips' => $userTrips ?? [],
            'sharedTrips' => $sharedTrips ?? []
        ];

        // Load the myTrips view with trip data
        // $this->view('traveler/myTrips', $data);
        $this->view('traveler/dummy', $data);
    }

    // Method to view a specific trip details
    public function viewTrip($trip_Id, $collaborator_Id = '')
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $tripModel = new Trip();
        $tripDaysModel = new TripDaysModel();
        $tripPlacesModel = new TripPlacesModel();
        $tripCollaboratorsModel = new TripCollaboratorsModel();

        // Fetch the specific trip
        if(empty($collaborator_Id)){
            $trip = $tripModel->first(['trip_Id' => $trip_Id]);
        }
        else{
            $collaborator = $tripCollaboratorsModel->first(['collaborator_Id' => $collaborator_Id]);
            $trip = $tripModel->first(['trip_Id' => $collaborator->trip_Id]);
        }
        

        if (!$trip) {
            // Redirect if trip not found
            header("Location: " . ROOT . "/traveler/MyTrips");
            exit();
        }

        $tripDays = $tripDaysModel->where(['trip_Id' => $trip_Id]);

        $allTripPlaces = [];  // Array to store places for all days
        
        foreach($tripDays as $tripDay) {
            $places = $tripPlacesModel->where(['day_Id' => $tripDay->day_Id]);
    
            // Convert times to 12-hour format
            foreach ($places as $place) {
                // Convert arrival time if it's not null
                if (!empty($place->arrival_time)) {
                    $arrivalTime = DateTime::createFromFormat('H:i:s', $place->arrival_time);
                    $place->arrival_time = $arrivalTime ? $arrivalTime->format('h:i A') : $place->arrival_time;
                }
        
                // Convert departure time if it's not null
                if (!empty($place->departure_time)) {
                    $departureTime = DateTime::createFromFormat('H:i:s', $place->departure_time);
                    $place->departure_time = $departureTime ? $departureTime->format('h:i A') : $place->departure_time;
                }
            }
    
            $allTripPlaces[$tripDay->day_Id] = $places;
        }

        //Below is to fetch the collaborators of the trip
        $collaborators = $tripCollaboratorsModel->where(['trip_Id' => $trip_Id]);

        $travelerModel = new Traveler();
        $i = 0;
        $collaboratorsList = [];
        foreach($collaborators as $collaborator){
            $collaboratorsList[$i]['collaboratorPermissions'] = $collaborators[$i];
            $collaboratorsList[$i]['collaboratorsProfiles'] = $travelerModel->first(['traveler_Id' => $collaborator->collaborator_traveler_Id]);
            $i++;
        }

        $data = [
            'trip' => $trip,
            'tripDays' => $tripDays,
            'allTripPlaces' => $allTripPlaces,
            'collaborators' => $collaboratorsList
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


    public function editTrip($trip_Id, $collaborator_Id = ''){
        
        $tripModel = new Trip();
        $tripCollaboratorsModel = new TripCollaboratorsModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Remove ", Sri Lanka" from the start and end locations
            $startingLocation = htmlspecialchars(trim($_POST['startLocation']));
            $startingLocation = str_replace(", Sri Lanka", "", $startingLocation);
        
            $destination = htmlspecialchars(trim($_POST['destination']));
            $destination = str_replace(", Sri Lanka", "", $destination );

            $data = [
                'tripName' => htmlspecialchars(trim($_POST['tripName'])),
                'startingLocation' => $startingLocation,
                'destination' => $destination,
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
        
        $this->viewTrip($trip_Id, $collaborator_Id);
        
    }

    public function addCollaborator($trip_Id){

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(empty($_POST['friendEmail'])){
                $_SESSION['errors'] = ['Please enter a valid email'];
                header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id);
                exit();
            }

            if(empty(($_POST['role']))){
                $_SESSION['errors'] = ['Please select an access permission'];
                header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id);
                exit();
            }

            $travelerModel = new Traveler();
            $tripCollaboratorsModel = new TripCollaboratorsModel();

            $collaboratorEmail = htmlspecialchars(trim($_POST['friendEmail']));
            $collaboratorRole = htmlspecialchars(trim($_POST['role']));

            $collaborator = $travelerModel->getTravelerByEmail($collaboratorEmail);

            if ($collaborator) {

                if($collaborator->traveler_Id == $_SESSION['traveler_id']){
                    $_SESSION['errors'] = ['You cannot add yourself as a collaborator.'];
                    header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id);
                    exit();
                }

                $existingCollaboratoredTrips = $tripCollaboratorsModel->where(['collaborator_traveler_Id' => $collaborator->traveler_Id]);
                foreach($existingCollaboratoredTrips as $existingCollaboratoredTrip){
                    if($existingCollaboratoredTrip->trip_Id == $trip_Id){
                        $_SESSION['errors'] = ['This user is already a collaborator or invited to this trip.'];
                        header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id);
                        exit();
                    }
                }

                $traveler_Id = $collaborator->traveler_Id;

                $insertData = [
                    'trip_Id' => $trip_Id,
                    'trip_owner_Id' => $_SESSION['traveler_id'],
                    'collaborator_traveler_Id' => $traveler_Id,
                    'role' => $collaboratorRole
                ];

                $result = $tripCollaboratorsModel->insert( $insertData);

                if(empty($result)){
                    $_SESSION['errors'] = ['Could not add collaboraor, Please try again later'];
                }
                else{
                    $_SESSION['success'] = ['Collaboration Invitation sent Successfully'];
                }

            }
            else {
                $_SESSION['errors'] = ['There is no user exist with such email'];
            }

            header("Location: " . ROOT . "/traveler/MyTrips/viewTrip/" . $trip_Id);
            exit();

        }

    }

    public function handleTripInvitations($collaborator_Id, $decision){
        $tripCollaboratorsModel = new TripCollaboratorsModel();
        
        $result = $tripCollaboratorsModel->update($collaborator_Id, ['request_status' => $decision], 'collaborator_Id');

        if ($result) {
            if ($decision == 'accepted') {
                $_SESSION['success'] = ['You\'ve accepted the trip invitation. Get ready for the adventure!'];
            } else if ($decision == 'declined') {
                $_SESSION['success'] = ['You\'ve declined the trip invitation. Maybe next time!'];
            }
        } else {
            $_SESSION['errors'] = ['Something went wrong. Please try again later'];
        }

        header("Location: " . ROOT . "/traveler/MyTrips/");
        exit();
    }

    

}
