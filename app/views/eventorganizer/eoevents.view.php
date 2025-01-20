<?php 
    $title = "EO - Pending Events";
    include '../app/views/components/eonavbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eoevents.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title><?= $title ?></title>
</head>
<body>
<!-- <div class="my-events-container">
    <div >
        <h2 class="my-events-heading">My Events</h2>
    
    </div>
    <hr>
    <div class="my-events">
        <div class="my-event">

        </div>
        <div class="event-actions">
            <button class="edit-btn">Edit</button>
            <button class="cancel-btn">Cancel Event</button>
        </div>
        <div class="my-event">

        </div>
        <div class="event-actions">
            <button class="edit-btn">Edit</button>
            <button class="cancel-btn">Cancel Event</button>
        </div>
    </div>
</div> -->

<div class="my-events-container">
    <!-- <div>
        <h2 class="my-events-heading">My Events</h2>
    </div> -->
    <div>
        <h2 class="my-events-heading">Pending Events for Admin approval</h2>
    </div>
    <hr>
    <div class="my-events" id="events-list">
        <!-- Event cards will be dynamically inserted here -->
    </div>
</div>


<div class="other-events-container">
    <div >
        <h2 class="other-events-heading">Other Events</h2>
    
    </div>
    <hr>
    <!-- <div class="other-events">
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        <div class="other-event"></div>
        
    </div> -->
    <div id="event-grid">
      <!-- Event cards will be dynamically loaded here -->
    </div>
</div>
        
       
<script>
    // JavaScript START
    const events = [
      {
        title: "Whimsical Wonderfest",
        description: "Join industry leaders in design and technology.",
        date: "Dec 18, 2024",
        location: "Arcade Independence Square, Colombo - 7",
        time: "02:00 PM onwards",
        price: "250.00Rs",
        organizer: "Tech Leaders Inc.",
        contact: "contact@techleaders.com",
        eventType: "Conference",
        seatsAvailable: 120,
        image: "<?php echo ROOT; ?>/assets/images/eo/event-banner.jpg",
      },
      {
        title: "Yoga in the Park",
        description: "Relax and rejuvenate with a morning yoga session.",
        date: "Dec 10, 2024",
        location: "Central Park",
        time: "8:00 AM - 9:30 AM",
        price: "Free",
        organizer: "Yoga Community",
        contact: "info@yogacommunity.com",
        eventType: "Workshop",
        seatsAvailable: 50,
        image: "<?php echo ROOT; ?>/assets/images/eo/yoga-park.jpg",
      },
      {
        title: "Game Night",
        description: "Enjoy a fun-filled game night with friends.",
        date: "Dec 12, 2024",
        location: "Community Center",
        time: "6:00 PM - 9:00 PM",
        price: "$5 per person",
        organizer: "Fun Times",
        contact: "games@funtimes.com",
        eventType: "Social",
        seatsAvailable: 30,
        image: "<?php echo ROOT; ?>/assets/images/eo/game-night.jpg",
      }
    ];

    const eventGrid = document.getElementById("event-grid");

    function loadEvents() {
      eventGrid.innerHTML = "";
      events.forEach((event) => {
        const eventCard = document.createElement("a");
        eventCard.className = "event-card";
        eventCard.href = "#"; // Redirects to "samble.php"
        eventCard.innerHTML = `
          <img src="${event.image}" alt="${event.title}">
          <div class="content">
            <h3>${event.title}</h3>
            <p>${event.description}</p>
            <div class="details">
              <p><strong>Date:</strong> ${event.date}</p>
              <p><strong>Location:</strong> ${event.location}</p>
              <p><strong>Time:</strong> ${event.time}</p>
              <p><strong>Organizer:</strong> ${event.organizer}</p>
              <p><strong>Contact:</strong> ${event.contact}</p>
              <p><strong>Event Type:</strong> ${event.eventType}</p>
              <p><strong>Seats Available:</strong> ${event.seatsAvailable}</p>
            </div>
            <p class="price">${event.price}</p>
          </div>
        `;
        eventGrid.appendChild(eventCard);
      });
    }

    // Load events on page load
    loadEvents();
    // JavaScript END
  </script>
  <style>
    #event-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .event-card {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none;
      color: inherit;
    }

    .event-card:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .event-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }

    .event-card .content {
      padding: 15px;
    }

    .event-card h3 {
      margin: 0;
      font-size: 18px;
      color: #333;
    }

    .event-card p {
      margin: 10px 0;
      color: #666;
      font-size: 14px;
    }

    .event-card .details {
      font-size: 14px;
      color: #444;
    }

    .event-card .details p {
      margin: 5px 0;
    }

    .event-card .price {
      margin-top: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #007bff;
    }
  </style>
  <style>
    /* General Styles */
