<?php
    $pendingEvents = $data['pendingEvents'];
    $approvedEvents = $data['approvedEvents'];
    $completedEvents = $data['completedEvents'];
    $eventOrganizers = $data['eventOrganizers'];
    $eventTicketTypes = $data['eventTicketTypes'];
    $rejectedEvents = $data['rejectedEvents'];    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/events.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>
        <div class="main-content">
            <h1>Events Management</h1>

            <!-- Main Tab Navigation -->
            <div class="tab-navigation">
                <button class="tab-button active" onclick="switchTab('pending')">
                    <i class="fas fa-hourglass-half"></i> Pending Events
                </button>
                <button class="tab-button" onclick="switchTab('approved')">
                    <i class="fas fa-check-circle"></i> Approved Events
                </button>
                <button class="tab-button" onclick="switchTab('rejected')">
                    <i class="fas fa-times-circle"></i> Rejected Events
                </button>
            </div>
            <?php
                if (isset($_SESSION['notification'])) {
                    echo '<div class="notification success">' . $_SESSION['notification'] . '</div>';
                    unset($_SESSION['notification']);
                }
                if (isset($_SESSION['error'])) {
                    echo '<div class="notification error">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
            ?>

            <!-- Pending Events Section -->
            <div id="pending-tab" class="tab-content">
                <div class="events-container">
                    <div class="events-header">
                        <h2><i class="fas fa-hourglass-half"></i> Pending Approval</h2>
                        <p>Events waiting for admin approval</p>
                    </div>

                    <?php if(empty($pendingEvents)): ?>
                    <div class="empty-pending-state">
                        <i class="fas fa-hourglass-end icon"></i>
                        <p>There are no pending events awaiting approval</p>
                        <p class="hint">All submitted events have been processed</p>
                    </div>
                    <?php else: ?>
                    <div class="events-grid">
                        <?php foreach($pendingEvents as $pendingEvent): ?>
                        <?php
                            $eventOrganizerData = [];
                            foreach ($eventOrganizers as $eventOrganizer) {
                                if($eventOrganizer->organizer_Id == $pendingEvent->organizer_Id){
                                    $eventOrganizerData = $eventOrganizer;
                                }
                            }
                        ?>
                        <div class="event-card">
                            <img src="<?= ROOT ?>/assets/images/events/eventWebBannerPics/<?= $pendingEvent->eventWebBannerPath ?>"
                                alt="Event image" class="event-image">
                            <div class="event-content">
                                <h3 class="event-title"><?= $pendingEvent->eventName ?></h3>
                                <div class="event-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= $pendingEvent->eventDate ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?= $pendingEvent->eventLocation ?></span>
                                    </div>
                                </div>
                                <span class="event-status status-pending">Pending Approval</span>
                                <div class="event-actions">
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="viewEventDetails(<?= $pendingEvent->event_Id ?>, 'pending')">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveEventFromModal(<?= $pendingEvent->event_Id ?>)">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Approved Events Section -->
            <div id="approved-tab" class="tab-content" style="display: none;">
                <!-- Sub Tab Navigation -->
                <div class="sub-tab-navigation">
                    <button class="sub-tab-button active" onclick="switchSubTab('upcoming')">
                        <i class="fas fa-calendar-alt"></i> Upcoming Events
                    </button>
                    <button class="sub-tab-button" onclick="switchSubTab('completed')">
                        <i class="fas fa-check-circle"></i> Completed Events
                    </button>
                </div>

                <!-- Upcoming Events Sub Tab -->
                <div id="upcoming-subtab" class="sub-tab-content">
                    <?php if(empty($approvedEvents)): ?>
                    <div class="no-events-message">
                        <i class="fas fa-calendar-times icon"></i>
                        <p>There are no upcoming events scheduled</p>
                    </div>
                    <?php else: ?>
                    <div class="events-grid">
                        <?php foreach($approvedEvents as $approvedEvent): ?>
                        <?php
                            $eventOrganizerData = [];
                            foreach ($eventOrganizers as $eventOrganizer) {
                                if($eventOrganizer->organizer_Id == $approvedEvent->organizer_Id){
                                    $eventOrganizerData = $eventOrganizer;
                                }
                            }
                        ?>
                        <div class="event-card">
                            <img src="<?= ROOT ?>/assets/images/events/eventWebBannerPics/<?= $approvedEvent->eventWebBannerPath ?>"
                                alt="Event image" class="event-image">
                            <div class="event-content">
                                <h3 class="event-title"><?= $approvedEvent->eventName ?></h3>
                                <div class="event-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= $approvedEvent->eventDate ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?= $approvedEvent->eventLocation ?></span>
                                    </div>
                                </div>
                                <span class="event-status status-approved">Approved</span>
                                <div class="event-actions">
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="viewEventDetails(<?= $approvedEvent->event_Id ?>, 'approved')">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn btn-secondary btn-sm"
                                        onclick="viewEventSales(<?= $approvedEvent->event_Id ?>)">
                                        <i class="fas fa-chart-line"></i> Sales
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Completed Events Sub Tab -->
                <div id="completed-subtab" class="sub-tab-content" style="display: none;">
                    <?php if(empty($completedEvents)): ?>
                    <div class="empty-completed-state">
                        <i class="fas fa-clipboard-check icon"></i>
                        <p>No completed events in records</p>
                        <p class="hint">Events will appear here after they've ended</p>
                    </div>
                    <?php else: ?>
                    <div class="events-grid">
                        <?php foreach($completedEvents as $completedEvent): ?>
                        <?php
                            $eventOrganizerData = [];
                            foreach ($eventOrganizers as $eventOrganizer) {
                                if($eventOrganizer->organizer_Id == $completedEvent->organizer_Id){
                                    $eventOrganizerData = $eventOrganizer;
                                }
                            }
                        ?>
                        <div class="event-card">
                            <img src="<?= ROOT ?>/assets/images/events/eventWebBannerPics/<?= $completedEvent->eventWebBannerPath ?>"
                                alt="Event image" class="event-image">
                            <div class="event-content">
                                <h3 class="event-title"><?= $completedEvent->eventName ?></h3>
                                <div class="event-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= $completedEvent->eventDate ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?= $completedEvent->eventLocation ?></span>
                                    </div>
                                </div>
                                <span class="event-status status-completed">Completed</span>
                                <div class="event-actions">
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="viewEventDetails(<?= $completedEvent->event_Id ?>, 'completed')">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                    <button class="btn btn-secondary btn-sm"
                                        onclick="viewEventSales(<?= $completedEvent->event_Id ?>)">
                                        <i class="fas fa-chart-line"></i> Sales
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Rejected Events Section -->
            <div id="rejected-tab" class="tab-content" style="display: none;">
                <div class="events-container">
                    <div class="events-header">
                        <h2><i class="fas fa-times-circle"></i> Rejected Events</h2>
                        <p>Events that were rejected by admin</p>
                    </div>

                    <?php if(empty($rejectedEvents)): ?>
                    <div class="empty-rejected-state">
                        <i class="fas fa-ban icon"></i>
                        <p>No events have been rejected</p>
                        <p class="hint">Rejected events will appear here</p>
                    </div>
                    <?php else: ?>
                    <div class="events-grid">
                        <?php foreach($rejectedEvents as $rejectedEvent): ?>
                        <?php
                            $eventOrganizerData = [];
                            foreach ($eventOrganizers as $eventOrganizer) {
                                if($eventOrganizer->organizer_Id == $rejectedEvent->organizer_Id){
                                    $eventOrganizerData = $eventOrganizer;
                                }
                            }
                        ?>
                        <div class="event-card">
                            <img src="<?= ROOT ?>/assets/images/events/eventWebBannerPics/<?= $rejectedEvent->eventWebBannerPath ?>"
                                alt="Event image" class="event-image">
                            <div class="event-content">
                                <h3 class="event-title"><?= $rejectedEvent->eventName ?></h3>
                                <div class="event-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= $rejectedEvent->eventDate ?></span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?= $rejectedEvent->eventLocation ?></span>
                                    </div>
                                </div>
                                <span class="event-status status-rejected">Rejected</span>
                                <div class="event-actions">
                                    <button class="btn btn-outline-secondary btn-sm"
                                        onclick="viewEventDetails(<?= $rejectedEvent->event_Id ?>, 'rejected')">
                                        <i class="fas fa-eye"></i> View
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div id="event-details-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('event-details-modal')">&times;</span>
            <div class="event-details-header">
                <h2 class="event-details-title" id="modal-event-title">Event Title</h2>
                <span class="event-status" id="modal-event-status">Pending Approval</span>
            </div>

            <img id="modal-event-image" src="" alt="Event Image" class="event-details-image">

            <div class="event-details-content">
                <div>
                    <div class="event-details-section">
                        <h3 class="section-title">Event Details</h3>
                        <div class="details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Event Type</span>
                                <span class="detail-value" id="modal-event-type"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Date</span>
                                <span class="detail-value" id="modal-event-date"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Time</span>
                                <span class="detail-value" id="modal-event-time"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Location</span>
                                <span class="detail-value" id="modal-event-location"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Organizer</span>
                                <span class="detail-value" id="modal-event-organizer"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Contact Email</span>
                                <span class="detail-value" id="modal-event-email"></span>
                            </div>
                            <div id="rejection-reason-container" class="detail-item" style="display: none;">
                                <span class="detail-label">Rejection Reason</span>
                                <span class="detail-value" id="modal-rejection-reason"></span>
                            </div>
                        </div>
                    </div>

                    <div class="event-details-section">
                        <h3 class="section-title">About Event</h3>
                        <p id="modal-event-description"></p>
                    </div>
                </div>

                <div>
                    <div class="event-details-section">
                        <h3 class="section-title">Ticket Types</h3>
                        <div class="ticket-types-list" id="modal-ticket-types"></div>
                    </div>

                    <div id="pending-actions" class="event-details-section" style="display: none;">
                        <h3 class="section-title">Admin Actions</h3>
                        <div class="event-actions">
                            <button class="btn btn-success" onclick="approveEventFromModal()">
                                <i class="fas fa-check"></i> Approve Event
                            </button>
                            <button class="btn btn-secondary" onclick="requestChanges()">
                                <i class="fas fa-edit"></i> Reject
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Event Modal -->
    <div id="reject-event-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal('reject-event-modal')">&times;</span>
            <h2>Reject Event</h2>
            <form id="reject-event-form" method="post" action="<?= ROOT ?>/admin/C_events/rejectEvent">
                <input type="hidden" name="event_id" id="reject-event-id">
                <div class="form-group">
                    <label for="rejection-reason">Reason for rejection:</label>
                    <textarea id="rejection-reason" name="rejection_reason" class="form-control" required></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('reject-event-modal')">Cancel</button>
                    <button type="submit" class="btn btn-danger">Submit Rejection</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Popup -->
    <div id="notification-popup" class="notification-popup notification-success">
        <div class="notification-content">
            <span class="notification-icon"></span>
            <p id="notification-message">Event approved successfully!</p>
            <span class="notification-close" onclick="hideNotification()">&times;</span>
        </div>
    </div>

    <script>
    // Convert PHP data to JavaScript
    const phpEventData =
        <?= json_encode(array_merge($pendingEvents, $approvedEvents, $completedEvents, $rejectedEvents)) ?>;
    const phpOrganizerData = <?= json_encode($eventOrganizers) ?>;
    const phpEventTicketTypes = <?= json_encode($eventTicketTypes) ?>;

    // Format date to display
    function formatDisplayDate(dateString) {
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    // Format time to display
    function formatDisplayTime(timeString) {
        const [hours, minutes] = timeString.split(':');
        const hour = parseInt(hours);
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 || 12;
        return `${displayHour}:${minutes} ${ampm}`;
    }

    // Format currency
    function formatCurrency(amount) {
        return 'Rs. ' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    // Switch between main tabs
    function switchTab(tabName) {
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });
        document.querySelectorAll('.tab-content').forEach(content => {
            content.style.display = 'none';
        });

        document.querySelector(`.tab-button[onclick="switchTab('${tabName}')"]`).classList.add('active');
        document.getElementById(`${tabName}-tab`).style.display = 'block';

        // Reset sub-tabs when switching main tabs
        if (tabName === 'approved') {
            switchSubTab('upcoming');
        }
    }

    // Switch between sub-tabs
    function switchSubTab(subTabName) {
        document.querySelectorAll('.sub-tab-button').forEach(button => {
            button.classList.remove('active');
        });
        document.querySelectorAll('.sub-tab-content').forEach(content => {
            content.style.display = 'none';
        });

        document.querySelector(`.sub-tab-button[onclick="switchSubTab('${subTabName}')"]`).classList.add('active');
        document.getElementById(`${subTabName}-subtab`).style.display = 'block';
    }

    // View event details
    function viewEventDetails(eventId, status) {
        // Find the event in the PHP data
        let event = phpEventData.find(e => e.event_Id == eventId);
        // Filter ticket types for this specific event
        let ticketsForEvent = phpEventTicketTypes.filter(t => t.event_Id == eventId);

        if (!event) return;

        // Find the organizer for this event
        let organizer = phpOrganizerData.find(o => o.organizer_Id == event.organizer_Id);
        if (!organizer) organizer = {
            company_Name: "Unknown",
            company_Email: "Unknown"
        };

        // Populate the modal with event data
        document.getElementById('modal-event-title').textContent = event.eventName;
        document.getElementById('modal-event-image').src = "<?= ROOT ?>/assets/images/events/eventWebBannerPics/" +
            event.eventWebBannerPath;
        document.getElementById('modal-event-image').alt = event.eventName;
        document.getElementById('modal-event-type').textContent = event.eventType;
        document.getElementById('modal-event-date').textContent = formatDisplayDate(event.eventDate);
        document.getElementById('modal-event-time').textContent =
            `${formatDisplayTime(event.eventStartTime)} - ${formatDisplayTime(event.eventEndTime)}`;
        document.getElementById('modal-event-location').textContent = event.eventLocation;
        document.getElementById('modal-event-organizer').textContent = organizer.company_Name;
        document.getElementById('modal-event-email').textContent = organizer.company_Email;
        document.getElementById('modal-event-description').textContent = event.aboutEvent;

        // Set status with appropriate styling
        const statusElement = document.getElementById('modal-event-status');
        statusElement.textContent = event.eventStatus === 'pending' ? 'Pending Approval' :
            event.eventStatus === 'approved' ? 'Approved' :
            event.eventStatus === 'rejected' ? 'Rejected' : 'Completed';
        statusElement.className = 'event-status ' +
            (event.eventStatus === 'pending' ? 'status-pending' :
                event.eventStatus === 'approved' ? 'status-approved' :
                event.eventStatus === 'rejected' ? 'status-rejected' : 'status-completed');

        // Show/hide rejection reason
        const rejectionContainer = document.getElementById('rejection-reason-container');
        const rejectionReason = document.getElementById('modal-rejection-reason');
        if (event.eventStatus === 'rejected' && event.rejection_reason) {
            rejectionContainer.style.display = 'block';
            rejectionReason.textContent = event.rejection_reason;
        } else {
            rejectionContainer.style.display = 'none';
        }

        // Populate ticket types
        const ticketTypesContainer = document.getElementById('modal-ticket-types');
        ticketTypesContainer.innerHTML = '';

        if (ticketsForEvent.length === 0) {
            ticketTypesContainer.innerHTML =
                '<div class="no-tickets-message"><i class="fas fa-ticket-alt"></i> This event has no ticket types defined</div>';
        } else {
            ticketsForEvent.forEach(ticket => {
                const total = parseInt(ticket.totalTickets) || 0;
                const available = Math.min(parseInt(ticket.availableTickets) || 0, total);
                const sold = total - available;

                const ticketElement = document.createElement('div');
                ticketElement.className = 'ticket-type-card';
                ticketElement.innerHTML = `
                    <div class="ticket-type-header">
                        <span class="ticket-type-name">${ticket.ticketTypeName || 'Unnamed Ticket'}</span>
                        <span class="ticket-type-price">${formatCurrency(parseFloat(ticket.pricePerTicket) || 0)}</span>
                    </div>
                    <div class="ticket-type-meta">
                        <div class="meta-item">
                            <i class="fas fa-ticket-alt"></i>
                            <span title="Total tickets">Total tickets: ${total}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-check-circle"></i>
                            <span title="Tickets sold">Sold: ${sold}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span title="Tickets available">Available: ${available}</span>
                        </div>
                        ${available < (total * 0.2) ? '<span class="low-availability">Selling Fast!</span>' : ''}
                    </div>
                    ${ticket.ticketTypeDescription ? `<p class="ticket-type-description">${ticket.ticketTypeDescription}</p>` : ''}
                `;
                ticketTypesContainer.appendChild(ticketElement);
            });
        }

        // Show admin actions for pending events
        document.getElementById('pending-actions').style.display =
            event.eventStatus === 'pending' ? 'block' : 'none';

        // Store current event ID and status for actions
        document.getElementById('event-details-modal').dataset.eventId = eventId;
        document.getElementById('event-details-modal').dataset.eventStatus = event.eventStatus;

        // Open the modal
        document.getElementById('event-details-modal').style.display = 'block';
    }

    function approveEventFromModal(eventId = null) {
        const id = eventId || document.getElementById('event-details-modal')?.dataset.eventId;
        if (confirm("Are you sure you want to approve this event?")) {
            window.location.href = `<?= ROOT ?>/admin/C_events/approveEvent/${id}`;
        }
    }

    // Request changes to event
    function requestChanges() {
        const modal = document.getElementById('event-details-modal');
        const eventId = modal.dataset.eventId;

        // Set the event ID in the reject form
        document.getElementById('reject-event-id').value = eventId;

        // Clear any previous reason
        document.getElementById('rejection-reason').value = '';

        // Close the details modal and open the reject modal
        closeModal('event-details-modal');
        document.getElementById('reject-event-modal').style.display = 'block';
    }

    // Add form submission handler
    document.getElementById('reject-event-form').addEventListener('submit', function(e) {
        e.preventDefault();
        this.submit();
    });

    // Close modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Show notification
    function showNotification(message, type) {
        const popup = document.getElementById('notification-popup');
        const messageEl = document.getElementById('notification-message');

        // Set message and type
        messageEl.textContent = message;
        popup.className = `notification-popup notification-${type}`;

        // Show the notification
        popup.style.display = 'block';

        // Auto-hide after 5 seconds
        setTimeout(() => {
            hideNotification();
        }, 5000);
    }

    // Hide notification
    function hideNotification() {
        const popup = document.getElementById('notification-popup');
        popup.style.animation = 'slideOut 0.3s ease-out forwards';

        setTimeout(() => {
            popup.style.display = 'none';
            popup.style.animation = 'slideIn 0.3s ease-out';
        }, 300);
    }

    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('event-details-modal')) {
            closeModal('event-details-modal');
        }
        if (event.target === document.getElementById('reject-event-modal')) {
            closeModal('reject-event-modal');
        }
    });
    </script>
</body>

</html>