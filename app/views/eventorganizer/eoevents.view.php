<?php
$title = "EO - Pending Events";
include '../app/views/components/eonavbar.php';

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
        }
        .container {
            margin-left: 300px;
            padding: 0 20px;
        }
        h1 {
            color: #002D40;
            text-align: center;
            margin-bottom: 30px;
        }
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .event-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .event-header {
            background-color: #002D40;
            color: #fff;
            padding: 15px;
        }
        .event-body {
            padding: 15px;
        }
        .event-detail {
            margin-bottom: 10px;
        }
        .event-actions {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: right;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: 10px;
        }
        .btn-edit { background-color: #004D6D; color: white; }
        .btn-delete { background-color: #dc3545; color: white; }
        .btn-save { background-color: #28a745; color: white; }
        .btn-cancel { background-color: #6c757d; color: white; }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .edit-form-container {
            padding: 15px;
        }
        .edit-form .event-detail {
            margin-bottom: 15px;
        }
        .edit-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #002D40;
        }
        .edit-form input,
        .edit-form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }
        .edit-form textarea {
            min-height: 100px;
            resize: vertical;
        }
        .event-content {
            display: block;
        }
        .message, .error {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .message { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pending Events for Admin Approval</h1>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="events-grid" id="events-list">
            <!-- Event cards will be dynamically inserted here -->
        </div>
    </div>

    <script>
        let eventsdata = <?php echo json_encode($eventsdata); ?>;

        // Debugging: Log eventsdata
        console.log('Events Data:', eventsdata);

        function renderEvents() {
            const eventsContainer = document.getElementById("events-list");
            eventsContainer.innerHTML = '';

            eventsdata.forEach(event => {
                if (!event.event_Id) {
                    console.error('Event missing event_Id:', event);
                    return;
                }

                const eventCard = document.createElement("div");
                eventCard.classList.add("event-card");
                eventCard.id = `event-${event.event_Id}`;
                eventCard.dataset.eventId = event.event_Id;

                const eventContent = `
                    <div class="event-header">
                        <h3>${event.eventName}</h3>
                    </div>
                    <div class="event-content">
                        <div class="event-body">
                            <div class="event-detail"><i class="fas fa-layer-group"></i> Type: ${event.eventType || 'N/A'}</div>
                            <div class="event-detail"><i class="fas fa-calendar"></i> Date: ${event.eventDate}</div>
                            <div class="event-detail"><i class="fas fa-clock"></i> Time: ${event.eventStartTime} - ${event.eventEndTime}</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Location: ${event.eventLocation}</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> Tickets: ${event.ticketCount || 'N/A'} available at $${event.ticketPrice || 'N/A'} each</div>
                            <div class="event-detail"><i class="fas fa-info-circle"></i> About: ${event.aboutEvent}</div>
                            <div class="event-detail"><i class="fas fa-check-circle"></i> Status: ${event.eventStatus || 'Pending'}</div>
                            ${event.eventWebBannerPath ? `<img src="${event.eventWebBannerPath}" alt="Event Image" style="width:100%;border-radius:8px;margin-top:10px;">` : ''}
                        </div>
                        <div class="event-actions">
                            <button class="btn btn-edit" data-event-id="${event.event_Id}">Edit</button>
                            <form method="post" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eoevents/delete_event" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete ${event.eventName}?');">
                                <input type="hidden" name="id" value="${event.event_Id}">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="edit-form-container" style="display: none;">
                        <form method="post" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eoevents/updateEvent" class="edit-form">
                            <input type="hidden" name="id" value="${event.event_Id}">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <div class="event-detail">
                                <label>Event Name:</label>
                                <input type="text" name="eventName" value="${event.eventName}" required>
                            </div>
                            <div class="event-detail">
                                <label>Event Type:</label>
                                <input type="text" name="eventType" value="${event.eventType || ''}" required>
                            </div>
                            <div class="event-detail">
                                <label>Date:</label>
                                <input type="date" name="eventDate" value="${event.eventDate}" required>
                            </div>
                            <div class="event-detail">
                                <label>Start Time:</label>
                                <input type="time" name="eventStartTime" value="${event.eventStartTime}" required>
                            </div>
                            <div class="event-detail">
                                <label>End Time:</label>
                                <input type="time" name="eventEndTime" value="${event.eventEndTime}" required>
                            </div>
                            <div class="event-detail">
                                <label>Location:</label>
                                <input type="text" name="eventLocation" value="${event.eventLocation}" required>
                            </div>
                            <div class="event-detail">
                                <label>Ticket Count:</label>
                                <input type="number" name="ticketCount" value="${event.ticketCount || ''}">
                            </div>
                            <div class="event-detail">
                                <label>Ticket Price:</label>
                                <input type="number" step="0.01" name="ticketPrice" value="${event.ticketPrice || ''}">
                            </div>
                            <div class="event-detail">
                                <label>About Event:</label>
                                <textarea name="aboutEvent" required>${event.aboutEvent}</textarea>
                            </div>
                            <div class="event-actions">
                                <button type="submit" class="btn btn-save">Save</button>
                                <button type="button" class="btn btn-cancel" data-event-id="${event.event_Id}">Cancel</button>
                            </div>
                        </form>
                    </div>
                `;

                eventCard.innerHTML = eventContent;
                eventsContainer.appendChild(eventCard);
            });

            // Event delegation for edit and cancel buttons
            eventsContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('btn-edit')) {
                    const eventId = e.target.dataset.eventId;
                    editEvent(eventId);
                } else if (e.target.classList.contains('btn-cancel')) {
                    const eventId = e.target.dataset.eventId;
                    cancelEdit(eventId);
                }
            });
        }

        function editEvent(eventId) {
            console.log('Editing event with ID:', eventId);
            document.querySelectorAll('.edit-form-container').forEach(container => {
                container.style.display = 'none';
            });
            document.querySelectorAll('.event-content').forEach(content => {
                content.style.display = 'block';
            });

            const eventCard = document.getElementById(`event-${eventId}`);
            if (!eventCard) {
                console.error(`Event card with ID event-${eventId} not found`);
                return;
            }

            const eventContent = eventCard.querySelector('.event-content');
            const editFormContainer = eventCard.querySelector('.edit-form-container');

            if (eventContent && editFormContainer) {
                eventContent.style.display = 'none';
                editFormContainer.style.display = 'block';
                console.log(`Toggled edit form for event-${eventId}`);
            } else {
                console.error('Event content or edit form not found in card:', eventCard);
            }
        }

        function cancelEdit(eventId) {
            console.log('Canceling edit for event with ID:', eventId);
            const eventCard = document.getElementById(`event-${eventId}`);
            if (!eventCard) {
                console.error(`Event card with ID event-${eventId} not found`);
                return;
            }

            const eventContent = eventCard.querySelector('.event-content');
            const editFormContainer = eventCard.querySelector('.edit-form-container');

            if (eventContent && editFormContainer) {
                eventContent.style.display = 'block';
                editFormContainer.style.display = 'none';
                console.log(`Canceled edit for event-${eventId}`);
            } else {
                console.error('Event content or edit form not found in card:', eventCard);
            }
        }

        renderEvents();
    </script>
</body>
</html>