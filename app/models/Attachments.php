<?php

class Attachments {
    
    use Model;
    
    protected $table = 'attachments';
    
    // List of columns that are allowed to be set
    protected $allowedColumns = [
        'report_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size'
    ];
    public function validate($data): bool {
        $this->errors = [];

        // Validate report_id
        if (empty($data['report_id'])) {
            $this->errors['report_id'] = "Report ID is required";
        }

        // Validate file_name
        if (empty($data['file_name'])) {
            $this->errors['file_name'] = "File name is required";
        }

        // Validate file_path
        if (empty($data['file_path'])) {
            $this->errors['file_path'] = "File path is required";
        }

        // Validate file_type
        if (empty($data['file_type'])) {
            $this->errors['file_type'] = "File type is required";
        }

        // Validate file_size
        if (empty($data['file_size'])) {
            $this->errors['file_size'] = "File size is required";
        }

        return empty($this->errors);
    }
}