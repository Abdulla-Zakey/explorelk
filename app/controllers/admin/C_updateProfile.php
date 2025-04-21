<?php 

class C_updateProfile extends Controller
{
    public function index()
    {
        // Ensure user is logged in
        if(!isset($_SESSION['admin_id'])) {
            // Redirect to login or show error
            header('Location: ' . ROOT . '/admin/C_adminLogin');
            exit;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new Admin();
            $id = $_SESSION['admin_id'];

            // Prepare data for update
            $data = [
                'firstName' => $_POST['first-name'] ?? '',
                'lastName' => $_POST['last-name'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['birth-date'] ?? '',
                'city' => $_POST['city'] ?? '',
                'phoneNo' => $_POST['contact-no'] ?? '',
                'address' => $_POST['address'] ?? '',
                'nic' => $_POST['nic'] ?? ''
            ];

            // Handle profile picture upload
            if (!empty($_FILES['profile-image']['name'])) {
                $uploadDir = APPROOT . '/public/assets/images/admin/';
                $fileName = uniqid() . '_' . basename($_FILES['profile-image']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $uploadPath)) {
                    $data['profile_picture'] = $fileName;
                }
            }

            // Handle password update
            if (!empty($_POST['password']) && $_POST['password'] === $_POST['re-password']) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            // Perform update
            $result = $user->update($id, $data, 'admin_id');

            if ($result) {
                // Set success message
                $_SESSION['message'] = 'Profile updated successfully';
                header('Location: ' . ROOT . '/admin/C_profile');
                exit;
            } else {
                // Set error message
                $_SESSION['error'] = 'Failed to update profile';
                // Redirect back to edit page
                header('Location: ' . ROOT . '/admin/C_editProfile');
                exit;
            }
        }

        // If not a POST request, redirect
        header('Location: ' . ROOT . '/admin/C_profile');
        exit;
    }
}