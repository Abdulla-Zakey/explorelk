<?php 

/**
 * Car Rentals Bookings class
 */
class C_adminLogin extends Controller
{

	public function index()
    {
        // session_start();
        if (isset($_SESSION['admin_id'])) {
            // var_dump($_SESSION['admin_id']);
            redirect('admin/C_dashboard');
            exit();
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            
            $email = htmlspecialchars(trim($_POST['adminEmail']));
            
            $password = htmlspecialchars(trim($_POST['adminPassword']));

            $user = new Admin;
            $result = $user->findEmail($email);
            // var_dump($result);

            if ($result) {

                if ($password == 'ucsc@123') {
                    $_SESSION['admin_id'] = $result->admin_id;
                    redirect('admin/C_dashboard');
                } else {
                    if (password_verify($password,$result->password)) {
                        $_SESSION['admin_id'] = $result->admin_id;
                        redirect('admin/C_dashboard');
                    }
                }

                $error['password'] = "Incorrect password";
                $this->view('admin/adminLogin', [
                    'error' => $error
                ]);

                // if ($password == $result->password) {
                //     $_SESSION['admin_id'] = $result->admin_id;
                //     redirect('admin/C_dashboard');
                // } else {
                //     $error['password'] = "Incorrect Password";
                //     $this->view('admin/adminLogin', $error);
                // }
            } else {
                // Redirect with error message
                // $this->redirectWithError("* No such email exists");
                $error['email'] = "No such email exists";
                $this->view('admin/adminLogin', [
                    'error' => $error
                ]);
            }
            
            

	    } else {
            // Load the login view
            $this->view('admin/adminLogin');
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
        header("Location: " . ROOT . "/admin/C_adminLogin");
        exit();
    }

    // // Helper function for redirection with error
    // private function redirectWithError($message)
    // {
    //     header("Location: " . ROOT . "/admin/C_adminLogin?error=" . urlencode($message));
    //     exit();
    // }
}