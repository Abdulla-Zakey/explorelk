<?php

class Eventorganizer {
    use Model;
    private $errors = [];

    protected $table = 'event_organizer';

    protected $allowedColumns = [
        'company_Email',
        'company_Password',
        'company_MobileNum',
        'company_Name',
        'company_Address',
        'company_logo', // Added to support profile image
        'status'
    ];

    public function validate($data, $update = false)
    {
        $this->errors = [];

        // Validate company name (required for insert, optional for update)
        if (!$update && empty($data['company_Name'])) {
            $this->errors['company_Name'] = "Company name is required.";
        } elseif (!empty($data['company_Name']) && strlen($data['company_Name']) > 100) { // Adjusted to match DB schema
            $this->errors['company_Name'] = "Company name cannot exceed 100 characters.";
        }

        // Validate company email (required for insert, optional for update)
        if (!$update && empty($data['company_Email'])) {
            $this->errors['company_Email'] = "Email is required.";
        } elseif (!empty($data['company_Email']) && !filter_var($data['company_Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['company_Email'] = "Email is not valid.";
        } elseif (!empty($data['company_Email']) && $this->checkExistingEmail($data['company_Email'], $data['organizer_Id'] ?? null)) {
            $this->errors['company_Email'] = "Email is already registered.";
        }

        // Validate company mobile number (optional)
        if (!empty($data['company_MobileNum']) && !preg_match('/^[0-9]{10}$/', $data['company_MobileNum'])) { // Match DB schema (10 digits)
            $this->errors['company_MobileNum'] = "Mobile number must be exactly 10 digits.";
        }

        // Validate company address (optional)
        if (!empty($data['company_Address']) && strlen($data['company_Address']) > 255) { // Match DB schema
            $this->errors['company_Address'] = "Address cannot exceed 255 characters.";
        }

        // Validate password (required for insert, optional for update)
        if (!$update && empty($data['company_Password'])) {
            $this->errors['company_Password'] = "Password is required.";
        } elseif (!empty($data['company_Password']) && strlen($data['company_Password']) < 8) {
            $this->errors['company_Password'] = "Password must be at least 8 characters long.";
        }

        // Validate confirm password (only if password is provided)
        if (!empty($data['company_Password']) && empty($data['confirm_Password'])) {
            $this->errors['confirm_Password'] = "Confirm Password is required.";
        } elseif (!empty($data['company_Password']) && $data['company_Password'] !== $data['confirm_Password']) {
            $this->errors['confirm_Password'] = "Password and Confirm Password do not match.";
        }

        // Validate company logo (optional)
        if (!empty($data['company_logo']) && strlen($data['company_logo']) > 255) { // Match DB schema
            $this->errors['company_logo'] = "Logo file path cannot exceed 255 characters.";
        }

        return empty($this->errors);
    }

    // Check if email already exists (exclude current organizer for updates)
    public function checkExistingEmail($email, $organizerId = null)
    {
        $query = "SELECT * FROM {$this->table} WHERE company_Email = :company_Email";
        $params = ['company_Email' => $email];

        if ($organizerId) {
            $query .= " AND organizer_Id != :organizer_Id";
            $params['organizer_Id'] = $organizerId;
        }

        $result = $this->query($query, $params);
        return !empty($result);
    }

    // Update organizer data
    public function updateOrganizer($id, $data)
    {
        if ($this->validate($data, true)) {
            // Hash password if provided
            if (!empty($data['company_Password'])) {
                $data['company_Password'] = password_hash($data['company_Password'], PASSWORD_DEFAULT);
            } else {
                unset($data['company_Password']);
            }

            // Remove confirm password
            unset($data['confirm_Password']);

            // Filter allowed columns
            $updateData = array_intersect_key($data, array_flip($this->allowedColumns));

            try {
                return $this->update($id, $updateData, 'organizer_Id');
            } catch (Exception $e) {
                error_log('Exception during organizer update: ' . $e->getMessage());
                $this->errors['database'] = 'An unexpected error occurred. Please try again.';
                return false;
            }
        }
        return false;
    }
    
}