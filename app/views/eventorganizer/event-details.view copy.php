<?php
    $title = "ExploreLK | EO - Event Details";
    include '../app/views/components/eonavbar.php';

    // In a real application, you would fetch the event details from a database
    // For this example, we'll use the event ID from the URL
    //$eventId = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eoeventdetails.css">
    <title><?= $title ?></title>
</head>
<body>
    <div class="container">
        <div id="eventDetails">
            <h1 id="eventTitle"></h1>
            <div class="event-info">
                <div class="event-image">
                    <img id="eventImage" src="/placeholder.svg" alt="Event Image">
                </div>
                <div class="event-description">
                    <h2>About Event</h2>
                    <p id="eventDescription"></p>
                </div>
            </div>
            <div class="event-metadata">
                <div class="date-location">
                    <h2>Date and Location</h2>
                    <p id="eventDate"></p>
                    <p id="eventLocation"></p>
                </div>
                <div class="ticket-details">
                    <h2>Ticket Details</h2>
                    <p id="ticketsSold"></p>
                    <p id="ticketsRemaining"></p>
                    <p id="ticketPrice"></p>
                </div>
            </div>
        </div>
        <h2>Buyer Details</h2>
        <table class="buyer-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Ticket Count</th>
                </tr>
            </thead>
            <tbody id="buyerList"></tbody>
        </table>
        <div id="summary" class="summary"></div>
    </div>

    <script>
            const eventData = [
            {
                id: 1,
                title: "Batch Welcome Event",
                description:
                "Join us for an exciting welcome event for the new batch of students. This event will feature introductions, team-building activities, and a chance to meet your fellow classmates and faculty members.",
                location: "UCSC, Reid Avenue, Colombo 00700, Sri Lanka",
                date: "Tuesday, December 10, 2024",
                time: "10:00 AM to 12:00 PM",
                sold: 10,
                total: 400,
                price: "Rs 1,000",
                income: "Rs 10,000",
                image:
                "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-02-02%20153835-Q8BvbhezERC6BCNqfpgG3mE3mS7eVu.png",
            },
            // ... (add more events as needed)
            ]

            const buyerData = [
            { id: 1, name: "John Doe", ticketCount: 2 },
            { id: 2, name: "Jane Smith", ticketCount: 1 },
            { id: 3, name: "Bob Johnson", ticketCount: 3 },
            // Add more buyers as needed
            ]

            function getEventId() {
            const urlParams = new URLSearchParams(window.location.search)
            return Number.parseInt(urlParams.get("id"))
            }

            function renderEventDetails(eventId) {
            const event = eventData.find((e) => e.id === eventId)
            if (!event) {
                document.getElementById("eventDetails").innerHTML = "<p>Event not found.</p>"
                return
            }

            document.getElementById("eventTitle").textContent = event.title
            document.getElementById("eventImage").src = event.image
            document.getElementById("eventImage").alt = event.title
            document.getElementById("eventDescription").textContent = event.description
            document.getElementById("eventDate").textContent = `Date: ${event.date}`
            document.getElementById("eventLocation").textContent = `Location: ${event.location}`
            document.getElementById("ticketsSold").textContent = `Tickets Sold: ${event.sold}`
            document.getElementById("ticketsRemaining").textContent = `Tickets Remaining: ${event.total - event.sold}`
            document.getElementById("ticketPrice").textContent = `Ticket Price: ${event.price}`

            const buyerListHtml = buyerData
                .map(
                (buyer) => `
                    <tr>
                        <td>${buyer.id}</td>
                        <td>${buyer.name}</td>
                        <td>${buyer.ticketCount}</td>
                    </tr>
                `,
                )
                .join("")
            document.getElementById("buyerList").innerHTML = buyerListHtml

            const summaryHtml = `
                    <p><strong>Total Sold:</strong> ${event.sold}</p>
                    <p><strong>Remaining:</strong> ${event.total - event.sold}</p>
                    <p><strong>Total Income:</strong> ${event.income}</p>
                `
            document.getElementById("summary").innerHTML = summaryHtml
            }

            document.addEventListener("DOMContentLoaded", () => {
            const eventId = getEventId()
            renderEventDetails(eventId)
            })


    </script>
    <style>
        .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        }

        .event-info {
        display: flex;
        margin-bottom: 20px;
        gap: 20px;
        }

        .event-image img {
        width: 100%;
        max-width: 400px;
        height: auto;
        }

        .event-description,
        .event-metadata {
        flex-grow: 1;
        }

        .event-metadata {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        }

        .date-location,
        .ticket-details {
        flex-basis: 48%;
        }

        h1,
        h2 {
        color: #333;
        margin-bottom: 10px;
        }

        p {
        margin-bottom: 10px;
        line-height: 1.5;
        }

        .buyer-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        }

        .buyer-table th,
        .buyer-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        }

        .buyer-table th {
        background-color: #f2f2f2;
        }

        .summary {
        display: flex;
        justify-content: space-between;
        font-weight: bold;
        background-color: #f2f2f2;
        padding: 10px;
        border-radius: 5px;
        }


    </style>
</body>
</html>

