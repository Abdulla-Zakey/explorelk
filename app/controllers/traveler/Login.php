<?php

class Login extends Controller
{
    public function index()
    {

        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); /*To prevent accessing the logged in prevelages, while logged out, by preventing caching the user credentials, */
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // Check if the user is already logged in
        if (isset($_SESSION['traveler_id'])) {
            // $this->view('traveler/registeredTravelerHome');
            redirect('traveler/RegisteredTravelerHome');
            exit();
        }
        else if(isset($_SESSION['organizer_id'])){
            redirect('Eventorganizer/Eodashboard');
            exit();
        }
        else if(isset($_SESSION['guide_id'])){
            redirect('tourguide/C_dashboard');
            exit();
        }
        else if(isset($_SESSION['hotel_id'])){
            redirect('Hotel/Hdashboard');
            exit();
        }
        elseif (isset($_SESSION['restaurant_id'])) {
            redirect('Restaurant/Rdashboard');
            exit();
        }


        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(empty($_POST['travelerEmail']) && empty($_POST['travelerPassword'])) {
                $error['password'] = "Enter your password";
                $error['email'] = "Enter your email";
                    $this->view('traveler/Login', [
                        'error' => $error
                    ]);
            } elseif (empty($_POST['travelerPassword'])) {
                $error['password'] = "Enter your Password";
                    $this->view('traveler/Login', [
                        'error' => $error
                    ]);
            } elseif (empty($_POST['travelerEmail'])) {
                $error['email'] = "Enter your email";
                    $this->view('traveler/Login', [
                        'error' => $error
                    ]);
            }elseif (!filter_var($_POST['travelerEmail'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Enter a valid email address";
                $this->view('traveler/Login', [
                    'error' => $error
                ]);
            }

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
                
                case 'diningSP':
                    $data = ['restaurantEmail' => $email];
                    $user = new Restaurant;
                    $passwordField = 'restaurantPassword';
                    break;


                default:
                    $this->redirectWithError("Invalid user role");
                    exit();
            }

            // Query the database for the user
            $result = $user->first($data);

            if(isset($result->approved) && $result->approved == 'no'){
                $error['email'] = "Your profile is not verified yet";
                $this->view('traveler/Login', [
                    'error' => $error
                ]);
                exit();

            }

            if (!empty($result)) {

                // Check if email is verified
                if ($userRole == 'traveler' && $result->emailVerified != 1) {
                    // Email not verified
                    redirect('traveler/VerificationPending');
                    exit();
                }

                // Verify password using the correct password field
                if (password_verify($password, $result->$passwordField)) {
                    switch($userRole){
                        case 'traveler':
                            // Set session variables
                            $_SESSION['traveler_id'] = $result->traveler_Id;

                            // Redirect to Traveler's dashboard
                            redirect('traveler/RegisteredTravelerHome');
                            exit();

                        case 'eventOrganizer':
                            // Redirect to Event Organizer's dashboard
                            $_SESSION['organizer_id'] = $result->organizer_Id;
                            redirect('Eventorganizer/Eodashboard');
                            exit();
                           
                        case 'accommodationSP':
                            $_SESSION['hotel_id'] = $result->hotel_Id;
                            // Redirect to Accommodation service provider's dashboard
                            redirect('Hotel/Hdashboard');
                            exit();


                        case 'tourGuide':
                            // Set session variables
                            $_SESSION['guide_id'] = $result->guide_Id;

                            // Redirect to Tour Guide's dashboard
                            redirect('tourguide/C_dashboard');
                            exit();

                        case 'diningSP':
                            // Set session variables
                            $_SESSION['restaurant_id'] = $result->restaurant_id;

                            // Redirect to Restaurant service provider's dashboard
                            redirect('Restaurant/Rdashboard');
                            exit();
                            
                    }
                } else {
                    // Redirect with error message
                    $error['password'] = "Incorrect password";
                    $this->view('traveler/Login', [
                        'error' => $error
                    ]);
                }
            } else {
                // Redirect with error message
                $error['email'] = "No such email exists";
                    $this->view('traveler/Login', [
                        'error' => $error
                    ]);

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

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Redirect to login page
        header("Location: " . ROOT . "/Home");
        exit();
    }

    // Helper function for redirection with error
    private function redirectWithError($message)
    {
        header("Location: " . ROOT . "/traveler/Login?error=" . urlencode($message));
        exit();
    }
}