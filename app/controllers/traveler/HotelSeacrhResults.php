<?php

    // class HotelSearchResults extends Controller{

    //     public function index(){

    //         $this->view('traveler/hotelSearchResults');
            
    //     }
    // }
    
    class HotelSearchResults extends Controller {  // Fixed class name
        public function index() {
            $this->view('traveler/hotelSearchResults');  // This should match your view file name exactly
        }
    }
