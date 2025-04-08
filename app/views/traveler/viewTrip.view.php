<!DOCTYPE html>
<html lang="en">
    <?php
        //I used this to check whether iternary place details are passed correctly
        // foreach($data['allTripPlaces'] as $dayId => $places) {
        //     echo "Day ID: " . $dayId . "\n";
        //     var_dump($places);
        // }
        // var_dump($data['collaborators'][2]);
        // var_dump($data['isOwner']);
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/viewTrip.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | View Trip</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places"></script> --> <!--Old Api key-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&libraries=places"></script>
    <style>

        .coverImage-text{
            background: none; 
            border: none; 
            color: white; 
        }

        #icon{
            font-size: 2rem; margin-top: 0.25rem; margin-right: 1rem;
        }

        .edit-controls {
            display: flex;    
            margin-top: 5rem;
            margin-right: 35%;
            margin-left: 35%;
            gap: 5%;
            padding-bottom: 1.5rem;
        }

        .save-btn {
            background-color: #4CAF50;
        }

        .cancel-btn {
            background-color: #f44336;
            
        }

        .save-btn, .cancel-btn{
            color: white;
            width: 47.5%;
            font-size: 1.6rem;
            padding: 1.5rem 1rem;
            border-radius: 1rem;
            border: none;
            box-sizing: border-box;
        }

        .edit-btn {
            background-color: #B3D9FF;
            margin-right: 5rem;
            font-size:1.6rem;
            width: 15rem;
            color: #002D40;;
            padding: 15px 30px;
            border: none;
            border-radius: 1rem;
        }

        .save-btn:hover, .cancel-btn:hover, .edit-btn:hover{
            box-shadow: 0px 0px 10px #333;
            cursor: pointer;
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

    <header>
        <nav class="navbar">

            <div class="backToHome" style="font-size: 1.6rem;">
                <a href="<?= ROOT ?>/traveler/MyTrips">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <?php 
                if($data['isOwner'] == true || $data['isEditor'] == true){
                    echo    '<button id="editToggle" class="edit-btn" style = "margin-left: 50%; margin-right: 1rem;">
                                <i class="fa-solid fa-edit"></i> Edit Trip
                            </button>
                    ';
                }

                if($data['isOwner'] == true){
                    echo    '<button id="inviteBtn" class="edit-btn" style = "width: 20rem;">
                                <i class="fa-solid fa-user-plus"></i> Invite Friends
                            </button>
                    ';
                }
            ?>

        </nav>
    </header>

    <section id="main">
        <form id = "tripEditForm" method="POST" action="<?= ROOT ?>/traveler/MyTrips/editTrip/<?= $data['trip']->trip_Id ?>">

            <div class="top">

                <div class="imgAndTopic-Container">

                    <h1>
                        <input type = "text" name="tripName" style = "font-size: 4.8rem; font-weight: 750;" class = "coverImage-text" value = "<?= htmlspecialchars($data['trip']->tripName) ?>" disabled>
                    </h1>

                    <div class="dateAndLocationInfo-Conatiner">

                        <div style = "display: flex;">
                            <i class = "fa-regular fa-calendar" id = "icon"></i>
                            <input type = "date" name = "startDate" class = "coverImage-text" style = "font-size: 1.8rem; margin-right: 1.25rem; margin-top: 0.25rem;" value = "<?= $data['trip']->startDate ?>" disabled>
                            
                            <i class="fa-regular fa-calendar" id = "icon"></i>
                            <input type = "date" name = "endDate" class = "coverImage-text" style = "font-size: 1.8rem; margin-right: 1.25rem; margin-top: 0.25rem;" value = "<?= $data['trip']->endDate ?>" disabled>
                        
                            <i class="fa-solid fa-location-dot" id = "icon"></i>
                            <input type="text" name = "destination" class = "coverImage-text" style = "font-size: 1.8rem; margin-top: 0.25rem;" value = "<?= htmlspecialchars($data['trip']->destination) ?>" disabled>
                        </div>

                    </div>
                </div>

                <div id="map-Holder" class="map-Conatiner">
                    <!-- Map will be initialized dynamically -->
                </div>

            </div>

            <div class="outer-Container">
                <div class="tripDetails-Conatiner">

                    <div class="basicInfo-Container">
                        <h2>Basic Trip Information</h2>
                        <div>
                            <label>Trip Name</label>
                            <input type="text" name="tripName" value="<?= htmlspecialchars($data['trip']->tripName) ?>" readonly>
                        </div>
                        <div>
                            <label>Starting Location</label>
                            <input type="text" name="startLocation" id="startLocation" value="<?= htmlspecialchars($data['trip']->startingLocation) ?>" readonly>
                        </div>
                        <div>
                            <label>Main Destination</label>
                            <input type="text" name="destination" id="destination" value="<?= htmlspecialchars($data['trip']->destination) ?>" readonly>
                        </div>
                    </div>

                    <div class="preferences-Container">
                        <h2>Travel Preferences</h2>

                        <div class="rowContainerIn-preferences-Container">
                            <div>
                                <label>Start Date</label>
                                <input type="date" name="startDate" value="<?= $data['trip']->startDate ?>" readonly>
                            </div>
                            <div>
                                <label>End Date</label>
                                <input type="date" name="endDate" value="<?= $data['trip']->endDate ?>" readonly>
                            </div>
                        </div>

                        <div class="rowContainerIn-preferences-Container">
                            <div>
                                <label>Preferred Departure Time</label>
                                <input type="time" name="departureTime" value="<?= $data['trip']->departureTime ?>" readonly style="padding: 0.9rem;">
                            </div>

                            <div>
                                <label>Mode of Transportation</label>
                                <input type = "text" name = "transportation" value = "<?= $data['trip']->transportationMode ?>" readonly style = "padding: 0.9rem;">
                            </div>
                        </div>

                        <div class="rowContainerIn-preferences-Container">
                            <div>
                                <label>Number of Travelers</label>
                                <input type="number" name="travelersCount" value="<?= $data['trip']->numberOfTravelers ?? '' ?>" readonly>
                            </div>

                            <div>
                                <label>Budget per Person</label>
                                <input type="number" name="budgetPerPerson" value="<?= $data['trip']->budgetPerPerson ?? '' ?>" readonly>
                            </div>
                        </div>
                        
                    </div>

                </div>

                <div class="itinerary-container">
                    <span class="topic">Your Itinerary</span>

                    <div class="day-tabs">
                        <?php foreach($data['tripDays'] as $index => $tripDay): ?>

                            <button type="button" 
                                    class="day-tab <?php echo $index === 0 ? 'active' : ''; ?>" 
                                    data-day="<?php echo $tripDay->day_number; ?>">
                                Day <?php echo $tripDay->day_number; ?>
                            </button>

                        <?php endforeach; ?>

                    </div>

                    <?php foreach($data['tripDays'] as $index => $tripDay): ?>
                        <div id="day<?php echo $tripDay->day_number; ?>" 
                             class="day-content <?php echo $index === 0 ? 'active' : ''; ?>">
            
                            <?php 
                                // Get places for this specific day using day_Id
                                $dayPlaces = $data['allTripPlaces'][$tripDay->day_Id] ?? [];
            
                                if (!empty($dayPlaces)): 
                                    foreach($dayPlaces as $place): 
                            ?>
                            <ul type="none" class="timeline">
                                <div class="iteneraryItemRow" style="display: flex; gap: 5rem; width: 100%;">
                                    <li class="timeline-item" style="width: 45%;">
                                        <div style = "display: flex;">
                                            <i class="fa fa-clock"></i>
                                            <strong><?php echo $place->arrival_time; ?></strong> &nbsp;-
                                        </div>
                                        <div style = "padding-left: 1rem;">
                                            Arriving to <span style = "font-weight: 550;"><?php echo $place->place_name; ?></span>
                                        </div>
                                    </li>

                                    <li class="timeline-item" style="width: 45%;">
                                        <div style = "display: flex;">
                                            <i class="fa fa-clock"></i>
                                            <strong><?php echo $place->departure_time; ?></strong> &nbsp;-
                                        </div>
                                        <div style = "padding-left: 1rem;">
                                            Leaving from <span style = "font-weight: 550;"><?php echo $place->place_name; ?></span>
                                        </div>
                                    </li>
                                </div>
                            </ul>
                        <?php endforeach;
                              endif;
                        ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                         
            </div>

            <div id = "editControls" class="edit-controls" style="display: none;">
                <button type="submit" class="save-btn">Save Changes</button>
                <button type="button" class="cancel-btn" id="cancelEdit">Discard Changes</button>
            </div>

        </form>
    </section>

    <!--Pop up model to add collaboartors to the trip-->
    <div id = "inviteModal" class="modal">
        <div class="modal-content">

            <div class = "inviteHeadingHolder">
                Invite Friends to Collaborate <span class="close">&times;</span>
            </div>
            
            <form id = "inviteForm" name = "inviteForm" method = "POST" action = "<?= ROOT ?>/traveler/MyTrips/addCollaborator/<?= $data['trip']->trip_Id ?>">

                <div class="invite-input-group">
                    <input type="email" id = "friendEmail" name = "friendEmail" placeholder="Enter friend's email">
                    <select id = "role" name = "role">
                        <option disabled selected value = "">Select Access Permission</option>
                        <option value="editor">View Only</option>
                        <option value="viewer">View and Edit</option>
                    </select>
                </div>

                <button type = "submit" class = "invite-submit-btn">Send Invitation</button>

            </form>

            <!-- Current Collaborators List -->
            <div class="collaborators-list">

                <span>Current Collaborators</span>
                <?php 
                    if(empty($data['collaborators'])){
                        echo '<ul id="collaboratorsList">
                                <div id="emptyCollaborators" class="empty-state">
                                    <i class="fa-solid fa-users-slash"></i>
                                    <p>No collaborators added yet</p>
                                    <span>Invite friends to plan this trip together!</span>
                                </div>
                            </ul>
                        ';
                    }
                    else if(!empty($data['collaborators'])){
                        echo '<ul id="collaboratorsList">';
                        foreach($data['collaborators'] as $collaborator){
                            echo '<li class="collaborator-item">
                                    <div class="collaborator-info">
                                        <i class="fa-solid fa-user"></i>
                                        <span style = "font-size: 1.5rem; font-weight: 300;">' . $collaborator['collaboratorsProfiles']->travelerEmail . '</span>
                                        <span class="status-badge status-'. $collaborator['collaboratorPermissions']->request_status .'" style = "font-size: 1.4rem;">
                                            '. $collaborator['collaboratorPermissions']->request_status .'
                                        </span>
                                    </div>
                            
                                    <div class="collaborator-role" style = "font-size: 1.5rem;">
                                       '. $collaborator['collaboratorPermissions']->role .'
                                    </div>
                                </li>
                            ';
                        }
                    }
                ?>

            </div>

        </div>

    </div>

    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-text"></p>
            <button id="closePopup">OK</button>
        </div>
    </div>

     <!--Script to handle collaborators to the trip-->
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const inviteBtn = document.getElementById('inviteBtn');
            const inviteModal = document.getElementById('inviteModal');
            const closeBtn = document.querySelector('.close');
            const inviteForm = document.getElementById('inviteForm');

            // Open modal
            inviteBtn.onclick = function() {
                inviteModal.style.display = "block";
                loadCollaborators();
            }

            // Close modal
            closeBtn.onclick = function() {
                inviteModal.style.display = "none";
            }

            // Close when clicking outside
            window.onclick = function(event) {
                if (event.target == inviteModal) {
                    inviteModal.style.display = "none";
                }
            }

            // Load current collaborators
            async function loadCollaborators() {
                const tripId = getTripIdFromUrl();
                const list = document.getElementById('collaboratorsList');
        
                try {
                    const response = await fetch(`${ROOT}/traveler/MyTrips/getCollaborators/${tripId}`);
                    const collaborators = await response.json();
            
                    list.innerHTML = collaborators.map(collaborator => `
                        <li class="collaborator-item">
                            <div class="collaborator-info">
                                <i class="fa-solid fa-user"></i>
                                <span>${collaborator.email}</span>
                                <span class="status-badge status-${collaborator.status}">
                                    ${collaborator.status}
                                </span>
                            </div>
                            <div class="collaborator-role">
                                ${collaborator.role}
                            </div>
                        </li>
                    `).join('');
                } 
                catch (error) {
                    console.error('Failed to load collaborators:', error);
                }
            }

            function showNotification(message, type) {
                // Implement your notification system here
            }

            function getTripIdFromUrl() {
                // Extract trip ID from current URL
                const pathParts = window.location.pathname.split('/');
                return pathParts[pathParts.length - 1];
            }
        });
    </script>

    <script>
        function showPopup(message) {
            const popup = document.getElementById("popup");
            const popupText = document.getElementById("popup-text");
            const container = document.querySelector("#main");
    
            popupText.innerHTML = message;
    
            // Show the pop-up
            popup.style.display = "flex";
    
            // Blur the background
            container.classList.add("blur");
    
            // Remove any existing listeners to prevent multiple bindings
            const closePopup = document.getElementById("closePopup");

            closePopup.onclick = function() {
                // Hide the pop-up
                popup.style.display = "none";
        
                // Remove the blur effect
                container.classList.remove("blur");
            };

        }

    </script>

    <!-- Below script is for displaying success or error messages, after inviting collaborators to the trip -->
    <script>
        // Create a PHP variable containing the message
        <?php 
            $messageToShow = '';
            if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                $messageToShow = implode(', ', $_SESSION['errors']);
                unset($_SESSION['errors']);
            }
            else if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                $messageToShow = implode(', ', $_SESSION['success']);
                unset($_SESSION['success']); 
            }
        ?>

        // passing the PHP message to JavaScript
        const serverMessage = <?= json_encode($messageToShow) ?>;
    
        // Show popup if there's a message
        if (serverMessage) {
            showPopup(serverMessage);
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all day tabs
            const dayTabs = document.querySelectorAll('.day-tab');
    
            // Add click event listener to each tab
            dayTabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    // Prevent default button behavior
                    e.preventDefault();
            
                    // Get the day number from data attribute
                    const dayNumber = this.getAttribute('data-day');
            
                    // Remove active class from all tabs and contents
                    document.querySelectorAll('.day-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.day-content').forEach(c => c.classList.remove('active'));
            
                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    document.getElementById('day' + dayNumber).classList.add('active');
                });
            });
        });
    </script>

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            const editButton = document.getElementById('editToggle');
            const editControls = document.getElementById('editControls');
            const cancelButton = document.getElementById('cancelEdit');
            const form = document.getElementById('tripEditForm');
            let autocompleteStartLocation, autocompleteDestination;

            // Check if we should start in edit mode
            const urlParams = new URLSearchParams(window.location.search);
            const startInEditMode = urlParams.get('edit') === 'true';

            // Function to enable edit mode
            function enableEditMode() {
                const inputs = document.querySelectorAll('input, select');
                const container = document.querySelector('#main');

                inputs.forEach(input => {
                    input.removeAttribute('readonly');
                });

                container.classList.add('edit-mode');
                editControls.style.display = 'flex';
                editButton.style.display = 'none';

                initializeAutocomplete();
            }

            // Function to initialize autocomplete
            function initializeAutocomplete() {
                const startLocationInput = document.getElementById('startLocation');
                const destinationInput = document.getElementById('destination');
        
                // Remove existing listeners if any
                if (autocompleteStartLocation) {
                    google.maps.event.clearInstanceListeners(startLocationInput);
                }
                if (autocompleteDestination) {
                    google.maps.event.clearInstanceListeners(destinationInput);
                }

                const options = {
                    componentRestrictions: {
                        country: 'LK'
                    }
                };

                // Create new autocomplete instances
                autocompleteStartLocation = new google.maps.places.Autocomplete(startLocationInput, options);
                autocompleteDestination = new google.maps.places.Autocomplete(destinationInput, options);

                // Optional: Handle place selection
                autocompleteStartLocation.addListener('place_changed', function() {
                    const place = autocompleteStartLocation.getPlace();
                    if (place.geometry) {
                        startLocationInput.value = place.formatted_address;
                    }
                });

                autocompleteDestination.addListener('place_changed', function() {
                    const place = autocompleteDestination.getPlace();
                    if (place.geometry) {
                        destinationInput.value = place.formatted_address;
                    }
                });
            }

            // If edit=true in URL, automatically enable edit mode
            if (startInEditMode) {
                enableEditMode();
            }

            // Edit button click handler now uses the same enableEditMode function
            editButton.addEventListener('click', enableEditMode);

            // Handle cancel
            cancelButton.addEventListener('click', function() {
                location.href = location.pathname; // Removes the ?edit=true parameter
            });

            // Handle form submission
            form.addEventListener('submit', function(e) {
                editButton.style.display = 'block';
                editControls.style.display = 'none';
            });
        });

        // InitMap function to handle both viewing and editing modes
        function initMap() {
            const startLocation = document.getElementById('startLocation').value;
            const destination = document.getElementById('destination').value;

            const map = new google.maps.Map(document.getElementById('map-Holder'), {
                center: { lat: 7.8731, lng: 80.7718 },
                zoom: 8
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            if (startLocation && destination) {
                calculateAndDisplayRoute(directionsService, directionsRenderer, startLocation, destination);
            }
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING
                },
                (result, status) => {
                    if (status === 'OK') {
                        directionsRenderer.setDirections(result);
                    } else {
                        console.error('Error calculating route:', status);
                    }
                }
            );
        }

        window.onload = initMap;

    </script>

    


   
    
</body>

</html>

