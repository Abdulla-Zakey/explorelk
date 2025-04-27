<?php

    class Tbookings extends Controller{

      
        public function index($a = '', $b = '', $c = ''){

           

            $this->view('travelagent/bookings');
            
        }
    }