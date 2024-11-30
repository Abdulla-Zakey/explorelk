<?php 
  include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Eventorganizer/createevent.css">
    <!-- Include Google Maps and Places API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places&callback=initMap" async defer></script>
    <style>
        .upload-container {
            background-image: url('<?php echo ROOT; ?>/assets/images/eo/create-event.jpg');
        }
    </style>
</head>
<body>
    
    <div class="upload-container">
        <input type="file" id="image-upload" class="upload-input" accept="image/*" required>
        <label for="image-upload" class="upload-label">
            <img src="<?php echo ROOT; ?>/assets/images/eo/upload.png" alt="Upload">
        </label>
    </div>
    
    <div class="event-overview">
        <h1>Event Description</h1>
        <h2>Event title</h2>
        <p>The name of the event, which should be clear and descriptive.</p>
        <input type="text" class="event-title" placeholder="Enter event title" required>
        <h2>Event Description</h2>
        <p>A brief overview of the event, including its purpose, activities, and any important details.</p>
        <input type="text" class="event-description" placeholder="Enter event description" required>
    </div>

    <div class="about-event">
        <h1>About Event</h1>
        <div class="text-editor">
            <div class="editor-header">
                <img src="<?php echo ROOT; ?>/assets/images/eo/texteditor.png" alt="Text Editor">
                <div>
                    <button onclick="document.execCommand('bold', false, '');"><strong>B</strong></button>
                    <button onclick="document.execCommand('italic', false, '');"><em>I</em></button>
                    <button onclick="document.execCommand('underline', false, '');"><u>U</u></button>
                </div>
            </div>
            <hr>
            <div class="editor-content" contenteditable="true">
                Start typing here...
            </div>
        </div>
    </div>

    <div class="date-and-location">
        <h1>Date and Location</h1>
        <h2>Date and Time</h2>
        <form id="event-datetime-form">
            <div>
                <label for="event-date">Date:</label>
                <input type="date" id="event-date" name="event-date" required>
            </div>
            <div>
                <label for="start-time">Start Time:</label>
                <input type="time" id="start-time" name="start-time" required>
            </div>
            <div>
                <label for="end-time">End Time:</label>
                <input type="time" id="end-time" name="end-time" required>
            </div>
        </form>
        
        <div class="location-container">
            <h2>Location</h2>
            <form id="location-form">
                <label for="location-input">Enter Location:</label>
                <input type="text" id="location-input" name="location-input" placeholder="e.g., Colombo, Sri Lanka" required>
            </form>
            <div id="map-container" style="height: 400px; width: 100%;"></div>
        </div>
    </div>

    <div class="ticket-container">
        <h2>Ticketing Information</h2>
        <form id="ticket-form">
            <label for="ticket-count">Ticket Count:</label>
            <input type="number" id="ticket-count" name="ticket-count" placeholder="Enter number" min="0" required>
        </form>
        <h2>Ticket Types</h2>
        <div id="ticket-forms-container">
            <form class="ticket-form">
                <div class="ticket-item">
                    <label for="ticket-type-1">Ticket Type:</label>
                    <input type="text" id="ticket-type-1" name="ticket-type-1" placeholder="e.g., VIP" required>
                </div>
                <div class="ticket-item">
                    <label for="price-1">Price:</label>
                    <input type="number" id="price-1" name="price-1" placeholder="e.g., 50" step="0.01" required>
                </div>
                <div class="ticket-item">
                    <label for="count-1">Count:</label>
                    <input type="number" id="count-1" name="count-1" placeholder="e.g., 100" min="0" required>
                </div>
            </form>
        </div>

        <button type="button" class="add-ticket-btn" onclick="addTicketForm()">
            <img src="<?php echo ROOT; ?>/assets/images/eo/plus.png" alt="Plus Icon" class="plus-icon"> Add More Ticket Types
        </button>   
    </div>

    <button type="button" class="review-publish-btn" onclick="validateForm()">Review and Publish</button>

    <script>
        // Initialize the map, geocoder, and autocomplete
        let map;
        let geocoder;
        let autocomplete;
        let marker;

        function initMap() {
             // Restrict to Sri Lanka (country code 'LK')
             var options = {
                componentRestrictions: { country: 'LK' }
            };

            // Default location is set to Colombo, Sri Lanka
            const defaultLocation = { lat: 6.9271, lng: 79.8612 };

            map = new google.maps.Map(document.getElementById("map-container"), {
                center: defaultLocation,
                zoom: 12,
            });
            
            geocoder = new google.maps.Geocoder();

            // Initialize the autocomplete for location input
            const input = document.getElementById('location-input');
            autocomplete = new google.maps.places.Autocomplete(input, options);

            // Prevent form submission on Enter key press
            input.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Prevent form submission and page reload
                }
            });

            // When a place is selected, update the map
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                
                if (!place.geometry) {
                    alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Center the map on the selected place and add a marker
                map.setCenter(place.geometry.location);
                map.setZoom(15);

                if (marker) {
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });
            });
        }

        // Function to add more ticket forms dynamically
        function addTicketForm() {
            var formContainer = document.getElementById('ticket-forms-container');
            var formCount = formContainer.querySelectorAll('.ticket-form').length + 1;

            var newForm = document.createElement('form');
            newForm.classList.add('ticket-form');
            newForm.innerHTML = `
                <div class="ticket-item">
                    <label for="ticket-type-${formCount}">Ticket Type:</label>
                    <input type="text" id="ticket-type-${formCount}" name="ticket-type-${formCount}" placeholder="e.g., VIP" required>
                </div>
                <div class="ticket-item">
                    <label for="price-${formCount}">Price:</label>
                    <input type="number" id="price-${formCount}" name="price-${formCount}" placeholder="e.g., 50" step="0.01" required>
                </div>
                <div class="ticket-item">
                    <label for="count-${formCount}">Count:</label>
                    <input type="number" id="count-${formCount}" name="count-${formCount}" placeholder="e.g., 100" min="0" required>
                </div>
            `;
            formContainer.appendChild(newForm);
        }

        // Form validation function
        function validateForm() {
            const eventTitle = document.querySelector('.event-title').value;
            const eventDescription = document.querySelector('.event-description').value;
            const locationInput = document.querySelector('#location-input').value;

            if (!eventTitle || !eventDescription || !locationInput) {
                alert('Please fill in all required fields.');
                return false;
            }

            // Proceed with form submission or further handling
            alert('Event successfully created!');
        }
    </script>
</body>
</html>
