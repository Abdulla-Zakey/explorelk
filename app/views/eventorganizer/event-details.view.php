<?php
    $title = "ExploreLK | EO - Event Details";
    include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eoeventdetails.css">
    <title><?= $title ?></title>
    <style>
        :root {
            --primary-color: #002d40;
            --secondary-color: #e9ecef;
            --accent-color: #0a9396;
            --text-color: #333;
            --light-text-color: #fff;
            --border-color: #ddd;
        }

        body {
            font-family: "Arial", sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 0 auto;
            padding: 40px 20px;
            margin-left: 300px;
            margin-right: 100px;
        }

        .event-details {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            overflow: hidden;
        }

        .event-header {
            background-color: var(--primary-color);
            color: var(--secondary-color);
            padding: 30px;
        }

        .event-header h1 {
            margin: 0 0 10px 0;
            font-size: 2.5em;
            color: var(--secondary-color);
        }

        .event-meta {
            font-size: 1.1em;
        }

        .event-meta span {
            margin-right: 20px;
        }

        .event-content {
            display: flex;
            padding: 30px;
        }

        .event-image {
            flex: 0 0 40%;
            margin-right: 30px;
        }

        .event-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .event-info {
            flex: 1;
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 1.8em;
        }

        .ticket-details ul {
            list-style-type: none;
            padding: 0;
        }

        .ticket-details li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: var(--secondary-color);
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .event-content {
                flex-direction: column;
            }

            .event-image {
                margin-right: 0;
                margin-bottom: 20px;
            }

            .event-meta span {
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($data['error']) && $data['error']): ?>
            <div class="error-message">
                <h2>Error</h2>
                <p><?= $data['error'] ?></p>
            </div>
        <?php else: ?>
            <div id="eventDetails" class="event-details">
                <div class="event-header">
                    <h1 id="eventTitle"></h1>
                    <div class="event-meta">
                        <span id="eventDate"></span>
                        <span id="eventTime"></span>
                        <span id="eventLocation"></span>
                    </div>
                </div>
                <div class="event-content">
                    <div class="event-image">
                        <img id="eventImage" src="/placeholder.svg" alt="Event Image">
                    </div>
                    <div class="event-info">
                        <div class="event-description">
                            <h2>About Event</h2>
                            <p id="eventDescription"></p>
                        </div>
                        <div class="event-description">
                            <h2>Event Type</h2>
                            <p id="eventType"></p>
                        </div>
                        <div class="ticket-details">
                            <h2>Ticket Information</h2>
                            <ul>
                                <li id="ticketPrice"></li>
                                <li id="ticketsTotal"></li>
                                <li id="ticketsSold"></li>
                                <li id="ticketsRemaining"></li>
                                <li id="totalIncome"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Event data passed from the controller
        const eventData = {
            id: <?= $data['event']['event_Id'] ?? 0 ?>,
            title: "<?= htmlspecialchars($data['event']['eventName'] ?? 'Untitled Event') ?>",
            description: "<?= htmlspecialchars($data['event']['aboutEvent'] ?? 'No description available.') ?>",
            date: "<?= $data['event']['eventDate'] ?? 'N/A' ?>",
            time: "<?= isset($data['event']['eventStartTime']) && isset($data['event']['eventEndTime']) ? date('h:i A', strtotime($data['event']['eventStartTime'])) . ' - ' . date('h:i A', strtotime($data['event']['eventEndTime'])) : 'N/A' ?>",
            location: "<?= htmlspecialchars($data['event']['eventLocation'] ?? 'Unknown Location') ?>",
            image: "<?= !empty($data['event']['eventWebBannerPath']) ? htmlspecialchars($data['event']['eventWebBannerPath']) : '/placeholder.svg' ?>",
            ticketPrice: "<?= $data['event']['ticketPrice'] ? 'Rs ' . number_format($data['event']['ticketPrice'], 2) : 'N/A' ?>",
            ticketsTotal: "<?= $data['event']['ticketCount'] ?? 'N/A' ?>",
            ticketsSold: null, // As requested, set to null
            totalIncome: null, // As requested, set to null
            eventType: "<?= htmlspecialchars($data['event']['eventType'] ?? 'No type available.') ?>"
        };

        function renderEventDetails() {
            document.getElementById("eventTitle").textContent = eventData.title;
            document.getElementById("eventImage").src = eventData.image;
            document.getElementById("eventImage").alt = eventData.title;
            document.getElementById("eventDescription").textContent = eventData.description;
            document.getElementById("eventType").textContent = eventData.eventType;
            document.getElementById("eventDate").textContent = `Date: ${eventData.date}`;
            document.getElementById("eventTime").textContent = `Time: ${eventData.time}`;
            document.getElementById("eventLocation").textContent = `Location: ${eventData.location}`;
            document.getElementById("ticketPrice").textContent = `Ticket Price: ${eventData.ticketPrice}`;
            document.getElementById("ticketsTotal").textContent = `Total Tickets: ${eventData.ticketsTotal}`;
            document.getElementById("ticketsSold").textContent = `Tickets Sold: ${eventData.ticketsSold === null ? 'N/A' : eventData.ticketsSold}`;
            document.getElementById("ticketsRemaining").textContent = `Tickets Remaining: ${eventData.ticketsSold === null || eventData.ticketsTotal === 'N/A' ? 'N/A' : (parseInt(eventData.ticketsTotal) - parseInt(eventData.ticketsSold))}`;
            document.getElementById("totalIncome").textContent = `Total Income: ${eventData.totalIncome === null ? 'N/A' : eventData.totalIncome}`;
        }

        document.addEventListener("DOMContentLoaded", () => {
            renderEventDetails();
        });
    </script>
</body>
</html>