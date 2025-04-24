<?php

class TourGuideUnavailability {
    use Model;

    protected $table = 'tourguideunavailability';

    protected $allowedColumns = [
        'guide_id',
        'start_date',
        'end_date',
        'reason',
    ];

    function validate($data) {
        $errors = [];
        
        // Validate from date
        if (empty($data['start_date'])) {
            $errors['start_date'] = "Start date is required";
        } elseif (!strtotime($data['start_date'])) {
            $errors['start_date'] = "Invalid start date format";
        }
        
        // Validate to date
        if (empty($data['end_date'])) {
            $errors['end_date'] = "End date is required";
        } elseif (!strtotime($data['end_date'])) {
            $errors['end_date'] = "Invalid end date format";
        }
        
        // Validate date range
        if (empty($errors['start_date']) && empty($errors['end_date'])) {
            $fromDate = new DateTime($data['start_date']);
            $toDate = new DateTime($data['end_date']);
            
            if ($fromDate > $toDate) {
                $errors['date_range'] = "From date cannot be after to date";
            }
            
            // Optional: Add maximum range validation
            // $interval = $fromDate->diff($toDate);
            // if ($interval->days > 30) { // Max 30 days
            //     $errors['date_range'] = "Unavailability period cannot exceed 30 days";
            // }
        }
        
        // Validate reason (optional field)
        if (empty($data['reason'])) {
            $errors['reason'] = "Reason for unavilability is required";
        } elseif (strlen($data['reason']) > 255) {
            $errors['reason'] = "Reason cannot exceed 255 characters";   
        }
        
        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }
}