<?php

class GuideBankAccount {
    use Model;

    protected $table = 'tourguidebankaccount';

    protected $allowedColumns = [
        'tourGuide_bankAccount_Id',
        'guide_Id',  // Add this if not already present
        'tourGuide_accountNum',
        'tourGuide_bankName',
        'tourGuide_bankBranch',
        'paymentMethod'
    ];
    
    // Update the checkExistingACNum method to check for specific guide
    public function checkExistingACNum($account_Num, $guide_Id)
    {
        $result = $this->where([
            'tourGuide_accountNum' => $account_Num,
            'guide_Id' => $guide_Id
        ]);
        return is_array($result) && !empty($result);
    }

    // public function checkExistingACNum($account_Num)
    // {
    //     $result = $this->where(['tourGuide_accountNum' => $account_Num]);
    //     return is_array($result) && !empty($result);
    // }

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