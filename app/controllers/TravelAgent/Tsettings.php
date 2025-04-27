<?php

class Tsettings extends Controller {

    private $travelagentModel;

    public function __construct() {
        $this->travelagentModel = new TravelAgent();
    }
    
    public function index($a = '', $b = '', $c = '') {
        $data['travelagentBasic'] = $this->travelagentModel->first(['travelagent_Id' => $_SESSION['travelagent_Id']]);
        $this->view('travelagent/settings', $data);
    }

    public function update(): void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // For debugging
            error_log(message: 'updatemethod called with POST data: ' . print_r(value:$_POST, return: true));

            //Process the form data
            $travelagentData = [
                'travelagentName' => $_POST['travelagent-name'],
                'travelagentEmail' => $_POST['email'],
                'serviceProviderName' => $_POST['owner-name'],
                'travelagentMobileNum' => $_POST['phone-number'],
                'travelagentAddress' => $_POST['address-line-1'],
                'district' => $_POST['district'],
                'province' => $_POST['province'],
                'description_para1' => $_POST['description'][0],
                'description_para2' => isset($_POST['description'][1]) ? $_POST['description'][1] : '',
                'description_para3' => isset($_POST['description'][2]) ? $_POST['description'][2] : ''
            ];

            //debug data being sent to update method
            error_log(message: 'travelagent data being sent to update: ' . print_r(value: $travelagentData, return: true));
            error_log(message: 'travelagent ID being used: ' . $_SESSION['travelagent_id']);

            //update travelagent data in database
            $updated = $this->travelagentModel->update($_SESSION['travelagent_id'], $travelagentData, 'travelagent_Id');

            //debug update result
            error_log(message: 'update result: ' . ($updated ? 'true' : 'false'));

            if ($updated) {
                $_SESSION['success'] = "Your profile has been updated successfully!";

                // Handle profile picture upload
                if(isset($_FILES['profile-photo']) && $_FILES['profile-photo']['error'] === UPLOAD_ERR_OK) {
                    $this->handleProfilePhotoUpload($_SESSION['travelagent_id']);
                }

                // Handle multiple travelagent photos
                if(isset($_FILES['travelagent-photos']) && !empty($_FILES['travelagent-photos']['name'][0])) {
                    $this->handleTravelagentPhotosUpload($_SESSION['travelagent_id']);
                }
            } else {
                $_SESSION['error'] = "Failed to update profile. Please try again.";
            }

            // Redirect to the settings page
            redirect('travelagent/settings');
        } else {
            // handle GET request - redirect to settings page
            redirect('travelagent/settings');
        }
    }

    private function handleProfilePhotoUpload($travelagentId): bool {
        $targetDir = 'public/uploads/travelagent/profile/';
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['profile-photo']['name']);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if file is an actual image
        $check = getimagesize($_FILES['profile-photo']['tmp_name']);
        if ($check === false) {
            $_SESSION['error'] = "File is not an image.";
            return false;
        }
        
        // Check file size (limit to 5MB)
        if ($_FILES['profile-photo']['size'] > 5000000) {
            $_SESSION['error'] = "Sorry, your file is too large.";
            return false;
        }
        
        // Allow certain file formats
        if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return false;
        }
        
        if (move_uploaded_file($_FILES['profile-photo']['tmp_name'], $targetFile)) {
            // Update the database with the new profile picture path
            $this->travelagentModel->update($travelagentId, ['profile_picture' => $targetFile], 'travelagent_Id');
            return true;
        } else {
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            return false;
        }
    }

    private function handleTravelagentPhotosUpload($travelagentId): bool {
        $targetDir = 'public/uploads/travelagent/gallery/';
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $uploadedFiles = [];
        $fileCount = count($_FILES['travelagent-photos']['name']);
        
        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['travelagent-photos']['error'][$i] === UPLOAD_ERR_OK) {
                $fileName = time() . '_' . $i . '_' . basename($_FILES['travelagent-photos']['name'][$i]);
                $targetFile = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                
                // Check if file is an actual image
                $check = getimagesize($_FILES['travelagent-photos']['tmp_name'][$i]);
                if ($check === false) continue;
                
                // Check file size (limit to 5MB)
                if ($_FILES['travelagent-photos']['size'][$i] > 5000000) continue;
                
                // Allow certain file formats
                if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") continue;
                
                if (move_uploaded_file($_FILES['travelagent-photos']['tmp_name'][$i], $targetFile)) {
                    $uploadedFiles[] = $targetFile;
                }
            }
        }
        
        // Here you would typically save the file paths to a gallery table in your database
        // For now, we'll just return true if at least one file was uploaded successfully
        return !empty($uploadedFiles);
    }
}
