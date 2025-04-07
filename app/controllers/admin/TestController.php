<?php

class TestController extends Controller {
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
            'attractions' => [
                (object)[
                    'id' => 1,
                    'attraction_name' => 'Sigiriya Rock Fortress',
                    'district_name' => 'Matale',
                    'preview_image' => 'assets/images/Travelers/topDistricts/kandy.jpg',
                    'description_paragraph1' => 'Sigiriya, also known as Lion Rock, is a historical and archaeological marvel...',
                    'image_count' => 12,
                    'todo_count' => 5
                ],
                (object)[
                    'id' => 2,
                    'attraction_name' => 'Yala National Park',
                    'district_name' => 'Hambantota',
                    'preview_image' => 'assets/images/Travelers/topDistricts/jaffna.jpg',
                    'description_paragraph1' => 'Yala National Park is home to the highest density of leopards in the world...',
                    'image_count' => 30,
                    'todo_count' => 8
                ],
                (object)[
                    'id' => 3,
                    'attraction_name' => 'Temple of the Tooth Relic',
                    'district_name' => 'Kandy',
                    'preview_image' => 'assets/images/Travelers/topDistricts/galle.jpg',
                    'description_paragraph1' => 'The Temple of the Sacred Tooth Relic houses the tooth of the Buddha...',
                    'image_count' => 15,
                    'todo_count' => 4
                ]
            ],
            'districts' => $districts,
            'selected_district' => null,
            'pagination' => '<a href="?page=1">1</a> <a href="?page=2">2</a>'
        ];

        
        
        // $data = [
        //     'districts' => $districts
        // ];

        
        $this->view('admin/test', $data);
    }

    public function edit($params = []) {
        $district_id = $params[0] ?? '';
        
        if (empty($district_id)) {
            redirect('admin/TestController');
        }
        
        // Get district details
        $district = $this->topDistrictsModel->first(['district_id' => $district_id]);
        
        if (!$district) {
            $_SESSION['error'] = "District not found";
            redirect('admin/TestController');
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
        
        $this->view('admin/editDistrict', $data);
    }
}