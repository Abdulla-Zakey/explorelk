<?php
class RestaurantStatus {
    use Model;

    protected $table = "restaurant_status";

    public function getStatus($restaurant_id) {
        $query = "SELECT id, restaurant_id, status, open_time, close_time, updated_at 
                  FROM {$this->table} 
                  WHERE restaurant_id = :restaurant_id 
                  LIMIT 1";
        $result = $this->query($query, ['restaurant_id' => $restaurant_id]);

        if ($result === false) {
            error_log("Database query failed for restaurant status, restaurant_id: $restaurant_id");
            return null;
        }

        if (is_array($result) && !empty($result)) {
            $result = $result[0];
        }

        error_log("Debug - Model: Status fetched for restaurant_id $restaurant_id: " . json_encode($result));
        return $result;
    }

    public function updateStatus($restaurant_id, $status, $open_time, $close_time) {
        $existingStatus = $this->getStatus($restaurant_id);

        $data = [
            'restaurant_id' => $restaurant_id,
            'status' => $status,
            'open_time' => $open_time,
            'close_time' => $close_time
        ];

        if ($existingStatus) {
            // Update existing status
            $result = $this->update($existingStatus->id, $data, 'id');
        } else {
            // Insert new status
            $result = $this->insert($data);
        }

        if ($result === false) {
            error_log("Failed to update/insert restaurant status for restaurant_id $restaurant_id: " . json_encode($data));
            return false;
        }

        error_log("Debug - Model: Status updated/inserted for restaurant_id $restaurant_id: " . json_encode($data));
        return true;
    }
}