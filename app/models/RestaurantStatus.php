<?php
class RestaurantStatus {
    use Model;

    protected $table = "restaurant_status";

    public function getStatus() {
        $query = "SELECT id, status, open_time, close_time, updated_at 
                  FROM {$this->table} 
                  WHERE id = 1 
                  LIMIT 1";
        $result = $this->query($query);

        if ($result === false) {
            error_log("Database query failed for restaurant status");
            return null;
        }

        if (is_array($result) && !empty($result)) {
            $result = $result[0];
        }

        error_log("Debug - Model: Status fetched: " . json_encode($result));
        return $result;
    }

    public function updateStatus($status, $open_time, $close_time) {
        $existingStatus = $this->getStatus();

        $data = [
            'status' => $status,
            'open_time' => $open_time,
            'close_time' => $close_time
        ];

        if ($existingStatus) {
            $result = $this->update(1, $data, 'id');
        } else {
            $data['id'] = 1;
            $result = $this->insert($data);
        }

        if ($result === false) {
            error_log("Failed to update/insert restaurant status: " . json_encode($data));
            return false;
        }

        error_log("Debug - Model: Status updated/inserted: " . json_encode($data));
        return true;
    }
}