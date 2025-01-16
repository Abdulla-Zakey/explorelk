<?php

class EditProfile extends Controller {
    public $errors = [];
    private $travelerModel;
    private $bankAccountModel;

    public function __construct() {
        $this->travelerModel = new Traveler();
        $this->bankAccountModel = new TravelerBankAccount();
    }

    public function index() {
        // Fetch current user's profile data
        $userData = $this->getCurrentUserData();
        
        $this->view('traveler/editProfile', $userData);
    }

    private function getCurrentUserData() {
        $data = [
            'traveler' => null,
            'accountDetails' => null
        ];
    
        $travelerData = $this->travelerModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
        $bankAccountData = $this->bankAccountModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
    
        if (!empty($travelerData)) {
            $data['traveler'] = $travelerData[0];
            $data['accountDetails'] = !empty($bankAccountData) ? $bankAccountData[0] : null;
        }
    
        return $data;
    }

    // Method to edit trip
    public function editTrip($trip_Id)
    {
        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        $tripModel = new Trip();

        // Fetch the specific trip
        $trip = $tripModel->first(['trip_Id' => $trip_Id, 'traveler_Id' => $_SESSION['traveler_id']]);

        if (!$trip) {
            // Redirect if trip not found or doesn't belong to the user
            header("Location: " . ROOT . "/traveler/MyTrips");
            exit();
        }

        // Handle form submission for editing
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Prepare updated trip data
            $data = [
                'tripName' => htmlspecialchars(trim($_POST['tripName'])),
                'startingLocation' => htmlspecialchars(trim($_POST['startLocation'])),
                'destination' => htmlspecialchars(trim($_POST['destination'])),
                'startDate' => $_POST['startDate'],
                'endDate' => $_POST['endDate'],
                'departureTime' => $_POST['departureTime'],
                'transportationMode' => $_POST['transportation'] ?? $trip->transportationMode,
                'numberOfTravelers' => !empty($_POST['travelersCount']) ? intval($_POST['travelersCount']) : null,
                'budgetPerPerson' => !empty($_POST['budgetPerPerson']) ? floatval($_POST['budgetPerPerson']) : null
            ];

            // Validate trip data
            if ($tripModel->validate($data)) {
                // Update trip in database
                $result = $tripModel->update($trip_Id, $data, 'trip_Id');

                if ($result) {
                    // Fetch the updated trip to ensure we have the latest data
                    $updatedTrip = $tripModel->first(['trip_Id' => $trip_Id, 'traveler_Id' => $_SESSION['traveler_id']]);

                    // redirect('traveler/MyTrips');
                    $this->view('traveler/viewTrip', $updatedTrip);
                    
                } else {
                    // Handle update error
                    $data['error'] = "Failed to update trip. Please try again.";
                    $data['trip'] = $trip;
                    $this->view('traveler/viewTrip', $data);
                }
            } else {
                // Validation failed
                $data['errors'] = $tripModel->errors;
                $data['trip'] = $trip;
                $this->view('traveler/viewTrip', $data);
            }
        } else {
            // Load view trip view with existing trip data
            $data = [
                'trip' => $trip
            ];
            $this->view('traveler/viewTrip', $data);
        }
    }

    public function updateProfile() {
        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Sanitize and collect form data
            $data = [
                'fName' => trim($_POST['firstName']),
                'lName' => trim($_POST['lastName']),
                'travelerEmail' => trim($_POST['email']),
                'travelerMobileNum' => trim($_POST['mobileNumber']),
                'travelerPassword' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'bio' => trim($_POST['bio']),
                'profilePicture' => $this->handleProfilePicUpload(),
                
                // Bank account details
                'traveler_accountNum' => trim($_POST['accountNumber']),
                'traveler_bankName' => trim($_POST['bankName']),
                'traveler_bankBranch' => trim($_POST['bankBranch'])
            ];

            // Validate traveler details
            $isValidTraveler = $this->validateTravelerDetails($data);
            //$isValidTraveler = true;
            

            // Additional bank account validation
            // $isValidBankAccount = $this->validateBankDetails($data);
            $isValidBankAccount = true;
            

            if ($isValidTraveler && $isValidBankAccount) {
                // Update traveler profile
                $this->updateTravelerProfile($data);

                // Update bank account details
                $this->updateBankAccount($data);

                // Redirect to view profile with success message
                redirect('traveler/ViewProfile');
                exit();
            } 
            else {
                // If validation fails, re-render the edit profile view with errors
                $this->view('traveler/editProfile', [
                    'errors' => $this->errors,
                    'data' => $data
                ]);
            }
        }
    }


    private function validateTravelerDetails($data){

        // Validate email
        if (empty($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "Email is required.";
        } elseif (!filter_var($data['travelerEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['travelerEmail'] = "Email is not valid.";
        } elseif ($this->checkExistingEmail($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "Email is already registered.";
        }

        // Validate username
        if (empty($data['username'])) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($data['username']) < 5) {
            $this->errors['username'] = "Username must be at least 5 characters long.";
        } elseif (strlen($data['username']) > 50) {
            $this->errors['username'] = "Username cannot exceed 50 characters.";
        } elseif ($this->checkExistingUsername($data['username'])) {
            $this->errors['username'] = "Username is already taken.";
        }

         // Validate password
         if (strlen($data['travelerPassword']) < 8) {
            $this->errors['travelerPassword'] = "Password must be at least 8 characters long.";
        }

        // Validate confirm password
        if (!empty($data['travelerPassword'])) {

            if (empty($data['confirmPassword'])) {
                $this->errors['confirmPassword'] = "Confirm Password is required.";
            } 
            elseif ($data['travelerPassword'] !== $data['confirmPassword']) {
                $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
            }
        }
        
        return empty($this->errors);
    }

    // Check if email already exists
    public function checkExistingEmail($email)
    {
        $result = $this->travelerModel->where([
            'travelerEmail' => $email,
            'traveler_Id !=' => $_SESSION['traveler_id'] // Exclude current user
        ]);
        return !empty($result);
    }

    // Check if username already exists
    public function checkExistingUsername($username)
    {
        $result = $this->travelerModel->where(['username' => $username]);
        return !empty($result);
    }

    private function validateBankDetails($data) {
        $errors = [];

        // Validate account number
        if (empty($data['traveler_accountNum'])) {
            $errors['accountNumber'] = "Account number is required.";
        } elseif (!is_numeric($data['traveler_accountNum'])) {
            $errors['accountNumber'] = "Account number must be numeric.";
        }

        // Validate bank name
        if (empty($data['traveler_bankName'])) {
            $errors['bankName'] = "Bank name is required.";
        }

        // Validate bank branch
        if (empty($data['traveler_bankBranch'])) {
            $errors['bankBranch'] = "Bank branch is required.";
        }

        // Merge these errors with existing errors
        $this->travelerModel->errors = array_merge(
            $this->travelerModel->errors ?? [], $errors
        );

        return empty($errors);
    }

    private function handleProfilePicUpload() {
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            // Use absolute server path instead of ROOT constant
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/assets/images/Travelers/userProfilePics/';
            
            // Generate a unique filename
            $fileName = uniqid() . '_' . basename($_FILES['profilePicture']['name']);
            
            // Full path for the uploaded file
            $uploadPath = $uploadDir . $fileName;
    
            // Ensure upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            // Move uploaded file
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
                // Return just the filename to be stored in the database
                return $fileName;
            } else {
                // Add error logging
                error_log("File upload failed. Temp path: " . $_FILES['profilePicture']['tmp_name'] . ", Destination: " . $uploadPath);
            }
        }
    
        // Return existing profile picture if no new upload
        return $_POST['existingProfilePic'] ?? null;
    }

    private function getBankAccountDetails() {
        // Fetch bank account details for the current user
        return [
            'accountNumber' => '',
            'bankName' => '',
            'bankBranch' => ''
        ];
    }

    private function updateTravelerProfile($data) {
        
        // Prepare the data for update
        $updateData = [
            'fName' => $data['fName'],
            'lName' => $data['lName'],
            'travelerEmail' => $data['travelerEmail'],
            'travelerMobileNum' => $data['travelerMobileNum'],
            'bio' => $data['bio']
        ];
    
        // Add profile picture if it exists
        if (!empty($data['profilePicture'])) {
            $updateData['profilePicture'] = $data['profilePicture'];
        }
    
        // Only update password if a new password is provided
        if (!empty($data['travelerPassword'])) {
            // Hash the password before storing
            $updateData['travelerPassword'] = password_hash($data['travelerPassword'], PASSWORD_DEFAULT);
        }
    
        // Update the traveler's profile using the current user's ID from session
        try {
            $result = $this->travelerModel->update($_SESSION['traveler_id'], $updateData, 'traveler_Id');
            
            if ($result === false) {
                // If update fails, log an error
                error_log("Failed to update traveler profile for ID: " . $_SESSION['traveler_id']);
                return false;
            }
            
            return true;
        } catch (Exception $e) {
            // Log any exceptions
            error_log("Exception in updateTravelerProfile: " . $e->getMessage());
            return false;
        }
    }
    
    private function updateBankAccount($data) {
        // Check if bank account details are provided
        if (empty($data['traveler_accountNum']) || 
            empty($data['traveler_bankName']) || 
            empty($data['traveler_bankBranch'])) {
            return false;
        }
    
        // Prepare bank account data
        $bankAccountData = [
            'traveler_accountNum' => $data['traveler_accountNum'],
            'traveler_bankName' => $data['traveler_bankName'],
            'traveler_bankBranch' => $data['traveler_bankBranch']
        ];
    
        // Check if a bank account already exists for this traveler
        $existingBankAccount = $this->bankAccountModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
    
        try {
            if (!empty($existingBankAccount)) {
                // Update existing bank account
                $result = $this->bankAccountModel->update(
                    $_SESSION['traveler_id'], 
                    $bankAccountData, 
                    'traveler_Id'
                );
            } else {
                // Insert new bank account
                $bankAccountData['traveler_Id'] = $_SESSION['traveler_id'];
                $result = $this->bankAccountModel->insert($bankAccountData);
            }
    
            if ($result === false) {
                error_log("Failed to update/insert bank account for traveler ID: " . $_SESSION['traveler_id']);
                return false;
            }
    
            return true;
        } catch (Exception $e) {
            error_log("Exception in updateBankAccount: " . $e->getMessage());
            return false;
        }
    }
}
?>


