<?php

class Hmessages extends Controller {
    private $hotelModel;
    private $messageModel;
    private $userModel;
    
    public function __construct() {
        // Check if session is active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in
        if (!isset($_SESSION['hotel_id'])) {
            redirect('hlogin');
            exit; // Ensure execution stops
        }
        
        $this->hotelModel = new Hotel();
        $this->messageModel = new Message();
        $this->userModel = new User();
    }
   
    public function index($a = '', $b = '', $c = '') {
        $data = [];
        $data['hotelBasic'] = $this->hotelModel->first(['hotel_Id' => $_SESSION['hotel_id']]);
        $data['conversations'] = $this->messageModel->getHotelConversations($_SESSION['hotel_id']);
        
        $this->view('hotel/messages', data: $data);
    }
    
    // API method to get conversation with a specific user
    public function getConversation() {
        // Check if request is AJAX
        if (!$this->isAjaxRequest()) {
            redirect('hmessages');
            exit;
        }
        
        // Get user ID from POST
        $user_id = $_POST['user_id'] ?? 0;
        if (!$user_id) {
            echo json_encode(['error' => 'Invalid user ID']);
            return;
        }
        
        // Get messages
        $messages = $this->messageModel->getConversation($_SESSION['hotel_id'], $user_id);
        $user = $this->userModel->first(['user_id' => $user_id]);
        
        if (!$user) {
            echo json_encode(['error' => 'User  not found']);
            return;
        }
        
        // Return JSON response
        echo json_encode([
            'messages' => $messages,
            'user' => [
                'name' => $user->name ?? 'Unknown',
                'profile_image' => $user->profile_image ?? ''
            ]
        ]);
    }
    
    // API method to check for new messages
    public function checkNewMessages() {
        // Check if request is AJAX
        if (!$this->isAjaxRequest()) {
            redirect('hmessages');
            exit;
        }
        
        // Get user ID and last message time from POST
        $user_id = $_POST['user_id'] ?? 0;
        $last_timestamp = $_POST['last_timestamp'] ?? '';
        
        if (!$user_id || !$last_timestamp) {
            echo json_encode(['error' => 'Missing required data']);
            return;
        }
        
        // Get new messages
        $new_messages = $this->messageModel->getNewMessages($_SESSION['hotel_id'], $user_id, $last_timestamp);
        
        // Mark messages as read
        if (!empty($new_messages)) {
            $this->messageModel->markAsRead($_SESSION['hotel_id'], $user_id);
        }
        
        // Return JSON response
        echo json_encode([
            'new_messages' => $new_messages,
            'count' => count($new_messages)
        ]);
    }
    
    // API method to send a message
    public function sendMessage() {
        // Check if request is AJAX
        if (!$this->isAjaxRequest()) {
            redirect('hmessages');
            exit;
        }
        
        // Get data from POST
        $user_id = $_POST['user_id'] ?? 0;
        $content = $_POST['content'] ?? ''; // Changed from 'message' to 'content'
        
        if (!$user_id) {
            echo json_encode(['error' => 'Invalid user ID']);
            return;
        }
        
        // Validate content
        if (empty(trim($content))) {
            echo json_encode(['error' => 'Message cannot be empty']);
            return;
        }
        
        // Limit message length
        if (strlen($content) > 1000) { // Adjust max length as needed
            echo json_encode(['error' => 'Message too long (maximum 1000 characters)']);
            return;
        }
        
        // Send message
        $result = $this->messageModel->sendMessage(
            $_SESSION['hotel_id'],
            $user_id,
            $content,
            $_SESSION['hotel_id'] // Assuming this is the sender ID
        );
        
        // Return JSON response
        if ($result) {
            // Get the latest message to return
            $messages = $this->messageModel->getConversation($_SESSION['hotel_id'], $user_id);
            echo json_encode([
                'success' => true,
                'message' => end($messages) // Get the last message
            ]);
        } else {
            echo json_encode(['error' => 'Failed to send message']);
        }
    }
    
    // API method to search conversations
    public function searchConversations() {
        // Check if request is AJAX
        if (!$this->isAjaxRequest()) {
            redirect('hmessages');
            exit;
        }
        
        // Get search term from POST
        $search_term = $_POST['search_term'] ?? '';
        
        if (empty(trim($search_term))) {
            echo json_encode(['error' => 'Search term cannot be empty']);
            return;
        }
        
        // Get conversations
        $conversations = $this->messageModel->searchConversations($_SESSION['hotel_id'], $search_term);
        
        // Return JSON response
        echo json_encode(['conversations' => $conversations]);
    }
    
    // API method to mark messages as read
    public function markAsRead() {
        // Check if request is AJAX
        if (!$this->isAjaxRequest()) {
            redirect('hmessages');
            exit;
        }
        
        // Get user ID from POST
        $user_id = $_POST['user_id'] ?? 0;
        
        if (!$user_id) {
            echo json_encode(['error' => 'Invalid user ID']);
            return;
        }
        
        // Mark messages as read
        $result = $this->messageModel->markAsRead($_SESSION['hotel_id'], $user_id);
        
        // Return JSON response
        echo json_encode(['success' => true]);
    }
    
    // Helper function to check if the request is AJAX
    private function isAjaxRequest() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}