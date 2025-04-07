<?php

    class DummyController extends Controller{

        private $hotelModel;
        private $hotelPicsModel;
        private $hotelRoomTypesModel;
        private $commonRoomTypesModel;
        private $commonRoomAmenitiesModel;
        private $hotelRoomTypeAmenitiesModel;
        private $roomsModel;

        public function __construct(){
            $this->hotelModel = new Hotel();
            $this->hotelPicsModel = new HotelPicsModel();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->commonRoomTypesModel = new CommonRoomTypesModel();
            $this->commonRoomAmenitiesModel = new commonRoomAmenitiesModel();
            $this->hotelRoomTypeAmenitiesModel = new HotelRoomTypeAmenitiesModel();
            $this->roomsModel = new RoomsModel();
        }

        public function index($hotelId){

            $data['hotelData'] = $this->hotelModel->getDetailsByHotelId($hotelId);
            $data['hotelPics'] = $this->hotelPicsModel->getImagesByHotelId($hotelId);
            $data['hotelRoomTypes'] = $this->hotelRoomTypesModel->getHotelRoomTypesByHotelId($hotelId);

            $i = 0;
            $tempRoomTypesNames = [];
            $tempRoomTypeAmenitiesIdList = [];
            $tempRoomTypeAmenitiesNameAndClassList = [];
            foreach( $data['hotelRoomTypes'] as $hotelRoomType){
               $tempRoomTypesNames[$i] = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($hotelRoomType->roomType_Id);
               $tempRoomTypeAmenityIdList[$i] = $this->hotelRoomTypeAmenitiesModel->getRoomTypeAmenities($hotelRoomType->hotel_roomType_Id);
               $j = 0;
               foreach($tempRoomTypeAmenityIdList[$i] as $RoomTypeAmenity){
                    $tempRoomTypeAmenitiesNameAndClassList[$j] = $this->commonRoomAmenitiesModel->getAmenityDetailsById($RoomTypeAmenity->amenity_Id);
                    $j++;
               }
            }

            // $data['hotelRoomTypesNames'] = $tempRoomTypesName;
            $data['hotelRoomTypeAmenityList'] = $tempRoomTypeAmenitiesNameAndClassList;

            // $i = 0;
            // foreach( $data['hotelRoomTypes'] as $hotelRoomType){
            //     $data['hotelRoomTypesNames'][$i] = $this->commonRoomTypesModel->getGenericRoomTypeDetailsByTypeId($hotelRoomType->roomType_Id);
            //     $data['hotelRoomTypeAmenities'][$i] = $this->hotelRoomTypeAmenitiesModel->getRoomTypeAmenities($hotelRoomType->hotel_roomType_Id);
            //     $j = 0;
            //     foreach( $data['hotelRoomTypeAmenities'][$i] as $roomTypeAmenity){
            //         $data['hotelRoomTypeAmenities'][$i][$j]['amenity'] = $this->commonRoomAmenitiesModel->getAmenityDetailsById($roomTypeAmenity->amenity_Id);
            //         $j++;
            //     }
            //     $i++;
            // }

            

            // $this->view('traveler/particularHotel', $data);
            $this->view('traveler/dummy', $data);
            
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