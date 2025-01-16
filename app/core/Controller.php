<?php

    class Controller{

        public function view($name, $data = []){
            $fileName = "../app/views/".$name.".view.php";
            extract($data);
            if(file_exists($fileName)){
                require $fileName;
            }
            else{
                $fileName = "../app/views/404.view.php";
                require $fileName;
            }
        }
    }
    