<?php

    class ViewParticularHotel extends Controller{

        private $travelerModel;
        private $topDistrictsModel;
        private $hotelModel;
        private $hotelPicsModel;
        private $hotelRoomTypesModel;
        private $commonRoomTypesModel;
        private $commonRoomAmenitiesModel;
        private $hotelRoomTypeAmenitiesModel;
        private $roomsModel;
        private $roomBookingsFinalModel;
        private $hotelGuestsModel;

        public function __construct(){
            $this->travelerModel = new Traveler();
            $this->topDistrictsModel = new TopDistrictsModel();
            $this->hotelModel = new Hotel();
            $this->hotelPicsModel = new HotelPicsModel();
            $this->hotelRoomTypesModel = new HotelRoomTypesModel();
            $this->commonRoomTypesModel = new CommonRoomTypesModel();
            $this->commonRoomAmenitiesModel = new commonRoomAmenitiesModel();
            $this->hotelRoomTypeAmenitiesModel = new HotelRoomTypeAmenitiesModel();
            $this->roomsModel = new RoomsModel();
            $this->roomBookingsFinalModel = new RoomBookingsFinalModel();
            $this->hotelGuestsModel  = new HotelGuestsModel();
        }

        public function index(){

            $userID = $_SESSION['traveler_id'];
            $data['userData'] = $this->travelerModel->first(['traveler_Id' => $userID]);
            $data['hotelData'] = $this->hotelModel->getDetailsByHotelId(18);
            $data['hotelPics'] = $this->hotelPicsModel->getImagesByHotelId(18);
            $data['hotelRoomTypes'] = $this->hotelRoomTypesModel->getHotelRoomTypesByHotelId(18);

            $districtName = $data['hotelData']->district;
            $data['districtData'] = $this->topDistrictsModel->where(['district_name'=> $districtName]);

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

        public function recordBookingRequest() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                // echo "<pre>";
                // print_r($_POST);
                // echo "</pre>";
                // die(); 
                
                // Calculate advance payment (25% of total)
                $totalRooms = str_replace(' Room', '', $_POST['bookedRoomCount']);
                $totalAmount = str_replace(' LKR', '', $_POST['totalAmount']);
                $advancePayment = $totalAmount * 0.25; // 25% advance
                
                $data = [
                    'traveler_Id' => $_SESSION['traveler_id'],
                    'hotel_Id' => $_POST['hotelId'],
                    'hotel_roomType_Id' => $_POST['hotelRoomTypeId'],
                    'check_in' => $_POST['finalCheckInDate'],
                    'check_out' => $_POST['finalCheckOutDate'],
                    'total_rooms' => $totalRooms,
                    'special_requests' => $_POST['guestSpecialRequests'],
                    'total_amount' => $totalAmount,
                    'advance_payment_amount' => $advancePayment,
                    'booking_status' => 'Pending'
                ];
                
                $roomBookingId = $this->roomBookingsFinalModel->insert($data);
                
                if($roomBookingId) {

                    $guestData = [
                        'room_booking_Id' => $roomBookingId,
                        'guest_full_name' => $_POST['guestFullName'],
                        'guest_nic' => $_POST['guestNIC'],
                        'guest_email' => $_POST['guestEmail'],
                        'guest_mobile_num' => $_POST['guestMobileNum']
                    ];

                    $guestId = $this->hotelGuestsModel->insert($guestData);

                    if($guestId){
                        redirect('traveler/ViewParticularHotel?success=booking_request_submitted&booking_id=' . $roomBookingId);
                    }
                    else{
                        redirect('traveler/ViewParticularHotel?error=guest_details_recording_failed');
                    }
                    
                } else {
                    // Handle error
                    redirect('traveler/ViewParticularHotel?error=booking_request_failed');
                }
            }
        }
        
    }