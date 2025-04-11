<?PHP
class Message {
    use Model;
    
    protected $table = 'messages';
    protected $primaryKey = 'message_id';
    protected $allowedColumns = [
        'sender_id',
        'receiver_id', 
        'content',
        'timestamp',
        'is_read',
        'hotel_id'
    ];

    // Get conversations for a hotel
    public function getHotelConversations($hotel_id) {
        $query = "SELECT DISTINCT 
                    u.user_id, 
                    u.name, 
                    u.profile_image,
                    (SELECT content FROM messages WHERE 
                        ((sender_id = u.user_id AND receiver_id = :hotel_id) OR 
                        (sender_id = :hotel_id AND receiver_id = u.user_id))
                        ORDER BY timestamp DESC LIMIT 1) as last_message,
                    (SELECT timestamp FROM messages WHERE 
                        ((sender_id = u.user_id AND receiver_id = :hotel_id) OR 
                        (sender_id = :hotel_id AND receiver_id = u.user_id))
                        ORDER BY timestamp DESC LIMIT 1) as last_message_time,
                    (SELECT COUNT(*) FROM messages WHERE 
                        sender_id = u.user_id AND receiver_id = :hotel_id AND is_read = 0) as unread_count
                FROM users u
                JOIN messages m ON (u.user_id = m.sender_id OR u.user_id = m.receiver_id)
                WHERE (m.sender_id = :hotel_id OR m.receiver_id = :hotel_id)
                AND u.user_id != :hotel_id
                ORDER BY last_message_time DESC
                LIMIT 50";
        
        return $this->query($query, ['hotel_id' => $hotel_id]);
    }

    // Get messages between hotel and a specific user
    public function getConversation($hotel_id, $user_id) {
        $query = "SELECT 
                    m.*,
                    CASE 
                        WHEN m.sender_id = :hotel_id THEN 'sent'
                        ELSE 'received'
                    END as message_type
                FROM messages m
                WHERE (m.sender_id = :hotel_id AND m.receiver_id = :user_id)
                   OR (m.sender_id = :user_id AND m.receiver_id = :hotel_id)
                ORDER BY m.timestamp ASC";
        
        // Mark messages as read when fetched by the hotel
        $this->markAsRead($hotel_id, $user_id);
        
        return $this->query($query, [
            'hotel_id' => $hotel_id,
            'user_id' => $user_id
        ]);
    }

    // Get new messages since a specific timestamp
    public function getNewMessages($hotel_id, $user_id, $last_timestamp) {
        $query = "SELECT 
                    m.*,
                    CASE 
                        WHEN m.sender_id = :hotel_id THEN 'sent'
                        ELSE 'received'
                    END as message_type
                FROM messages m
                WHERE ((m.sender_id = :hotel_id AND m.receiver_id = :user_id)
                    OR (m.sender_id = :user_id AND m.receiver_id = :hotel_id))
                    AND m.timestamp > :last_timestamp
                ORDER BY m.timestamp ASC";
        
        return $this->query($query, [
            'hotel_id' => $hotel_id,
            'user_id' => $user_id,
            'last_timestamp' => $last_timestamp
        ]);
    }

    // Mark messages as read
    public function markAsRead($hotel_id, $sender_id) {
        $query = "UPDATE messages 
                  SET is_read = 1 
                  WHERE sender_id = :sender_id 
                  AND receiver_id = :hotel_id 
                  AND is_read = 0";
        
        return $this->query($query, [
            'sender_id' => $sender_id,
            'hotel_id' => $hotel_id
        ]);
    }

    // Send new message
    public function sendMessage($sender_id, $receiver_id, $content, $hotel_id) {
        // Sanitize content
        $sanitized_content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
        
        $data = [
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'content' => $sanitized_content,
            'timestamp' => date('Y-m-d H:i:s'),
            'is_read' => 0,
            'hotel_id' => $hotel_id
        ];
        
        return $this->insert($data);
    }

    // Search conversations by user name
    public function searchConversations($hotel_id, $search_term) {
        $query = "SELECT DISTINCT 
                    u.user_id, 
                    u.name, 
                    u.profile_image,
                    (SELECT content FROM messages WHERE 
                        ((sender_id = u.user_id AND receiver_id = :hotel_id) OR 
                        (sender_id = :hotel_id AND receiver_id = u.user_id))
                        ORDER BY timestamp DESC LIMIT 1) as last_message,
                    (SELECT timestamp FROM messages WHERE 
                        ((sender_id = u.user_id AND receiver_id = :hotel_id) OR 
                        (sender_id = :hotel_id AND receiver_id = u.user_id))
                        ORDER BY timestamp DESC LIMIT 1) as last_message_time,
                    (SELECT COUNT(*) FROM messages WHERE 
                        sender_id = u.user_id AND receiver_id = :hotel_id AND is_read = 0) as unread_count
                FROM users u
                JOIN messages m ON (u.user_id = m.sender_id OR u.user_id = m.receiver_id)
                WHERE (m.sender_id = :hotel_id OR m.receiver_id = :hotel_id)
                AND u.user_id != :hotel_id
                AND u.name LIKE :search_term
                ORDER BY last_message_time DESC";
        
        return $this->query($query, [
            'hotel_id' => $hotel_id,
            'search_term' => '%' . $search_term . '%'
        ]);
    }
}