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
    ];

    public function validate($data, $isNewUser = false){
        $this->errors = [];
    
        // Required fields for profile update
        if (empty($data['firstName'])) {
            $this->errors['firstName'] = "First name required.";
        } 
    
        if (empty($data['lastName'])) {
            $this->errors['lastName'] = "Last name required.";
        }
    
        // Optional validation for specific scenarios
        if ($isNewUser) {
            // Email uniqueness check only for new user registration
            if (empty($data['email'])) {
                $this->errors['email'] = "Email is required.";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Email is not valid.";
            } elseif ($this->findEmail($data['email'])) {
                $this->errors['email'] = "Email is already registered.";
            }
    
            // Password validation only for new users
            if (empty($data['password'])) {
                $this->errors['password'] = "Password is required.";
            } elseif (strlen($data['password']) < 8) {
                $this->errors['password'] = "Password must be at least 8 characters long.";
            }
    
            // Confirm password only for new users
            if ($data['password'] !== $data['confirmPassword']) {
                $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
            }
        } else {
            // For profile updates, only validate password if it's being changed
            if (!empty($data['password'])) {
                if (strlen($data['password']) < 8) {
                    $this->errors['password'] = "Password must be at least 8 characters long.";
                }
                if ($data['password'] !== $data['confirmPassword']) {
                    $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
                }
            }
        }
    
        // Other fields validation
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