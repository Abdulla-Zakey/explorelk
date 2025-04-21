<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
    
    // ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            min-height: 100vh;
            padding: 20px;
            margin-left: 100px;
        }

        .chat-container {
            display: flex;
            max-width: 1100px;
            margin-top: 200px;
            margin-left: 165px; 
            height: 70vh;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar1 {
            width: 30%;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            border-radius: 10px 0 0 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .heading {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #ddd;
        }

        .heading h2 {
            font-size: 1.5em;
            font-weight: 600;
            color: #002D40;
        }

        .search-bar {
            padding: 15px;
            background: #fff;
            border: none;
            border-bottom: 1px solid #ddd;
            width: 100%;
            font-size: 1rem;
        }

        .search-bar:focus {
            outline: none;
            background-color: #f8f9fa;
        }

        .contacts-list {
            overflow-y: auto;
            flex: 1;
        }

        .contact {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s;
        }

        .contact:hover {
            background-color: #f0f0f0;
        }

        .contact.active {
            background-color: #e3f2fd;
        }

        .contact img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }

        .contact-info {
            flex: 1;
        }

        .contact-info .name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .contact-info .preview {
            font-size: 0.9em;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .unread-badge {
            background-color: #002D40;
            color: white;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            font-size: 0.7em;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }

        .chat {
            width: 70%;
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 0 10px 10px 0;
        }

        .chat-header {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .empty-state {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 1.2em;
            text-align: center;
        }
        
        .empty-state i {
            font-size: 3em;
            margin-bottom: 20px;
            color: #002D40;  
        }
        
        .message {
            max-width: 70%;
            margin-bottom: 15px;
            padding: 12px 15px;
            border-radius: 10px;
            background: #f0f0f0;
            align-self: flex-start;
            word-break: break-word;
        }

        .message.sent {
            background: #e3f2fd;
            align-self: flex-end;
        }
        
        .message.pending {
            opacity: 0.7;
        }

        .message-time {
            font-size: 0.7em;
            color: #888;
            margin-top: 5px;
            text-align: right;
        }

        .chat-input {
            padding: 20px;
            background: #fff;
            border-top: 1px solid #ddd;
        }

        .input-wrapper {
            display: flex;
            gap: 10px;
        }

        .input-wrapper input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #002D40;
        }

        .input-wrapper button {
            padding: 12px 24px;
            background: #002D40;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .input-wrapper button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .input-wrapper button:not(:disabled):hover {
            background: #003d5c;
        }
        
        .loading {
            text-align: center;
            padding: 20px;
            color: #666;
        }
        
        .error-message {
            color: #e74c3c;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            display: none;
        }
        
        .empty-contacts {
            padding: 20px;
            text-align: center;
            color: #666;
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .chat-container {
                flex-direction: column;
                margin-left: 0;
                margin-top: 100px;
                height: 85vh;
            }
            
            .sidebar1 {
                width: 100%;
                height: 35%;
                border-radius: 10px 10px 0 0;
            }
            
            .chat {
                width: 100%;
                height: 65%;
                border-radius: 0 0 10px 10px;
            }
            
            body {
                margin-left: 0;
                padding: 10px;
            }
        }
    </style>
    <title>Chat Interface</title>
</head>
<body>
    <div class="chat-container">
        <div class="sidebar1">
            <div class="heading">
                <h2>Messages</h2>
            </div>
            <input type="text" class="search-bar" placeholder="Search contacts...">
            <div class="contacts-list">
                <?php if (!empty($data['conversations'])): ?>
                    <?php foreach ($data['conversations'] as $conversation): ?>
                        <div class="contact" data-user-id="<?= $conversation->user_id ?>">
                            <img src="<?= !empty($conversation->profile_image) ? ROOT . '/assets/images/users/' . $conversation->profile_image : ROOT . '/assets/images/serviceProviders/profile.jpg' ?>" alt="<?= htmlspecialchars($conversation->name) ?>">
                            <div class="contact-info">
                                <p class="name"><?= htmlspecialchars($conversation->name) ?></p>
                                <p class="preview"><?= htmlspecialchars($conversation->last_message) ?></p>
                            </div>
                            <?php if ($conversation->unread_count > 0): ?>
                                <div class="unread-badge"><?= $conversation->unread_count ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-contacts">
                        <p>No conversations yet</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="chat">
        
            <div class="chat-messages">
                <div class="empty-state">
                    <i class="fa-solid fa-comments"></i>
                    <p>Select a contact to start chatting</p>
                </div>
            </div>
            <div class="chat-input">
                <div class="input-wrapper">
                    <input type="text" placeholder="Type your message...">
                    <button disabled>Send</button>
                </div>
                <div class="error-message"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const contacts = document.querySelectorAll('.contact');
            const chatHeader = document.querySelector('.chat-header');
            const chatMessages = document.querySelector('.chat-messages');
            const chatInput = document.querySelector('.chat-input');
            const messageInput = chatInput.querySelector('input');
            const sendButton = chatInput.querySelector('button');
            const errorMessage = document.querySelector('.error-message');

            let selectedUserId = null;
            let lastMessageTimestamp = null;
            let pollingInterval = null;
            
            // Add click event listener to each contact
            contacts.forEach(contact => {
                contact.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    loadChat(userId, this);
                });
            });
            
            // Show/hide chat input based on message input
            messageInput.addEventListener('input', () => {
                sendButton.disabled = !messageInput.value.trim();
                errorMessage.style.display = 'none';
            });
            
            // Function to format timestamp
            function formatTimestamp(timestamp) {
                // Handle various timestamp formats
                let date;
                if (timestamp.includes('T') || timestamp.includes('Z')) {
                    // ISO format
                    date = new Date(timestamp);
                } else if (timestamp.includes('-') && timestamp.includes(':')) {
                    // MySQL format: 2023-02-25 14:30:45
                    date = new Date(timestamp.replace(' ', 'T'));
                } else {
                    // Fallback to current time if format is unrecognized
                    console.warn('Unrecognized timestamp format:', timestamp);
                    date = new Date();
                }
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
            
            // Function to show error message
            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.style.display = 'block';
                setTimeout(() => {
                    errorMessage.style.display = 'none';
                }, 5000);
            }
            
            // Start polling for new messages
            function startPolling() {
                if (pollingInterval) {
                    clearInterval(pollingInterval);
                }
                
                if (selectedUserId) {
                    pollingInterval = setInterval(() => {
                        checkNewMessages();
                    }, 5000); // Poll every 5 seconds
                }
            }
            
            // Stop polling for new messages
            function stopPolling() {
                if (pollingInterval) {
                    clearInterval(pollingInterval);
                    pollingInterval = null;
                }
            }
            
            // Check for new messages
            function checkNewMessages() {
                if (!selectedUserId) return;
                
                const formData = new FormData();
                formData.append('user_id', selectedUserId);
                
                // Only append timestamp if we have one
                if (lastMessageTimestamp) {
                    formData.append('last_timestamp', lastMessageTimestamp);
                }
                
                fetch('<?= ROOT ?>/hmessages/checkNewMessages', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        console.error('Error checking messages:', data.error);
                        return;
                    }
                    
                    if (data.new_messages && data.new_messages.length > 0) {
                        // Add new messages to chat
                        data.new_messages.forEach(message => {
                            addMessage(message);
                        });
                        
                        // Update last message timestamp
                        const lastMsg = data.new_messages[data.new_messages.length - 1];
                        lastMessageTimestamp = lastMsg.timestamp;
                        
                        // Update contact preview if it's the selected user
                        const contact = document.querySelector(`.contact[data-user-id="${selectedUserId}"]`);
                        if (contact) {
                            const preview = contact.querySelector('.preview');
                            if (preview) {
                                preview.textContent = lastMsg.content;
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error checking for new messages:', error);
                });
            }
            
            // Add a message to the chat
            function addMessage(message) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${message.message_type || (message.is_sender ? 'sent' : 'received')}`;
                messageDiv.innerHTML = `
                    ${message.content || message.message}
                    <div class="message-time">${formatTimestamp(message.timestamp)}</div>
                `;
                chatMessages.appendChild(messageDiv);
                
                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            function loadChat(userId, contactElement) {
                // Check if userId is valid
                if (!userId) {
                    console.error('Invalid user ID');
                    return;
                }
                
                // Stop current polling
                stopPolling();
                
                // Update selected user
                selectedUserId = userId;
                contacts.forEach(c => c.classList.remove('active'));
                contactElement.classList.add('active');
                
                // If there was an unread badge, remove it
                const unreadBadge = contactElement.querySelector('.unread-badge');
                if (unreadBadge) {
                    unreadBadge.remove();
                }

                // Show loading state
                chatMessages.innerHTML = '<div class="loading">Loading messages...</div>';
                
                // Update UI states
                chatHeader.style.display = 'flex';
                chatInput.style.display = 'block';
                const emptyState = document.querySelector('.empty-state');
                if (emptyState) {
                    emptyState.style.display = 'none';
                }

                // Reset error message
                errorMessage.style.display = 'none';

                // Fetch conversation from server
                const formData = new FormData();
                formData.append('user_id', userId);
                
                fetch('<?= ROOT ?>/hmessages/getConversation', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Conversation data:', data); // Debug
                    
                    if (data.error) {
                        showError(data.error);
                        chatMessages.innerHTML = `<div class="empty-state"><p>Error: ${data.error}</p></div>`;
                        return;
                    }
                    
                    // Update chat header
                    chatHeader.querySelector('h3').textContent = data.user.name;
                    if (data.user.profile_image) {
                        chatHeader.querySelector('img').src = '<?= ROOT ?>/assets/images/users/' + data.user.profile_image;
                    } else {
                        chatHeader.querySelector('img').src = '<?= ROOT ?>/assets/images/serviceProviders/profile.jpg';
                    }
                    
                    // Clear previous messages
                    chatMessages.innerHTML = '';
                    
                    // Add messages
                    if (!data.messages || data.messages.length === 0) {
                        chatMessages.innerHTML = '<div class="empty-state"><p>No messages yet. Start the conversation!</p></div>';
                        // Set a default timestamp (now) if no messages
                        lastMessageTimestamp = new Date().toISOString();
                    } else {
                        data.messages.forEach(message => {
                            addMessage(message);
                        });
                        
                        // Get the timestamp of the last message
                        const lastMsg = data.messages[data.messages.length - 1];
                        lastMessageTimestamp = lastMsg.timestamp;
                        
                        // Scroll to bottom
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }
                    
                    // Focus input
                    messageInput.focus();
                    sendButton.disabled = !messageInput.value.trim();
                    
                    // Start polling for new messages
                    startPolling();
                })
                .catch(error => {
                    console.error('Error loading conversation:', error);
                    chatMessages.innerHTML = '<div class="empty-state"><p>Error loading messages. Please try again.</p></div>';
                    showError('Failed to load messages. Please try again.');
                });
            }

            // Add event listener for send button
            sendButton.addEventListener('click', sendMessage);
            
            // Add event listener for enter key
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });

            function sendMessage() {
                const text = messageInput.value.trim();
                if (!text || !selectedUserId) return;

                // Disable input and button
                messageInput.disabled = true;
                sendButton.disabled = true;
                
                // Add temporary message to chat
                const tempId = 'msg-' + Date.now();
                const tempMessageDiv = document.createElement('div');
                tempMessageDiv.id = tempId;
                tempMessageDiv.className = 'message sent pending';
                tempMessageDiv.innerHTML = `
                    ${text}
                    <div class="message-time">Sending...</div>
                `;
                chatMessages.appendChild(tempMessageDiv);
                
                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                // Prepare form data
                const formData = new FormData();
                formData.append('user_id', selectedUserId);
                formData.append('message', text);
                
                // Send message to server
                fetch('<?= ROOT ?>/hmessages/sendMessage', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    // Enable input and clear it
                    messageInput.disabled = false;
                    messageInput.value = '';
                    messageInput.focus();
                    sendButton.disabled = true;
                    
                    if (data.error) {
                        // Update temporary message to show error
                        const tempMsg = document.getElementById(tempId);
                        if (tempMsg) {
                            tempMsg.classList.add('error');
                            tempMsg.querySelector('.message-time').textContent = 'Failed to send';
                        }
                        showError(data.error);
                        return;
                    }
                    
                    // Update temporary message with sent status
                    const tempMsg = document.getElementById(tempId);
                    if (tempMsg) {
                        tempMsg.classList.remove('pending');
                        tempMsg.querySelector('.message-time').textContent = formatTimestamp(data.message.timestamp);
                    }
                    
                    // Update last message timestamp
                    lastMessageTimestamp = data.message.timestamp;
                    
                    // Update contact preview
                    const contact = document.querySelector(`.contact[data-user-id="${selectedUserId}"]`);
                    if (contact) {
                        const preview = contact.querySelector('.preview');
                        if (preview) {
                            preview.textContent = text;
                        }
                        
                        // Move contact to top of list
                        const contactsList = document.querySelector('.contacts-list');
                        if (contactsList.firstChild) {
                            contactsList.insertBefore(contact, contactsList.firstChild);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    
                    // Enable input and button
                    messageInput.disabled = false;
                    messageInput.focus();
                    sendButton.disabled = !messageInput.value.trim();
                    
                    // Update temporary message to show error
                    const tempMsg = document.getElementById(tempId);
                    if (tempMsg) {
                        tempMsg.classList.add('error');
                        tempMsg.querySelector('.message-time').textContent = 'Failed to send';
                    }
                    
                    showError('Failed to send message. Please try again.');
                });
            }

            // Initialize search functionality
            const searchBar = document.querySelector('.search-bar');
            searchBar.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                contacts.forEach(contact => {
                    const name = contact.querySelector('.name').textContent.toLowerCase();
                    const preview = contact.querySelector('.preview').textContent.toLowerCase();
                    
                    if (name.includes(searchTerm) || preview.includes(searchTerm)) {
                        contact.style.display = 'flex';
                    } else {
                        contact.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>