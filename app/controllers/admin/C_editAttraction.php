<?php 

/**
 * Edit attraction class
 */
class C_editAttraction extends Controller {

    private $attractionsModel;
	private $attractionPicsModel;
	private $thingsToDoModel;

    public function __construct(){
        $this->attractionsModel = new AttractionsModel();
        $this->attractionPicsModel = new AttractionPicsModel();
		$this->thingsToDoModel = new ThingsToDoModel();
	}
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // show($_POST);

            $attraction_id = $_POST['attraction_id'];

            // Update basic attraction details
            $attraction_data = [
                'attraction_name' => $_POST['attraction_name'],
                'district_id' => $_POST['district_id'],
                'description_paragraph1' => $_POST['description_paragraph1'],
                'description_paragraph2' => $_POST['description_paragraph2'], 
                'description_paragraph3' => $_POST['description_paragraph3'],
                'iframe' => $_POST['iframe'],
            ];

            // Update attraction record
            $this->attractionsModel->update($attraction_id, $attraction_data,'attraction_id');

            // Handle deleted images
            if(isset($_POST['deleted_image_ids']) && is_array($_POST['deleted_image_ids'])) {
                foreach($_POST['deleted_image_ids'] as $attraction_pic_id) {
                    // Get the image details first to delete the file
                    $image = $this->attractionPicsModel->where(['attraction_pic_id' => $attraction_pic_id]);
                    if($image) {
                        // show($image);
                        // Delete the file if it exists
                        if(file_exists(ROOT . $image[0]->image_location)) {
                            unlink(ROOT . $image[0]->image_location);
                        }
                        // Delete the database record
                        $this->attractionPicsModel->delete($attraction_pic_id, 'attraction_pic_id');
                    }
                }
            }

            // Handle deleted activities
            if(isset($_POST['deleted_activity_ids']) && is_array($_POST['deleted_activity_ids'])) {
                foreach($_POST['deleted_activity_ids'] as $todo_id) {
                    $this->thingsToDoModel->delete($todo_id, 'todo_id');
                }
            }

            // Handle new activities
            if(isset($_POST['new_activity_name']) && is_array($_POST['new_activity_name'])) {
                for($i = 0; $i < count($_POST['new_activity_name']); $i++) {
                    $todo_data = [
                        'attraction_id' => $attraction_id,
                        'activity_name' => $_POST['new_activity_name'][$i],
                        'icon_class' => $_POST['new_activity_icon'][$i],
                        'activity_description' => $_POST['new_activity_desc'][$i],
                    ];

                    //show($todo_data);
                    
                    $this->thingsToDoModel->insert($todo_data);
                }
            }

            // Handle new images (file uploads)
            if(isset($_FILES['image_upload']) && is_array($_FILES['image_upload']['name'])) {
                $upload_path = 'assets/images/admin/attractionPics/attraction_Id_'. $attraction_id . '/';
                
                // Create directory if it doesn't exist
                if(!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
                
                for($i = 0; $i < count($_FILES['image_upload']['name']); $i++) {
                    if($_FILES['image_upload']['error'][$i] == 0) {
                        $filename = 'attrction_image' . '_' . $_FILES['image_upload']['name'][$i];
                        $destination = $upload_path . $filename;
                        // assets/images/Travelers/topDistricts/nuwaraEliya/gregorLake/Image5.jpg
                        
                        if(move_uploaded_file($_FILES['image_upload']['tmp_name'][$i], $destination)) {
                            $image_data = [
                                'attraction_id' => $attraction_id,
                                'image_location' => $destination,
                            ];
                            
                            $this->attractionPicsModel->insert($image_data);
                        }
                    }
                }
            }

            // $this->set_message('success', 'Attraction updated successfully');
            // redirect('admin/attractions');

            // if ($this->attractionsModel->update($attraction_id, $attraction_data,'attraction_id')) {
            //     # code...
            //     echo 'Success';
            // }

            redirect('admin/C_attractions');
            
        }
    }
}