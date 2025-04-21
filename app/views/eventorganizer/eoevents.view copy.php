
<?php print_r($eventsdata); 
    $title = "EO - Pending Events";
    include '../app/views/components/eonavbar.php';
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
            /* max-width: 1200px;
            margin: 20px auto; */
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Pending Events for Admin Approval</h1>
        <div class="events-grid" id="events-list">
            <!-- Event cards will be dynamically inserted here -->
        </div>
    </div>

    <script>
        let eventsdata = <?php echo json_encode($eventsdata); ?>;

        function renderEvents() {
            const eventsContainer = document.getElementById("events-list");
            eventsContainer.innerHTML = '';

            eventsdata.forEach(event => {
                const eventCard = document.createElement("div");
                eventCard.classList.add("event-card");
                eventCard.id = `event-${event.id}`;

                const eventContent = `
                    <div class="event-header">
                        <h3>${event.eventName}</h3>
                    </div>
                    <div class="event-body">
                        <div class="event-detail"><i class="fas fa-calendar"></i> ${event.eventDate}</div>
                        <div class="event-detail"><i class="fas fa-clock"></i> ${event.eventStartTime} - ${event.eventEndTime}</div>
                        <div class="event-detail"><i class="fas fa-map-marker-alt"></i> ${event.eventLocation}</div>
                        <div class="event-detail"><i class="fas fa-ticket-alt"></i> ${event.ticketCount} tickets at $${event.ticketPrice} each</div>
                        <div class="event-detail"><i class="fas fa-info-circle"></i> ${event.aboutEvent}</div>
                    </div>
                    <div class="event-actions">
                        <button class="btn btn-edit" onclick="editEvent(${event.id})">Edit</button>
                        <form method="post" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eoevents/delete_event" style="display:inline;">
                            <input type="hidden" value="${event.id}" name="id">
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                `;

                eventCard.innerHTML = eventContent;
                eventsContainer.appendChild(eventCard);
            });
        }

        function editEvent(eventId) {
            const eventCard = document.getElementById(`event-${eventId}`);
            const event = eventsdata.find(e => e.id == eventId);

            const editForm = `
                <form method="post" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eoevents/updateEvent">
                    <div class="event-header">
                        <input type="hidden" name="id" value="${event.id}">
                        <input type="text" name="eventName" value="${event.eventName}" required>
                    </div>
                    <div class="event-body">
                        <input type="text" name="eventType" value="${event.eventType}" required>
                        <input type="date" name="eventDate" value="${event.eventDate}" required>
                        <input type="time" name="eventStartTime" value="${event.eventStartTime}" required>
                        <input type="time" name="eventEndTime" value="${event.eventEndTime}" required>
                        <input type="text" name="eventLocation" value="${event.eventLocation}" required>
                        <input type="number" name="ticketCount" value="${event.ticketCount}" required>
                        <input type="number" name="ticketPrice" value="${event.ticketPrice}" required>
                        <textarea name="aboutEvent" required>${event.aboutEvent}</textarea>
                    </div>
                    <div class="event-actions">
                        <button type="submit" class="btn btn-save">Save</button>
                        <button type="button" class="btn btn-cancel" onclick="cancelEdit(${event.id})">Cancel</button>
                    </div>
                </form>
            `;

            eventCard.innerHTML = editForm;
        }

        function cancelEdit(eventId) {
            renderEvents();
        }

        renderEvents();
    </script>
</body>
</html>