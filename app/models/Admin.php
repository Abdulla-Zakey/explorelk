<?php

class Admin
{
    use Model;

    protected $table = 'admin';

    protected $allowedColumns = [
        'admin_id',
        'firstName',
        'lastName',
        'email',
        'password',
        'gender',
        'dob',
        'city',
        'phoneNo',
        'address',
        'nic',
        'profile_picture', 
        'work_experience'  
    ];

    public function validate($data, $isNewUser = false){
        $this->errors = [];
    
        if (empty($data['firstName'])) {
            $this->errors['firstName'] = "First name required.";
        } 
    
        if (empty($data['lastName'])) {
            $this->errors['lastName'] = "Last name required.";
        }
    
        if (!empty($data['password'])) {
            if (strlen($data['password']) < 8) {
                $this->errors['password'] = "Password must be at least 8 characters long.";
            }
            if ($data['password'] !== $data['confirmPassword']) {
                $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
            }
        }
    
        if (empty($data['gender'])) {
            $this->errors['gender'] = "Choose a gender";
        }
    
        if (empty($data['dob'])) {
            $this->errors['dob'] = "Date of birth required.";
        }
    
        if (empty($data['city'])) {
            $this->errors['city'] = "City required.";
        }

        if (empty($data['phoneNo'])) {
            $this->errors['phoneNo'] = "Phone Number required.";
        }

        if (empty($data['address'])) {
            $this->errors['address'] = "Address required.";
        }
        
        if (empty($data['nic'])) {
            $this->errors['nic'] = "NIC required.";
        } elseif (strlen($data['nic']) != 12) {
            $this->errors['nic'] = "NIC should be 12 numerical digits";
        }

        if (empty($data['work_experience'])) {
            $this->errors['work_experience'] = "Work experience required.";
        } elseif ($data['work_experience'] < 0) {
            $this->errors['work_experience'] = "Work experience should be a positive value";
        }
    
        return empty($this->errors);
    }

    public function findEmail($email){
        $query = "SELECT * FROM $this->table WHERE email = :email";
        $params = [':email' => $email];
        $result = $this->query($query, $params);
        return $result ? $result[0]: null;
    }

    public function findUserById($id){
        $query = "SELECT * FROM $this->table WHERE admin_id = :id";
        $params = [':id' => $id];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }

}