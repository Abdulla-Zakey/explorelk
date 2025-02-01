<?php 

/**
 * Profile class
 */
class C_editProfile extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
			header("Location: " . ROOT . "/traveler/login");
			exit();
		}
		$guide = new TourGuide_M;
		$userData = $guide->where(['guide_id' => $_SESSION['guide_id']]);

		$guideBankDetails = new GuideBankAccount;
		$bankDetailsData = $guideBankDetails->where(['guide_id' => $_SESSION['guide_id']]);

		
		//var_dump($userData[0]->name);
		$data = [
            'userData' => $userData ?? [],
			'bankDetailsData' => $bankDetailsData ?? []
        ];

		$this->view('tourGuide/editProfile',$data);
	}

	public function update()
    {
		// Ensure user is logged in
        if(!isset($_SESSION['guide_id'])) {
            header('Location: ' . ROOT . '/traveler/login');
            exit;
        }

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$guide = new TourGuide_M();
            $id = $_SESSION['guide_id'];

			$userData = $guide->findUserById($id);
            $uploadedImage = $userData->profilePhoto;

			$profileData = [
				'guide_Id' => $id,
                'firstName' => $_POST['firstName'] ?? '',
                'lastName' => $_POST['lastName'] ?? '',
                'username' => $_POST['username'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'password' => $_POST['password'] ?? '',
                'confirmPassword' => $_POST['confirmPassword'] ?? '',
                'email' => $_POST['email'] ?? '',
                'mobileNum' => $_POST['mobileNum'] ?? '',
                'nic' => $_POST['nic'] ?? '',
                'licenseNum' => $_POST['licenseNum'] ?? '',
				'tourFrequencyPerMonth' => $_POST['tourFrequencyPerMonth'] ?? '',
                'experience' => $_POST['experience'] ?? '',
                'guideBio' => $_POST['guideBio'] ?? '',
            ];

			// Handle profile picture upload first
            if (isset($_FILES['profile-image']) && $_FILES['profile-image']['error'] == 0) {
                $uploadDir = '../public/assets/images/tourGuide/tourGuideProfilePhotos/';
                $fileName = uniqid() . '_' . basename($_FILES['profile-image']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profile-image']['tmp_name'], $uploadPath)) {
                    $profileData['profilePhoto'] = $fileName;
                } else {
                    $_SESSION['error'] = 'File upload failed';
                }
            } else {
				$profileData['profilePhoto'] = $uploadedImage;
			}

			// Handle password update
			if (!empty($_POST['password'])) {
				if ($_POST['password'] === $_POST['confirmPassword']) {
					$profileData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				} else {
					$_SESSION['error'] = 'Passwords do not match';
					header('Location: ' . ROOT . '/tourGuide/C_editProfile');
					exit;
				}
			} else {
				$profileData['password'] = $userData->password;
			}

			// $test = $guide->profileValidate($profileData);
			
			$guideUpdated = true;
			if (!$guide->profileValidate($profileData)) {
				$guideErrors = $guide->errors;
				// show($guideErrors['firstName']);
			} else {
				$guideResult = $guide->update($id, $profileData, 'guide_Id');
				if ($guideResult) {
					$_SESSION['message'] = 'Profile update success';
				} else {
					$guideUpdated = false;
				}
			}
			$bank = new GuideBankAccount();

			$bankData = [
				'tourGuide_accountNum' => $_POST['tourGuide_accountNum'] ?? '',
				'tourGuide_bankName' => $_POST['tourGuide_bankName'] ?? '',
				'tourGuide_bankBranch' => $_POST['tourGuide_bankBranch'] ?? '',
			];

			$bankUpdated = true;
			if(!$bank->validate($bankData)){
				$bankErrors = $bank->errors;
				// show($bankErrors);
			} else {
				if ($bank->checkExistingACNum($bankData['tourGuide_accountNum'])) {
					$bankResult = $bank->update($id, $bankData, 'guide_Id');
				} else {
					$bankResult = $bank->insert($bankData); // Assuming you have an insert() method
				}
				
			}

			$userData = $guide->where(['guide_id' => $_SESSION['guide_id']]);
			$bankDetailsData = $bank->where(['guide_id' => $_SESSION['guide_id']]);

			$data = [
				'userData' => $userData ?? [],
				'bankDetailsData' => $bankDetailsData ?? [],
				'guideErrors' => $guideErrors ?? [],
				'bankErrors' => $bankErrors ?? [],
			];
			// show($data);

			// $profileErrors = [
			// 	'guideErrors' => $guideErrors ?? [],
			// 	'bankErrors' => $bankErrors ?? [],
			// ];

			if (!empty($data['guideErrors'] || $data['bankErrors'])) {
				$this->view('tourGuide/editProfile', $data);
				return;
			}

			// show($bankResult);
			if ($guideUpdated && $bankUpdated) {
				header('Location: ' . ROOT . '/tourGuide/C_profile');
                exit;
			}
			


			
			// if(!$bank->checkExistingACNum($bankData['tourGuide_accountNum'])){
			// 	if($guide->validate($profileData)){
					

			// 		echo 'hi';
					
			// 		$result = $guide->update($id, $profileData, 'guide_Id');
			// 	} else {
			// 		echo 'bye';
			// 	}
			// } else {

			// }

			
			// if ($result) {
			// 	echo 'Good';
			// } else {
			// 	echo 'bye';
			// 	var_dump($result);
			// }
			
		}
	}
}