<?php

    class Hreports{

        use Controller;
        public function index($a = '', $b = '', $c = ''){

           

            $this->view('hotel/reports');
            
        }
    }