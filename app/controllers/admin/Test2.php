<?php

class Test2 extends Controller {
    
    private $topDistrictsModel;
    private $districtPicsModel;
    private $attractionsModel;
    private $attractionPicsModel;
    
    public function __construct() {
        $this->topDistrictsModel = new TopDistrictsModel();
        $this->districtPicsModel = new DistrictsPicsModel();
        $this->attractionsModel = new AttractionsModel();
        $this->attractionPicsModel = new AttractionPicsModel();
    }
    
    public function index() {
        // Get all districts for the admin dashboard
        $districts = $this->topDistrictsModel->selectAll();
        
        $data = [
            'districts' => $districts
        ];
        
        $this->view('admin/test2', $data);
    }
    
    public function edit($params = []) {
        $district_id = $params[0] ?? '';
        
        if (empty($district_id)) {
            redirect('admin/districts');
        }
        
        // Get district details
        $district = $this->topDistrictsModel->first(['district_id' => $district_id]);
        
        if (!$district) {
            $_SESSION['error'] = "District not found";
            redirect('admin/districts');
        }
        
        // Get district gallery pictures
        $galleryPics = $this->districtPicsModel->getPicturesForDistrict($district_id);
        
        // Get all attractions for the district
        $attractions = $this->attractionsModel->where(['district_id' => $district_id]);
        
        $data = [
            'district' => $district,
            'gallery_pics' => $galleryPics,
            'attractions' => $attractions
        ];
        
        $this->view('admin/districts/edit', $data);
    }
    
    public function update($params = []) {
        $district_id = $params[0] ?? '';
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/districts');
        }
        
        // Validate inputs
        $errors = [];
        
        if (empty($_POST['district_name'])) {
            $errors[] = "District name is required";
        }
        
        if (empty($_POST['about_the_district'])) {
            $errors[] = "About the district is required";
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('admin/districts/edit/' . $district_id);
        }
        
        // Update district info
        $data = [
            'district_name' => $_POST['district_name'],
            'about_the_district' => $_POST['about_the_district']
        ];
        
        // Upload cover image if provided
        if (!empty($_FILES['coverPic']['name'])) {
            $uploadResult = $this->uploadImage('coverPic', 'districts/covers/');
            
            if ($uploadResult['success']) {
                $data['coverPic'] = $uploadResult['path'];
            } else {
                $_SESSION['error'] = $uploadResult['error'];
                redirect('admin/districts/edit/' . $district_id);
            }
        }
        
        $this->topDistrictsModel->update($district_id, $data);
        
