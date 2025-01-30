<?php

    class ViewParticularHotel extends Controller{

        private $hotelModel;
        private $hotelPicsModel;
        private $hotelRoomTypesModel;
        private $commonRoomTypesModel;

        public function __construct(){
            $this->hotelModel = new Hotel();
            $this->hotelPicsModel = new HotelPicsModel();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->commonRoomTypesModel = new CommonRoomTypesModel();
        }

        public function index(){

            $data['hotelData'] = $this->hotelModel->getDetailsByHotelId(13);
            $data['hotelPics'] = $this->hotelPicsModel->getImagesByHotelId(13);
            $data['hotelRoomTypes'] = $this->hotelRoomTypesModel->getHotelRoomTypesByHotelId(13);

            $i = 0;
            foreach( $data['hotelRoomTypes'] as $hotelRoomType){
                $data['hotelRoomTypesNames'][$i] = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($hotelRoomType->roomType_Id);
                $i++;
            }

            $this->view('traveler/particularHotel', $data);
            
        }
        
    }