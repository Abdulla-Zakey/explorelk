<?php

    class Tdashboard extends Controller {

        public function index($a = '', $b = '', $c = ''){

           

            $this->view('travelagent/dashboard');
            
        }
    }