<?php

class TAmessages extends Controller {
    private $messagestamodel;
    
    public function __construct() {
        if (!isset($_SESSION['travelagent_id']) || !is_numeric($_SESSION['travelagent_id'])) {
            redirect('login');
        }
        $this->messagestamodel = $this->loadModel('MessagesTA');
    }
    
    public function index() {
        $data['conversations'] = $this->messagestamodel->getTravelAgentConversations($_SESSION['travelagent_id']);
        $this->view('travelagent/messages', $data);
    }
    
    public function api_getConversation() {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        $travelagent_id = isset($_GET['travelagent_id']) ? (int)$_GET['travelagent_id'] : null;
        $traveler_id = isset($_GET['traveler_id']) ? (int)$_GET['traveler_id'] : null;
        
        if (!$travelagent_id || !$traveler_id || $travelagent_id !== $_SESSION['travelagent_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        $lastTimestamp = isset($_GET['last_timestamp']) ? urldecode($_GET['last_timestamp']) : null;
        
        try {
            $messages = $this->messagestamodel->getConversation($travelagent_id, $traveler_id, $lastTimestamp);
            echo json_encode([
                'success' => true,
                'messages' => $messages,
                'server_time' => date('Y-m-d H:i:s.u')
            ]);
        } catch (Exception $e) {
            error_log('Error fetching conversation: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch conversation']);
        }
    }
    
    public function api_sendMessage() {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['travelagent_id']) || !isset($data['traveler_id']) || 
            !isset($data['content']) || empty(trim($data['content']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing or invalid required fields']);
            exit;
        }
        
        if ((int)$data['travelagent_id'] !== $_SESSION['travelagent_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        try {
            $message_id = $this->messagestamodel->sendMessage(
                (int)$data['travelagent_id'],
                (int)$data['traveler_id'],
                trim($data['content']),
                'travelagent'
            );
            if ($message_id) {
                echo json_encode([
                    'success' => true,
                    'message_id' => $message_id,
                    'timestamp' => date('Y-m-d H:i:s.u')
                ]);
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
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($data['travelagent_id']) || !isset($data['traveler_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            exit;
        }
        
        if ((int)$data['travelagent_id'] !== $_SESSION['travelagent_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        try {
            $success = $this->messagestamodel->markAsRead((int)$data['travelagent_id'], (int)$data['traveler_id']);
            echo json_encode(['success' => $success]);
        } catch (Exception $e) {
            error_log('Error marking as read: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to mark messages as read']);
        }
    }
    
    public function api_getUnreadCounts() {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
            http_response_code(403);
            echo json_encode(['error' => 'Invalid request']);
            exit;
        }
        
        $travelagent_id = isset($_GET['travelagent_id']) ? (int)$_GET['travelagent_id'] : null;
        
        if (!$travelagent_id || $travelagent_id !== $_SESSION['travelagent_id']) {
            http_response_code(403);
            echo json_encode(['error' => 'Access denied']);
            exit;
        }
        
        try {
            $counts = $this->messagestamodel->getUnreadCounts($travelagent_id);
            $formattedCounts = [];
            foreach ($counts as $count) {
                $formattedCounts[$count->traveler_Id] = (int)$count->count;
            }
            echo json_encode(['success' => true, 'unread_counts' => $formattedCounts]);
        } catch (Exception $e) {
            error_log('Error fetching unread counts: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch unread counts']);
        }
    }
    
    public function test() {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Test endpoint working']);
        exit;
    }
}