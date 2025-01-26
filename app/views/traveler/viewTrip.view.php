<!DOCTYPE html>
<html lang="en">

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

        /* .edit-mode input,
        .edit-mode select {
            border: 1px solid #333;
            border-radius: 10px;
            background-color: #333;
            padding: 5px 10px;
        } */

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

            <button id="editToggle" class="edit-btn">
                <i class="fa-solid fa-edit"></i> Edit Trip
            </button>

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
                                <input type="number" step="0.01" name="budgetPerPerson" value="<?= $data['trip']->budgetPerPerson ?? '' ?>" readonly>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>

            <div id = "editControls" class="edit-controls" style="display: none;">
                <button type="submit" class="save-btn">Save Changes</button>
                <button type="button" class="cancel-btn" id="cancelEdit">Discard Changes</button>
            </div>

        </form>
    </section>

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

