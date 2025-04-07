<?php
    // Assuming $data contains the passed information
    $district_id = $data['district_id'] ?? null;
    $attraction = $data['attraction'] ?? null;
    $attractionPictures = $data['attractionPictures'] ?? [];
    $thingsToDo = $data['thingsToDo'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/viewAttractionsDetails.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | <?= htmlspecialchars($data['attraction']->attraction_name) ?> </title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places"></script>
</head>
<body>

    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a  href="<?= ROOT ?>/traveler/ParticularDistrict/index/<?= $district_id ?>">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <ul class="nav-links">
                <li><a href = "<?= ROOT ?>/traveler/RegisteredTravelerHome">Home</a></li>
                <li><a href = "<?= ROOT ?>/traveler/FindAHotel" target = "_blank">Find a Hotel</a></li>
                <li><a href = "<?= ROOT ?>/traveler/RentACar" target = "_blank">Rent a Car</a></li>
                <li><a href = "#">Restaurants</a></li>
                <li><a href = "#">Join a Tour</a></li>
                <li><a href = "<?= ROOT ?>/traveler/ViewAllEvents" target = "_blank">Upcoming Events</a></li>
            </ul>

        </nav>
    </header>

    <section id = "main">
        <h1>
            <?php
                echo htmlspecialchars($attraction->attraction_name ?? '');
            ?>
            
        </h1>
        
        <div class = "row">
            <div class="infoText">
                
                <?php 
                    // Use attraction descriptions if available, otherwise use existing text
                    if ($attraction) {

                        echo htmlspecialchars($attraction->description_paragraph1 ?? '');
                        echo '<br><br>';

                        echo htmlspecialchars($attraction->description_paragraph2 ?? '');
                        echo '<br><br>';

                        echo htmlspecialchars($attraction->description_paragraph3 ?? '');

                    } 
                    else {
                        // Fallback to existing text
                        echo 'Oops something went wrong! Could not retrieve, about the place from the Database. Please try again in a while!';
                    }
                ?>

            </div>

            <div class = "mapHolder">

                <?php 
                    // Use iframe from attraction if available
                    if ($attraction && !empty($attraction->iframe)) {
                        // Wrap the link in a full iframe tag
                        echo '<iframe 
                            id = "directionsMap"
                            width="600" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>';

                        echo '<input type = "hidden" id = "destinationName" value="' . htmlspecialchars($attraction->attraction_name . ', Sri Lanka') . '">';
                        
                    } else {
                        // Fallback to existing map
                        echo 'Destination Direction Info is Missing';
                    }
                ?>
                
            </div>
        </div>
        
    </section>

    <section class = "gallery-container">
        <div class = "slider-wrapper">
            <div class = "slider">

                <?php 
                    // Use dynamic images if available
                    if (!empty($attractionPictures)) {
                        foreach ($attractionPictures as $index => $pic) {
                            $id = "slide" . ($index + 1);
                            // Prepend ROOT to the image location
                            echo '<img id="' . $id . '" src="' . ROOT . '/' . htmlspecialchars($pic->image_location) . '">';
                        }
                    } else {
                        // Fallback to existing images
                        echo '<img id="slide1" src="' . ROOT . '/assets/images/travelers/nuwaraEliya/gregorLake/Image5.jpg">';
                        // ... other image fallbacks
                    }
                ?>
                
                <div class = "slider-nav">
                
                    <?php 
                        // Generate navigation links dynamically
                        for ($i = 0; $i < count($attractionPictures); $i++) {
                            echo '<a href="#slide' . ($i + 1) . '"></a>';
                        }
                    ?>

                </div>
                
            </div>

        </div>
    </section>

    <section id = "thingsToDo">
        <h1>

            <?php
                echo "Things to Do at " . htmlspecialchars($attraction->attraction_name ?? '');
            ?>
            
        </h1>
        <div class = "todo-container">

            <?php 
                // Use dynamic things to do if available
                if (!empty($thingsToDo)) {
                    
                    
                    foreach ($thingsToDo as $index => $todo) {
                        $todoId = "todo" . ($index + 1);
                        echo '<div id="' . $todoId . '">';
                        echo '  <div class="activityType">';
                        echo '    <i class="' . htmlspecialchars($todo->icon_class) . '"></i> ' . htmlspecialchars($todo->activity_name) . ':';
                        echo '  </div>';
                        echo '  <div class="activity">';
                        echo     htmlspecialchars($todo->activity_description);
                        echo '  </div>';
                        echo '</div>';

                    }

                } else {
                    // Fallback to existing things to do
                    // ... existing HTML for things to do
                }
            ?>

        </div>

    </section>

    <script>

        // Get the destination name from the hidden input
        const destinationName = document.getElementById('destinationName').value;

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const mapFrame = document.getElementById('directionsMap');
                
                mapFrame.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&origin=${latitude},${longitude}&destination=${encodeURIComponent(destinationName)}&mode=driving`;
            },
            (error) => {
                alert('Unable to retrieve your location. Please check your settings.');
                // Fallback to just showing the destination without directions
                
                const mapFrame = document.getElementById('directionsMap');
                mapFrame.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&q=${encodeURIComponent(destinationName)}`;
        
            }
        );

    </script>


    
</body>
</html>