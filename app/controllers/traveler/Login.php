<?php

class Login extends Controller
{
    public function index()
    {
        // Start session at the beginning of login proces

        // Check if the user is already logged in
        if (isset($_SESSION['traveler_id'])) {
            $this->view('traveler/registeredTravelerHome');
            exit();
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize and get form data
            $email = htmlspecialchars(trim($_POST['travelerEmail']));
            $password = htmlspecialchars(trim($_POST['travelerPassword']));

            $data = ['travelerEmail' => $email];

            $user = new Traveler;

            // Query the database for the user
            $result = $user->where($data);

            if (!empty($result)) {
                // Verify password
                if (password_verify($password, $result[0]->travelerPassword)) {
                    // Set session variables
                    $_SESSION['traveler_id'] = $result[0]->traveler_Id;
                    $_SESSION['username'] = $result[0]->username;
                    $_SESSION['email'] = $result[0]->travelerEmail;

                    // Redirect to Traveler's dashboard
                    $this->view('traveler/registeredTravelerHome');
                    exit();
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