<?php

class Traveler
{
    use Model;

    protected $table = 'traveler';

    protected $allowedColumns = [
        'fName',
        'lName',
        'travelerEmail',
        'travelerPassword',
        'travelerMobileNum',
        'homeDistrict',
        'username',
        'created_at',
        'updated_at'
    ];

    public function validate($data)
    {
        $this->errors = [];

        // Validate first name
        if (empty($data['fName'])) {
            $this->errors['fName'] = "First name is required.";
        } elseif (strlen($data['fName']) > 25) {
            $this->errors['fName'] = "First name cannot exceed 25 characters.";
        }

        // Validate last name
        if (empty($data['lName'])) {
            $this->errors['lName'] = "Last name is required.";
        } elseif (strlen($data['lName']) > 25) {
            $this->errors['lName'] = "Last name cannot exceed 25 characters.";
        }

        // Validate email
        if (empty($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "Email is required.";
        } elseif (!filter_var($data['travelerEmail'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['travelerEmail'] = "Email is not valid.";
        } elseif ($this->checkExistingEmail($data['travelerEmail'])) {
            $this->errors['travelerEmail'] = "Email is already registered.";
        }

        // Validate username
        if (empty($data['username'])) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($data['username']) < 4) {
            $this->errors['username'] = "Username must be at least 4 characters long.";
        } elseif (strlen($data['username']) > 50) {
            $this->errors['username'] = "Username cannot exceed 50 characters.";
        } elseif ($this->checkExistingUsername($data['username'])) {
            $this->errors['username'] = "Username is already taken.";
        }

        // Validate password
        if (empty($data['travelerPassword'])) {
            $this->errors['travelerPassword'] = "Password is required.";
        } elseif (strlen($data['travelerPassword']) < 8) {
            $this->errors['travelerPassword'] = "Password must be at least 8 characters long.";
        }

        // Validate confirm password
        if (empty($data['confirmPassword'])) {
            $this->errors['confirmPassword'] = "Confirm Password is required.";
        } elseif ($data['travelerPassword'] !== $data['confirmPassword']) {
            $this->errors['confirmPassword'] = "Password and Confirm Password do not match.";
        }

        // Validate home district
        if (empty($data['homeDistrict'])) {
            $this->errors['homeDistrict'] = "Home district is required.";
        } elseif (strlen($data['homeDistrict']) > 50) {
            $this->errors['homeDistrict'] = "Home district cannot exceed 50 characters.";
        }

        return empty($this->errors);
    }

    // Check if email already exists
    public function checkExistingEmail($email)
    {
        $result = $this->where(['travelerEmail' => $email]);
        return !empty($result);
    }

    // Check if username already exists
    public function checkExistingUsername($username)
    {
        $result = $this->where(['username' => $username]);
        return !empty($result);
    }
}