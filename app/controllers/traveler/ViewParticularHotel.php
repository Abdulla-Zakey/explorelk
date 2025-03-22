<?php

    class ViewParticularHotel extends Controller{

        private $travelerModel;
        private $hotelModel;
        private $hotelPicsModel;
        private $hotelRoomTypesModel;
        private $commonRoomTypesModel;
        private $commonRoomAmenitiesModel;
        private $hotelRoomTypeAmenitiesModel;
        private $roomsModel;

        public function __construct(){
            $this->travelerModel = new Traveler();
            $this->hotelModel = new Hotel();
            $this->hotelPicsModel = new HotelPicsModel();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->commonRoomTypesModel = new CommonRoomTypesModel();
            $this->commonRoomAmenitiesModel = new commonRoomAmenitiesModel();
            $this->hotelRoomTypeAmenitiesModel = new HotelRoomTypeAmenitiesModel();
            $this->roomsModel = new RoomsModel();
        }

        public function index(){

            $userID = $_SESSION['traveler_id'];
            $data['userData'] = $this->travelerModel->first(['traveler_Id' => $userID]);
            $data['hotelData'] = $this->hotelModel->getDetailsByHotelId(18);
            $data['hotelPics'] = $this->hotelPicsModel->getImagesByHotelId(18);
            $data['hotelRoomTypes'] = $this->hotelRoomTypesModel->getHotelRoomTypesByHotelId(18);

            $i = 0;
            $tempRoomTypesNames = [];
            $tempRoomTypeAmenitiesIdList = [];
            $tempRoomTypeAmenitiesNameAndClassList = [];
            foreach( $data['hotelRoomTypes'] as $hotelRoomType){
               $tempRoomTypesNames[$i] = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($hotelRoomType->roomType_Id);
               $tempRoomTypeAmenityIdList[$i] = $this->hotelRoomTypeAmenitiesModel->getRoomTypeAmenities($hotelRoomType->hotel_roomType_Id);
               $j = 0;
               foreach($tempRoomTypeAmenityIdList[$i] as $RoomTypeAmenity){
                    $tempRoomTypeAmenitiesNameAndClassList[$i][$j] = $this->commonRoomAmenitiesModel->getAmenityDetailsById($RoomTypeAmenity->amenity_Id);
                    $j++;
               }
               $i++;
            }

            $data['hotelRoomTypesNames'] = $tempRoomTypesNames;
            $data['hotelRoomTypeAmenityList'] = $tempRoomTypeAmenitiesNameAndClassList;

            // $this->view('traveler/particularHotel', $data);
            $this->view('traveler/temp', $data);

        }

        public function getRoomTypeDetails($id) {
            $roomTypeModel = new HotelRoomTypesModel();
            $amenitiesModel = new HotelRoomTypeAmenitiesModel();
            
            $roomType = $roomTypeModel->getHotelRoomTypeDetailsById($id);
            $amenities = $amenitiesModel->getRoomTypeAmenities($id);
            
            $data = [
                'roomType' => $roomType,
                'amenities' => $amenities
            ];
            
            header('Content-Type: application/json');
            echo json_encode($data);
        }
        
    }