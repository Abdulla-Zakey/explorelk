<?php
    
    class HotelSearchResults extends Controller {

        private $hotelModel;
        private $hotelPicsModel;

        public function __construct(){
            $this->hotelModel = new Hotel();
            $this->hotelPicsModel = new HotelPicsModel();
        }

        public function index() {

             // Check if the user is already logged in
            if (!isset($_SESSION['traveler_id'])) {
                redirect('traveler/RegisteredTravelerHome');
                exit();
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['district']) && !empty($_POST['district'])) {
                    // Store search parameters in session
                    $_SESSION['search_district'] = $_POST['district'];
                    if(isset($_POST['province'])) {
                        $_SESSION['search_province'] = $_POST['province'];
                    }
                    
                    // Redirect to the same page using GET
                    redirect('traveler/HotelSearchResults/results');
                } else {
                    // Handle missing district data
                    redirect('traveler/FindAHotel');
                }
            } else {
                // Handle direct GET requests to index
                redirect('traveler/FindAHotel');
            }
        }
        
        public function results() {
            // This method handles the GET request after redirection
            if(isset($_SESSION['search_district'])) {
                $district = $_SESSION['search_district'];
                
                $districtHotelData = $this->hotelModel->where(['district' => $district]);
                
                // Add district to data array
                $data['district'] = $district;
                if(isset($_SESSION['search_province'])) {
                    $data['province'] = $_SESSION['search_province'];
                }
                
                foreach($districtHotelData as $hotel){
                    $hotelImage = $this->hotelPicsModel->first(['hotel_Id' => $hotel->hotel_Id]);
                    $hotel->image_path = $hotelImage ? $hotelImage->image_path : null;
                }
                
                $data['hotels'] = $districtHotelData;
                
                $this->view('traveler/hotelSearchResults', $data);
            } else {
                redirect('traveler/FindAHotel');
            }
        }
    }
