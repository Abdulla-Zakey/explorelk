<?php

    class Eosignup extends Controller{

        public function index($a = '', $b = '', $c = ''){

           $this->view('eventorganizer/eosignup');
            
        }


        public function signup(){
            // Check if the form is submitted
            $this->view('eventorganizer/eoregister');
        }
    }

    