<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/navbar.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/viewTrip.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | View Trip</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places" async defer></script>
</head>
<body>
    <header>
        <nav class="navbar">

            <div class="backToHome" style="font-size: 1.6rem;">
                <a  href="<?= ROOT ?>/traveler/MyTrips">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

        </nav>
    </header>
    <section id = "main">
        <div class = "top">
            
            <div class = "imgAndTopic-Container">
                <h1>
                    Family Vacation
                </h1>
                <div class = "dateAndLocationInfo-Conatiner">

                    <div>
                        <i class="fa-regular fa-calendar"></i>2024-12-18 to 2024-12-21
                    </div>

                    <div>
                        <i class="fa-solid fa-location-dot"></i>Nuwara Eliya
                    </div>

                </div>
                
            </div>

            <div id = "map-Holder" class = "map-Conatiner">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d506898.08753624174!2d79.99523002633822!3d6.992632706504587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2scolombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae380434e1554c7%3A0x291608404c937d9c!2snuwara%20eliya!3m2!1d6.9497165999999995!2d80.7891068!5e0!3m2!1sen!2slk!4v1731641252540!5m2!1sen!2slk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
            </div>

            

        </div>

        <div class = "outer-Container">
            <div class = "tripDetails-Conatiner">

                <div class = "basicInfo-Container">
                    <h2>
                        Basic Trip Information
                    </h2>
                    <div>
                        <label>
                            Trip Name
                        </label>
                        <input type="text" value="Family Vacation" readonly>
                    </div>
    
                    <div>
                        <label>
                            Starting Location
                        </label>
                        <input type="text" id = "startLocation" value="Colombo" readonly>
                    </div>
    
                    <div>
                        <label>
                            Main Destination
                        </label>
                        <input type="text" id = "destination" value = "NuwaraEliya" readonly>
                    </div>
    
                </div>
    
                <div class = "preferences-Container">
                    <h2>
                        Travel Preferences
                    </h2>
                    <div class = "rowContainerIn-preferences-Container">
                        <div>
                            <label>
                                Start Date
                            </label>
                            <input type = "date" value = "2024-12-18" readonly>
    
                        </div>
    
                        <div>
                            <label>
                                End Date
                            </label>
                            <input type = "date" value = "2024-12-21" readonly>
    
                        </div>
                    </div>
    
                    <div class = "rowContainerIn-preferences-Container">
                        <div>
                            <label>
                                Preferred Departure Time
                            </label>
                            <input type = "time" value = "05:00" readonly style="padding: 0.9rem;">
    
                        </div>
    
                        <div>
                            <label>
                                Mode of Transportation
                            </label>
                            <input type = "text" value = "Van" readonly>
    
                        </div>
                    </div>
    
                    <div class = "rowContainerIn-preferences-Container">
                        <div>
                            <label>
                                Number of Travelers
                            </label>
                            <input type = "number" value = "7" readonly>
    
                        </div>
    
                        <div>
                            <label>
                                Budget per Person
                            </label>
                            <input type = "text" value = "20000" readonly>
    
                        </div>
                    </div>
    
    
    
                </div>
            </div>
    

            <div class = "table-Conatiner">
                <h2>
                    Itinerary
                </h2>
    
                <table class="itinerary-table">
                    <thead>
                        <tr>
                            <th>Day</th>
                            <th>Accommodation</th>
                            <th>Places to Visit</th>
                            <th>Preferred Activities to do there</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Day 01</td>
                            <td>Araliya Green Hills Hotel</td>
                            <td>
                                Nuwara Eliya Post Office<br>
                                Victoria Park<br>
                                Gregory Lake
                            </td>
                            <td>
                                Sightseeing at the Post Office<br>
                                Walking and relaxing in the park<br>
                                Boating, strolling around the lake
                            </td>
                        </tr>
                        <tr>
                            <td>Day 02</td>
                            <td>Araliya Green Hills Hotel</td>
                            <td>
                                Lover's Leap Waterfall<br>
                                Pedro Tea Estate
                            </td>
                            <td>
                                Hiking to the waterfall<br>
                                Tea tour and tasting
                            </td>
                        </tr>
                        <tr>
                            <td>Day 03</td>
                            <td>Early checkout from the hotel</td>
                            <td>Horton Plains National Park</td>
                            <td>Hiking at Horton Plains</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
                
        </div>
        
    </section>


    <script>
        function initMap() {
            const startLocation = document.getElementById('startLocation').value;
            const destination = document.getElementById('destination').value;

            // Initialize the map centered on Sri Lanka
            const map = new google.maps.Map(document.getElementById('map-Holder'), {
                center: { lat: 7.8731, lng: 80.7718 },
                zoom: 8
            });

            // Create directions service and renderer
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Calculate and display the route
            calculateAndDisplayRoute(directionsService, directionsRenderer, startLocation, destination);
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination) {
            directionsService.route(
                {
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

        // Call initMap when the page loads
        window.onload = initMap;
    </script>
    
</body>
</html>