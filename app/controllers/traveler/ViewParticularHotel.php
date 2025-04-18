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
        private $hotelReviewsModel;

        private $hotelCommissionsModel;

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
            $this->hotelReviewsModel = new HotelReviewsModel();
            $this->hotelCommissionsModel = new HotelCommissionsModel();
        }

        public function index($hotelId){

            $userID = $_SESSION['traveler_id'];
            $data['userData'] = $this->travelerModel->first(['traveler_Id' => $userID]);
            $data['hotelData'] = $this->hotelModel->getDetailsByHotelId($hotelId);
            $data['hotelPics'] = $this->hotelPicsModel->getImagesByHotelId($hotelId);
            $data['hotelRoomTypes'] = $this->hotelRoomTypesModel->getHotelRoomTypesByHotelId($hotelId);

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

            $data['hotelReviews'] = [];
            $hotelReviews = $this->hotelReviewsModel->where(['hotel_Id'=> $hotelId]);

            if ($hotelReviews) {
                foreach($hotelReviews as $hotelReview) {
                    $travelerId = $hotelReview->traveler_Id;
                    $traveler = $this->travelerModel->first(['traveler_Id' => $travelerId]);

                    $hotelReview->travelerUserName = $traveler->username;

                    $travelerProfilePic = $traveler ? $traveler->profilePicture : null;
                    $hotelReview->travelerProfilePicture = $travelerProfilePic;
                    
                    $data['hotelReviews'][] = $hotelReview;
                }
            }

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

                $advancePaymentDeadline = date('Y-m-d 23:59:00', strtotime('+3 days'));
                
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
                    'booking_status' => 'Pending',
                    'advance_payment_deadline' => $advancePaymentDeadline
                ];
                
                $roomBookingId = $this->roomBookingsFinalModel->insert($data);
                
                if($roomBookingId) {

                    $commissionAmount = ($totalAmount * 8) / 100;
                    $commissionData = [
                        'room_booking_Id' => $roomBookingId,
                        'hotel_Id' => $_POST['hotelId'],
                        'total_amount'=> $totalAmount,
                        'commission_rate' => 8.00,
                        'commission_amount' => $commissionAmount,
                        'is_applicable_for_commision' => 1
                    ];

                    $guestData = [
                        'room_booking_Id' => $roomBookingId,
                        'guest_full_name' => $_POST['guestFullName'],
                        'guest_nic' => $_POST['guestNIC'],
                        'guest_email' => $_POST['guestEmail'],
                        'guest_mobile_num' => $_POST['guestMobileNum']
                    ];

                    // show($commssionData);
                    // exit();
                    $commisionId = $this->hotelCommissionsModel->insert($commissionData);

                    $guestId = $this->hotelGuestsModel->insert($guestData);

                    if(!$commisionId){
                        redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=commision_details_recording_failed');
                    }

                    if($guestId){
                        redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?success=booking_request_submitted&booking_id=' . $roomBookingId);
                    }
                    else{
                        redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=guest_details_recording_failed');
                    }
                    
                } else {
                    // Handle error
                    redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=booking_request_failed');
                }
            }
        }
        
    }