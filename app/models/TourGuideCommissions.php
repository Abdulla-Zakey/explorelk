<?php

class TourGuideCommissions{
    use Model;

    protected $table = 'tourguidecommissions';

    protected $allowedColumns = [
        'commission_id',
        'guide_id',
        'amount',
        'reference_number',
        'payment_date',
        'receipt_path',
        'notes',
        'status',
        'verified_at',
        'created_at',
        'updated_at',
    ];

    public function validate($data){
        $errors = [];
    
        // Validate amount
        if (empty($data['amount'])) {
            $errors['amount'] = "Payment amount is required";
        } elseif (!is_numeric($data['amount']) || $data['amount'] <= 0) {
            $errors['amount'] = "Payment amount must be a positive number";
        }
        
        // Validate reference number
        if (empty($data['reference_number'])) {
            $errors['reference_number'] = "Reference number is required";
        } elseif (strlen($data['reference_number']) < 4) {
            $errors['reference_number'] = "Reference number must be at least 4 characters";
        }
        
        // Validate payment date
        if (empty($data['payment_date'])) {
            $errors['payment_date'] = "Payment date is required";
        } elseif (strtotime($data['payment_date']) > time()) {
            $errors['payment_date'] = "Payment date cannot be in the future";
        }
        
        // Validate file upload
        if (!isset($data['payment_receipt']) || empty($data['payment_receipt']['name'])) {
            $errors['payment_receipt'] = "Payment receipt is required";
        } else {
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
            $max_size = 2 * 1024 * 1024; // 2MB
            
            if (!in_array($data['payment_receipt']['type'], $allowed_types)) {
                $errors['payment_receipt'] = "Only JPG, PNG, and PDF files are allowed";
            }
            
            if ($data['payment_receipt']['size'] > $max_size) {
                $errors['payment_receipt'] = "File size must be less than 2MB";
            }
            
            if ($data['payment_receipt']['error'] !== 0) {
                $errors['payment_receipt'] = "Error uploading file. Please try again.";
            }
        }

        if(empty($errors)) {
            return true;
        }
        
        return $errors;
    }
}