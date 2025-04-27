<?php
// $title defined for page title
$title = "EO - Approved Events";
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&libraries=places"></script>

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
            background-color: #D4EDDA;
            color: #155724;
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

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
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
            max-width: 1000px;
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

        /* Participants Table Styles */
        .participants-section {
            margin-top: 1.5rem;
            border-top: 1px solid #e9ecef;
            padding-top: 1rem;
        }

        .participants-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .participants-table th,
        .participants-table td {
            padding: 0.8rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .participants-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        .participants-table tr:hover {
            background-color: #f8f9fa;
        }

        .participant-details {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-top: 1rem;
        }

        .participant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .participant-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #002D40;
            margin: 0;
        }

        .participant-count {
            background-color: #007bff;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .participant-stats {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            min-width: 180px;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: #002D40;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .participant-filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-input {
            flex: 1;
            min-width: 200px;
            padding: 0.6rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95rem;
        }

        .filter-input:focus {
            outline: none;
            border-color: #002D40;
            box-shadow: 0 0 0 3px rgba(0, 45, 64, 0.15);
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
        input[type="search"],
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

        /* tabs for participant data */
        .tabs {
            display: flex;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e9ecef;
        }

        .tab {
            padding: 0.8rem 1.5rem;
            cursor: pointer;
            font-weight: 500;
            color: #495057;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }

        .tab:hover {
            color: #002D40;
        }

        .tab.active {
            color: #002D40;
            border-bottom-color: #002D40;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Export button */
        .export-btn {
            padding: 0.5rem 1rem;
            margin-left: auto;
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

            .participant-stats {
                flex-direction: column;
                gap: 1rem;
            }

            .stat-card {
                width: 100%;
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

            .tabs {
                flex-wrap: wrap;
            }

            .tab {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <?php
    // var_dump($data);
    // exit();
    ?>
    <div class="content-wrapper">
        <!-- Approved Events Section -->
        <div class="events-container approved">
            <div class="events-header">
                <h2><i class="fas fa-check-circle"></i> Approved Events</h2>
                <p>Your events that have been approved by admin</p>
            </div>

            <div class="events-list">
                <?php if (isset($data['approvedEvents']) && !empty($data['approvedEvents'])): ?>
                    <?php
                    $totalApprovedEvents = count($data['approvedEvents']);
                    $index = 0;
                    while ($index < $totalApprovedEvents):
                        $event = $data['approvedEvents'][$index];
                        ?>
                        <div class="event-card" id="event-<?= $event->event_Id ?>">
                            <div class="event-header">
                                <h3 class="event-title"><?= $event->eventName ?></h3>
                                <span class="event-status">Approved</span>
                            </div>

                            <div class="event-image">
                                <img src="<?= IMAGES ?>/events/eventWebBannerPics/<?= $event->eventWebBannerPath ?>"
                                    alt="<?= $event->eventName ?>">
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
                            if (isset($data['eventTicketTypes'][$index]) && !empty($data['eventTicketTypes'][$index])): ?>
                                <?= renderTicketTypes($data['eventTicketTypes'][$index]) ?>
                            <?php endif; ?>

                            <div class="event-actions">
                                <button class="btn btn-info"
                                    onclick="viewParticipants(<?= $event->event_Id ?>, '<?= addslashes($event->eventName) ?>', <?= $index ?>)">
                                    <i class="fas fa-users"></i> View Participants
                                </button>
                                <button class="btn btn-danger"
                                    onclick="openDeleteModal(<?= $event->event_Id ?>, '<?= addslashes($event->eventName) ?>')">
                                    <i class="fas fa-trash"></i> Cancel Event
                                </button>
                            </div>
                        </div>
                        <?php $index++; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-check fa-3x"></i>
                        <h3>No approved events</h3>
                        <p>Events will appear here once they are approved by admin</p>
                        <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
                            <!-- <button class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>Create New Event
                            </button> -->
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Cancel event Confirmation Modal -->
    <div id="delete-confirm-modal" class="modal">
        <div class="modal-content delete-modal">
            <span class="close-button" onclick="closeModals()">&times;</span>
            <h2>Confirm Event Cancellation</h2>
            <p style="text-align: left;">Are you sure you want to cancel <strong id="delete-event-name"></strong>?</p>
            <p style="text-align: left;">This action cannot be undone. Please provide a reason for cancellation.</p>

            <form method="post" action="<?= ROOT ?>/eventorganizer/ViewApprovedEvents/cancel_event"
                id="cancellation-form">
                <input type="hidden" id="delete-event-id" name="id" value="">

                <div class="form-group">
                    <label for="cancellation_reason" style="text-align: left;">Reason for Cancellation:</label>
                    <textarea id="cancellation_reason" name="cancellation_reason"
                        placeholder="Please explain why you need to cancel this event..." 
                        style="resize: none;"
                        required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-danger" id="submit-cancel-btn">Submit Cancellation
                        Request</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModals()">Back</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Participants View Modal -->
    <div id="participants-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModals()">&times;</span>
            <h2 id="participants-event-title">Participants for Event</h2>

            <div class="participant-details">
                <div class="participant-header">
                    <h3 class="participant-title">Registration Details</h3>
                    <span class="participant-count" id="participant-count">0 Purchasers</span>
                </div>

                <div class="participant-stats">
                    <div class="stat-card">
                        <div class="stat-value" id="total-participants">0</div>
                        <div class="stat-label">Total Participants</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="total-tickets-sold">0</div>
                        <div class="stat-label">Tickets Sold</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value" id="total-revenue">Rs. 0</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                </div>

                <div class="participant-filters">
                    <input type="search" id="participant-search" class="filter-input"
                        placeholder="Search participants...">
                    <button class="btn btn-secondary export-btn" id="export-csv">
                        <i class="fas fa-download"></i> Export CSV
                    </button>
                </div>

                <div class="tabs">
                    <div class="tab active" data-tab="all-participants">All Participants</div>
                    <div class="tab" data-tab="ticket-breakdown">Ticket Breakdown</div>
                </div>

                <div class="tab-content active" id="all-participants">
                    <table class="participants-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Ticket Type</th>
                                <th>Tickets</th>
                                <th>Purchase Date</th>
                            </tr>
                        </thead>
                        <tbody id="participants-list">
                            <!-- Participant data will be loaded here -->
                        </tbody>
                    </table>
                </div>

                <div class="tab-content" id="ticket-breakdown">
                    <table class="participants-table">
                        <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Price</th>
                                <th>Sold</th>
                                <th>Available</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody id="ticket-breakdown-list">
                            <!-- Ticket breakdown will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Popup -->
    <div id="notification-popup" class="notification-popup">
        <div class="notification-content">
            <div class="notification-icon"></div>
            <p id="notification-message"></p>
            <span class="notification-close" onclick="closeNotification()">&times;</span>
        </div>
    </div>

    <script>
        // Global variables
        let eventData = <?= json_encode($data['approvedEvents'] ?? []) ?>;
        let ticketTypesData = <?= json_encode($data['eventTicketTypes'] ?? []) ?>;

        // Function to close all modals
        function closeModals() {
            document.getElementById('delete-confirm-modal').style.display = 'none';
            document.getElementById('participants-modal').style.display = 'none';
        }

        // Function to open cancel event cancellation confirm modal
        function openDeleteModal(eventId, eventName) {
            const modal = document.getElementById('delete-confirm-modal');
            document.getElementById('delete-event-id').value = eventId;
            document.getElementById('delete-event-name').textContent = eventName;

            // Reset the form and any previous validation messages
            document.getElementById('cancellation-form').reset();
            document.getElementById('cancellation_reason').classList.remove('error-input');

            modal.style.display = 'block';
        }

        // Add form validation
        document.getElementById('cancellation-form').addEventListener('submit', function (e) {
            const reasonField = document.getElementById('cancellation_reason');
            if (!reasonField.value.trim()) {
                e.preventDefault();
                reasonField.classList.add('error-input');
                reasonField.setAttribute('placeholder', 'Reason is required - please explain why you are cancelling');
                reasonField.focus();

                // Show inline validation message
                if (!document.getElementById('reason-error')) {
                    const errorMsg = document.createElement('div');
                    errorMsg.id = 'reason-error';
                    errorMsg.className = 'error-message';
                    errorMsg.textContent = 'Please provide a detailed reason for cancellation';
                    errorMsg.style.color = '#dc3545';
                    errorMsg.style.fontSize = '0.85rem';
                    errorMsg.style.marginTop = '0.25rem';
                    reasonField.parentNode.appendChild(errorMsg);
                }
            }
        });

        // Clear validation styling on input
        document.getElementById('cancellation_reason').addEventListener('input', function () {
            this.classList.remove('error-input');
            const errorMsg = document.getElementById('reason-error');
            if (errorMsg) {
                errorMsg.remove();
            }
        });
        // Function to view participants
        function viewParticipants(eventId, eventName, index) {
            const modal = document.getElementById('participants-modal');
            document.getElementById('participants-event-title').textContent = `Participants for ${eventName}`;

            // Reset displays
            document.getElementById('total-participants').textContent = '0';
            document.getElementById('total-tickets-sold').textContent = '0';
            document.getElementById('total-revenue').textContent = 'Rs. 0';
            document.getElementById('participant-count').textContent = '0 Purchasers';

            document.getElementById('participants-list').innerHTML = '<tr><td colspan="6" style="text-align: center;">Loading participant data...</td></tr>';

            // Make AJAX request to get participants
            fetch('<?= ROOT ?>/eventorganizer/ViewApprovedEvents/getParticipants/' + eventId)
                .then(response => response.json())
                .then(data => {
                    updateParticipantsData(data);
                })
                .catch(error => {
                    console.error('Error fetching participants:', error);
                    document.getElementById('participants-list').innerHTML = '<tr><td colspan="6" style="text-align: center;">Error loading participant data.</td></tr>';
                });

            modal.style.display = 'block';
        }

        // Function to update participants data in the modal
        function updateParticipantsData(data) {
            const participants = data.participants || [];
            const ticketBreakdown = data.ticketBreakdown || [];
            let totalParticipants = participants.length;
            let totalTickets = 0;
            let totalRevenue = 0;

            // Update stats
            document.getElementById('total-participants').textContent = totalParticipants;
            document.getElementById('participant-count').textContent = `${totalParticipants} Purchasers`;

            // Calculate totals from ticket breakdown
            ticketBreakdown.forEach(ticket => {
                totalTickets += parseInt(ticket.soldCount);
                totalRevenue += parseFloat(ticket.revenue);
            });

            document.getElementById('total-tickets-sold').textContent = totalTickets;
            document.getElementById('total-revenue').textContent = `Rs. ${totalRevenue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

            // Update participants table
            const participantsList = document.getElementById('participants-list');
            if (participants.length > 0) {
                let html = '';
                participants.forEach(participant => {
                    html += `<tr>
            <td>${participant.fullName}</td>
            <td>${participant.email}</td>
            <td>${participant.mobileNum}</td>
            <td>${participant.ticketType || 'Standard'}</td>
            <td>${participant.quantity || 1}</td>
            <td>${formatDate(participant.created_at)}</td>
        </tr>`;
                });
                participantsList.innerHTML = html;
            } else {
                participantsList.innerHTML = '<tr><td colspan="6" style="text-align: center;">No participants registered yet.</td></tr>';
            }

            // Update ticket breakdown table
            const ticketBreakdownList = document.getElementById('ticket-breakdown-list');
            if (ticketBreakdown.length > 0) {
                let html = '';
                ticketBreakdown.forEach(ticket => {
                    html += `<tr>
            <td>${ticket.ticketTypeName}</td>
            <td>Rs. ${parseFloat(ticket.pricePerTicket).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
            <td>${ticket.totalTickets - ticket.availableTickets}</td>
            <td>${ticket.availableTickets}</td>
            <td>Rs. ${parseFloat((ticket.totalTickets - ticket.availableTickets) * ticket.pricePerTicket).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
        </tr>`;
                });
                ticketBreakdownList.innerHTML = html;
            } else {
                ticketBreakdownList.innerHTML = '<tr><td colspan="5" style="text-align: center;">No ticket data available.</td></tr>';
            }
        }

        // Format date helper function
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            return new Date(dateString).toLocaleDateString(undefined, options);
        }

        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove active class from all tabs and content
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Show corresponding content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Search functionality
        document.getElementById('participant-search').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#participants-list tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Export to CSV functionality
        document.getElementById('export-csv').addEventListener('click', function () {
            // This would typically call a backend endpoint to generate CSV
            // For now, we'll just show a notification
            showNotification('Export functionality will be implemented soon.', 'success');
        });

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.getElementById('notification-popup');
            notification.className = 'notification-popup notification-' + type;
            document.getElementById('notification-message').textContent = message;
            notification.style.display = 'block';

            // Auto-hide after 5 seconds
            setTimeout(closeNotification, 5000);
        }

        // Close notification
        function closeNotification() {
            const notification = document.getElementById('notification-popup');
            notification.style.animation = 'slideOut 0.3s forwards';
            setTimeout(() => {
                notification.style.display = 'none';
                notification.style.animation = '';
            }, 300);
        }

        window.onload = function () {
            // Show notification if there's a message from the server
            <?php if (isset($_SESSION['message'])): ?>
                showNotification('<?= $_SESSION['message'] ?>', '<?= $_SESSION['message_type'] ?>');
                <?php unset($_SESSION['message']);
                unset($_SESSION['message_type']); ?>
            <?php endif; ?>
        };

        // Close modal when clicking outside of it
        window.onclick = function (event) {
            const modals = document.getElementsByClassName('modal');
            for (let i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>