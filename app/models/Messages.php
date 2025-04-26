<?php

class Messages {
    use Model;
    
    protected $table = 'messages';
    
    protected $allowedColumns = [
        'message_id',
        'hotel_Id',
        'traveler_Id',
        'sender_type',
        'conversations',
        'is_read',
        'timestamp'
    ];
    
    public function getHotelConversations($hotel_id) {
        // Raw SQL to join travelers with messages and get the latest message for each traveler
        $sql = "SELECT m.traveler_Id, t.username, t.profilePicture, 
                    (SELECT conversations FROM messages 
                     WHERE hotel_Id = :hotel_Id AND traveler_Id = m.traveler_Id 
                     ORDER BY timestamp DESC LIMIT 1) as last_message,
                    (SELECT timestamp FROM messages 
                     WHERE hotel_Id = :hotel_Id AND traveler_Id = m.traveler_Id 
                     ORDER BY timestamp DESC LIMIT 1) as timestamp,
                    (SELECT COUNT(*) FROM messages 
                     WHERE hotel_Id = :hotel_Id AND traveler_Id = m.traveler_Id 
                     AND sender_type = 'traveler' AND is_read = 0) as unread_count
                FROM messages m
                JOIN traveler t ON m.traveler_Id = t.traveler_Id
                WHERE m.hotel_Id = :hotel_Id
                GROUP BY m.traveler_Id, t.username, t.profilePicture
                ORDER BY timestamp DESC";
        
        try {
            $conversations = $this->query($sql, ['hotel_Id' => $hotel_id]);
            
            // Convert unread_count to integer
            foreach ($conversations as $conversation) {
                $conversation->unread_count = (int)$conversation->unread_count;
            }
            
            return $conversations;
        } catch (Exception $e) {
            error_log('Error in getHotelConversations: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getConversation($hotel_Id, $traveler_Id, $last_timestamp = null) {
        if (!is_numeric($hotel_Id) || !is_numeric($traveler_Id)) {
            error_log('Invalid hotel_Id or traveler_Id');
            return [];
        }
        
        $params = [
            'hotel_Id' => $hotel_Id,
            'traveler_Id' => $traveler_Id
        ];
        
        $sql = "SELECT * FROM messages WHERE hotel_Id = :hotel_Id AND traveler_Id = :traveler_Id";
        
        if ($last_timestamp !== null) {
            $sql .= " AND timestamp > :last_timestamp";
            $params['last_timestamp'] = $last_timestamp;
        }
        
        $sql .= " ORDER BY timestamp ASC";
        
        try {
            $messages = $this->query($sql, $params);
            return $messages;
        } catch (Exception $e) {
            error_log('Error in getConversation: ' . $e->getMessage());
            throw new Exception('Failed to retrieve conversation: ' . $e->getMessage());
        }
    }
    
   // In the sendMessage method, ensure consistent timestamp format:
public function sendMessage($hotel_Id, $traveler_Id, $conversations, $sender_type) {
    if (!is_numeric($hotel_Id) || !is_numeric($traveler_Id)) {
        error_log('Invalid hotel_Id or traveler_Id');
        return false;
    }
    
    if (!in_array($sender_type, ['hotel', 'traveler'])) {
        error_log('Invalid sender_type');
        return false;
    }
    
    // Set timezone to UTC for consistency
    date_default_timezone_set('Asia/Colombo');
    
    $data = [
        'hotel_Id' => $hotel_Id,
        'traveler_Id' => $traveler_Id,
        'conversations' => $conversations,
        'sender_type' => $sender_type,
        'timestamp' => date('Y-m-d H:i:s'),
        'is_read' => 0
    ];
    
    try {
        $message_id = $this->insert($data);
        return $message_id;
    } catch (Exception $e) {
        error_log('Error in sendMessage: ' . $e->getMessage());
        throw new Exception('Failed to send message: ' . $e->getMessage());
    }
}

    
    public function markAsRead($hotel_Id, $traveler_Id) {
        if (!is_numeric($hotel_Id) || !is_numeric($traveler_Id)) {
            error_log('Invalid hotel_Id or traveler_Id');
            return false;
        }
        
        $sql = "UPDATE messages SET is_read = 1 
                WHERE hotel_Id = :hotel_Id 
                AND traveler_Id = :traveler_Id 
                AND sender_type = 'traveler' 
                AND is_read = 0";
        
        try {
            $this->query($sql, [
                'hotel_Id' => $hotel_Id,
                'traveler_Id' => $traveler_Id
            ]);
            return true;
        } catch (Exception $e) {
            error_log('Error in markAsRead: ' . $e->getMessage());
            throw new Exception('Failed to mark messages as read: ' . $e->getMessage());
        }
    }
    
    public function getUnreadCounts($hotel_Id) {
        if (!is_numeric($hotel_Id)) {
            error_log('Invalid hotel_Id');
            return [];
        }
        
        $sql = "SELECT traveler_Id, COUNT(*) as count 
                FROM messages 
                WHERE hotel_Id = :hotel_Id 
                AND sender_type = 'traveler' 
                AND is_read = 0 
                GROUP BY traveler_Id";
        
        try {
            $counts = $this->query($sql, ['hotel_Id' => $hotel_Id]);
            return $counts;
        } catch (Exception $e) {
            error_log('Error in getUnreadCounts: ' . $e->getMessage());
            throw new Exception('Failed to get unread counts: ' . $e->getMessage());
        }
    }
}

