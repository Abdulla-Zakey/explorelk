<?php 

/**
 * Car Rentals Bookings class
 */
class C_adminLogin extends Controller
{

	public function index()
    {
        // session_start();
        // if (isset($_SESSION['admin_id'])) {
        //     $this->view('admin/C_dashboard');
        //     exit();
        // }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            
            $email = htmlspecialchars(trim($_POST['adminEmail']));
            
            $password = htmlspecialchars(trim($_POST['adminPassword']));

            $user = new Admin;
            $result = $user->findEmail($email);

            if ($result) {
                if ($password == $result->password) {
                    redirect('admin/C_dashboard');
                }
            }
            
            

	    } else {
            // Load the login view
            $this->view('admin/adminLogin');
        }
    }

    // // Logout method
    // public function logout()
    // {
    //     // Start session
    //     session_start();

    //     // Unset all session variables
    //     $_SESSION = array();

    //     // Destroy the session
    //     session_destroy();

    //     // Redirect to login page
    //     header("Location: " . ROOT . "/admin/C_adminLogin");
    //     exit();
    // }

    // // Helper function for redirection with error
    // private function redirectWithError($message)
    // {
    //     header("Location: " . ROOT . "/admin/C_adminLogin?error=" . urlencode($message));
    //     exit();
    // }
}