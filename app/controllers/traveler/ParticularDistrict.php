<?php

class ParticularDistrict extends Controller {

    private $hotelModel;
    private $hotelPicsModel;

    public function __construct(){
        $this->hotelModel = new Hotel();
        $this->hotelPicsModel = new HotelPicsModel();
    }

    public function index($params = []) {
        
        // For numeric IDs, we don't need urldecode
        $district_id = $params[0] ?? '';

        if (empty($district_id)) {
            redirect('traveler/TopDistricts');
        }

        $topDistrictsModel = new TopDistrictsModel();
        $districtPicsModel = new DistrictsPicsModel;
        $attractionsModel = new AttractionsModel(); 
        $attractionPicsModel = new AttractionPicsModel();

        // Get district details
        $district = $topDistrictsModel->first(['district_id' => $district_id]);
        
        if (!$district) {
            redirect('traveler/TopDistricts');
        }

        // Get district gallery pictures
        $galleryPics = $districtPicsModel->getPicturesForDistrict($district_id);

        // Get top 3 attractions for the district
        $attractions = $attractionsModel->where(['district_id' => $district_id]);
        
        $topAttractions = array_slice($attractions, 0, 3); // Get first 3 attractions

        $data = [
            'district' => $district,
            'gallery_pics' => $galleryPics,
            'attractions' => $topAttractions
        ];

        //Getting all the hotels available for the district
        $districtName = $district->district_name;
        $hotelsInDistrict = $this->hotelModel->where(['district' => $districtName]); 
        $finalHotels = [];
        
        if(!empty($hotelsInDistrict)){

            foreach($hotelsInDistrict as $hotel){
                $result = $this->hotelPicsModel->first(['hotel_Id' => $hotel->hotel_Id]);
                
                if(!empty($result)){
                    $hotel->image_path = $result->image_path;
                    $finalHotels[] = $hotel;
                }
               
            }

        }

        $data['hotels'] = $finalHotels;
        

        

        $this->view('traveler/particularDistrict', $data);
    }

    public function loadAttractionDetails($attraction_id = '') {
        if (empty($attraction_id)) {
            redirect('traveler/TopDistricts');
        }

        $attractionsModel = new AttractionsModel();
        $attraction = $attractionsModel->first(['id' => $attraction_id]);

        if (!$attraction) {
            redirect('traveler/TopDistricts');
        }

        // Load attraction details view with the data
        $this->view('traveler/attractionDetails', ['attraction' => $attraction]);
    }
}