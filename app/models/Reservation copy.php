<?php

class Reservation
{
    use Model;

    protected $table = 'reservations';

    protected $allowedColumns = [
        'table_id',
        'customer_name',
        'date',
        'start_time',
        'end_time',
        'notes',
        'created_at',
        'updated_at'
    ];

    public function validate($data, $restaurant_id)
    {
        $this->errors = [];

        // Validate table_id and ensure it belongs to the restaurant
        if (empty($data['table_id'])) {
            $this->errors['table_id'] = "Table ID is required.";
        } else {
            // Check if table exists and belongs to the restaurant
            $tableModel = new Table();
            $table = $tableModel->first(['id' => $data['table_id'], 'restaurant_id' => $restaurant_id]);
            if (!$table) {
                $this->errors['table_id'] = "Invalid table or table does not belong to this restaurant.";
            }
        }

        // Validate customer name
        if (empty($data['customer_name'])) {
            $this->errors['customer_name'] = "Customer name is required.";
        } elseif (strlen($data['customer_name']) > 255) {
            $this->errors['customer_name'] = "Customer name cannot exceed 255 characters.";
        }

        // Validate date
        if (empty($data['date'])) {
            $this->errors['date'] = "Date is required.";
        } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data['date'])) {
            $this->errors['date'] = "Invalid date format.";
        }

        // Validate start time
        if (empty($data['start_time'])) {
            $this->errors['start_time'] = "Start time is required.";
        } elseif (!preg_match("/^\d{2}:\d{2}$/", $data['start_time'])) {
            $this->errors['start_time'] = "Invalid start time format.";
        }

        // Validate end time
        if (empty($data['end_time'])) {
            $this->errors['end_time'] = "End time is required.";
        } elseif (!preg_match("/^\d{2}:\d{2}$/", $data['end_time'])) {
            $this->errors['end_time'] = "Invalid end time format.";
        } elseif ($data['start_time'] >= $data['end_time']) {
            $this->errors['end_time'] = "End time must be after start time.";
        }

        // Check for overlapping reservations
        if (empty($this->errors) && !$this->isTimeSlotAvailable($data)) {
            $this->errors['time_slot'] = "This time slot is already reserved.";
        }

        if (!empty($this->errors)) {
            error_log('Reservation validation failed: ' . json_encode($this->errors));
        }

        return empty($this->errors);
    }

    public function isTimeSlotAvailable($data)
    {
        $query = "SELECT * FROM {$this->table} 
                 WHERE table_id = :table_id 
                 AND date = :date 
                 AND (
                     (:start_time >= start_time AND :start_time < end_time) OR
                     (:end_time > start_time AND :end_time <= end_time) OR
                     (:start_time <= start_time AND :end_time >= end_time)
                 )";
        
        if (!empty($data['id'])) {
            $query .= " AND id != :id";
        }

        $params = [
            'table_id' => $data['table_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time']
        ];

        if (!empty($data['id'])) {
            $params['id'] = $data['id'];
        }

        $result = $this->query($query, $params);
        return empty($result);
    }

    public function getReservationsByDate($date, $restaurant_id)
    {
        $query = "SELECT r.* FROM {$this->table} r
                  JOIN tables t ON r.table_id = t.id
                  WHERE r.date = :date AND t.restaurant_id = :restaurant_id";
        return $this->query($query, ['date' => $date, 'restaurant_id' => $restaurant_id]);
    }

    public function getReservationsByTableAndDate($table_id, $date, $restaurant_id)
    {
        $query = "SELECT r.* FROM {$this->table} r
                  JOIN tables t ON r.table_id = t.id
                  WHERE r.table_id = :table_id AND r.date = :date AND t.restaurant_id = :restaurant_id";
        return $this->query($query, [
            'table_id' => $table_id,
            'date' => $date,
            'restaurant_id' => $restaurant_id
        ]);
    }

    public function getReservationById($id, $restaurant_id)
    {
        $query = "SELECT r.* FROM {$this->table} r
                  JOIN tables t ON r.table_id = t.id
                  WHERE r.id = :id AND t.restaurant_id = :restaurant_id";
        $result = $this->query($query, ['id' => $id, 'restaurant_id' => $restaurant_id]);
        return $result ? $result[0] : null;
    }
}