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
        private $notificationsModel;
        private $accommodationBookingNotificationsModel;

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
            $this->notificationsModel = new NotificationsModel();
            $this->accommodationBookingNotificationsModel = new AccommodationBookingNotifications();
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

            $this->view('traveler/particularHotel', $data);
            // $this->view('traveler/temp', $data);

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

                    $hotelData = $this->hotelModel->getDetailsByHotelId($_POST['hotelId']);
                    
                    $notificationData = [
                        'recipient_type' => 'traveler',
                        'recipient_Id' => $_SESSION['traveler_id'],
                        'notification_type' => 'accommodation_related',
                        'notification_title' => 'Booking Request Submitted for ' . $hotelData->hotelName,
                        'notification_text' => 'Your booking request for ' . $hotelData->hotelName . ' has been successfully submitted. 
                                                Please make the advance payment before '. date('F d, Y', strtotime($advancePaymentDeadline)) . ' at 11:59 PM to confirm your booking'
                    ];

                    $commisionId = $this->hotelCommissionsModel->insert($commissionData);

                    $guestId = $this->hotelGuestsModel->insert($guestData);

                    if($guestId && $commisionId) {
                        $notificationId = $this->notificationsModel->insert($notificationData);

                        if($notificationId){
                            $accommodationBookingNotificationData = [
                                'notification_Id' => $notificationId,
                                'room_booking_Id' => $roomBookingId
                            ];

                            $result = $this->accommodationBookingNotificationsModel->insert($accommodationBookingNotificationData);

                            if($result){
                                redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?success=booking_request_submitted&booking_id=' . $roomBookingId);
                            }
                            else{
                                redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=booking_request_submitted_but_failed_to_generate_accommodation_notification&booking_id=' . $roomBookingId);
                            }
                        }
                        else{
                            redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=booking_request_submitted_but_failed_to_generate_notification&booking_id=' . $roomBookingId);
                        }
                        
                    }
                    else if(!$commisionId){
                        redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=commision_details_recording_failed');
                    }
                    else if(!$guestId){
                        redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=guest_details_recording_failed');
                    }
                    
                } else {
                    // Handle error
                    redirect('traveler/ViewParticularHotel/index/'. $_POST['hotelId'] .'?error=booking_request_failed');
                }
            }
        }
        
    }