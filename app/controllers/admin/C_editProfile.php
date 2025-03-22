<?php 

/**
 * Edit Profile class
 */
class C_editProfile extends Controller
{

	public function index()
	{

		$user = new Admin;
		$id = $_SESSION['admin_id'];

		$data = [
            'userData' => $user->findUserById($id),
        ];

		$this->view('admin/editProfile' , $data);
	}

    public function updateProfile()
    {
        // Ensure user is logged in
        if(!isset($_SESSION['admin_id'])) {
            header('Location: ' . ROOT . '/admin/C_adminLogin');
            exit;
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new Admin();
            $id = $_SESSION['admin_id'];

            $userData = $user->findUserById($id);
            $uploadedImage = $userData->profile_picture;

            // Prepare data for update
            $data = [
                'firstName' => $_POST['first-name'] ?? '',
                'lastName' => $_POST['last-name'] ?? '',
                'password' => $_POST['password'] ?? '',
                'confirmPassword' => $_POST['confirmPassword'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'dob' => $_POST['birth-date'] ?? '',
                'city' => $_POST['city'] ?? '',
                'phoneNo' => $_POST['contact-no'] ?? '',
                'address' => $_POST['address'] ?? '',
                'nic' => $_POST['nic'] ?? '',
            ];

            // Handle profile picture upload first
            if (isset($_FILES['profile-image']) && $_FILES['profile-image']['error'] == 0) {
                $uploadDir = '../public/assets/images/admin/adminProfilePhotos/';
                $fileName = uniqid() . '_' . basename($_FILES['profile-image']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $uploadPath)) {
                    $data['profile_picture'] = $fileName;
                } else {
                    $_SESSION['error'] = 'File upload failed';
                }
            }

            if (!$user->validate($data, false)) {
                // Pass errors to the view
                $data = [
                    'userData' => $userData,
                    'errors' => $user->errors,
                ];
    
                // Render view with errors
                $this->view('admin/editProfile', $data);
                exit;
            }

            // Validate without strict email/password checks for profile update
            if ($user->validate($data, false)) {
                // Handle password update
                if (!empty($_POST['password'])) {
                    if ($_POST['password'] === $_POST['confirmPassword']) {
                        $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    } else {
                        $_SESSION['error'] = 'Passwords do not match';
                        header('Location: ' . ROOT . '/admin/C_editProfile');
                        exit;
                    }
                } else {
                    $data['password'] = $userData->password;
                }

                // Perform update
                $result = $user->update($id, $data, 'admin_id');

                if ($result) {
                    $_SESSION['message'] = 'Profile updated successfully';
                    header('Location: ' . ROOT . '/admin/C_profile');
                    exit;
                } else {
                    $_SESSION['error'] = 'Failed to update profile';
                    header('Location: ' . ROOT . '/admin/C_editProfile');
                    exit;
                }
            } else {
                // Store validation errors in session for display
                $_SESSION['errors'] = $user->errors;
                header('Location: ' . ROOT . '/admin/C_editProfile');
                exit;
            }
        }

        header('Location: ' . ROOT . '/admin/C_profile');
        exit;
    }
}