<?php

class EditProfile extends Controller {
    public $errors = [];
    private $travelerModel;
    private $bankAccountModel;

    public function __construct() {
        $this->travelerModel = new Traveler();
        $this->bankAccountModel = new TravelerBankAccount();
    }

    public function index() {
        // Fetch current user's profile data
        $userData = $this->getCurrentUserData();
        
        $this->view('traveler/editProfile', $userData);
    }

    private function getCurrentUserData() {
        $data = [
            'traveler' => null,
            'accountDetails' => null
        ];
    
        $travelerData = $this->travelerModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
        $bankAccountData = $this->bankAccountModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
    
        if (!empty($travelerData)) {
            $data['traveler'] = $travelerData[0];
            $data['accountDetails'] = !empty($bankAccountData) ? $bankAccountData[0] : null;
        }
    
        return $data;
    }

    
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $formData = [
                'fName' => trim($_POST['firstName']),
                'lName' => trim($_POST['lastName']),
                'travelerEmail' => trim($_POST['email']),
                'travelerMobileNum' => trim($_POST['mobileNumber']),
                'travelerPassword' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'bio' => trim($_POST['bio']),
                'profilePicture' => $this->handleProfilePicUpload()
            ];

            $bankData = [
                'traveler_accountNum' => trim($_POST['accountNumber']),
                'traveler_bankName' => trim($_POST['bankName']),
                'traveler_bankBranch' => trim($_POST['bankBranch'])
            ];
    
