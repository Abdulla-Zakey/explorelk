<?php

class Messages {
    use Model;

    protected $table = 'messages';
    protected $allowedColumns = [
        'hotel_Id',
        'traveler_Id',
        'sender_type',
        'conversations',
        'is_read',
        'timestamp'
    ];

    public function getHotelConversations($hotel_id) {
        $query = "SELECT m.traveler_Id, 
                         t.username, 
                         t.profilePicture AS profilePicture,
                         latest.conversations AS last_message,
                         latest.timestamp,
                         COUNT(CASE WHEN m.is_read = 0 AND m.sender_type = 'traveler' THEN 1 END) AS unread_count
                  FROM messages m
                  JOIN traveler t ON m.traveler_Id = t.traveler_Id
                  JOIN (
                      SELECT traveler_Id, MAX(timestamp) as max_time
                      FROM messages
                      WHERE hotel_Id = :hotel_id
                      GROUP BY traveler_Id
                  ) as latest_time ON m.traveler_Id = latest_time.traveler_Id AND m.timestamp = latest_time.max_time
                  JOIN messages latest ON latest.traveler_Id = latest_time.traveler_Id AND latest.timestamp = latest_time.max_time
                  WHERE m.hotel_Id = :hotel_id
                  GROUP BY m.traveler_Id, t.username, t.profilePicture, latest.conversations, latest.timestamp
                  ORDER BY latest.timestamp DESC";

        try {
            return $this->query($query, ['hotel_id' => $hotel_id]);
        } catch (Exception $e) {
            error_log('Error in getHotelConversations: ' . $e->getMessage());
            return [];
        }
    }

    public function getConversation($hotel_Id, $traveler_Id, $last_timestamp = null) {
        // Validate inputs
        if (!is_numeric($hotel_Id) || !is_numeric($traveler_Id)) {
            error_log('Invalid hotel_id or traveler_id');
            return [];
        }
    
        $params = [
            'hotel_Id' => $hotel_Id,
            'traveler_Id' => $traveler_Id
        ];
    
        // Use lowercase column names for consistency (adjust based on DB schema)
        $query = "SELECT message_id, hotel_Id, traveler_Id, sender_type, conversation, is_read, timestamp 
                  FROM messages 
                  WHERE hotel_Id = :hotel_Id AND traveler_Id = :traveler_Id";
    
        if ($last_timestamp !== null) {
            // Validate timestamp format (adjust based on DB format)
            if (!strtotime($last_timestamp)) {
                error_log('Invalid last_timestamp format');
                return [];
            }
            $query .= " AND timestamp > :last_timestamp";
            $params['last_timestamp'] = $last_timestamp;
        }
    
        $query .= " ORDER BY timestamp ASC";
    
        try {
            $result = $this->query($query, $params);
            return $result ?: []; // Ensure empty array if result is falsy
        } catch (Exception $e) {
            error_log('Error in getConversation: ' . $e->getMessage());
            throw new Exception('Failed to retrieve conversation: ' . $e->getMessage());
        }
    }

    public function markAsRead($hotel_id, $traveler_id) {
        $query = "UPDATE messages 
                  SET is_read = 1 
                  WHERE hotel_Id = :hotel_id 
                  AND traveler_Id = :traveler_id 
                  AND sender_type = 'traveler' 
                  AND is_read = 0";
                 
        try {
            $result = $this->query($query, [
                'hotel_id' => $hotel_id,
                'traveler_id' => $traveler_id
            ]);
            return $result !== false;
        } catch (Exception $e) {
            error_log('Error in markAsRead: ' . $e->getMessage());
            return false;
        }
    }

    public function getUnreadCounts($hotel_id) {
        $query = "SELECT traveler_Id, COUNT(*) as count 
                  FROM messages 
                  WHERE hotel_Id = :hotel_id 
                  AND sender_type = 'traveler' 
                  AND is_read = 0 
                  GROUP BY traveler_Id";
                 
        try {
            return $this->query($query, ['hotel_id' => $hotel_id]);
        } catch (Exception $e) {
            error_log('Error in getUnreadCounts: ' . $e->getMessage());
            return [];
        }
    }

    public function sendMessage($hotel_id, $traveler_id, $content, $sender_type = 'hotel') {
        $data = [
            'hotel_Id' => $hotel_id,
            'traveler_Id' => $traveler_id,
            'conversations' => $content,
            'sender_type' => $sender_type,
            'is_read' => ($sender_type === 'hotel') ? 1 : 0,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        try {
            $result = $this->insert($data);
            if ($result) {
                $lastId = $this->lastInsertId();
                return $lastId ?: false;
            }
            return false;
        } catch (Exception $e) {
            error_log('Error in sendMessage: ' . $e->getMessage());
            return false;
        }
    }

    private function lastInsertId() {
        try {
            $query = "SELECT LAST_INSERT_ID() as id";
            $result = $this->query($query);
            return $result[0]->id ?? false;
        } catch (Exception $e) {
            error_log('Error in lastInsertId: ' . $e->getMessage());
            return false;
        }
    }
}