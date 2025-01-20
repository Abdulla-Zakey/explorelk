<?php

class TopDistricts extends Controller {
    private $districtModel;

    public function __construct() {
        $this->districtModel = new TopDistrictsModel();
    }

    public function index() {
        // Fetch all districts from the database
        $districts = $this->districtModel->selectALL();
        // var_dump($districts);
        
        // Process the districts data to include image paths
        $processedDistricts = array_map(function($district) {
            // Convert district name to lowercase and remove spaces for image filename
            $imageFilename = strtolower(str_replace(' ', '', $district->district_name));
            
            return [
                'id' => $district->district_id,
                'name' => $district->district_name,
                'about' => $district->about_the_district,
                // Use the provided image path structure
                'image_path' => ROOT . '/assets/images/travelers/topDistricts/' . $imageFilename . '.jpg'
            ];
        }, $districts);

        // Sort districts if a sort parameter is provided
        if (isset($_GET['sort'])) {
            switch ($_GET['sort']) {
                case 'alphabetical':
                    usort($processedDistricts, function($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
                    break;
                case 'reverse alphabetical':
                    usort($processedDistricts, function($a, $b) {
                        return strcmp($b['name'], $a['name']);
                    });
                    break;
                // Add more sorting options as needed
            }
        }

       // Search functionality
       if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = strtolower($_GET['search']);
        $processedDistricts = array_filter($processedDistricts, function($district) use ($searchTerm) {
            return strpos(strtolower($district['name']), $searchTerm) !== false;
        });
    }

        // Prepare data for the view
        $data = [
            'districts' => $processedDistricts,
            'title' => 'Top Destinations in Sri Lanka'
        ];

        // Load the view with the processed data
        $this->view('traveler/topDistricts', $data);
    }

    public function getDistrict($id) {
        // Get single district details
        $district = $this->districtModel->first(['district_id' => $id]);
        
        if ($district) {
            $imageFilename = strtolower(str_replace(' ', '', $district->district_name));
            $district->image_path = ROOT . '/assets/images/travelers/topDistricts/' . $imageFilename . '.jpg';
            
            $this->view('traveler/districtDetails', ['district' => $district]);
        } else {
            // Handle district not found
            redirect('traveler/topDistricts');
        }
    }

    public function search() {
        // Handle AJAX search requests
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $searchTerm = $_POST['search'];
            $results = $this->districtModel->where(['district_name', 'LIKE', "%$searchTerm%"]);
            
            // Return JSON response for AJAX
            header('Content-Type: application/json');
            echo json_encode($results);
            exit;
        }
    }
}