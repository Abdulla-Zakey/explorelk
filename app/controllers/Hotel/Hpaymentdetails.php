<?php

    class Hpaymentdetails extends Controller {

        private $hotelModel;
        public function __construct() {
            $this->hotelModel = new Hotel();
        }
       
        public function index($a = '', $b = '', $c = ''){

            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);

           

            $this->view('hotel/paymentdetails',data: $data);
            
        }
    }