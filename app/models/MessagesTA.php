<?php

class MessagesTA {
    use Model;
    
    protected $table = 'messagesta';
    
    protected $allowedColumns = [
        'message_id',
        'travelagent_Id',
        'traveler_Id',
        'sender_type',
        'conversations',
        'is_read',
        'timestamp'
    ];
    
    public function getTravelAgentConversations($travelagent_id) {
        $sql = "SELECT m.traveler_Id, t.username, t.profilePicture, 
                    (SELECT conversations FROM messagesta 
                     WHERE travelagent_Id = :travelagent_Id AND traveler_Id = m.traveler_Id 
                     ORDER BY timestamp DESC LIMIT 1) as last_message,
                    (SELECT timestamp FROM messagesta 
                     WHERE travelagent_Id = :travelagent_Id AND traveler_Id = m.traveler_Id 
                     ORDER BY timestamp DESC LIMIT 1) as timestamp,
                    (SELECT COUNT(*) FROM messagesta 
                     WHERE travelagent_Id = :travelagent_Id AND traveler_Id = m.traveler_Id 
                     AND sender_type = 'traveler' AND is_read = 0) as unread_count
                FROM messagesta m
                JOIN traveler t ON m.traveler_Id = t.traveler_Id
                WHERE m.travelagent_Id = :travelagent_Id
                GROUP BY m.traveler_Id, t.username, t.profilePicture
                ORDER BY timestamp DESC";
        
        try {
            $conversations = $this->query($sql, ['travelagent_Id' => $travelagent_id]);
            foreach ($conversations as $conversation) {
                $conversation->unread_count = (int)$conversation->unread_count;
            }
            return $conversations;
        } catch (Exception $e) {
            error_log('Error in getTravelAgentConversations: ' . $e->getMessage());
            return [];
        }
    }
    
    public function getConversation($travelagent_Id, $traveler_Id, $last_timestamp = null) {
        if (!is_numeric($travelagent_Id) || !is_numeric($traveler_Id)) {
            error_log('Invalid travelagent_Id or traveler_Id');
            return [];
        }
        
        $params = [
            'travelagent_Id' => $travelagent_Id,
            'traveler_Id' => $traveler_Id
        ];
        
        $sql = "SELECT message_id, travelagent_Id, traveler_Id, sender_type, conversations, is_read, 
                timestamp AS timestamp 
                FROM messagesta 
                WHERE travelagent_Id = :travelagent_Id AND traveler_Id = :traveler_Id";
        
        if ($last_timestamp !== null) {
            $sql .= " AND timestamp > :last_timestamp";
            $params['last_timestamp'] = $last_timestamp;
        }
        
        $sql .= " ORDER BY timestamp ASC";
        
        try {
            return $this->query($sql, $params);
        } catch (Exception $e) {
            error_log('Error in getConversation: ' . $e->getMessage());
            throw new Exception('Failed to retrieve conversation');
        }
    }
    
    public function sendMessage($travelagent_Id, $traveler_Id, $conversations, $sender_type) {
        if (!is_numeric($travelagent_Id) || !is_numeric($traveler_Id)) {
            error_log('Invalid travelagent_Id or traveler_Id');
            return false;
        }
        
        if (!in_array($sender_type, ['travelagent', 'traveler'])) {
            error_log('Invalid sender_type');
            return false;
        }
        
        if (empty(trim($conversations))) {
            error_log('Empty message content');
            return false;
        }
        
        date_default_timezone_set('Asia/Colombo');
        
        $data = [
            'travelagent_Id' => $travelagent_Id,
            'traveler_Id' => $traveler_Id,
            'conversations' => trim($conversations),
            'sender_type' => $sender_type,
            'timestamp' => date('Y-m-d H:i:s.u'),
            'is_read' => $sender_type === 'travelagent' ? 1 : 0
        ];
        
        try {
            $con = $this->connect();
            $con->beginTransaction();
            $message_id = $this->insert($data);
            $con->commit();
            return $message_id;
        } catch (Exception $e) {
            $con->rollBack();
            error_log('Error in sendMessage: ' . $e->getMessage());
            throw new Exception('Failed to send message');
        }
    }
    
    public function markAsRead($travelagent_Id, $traveler_Id) {
        if (!is_numeric($travelagent_Id) || !is_numeric($traveler_Id)) {
            error_log('Invalid travelagent_Id or traveler_Id');
            return false;
        }
        
        $sql = "UPDATE messagesta SET is_read = 1 
                WHERE travelagent_Id = :travelagent_Id 
                AND traveler_Id = :traveler_Id 
                AND sender_type = 'traveler' 
                AND is_read = 0";
        
        try {
            $result = $this->query($sql, [
                'travelagent_Id' => $travelagent_Id,
                'traveler_Id' => $traveler_Id
            ]);
            return true;
        } catch (Exception $e) {
            error_log('Error in markAsRead: ' . $e->getMessage());
            throw new Exception('Failed to mark messages as read');
        }
    }
    
    public function getUnreadCounts($travelagent_Id) {
        if (!is_numeric($travelagent_Id)) {
            error_log('Invalid travelagent_Id');
            return [];
        }
        
        $sql = "SELECT traveler_Id, COUNT(*) as count 
                FROM messagesta 
                WHERE travelagent_Id = :travelagent_Id 
                AND sender_type = 'traveler' 
                AND is_read = 0 
                GROUP BY traveler_Id";
        
        try {
            return $this->query($sql, ['travelagent_Id' => $travelagent_Id]);
        } catch (Exception $e) {
            error_log('Error in getUnreadCounts: ' . $e->getMessage());
            throw new Exception('Failed to get unread counts');
        }
    }
}