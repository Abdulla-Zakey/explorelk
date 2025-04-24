<?php
    include_once APPROOT . '/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/messages.css?v=1.3">
    <title>Hotel Messaging System</title>
</head>
<body>
    <div class="chat-container">
        <!-- Sidebar with contacts -->
        <div class="sidebar1">
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search travelers...">
            </div>
            <div class="contacts-list">
                <?php if (!empty($data['conversations'])): ?>
                    <?php foreach ($data['conversations'] as $conversation): ?>
                        <div class="contact" 
                             data-hotel-id="<?= htmlspecialchars($_SESSION['hotel_id'] ?? '') ?>" 
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

        <!-- Main chat area -->
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
                    <button type="button" disabled><i class="fa-solid fa-paper-plane"></i>Send</button>
                </div>
                <div class="error-message"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // DOM Elements
            const contactsList = document.querySelector('.contacts-list');
            const chatHeader = document.querySelector('.chat-header');
            const chatMessages = document.querySelector('.chat-messages');
            const messageInput = document.querySelector('.input-wrapper input');
            const sendButton = document.querySelector('.input-wrapper button');
            const errorMessage = document.querySelector('.error-message');
            const searchBar = document.querySelector('.search-bar');
            const chat = document.querySelector('.input-wrapper');

            


            // State variables
            let selectedHotelId = null;
            let selectedTravelerId = null;
            let selectedTravelerName = null;
            let lastMessageTimestamp = null;
            let pollingInterval = null;

            // Search functionality with debounce
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

            // Format timestamp for display
            function formatTimestamp(timestamp) {
                if (!timestamp) return '';
                const date = new Date(timestamp);
                const now = new Date();
                if (date.toDateString() === now.toDateString()) {
                    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                }
                const yesterday = new Date(now);
                yesterday.setDate(now.getDate() - 1);
                if (date.toDateString() === yesterday.toDateString()) {
                    return 'Yesterday';
                }
                return date.toLocaleDateString();
            }

            // Format date for separator
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

            // Add message to chat
            function addMessage(message) {
                const messageId = message.message_id || message.id || Date.now();
                if (document.getElementById(`msg_${messageId}`) && !message.temp) {
                    return;
                }
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${message.sender_type === 'hotel' ? 'sent' : 'received'}`;
                if (message.temp) messageDiv.classList.add('temp');
                messageDiv.id = `msg_${messageId}`;

                const timestamp = message.timestamp || message.created_at;
                const formattedTime = formatTimestamp(timestamp);
                const messageContent = message.conversations || '';

                messageDiv.innerHTML = `
                    <div class="message-content">${messageContent}</div>
                    <div class="message-time">${formattedTime}</div>
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

                messageDiv.querySelector('.message-time').dataset.fullDate = timestamp;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Show error message
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
            function sendMessage() {
                if (!selectedHotelId || !selectedTravelerId) return;
                const content = messageInput.value.trim();
                if (!content) return;

                const tempId = 'msg_temp_' + Date.now();
                addMessage({
                    message_id: tempId,
                    conversations: content,
                    timestamp: new Date().toISOString(),
                    sender_type: 'hotel',
                    is_read: 1,
                    temp: true
                });

                messageInput.value = '';
                sendButton.disabled = true;
                messageInput.focus();

                fetch(`${ROOT}/Hmessages/api_sendMessage`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        hotel_id: selectedHotelId,
                        traveler_id: selectedTravelerId,
                        content: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const tempMessage = document.getElementById(tempId);
                    if (data.success && tempMessage) {
                        tempMessage.classList.remove('temp');
                        tempMessage.id = `msg_${data.message_id}`;
                        lastMessageTimestamp = new Date().toISOString();
                        updateContactPreview(selectedTravelerId, content, new Date().toISOString());
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
                });
            }

            // Fetch conversation
            // Fetch conversation
function fetchConversation(silent = false) {
    if (!selectedHotelId || !selectedTravelerId) return;
    if (!silent) {
        // Remove the spinner and just show empty div
        chatMessages.innerHTML = '';
    }

    let url = `${ROOT}/Hmessages/api_getConversation/${selectedHotelId}/${selectedTravelerId}`;
    if (lastMessageTimestamp && silent) {
        url += `?last_timestamp=${encodeURIComponent(lastMessageTimestamp)}`;
    }

    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        const messages = data.messages || [];
        if (!silent) {
            chatMessages.innerHTML = '';
            if (messages.length === 0) {
                chatMessages.innerHTML = '<div class="empty-state"><p>No messages yet. Start the conversation!</p></div>';
            } else {
                messages.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));
                messages.forEach(message => addMessage(message));
            }
        } else {
            const existingIds = Array.from(document.querySelectorAll('.message'))
                .map(el => el.id.replace('msg_', ''));
            messages.forEach(message => {
                const messageId = message.message_id || message.id || '';
                if (messageId && !existingIds.includes(messageId.toString())) {
                    addMessage(message);
                    const messageTimestamp = message.timestamp || message.created_at;
                    if (messageTimestamp && (!lastMessageTimestamp || new Date(messageTimestamp) > new Date(lastMessageTimestamp))) {
                        lastMessageTimestamp = messageTimestamp;
                    }
                }
            });
        }
        if (!silent) markConversationAsRead();
        updateUnreadCounts();
    })
    .catch(error => {
        console.error('Error fetching conversation:', error);
        if (!silent) {
            chatMessages.innerHTML = '<div class="empty-state"><i class="fas fa-exclamation-triangle"></i><p>Failed to load messages. Please try again.</p></div>';
            showError('Failed to load messages. Please refresh the page.');
        }
    });
}

            // Mark conversation as read
            function markConversationAsRead() {
                if (!selectedHotelId || !selectedTravelerId) return;
                fetch(`${ROOT}/Hmessages/api_markAsRead`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        hotel_id: selectedHotelId,
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
                if (!selectedHotelId) return;
                fetch(`${ROOT}/Hmessages/api_getUnreadCounts/${selectedHotelId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
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
            function loadChat(hotel_Id, traveler_Id, travelerName, contactElement) {
                selectedHotelId = hotel_Id;
                selectedTravelerId = traveler_Id;
                selectedTravelerName = travelerName;
                lastMessageTimestamp = null;
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
                if (pollingInterval) clearInterval(pollingInterval);
                if (!selectedHotelId || !selectedTravelerId) return;
                pollingInterval = setInterval(() => {
                    fetchConversation(true);
                }, 3000);
            }

            // Event listeners
            document.querySelectorAll('.contact').forEach(contact => {
                contact.addEventListener('click', () => {
                    const hotelId = contact.dataset.hotelId;
                    const travelerId = contact.dataset.travelerId;
                    const travelerName = contact.dataset.travelerName;
                    loadChat(hotelId, travelerId, travelerName, contact);
                });
            });

            messageInput.addEventListener('input', () => {
                sendButton.disabled = !messageInput.value.trim();
                errorMessage.style.display = 'none';
            });

            messageInput.addEventListener('keypress', e => {
                if (e.key === 'Enter' && !sendButton.disabled) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            sendButton.addEventListener('click', sendMessage);

            if ('hotel_id' in window.sessionStorage) {
                updateUnreadCounts();
            }

            document.addEventListener('visibilitychange', () => {
                if (document.visibilityState === 'visible' && selectedHotelId && selectedTravelerId) {
                    startPolling();
                } else if (pollingInterval) {
                    clearInterval(pollingInterval);
                }
            });

            window.addEventListener('beforeunload', () => {
                if (pollingInterval) clearInterval(pollingInterval);
            });
        });
    </script>
</body>
</html>