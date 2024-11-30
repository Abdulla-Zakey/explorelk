<?php

    class Hnotifications{

        use Controller;
        public function index($a = '', $b = '', $c = ''){

           

            $this->view('hotel/notifications');
            
        }
    }