<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/navbar.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/findaHotel.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Find a Hotel</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places"></script>
    
</head>
<body>
    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a  href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>

        </nav>
    </header>

    <section id = "main">
        <h1>
            Find Your Perfect Stay
        </h1>

        <div class = "container">

            <div class = "form-container">
                <form name = "findaHotel" method = "POST" onsubmit="redirectToResults(event)">

                    <div class = "longInputs">
                        Accommodation Type:<br>
                        <select required>
                            <option value="" disabled selected>Select the accommodation type</option>
                            <option value="hotels">Hotels</option>
                            <option value="resorts">Resorts</option>
                            <option value="villas">Villas</option>
                        </select>
    
                    </div>


                    <div class = "longInputs">
                        Where are you going:<br>
                        <input type = "text" id = "destination" name = "destination" required>
                    </div>

                    <div class = "mediumInputs-container">
                        <div class = "mediumInputs">
                            Number of Guests:<br>
                            <input type = "text" name = "numOfGuests" required>
                        </div>

                        <div class = "mediumInputs">
                            Number of Days:<br>
                            <input type = "text" name = "numOfDays" required>
                        </div>
                        
                    </div>

                    <div class = "mediumInputs-container">
                        <div class = "mediumInputs">
                            Check-In Date:<br>
                            <input type = "date" name = "check-inDate" required>
                        </div>

                        <div class = "mediumInputs">
                            Check-Out Date:<br>
                            <input type = "date" name = "check-outDate" required>
                        </div>
                        
                    </div>

                    
                    <!-- <div class = "shortInputs-container">
                        <div class = "shortInput">
                            Check-in Date:<br>
                            <input type = "date" name = "check-inDate" required>
                        </div>

                        <div class = "shortInput">
                            Time:<br>
                            <input type = "time" name = "check-inTime" required>
                        </div>

                        <div class = "shortInput">
                            Check-out Date:<br>
                            <input type = "date" name = "check-outDate" required>
                        </div>

                        <div class = "shortInput">
                            Time:<br>
                            <input type = "time" name = "check-outTime">
                        </div>
                    </div> -->

                    <div class = "searchBtnContainer">
                        <input type = "submit" value = "Search" name = "search">
                    </div>
                </form>
            </div>

        </div>

    </section>

    <script>
        function initAutocomplete() {
            var destinationInput = document.getElementById('destination');
            
            
            // Restrict to Sri Lanka (country code 'LK')
            var options = {
                componentRestrictions: { country: 'LK' }
            };

            // Create autocomplete objects and apply the restriction
            var autocompletePickup = new google.maps.places.Autocomplete(destinationInput, options);
        }
        
        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>

    <script>
        function redirectToResults(event) {
            event.preventDefault();  // Prevent the form from submitting
            window.location.href = "hotelSearchResults.html";  // Redirect to the search result page
        }
    </script>

</body>
</html>