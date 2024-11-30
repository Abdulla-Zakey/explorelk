<?php

class Login extends Controller
{
    public function index()
    {

        // Check if there's a success message
        $successMessage = null;
        if (isset($_SESSION['success_message'])) {
            $successMessage = $_SESSION['success_message'];
            unset($_SESSION['success_message']); // Clear the message after fetching it
        }

        //Pass the message to the view
        // $this->view('traveler/login', ['success' => $successMessage]);

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Sanitize and get form data
            $email = htmlspecialchars(trim($_POST['travelerEmail']));
            $password = htmlspecialchars(trim($_POST['travelerPassword']));
            $userRole = htmlspecialchars(trim($_POST['userRole']));

            $data = ['travelerEmail' => $email];

            //Handle login based on user role
            switch ($userRole) {
                case 'traveler':
                    $user = new Traveler;

                    // Query the database for the user
                    $result = $user->where($data);

                    if (!empty($result)) {
                        // Verify password
                        if (password_verify($password, $result[0]->travelerPassword)) {

                            // Redirect to Traveler's dashboard
                            // header("Location: " .APP. "/views/traveler/registeredTravelerHome.view.php");
                            $this->view('traveler/registeredTravelerHome');
                            exit();
                        } 
                        else {
                            // Redirect with error message
                            $this->redirectWithError("Incorrect password");
                        }
                    } else {
                        // Redirect with error message
                        $this->redirectWithError("No such email exists");
                    }
                    break;

                default:
                    // Redirect for invalid role
                    $this->redirectWithError("Invalid role");
            }
        } else {
            // Load the login view
            $this->view('traveler/login');
        }
    }

    // Helper function for redirection with error
    private function redirectWithError($message)
    {
        header("Location: " .APP. "/public/login?error=" . urlencode($message));
        exit();
    }
}
