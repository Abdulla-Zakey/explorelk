<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/navbar.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/rentaCar.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Rent a Car</title>
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
            Rent the Perfect Car for Your Dream Itenary
        </h1>

        <div class = "container">

            <!-- <div class = "btnHolder">

                <div class = "button">
                    Self Drive
                </div>

                <div class = "button">
                    With Driver
                </div>

            </div> -->

            <div class = "form-container">
                <form name = "searchaCar" method = "POST" onsubmit="redirectToResults(event)">

                    <div class = "longInputs">
                        Vehicle Type:<br>
                        <select required>
                            <option value="" disabled selected>Select the vehicle type</option>
                            <option value="car">Economy Cars</option>
                            <option value="luxuryCars">Luxury Cars</option>
                            <option value="miniVans">Mini Vans</option>
                            <option value="suvs">SUVs</option>
                            <option value="vans">Vans</option>
                        </select>
    
                    </div>


                    <div class = "longInputs">
                        Pickup Location:<br>
                        <input type = "text" id = "pickupLocation" name = "pickupLocation" required>
                    </div>

                    <div class = "longInputs">
                        Return Location:<br>
                        <input type = "text" id = "returnLocation" name = "returnLocation" required>
                    </div>

                    
                    <div class = "shortInputs-container">
                        <div class = "shortInput">
                            Pickup Date:<br>
                            <input type = "date" name = "pickupDate" required>
                        </div>

                        <div class = "shortInput">
                            Time:<br>
                            <input type = "time" name = "pickupTime" required>
                        </div>

                        <div class = "mediumInputs">
                            Return Date:<br>
                            <input type = "date" name = "returnDate" required>
                        </div>

                        <!-- <div class = "shortInput">
                            Return Date:<br>
                            <input type = "date" name = "returnDate" required>
                        </div>

                        <div class = "shortInput">
                            Time:<br>
                            <input type = "time" name = "returnTime">
                        </div> -->
                    </div>

                    <div class = "searchBtnContainer">
                        <input type = "submit" value = "Search" name = "search">
                    </div>
                </form>
            </div>

        </div>

    </section>

    <script>
        function redirectToResults(event) {
            event.preventDefault();  // Prevent the form from submitting
            window.location.href = "carSearchResult.html";  // Redirect to the search result page
        }
    </script>

    <!-- <script>
        function initAutocomplete() {
            var pickupInput = document.getElementById('pickupLocation');
            var returnInput = document.getElementById('returnLocation');
            var autocompletePickup = new google.maps.places.Autocomplete(pickupInput);
            var autocompleteReturn = new google.maps.places.Autocomplete(returnInput);
        }
        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script> -->

    <script>
        function initAutocomplete() {
            var pickupInput = document.getElementById('pickupLocation');
            var returnInput = document.getElementById('returnLocation');
            
            // Restrict to Sri Lanka (country code 'LK')
            var options = {
                componentRestrictions: { country: 'LK' }
            };

            // Create autocomplete objects and apply the restriction
            var autocompletePickup = new google.maps.places.Autocomplete(pickupInput, options);
            var autocompleteReturn = new google.maps.places.Autocomplete(returnInput, options);
        }
        
        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>
</body>
</html>