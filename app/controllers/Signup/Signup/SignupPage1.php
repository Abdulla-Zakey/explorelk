<?php

    class SignupPage1{

        use Controller;
        public function index($a = '', $b = '', $c = ''){

           

            $this->view('signup/signupPage1');
            
        }
    }