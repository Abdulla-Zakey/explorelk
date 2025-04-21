<?php
    // Dummy Data for Testing
    $district_id = $data['district_id'];
    $attraction = $data['attraction'];
    $thingsToDo = $data['thingsToDo'];
    $attractionPics = $data['attractionPics'];
    // show($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/viewAttraction.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | <?= htmlspecialchars($attraction->attraction_name) ?> </title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places">
    </script>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>

        <div class="main-content">
            <h1><?= htmlspecialchars($attraction->attraction_name) ?></h1>
            <div class="flexContainer">
                <div class="infoText">
                    <?= htmlspecialchars($attraction->description_paragraph1) ?>
                    <br><br>
                    <?= htmlspecialchars($attraction->description_paragraph2) ?>
                    <br><br>
                    <?= htmlspecialchars($attraction->description_paragraph3) ?>
                </div>

                <div class="mapHolder">
                    <iframe id="directionsMap" width="600" height="450" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        src="<?= $attraction->iframe ?>"></iframe>
                </div>
            </div>


            <div class="gallery-container">
                <div class="slider-wrapper">
                    <div class="slider">
                        <?php foreach ($attractionPics as $attractionPic): ?>
                        <img src="<?php echo ROOT . '/' . $attractionPic->image_location ?>" alt="Attraction Image">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="thingsToDo">
                <h2>Things to Do at <?= htmlspecialchars($attraction->attraction_name) ?></h2>
                <div class="todo-container">
                    <?php foreach ($thingsToDo as $todo): ?>
                    <div class="activity-item">
                        <div class="activity-info">
                            <i class="<?= htmlspecialchars($todo->icon_class) ?>"></i>
                            <div class="activity-name"><h4><?= htmlspecialchars($todo->activity_name) ?></h4></div>
                        </div>
                        <div class="activity-description">
                            <?= htmlspecialchars($todo->activity_description) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    const destinationName = "Gregory Lake, Sri Lanka";
    const mapFrame = document.getElementById('directionsMap');
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            mapFrame.src =
                `https://www.google.com/maps/embed/v1/directions?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&origin=${latitude},${longitude}&destination=${encodeURIComponent(destinationName)}&mode=driving`;
        },
        (error) => {
            mapFrame.src =
                `https://www.google.com/maps/embed/v1/place?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&q=${encodeURIComponent(destinationName)}`;
        }
    );
    </script>
</body>

</html>