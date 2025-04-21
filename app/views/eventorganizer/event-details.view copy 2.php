<?php
    $title = "ExploreLK | EO - Event Details";
    include '../app/views/components/eonavbar.php';

    // In a real application, you would fetch the event details from a database
    // For this example, we'll use a hardcoded event ID
    $eventId = 1;
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

        <div id="buyerDetails" class="buyer-details">
            <h2>Buyer Details</h2>
            <div class="table-container">
                <table class="buyer-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Ticket Count</th>
                            <th>Purchase Date</th>
                        </tr>
                    </thead>
                    <tbody id="buyerList"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Mock data for the event
const eventData = {
  id: 1,
  title: "Batch Welcome Event",
  description:
    "Join us for an exciting welcome event for the new batch of students. This event will feature introductions, team-building activities, and a chance to meet your fellow classmates and faculty members.",
  date: "2024-12-10",
  time: "10:00 AM - 12:00 PM",
  location: "UCSC, Reid Avenue, Colombo 00700, Sri Lanka",
  image:
    "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-02-02%20153835-Q8BvbhezERC6BCNqfpgG3mE3mS7eVu.png",
  ticketPrice: "Rs 1,000",
  ticketsTotal: 400,
  ticketsSold: 150,
  totalIncome: "Rs 150,000",
}

// Mock data for buyers
const buyerData = [
  { id: 1, name: "John Doe", ticketCount: 2, purchaseDate: "2024-11-15" },
  { id: 2, name: "Jane Smith", ticketCount: 1, purchaseDate: "2024-11-16" },
  { id: 3, name: "Bob Johnson", ticketCount: 3, purchaseDate: "2024-11-17" },
  { id: 4, name: "Alice Brown", ticketCount: 2, purchaseDate: "2024-11-18" },
  { id: 5, name: "Charlie Davis", ticketCount: 1, purchaseDate: "2024-11-19" },
]

function renderEventDetails() {
  document.getElementById("eventTitle").textContent = eventData.title
  document.getElementById("eventImage").src = eventData.image
  document.getElementById("eventImage").alt = eventData.title
  document.getElementById("eventDescription").textContent = eventData.description
  document.getElementById("eventDate").textContent = `Date: ${eventData.date}`
  document.getElementById("eventTime").textContent = `Time: ${eventData.time}`
  document.getElementById("eventLocation").textContent = `Location: ${eventData.location}`
  document.getElementById("ticketPrice").textContent = `Ticket Price: ${eventData.ticketPrice}`
  document.getElementById("ticketsTotal").textContent = `Total Tickets: ${eventData.ticketsTotal}`
  document.getElementById("ticketsSold").textContent = `Tickets Sold: ${eventData.ticketsSold}`
  document.getElementById("ticketsRemaining").textContent =
    `Tickets Remaining: ${eventData.ticketsTotal - eventData.ticketsSold}`
  document.getElementById("totalIncome").textContent = `Total Income: ${eventData.totalIncome}`
}

function renderBuyerDetails() {
  const buyerListElement = document.getElementById("buyerList")
  buyerListElement.innerHTML = ""

  buyerData.forEach((buyer) => {
    const row = document.createElement("tr")
    row.innerHTML = `
            <td>${buyer.id}</td>
            <td>${buyer.name}</td>
            <td>${buyer.ticketCount}</td>
            <td>${buyer.purchaseDate}</td>
        `
    buyerListElement.appendChild(row)
  })
}

document.addEventListener("DOMContentLoaded", () => {
  renderEventDetails()
  renderBuyerDetails()
})


    </script>
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
  /* max-width: 1000px; */
  margin: 0 auto;
  padding: 40px 20px;
  margin-left: 300px;
  margin-right: 100px;
}

.event-details,
.buyer-details {
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

.buyer-details {
  padding: 30px;
}

.table-container {
  overflow-x: auto;
}

.buyer-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.buyer-table th,
.buyer-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid var(--border-color);
}

.buyer-table th {
  background-color: var(--primary-color);
  color: var(--light-text-color);
  font-weight: bold;
}

.buyer-table tr:hover {
  background-color: var(--secondary-color);
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
</body>
</html>

