<?php

    class Hsettings extends Controller {

        private $hotelModel;
        public function __construct() {
            $this->hotelModel = new Hotel();
        }
       
        public function index($a = '', $b = '', $c = ''){

            $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);

            $this->view('hotel/settings', $data);
            
        }
        
        
        // public function index() {
        //     $hotelModel = new M_Hotel();
        //     $hotelData = $hotelModel->where(['id' => $_SESSION['user_id']])->first();
            
        //     $this->view('hotel/settings', [
        //         'hotel' => $hotelData
        //     ]);
        // }
        
    }