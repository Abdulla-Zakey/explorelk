<?php 
    $title = 'ExploreLK | EO - Create Event';
    include '../app/views/components/eonavbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/createevent.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title><?= $title ?></title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&libraries=places&callback=initMap" async defer></script>
    <style>
        .upload-container {
            background-image: url('<?php echo ROOT; ?>/assets/images/eo/create-event.jpg');
        }

        p {
            color: #333;
        }

        textarea {
            overflow: hidden;
            resize: none;
            line-height: 2rem;
        }

        /* Pop-up container (initially hidden) */
        .popup-container {
            font-size: 1.35rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Dark transparent overlay */
            display: none; /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 999; /* Above other content */
        }

        /* Pop-up content */
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            font-size: 16px;
        }

        /* Close button */
        .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        /* Blur background effect when pop-up is visible */
        .blur {
            filter: blur(5px);
            pointer-events: none;
        }
    </style>
</head>
<body>
    
    <form id="event-form" action="http://localhost/gitexplorelk/explorelk/public/eventorganizer/Eocreateevent/create" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(event)">
        <div class="upload-container" style="width: 1000px; margin-left: 20%;">
            <input type="file" id="image-upload" name="eventWebBanner" class="upload-input" accept="image/*">
            <label for="image-upload" class="upload-label">
                <img src="<?php echo ROOT; ?>/assets/images/eo/upload.png" alt="Upload">
            </label>
        </div>
        
        <div class="event-overview" style="width: 1000px; margin-left: 20%;">
            <h1>Event title</h1>
            <p>Name of the event, which should be clear and descriptive.</p>
            <div style="display: flex; gap: 1rem; width: 95%; margin-bottom: 1rem;">
                <input type="text" name="eventName" class="event-title" placeholder="Enter event title" style="flex: 2;">
                <select name="eventType" class="event-title" style="flex: 1;">
                    <option value="">Select Event Type</option>
                    <option value="carnival">Carnivals</option>
                    <option value="Music Concert">Music Concerts</option>
                    <option value="Magic Show">Magic Show</option>
                    <option value="sports">Sports</option>
                    <option value="Other">Others</option>
                </select>
            </div>
        </div>

        <div class="about-event" style="width: 1000px; margin-left: 20%;">
            <h1>About Event</h1>
            <p>A brief overview of the event, including its purpose, activities, and key details, within 350 characters.</p>
            <div class="text-editor" style="width: 95%; height: 10rem;">
                <div class="editor-header">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/texteditor.png" alt="Text Editor">
                    <div>
                        <button onclick="document.execCommand('bold', false, '');"><strong>B</strong></button>
                        <button onclick="document.execCommand('italic', false, '');"><em>I</em></button>
                        <button onclick="document.execCommand('underline', false, '');"><u>U</u></button>
                    </div>
                </div>
                <hr>
                <textarea name="aboutEvent" cols="90" class="editor-content" contenteditable="true" style="width: 97.5%; border: none; resize: none; border-bottom: 1px solid #d3d3d3;" placeholder="Start typing here..."></textarea>
            </div>
        </div>

        <div class="date-and-location" style="width: 1000px; margin-left: 20%;">
            <h1>Date and Location</h1>
            <div class="location-container" style="width: 100%;">
                <h2>Date and Time</h2>
                <div id="event-datetime-form">
                    <div style="margin-bottom: 15px;">
                        <label for="event-date">Date:</label>
                        <input type="date" id="event-date" name="eventDate">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="start-time">Start Time:</label>
                        <input type="time" id="start-time" name="eventStartTime">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="end-time">End Time:</label>
                        <input type="time" id="end-time" name="eventEndTime">
                    </div>
                </div>
            </div>
            <div class="location-container" style="width: 100%;">
                <h2>Location</h2>
                <div id="location-form">
                    <label for="location-input">Enter Location:</label>
                    <input type="text" id="location-input" name="eventLocation" placeholder="e.g., Colombo, Sri Lanka" style="width: 138.75%;">
                </div>
                <div id="map-container" style="height: 400px; width: 100%;"></div>
            </div>
        </div>

        <div class="ticket-container">
            <h1>Add Ticket Details</h1>
            <div id="ticket-forms-container">
                <!-- Initial ticket form -->
                <div class="ticket-form">
                    <!-- First row for ticket type and description -->
                    <div class="form-row">
                        <div class="ticket-item">
                            <label for="ticket-type-1">Ticket Type:</label>
                            <input type="text" id="ticket-type-1" name="ticket-type-1" placeholder="Eg: Kids Entrance Ticket">
                        </div>
                        <div class="ticket-item">
                            <label for="type-desc-1">Type Description:</label>
                            <input type="text" id="type-desc-1" name="type-desc-1" placeholder="Eg: Entrance fee for children under 10 years of age">
                        </div>
                    </div>
                    <!-- Second row for price and quantity -->
                    <div class="form-row">
                        <div class="ticket-item">
                            <label for="price-1">Price:</label>
                            <input type="number" id="price-1" name="price-1" placeholder="Eg: 250" step="1" min="100">
                        </div>
                        <div class="ticket-item">
                            <label for="count-1">Quantity:</label>
                            <input type="number" id="count-1" name="count-1" placeholder="Eg: 100" min="25" title="A minimum of 25 tickets must be added.">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="add-ticket-btn" onclick="addTicketForm()">
                <img src="<?= IMAGES ?>/eo/plus.png" alt="Plus Icon" class="plus-icon"> 
                Add More Ticket Types
            </button>
        </div>

        <button type="submit" class="review-publish-btn" style="width: 1000px; margin-left: 20%; background-color: #1E7A8F; cursor: pointer; height: 50px; color: white; font-size: 16px;">Review and Publish</button>
    </form>

    <div id="validation-popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-message"></p>
            <button id="close-popup">OK</button>
        </div>
    </div>

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

        function addTicketForm() {
            var formContainer = document.getElementById('ticket-forms-container');
            var formCount = formContainer.querySelectorAll('.ticket-form').length;
            var addButton = document.querySelector('.add-ticket-btn');
            var placeholder;
            var typeDescription;

            switch(formCount){
                case 1:
                    placeholder = 'General Entrance Ticket';
                    typeDescription = 'Entrance fee for adults (10 years and above)';
                    break;
                case 2:
                    placeholder = 'Family Entrance Ticket';
                    typeDescription = 'Discounted family ticket for 2 adults and 3 children';
                    break;
            }
    
            // Check if we've reached the limit of 3 ticket types
            if (formCount >= 3) {
                addButton.style.display = 'none';
                return;
            }

            var newForm = document.createElement('div');
            newForm.className = 'ticket-form';
    
            newForm.innerHTML = `
                <div class="form-row">
                    <div class="ticket-item">
                        <label for="ticket-type-${formCount + 1}">Ticket Type:</label>
                        <input type="text" id="ticket-type-${formCount + 1}" name="ticket-type-${formCount + 1}" placeholder="Eg: ${placeholder}" required>
                    </div>
                    <div class="ticket-item">
                        <label for="type-desc-${formCount + 1}">Type Description:</label>
                        <input type="text" id="type-desc-${formCount + 1}" name="type-desc-${formCount + 1}" placeholder="Eg: ${typeDescription}" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="ticket-item">
                        <label for="price-${formCount + 1}">Price:</label>
                        <input type="number" id="price-${formCount + 1}" name="price-${formCount + 1}" placeholder="e.g., 250" step="0.01" required>
                    </div>
                    <div class="ticket-item">
                        <label for="count-${formCount + 1}">Quantity:</label>
                        <input type="number" id="count-${formCount + 1}" name="count-${formCount + 1}" placeholder="e.g., 100" min="0" required>
                    </div>
                </div>
            `;
    
            formContainer.appendChild(newForm);

            if (formContainer.querySelectorAll('.ticket-form').length >= 3) {
                addButton.style.display = 'none';
            }
        }

        // Form validation function
        // function validateForm(event) {
        //     event.preventDefault();

        //     // Get all required fields
        //     const eventTitle = document.querySelector('.event-title').value.trim();
        //     const eventType = document.querySelector('[name="eventType"]').value;
        //     const aboutEvent = document.querySelector('[name="aboutEvent"]').value.trim();
        //     const eventDate = document.querySelector('#event-date').value;
        //     const startTime = document.querySelector('#start-time').value;
        //     const endTime = document.querySelector('#end-time').value;
        //     const locationInput = document.querySelector('#location-input').value.trim();

        //     // Validation checks
        //     if (!eventTitle) {
        //         showValidationPopup('Please enter an event title.');
        //         return false;
        //     }

        //     if (!eventType) {
        //         showValidationPopup('Please select an event type.');
        //         return false;
        //     }

        //     if (!aboutEvent) {
        //         showValidationPopup('Please provide a description about the event.');
        //         return false;
        //     }

        //     if (aboutEvent.length > 350) {
        //         showValidationPopup('Event description cannot exceed 350 characters.');
        //         return false;
        //     }

        //     if (!eventDate) {
        //         showValidationPopup('Please select an event date.');
        //         return false;
        //     }

        //     // Validate event date is not in the past
        //     const selectedDate = new Date(eventDate);
        //     const today = new Date();
        //     today.setHours(0, 0, 0, 0);

        //     if (selectedDate < today) {
        //         showValidationPopup('Event date cannot be in the past.');
        //         return false;
        //     }

        //     if (!startTime || !endTime) {
        //         showValidationPopup('Please select both start and end times.');
        //         return false;
        //     }

        //     // Validate end time is after start time
        //     const startDateTime = new Date(eventDate + 'T' + startTime);
        //     const endDateTime = new Date(eventDate + 'T' + endTime);

        //     if (endDateTime <= startDateTime) {
        //         showValidationPopup('End time must be after start time.');
        //         return false;
        //     }

        //     if (!locationInput) {
        //         showValidationPopup('Please enter an event location.');
        //         return false;
        //     }

        //     // Validate at least one ticket type
        //     const ticketTypes = document.querySelectorAll('[id^="ticket-type-"]');
        //     let isTicketValid = true;

        //     ticketTypes.forEach((ticket, index) => {
        //         const typeValue = ticket.value.trim();
        //         const priceValue = document.getElementById(`price-${index + 1}`).value;
        //         const countValue = document.getElementById(`count-${index + 1}`).value;

        //         if (!typeValue || !priceValue || !countValue) {
        //             isTicketValid = false;
        //         }

        //         if (priceValue < 0) {
        //             showValidationPopup('Ticket price cannot be negative.');
        //             isTicketValid = false;
        //         }

        //         if (countValue < 1) {
        //             showValidationPopup('Ticket quantity must be at least 1.');
        //             isTicketValid = false;
        //         }
        //     });

        //     // If all validations pass
        //     if (isTicketValid) {
        //         const form = event.target;
        //         form.submit();
        //         return true;
        //     }

        //     if (!isTicketValid) {
        //         showValidationPopup('Please fill in all ticket details correctly.');
        //         return false;
        //     }
        // }

        function validateForm(event) {
        event.preventDefault();

        // Get all required fields
        const eventTitle = document.querySelector('.event-title').value.trim();
        const eventType = document.querySelector('[name="eventType"]').value;
        const aboutEvent = document.querySelector('[name="aboutEvent"]').value.trim();
        const eventDate = document.querySelector('#event-date').value;
        const startTime = document.querySelector('#start-time').value;
        const endTime = document.querySelector('#end-time').value;
        const locationInput = document.querySelector('#location-input').value.trim();
        const imageInput = document.getElementById('image-upload');

        // Validation checks
        if (!eventTitle) {
            showValidationPopup('Please enter an event title.');
            return false;
        }

        if (!eventType) {
            showValidationPopup('Please select an event type.');
            return false;
        }

        if (!aboutEvent) {
            showValidationPopup('Please provide a description about the event.');
            return false;
        }

        if (aboutEvent.length > 350) {
            showValidationPopup('Event description cannot exceed 350 characters.');
            return false;
        }

        if (!eventDate) {
            showValidationPopup('Please select an event date.');
            return false;
        }

        // Validate event date is not in the past
        const selectedDate = new Date(eventDate);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            showValidationPopup('Event date cannot be in the past.');
            return false;
        }

        if (!startTime || !endTime) {
            showValidationPopup('Please select both start and end times.');
            return false;
        }

        // Validate end time is after start time
        const startDateTime = new Date(eventDate + 'T' + startTime);
        const endDateTime = new Date(eventDate + 'T' + endTime);

        if (endDateTime <= startDateTime) {
            showValidationPopup('End time must be after start time.');
            return false;
        }

        if (!locationInput) {
            showValidationPopup('Please enter an event location.');
            return false;
        }

        // Validate image upload
        if (!imageInput.files || imageInput.files.length === 0) {
            showValidationPopup('Please upload an event banner image.');
            return false;
        }

        const file = imageInput.files[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes

        if (!allowedTypes.includes(file.type)) {
            showValidationPopup('Please upload an image in JPEG, JPG, or PNG format.');
            return false;
        }

        if (file.size > maxSize) {
            showValidationPopup('Image size must not exceed 5MB.');
            return false;
        }

        // Validate at least one ticket type
        const ticketTypes = document.querySelectorAll('[id^="ticket-type-"]');
        let isTicketValid = true;

        ticketTypes.forEach((ticket, index) => {
            const typeValue = ticket.value.trim();
            const priceValue = document.getElementById(`price-${index + 1}`).value;
            const countValue = document.getElementById(`count-${index + 1}`).value;

            if (!typeValue || !priceValue || !countValue) {
                isTicketValid = false;
            }

            if (priceValue < 0) {
                showValidationPopup('Ticket price cannot be negative.');
                isTicketValid = false;
            }

            if (countValue < 1) {
                showValidationPopup('Ticket quantity must be at least 1.');
                isTicketValid = false;
            }
        });

        // If all validations pass
        if (isTicketValid) {
            const form = event.target;
            form.submit();
            return true;
        }

        if (!isTicketValid) {
            showValidationPopup('Please fill in all ticket details correctly.');
            return false;
        }
    }

        // Popup handling for validation errors
        function showValidationPopup(message) {
            const popup = document.getElementById('validation-popup');
            const popupMessage = document.getElementById('popup-message');
            const form = document.querySelector('form');
            const navbar = document.querySelector('.navbar');

            popupMessage.textContent = message;
            popup.style.display = 'flex';

            // Reset to default error styling
            popup.querySelector('.popup-content').style.backgroundColor = 'white';
            popup.querySelector('button').style.backgroundColor = '#007bff';
            popup.querySelector('button').style.borderColor = '#007bff';

            // Add blur effect to specific elements
            if (form) 
                form.classList.add('blur');
            if (navbar) 
                navbar.classList.add('blur');

            // Close popup on button click
            document.getElementById('close-popup').onclick = function() {
                popup.style.display = 'none';
                // Remove blur from specific elements
                if (form) 
                    form.classList.remove('blur');
                if (navbar) 
                    navbar.classList.remove('blur');
            };

            // Close popup on clicking outside
            popup.onclick = function(event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                    // Remove blur from specific

                    // Remove blur from specific elements
                    if (form) 
                        form.classList.remove('blur');
                    if (navbar) 
                        navbar.classList.remove('blur');
                }
            };
        }

        // Popup handling for success message
        function showSuccessPopup(message) {
            const popup = document.getElementById('validation-popup');
            const popupMessage = document.getElementById('popup-message');
            const form = document.querySelector('form');
            const navbar = document.querySelector('.navbar');

            popupMessage.textContent = message;
            popup.style.display = 'flex';
            // Customize success popup styling
            popup.querySelector('.popup-content').style.backgroundColor = '#e6ffed';
            popup.querySelector('button').style.backgroundColor = '#28a745';
            popup.querySelector('button').style.borderColor = '#28a745';

            // Add blur effect to specific elements
            if (form) 
                form.classList.add('blur');
            if (navbar) 
                navbar.classList.add('blur');

            // Close popup on button click and redirect
            document.getElementById('close-popup').onclick = function() {
                popup.style.display = 'none';
                // Remove blur from specific elements
                if (form) 
                    form.classList.remove('blur');
                if (navbar) 
                    navbar.classList.remove('blur');
                // Redirect to ViewPendingEvents after closing popup
                window.location.href = 'http://localhost/gitexplorelk/explorelk/public/eventorganizer/ViewPendingEvents';
            };

            // Close popup on clicking outside and redirect
            popup.onclick = function(event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                    // Remove blur from specific elements
                    if (form) 
                        form.classList.remove('blur');
                    if (navbar) 
                        navbar.classList.remove('blur');
                    // Redirect to ViewPendingEvents after closing popup
                    window.location.href = 'http://localhost/gitexplorelk/explorelk/public/eventorganizer/ViewPendingEvents';
                }
            };
        }

        // Add event listener to prevent form submission on Enter key
        document.getElementById('event-form').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });
    </script>

    <?php
    // Check for success message
    if (isset($_SESSION['success_message'])) {
        $successMessage = $_SESSION['success_message'];
        unset($_SESSION['success_message']); // Clear the message after displaying
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessPopup('" . htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') . "');
            });
        </script>";
    }

    // Check for error message
    if (isset($_GET['error'])) {
        $errorMessage = $_GET['error'];
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showValidationPopup('" . htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') . "');
            });
        </script>";
    }
    ?>
</body>
</html>