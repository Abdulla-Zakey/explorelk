<?php

    class ViewParticularHotel extends Controller{

        private $hotelModel;
        private $advancedHotelModel;
        private $hotelPicsModel;

        public function __construct(){
            $this->hotelModel = new Hotel();
            $this->advancedHotelModel = new AdvancedHotelModel();
            $this->hotelPicsModel = new HotelPicsModel();
        }

        public function index(){

            $data['advancedHotelData'] = $this->advancedHotelModel->getDetailsByHotelId(13);
            $data['hotelPics'] = $this->hotelPicsModel->getImagesByHotelId(13);


            $this->view('traveler/particularHotel', $data);
            
        }
        
    }