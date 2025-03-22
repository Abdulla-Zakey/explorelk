<?php

class GuideBankAccount {
    use Model;

    protected $table = 'tourguidebankaccount';

    protected $allowedColumns = [
        'tourGuide_bankAccount_Id',
        'tourGuide_accountNum',
        'tourGuide_bankName',
        'tourGuide_bankBranch',
        'paymentMethod'
    ];

    public function checkExistingACNum($account_Num)
    {
        $result = $this->where(['tourGuide_accountNum' => $account_Num]);
        return is_array($result) && !empty($result);
    }

    public function validate($data){
        $this->errors = [];
    
        // Required fields for profile update
        if (empty($data['tourGuide_accountNum'])) {
            $this->errors['tourGuide_accountNum'] = "Account number required.";
        } 

        if (empty($data['tourGuide_bankName'])) {
            $this->errors['tourGuide_bankName'] = "Bank name required.";
        } 

        if (empty($data['tourGuide_bankBranch'])) {
            $this->errors['tourGuide_bankBranch'] = "Bank branch required.";
        } 

        return empty($this->errors);
    }
}