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

        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        
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
                
                if ($profileUpdated && $bankUpdated) {
                    redirect('traveler/ViewProfile');
                } else {
                    $this->errors['general'] = "Failed to update profile! Please try again.";
                }
            }
            
            // If we reach here, there were validation errors or update failed
            $currentData = $this->getCurrentUserData();
            $currentData['errors'] = $this->errors;
            $this->view('traveler/editProfile', $currentData);
        }
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


    private function validateTravelerDetails($data) {
        // Validate email
        if (empty($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "Email is required.";
        } elseif (!filter_var($data['travelerEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['travelerEmail'] = "Email is not valid.";
        } elseif ($this->checkExistingEmail($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "*The email address you entered is already associated with another account. Please try a different email.";
            return false;
        }

        // Password validation only if password is provided
        if (!empty($data['travelerPassword'])) {
            // Validate password
            if (strlen($data['travelerPassword']) < 8) {
                $this->errors['travelerPassword'] = "Password must be at least 8 characters long.";
            }

            // Validate confirm password
            if (empty($data['confirmPassword'])) {
                $this->errors['confirmPassword'] = "Confirm Password is required.";
            } elseif ($data['travelerPassword'] !== $data['confirmPassword']) {
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
            $updateData['travelerPassword'] = password_hash($data['travelerPassword'], PASSWORD_DEFAULT);
        }
    
        try {
            $result = $this->travelerModel->update($_SESSION['traveler_id'], $updateData, 'traveler_Id');
            if ($result === false) {
                error_log("Failed to update traveler profile for ID: " . $_SESSION['traveler_id']);
                $this->errors['general'] = "Failed to update profile.";
                return false;
            }
            return true;
        } catch (Exception $e) {
            error_log("Exception in updateTravelerProfile: " . $e->getMessage());
            $this->errors['general'] = "An error occurred while updating profile.";
            return false;
        }
    }
    
    private function updateBankAccount($data) {
        // Only proceed if at least one bank field is filled
        if (empty($data['traveler_accountNum']) && empty($data['traveler_bankName']) && empty($data['traveler_bankBranch'])) {
            return true; // Return true if no bank data to update
        }

        // If account number is provided, ensure all bank details are present
        if (!empty($data['traveler_accountNum'])) {
            if (empty($data['traveler_bankName'])) {
                $this->errors['traveler_bankName'] = "Bank name is required when providing account number";
                return false;
            }
            if (empty($data['traveler_bankBranch'])) {
                $this->errors['traveler_bankBranch'] = "Bank branch is required when providing account number";
                return false;
            }
        }
    
        // If bank name or branch is provided without account number
        if ((empty($data['traveler_accountNum']) && (!empty($data['traveler_bankName']) || !empty($data['traveler_bankBranch'])))) {
            $this->errors['traveler_accountNum'] = "Account number is required when providing bank details";
            return false;
        }
    
        try {

            // Add traveler_Id to the data array before any database operation
            $data['traveler_Id'] = $_SESSION['traveler_id'];

            $existingBankAccount = $this->bankAccountModel->where(['traveler_Id' => $_SESSION['traveler_id']]);
    
            // Update existing record
            if (!empty($existingBankAccount)) {
                $result = $this->bankAccountModel->update(
                    $_SESSION['traveler_id'], 
                    $data, 
                    'traveler_Id'
                );
            } else {
                // Insert new record
                $result = $this->bankAccountModel->insert($data);
            }
    
            if ($result === false) {
                error_log("Failed to Update/Insert bank account for traveler ID: " . $_SESSION['traveler_id']);
                $this->errors['bank'] = "Failed to update bank account details.";
                return false;
            }
    
            return true;
        } catch (Exception $e) {
            error_log("Exception in updateBankAccount: " . $e->getMessage());
            $this->errors['bank'] = "An error occurred while updating bank details.";
            return false;
        }
    }

    
}
