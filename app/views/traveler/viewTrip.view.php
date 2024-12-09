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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places" async defer></script>
    <style>
        .edit-mode input,
        .edit-mode select {
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .edit-controls {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
            gap: 10px;
        }

        .edit-controls button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .edit-btn {
            background-color: #2196F3;
            width: 125px;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .coverImage-text{
            background: none; 
            border: none; 
            color: white; 
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
        <form id="tripEditForm" action="<?= ROOT ?>/traveler/MyTrips/editTrip/<?= $data['trip']->trip_Id ?>" method="POST">
            <div class="top">
                <div class="imgAndTopic-Container">
                    <h1>
                        <input type="text" name="tripName" style = "font-size: 28px;" class = "coverImage-text" value="<?= htmlspecialchars($data['trip']->tripName) ?>" readonly>
                    </h1>
                    <div class="dateAndLocationInfo-Conatiner">
                        <div style = "display: flex;">
                            <i class="fa-regular fa-calendar" style ="font-size: 18px; margin-top: 3.5px;"></i>
                            <input type="date" name="startDate" class = "coverImage-text" style ="font-size: 14px;" value="<?= $data['trip']->startDate ?>" readonly>
                            
                            <i class="fa-regular fa-calendar" style ="font-size: 18px; margin-top: 3.5px;"></i>
                            <input type="date" name="endDate" class = "coverImage-text" style ="font-size: 14px;" value="<?= $data['trip']->endDate ?>" readonly>
                        </div>
                        <div>
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="text" name="destination" class = "coverImage-text" style ="font-size: 16px;" value="<?= htmlspecialchars($data['trip']->destination) ?>" readonly>
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
                                <select name="transportation" disabled>
                                    <option value="Car" <?= $data['trip']->transportationMode == 'Car' ? 'selected' : '' ?>>Car</option>
                                    <option value="Bus" <?= $data['trip']->transportationMode == 'Bus' ? 'selected' : '' ?>>Bus</option>
                                    <option value="Train" <?= $data['trip']->transportationMode == 'Train' ? 'selected' : '' ?>>Train</option>
                                    <option value="Other" <?= $data['trip']->transportationMode == 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
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

            <div id="editControls" class="edit-controls" style="display: none;">
                <button type="submit" class="save-btn">Save Changes</button>
                <button type="button" class="cancel-btn" id="cancelEdit">Cancel</button>
            </div>
        </form>
    </section>

    <script>
        document.getElementById('editToggle').addEventListener('click', function() {
            const inputs = document.querySelectorAll('input, select');
            const container = document.querySelector('#main');
            const editControls = document.getElementById('editControls');

            inputs.forEach(input => {
                if (input.hasAttribute('readonly')) {
                    input.removeAttribute('readonly');
                    input.removeAttribute('disabled');
                } else {
                    input.setAttribute('readonly', true);
                    input.setAttribute('disabled', true);
                }
            });

            container.classList.toggle('edit-mode');
            editControls.style.display = container.classList.contains('edit-mode') ? 'flex' : 'none';
        });

        document.getElementById('cancelEdit').addEventListener('click', function() {
            // Reset form to original values
            location.reload();
        });
    </script>

    <script>
        function initMap() {
            const startLocation = document.getElementById('startLocation').value;
            const destination = document.getElementById('destination').value;

            const map = new google.maps.Map(document.getElementById('map-Holder'), {
                center: {
                    lat: 7.8731,
                    lng: 80.7718
                },
                zoom: 8
            });

            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsRenderer, startLocation, destination);
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
