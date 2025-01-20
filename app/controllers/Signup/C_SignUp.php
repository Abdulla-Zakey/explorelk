<?php

class C_SignUp extends Controller
{
    public function index()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            //var_dump($_POST);
            if ($_POST['password'] === $_POST['confirmPassword']) {
                $email = $_POST['email'];
                $serviceType = $_POST['servicetype'];
                //var_dump($_POST);
                

                // Check if the email already exists in the corresponding table based on service type
                $emailExists = false;

                switch ($serviceType) {
                    case 'hotels':
                        $hotelModel = new M_Hotel();
                        $existingHotel = $hotelModel->find(['email' => $email]);
                        if ($existingHotel) {
                            $emailExists = true;
                        }
                        break;

                    case 'restaurants':
                        $restaurantModel = new M_Restaurant();
                        $existingRestaurant = $restaurantModel->find(['email' => $email]);
                        if ($existingRestaurant) {
                            $emailExists = true;
                        }
                        break;

                    case 'travelagent':
                        $travelAgentModel = new M_TravelAgent();
                        $existingTravelAgent = $travelAgentModel->find(['email' => $email]);
                        if ($existingTravelAgent) {
                            $emailExists = true;
                        }
                        break;

                    case 'tourguide':
                        $tourGuideModel = new M_TourGuide();
                        $existingTourGuide = $tourGuideModel->find($email);
                        //var_dump($existingTourGuide);

                        if ($existingTourGuide) {
                            $emailExists = true;
                        }
                        //var_dump($_POST);
                        break;

                    default:
                        $data['error'] = "Invalid service type selected.";
                        break;
                }

                // If email already exists, set error message
                //var_dump($_POST);
                if ($emailExists) {
                    $data['error'] = "This email address is already registered for the selected service.";
                } else {
                    //var_dump($_POST);
                    switch ($serviceType) {
                        case 'hotels':
                            $hotelModel = new M_Hotel();
                            if ($hotelModel->validate($_POST)) {
                                $hotelModel->insert($_POST);
                                $data['success'] = "Hotel service provider registered successfully!";
                            } else {
                                $data['error'] = "Validation failed for hotel registration.";
                                $data['errors'] = $hotelModel->errors;
                            }
                            break;

                        case 'restaurants':
                            $restaurantModel = new M_Restaurant();
                            if ($restaurantModel->validate($_POST)) {
                                $restaurantModel->insert($_POST);
                                $data['success'] = "Restaurant service provider registered successfully!";
                            } else {
                                $data['error'] = "Validation failed for restaurant registration.";
                                $data['errors'] = $restaurantModel->errors;
                            }
                            break;

                        case 'travelagent':
                            $travelAgentModel = new M_TravelAgent();
                            if ($travelAgentModel->validate($_POST)) {
                                $travelAgentModel->insert($_POST);
                                $data['success'] = "Travel agent service provider registered successfully!";
                            } else {
                                $data['error'] = "Validation failed for travel agent registration.";
                                $data['errors'] = $travelAgentModel->errors;
                            }
                            break;

                        case 'tourguide':
                            //var_dump($_POST);
                            $tourGuideModel = new M_TourGuide();
                            //var_dump($_POST);
                            //var_dump($tourGuideModel->validate($_POST));
                            if ($tourGuideModel->validate($_POST)) {
                                var_dump($tourGuideModel->insert($_POST));
                                $tourGuideModel->insert($_POST);
                                $data['success'] = "Tour guide service provider registered successfully!";
                            } else {
                                $data['error'] = "Validation failed for tour guide registration.";
                                $data['errors'] = $tourGuideModel->errors;
                            }
                            break;

                        default:
                            $data['error'] = "Invalid service type selected.";
                            break;
                    }
                }
            } else {
                $data['error'] = "Password and Confirm Password do not match.";
            }
        }

        $this->view('signup/signUp', $data);
    }
}
