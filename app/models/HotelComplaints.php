<?php

class HotelComplaints {
    use Model;

    protected $table = 'hotelComplaints';
    
    protected $allowedColumns = [
        'hotel_Id',
        'traveler_Id',
        'date_submitted',
        'subject',
        'message',
        'booking_id',
        'status',
        'resolution_notes',
        'date_resolved'
    ];

    /**
     * Select all complaints for a specific hotel
     * @param int $hotelId
     * @return array
     */
    public function selectAllByHotel($hotelId) {
        if (!filter_var($hotelId, FILTER_VALIDATE_INT) || $hotelId <= 0) {
            error_log("HotelComplaints::selectAllByHotel - Invalid hotel ID: $hotelId");
            throw new InvalidArgumentException("Invalid hotel ID: $hotelId");
        }

        $query = "SELECT * FROM {$this->table} WHERE hotel_Id = :hotelId ORDER BY date_submitted DESC";
        $result = $this->query($query, ['hotelId' => $hotelId]);
        
        if ($result === false) {
            error_log("HotelComplaints::selectAllByHotel - Query failed for hotelId: $hotelId");
            return [];
        }
        
        return $result;
    }

    /**
     * Insert a new complaint
     * @param array $data
     * @return array
     */
    public function insertComplaint($data) {
        try {
            // Filter data to only allowed columns
            $filteredData = array_intersect_key($data, array_flip($this->allowedColumns));
            
            // Validate required fields
            $errors = [];
            if (empty($filteredData['subject'])) {
                $errors['subject'] = 'Subject is required';
            }
            if (empty($filteredData['message'])) {
                $errors['message'] = 'Description is required';
            }
            if (empty($filteredData['hotel_Id'])) {
                $errors['hotel_Id'] = 'Hotel ID is required';
            }

            if (!empty($errors)) {
                error_log("HotelComplaints::insertComplaint - Validation errors: " . json_encode($errors));
                return ['status' => 'error', 'errors' => $errors];
            }

            // Set default values
            $filteredData['date_submitted'] = date('Y-m-d H:i:s');
            $filteredData['status'] = 'Pending';
            $filteredData['traveler_Id'] = isset($data['traveler_Id']) ? $data['traveler_Id'] : null;

            // Sanitize input
            foreach ($filteredData as $key => &$value) {
                if ($value !== null) {
                    $value = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
                }
            }

            // Log the data being inserted
            error_log("HotelComplaints::insertComplaint - Attempting to insert: " . json_encode($filteredData));

            // Insert into database
            $result = $this->insert($filteredData);
            
            if ($result === false) {
                error_log("HotelComplaints::insertComplaint - Insert failed for data: " . json_encode($filteredData));
                return ['status' => 'error', 'message' => 'Failed to submit complaint to database'];
            }

            return ['status' => 'success', 'message' => 'Complaint submitted successfully'];
        } catch (Exception $e) {
            error_log("HotelComplaints::insertComplaint - Exception: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()];
        }
    }
}