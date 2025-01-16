<?php
    class EventTermsAndConds{
        use Model;

        protected $table = "event_terms_conditions"; 

        protected $allowedColumns = [
            "termAndCondition"
        ];

        public function getTermsAndConditions(){
            $data = $this->selectAll();
            return $data;
        }
    }