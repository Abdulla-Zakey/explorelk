<?php

class TravelAgent
{
    use Model;

    protected $table = 'travelprovider';

    protected $allowedColumns = [
        'travelagent_Id',
        'travelagentName',
        'serviceProviderName',
        'travelagentEmail',
        'travelagentPassword',
        'travelagentMobileNum',
        'travelagentAddress',
        'district',
        'province',
        'description_para1',
        'profile_picture',
        'yearStarted',
        'BRNum'
    ];

    public function validate($data, $isUpdate = false)
    {
        $this->errors = [];

        // Validate travelagentEmail
        if (empty($data['travelagentEmail'])) {
            $this->errors['travelagentEmail'] = "Email is required.";
        } elseif (!filter_var($data['travelagentEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['travelagentEmail'] = "Email is not valid.";
        }

        // Validate travelagentName
        if (empty($data['travelagentName'])) {
            $this->errors['travelagentName'] = "Travel agent name is required.";
        } elseif (strlen($data['travelagentName']) < 2) {
            $this->errors['travelagentName'] = "Travel agent name must be at least 2 characters long.";
        } elseif (strlen($data['travelagentName']) > 100) {
            $this->errors['travelagentName'] = "Travel agent name cannot exceed 100 characters.";
        }

        // Validate serviceProviderName
        if (empty($data['serviceProviderName'])) {
            $this->errors['serviceProviderName'] = "Owner name is required.";
        } elseif (strlen($data['serviceProviderName']) > 100) {
            $this->errors['serviceProviderName'] = "Owner name cannot exceed 100 characters.";
        }

        // Validate travelagentMobileNum
        if (empty($data['travelagentMobileNum'])) {
            $this->errors['travelagentMobileNum'] = "Mobile number is required.";
        } elseif (!preg_match('/^\+?\d{10,15}$/', $data['travelagentMobileNum'])) {
            $this->errors['travelagentMobileNum'] = "Mobile number is not valid.";
        }

        // Validate travelagentAddress
        if (empty($data['travelagentAddress'])) {
            $this->errors['travelagentAddress'] = "Address is required.";
        }

        // Validate district
        if (empty($data['district'])) {
            $this->errors['district'] = "District is required.";
        }

        // Validate province
        if (empty($data['province'])) {
            $this->errors['province'] = "Province is required.";
        }

        // Validate description_para1
        if (empty($data['description_para1'])) {
            $this->errors['description_para1'] = "First description paragraph is required.";
        }

        return empty($this->errors);
    }

    public function getDetailsByTravelAgentId($travelagent_Id)
    {
        return $this->first(['travelagent_Id' => $travelagent_Id]);
    }
}