<?php
// show($data);
// exit();
$title = "EO - Pending Events";
include '../app/views/components/eonavbar.php';

// Helper function to format date
function formatDate($dateString)
{
    $date = new DateTime($dateString);
    return $date->format('l, F j, Y');
}

// Helper function to format time
function formatTime($timeString)
{
    $time = new DateTime($timeString);
    return $time->format('g:i A');
}

// Helper function to generate ticket type HTML
function renderTicketTypes($ticketTypes)
{
    $html = '<div class="ticket-types">';
    foreach ($ticketTypes as $ticket) {
        $html .= '<div class="ticket-type">';
        $html .= '<div class="ticket-name">' . $ticket->ticketTypeName . '</div>';
        $html .= '<div class="ticket-details">';
        $html .= '<span class="price">Rs. ' . number_format($ticket->pricePerTicket, 2) . '</span>';
        $html .= '<span class="available">' . $ticket->availableTickets . '/' . $ticket->totalTickets . ' available</span>';
        $html .= '</div>';
        $html .= '</div>';
    }
    $html .= '</div>';
    return $html;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eoevents.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title><?= $title ?></title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&libraries=places"></script>

    <style>
        /* Primary Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .content-wrapper {
            margin-left: 18%;
            /* Match the width of the left navbar */
            padding: 2rem;
        }

        /* Event Container Styles */
        .events-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 45, 64, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .events-header {
            background: linear-gradient(135deg, #002D40 0%, #004d6e 100%);
            color: white;
            padding: 1.5rem 2rem;
        }

        .events-header h2 {
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            color: white;
        }

        .events-header h2 i {
            margin-right: 12px;
        }

        .events-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }

        /* Empty State Styles */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }

        .empty-state i {
            color: #adb5bd;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            margin-bottom: 0.5rem;
            font-size: 1.4rem;
        }

        .empty-state p {
            margin-bottom: 1.5rem;
        }

        /* Event Card Styles */
        .events-list {
            padding: 1.5rem;
        }

        .event-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .event-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .event-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .event-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #002D40;
            margin: 0;
        }

        .event-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            background-color: #FFF3CD;
            color: #856404;
        }

        .event-image {
            margin-bottom: 1rem;
            border-radius: 8px;
            overflow: hidden;
        }

        .event-image img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            padding: 1.5rem;
        }

        .grid-event-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .grid-event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .event-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .grid-event-content {
            padding: 1rem;
        }

        .grid-event-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0 0 0.5rem;
            color: #002D40;
        }

        .event-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #555;
        }

        .meta-item i {
            margin-right: 8px;
            color: #002D40;
            width: 16px;
            text-align: center;
        }

        .event-description {
            margin-bottom: 1rem;
            color: #555;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .event-price {
            font-weight: 600;
            color: #007bff;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }

        .event-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
            margin-top: 1rem;
        }

        /* Ticket Types Styles */
        .ticket-types {
            margin: 1rem 0;
            border-top: 1px solid #e9ecef;
            padding-top: 1rem;
        }

        .ticket-type {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            margin-bottom: 0.5rem;
            background-color: #f8f9fa;
        }

        .ticket-name {
            font-weight: 500;
            color: #343a40;
        }

        .ticket-details {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .price {
            font-weight: 600;
            color: #007bff;
        }

        .available {
            color: #6c757d;
            font-size: 0.9rem;
        }

        /* Form Styles */
        .form-section {
            margin: 1.5rem 0;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .form-section h3 {
            margin-bottom: 1rem;
            color: #002D40;
            font-size: 1.2rem;
        }

        .ticket-form-group {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        /* Button Styles */
        .btn {
            display: flex;
            padding: 0.5rem 2rem;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .btn i {
          
            margin-right: 0.125rem;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #002D40;
            color: white;
        }

        .btn-primary:hover {
            background-color: #004d6e;
        }

        .btn-secondary {
            background-color: #e9ecef;
            color: #495057;
        }

        .btn-secondary:hover {
            background-color: #dde2e6;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 2rem;
            width: 60%;
            max-width: 700px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            animation: modalopen 0.3s;
            max-height: 80vh;
            overflow-y: auto;
        }

        .delete-modal {
            width: 40%;
            max-width: 500px;
            text-align: center;
        }

        @keyframes modalopen {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .close-button {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            color: #aaa;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-button:hover {
            color: #333;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea {
            width: 100%;
            resize: none;
            padding: 0.8rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #002D40;
            box-shadow: 0 0 0 3px rgba(0, 45, 64, 0.15);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        /* Notification Popup Styles */
    .notification-popup {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 300px;
        max-width: 450px;
        z-index: 2000;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .notification-content {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-radius: 8px;
        background-color: white;
    }

    .notification-icon {
        font-size: 20px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .notification-success .notification-content {
        border-left: 4px solid #28a745;
    }

    .notification-error .notification-content {
        border-left: 4px solid #dc3545;
    }

    .notification-success .notification-icon:before {
        content: '✓';
        color: #28a745;
    }

    .notification-error .notification-icon:before {
        content: '✕';
        color: #dc3545;
    }

    #notification-message {
        flex-grow: 1;
        margin: 0;
        font-size: 0.95rem;
        color: #333;
    }

    .notification-close {
        font-size: 20px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
        margin-left: 15px;
        transition: color 0.2s;
    }

    .notification-close:hover {
        color: #333;
    }


        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .content-wrapper {
                margin-left: 0;
                padding: 1rem;
            }

            .modal-content {
                width: 80%;
            }
        }

        @media (max-width: 768px) {
            .events-grid {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            }

            .modal-content {
                width: 90%;
                padding: 1.5rem;
                margin: 10% auto;
            }

            .delete-modal {
                width: 70%;
            }

            .event-header {
                flex-direction: column;
                gap: 0.5rem;
            }

            .event-status {
                align-self: flex-start;
            }
        }

        @media (max-width: 576px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .event-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <!-- Pending Events Section -->
        <div class="events-container pending">
            <div class="events-header">
                <h2><i class="fas fa-hourglass-half"></i> Pending Events</h2>
                <p>Events awaiting admin approval</p>
            </div>

            <div class="events-list">
                <?php if (isset($data['pendingEvents']) && !empty($data['pendingEvents'])): ?>
                    <?php
                    $totalPendingEvents = count($data['pendingEvents']);
                    $index = 0;
                    while ($index < $totalPendingEvents):
                        $event = $data['pendingEvents'][$index];
                        ?>
                        <div class="event-card" id="event-<?= $event->event_Id ?>">
                            <div class="event-header">
                                <h3 class="event-title"><?= $event->eventName ?></h3>
                                <span class="event-status">Pending Approval</span>
                            </div>

                            <div class="event-image">
                                <img src="<?= IMAGES ?>/events/eventWebBannerPics/<?= $event->eventWebBannerPath ?>" alt="<?= $event->eventName ?>">
                            </div>

                            <div class="event-description">
                                <?= $event->aboutEvent ?>
                            </div>

                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span><?= formatDate($event->eventDate) ?></span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span><?= formatTime($event->eventStartTime) ?> -
                                        <?= formatTime($event->eventEndTime) ?></span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= $event->eventLocation ?></span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-tag"></i>
                                    <span><?= $event->eventType ?></span>
                                </div>
                            </div>

                            <?php
                            $eventId = $event->event_Id;
                            if (isset($data['eventTicketTypes'][$index]) && !empty($data['eventTicketTypes'][$index])): ?>
                                <?= renderTicketTypes($data['eventTicketTypes'][$index]) ?>
                            <?php endif; ?>

                            <div class="event-actions">
                                <button class="btn btn-primary" onclick="openEditModal(<?= $event->event_Id ?>, <?= $index ?>)">
                                    <i class="fas fa-edit"></i> Edit Event
                                </button>
                                <button class="btn btn-danger"
                                    onclick="openDeleteModal(<?= $event->event_Id ?>, '<?= addslashes($event->eventName) ?>')">
                                    <i class="fas fa-trash"></i> Delete Event
                                </button>
                            </div>
                        </div>
                        <?php $index++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-times fa-3x"></i>
                        <h3>No pending events</h3>
                        <p>Your events will appear here once submitted for approval</p>
                            <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent" >
                                <button class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>Create New Event
                                </button>
                            </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- Event Edit Modal -->
    <?php if (isset($data['pendingEvents']) && !empty($data['pendingEvents'])): ?>
        <div id="event-edit-modal" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModals()">&times;</span>
                <h2>Edit Event</h2>
                <form id="edit-event-form" method="post" action="<?= ROOT ?>/eventorganizer/ViewPendingEvents/updateEvent">
                    <input type="hidden" id="modal-event-id" name="id" value="">

                    <div class="form-group">
                        <label for="modal-event-name">Event Name</label>
                        <input type="text" id="modal-event-name" name="eventName" required value="">
                    </div>

                    <div class="form-group">
                        <label for="modal-about-event">About Event</label>
                        <textarea id="modal-about-event" name="aboutEvent" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="modal-event-type">Event Type</label>
                        <input type="text" id="modal-event-type" name="eventType" required value="">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="modal-event-date">Date</label>
                            <input type="date" id="modal-event-date" name="eventDate" required value="">
                        </div>

                        <div class="form-group">
                            <label for="modal-start-time">Start Time</label>
                            <input type="time" id="modal-start-time" name="eventStartTime" required value="">
                        </div>

                        <div class="form-group">
                            <label for="modal-end-time">End Time</label>
                            <input type="time" id="modal-end-time" name="eventEndTime" required value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="modal-event-location">Location</label>
                        <input type="text" id="modal-event-location" name="eventLocation" required value="">
                    </div>

                    <div class="form-section" id="ticket-types-container">
                        <h3>Ticket Types</h3>
                        <!-- Ticket types will be dynamically added here -->
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModals()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="delete-confirm-modal" class="modal">
            <div class="modal-content delete-modal">
                <span class="close-button" onclick="closeModals()">&times;</span>
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete <strong id="delete-event-name"></strong>?</p>
                <p>This action cannot be undone.</p>
                <form method="post" action="<?= ROOT ?>/eventorganizer/ViewPendingEvents/delete_event">
                    <input type="hidden" id="delete-event-id" name="id" value="">
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Delete Event</button>
                        <button type="button" class="btn btn-secondary" onclick="closeModals()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div id="notification-popup" class="notification-popup">
        <div class="notification-content">
            <span class="notification-icon"></span>
            <p id="notification-message"></p>
            <span class="notification-close">&times;</span>
        </div>
    </div>

    <script>
        // Store events and ticket types data for modal use
        const pendingEvents = <?= json_encode($data['pendingEvents'] ?? []) ?>;
        const eventTicketTypes = <?= json_encode($data['eventTicketTypes'] ?? []) ?>;

        // Function to open the edit modal with event data
        function openEditModal(eventId, index) {
            const event = pendingEvents[index];
            if (!event) return;

            // Set event data in the modal form
            document.getElementById('modal-event-id').value = event.event_Id;
            document.getElementById('modal-event-name').value = event.eventName;
            document.getElementById('modal-about-event').value = event.aboutEvent;
            document.getElementById('modal-event-type').value = event.eventType;
            document.getElementById('modal-event-date').value = event.eventDate;
            document.getElementById('modal-start-time').value = event.eventStartTime.substring(0, 5);
            document.getElementById('modal-end-time').value = event.eventEndTime.substring(0, 5);
            document.getElementById('modal-event-location').value = event.eventLocation;

            // Generate ticket type forms
            const ticketTypesContainer = document.getElementById('ticket-types-container');
            ticketTypesContainer.innerHTML = '<h3>Ticket Types</h3>';

            if (eventTicketTypes[index] && eventTicketTypes[index].length > 0) {
                const tickets = eventTicketTypes[index];

                tickets.forEach((ticket, i) => {
                    const ticketFormGroup = document.createElement('div');
                    ticketFormGroup.className = 'ticket-form-group';
                    ticketFormGroup.innerHTML = `
                    <input type="hidden" name="ticketIds[]" value="${ticket.eventTicketType_Id}">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ticket-name-${i}">Ticket Name</label>
                            <input type="text" id="ticket-name-${i}" name="ticketNames[]" required value="${ticket.ticketTypeName}">
                        </div>
                        
                        <div class="form-group">
                            <label for="ticket-price-${i}">Price (Rs)</label>
                            <input type="number" id="ticket-price-${i}" name="ticketPrices[]" step="0.01" min="0" required value="${ticket.pricePerTicket}">
                        </div>
                        
                        <div class="form-group">
                            <label for="ticket-quantity-${i}">Total Tickets</label>
                            <input type="number" id="ticket-quantity-${i}" name="ticketQuantities[]" min="1" required value="${ticket.totalTickets}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="ticket-desc-${i}">Description</label>
                        <textarea id="ticket-desc-${i}" name="ticketDescriptions[]" required>${ticket.ticketTypeDescription}</textarea>
                    </div>
                `;

                    ticketTypesContainer.appendChild(ticketFormGroup);
                });
            }

            // Show the modal
            document.getElementById('event-edit-modal').style.display = 'block';
        }

        // Function to open the delete confirmation modal
        function openDeleteModal(eventId, eventName) {
            document.getElementById('delete-event-id').value = eventId;
            document.getElementById('delete-event-name').textContent = eventName;
            document.getElementById('delete-confirm-modal').style.display = 'block';
        }

        // Function to close all modals
        function closeModals() {
            document.getElementById('event-edit-modal').style.display = 'none';
            document.getElementById('delete-confirm-modal').style.display = 'none';
        }

        // Close modals when clicking outside
        window.addEventListener('click', function (event) {
            if (event.target === document.getElementById('event-edit-modal')) {
                closeModals();
            }
            if (event.target === document.getElementById('delete-confirm-modal')) {
                closeModals();
            }
        });
    </script>

    <!-- This is to initialize the Google map auto complete -->
    <script>
        function initAutocomplete() {
            var newLocationInput = document.getElementById('modal-event-location');

            // Restrict to Sri Lanka (country code 'LK')
            var options = {
                componentRestrictions: {
                    country: 'LK'
                }
            };

            // Create autocomplete objects and apply the restriction
            var autocomplete = new google.maps.places.Autocomplete(newLocationInput, options);
            
        }

        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>

<script>
    // Notification functions
    function showNotification(message, type) {
        const popup = document.getElementById('notification-popup');
        const messageEl = document.getElementById('notification-message');
        
        // Set message content
        messageEl.textContent = message;
        
        // Set notification type (success or error)
        popup.className = 'notification-popup notification-' + type;
        
        // Show the notification
        popup.style.display = 'block';
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification();
        }, 5000);
    }
    
    function hideNotification() {
        const popup = document.getElementById('notification-popup');
        popup.style.animation = 'slideOut 0.3s ease-out forwards';
        
        setTimeout(() => {
            popup.style.display = 'none';
            popup.style.animation = 'slideIn 0.3s ease-out';
        }, 300);
    }
    
    // Close button functionality
    document.addEventListener('DOMContentLoaded', function() {
        const closeBtn = document.querySelector('.notification-close');
        closeBtn.addEventListener('click', hideNotification);
    });

    // Check for session messages on page load
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['success'])): ?>
            showNotification('<?= htmlspecialchars($_SESSION['success']) ?>', 'success');
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            showNotification('<?= htmlspecialchars($_SESSION['error']) ?>', 'error');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    });
</script>

</body>

</html>