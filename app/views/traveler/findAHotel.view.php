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
    
    <style>
        .searchButton{
            width: 100%;
            padding: 0.75rem;
            box-sizing: border-box;
            color: white;
            background-color: #1E7A8F;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
    
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .searchButton:hover{
            cursor: pointer;
            background-color: #3DA4BF;
            transform: scale(1.05);
        }
    </style>

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
            event.preventDefault();
            console.log("Redirect triggered");

            try {
                const rootUrl = "<?= htmlspecialchars(ROOT, ENT_QUOTES) ?>";
                console.log("Root URL:", rootUrl);
                const redirectUrl = encodeURI(`${rootUrl}/traveler/HotelSearchResults`);
                console.log("Redirect URL:", redirectUrl);
                window.location.href = redirectUrl;
            } catch (error) {
                console.error("Redirect failed:", error);
            }
        }
    </script>

</body>
</html>