        $_SESSION['success'] = "District information updated successfully";
        redirect('admin/districts/edit/' . $district_id);
    }
    
    public function addGalleryImage($params = []) {
        $district_id = $params[0] ?? '';
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/districts');
        }
        
        if (empty($_FILES['gallery_image']['name'])) {
            $_SESSION['error'] = "No image selected";
            redirect('admin/districts/edit/' . $district_id);
        }
        
        // Upload gallery image
        $uploadResult = $this->uploadImage('gallery_image', 'districts/gallery/');
        
        if ($uploadResult['success']) {
            // Add to district_pics table
            $imageData = [
                'district_id' => $district_id,
                'image_location' => $uploadResult['path']
            ];
            
            $this->districtPicsModel->insert($imageData);
            
            $_SESSION['success'] = "Gallery image added successfully";
        } else {
            $_SESSION['error'] = $uploadResult['error'];
        }
        
        redirect('admin/districts/edit/' . $district_id);
    }
    
    public function deleteGalleryImage($params = []) {
        $image_id = $params[0] ?? '';
        $district_id = $params[1] ?? '';
        
        if (empty($image_id) || empty($district_id)) {
            redirect('admin/districts');
        }
        
        // Get image path
        $image = $this->districtPicsModel->first(['id' => $image_id]);
        
        if ($image && file_exists($image->image_location)) {
            unlink($image->image_location);
        }
        
        // Delete from database
        $this->districtPicsModel->delete($image_id);
        
        $_SESSION['success'] = "Gallery image deleted successfully";
        redirect('admin/districts/edit/' . $district_id);
    }
    
    public function addAttraction($params = []) {
        $district_id = $params[0] ?? '';
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/districts');
        }
        
        // Validate inputs
        $errors = [];
        
        if (empty($_POST['attraction_name'])) {
            $errors[] = "Attraction name is required";
        }
        
        if (empty($_POST['description'])) {
            $errors[] = "Description is required";
        }
        
        if (empty($_FILES['attraction_image']['name'])) {
            $errors[] = "Attraction image is required";
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('admin/districts/edit/' . $district_id);
        }
        
        // Upload attraction image
        $uploadResult = $this->uploadImage('attraction_image', 'attractions/');
        
        if (!$uploadResult['success']) {
            $_SESSION['error'] = $uploadResult['error'];
            redirect('admin/districts/edit/' . $district_id);
        }
        
        // Add attraction to database
        $attractionData = [
            'district_id' => $district_id,
            'attraction_name' => $_POST['attraction_name'],
            'description' => $_POST['description'],
            'image_path' => $uploadResult['path']
        ];
        
        $this->attractionsModel->insert($attractionData);
        
        $_SESSION['success'] = "Attraction added successfully";
        redirect('admin/districts/edit/' . $district_id);
    }
    
    public function editAttraction($params = []) {
        $attraction_id = $params[0] ?? '';
        
        if (empty($attraction_id)) {
            redirect('admin/districts');
        }
        
        // Get attraction details
        $attraction = $this->attractionsModel->first(['id' => $attraction_id]);
        
        if (!$attraction) {
            $_SESSION['error'] = "Attraction not found";
            redirect('admin/districts');
        }
        
        // Get attraction images
        $attractionPics = $this->attractionPicsModel->where(['attraction_id' => $attraction_id]);
        
        $data = [
            'attraction' => $attraction,
            'attraction_pics' => $attractionPics
        ];
        
        $this->view('admin/districts/editAttraction', $data);
    }
    
    public function updateAttraction($params = []) {
        $attraction_id = $params[0] ?? '';
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('admin/districts');
        }
        
        // Get attraction to get district_id
        $attraction = $this->attractionsModel->first(['id' => $attraction_id]);
        
        if (!$attraction) {
            $_SESSION['error'] = "Attraction not found";
            redirect('admin/districts');
        }
        
        // Validate inputs
        $errors = [];
        
        if (empty($_POST['attraction_name'])) {
            $errors[] = "Attraction name is required";
        }
        
        if (empty($_POST['description'])) {
            $errors[] = "Description is required";
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('admin/districts/editAttraction/' . $attraction_id);
        }
        
        // Update attraction data
        $data = [
            'attraction_name' => $_POST['attraction_name'],
            'description' => $_POST['description']
        ];
        
        // Upload image if provided
        if (!empty($_FILES['attraction_image']['name'])) {
            $uploadResult = $this->uploadImage('attraction_image', 'attractions/');
            
            if ($uploadResult['success']) {
                // Delete old image if exists
                if ($attraction->image_path && file_exists($attraction->image_path)) {
                    unlink($attraction->image_path);
                }
                
                $data['image_path'] = $uploadResult['path'];
            } else {
                $_SESSION['error'] = $uploadResult['error'];
                redirect('admin/districts/editAttraction/' . $attraction_id);
            }
        }
        
        $this->attractionsModel->update($attraction_id, $data);
        
        $_SESSION['success'] = "Attraction updated successfully";
        redirect('admin/districts/editAttraction/' . $attraction_id);
    }
    
    public function deleteAttraction($params = []) {
        $attraction_id = $params[0] ?? '';
        $district_id = $params[1] ?? '';
        
        if (empty($attraction_id) || empty($district_id)) {
            redirect('admin/districts');
        }
        
        // Get attraction details
        $attraction = $this->attractionsModel->first(['id' => $attraction_id]);
        
        if (!$attraction) {
            $_SESSION['error'] = "Attraction not found";
            redirect('admin/districts/edit/' . $district_id);
        }
        
        // Delete attraction image
        if ($attraction->image_path && file_exists($attraction->image_path)) {
            unlink($attraction->image_path);
        }
        
        // Delete attraction pictures
        $attractionPics = $this->attractionPicsModel->where(['attraction_id' => $attraction_id]);
        
        foreach ($attractionPics as $pic) {
            if ($pic->image_path && file_exists($pic->image_path)) {
                unlink($pic->image_path);
            }
            $this->attractionPicsModel->delete($pic->id);
        }
        
        // Delete attraction
        $this->attractionsModel->delete($attraction_id);
        
        $_SESSION['success'] = "Attraction deleted successfully";
        redirect('admin/districts/edit/' . $district_id);
    }
    
    private function uploadImage($fileInputName, $directory) {
        // Check if uploads directory exists
        $uploads_dir = "assets/images/" . $directory;
        
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        
        $target_file = $uploads_dir . basename($_FILES[$fileInputName]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if file is an actual image
        $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
        if (!$check) {
            return [
                'success' => false,
                'error' => "File is not an image."
            ];
        }
        
        // Check file size (limit to 5MB)
        if ($_FILES[$fileInputName]["size"] > 5000000) {
            return [
                'success' => false,
                'error' => "File is too large. Maximum size is 5MB."
            ];
        }
        
        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return [
                'success' => false,
                'error' => "Only JPG, JPEG & PNG files are allowed."
            ];
        }
        
        // Generate unique filename to prevent overwriting
        $new_filename = uniqid() . '.' . $imageFileType;
        $target_file = $uploads_dir . $new_filename;
        
        // Upload file
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target_file)) {
            return [
                'success' => true,
                'path' => $target_file
            ];
        } else {
            return [
                'success' => false,
                'error' => "There was an error uploading your file."
            ];
        }
    }
    
    // Method to handle Hotel and Restaurant functionality
    public function manageHotels($params = []) {
        $district_id = $params[0] ?? '';
        
        if (empty($district_id)) {
            redirect('admin/districts');
        }
        
        // Implementation for hotel management would go here
        // This would require additional models for hotels
        
        $data = [
            'district_id' => $district_id
        ];
        
        $this->view('admin/districts/manageHotels', $data);
    }
    
    public function manageRestaurants($params = []) {
        $district_id = $params[0] ?? '';
        
        if (empty($district_id)) {
            redirect('admin/districts');
        }
        
        // Implementation for restaurant management would go here
        // This would require additional models for restaurants
        
        $data = [
            'district_id' => $district_id
        ];
        
        $this->view('admin/districts/manageRestaurants', $data);
    }
}