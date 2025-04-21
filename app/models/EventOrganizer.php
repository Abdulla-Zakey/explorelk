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
        'first_Name',
        'last_Name',
        'website',
        'blog',
        'job_Title',
        'event_Type',
        'experience',
        'profile_Image',
    ];

    public function validate($data, $update = false)
    {
        $this->errors = [];

        // Validate company name (required for insert, optional for update)
        if (!$update && empty($data['company_Name'])) {
            $this->errors['company_Name'] = "Company name is required.";
        } elseif (!empty($data['company_Name']) && strlen($data['company_Name']) > 50) {
            $this->errors['company_Name'] = "Company name cannot exceed 50 characters.";
        }

        // Validate company email (required for insert, optional for update)
        if (!$update && empty($data['company_Email'])) {
            $this->errors['company_Email'] = "Email is required.";
        } elseif (!empty($data['company_Email']) && !filter_var($data['company_Email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['company_Email'] = "Email is not valid.";
        } elseif (!empty($data['company_Email']) && $update && $this->checkExistingEmail($data['company_Email'], $data['organizer_Id'] ?? null)) {
            $this->errors['company_Email'] = "Email is already registered.";
        }

        // Validate company mobile number (optional)
        if (!empty($data['company_MobileNum']) && strlen($data['company_MobileNum']) > 12) {
            $this->errors['company_MobileNum'] = "Mobile number cannot exceed 12 characters.";
        }

        // Validate company address (optional)
        if (!empty($data['company_Address']) && strlen($data['company_Address']) < 10) {
            $this->errors['company_Address'] = "Address must be at least 10 characters long.";
        } elseif (!empty($data['company_Address']) && strlen($data['company_Address']) > 50) {
            $this->errors['company_Address'] = "Address cannot exceed 50 characters.";
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

        // Validate optional fields
        if (!empty($data['website']) && !filter_var($data['website'], FILTER_VALIDATE_URL)) {
            $this->errors['website'] = "Invalid website URL.";
        }

        if (!empty($data['blog']) && !filter_var($data['blog'], FILTER_VALIDATE_URL)) {
            $this->errors['blog'] = "Invalid blog URL.";
        }

        if (!empty($data['experience']) && (!is_numeric($data['experience']) || $data['experience'] < 0)) {
            $this->errors['experience'] = "Experience must be a positive number.";
        }

        if (!empty($data['first_Name']) && strlen($data['first_Name']) > 50) {
            $this->errors['first_Name'] = "First name cannot exceed 50 characters.";
        }

        if (!empty($data['last_Name']) && strlen($data['last_Name']) > 50) {
            $this->errors['last_Name'] = "Last name cannot exceed 50 characters.";
        }

        if (!empty($data['job_Title']) && strlen($data['job_Title']) > 100) {
            $this->errors['job_Title'] = "Job title cannot exceed 100 characters.";
        }

        if (!empty($data['event_Type']) && strlen($data['event_Type']) > 255) {
            $this->errors['event_Type'] = "Event type cannot exceed 255 characters.";
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