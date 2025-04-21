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


       
       
  
  <style>
   
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
