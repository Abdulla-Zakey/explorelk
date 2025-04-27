<?php 
    include_once APPROOT . '/views/travelagent/nav.php';
    include_once APPROOT . '/views/travelagent/travelagenthead.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/travelagent/messages.css?v=1.4">
    <title>Travel Agent Messaging System</title>
</head>

<body>
    <div class="chat-container">
        <div class="sidebar1">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search travelers...">
            </div>
            <div class="contacts-list">
                <?php if (!empty($data['conversations'])): ?>
                    <?php foreach ($data['conversations'] as $conversation): ?>
                        <div class="contact"
                            data-travelagent-id="<?= htmlspecialchars($_SESSION['travelagent_id'] ?? '') ?>"
                            data-traveler-id="<?= htmlspecialchars($conversation->traveler_Id) ?>"
                            data-traveler-name="<?= htmlspecialchars($conversation->username) ?>">
                            <img src="<?= !empty($conversation->profilePicture) ? htmlspecialchars(ROOT . '/assets/images/users/' . $conversation->profilePicture) : htmlspecialchars(ROOT . '/assets/images/serviceProviders/profile.jpg') ?>"
                                alt="<?= htmlspecialchars($conversation->username) ?>"
                                onerror="this.src='<?= htmlspecialchars(ROOT) ?>/assets/images/serviceProviders/profile.jpg';">
                            <div class="contact-info">
                                <p class="name"><?= htmlspecialchars($conversation->username) ?></p>
                                <p class="preview"><?= htmlspecialchars($conversation->last_message ?: 'No messages yet') ?></p>
                            </div>
                            <p class="timestamp">
                                <?= !empty($conversation->timestamp) ? htmlspecialchars(date('h:i A', strtotime($conversation->timestamp))) : '' ?>
                            </p>
                            <?php if (isset($conversation->unread_count) && $conversation->unread_count > 0): ?>
                                <div class="unread-badge"><?= htmlspecialchars($conversation->unread_count) ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No conversations yet</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="chat-main">
            <div class="chat-header"></div>
            <div class="chat-messages">
                <div class="empty-state">
                    <i class="fa-solid fa-comments"></i>
                    <p>Select a contact to start chatting</p>
                </div>
            </div>
            <div class="chat-input">
                <div class="input-wrapper">
                    <input type="text" placeholder="Type your message..." disabled>
                    <button type="button" disabled><i class="fa-solid fa-paper-plane"></i> Send</button>
                </div>
                <div class="error-message"></div>
            </div>
        </div>
    </div>

    <script>
    const ROOT = "<?= ROOT ?>";

    document.addEventListener('DOMContentLoaded', () => {
        // DOM Elements
        const contactsList = document.querySelector('.contacts-list');
        const chatHeader = document.querySelector('.chat-header');
        const chatMessages = document.querySelector('.chat-messages');
        const messageInput = document.querySelector('.input-wrapper input');
        const sendButton = document.querySelector('.input-wrapper button');
        const errorMessage = document.querySelector('.error-message');
        const searchBar = document.querySelector('.search-bar');

        // State
        let selectedTravelagentId = null;
        let selectedTravelerId = null;
        let selectedTravelerName = null;
        let lastMessageTimestamp = null;
        let pollingInterval = null;
        let isMessageSending = false;
        let messageQueue = [];
        let processedMessages = new Set();

        // Search functionality
        let searchTimeout;
        searchBar.addEventListener('input', () => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = searchBar.value.toLowerCase();
                document.querySelectorAll('.contact').forEach(contact => {
                    const name = contact.querySelector('.name').textContent.toLowerCase();
                    contact.style.display = name.includes(searchTerm) ? 'flex' : 'none';
                });
            }, 300);
        });

        // Format timestamp
        function formatTimestamp(timestamp) {
            if (!timestamp) return '';
            const date = new Date(timestamp);
            if (isNaN(date.getTime())) return '';

            const now = new Date();
            const timeOptions = { hour: '2-digit', minute: '2-digit', hour12: true };

            if (date.toDateString() === now.toDateString()) {
                return date.toLocaleTimeString([], timeOptions);
            }

            const yesterday = new Date(now);
            yesterday.setDate(now.getDate() - 1);
            if (date.toDateString() === yesterday.toDateString()) {
                return 'Yesterday';
            }

            return date.toLocaleDateString();
        }

        // Format date separator
        function formatDateForSeparator(timestamp) {
            if (!timestamp) return '';
            const date = new Date(timestamp);
            const now = new Date();
            if (date.toDateString() === now.toDateString()) {
                return 'Today';
            }
            const yesterday = new Date(now);
            yesterday.setDate(now.getDate() - 1);
            if (date.toDateString() === yesterday.toDateString()) {
                return 'Yesterday';
            }
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString(undefined, options);
        }

        // Add message
        function addMessage(message, isTemp = false) {
            const messageId = message.message_id || (isTemp ? `temp_${Date.now()}` : Date.now());
            if (processedMessages.has(messageId) && !isTemp) return;

            processedMessages.add(messageId);
            
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${message.sender_type === 'travelagent' ? 'sent' : 'received'} ${isTemp ? 'temp' : ''}`;
            messageDiv.id = `msg_${messageId}`;

            const timestamp = message.timestamp || new Date().toISOString();
            const formattedTime = formatTimestamp(timestamp);

            messageDiv.innerHTML = `
                <div class="message-content">${message.conversations}</div>
                <div class="message-time" data-full-date="${timestamp}">${formattedTime}</div>
            `;

            const messageDate = new Date(timestamp).toDateString();
            const lastMessage = chatMessages.querySelector('.message:last-child');
            if (lastMessage) {
                const lastTimestamp = lastMessage.querySelector('.message-time').dataset.fullDate;
                if (lastTimestamp && new Date(lastTimestamp).toDateString() !== messageDate) {
                    const dateSeparator = document.createElement('div');
                    dateSeparator.className = 'date-separator';
                    dateSeparator.textContent = formatDateForSeparator(timestamp);
                    chatMessages.appendChild(dateSeparator);
                }
            } else {
                const dateSeparator = document.createElement('div');
                dateSeparator.className = 'date-separator';
                dateSeparator.textContent = formatDateForSeparator(timestamp);
                chatMessages.appendChild(dateSeparator);
            }

            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            if (!isTemp && timestamp > lastMessageTimestamp) {
                lastMessageTimestamp = timestamp;
            }
        }

        // Show error
        function showError(message) {
            errorMessage.textContent = message;
            errorMessage.style.display = 'block';
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 5000);
        }

        // Update contact preview
        function updateContactPreview(travelerId, message, timestamp) {
            const contact = document.querySelector(`.contact[data-traveler-id="${travelerId}"]`);
            if (contact) {
                const preview = contact.querySelector('.preview');
                const timestampEl = contact.querySelector('.timestamp');
                if (preview) preview.textContent = message;
                if (timestampEl) timestampEl.textContent = formatTimestamp(timestamp);
                const parentNode = contact.parentNode;
                if (parentNode && parentNode.firstChild !== contact) {
                    parentNode.insertBefore(contact, parentNode.firstChild);
                }
            }
        }

        // Send message
        function sendMessage(content) {
            if (!selectedTravelagentId || !selectedTravelerId || isMessageSending) {
                messageQueue.push(content);
                return;
            }

            isMessageSending = true;
            const tempId = `temp_${Date.now()}`;
            const messageTimestamp = new Date().toISOString();

            addMessage({
                message_id: tempId,
                conversations: content,
                timestamp: messageTimestamp,
                sender_type: 'travelagent',
                is_read: 1
            }, true);

            messageInput.value = '';
            sendButton.disabled = true;
            messageInput.focus();

            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }

            fetch(`${ROOT}/travelagent/TAmessages/api_sendMessage`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    travelagent_id: selectedTravelagentId,
                    traveler_id: selectedTravelerId,
                    content: content
                })
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                const tempMessage = document.getElementById(tempId);
                if (data.success && tempMessage) {
                    tempMessage.classList.remove('temp');
                    tempMessage.id = `msg_${data.message_id}`;
                    lastMessageTimestamp = data.timestamp;
                    updateContactPreview(selectedTravelerId, content, data.timestamp);
                } else {
                    if (tempMessage) tempMessage.classList.add('error');
                    showError(data.error || 'Failed to send message');
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                const tempMessage = document.getElementById(tempId);
                if (tempMessage) tempMessage.classList.add('error');
                showError('Failed to send message. Please try again.');
            })
            .finally(() => {
                isMessageSending = false;
                if (messageQueue.length > 0) {
                    sendMessage(messageQueue.shift());
                } else if (selectedTravelagentId && selectedTravelerId) {
                    setTimeout(startPolling, 1000);
                }
            });
        }

        // Fetch conversation
        function fetchConversation(silent = false) {
            if (!selectedTravelagentId || !selectedTravelerId) return;
            
            if (!silent) {
                chatMessages.innerHTML = '<div class="loading-state"><i class="fa-solid fa-spinner fa-spin"></i><p>Loading messages...</p></div>';
            }

            let url = `${ROOT}/travelagent/TAmessages/api_getConversation`;
            const params = new URLSearchParams({
                travelagent_id: selectedTravelagentId,
                traveler_id: selectedTravelerId
            });

            if (lastMessageTimestamp && silent) {
                params.append('last_timestamp', lastMessageTimestamp);
            }

            url += '?' + params.toString();

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                const messages = data.messages || [];
                if (!silent) {
                    chatMessages.innerHTML = '';
                    if (messages.length === 0) {
                        chatMessages.innerHTML = '<div class="empty-state"><p>No messages yet. Start the conversation!</p></div>';
                    } else {
                        messages.forEach(message => addMessage(message));
                    }
                } else {
                    messages.forEach(message => {
                        const messageId = message.message_id;
                        if (!processedMessages.has(messageId)) {
                            const tempMessages = document.querySelectorAll('.message.temp');
                            let isDuplicate = false;

                            tempMessages.forEach(tempMsg => {
                                const tempContent = tempMsg.querySelector('.message-content').textContent;
                                if (tempContent === message.conversations) {
                                    tempMsg.id = `msg_${messageId}`;
                                    tempMsg.classList.remove('temp');
                                    const serverTimestamp = message.timestamp;
                                    tempMsg.querySelector('.message-time').textContent = formatTimestamp(serverTimestamp);
                                    tempMsg.querySelector('.message-time').dataset.fullDate = serverTimestamp;
                                    processedMessages.add(messageId);
                                    isDuplicate = true;
                                }
                            });

                            if (!isDuplicate) {
                                addMessage(message);
                            }
                        }
                    });
                }

                if (selectedTravelagentId && selectedTravelerId) {
                    markConversationAsRead();
                }
            })
            .catch(error => {
                console.error('Error fetching conversation:', error);
                if (!silent) {
                    chatMessages.innerHTML = '<div class="empty-state"><p>Failed to load messages. Please try again.</p></div>';
                }
            });
        }

        // Mark as read
        function markConversationAsRead() {
            if (!selectedTravelagentId || !selectedTravelerId) return;
            fetch(`${ROOT}/travelagent/TAmessages/api_markAsRead`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    travelagent_id: selectedTravelagentId,
                    traveler_id: selectedTravelerId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const contact = document.querySelector(`.contact[data-traveler-id="${selectedTravelerId}"]`);
                    if (contact) {
                        const badge = contact.querySelector('.unread-badge');
                        if (badge) badge.remove();
                    }
                }
            })
            .catch(error => {
                console.warn('Error marking conversation as read:', error);
            });
        }

        // Update unread counts
        function updateUnreadCounts() {
            if (!selectedTravelagentId) return;
            fetch(`${ROOT}/travelagent/TAmessages/api_getUnreadCounts?travelagent_id=${selectedTravelagentId}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                const unreadCounts = data.unread_counts || {};
                document.querySelectorAll('.contact').forEach(contact => {
                    const travelerId = contact.dataset.travelerId;
                    if (!travelerId) return;
                    const existingBadge = contact.querySelector('.unread-badge');
                    if (existingBadge) existingBadge.remove();
                    const unreadCount = unreadCounts[travelerId];
                    if (unreadCount && unreadCount > 0) {
                        const badge = document.createElement('div');
                        badge.className = 'unread-badge';
                        badge.textContent = unreadCount;
                        contact.appendChild(badge);
                    }
                });
            })
            .catch(error => {
                console.warn('Error updating unread counts:', error);
            });
        }

        // Load chat
        function loadChat(travelagentId, travelerId, travelerName, contactElement) {
            selectedTravelagentId = travelagentId;
            selectedTravelerId = travelerId;
            selectedTravelerName = travelerName;
            lastMessageTimestamp = null;
            processedMessages.clear();

            document.querySelectorAll('.contact').forEach(c => c.classList.remove('active'));
            contactElement.classList.add('active');
            const travelerImage = contactElement.querySelector('img').src;
            chatHeader.innerHTML = `
                <img src="${travelerImage}" alt="${travelerName}">
                <h3>${travelerName}</h3>
            `;
            messageInput.disabled = false;
            messageInput.placeholder = `Message ${travelerName}...`;
            messageInput.focus();
            sendButton.disabled = !messageInput.value.trim();
            fetchConversation();
            startPolling();
        }

        // Start polling
        function startPolling() {
            if (pollingInterval) {
                clearInterval(pollingInterval);
                pollingInterval = null;
            }

            if (!selectedTravelagentId || !selectedTravelerId) return;

            pollingInterval = setInterval(() => {
                if (!isMessageSending) {
                    fetchConversation(true);
                }
            }, 5000);
        }

        // Event handlers
        function handleMessageInput() {
            sendButton.disabled = !messageInput.value.trim();
            errorMessage.style.display = 'none';
        }

        function handleKeyPress(e) {
            if (e.key === 'Enter' && !sendButton.disabled) {
                e.preventDefault();
                sendMessage(messageInput.value.trim());
            }
        }

        // Setup event listeners
        function setupEventListeners() {
            document.querySelectorAll('.contact').forEach(contact => {
                const newContact = contact.cloneNode(true);
                contact.parentNode.replaceChild(newContact, contact);
                newContact.addEventListener('click', () => {
                    const travelagentId = newContact.dataset.travelagentId;
                    const travelerId = newContact.dataset.travelerId;
                    const travelerName = newContact.dataset.travelerName;
                    loadChat(travelagentId, travelerId, travelerName, newContact);
                });
            });

            messageInput.removeEventListener('input', handleMessageInput);
            messageInput.removeEventListener('keypress', handleKeyPress);
            sendButton.removeEventListener('click', sendMessage);

            messageInput.addEventListener('input', handleMessageInput);
            messageInput.addEventListener('keypress', handleKeyPress);
            sendButton.addEventListener('click', () => sendMessage(messageInput.value.trim()));
        }

        // Initialize
        setupEventListeners();
        updateUnreadCounts();

        // Handle visibility
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible' && selectedTravelagentId && selectedTravelerId) {
                startPolling();
            } else if (pollingInterval) {
                clearInterval(pollingInterval);
            }
        });

        // Cleanup
        window.addEventListener('beforeunload', () => {
            if (pollingInterval) clearInterval(pollingInterval);
        });

        // Periodic unread count update
        setInterval(updateUnreadCounts, 30000);
    });
    </script>
</body>

</html>