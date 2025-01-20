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
                            <label>Trip Name:</label>
                            <?php echo "\t" . (isset($errors['tripName']) ? "*" . $errors['tripName'] : ''); ?>
                            
                        </div>
                        <input type="text" name="tripName" id="tripName" placeholder="Eg. Winter Vacation" required>

                    </div>


                    <div class="longInputs">
                        <div class = "errors">
                            <label>Starting Location:</label>
                            <?php echo "\t" . (isset($errors['startingLocation']) ? "*" . $errors['startingLocation'] : ''); ?>
                            
                        </div>
                        
                        <input type="text" name="startLocation" id="startLocation" placeholder="Eg. Colombo" required>
                    </div>

                    <div class="longInputs">
                        <div class = "errors">
                            <label>Destination:</label>
                            <?php echo "\t" . (isset($errors['destination']) ? "*" . $errors['destination'] : ''); ?>
                            
                        </div>
                        
                        <input type="text" name="destination" id="destination" placeholder="Eg. Nuwara Eliya" required>
                    </div>


                    <div class="longInputs" style="display: flex;">

                        <div class="leftMediumInput-Conatiner">
                            <div class = "errors">
                                <label>Start Date:</label>
                                <?php echo "\t" . (isset($errors['startDate']) ? "*" . $errors['startDate'] : ''); ?>
                                
                            </div>
                            
                            <input type="date" name="startDate" id="startDate" required>
                        </div>

                        <div class="rightMediumInput-Conatiner">
                            <div class = "errors">
                                <label>End Date:</label>
                                <?php echo "\t" . (isset($errors['endDate']) ? "*" . $errors['endDate'] : ''); ?>
                                
                            </div>
                            
                            <input type="date" name="endDate" id="endDate" required>
                        </div>

                    </div>

                    <div class="longInputs" style="display: flex;">

                        <div class="leftMediumInput-Conatiner">
                            <label>Preferred Departure Time:</label>
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
                                <label>Number of Travelers:</label>
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

                    <!--  <div class="longInputs">
                        <label>
                            Itenerary
                        </label>
                        <div class="itenerary-Conatiner">
                            <h3>
                                Day 1
                            </h3>
                            <label>
                                Accommodation
                            </label>
                            <input type="text" name="accommadation" id="accommodation" placeholder="Eg. Araliya Green Hills Hotel">

                            <div class="placeAndActivity-Container">

                                <div class="leftMediumInput-Conatiner">
                                    <label>Place to Visit:</label>
                                    <input type="text" name="placeToVisit" id="placeToVisit" placeholder="Eg. Horton Plains National Park">
                                </div>

                                <div class="rightMediumInput-Conatiner">
                                    <label>Expected Activities do There:</label>
                                    <input type="text" name="activity" id="activity" placeholder="Eg. Sightseeing">
                                </div>
                            </div>

                            <button class="btn" id="addNewPlaceBtn" style="background-color: #008080;">
                                Add another Place and Activity
                            </button>

                        </div>

                    </div> -->

                    <div class="longInputs">
                        <!-- <button class="btn" id="addNewDayBtn" style="background-color: #005f6b;">
                            Add Another Day
                        </button> -->

                        <button class="btn" id="createTripBtn" style="background-color: #228B22;">
                            Create Trip
                        </button>

                    </div>



                </form>
            </div>

        </div>

    </section>

    <script>
        function initAutocomplete() {
            var startLocationInput = document.getElementById('startLocation');
            var destinationInput = document.getElementById('destination');
            var accommodationInput = document.getElementById('accommodation');
            var placeToVisitInput = document.getElementById('placeToVisit');

            // Restrict to Sri Lanka (country code 'LK')
            var options = {
                componentRestrictions: {
                    country: 'LK'
                }
            };

            // Create autocomplete objects and apply the restriction
            var autocompletePickup = new google.maps.places.Autocomplete(destinationInput, options);
            var autocompleteStartLocation = new google.maps.places.Autocomplete(startLocationInput, options);
            var autocompleteAccommodation = new google.maps.places.Autocomplete(accommodationInput, options);
            var autocompletePlaceToVisit = new google.maps.places.Autocomplete(placeToVisitInput, options);
        }

        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>

    <script>
        function redirectToResults(event) {
            event.preventDefault(); // Prevent the form from submitting
            window.location.href = "hotelSearchResults.html"; // Redirect to the search result page
        }
    </script>

</body>

</html>