<?php

class TravelagentComplaints {
    use Model;

    protected $table = 'travelagentComplaints';
    
    protected $allowedColumns = [
        'traveler_Id',
        'travelagent_Id',
        'hotel_Id',
        'date_submitted',
        'subject',
        'message',
        'booking_id',
        'status',
        'resolution_notes',
        'date_resolved'
    ];

    /**
     * Select all issues for a specific travel agent
     * @param int $travelagentId
     * @return array
     */
    public function selectAllByTravelagent($travelagentId) {
        if (!filter_var($travelagentId, FILTER_VALIDATE_INT) || $travelagentId <= 0) {
            error_log("TravelagentComplaints::selectAllByTravelagent - Invalid travel agent ID: $travelagentId");
            throw new InvalidArgumentException("Invalid travel agent ID: $travelagentId");
        }

        $query = "SELECT * FROM {$this->table} WHERE travelagent_Id = :travelagentId ORDER BY date_submitted DESC";
        $result = $this->query($query, ['travelagentId' => $travelagentId]);
        
        if ($result === false) {
            error_log("TravelagentComplaints::selectAllByTravelagent - Query failed for travelagentId: $travelagentId");
            return [];
        }
        
        return $result;
    }

    /**
     * Insert a new issue
     * @param array $data
     * @return array
     */
    public function insertIssue($data) {
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
            if (empty($filteredData['traveler_Id'])) {
                $errors['traveler_Id'] = 'Traveler ID is required';
            }
            if (empty($filteredData['travelagent_Id'])) {
                $errors['travelagent_Id'] = 'Travel Agent ID is required';
            }
            if (empty($filteredData['hotel_Id'])) {
                $filteredData['hotel_Id'] = 0; // Set default value if not provided
            }

            if (!empty($errors)) {
                error_log("TravelagentComplaints::insertIssue - Validation errors: " . json_encode($errors));
                return ['status' => 'error', 'errors' => $errors];
            }

            // Set default values
            $filteredData['date_submitted'] = date('Y-m-d H:i:s');
            $filteredData['status'] = 'Pending';
            $filteredData['booking_id'] = isset($filteredData['booking_id']) ? $filteredData['booking_id'] : null;

            // Sanitize input
            foreach ($filteredData as $key => &$value) {
                if ($value !== null) {
                    $value = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
                }
            }

            // Log the data being inserted
            error_log("TravelagentComplaints::insertIssue - Attempting to insert: " . json_encode($filteredData));

            // Insert into database
            $result = $this->insert($filteredData);
            
            if ($result === false) {
                error_log("TravelagentComplaints::insertIssue - Insert failed for data: " . json_encode($filteredData));
                return ['status' => 'error', 'message' => 'Failed to submit issue to database'];
            }

            return ['status' => 'success', 'message' => 'Issue submitted successfully', 'issue_id' => $result];
        } catch (Exception $e) {
            error_log("TravelagentComplaints::insertIssue - Exception: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()];
        }
    }

    /**
     * Update issue status and resolution notes
     * @param int $issueId
     * @param array $data
     * @return array
     */
    public function updateIssue($issueId, $data) {
        try {
            if (!filter_var($issueId, FILTER_VALIDATE_INT) || $issueId <= 0) {
                error_log("TravelagentComplaints::updateIssue - Invalid issue ID: $issueId");
                throw new InvalidArgumentException("Invalid issue ID: $issueId");
            }

            // Filter data to only allowed columns
            $filteredData = array_intersect_key($data, array_flip(['status', 'resolution_notes', 'date_resolved']));
            
            // Validate required fields
            if (empty($filteredData['status'])) {
                error_log("TravelagentComplaints::updateIssue - Status is required");
                return ['status' => 'error', 'message' => 'Status is required'];
            }

            // Set date_resolved if status is Resolved
            if ($filteredData['status'] === 'Resolved' && !isset($filteredData['date_resolved'])) {
                $filteredData['date_resolved'] = date('Y-m-d H:i:s');
            }

            // Sanitize input
            foreach ($filteredData as $key => &$value) {
                if ($value !== null) {
                    $value = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
                }
            }

            // Log the data being updated
            error_log("TravelagentComplaints::updateIssue - Attempting to update issue $issueId: " . json_encode($filteredData));

            // Update in database
            $result = $this->update($issueId, $filteredData, 'issue_id');
            
            if ($result === false) {
                error_log("TravelagentComplaints::updateIssue - Update failed for issueId: $issueId");
                return ['status' => 'error', 'message' => 'Failed to update issue'];
            }

            return ['status' => 'success', 'message' => 'Issue updated successfully'];
        } catch (Exception $e) {
            error_log("TravelagentComplaints::updateIssue - Exception: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()];
        }
    }
}