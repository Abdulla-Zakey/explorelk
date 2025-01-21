<?php 

/**
 * Profile class
 */
class C_profile extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
			header("Location: " . ROOT . "/traveler/login");
			exit();
		}
		$guide = new TourGuide_M;
		$userData = $guide->where(['guide_id' => $_SESSION['guide_id']]);

		$data = [
            'userData' => $userData ?? []
        ];

		$this->view('tourGuide/profile',$data);
	}

	// Add new method to serve profile image
    public function getProfileImage()
    {
        if (!isset($_SESSION['guide_id'])) {
            header("HTTP/1.0 403 Forbidden");
            exit();
        }

        $guide = new TourGuide_M;
        $userData = $guide->first(['guide_id' => $_SESSION['guide_id']]);

        if ($userData && $userData->profilePhoto) {
            header("Content-Type: image/jpeg"); // Adjust content type if needed
            echo $userData->profilePhoto;
            exit();
        }
		
        // Serve default image if no profile photo exists
        $defaultImage = file_get_contents(APPROOT . '/public/assets/images/tourGuide/morrey.png');
        header("Content-Type: image/png");
        echo $defaultImage;
    }

	// public function updateProfile()
	// {
	// 	if (!isset($_SESSION['guide_id'])) {
	// 		header("Location: " . ROOT . "/traveler/login");
	// 		exit();
	// 	}

	// 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// 		$guide = new TourGuide_M;
			
	// 		// Collect form data
	// 		$updateData = [
	// 			'name' => $_POST['name'] ?? '',
	// 			'mobileNum' => $_POST['phone'] ?? '',
	// 			'guideLocation' => $_POST['location'] ?? '',
	// 			'nic' => $_POST['nic'] ?? '',
	// 			'licenseNum' => $_POST['license'] ?? '',
	// 			'guideBio' => $_POST['bio'] ?? '',
	// 			'experience' => $_POST['experience'] ?? '',
	// 			'tourFrequencyPerMonth' => $_POST['tourFrequency'] ?? '',
	// 			'languages_spoken' => json_encode([
	// 				'sinhala' => isset($_POST['sinhala']),
	// 				'english' => isset($_POST['english']),
	// 				'tamil' => isset($_POST['tamil'])
	// 			])
	// 		];

	// 		// Update profile
	// 		if ($guide->updateProfile($_SESSION['guide_id'], $updateData)) {
	// 			// Set success message in session
	// 			$_SESSION['success_message'] = "Profile updated successfully!";
	// 		} else {
	// 			// Set error message in session
	// 			$_SESSION['error_message'] = "Failed to update profile.";
	// 		}

	// 		// Redirect back to profile page
	// 		header("Location: " . ROOT . "/tourGuide/C_profile");
	// 		exit();
	// 	}
	// }

}