            if ($this->validateTravelerDetails($formData)) {

                $profileUpdated = $this->updateTravelerProfile($formData);
                $bankUpdated = $this->updateBankAccount($bankData);

                if($profileUpdated && $bankUpdated) {
                    redirect('traveler/ViewProfile');
                }else {
                    $this->errors['general'] = "Failed to update profile. Please try again.";
                }
            }

            // If we reach here, there were validation errors or update failed
            $currentData = $this->getCurrentUserData();
            $currentData['errors'] = $this->errors;
            $this->view('traveler/editProfile', $currentData);
        }
    }

    private function validateTravelerDetails($data){

        // Validate email
        if (empty($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "Email is required.";
        }
        
        elseif (!empty($data['travelerEmail'])) {
            if (!filter_var($data['travelerEmail'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['travelerEmail'] = "Email is not valid.";
            }

            if ($this->checkExistingEmail($data['travelerEmail'])) {
                $this->errors['travelerEmail'] = "Email is already registered.";
            }

        }
         

        if (!empty($data['travelerPassword'])) {

            // Validate password
            if (strlen($data['travelerPassword']) < 8) {
                $this->errors['travelerPassword'] = "Password must be at least 8 characters long.";
            }

            // Validate confirm password
            if (empty($data['confirmPassword'])) {
                $this->errors['confirmPassword'] = "Confirm Password is required.";
            } 
            elseif ($data['travelerPassword'] !== $data['confirmPassword']) {
                $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
            }
        }
        
        return empty($this->errors);
    }

    // Check if email already exists
    public function checkExistingEmail($email)
    {
        $result = $this->travelerModel->where([
            'travelerEmail' => $email,
            'traveler_Id !=' => $_SESSION['traveler_id'] //We should exclude the current user, if not for an unchanged email is also an error will pops up
        ]);
        
        return !empty($result);
    }

    private function validateBankDetails($data) {

        // Validate account number
        if (!empty($data['accountNumber'])) {

            if (!is_numeric($data['accountNumber'])) {
                $this->errors['accountNumber'] = "Account number must be numeric";
            }

            // Validate bank name
            if (empty($data['bankName'])) {
                $this->errors['bankName'] = "Bank name is required.";
            }

            // Validate bank branch
            if (empty($data['bankBranch'])) {
                $this->errors['bankBranch'] = "Bank branch is required.";
            }
            
        } 

        return empty($this->errors);

    }

    private function handleProfilePicUpload() {
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
            // Use absolute server path instead of ROOT constant
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/assets/images/Travelers/userProfilePics/';
            
            // Generate a unique filename
            $fileName = uniqid() . '_' . basename($_FILES['profilePicture']['name']);
            
            // Full path for the uploaded file
            $uploadPath = $uploadDir . $fileName;
    
            // Ensure upload directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
    
            // Move uploaded file
            if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $uploadPath)) {
                // Return just the filename to be stored in the database
                return $fileName;
            } else {
                // Add error logging
                error_log("File upload failed. Temp path: " . $_FILES['profilePicture']['tmp_name'] . ", Destination: " . $uploadPath);
            }
        }
    
        // Return existing profile picture if no new upload
        return $_POST['existingProfilePic'] ?? null;
    }

    private function getBankAccountDetails() {
        // Fetch bank account details for the current user
        return [
            'accountNumber' => '',
            'bankName' => '',
            'bankBranch' => ''
        ];
    }

    private function updateTravelerProfile($data) {
        
        // Prepare the data for update
        $updateData = [
            'fName' => $data['fName'],
            'lName' => $data['lName'],
            'travelerEmail' => $data['travelerEmail'],
            'travelerMobileNum' => $data['travelerMobileNum'],
            'bio' => $data['bio']
        ];
    
        // Add profile picture if it exists
        if (!empty($data['profilePicture'])) {
            $updateData['profilePicture'] = $data['profilePicture'];
        }
    
        // Only update password if a new password is provided
        if (!empty($data['travelerPassword'])) {
            // Hash the password before storing
            $updateData['travelerPassword'] = password_hash($data['travelerPassword'], PASSWORD_DEFAULT);
        }
    
        // Update the traveler's profile using the current user's ID from session
        try {
            $result = $this->travelerModel->update($_SESSION['traveler_id'], $updateData, 'traveler_Id');
            
            if ($result === false) {
                // If update fails, log an error
                error_log("Failed to update traveler profile for ID: " . $_SESSION['traveler_id']);
                return false;
            }
            
            return true;
        } catch (Exception $e) {
            // Log any exceptions
            error_log("Exception in updateTravelerProfile: " . $e->getMessage());
            return false;
        }
    }
    
    private function updateBankAccount($data) {
        // Check if bank account details are provided
        if (empty($data['traveler_accountNum']) || 
            empty($data['traveler_bankName']) || 
            empty($data['traveler_bankBranch'])) {
            return false;
        }
    
        // Prepare bank account data
        $bankAccountData = [
            'traveler_accountNum' => $data['traveler_accountNum'],
            'traveler_bankName' => $data['traveler_bankName'],
            'traveler_bankBranch' => $data['traveler_bankBranch']
        ];
    
        // Check if a bank account already exists for this traveler
        $existingBankAccount = $this->bankAccountModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
    
        try {
            if (!empty($existingBankAccount)) {
                // Update existing bank account
                $result = $this->bankAccountModel->update(
                    $_SESSION['traveler_id'], 
                    $bankAccountData, 
                    'traveler_Id'
                );
            } else {
                // Insert new bank account
                $bankAccountData['traveler_Id'] = $_SESSION['traveler_id'];
                $result = $this->bankAccountModel->insert($bankAccountData);
            }
    
            if ($result === false) {
                error_log("Failed to update/insert bank account for traveler ID: " . $_SESSION['traveler_id']);
                return false;
            }
    
            return true;
        } catch (Exception $e) {
            error_log("Exception in updateBankAccount: " . $e->getMessage());
            return false;
        }
    }
}
