<?php

class TravelerBankAccount
{
    use Model;

    protected $table = 'traveler_bank_account';

    protected $allowedColumns = [
        'traveler_Id', 
        'traveler_accountNum',
        'traveler_bankName',
        'traveler_bankBranch'
    ];

    // Check if email already exists
    public function checkExistingACNum($acNum)
    {
        $result = $this->where(['traveler_accountNum' => $acNum]);
        return !empty($result);
    }
}