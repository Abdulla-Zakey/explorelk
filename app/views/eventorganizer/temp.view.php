<?php
// $title defined for page title
$title = "EO - Completed Events";
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

// Helper function to format payment status with badge
function formatPaymentStatus($status)
{
    $statusClass = '';
    $icon = '';

    switch (strtolower($status)) {
        case 'paid':
            $statusClass = 'status-paid';
            $icon = 'fa-check-circle';
            break;
        case 'pending':
            $statusClass = 'status-pending';
            $icon = 'fa-clock';
            break;
        case 'processing':
            $statusClass = 'status-processing';
            $icon = 'fa-spinner fa-spin';
            break;
        default:
            $statusClass = 'status-pending';
            $icon = 'fa-question-circle';
    }

    return '<span class="payment-status ' . $statusClass . '"><i class="fas ' . $icon . '"></i> ' . ucfirst($status) . '</span>';
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
    <link rel = "stylesheet" href="<?= CSS ?>/Eventorganizer/temp.css">
    <title><?= $title ?></title>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&libraries=places"></script>
</head>

<body>
    <div class="content-wrapper">
        <!-- Completed Events Section -->
        <div class="events-container completed">
            <div class="events-header">
                <h2><i class="fas fa-calendar-check"></i> Completed Events</h2>
                <p>Your events that have been completed successfully</p>
            </div>

            <div class="events-list">
                <?php if (isset($data['completedEvents']) && !empty($data['completedEvents'])): ?>
                    <?php
                    $totalCompletedEvents = count($data['completedEvents']);
                    $index = 0;
                    while ($index < $totalCompletedEvents):
                        $event = $data['completedEvents'][$index];
                        ?>
                        <div class="event-card" id="event-<?= $event->event_Id ?>">
                            <div class="event-header">
                                <h3 class="event-title"><?= $event->eventName ?></h3>
                                <span class="event-status completed">Completed</span>
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
                                <button class="btn btn-primary"
                                    onclick="viewPaymentInfo(<?= $event->event_Id ?>, '<?= addslashes($event->eventName) ?>')">
                                    <i class="fas fa-money-bill-wave"></i> Payment Info
                                </button>
                            </div>
                        </div>
                        <?php
                        $index++;
                    endwhile;
                    ?>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-calendar-xmark fa-3x"></i>
                        <h3>No Completed Events Found</h3>
                        <p>When your events are completed, they will appear here.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Participants Modal -->
        <div id="participantsModal" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeParticipantsModal()">&times;</span>
                <h2 id="modal-event-title">Participants for Event</h2>

                <div class="participant-details">
                    <div class="participant-header">
                        <h3 class="participant-title">Financial Information</h3>
                        <span class="participant-count" id="participant-count">0 participants</span>
                    </div>

                    <div class="participant-stats">
                        <div class="stat-card">
                            <div class="stat-value" id="total-sales">Rs. 0</div>
                            <div class="stat-label">Total Sales</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value" id="commission-amount">Rs. 0</div>
                            <div class="stat-label">Commission (8%)</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value" id="receivable-amount">Rs. 0</div>
                            <div class="stat-label">Receivable Amount</div>
                        </div>
                    </div>

                    <div class="tabs">
                        <div class="tab active" onclick="openTab('participants-tab')">Participants</div>
                        <div class="tab" onclick="openTab('tickets-tab')">Ticket Breakdown</div>
                        <button class="btn btn-secondary export-btn">
                            <i class="fas fa-download"></i> Export Data
                        </button>
                    </div>

                    <div id="participants-tab" class="tab-content active">
                        <div class="participant-filters">
                            <input type="text" class="filter-input" id="participant-search"
                                placeholder="Search participants...">
                        </div>

                        <table class="participants-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Purchase Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="participants-list">
                                <!-- Participants will be populated here via JS -->
                            </tbody>
                        </table>
                    </div>

                    <div id="tickets-tab" class="tab-content">
                        <table class="participants-table">
                            <thead>
                                <tr>
                                    <th>Ticket Type</th>
                                    <th>Price</th>
                                    <th>Total Tickets</th>
                                    <th>Available</th>
                                    <th>Sold</th>
                                    <th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody id="tickets-breakdown">
                                <!-- Ticket breakdown will be populated here via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Info Modal -->
        <div id="paymentInfoModal" class="modal">
            <div class="modal-content payment-info-modal">
                <span class="close-button" onclick="closePaymentInfoModal()">&times;</span>
                <h2>Payment Information</h2>
                <p>Event: <strong id="payment-event-name"></strong></p>

                <div id="payment-status-container">
                    <div class="payment-info">
                        <div class="payment-info-title">Payment Status</div>
                        <div id="payment-status-badge"></div>
                    </div>

                    <div class="payment-info">
                        <div class="payment-info-title">Payment Details</div>
                        <div class="payment-info-details">
                            <p><strong>Total Sales:</strong> <span id="payment-total-sales">Rs. 0</span></p>
                            <p><strong>Commission (8%):</strong> <span id="payment-commission">Rs. 0</span></p>
                            <p><strong>Receivable Amount:</strong> <span id="payment-receivable">Rs. 0</span></p>
                        </div>
                    </div>

                    <div class="payment-info">
                        <div class="payment-info-title">Processing Information</div>
                        <div class="payment-info-details">
                            <p id="payment-processing-message">Payment processing can take 3-5 business days after
                                event completion.</p>
                            <p id="payment-date">Expected payment date: <span id="expected-payment-date">-</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notification Popup -->
        <div class="notification-popup" id="notification-popup">
            <div class="notification-content">
                <div class="notification-icon"></div>
                <p id="notification-message"></p>
                <span class="notification-close" onclick="closeNotification()">&times;</span>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let eventParticipantsData = {};

        // Function to open the participants modal
        function viewParticipants(eventId, eventName, eventIndex) {
            const modal = document.getElementById('participantsModal');
            document.getElementById('modal-event-title').textContent = 'Participants for ' + eventName;

            // Set the event index for reference
            modal.dataset.eventIndex = eventIndex;

            // Add loading indicator
            document.getElementById('participants-list').innerHTML = '<tr><td colspan="5" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading participants data...</td></tr>';
            document.getElementById('tickets-breakdown').innerHTML = '<tr><td colspan="6" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading ticket data...</td></tr>';

            // Show the modal immediately
            modal.style.display = 'block';

            // Check if we already have the data for this event
            if (eventParticipantsData[eventId]) {
                populateParticipantsData(eventParticipantsData[eventId]);
            } else {
                // Fetch participants data with debugging
                fetch(`<?= ROOT ?>/eventOrganizer/ViewCompletedEvents/getEventParticipants/${eventId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        console.log('Raw response received');
                        return response.json();
                    })
                    .then(data => {
                        console.log('Parsed data:', data);
                        
                        if (data.error) {
                            showNotification(data.error, 'error');
                            throw new Error(data.error);
                        }
                        
                        eventParticipantsData[eventId] = data;
                        populateParticipantsData(data);
                    })
                    .catch(error => {
                        console.error('Error fetching participants:', error);
                        document.getElementById('participants-list').innerHTML = '<tr><td colspan="5" class="text-center">Error loading data. Please try again.</td></tr>';
                        document.getElementById('tickets-breakdown').innerHTML = '<tr><td colspan="6" class="text-center">Error loading data. Please try again.</td></tr>';
                        showNotification('Failed to load participants data: ' + error.message, 'error');
                    });
            }
        }

        // Function to populate the participants data
        function populateParticipantsData(data) {
            const participantsList = document.getElementById('participants-list');
            const ticketsBreakdown = document.getElementById('tickets-breakdown');
            const participantCount = document.getElementById('participant-count');
            const totalSales = document.getElementById('total-sales');
            const commissionAmount = document.getElementById('commission-amount');
            const receivableAmount = document.getElementById('receivable-amount');

            // Clear previous data
            participantsList.innerHTML = '';
            ticketsBreakdown.innerHTML = '';

            // Check if data is valid
            if (!data) {
                showNotification('Invalid data received from server', 'error');
                return;
            }

            // Financial calculations
            let totalSalesValue = 0;
            if (data.participants && data.participants.length > 0) {
                // Update participant count
                participantCount.textContent = data.participants.length + ' participants';

                // Calculate total sales
                data.participants.forEach(participant => {
                    totalSalesValue += parseFloat(participant.amount || 0);
                });

                // Populate participants list
                data.participants.forEach(participant => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${participant.name || 'N/A'}</td>
                <td>${participant.email || 'N/A'}</td>
                <td>${participant.phone || 'N/A'}</td>
                <td>${participant.purchaseDate || 'N/A'}</td>
                <td>Rs. ${parseFloat(participant.amount || 0).toFixed(2)}</td>
            `;
                    participantsList.appendChild(row);
                });
            } else {
                participantCount.textContent = '0 participants';
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = '<td colspan="5" style="text-align: center;">No participants found</td>';
                participantsList.appendChild(emptyRow);
            }

            // Populate ticket breakdown
            if (data.ticketTypes && data.ticketTypes.length > 0) {
                data.ticketTypes.forEach(ticket => {
                    const soldTickets = parseInt(ticket.totalTickets || 0) - parseInt(ticket.availableTickets || 0);
                    const revenue = soldTickets * parseFloat(ticket.pricePerTicket || 0);

                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${ticket.ticketTypeName || 'N/A'}</td>
                <td>Rs. ${parseFloat(ticket.pricePerTicket || 0).toFixed(2)}</td>
                <td>${ticket.totalTickets || 0}</td>
                <td>${ticket.availableTickets || 0}</td>
                <td>${soldTickets}</td>
                <td>Rs. ${revenue.toFixed(2)}</td>
            `;
                    ticketsBreakdown.appendChild(row);
                });
            } else {
                const emptyRow = document.createElement('tr');
                emptyRow.innerHTML = '<td colspan="6" style="text-align: center;">No ticket data available</td>';
                ticketsBreakdown.appendChild(emptyRow);
            }

            // Update financial statistics
            if (data.financialSummary) {
                // Use the financial summary data directly from the controller
                totalSales.textContent = 'Rs. ' + parseFloat(data.financialSummary.totalSales).toFixed(2);
                commissionAmount.textContent = 'Rs. ' + parseFloat(data.financialSummary.commissionAmount).toFixed(2);
                receivableAmount.textContent = 'Rs. ' + parseFloat(data.financialSummary.receivableAmount).toFixed(2);
            } else {
                // Fallback to calculated values
                totalSales.textContent = 'Rs. ' + totalSalesValue.toFixed(2);
                const commission = totalSalesValue * 0.08; // 8% commission
                commissionAmount.textContent = 'Rs. ' + commission.toFixed(2);
                receivableAmount.textContent = 'Rs. ' + (totalSalesValue - commission).toFixed(2);
            }
        }

        // Function to close the participants modal
        function closeParticipantsModal() {
            document.getElementById('participantsModal').style.display = 'none';
        }

        // Function to switch between participant tabs
        function openTab(tabId) {
            // Hide all tab contents
            const tabContents = document.getElementsByClassName('tab-content');
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove('active');
            }

            // Deactivate all tabs
            const tabs = document.getElementsByClassName('tab');
            for (let i = 0; i < tabs.length; i++) {
                tabs[i].classList.remove('active');
            }

            // Activate the selected tab
            document.getElementById(tabId).classList.add('active');

            // Activate the selected tab button
            const tabButtons = document.querySelectorAll('.tab');
            for (let i = 0; i < tabButtons.length; i++) {
                if (tabButtons[i].getAttribute('onclick').includes(tabId)) {
                    tabButtons[i].classList.add('active');
                }
            }
        }

        // Function to view payment information
        function viewPaymentInfo(eventId, eventName) {
            const modal = document.getElementById('paymentInfoModal');
            document.getElementById('payment-event-name').textContent = eventName;

            // Add loading indicator
            document.getElementById('payment-status-badge').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            
            // Show the modal immediately
            modal.style.display = 'block';

            // Fetch payment info for this event
            fetch(`<?= ROOT ?>/eventOrganizer/ViewCompletedEvents/getEventPaymentInfo/${eventId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Payment data:', data);
                    
                    if (data.error) {
                        showNotification(data.error, 'error');
                        throw new Error(data.error);
                    }
                    
                    // Update payment status badge
                    const statusContainer = document.getElementById('payment-status-badge');
                    statusContainer.innerHTML = '';

                    // Create payment status badge
                    const paymentStatus = data.paymentStatus || 'Pending';
                    
                    // Use PHP's formatPaymentStatus function
                    let statusClass = '';
                    let icon = '';
                    
                    switch (paymentStatus.toLowerCase()) {
                        case 'paid':
                            statusClass = 'status-paid';
                            icon = 'fa-check-circle';
                            break;
                        case 'pending':
                            statusClass = 'status-pending';
                            icon = 'fa-clock';
                            break;
                        case 'processing':
                            statusClass = 'status-processing';
                            icon = 'fa-spinner fa-spin';
                            break;
                        default:
                            statusClass = 'status-pending';
                            icon = 'fa-question-circle';
                    }
                    
                    statusContainer.innerHTML = `<span class="payment-status ${statusClass}"><i class="fas ${icon}"></i> ${paymentStatus.charAt(0).toUpperCase() + paymentStatus.slice(1)}</span>`;

                    // Update financial information
                    document.getElementById('payment-total-sales').textContent = 'Rs. ' + parseFloat(data.totalSales || 0).toFixed(2);
                    const commission = parseFloat(data.totalSales || 0) * 0.08; // 8% commission
                    document.getElementById('payment-commission').textContent = 'Rs. ' + commission.toFixed(2);

                    // Use payableAmount from controller if available
                    document.getElementById('payment-receivable').textContent = 'Rs. ' + parseFloat(data.payableAmount || ((data.totalSales || 0) - commission)).toFixed(2);

                    // Update processing information
                    if (paymentStatus.toLowerCase() === 'paid') {
                        document.getElementById('payment-processing-message').textContent = 'Payment has been processed to your bank account.';
                        document.getElementById('payment-date').textContent = 'Payment date: ' + (data.paymentDate || 'N/A');
                    } else if (paymentStatus.toLowerCase() === 'processing') {
                        document.getElementById('payment-processing-message').textContent = 'Your payment is being processed.';
                        document.getElementById('expected-payment-date').textContent = calculateExpectedPaymentDate(data.eventDate);
                    } else {
                        document.getElementById('payment-processing-message').textContent = 'Payment processing can take 3-5 business days after event completion.';
                        document.getElementById('expected-payment-date').textContent = calculateExpectedPaymentDate(data.eventDate);
                    }
                })
                .catch(error => {
                    console.error('Error fetching payment info:', error);
                    document.getElementById('payment-status-badge').innerHTML = '<span class="payment-status status-error"><i class="fas fa-exclamation-circle"></i> Error</span>';
                    showNotification('Failed to load payment information: ' + error.message, 'error');
                });
        }

        // Function to calculate expected payment date (3-5 business days after event)
        function calculateExpectedPaymentDate(eventDate) {
            // Default to current date if event date not provided
            if (!eventDate) {
                return '3-5 business days';
            }

            const date = new Date(eventDate);

            // Add 5 business days
            let businessDays = 5;
            while (businessDays > 0) {
                date.setDate(date.getDate() + 1);
                // Skip weekends
                if (date.getDay() !== 0 && date.getDay() !== 6) {
                    businessDays--;
                }
            }

            // Format the date
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        // Function to close payment info modal
        function closePaymentInfoModal() {
            document.getElementById('paymentInfoModal').style.display = 'none';
        }

        // Function to show notification
        function showNotification(message, type) {
            const notification = document.getElementById('notification-popup');
            const notificationMessage = document.getElementById('notification-message');

            // Set message and type
            notificationMessage.textContent = message;
            notification.className = 'notification-popup notification-' + type;

            // Show notification
            notification.style.display = 'block';

            // Auto hide after 5 seconds
            setTimeout(() => {
                closeNotification();
            }, 5000);
        }

        // Function to close notification
        function closeNotification() {
            const notification = document.getElementById('notification-popup');
            notification.style.animation = 'slideOut 0.3s forwards';

            setTimeout(() => {
                notification.style.display = 'none';
                notification.style.animation = '';
            }, 300);
        }

        // Close modals when clicking outside
        window.onclick = function (event) {
            const participantsModal = document.getElementById('participantsModal');
            const paymentInfoModal = document.getElementById('paymentInfoModal');

            if (event.target === participantsModal) {
                closeParticipantsModal();
            }

            if (event.target === paymentInfoModal) {
                closePaymentInfoModal();
            }
        }

        // Filter participants based on search
        document.getElementById('participant-search').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const participantRows = document.querySelectorAll('#participants-list tr');

            participantRows.forEach(row => {
                const text = row.textContent.toLowerCase();

                // Show/hide row based on search
                if (text.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>