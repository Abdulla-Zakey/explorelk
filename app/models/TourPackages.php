<?php

class TourPackages
{
    use Model;

    protected $table = 'tourpackages';

    protected $allowedColumns = [
        'package_id',
        'guide_id',
        'name',
        'location',
        'duration_days',
        'group_size',
        'package_price',
        'languages',
        'description',
        'tags',
        'inclusions',
        'exclusions',
        'created_at',
        'updated_at',
    ];

    public function getPackageId(){
        return $this->package_id;
    }

    public function validate($data) {
        $errors = [];
        
        // Validate basic information
        if (empty($data['name'])) {
            $errors['name'] = "Package name is required";
        } elseif (strlen($data['name']) > 100) {
            $errors['name'] = "Package name cannot exceed 100 characters";
        }
        
        if (empty($data['location'])) {
            $errors['location'] = "Location is required";
        } elseif (strlen($data['location']) > 150) {
            $errors['location'] = "Location cannot exceed 150 characters";
        }
        
        if (empty($data['duration_days'])) {
            $errors['duration_days'] = "Duration is required";
        } elseif (!is_numeric($data['duration_days']) || $data['duration_days'] < 1) {
            $errors['duration_days'] = "Duration must be a positive number";
        }
        
        if (empty($data['group_size'])) {
            $errors['group_size'] = "Group size is required";
        } elseif (strlen($data['group_size']) > 50) {
            $errors['group_size'] = "Group size cannot exceed 50 characters";
        }
        
        if (empty($data['package_price'])) {
            $errors['package_price'] = "Package price is required";
        } elseif (!is_numeric($data['package_price']) || $data['package_price'] < 0) {
            $errors['package_price'] = "Price must be a non-negative number";
        }
        
        if (empty($data['languages'])) {
            $errors['languages'] = "Languages cannot exceed 100 characters";
        }
        
        // Validate description
        if (empty($data['description'])) {
            $errors['description'] = "Package description is required";
        } elseif (strlen($data['description']) > 5000) {
            $errors['description'] = "Description cannot exceed 5000 characters";
        }
        
        // Validate tags
        if (empty($data['tags'])) {
            $errors['tags'] = "Tags required";
        }
        
        // Validate inclusions & exclusions
        if (!empty($data['inclusions']) && strlen($data['inclusions']) > 1000) {
            $errors['inclusions'] = "Inclusions cannot exceed 1000 characters";
        }
        
        if (!empty($data['exclusions']) && strlen($data['exclusions']) > 1000) {
            $errors['exclusions'] = "Exclusions cannot exceed 1000 characters";
        }
        
        // Validate images
        if (empty($_FILES['packageImages']) || empty($_FILES['packageImages']['name'][0])) {
            $errors['packageImages'] = "At least one image is required";
        } else {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            $maxFileSize = 5 * 1024 * 1024; // 5MB
            
            foreach ($_FILES['packageImages']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['packageImages']['name'][$key];
                $file_size = $_FILES['packageImages']['size'][$key];
                $file_type = $_FILES['packageImages']['type'][$key];
                
                // Check file type
                if (!in_array($file_type, $allowedTypes)) {
                    $errors['packageImages'] = "Only JPG, JPEG, PNG and GIF files are allowed. Error with: " . $file_name;
                    break;
                }
                
                // Check file size
                if ($file_size > $maxFileSize) {
                    $errors['packageImages'] = "File size cannot exceed 5MB. Error with: " . $file_name;
                    break;
                }
            }
        }
        
        // Validate itinerary - Check for at least one day with at least one activity
        $hasDays = false;
        
        foreach ($data as $key => $value) {
            if (strpos($key, 'day') === 0 && strpos($key, '_activity') !== false) {
                $hasDays = true;
                
                // Validate each activity
                foreach ($value as $index => $activity) {
                    if (empty($activity)) {
                        $day = substr($key, 3, strpos($key, '_') - 3);
                        $errors['itinerary'] = "Activity title is required for Day " . $day;
                        break 2;
                    }
                }
            }
        }
        
        if (!$hasDays) {
            $errors['itinerary'] = "At least one day with one activity is required";
        }
        
        return [
            'is_valid' => empty($errors),
            'errors' => $errors
        ];
    }

    
}