/* body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}
 */
/* Container for All Events */
.my-events-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Heading */
.my-events-heading {
    font-size: 2em;
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

/* Individual Event Card Styles */
.my-events {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
}

/* Event Card Styling */
.my-event {
    background-color: #fff;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    overflow: hidden;
}

.my-event:hover {
    transform: translateY(-12px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    background-color: #f9f9f9;
}

/* Event Details */
.event-details {
    margin-bottom: 25px;
}

.event-name {
    font-size: 1.8em;
    color: #2C3E50;
    font-weight: 600;
    margin-bottom: 12px;
    letter-spacing: 1px;
}

.event-description {
    font-style: italic;
    color: #7F8C8D;
    margin-bottom: 12px;
}

.about-event,
.event-date,
.event-location,
.ticket-count,
.ticket-price {
    font-size: 1.1em;
    color: #34495E;
    margin-bottom: 10px;
}

.event-description {
    color: #95A5A6;
}

.event-time {
    font-weight: 700;
    color: #E74C3C;
    margin-bottom: 15px;
}

.event-location {
    color: #8E44AD;
}

.ticket-count,
.ticket-price {
    color: #16A085;
}

span {
    font-weight: normal;
}

/* Add some subtle animation */
.my-event:hover .event-name {
    color: #2980B9;
    text-decoration: underline;
}

.event-name:hover {
    cursor: pointer;
}

/* Edit Mode Styles */
[contenteditable="true"] {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 4px;
    outline: none;
    transition: border-color 0.3s ease;
}

[contenteditable="true"]:focus {
    border-color: #007bff;
}

/* Event Actions Buttons */
.event-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

button {
    padding: 10px 20px;
    font-size: 0.9em;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    transform: scale(1.05);
}

.edit-btn {
    background-color: #007bff;
    color: white;
    border: none;
}

.save-btn {
    background-color: #28a745;
    color: white;
    border: none;
    display: inline-block;
}

.cancel-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    display: inline-block;
}

.delete-btn {
    background-color: #f44336;
    color: white;
    border: none;
    display: inline-block;
}

/* Button Group for Edit/Save/Cancel */
button:focus {
    outline: none;
}

/* Container for the events */
.my-events-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #f4f6f9; /* Light background to contrast with dark blue */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading Style */
        .my-events-heading {
            text-align: center;
            font-size: 2.5em;
            font-family: 'Roboto', sans-serif;
            color: #002D40; /* Dark blue color for the heading */
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Individual Event Styling */
        .my-event {
            border: 1px solid #003C53; /* Slightly lighter dark blue for borders */
            padding: 20px;
            margin-bottom: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Hover Effect for Events */
        .my-event:hover {
            transform: scale(1.02);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Event Details Styling */
        .event-details p {
            font-size: 1.1em;
            color: #003C53; /* Lighter dark blue text */
            line-height: 1.6;
        }

        /* Action Buttons Styling */
        .event-actions {
            margin-top: 20px;
            text-align: center;
        }

        /* Button Style */
        .event-actions button {
            padding: 12px 24px;
            margin-right: 10px;
            background-color: #002D40; /* Primary dark blue */
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        /* Button Hover Effect */
        .event-actions button:hover {
            background-color: #00415a; /* Slightly lighter blue for hover effect */
        }

        /* Disabled Button */
        .event-actions button:disabled {
            background-color: #d3d3d3; /* Gray for disabled button */
            cursor: not-allowed;
        }

        /* Input Fields */
        input[type="text"], input[type="date"], input[type="time"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #003C53; /* Lighter blue border for inputs */
            border-radius: 4px;
            background-color: #f9f9f9; /* Light background */
        }

        /* Read-only Input Fields */
        input[readonly] {
            background-color: #e3e3e3; /* Light gray for read-only fields */
        }

        /* Input Focus Effect */
        input:focus {
            outline: none;
            border-color: #002D40; /* Focus border color matches the primary blue */
            box-shadow: 0 0 5px rgba(0, 45, 64, 0.5); /* Subtle glow on focus */
        }

/* Responsive Design */
@media (max-width: 768px) {
    .my-events {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 500px) {
    .my-events {
        grid-template-columns: 1fr;
    }

    .event-actions {
        flex-direction: column;
        gap: 10px;
    }
}

  </style>

<script>
    // Dummy data for events
    let eventsdata = <?php echo json_encode($eventsdata); ?>;

    // Function to render events dynamically
    function renderEvents() {
        const eventsContainer = document.getElementById("events-list");

        eventsdata.forEach(event => {
            // Create event card element
            const eventCard = document.createElement("div");
            eventCard.classList.add("my-event");
            eventCard.id = `event-${event.id}`;

            // Create event details HTML
            const eventDetails = `
                
                <form method="post" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eoevents/updateEvent" >
                <div class="event-details">
                    <input type="hidden" id="event-name-${event.id}" value="${event.id}" name="id" readonly>
                    <label for="event-name-${event.id}">Event Name:</label>
                    <input type="text" id="event-name-${event.id}" value="${event.eventName}" name="eventName" readonly>
                    
                    <label for="event-description-${event.id}">About Event:</label>
                    <input type="text" id="event-description-${event.id}" value="${event.aboutEvent}" name="aboutEvent" readonly>


                    <label for="event-date-${event.id}">Event Date:</label>
                    <input type="date" id="event-date-${event.id}" value="${event.eventDate}" name="eventDate" readonly>

                    <label for="start-time-${event.id}">Start Time:</label>
                    <input type="time" id="start-time-${event.id}" value="${event.eventStartTime}" name="eventStartTime" readonly>

                    <label for="end-time-${event.id}">End Time:</label>
                    <input type="time" id="end-time-${event.id}" value="${event.eventEndTime}" name="eventEndTime" readonly>

                    <label for="event-location-${event.id}">Location:</label>
                    <input type="text" id="event-location-${event.id}" value="${event.eventLocation}" name="eventLocation" readonly>

                    <label for="available-tickets-${event.id}">Tickets Available:</label>
                    <input type="number" id="available-tickets-${event.id}" value="${event.ticketCount}" name="ticketCount" readonly>

                    <label for="ticket-price-${event.id}">Ticket Price:</label>
                    <input type="number" id="ticket-price-${event.id}" value="${event.ticketPrice}" name="ticketPrice" readonly>
                </div>
                <div class="event-actions">
                    <button type="button" id="edit-btn-${event.id}" onclick="editEvent(${event.id})">Edit</button>
                    <button type="submit" id="save-btn-${event.id}" style="display:none;" >Save</button>
                </form>
                
                    <button type="button" id="cancel-btn-${event.id}" onclick="cancelEdit(${event.id})" style="display:none;">Cancel</button>
                <form method="post" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eoevents/delete_event">
                    <input type="hidden" value="${event.id}" name="id" >   
                    <button type="submit" id="delete-btn-${event.id}" >Delete</button>
                </form>
                </div>
           
            `;

            // Append the event card to the container
            eventCard.innerHTML = eventDetails;
            eventsContainer.appendChild(eventCard);
        });
    }

    // Function to enable editing
    function editEvent(eventId) {
        document.getElementById(`edit-btn-${eventId}`).style.display = "none";
        document.getElementById(`save-btn-${eventId}`).style.display = "inline";
        document.getElementById(`cancel-btn-${eventId}`).style.display = "inline";
        
        const inputs = document.querySelectorAll(`#event-${eventId} input`);
        inputs.forEach(input => input.removeAttribute("readonly"));
    }

    // Function to save the changes
  

    // Function to cancel editing
    function cancelEdit(eventId) {
        const inputs = document.querySelectorAll(`#event-${eventId} input`);
        inputs.forEach(input => input.setAttribute("readonly", true));

        document.getElementById(`edit-btn-${eventId}`).style.display = "inline";
        document.getElementById(`save-btn-${eventId}`).style.display = "none";
        document.getElementById(`cancel-btn-${eventId}`).style.display = "none";
    }

    // Function to delete an event
    function deleteEvent(eventId) {
        const eventCard = document.getElementById(`event-${eventId}`);
        eventCard.remove();
    }

    // Render the events when the page loads
    renderEvents();
</script>
</body>
</html>
