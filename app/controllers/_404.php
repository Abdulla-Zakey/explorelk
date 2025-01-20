<?php

    class _404 extends Controller{

        // public function index(){
        //     echo "404 Page not found controller";
        // }
        public function index() {
            // Set HTTP response code
            http_response_code(404);
            
            $data['title'] = "Page Not Found";
            $this->view('_404', $data);
        }
    }

    
   