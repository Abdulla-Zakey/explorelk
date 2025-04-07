<?php 

class Eventorganizer {
    use Model;

    protected $table = 'event_organizer'; 

    protected $allowedColumns = [
        'company_Email',
        'company_Password',
        'company_MobileNum',
        'company_Name',
        'company_Address',
        'status'
    ];

    public function validate($data)
    {
        $this->errors = [];

        // Validate company name
        if (empty($data['company_Name'])) {
            $this->errors['company_Name'] = "Company name is required.";
        } elseif (strlen($data['company_Name']) > 50) {
            $this->errors['company_Name'] = "Company name cannot exceed 50 characters.";
        }

        // Validate company email
        if (empty($data['company_Email'])) {
            $this->errors['company_Email'] = "Email is required.";
        } elseif (!filter_var($data['company_Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['company_Email'] = "Email is not valid.";
        } elseif ($this->checkExistingEmail($data['company_Email'])) {
            $this->errors['company_Email'] = "Email is already registered.";
        }

        // Validate company mobile number
        if (empty($data['company_MobileNum'])) {
            $this->errors['company_MobileNum'] = "Company mobile number is required.";
        } elseif (strlen($data['company_MobileNum']) > 12) {
            $this->errors['company_MobileNum'] = "Mobile number cannot exceed 10 characters.";
        }

        // Validate company address
        if (empty($data['company_Address'])) {
            $this->errors['company_Address'] = "Address is required.";
        } elseif (strlen($data['company_Address']) < 10) {
            $this->errors['company_Address'] = "Address must be at least 10 characters long.";
        } elseif (strlen($data['company_Address']) > 50) {
            $this->errors['company_Address'] = "Address cannot exceed 50 characters.";
        } 

        // Validate password
        if (empty($data['company_Password'])) {
            $this->errors['company_Password'] = "Password is required.";
        } elseif (strlen($data['company_Password']) < 8) {
            $this->errors['company_Password'] = "Password must be at least 8 characters long.";
        }

        // Validate confirm password
        if (empty($data['confirm_Password'])) {
            $this->errors['confirm_Password'] = "Confirm Password is required.";
        } elseif ($data['company_Password'] !== $data['confirm_Password']) {
            $this->errors['confirm_Password'] = "Password and Confirm Password do not match.";
        }

        return empty($this->errors);
    }

    // Check if email already exists
    public function checkExistingEmail($email)
    {
        $result = $this->where(['company_Email' => $email]);
        return !empty($result);
    }
}