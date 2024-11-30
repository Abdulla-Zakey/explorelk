<?php

    /**
     * Main model trait for the application.
     */

     Trait Model{

        use Database;

        protected $limit = 10;
        protected $offset = 0;
        protected $order_type = "asc";
        protected $order_column = "id";
        

        public function selectALL(){

            $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

            return $this->query($query);

        }

        public function where($data, $data_not = []){

            $keys = array_keys($data);
            $keys_not = array_keys($data_not);

            $query = "SELECT * FROM $this->table WHERE ";

            foreach($keys as $key){
                $query .= $key . " = :" . $key . " && ";
            }

            foreach($keys_not as $key){
                $query .= $key . " != :" . $key . " && ";
            }

            $query = trim($query, " && ");

            $query .= " limit $this->limit offset $this->offset";

            $data = array_merge($data, $data_not);

            return $this->query($query, $data);
       
        }

        public function first($data, $data_not = []){

            $keys = array_keys($data);
            $keys_not = array_keys($data_not);

            $query = "SELECT * FROM $this->table WHERE ";

            foreach($keys as $key){
                $query .= $key . " = :" . $key . " && ";
            }

            foreach($keys_not as $key){
                $query .= $key . " != :" . $key . " && ";
            }

            $query = trim($query, " && ");

            $query .= " limit $this->limit offset $this->offset";

            $data = array_merge($data, $data_not);

            $result = $this->query($query, $data);

            if($result)
                return $result[0];
            
            return false;

        }

        public function insert($data){

            /**Remove unwanted data **/
            if(!empty($this->allowedColumns)){

                foreach($data as $key => $value){

                    if(!in_array($key, $this->allowedColumns)){

                        unset($data[$key]);
                    }
                }
            }

            $keys = array_keys($data);

            $query = "INSERT INTO $this->table(".implode(", ", $keys).") VALUES(:".implode(", :", $keys).")";

            if($this->query($query, $data)){
                return true;
            }
            
            return false;
            
        }

        public function update($id, $data, $id_column = 'id'){

            /**Remove unwanted data **/
            if(!empty($this->allowedColumns)){

                foreach($data as $key => $value){

                    if(!in_array($key, $this->allowedColumns)){

                        unset($data[$key]);
                    }
                }
            }
            
            
            $keys = array_keys($data);
            $query = "UPDATE $this->table SET ";

            foreach($keys as $key){
                $query .= $key . " = :" . $key . ", ";
            }

            $query = trim($query, ", ");

            $query .= " WHERE $id_column = :$id_column";

            $data[$id_column] = $id;
            
            return $this->query($query, $data);
            
        }

        public function delete($id, $id_column = 'id'){

            $data[$id_column] = $id;
            
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

            if($this->query($query, $data)){
                return true;
            }

            return false;
            
        }

     }