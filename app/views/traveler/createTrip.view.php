<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/createTrip.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Create Trip</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&libraries=places"></script>

    <style>
        .errors{
            color: red;
            font-size: 1.2rem;
        }

        label{
            color: black;
            font-size: 1.6rem;
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

        </nav>
    </header>

    <section id="main">
        <h1>
            Create a New Trip
        </h1>

        <div class="main-Container">

            <div class="form-container">
                <form name="createTrip" method="POST">

                    <div class="longInputs">

                        <div class = "errors">
                            <label>Trip Name</label>
                            <?php echo "\t" . (isset($errors['tripName']) ? "*" . $errors['tripName'] : ''); ?>
                            
                        </div>
                        <input type="text" name="tripName" id="tripName" placeholder="Eg. Winter Vacation" required>

                    </div>


                    <div class="longInputs">
                        <div class = "errors">
                            <label>Starting Location</label>
                            <?php echo "\t" . (isset($errors['startingLocation']) ? "*" . $errors['startingLocation'] : ''); ?>
                            
                        </div>
                        
                        <input type="text" name="startLocation" id="startLocation" placeholder="Eg. Colombo" required>
                    </div>

                    <div class="longInputs">
                        <div class = "errors">
                            <label>Main Destination</label>
                            <?php echo "\t" . (isset($errors['destination']) ? "*" . $errors['destination'] : ''); ?>
                            
                        </div>
                        
                        <input type="text" name="destination" id="destination" placeholder="Eg. Nuwara Eliya" required>
                    </div>


                    <div class="longInputs" style="display: flex;">

                        <div class="leftMediumInput-Conatiner">
                            <div class = "errors">
                                <label>Start Date</label>
                                <?php echo "\t" . (isset($errors['startDate']) ? "*" . $errors['startDate'] : ''); ?>
                                
                            </div>
                            
                            <input type="date" name="startDate" id="startDate" required>
                        </div>

                        <div class="rightMediumInput-Conatiner">
                            <div class = "errors">
                                <label>End Date</label>
                                <?php echo "\t" . (isset($errors['endDate']) ? "*" . $errors['endDate'] : ''); ?>
                                
                            </div>
                            
                            <input type="date" name="endDate" id="endDate" required>
                        </div>

                    </div>

                    <div class="longInputs" style="display: flex;">

                        <div class="leftMediumInput-Conatiner">
                            <label>Preferred Departure Time</label>
                            <input type="time" name="departureTime" id="departureTime" required>
                        </div>

                        <div class="rightMediumInput-Conatiner">
                            <label>Mode of Transportation:</label>
                            <select name="transportation" id="transportation" required>
                                <option value = "" disabled selected>Select Your Mode of Travel</option>
                                <option>Car</option>
                                <option>Van</option>
                                <option>Bus</option>
                                <option>Train</option>
                            </select>
                        </div>

                    </div>

                    <div class="longInputs" style="display: flex;">

                        <div class="leftMediumInput-Conatiner">
                            <div class = "errors">
                                <label>Number of Travelers</label>
                                <?php echo "\t" . (isset($errors['numberOfTravelers']) ? "*" . $errors['numberOfTravelers'] : ''); ?>
                                
                            </div>
                            
                            <input type="number" name="travelersCount" id="travelersCount" placeholder="Eg. 5">
                        </div>

                        <div class="rightMediumInput-Conatiner">
                            <div class = "errors">
                                <label>Budget per Person</label>
                                <?php echo "\t" . (isset($errors['budgetPerPerson']) ? "*" . $errors['budgetPerPerson'] : ''); ?>
                                
                            </div>
                            
                            <input type="number" name="budgetPerPerson" id="budgetPerPerson" placeholder="Eg. 25000">
                        </div>

                    </div>

                     <div class="longInputs">
                        <label>
                            Itenerary
                        </label>
                        <div class="itenerary-Conatiner">
                            <h3>
                                Day 1
                            </h3>
                            <label>
                                Place to visit
                            </label>
                            <input type = "text" name = "day1Place1" id = "day1Place1" class = "placeToVisit" placeholder = "Eg. Horton Plains National Park & World's End">

                            <div class="placeAndActivity-Container">

                                <div class="leftMediumInput-Conatiner">
                                    <label>Expected arrival time</label>
                                    <input type = "time" name = "day1Place1ArrivalTime" id = "day1Place1ArrivalTime">
                                </div>

                                <div class="rightMediumInput-Conatiner">
                                    <label>Expected departure time</label>
                                    <input type = "time" name = "day1Place1DepartureTime" id = "day1Place1DepartureTime">
                                </div>
                            </div>

                            <button class = "btn" id = "addNewPlaceBtn" style = "background-color: #008080;">
                                Add another Place and Time
                            </button>

                        </div>

                    </div>

                    <div class="longInputs">
                        <button class="btn" id="addNewDayBtn" style="background-color:  #1A7F88;">
                            Add Another Day
                        </button>

                        <button class="btn" id="createTripBtn" style="background-color: #2E8B57">
                            Create Trip
                        </button>

                    </div>

                </form>
            </div>

        </div>

    </section>

    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-text"></p>
            <button id="closePopup">OK</button>
        </div>
    </div>

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

    <script>
        function initAutocomplete() {
            var startLocationInput = document.getElementById('startLocation');
            var destinationInput = document.getElementById('destination');
            var placeToVisitInputs = document.querySelectorAll('.placeToVisit');

            // Restrict to Sri Lanka (country code 'LK')
            var options = {
                componentRestrictions: {
                    country: 'LK'
                }
            };

            // Create autocomplete objects and apply the restriction
            var autocompletePickup = new google.maps.places.Autocomplete(destinationInput, options);
            var autocompleteStartLocation = new google.maps.places.Autocomplete(startLocationInput, options);
            
            // Create autocomplete for each place to visit input
            placeToVisitInputs.forEach(input => {
                new google.maps.places.Autocomplete(input, options);
            });
        }

        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>

    <script>
        // Counter to track places per day
        const daysWithPlaces = new Map();

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize listeners for date inputs
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');

            // Add listeners to prevent default Enter key behavior
            const placeInputs = document.querySelectorAll('.placeToVisit, input[type="text"], input[type="time"], input[type="number"]');
            placeInputs.forEach(input => {
                input.addEventListener('keydown', function(event) {
                    // Prevent form submission or adding new place on Enter key
                    if (event.key === 'Enter') {
                        event.preventDefault();
                    }
                });
            });
    
            // Initialize buttons
            const addNewDayBtn = document.getElementById('addNewDayBtn');
            const addNewPlaceBtns = document.querySelectorAll('#addNewPlaceBtn');
    
            // Add listeners for date changes
            startDateInput.addEventListener('change', updateMaxDays);
            endDateInput.addEventListener('change', updateMaxDays);
    
            // Add listeners for add place buttons
            addNewPlaceBtns.forEach(btn => {
                btn.addEventListener('click', handleAddPlace);
            });
    
            // Add listener for add day button
            addNewDayBtn.addEventListener('click', handleAddDay);
    
            // Initialize the places counter for initial days
            document.querySelectorAll('.itenerary-Conatiner').forEach((container, index) => {
                daysWithPlaces.set(index + 1, 1);
            });
        });

        function updateMaxDays() {
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);
    
            if (startDate && endDate && startDate <= endDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        
                // Hide add day button if we've reached the maximum days
                const currentDays = document.querySelectorAll('.itenerary-Conatiner').length;
                const addNewDayBtn = document.getElementById('addNewDayBtn');
        
                if (currentDays >= diffDays) {
                    addNewDayBtn.style.display = 'none';
                } else {
                    addNewDayBtn.style.display = 'block';
                }
            }
        }

        function handleAddPlace(event) {
            event.preventDefault();
    
            const dayContainer = event.target.closest('.itenerary-Conatiner');
            const dayNumber = Array.from(document.querySelectorAll('.itenerary-Conatiner')).indexOf(dayContainer) + 1;
            const currentPlaces = daysWithPlaces.get(dayNumber) || 1;
    
            if (currentPlaces < 5) {
                // Create new place and activity inputs
                const newPlaceActivity = document.createElement('div');
                newPlaceActivity.className = 'itenerary-Container';
                newPlaceActivity.innerHTML = `
                    <label>
                        Place to visit
                    </label>
                    <input type = "text" name = "day${dayNumber}Place${currentPlaces+1}" id = "day${dayNumber}Place${currentPlaces+1}" class = "placeToVisit" placeholder = "Eg. Victoria Park, Nuwara Eliya">

                    <div class="placeAndActivity-Container">
                        <div class="leftMediumInput-Conatiner">
                            <label>Expected arrival time</label>
                            <input type = "time" name = "day${dayNumber}Place${currentPlaces+1}ArrivalTime" id = "day${dayNumber}Place${currentPlaces+1}ArrivalTime">
                        </div>

                        <div class="rightMediumInput-Conatiner">
                            <label>Expected departure time</label>
                            <input type = "time" name = "day${dayNumber}Place${currentPlaces+1}DepartureTime" id = "day${dayNumber}Place${currentPlaces+1}DepartureTime">
                        </div>
                    </div>
                `;
        
                // Insert before the add button
                event.target.insertAdjacentElement('beforebegin', newPlaceActivity);
        
                // Update counter and hide button if limit reached
                daysWithPlaces.set(dayNumber, currentPlaces + 1);
                if (currentPlaces + 1 >= 5) {
                    event.target.style.display = 'none';
                }
        
                // Initialize Google Places Autocomplete for new place input
                const newPlaceInput = newPlaceActivity.querySelector('input[type="text"]');
                newPlaceInput.classList.add('placeToVisit'); // Add the class
                new google.maps.places.Autocomplete(newPlaceInput, {
                    componentRestrictions: { country: 'LK' }
                });
            }

        }

        function handleAddDay(event) {
            event.preventDefault();

            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
    
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);

            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time to start of day for accurate comparison
    
            if (!startDateInput.value || !endDateInput.value) {
                showPopup('Please select both start and end dates first!');
                return;
            }

            if (startDate < today) {
                showPopup('Start date cannot be in the past!');
                return;
            }

            if (startDate > endDate) {
                showPopup('End date must be after start date!');
                return;
            }
    
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            const currentDays = document.querySelectorAll('.itenerary-Conatiner').length;
    
            if (currentDays < diffDays) {
                const newDayNumber = currentDays + 1;
                const newDay = document.createElement('div');
                newDay.className = 'longInputs';
                newDay.innerHTML = `
                    <div class="itenerary-Conatiner">
                        <h3>Day ${newDayNumber}</h3>
                        <label>
                            Place to visit
                        </label>
                        <input type = "text" name = "day${newDayNumber}Place1" id = "day${newDayNumber}" class = "placeToVisit" placeholder = "Eg. Victoria Park, Nuwara Eliya">

                        <div class="placeAndActivity-Container">

                            <div class="leftMediumInput-Conatiner">
                                <label>Expected arrival time</label>
                                <input type = "time" name = "day${newDayNumber}Place1ArrivalTime" id = "day${newDayNumber}Place1ArrivalTime">
                            </div>

                            <div class="rightMediumInput-Conatiner">
                                <label>Expected departure time</label>
                                <input type = "time" name = "day${newDayNumber}Place1DepartureTime" id = "day${newDayNumber}Place1DepartureTime">
                            </div>
                        </div>

                        <button class = "btn" id = "addNewPlaceBtn" style = "background-color: #008080;">
                            Add another Place and Time
                        </button>
                    </div>
                `;
        
                // Insert before the buttons container
                const buttonsContainer = document.querySelector('.longInputs:last-child');
                buttonsContainer.insertAdjacentElement('beforebegin', newDay);
        
                // Initialize counter for new day
                daysWithPlaces.set(newDayNumber, 1);
        
                // Add event listener for new add place button
                const newAddPlaceBtn = newDay.querySelector('#addNewPlaceBtn');
                newAddPlaceBtn.addEventListener('click', handleAddPlace);
        
                // Initialize Google Places Autocomplete for new inputs
                const newPlaceInput = newDay.querySelector('input[type="text"]');
                newPlaceInput.classList.add('placeToVisit'); // Add the class
                new google.maps.places.Autocomplete(newPlaceInput, {
                    componentRestrictions: { country: 'LK' }
                });
        
                // Hide add day button if we've reached the maximum days
                if (newDayNumber >= diffDays) {
                    event.target.style.display = 'none';
                }
            }
        }
    </script>

    <script>

        function updateItineraryDays() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            // Calculate actual number of days in the trip
            const diffTime = Math.abs(endDate - startDate);
            const actualTripDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

            // Get all current itinerary containers
            const itineraryContainers = document.querySelectorAll('.itenerary-Conatiner');

            // Remove excess days
            if (itineraryContainers.length > actualTripDays) {
                for (let i = actualTripDays; i < itineraryContainers.length; i++) {
                    itineraryContainers[i].closest('.longInputs').remove();
                }
            }

            // Show add day button if we haven't reached max days
            const addNewDayBtn = document.getElementById('addNewDayBtn');
            addNewDayBtn.style.display = actualTripDays > itineraryContainers.length ? 'block' : 'none';
        }

        // Add event listener to end date input
        document.getElementById('endDate').addEventListener('change', updateItineraryDays);
    </script>

</body>

</html>