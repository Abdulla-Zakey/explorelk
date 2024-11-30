<?php

    class Hguest{

        use Controller;
        public function index($a = '', $b = '', $c = ''){

           

            $this->view('hotel/guest');
            
        }
    }