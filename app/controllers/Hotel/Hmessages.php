<?php

    class Hmessages{

        use Controller;
        public function index($a = '', $b = '', $c = ''){

           

            $this->view('hotel/messages');
            
        }
    }