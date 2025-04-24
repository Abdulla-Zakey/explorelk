<?php

class Table
{
    use Model;

    protected $table = 'tables';

    protected $allowedColumns = [
        'restaurant_id',
        'number',
        'capacity',
        'location',
        'created_at',
        'updated_at'
    ];

    public function validate($data, $restaurant_id, $existingTableId = null)
    {
        $this->errors = [];

        // Validate restaurant_id
        if (empty($data['restaurant_id'])) {
            $this->errors['restaurant_id'] = "Restaurant ID is required.";
        }

        // Validate table number
        if (empty($data['number'])) {
            $this->errors['number'] = "Table number is required.";
        } elseif (!is_numeric($data['number']) || $data['number'] <= 0) {
            $this->errors['number'] = "Table number must be a positive number.";
        } elseif ($this->checkExistingNumber($data['number'], $restaurant_id, $existingTableId)) {
            $this->errors['number'] = "Table number already exists for this restaurant.";
        }

        // Validate capacity
        if (empty($data['capacity'])) {
            $this->errors['capacity'] = "Capacity is required.";
        } elseif (!is_numeric($data['capacity']) || $data['capacity'] <= 0) {
            $this->errors['capacity'] = "Capacity must be a positive number.";
        }

        // Validate location
        if (empty($data['location'])) {
            $this->errors['location'] = "Location is required.";
        } elseif (!in_array($data['location'], ['Indoor', 'Outdoor', 'VIP'])) {
            $this->errors['location'] = "Invalid location.";
        }

        if (!empty($this->errors)) {
            error_log('Table validation failed: ' . json_encode($this->errors));
        }

        return empty($this->errors);
    }

    public function checkExistingNumber($number, $restaurant_id, $existingTableId = null)
    {
        $query = "SELECT * FROM {$this->table} WHERE number = :number AND restaurant_id = :restaurant_id";
        $params = ['number' => $number, 'restaurant_id' => $restaurant_id];
        
        if ($existingTableId) {
            $query .= " AND id != :id";
            $params['id'] = $existingTableId;
        }

        $result = $this->query($query, $params);
        return !empty($result);
    }

    public function getAllTables($restaurant_id)
    {
        return $this->where(['restaurant_id' => $restaurant_id]);
    }

    public function getTableById($id, $restaurant_id)
    {
        return $this->first(['id' => $id, 'restaurant_id' => $restaurant_id]);
    }
}