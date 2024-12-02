<?php

Trait Database{
    private function connect(){
        $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
        $con = new PDO($string, DBUSER, DBPASS);
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }

    /**This function is used to get the first value from a result set */
    public function get_row($query, $data = []){

        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);

        if($check){

            $result = $stm->fetchALL(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){

                return $result[0];
            }
        }

        return false;
    }

     /**This function is used to get all values from a result set */
    public function query($query, $data = []){

        $con = $this->connect();
        $stm = $con->prepare($query);
        $check = $stm->execute($data);

        if($check){
            $result = $stm->fetchALL(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
                return $result;
            }
            return [];
        }
        return false;
    }
}


    