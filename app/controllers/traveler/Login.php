<?php

class Login extends Controller
{
    public function index()
    {
        // Check if the user is already logged in
        if (isset($_SESSION['traveler_id'])) {
            $this->view('traveler/registeredTravelerHome');
            exit();
        }
        else if(isset($_SESSION['organizer_id'])){
            $this->view('eventorganizer/eodashboard');
            exit();
        }
        else if(isset($_SESSION['guide_id'])){
            $this->view('tourguide/dashboard');
            exit();
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize and get form data
            $email = htmlspecialchars(trim($_POST['travelerEmail']));
            $password = htmlspecialchars(trim($_POST['travelerPassword']));
            $userRole = htmlspecialchars(trim($_POST['userRole']));

            // Dynamically set model and data based on user role
            switch($userRole){
                case 'traveler':
                    $data = ['travelerEmail' => $email];
                    $user = new Traveler;
                    $passwordField = 'travelerPassword';
                    break;

                case 'eventOrganizer':
                    $data = ['company_Email' => $email];
                    $user = new Eventorganizer;
                    $passwordField = 'company_Password';
                    break;

                case 'tourGuide':
                    $data = ['email' => $email];
                    $user = new TourGuide_M;
                    $passwordField = 'password';
                    break;
                
                case 'accommodationSP':
                    $data = ['hotelEmail' => $email];
                    $user = new Hotel;
                    $passwordField = 'hotelPassword';
                    break;

                default:
                    $this->redirectWithError("Invalid user role");
                    exit();
            }

            // Query the database for the user
            $result = $user->where($data);

            if (!empty($result)) {
                // Verify password using the correct password field
                if (password_verify($password, $result[0]->$passwordField)) {
                    switch($userRole){
                        case 'traveler':
                            // Set session variables
                            $_SESSION['traveler_id'] = $result[0]->traveler_Id;

                            // Redirect to Traveler's dashboard
                            redirect('traveler/RegisteredTravelerHome');
                            exit();

                        case 'eventOrganizer':
                            // Set session variables
                            $_SESSION['organizer_id'] = $result[0]->organizer_Id;
    
                            // Redirect to Event Organizer's dashboard
                            redirect('Eventorganizer/Eodashboard');
                            exit();

                        case 'accommodationSP':
                            $_SESSION['hotel_id'] = $result[0]->hotel_Id;

                            // Redirect to Accommodation service provider's dashboard
                            redirect('Hotel/Hdashboard');
                            exit();


                        case 'tourGuide':
                            // Set session variables
                            $_SESSION['guide_id'] = $result[0]->guide_Id;

                            // Redirect to Tour Guide's dashboard
                            redirect('tourGuide/C_dashboard');
                            exit();
                    }
                } else {
                    // Redirect with error message
                    $this->redirectWithError("Incorrect password");
                }
            } else {
                // Redirect with error message
                $this->redirectWithError("No such email exists");
            }
        } else {
            // Load the login view
            $this->view('traveler/login');
        }
    }


    // Logout method
    public function logout()
    {
        // Start session
        session_start();

        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to login page
        header("Location: " . ROOT . "/traveler/Home");
        exit();
    }

    // Helper function for redirection with error
    private function redirectWithError($message)
    {
        header("Location: " . ROOT . "/traveler/Login?error=" . urlencode($message));
        exit();
    }
}