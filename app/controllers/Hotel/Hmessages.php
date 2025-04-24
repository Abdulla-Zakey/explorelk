<?php

class Hmessages extends Controller {
    private $messagesModel;
    
    public function __construct() {
        if (!isset($_SESSION['hotel_id'])) {
            redirect('login');
        }
        $this->messagesModel = $this->loadModel('Messages');
    }
    
    public function index() {
        $data['conversations'] = $this->messagesModel->getHotelConversations($_SESSION['hotel_id']);
        $this->view('hotel/messages', $data);
    }
    
    public function api_getConversation($hotel_id = null, $traveler_id = null) {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        if (!$hotel_id || !$traveler_id || $hotel_id != $_SESSION['hotel_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        $lastTimestamp = isset($_GET['last_timestamp']) ? urldecode($_GET['last_timestamp']) : null;
        try {
            $messages = $this->messagesModel->getConversation($hotel_id, $traveler_id, $lastTimestamp);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'messages' => $messages]);
        } catch (Exception $e) {
            error_log('Error fetching conversation: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch conversation']);
        }
    }
    
    public function api_sendMessage() {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['hotel_id']) || !isset($data['traveler_id']) || !isset($data['content']) || empty(trim($data['content']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing or invalid required fields']);
            exit;
        }
        
        if ($data['hotel_id'] != $_SESSION['hotel_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        try {
            $message_id = $this->messagesModel->sendMessage(
                $data['hotel_id'],
                $data['traveler_id'],
                trim($data['content']),
                'hotel'
            );
            if ($message_id) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message_id' => $message_id]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to send message']);
            }
        } catch (Exception $e) {
            error_log('Error sending message: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to send message']);
        }
    }
    
    public function api_markAsRead() {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['hotel_id']) || !isset($data['traveler_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            exit;
        }
        
        if ($data['hotel_id'] != $_SESSION['hotel_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        try {
            $success = $this->messagesModel->markAsRead($data['hotel_id'], $data['traveler_id']);
            header('Content-Type: application/json');
            echo json_encode(['success' => $success]);
        } catch (Exception $e) {
            error_log('Error marking as read: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to mark messages as read']);
        }
    }
    
    public function api_getUnreadCounts($hotel_id = null) {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        if (!$hotel_id || $hotel_id != $_SESSION['hotel_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        try {
            $counts = $this->messagesModel->getUnreadCounts($hotel_id);
            $formattedCounts = [];
            foreach ($counts as $count) {
                $formattedCounts[$count->traveler_Id] = (int)$count->count;
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'unread_counts' => $formattedCounts]);
        } catch (Exception $e) {
            error_log('Error fetching unread counts: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch unread counts']);
        }
    }
}