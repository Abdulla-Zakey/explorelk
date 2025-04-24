<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/viewParticularDistrict.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | About <?= htmlspecialchars($data['district']->district_name) ?></title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

</head>

<body>

    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/topDistricts">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back </span>
                </a>
            </div>

            <ul class="nav-links">
                <li><a href="<?= ROOT ?>/traveler/RegisteredTravelerHome">Home</a></li>
                <li><a href="<?= ROOT ?>/traveler/FindAHotel" target="_blank">Find a Hotel</a></li>
                <li><a href="<?= ROOT ?>/traveler/RentACar" target="_blank">Rent a Car</a></li>
                <li><a href="#">Restaurants</a></li>
                <li><a href="#">Join a Tour</a></li>
                <li><a href="<?= ROOT ?>/traveler/ViewAllEvents" target="_blank">Upcoming Events</a></li>
            </ul>
        </nav>
    </header>

    <div class="top">
        <div class="placeIntro">
            <h1><?= htmlspecialchars($data['district']->district_name) ?></h1>
            <p><?= htmlspecialchars($data['district']->about_the_district) ?></p>
        </div>

        <div class="gallery-container">
            <div class="slider-wrapper">
                <div class="slider">
                    <?php foreach ($data['gallery_pics'] as $index => $pic): ?>
                        <img id="slide<?= $index + 1 ?>" src="<?= ROOT . '/' . $pic->image_location ?>"
                            alt="District Image">

                    <?php endforeach; ?>

                    <div class="slider-nav">
                        <?php foreach ($data['gallery_pics'] as $index => $pic): ?>
                            <a href="#slide<?= $index + 1 ?>"></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="detailsContainer">
        <h2>Places to Visit</h2>
        <p>Discover the top 3 must visit places in <?= htmlspecialchars($data['district']->district_name) ?>, that we've
            handpicked just for you!</p>

        <div class="imageContainer">
            <?php
            $positions = ['leftImg', 'midImg', 'rightImg'];
            foreach ($data['attractions'] as $index => $attraction):
                $position = $positions[$index];
                ?>
                <div class="<?= $position ?>">
                    <a href="<?= ROOT ?>/traveler/LoadAttractionsDetails/index/<?= $attraction->attraction_name ?>"
                        title="Click here to view more details">
                        <img src="<?= ROOT . '/' . $attraction->image_path ?>"
                            alt="<?= htmlspecialchars($attraction->attraction_name) ?>">
                        <p><?= htmlspecialchars($attraction->attraction_name) ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Keep the hardcoded sections for Places to Stay and Places to Dine-In -->
    <!-- <div class="detailsContainer">
        <h2>Places to Stay</h2>
        <div class="imageContainer">
            <div class="leftImg">
                <a href="<?= ROOT ?>/traveler/ViewParticularHotel/index/18">
                    <img src="<?= IMAGES ?>/travelers/topdistricts/nuwaraEliya/hotels/araliya green hills.jpg">
                    <p>Araliya Green Hills Hotel</p>
                </a>
            </div>
            <div class="midImg">
                <a href="<?= ROOT ?>/traveler/ViewParticularHotel/index/19">
                    <img src="<?= IMAGES ?>/travelers/topdistricts/nuwaraEliya/hotels/GrandHotelNuwaraEliya.jpg">
                    <p>The Grand Hotel - Heritage Grand</p>
                </a>
            </div>
            <div class="rightImg">
                <img src="<?= IMAGES ?>/travelers/topdistricts/nuwaraEliya/hotels/the golden ridge hotel.jpg">
                <p>The Golden Ridge Hotel</p>
            </div>
        </div>
        <button class="btn">See More</button>
    </div> -->

    <div class="detailsContainer">
        <h2>Places to Stay</h2>

        <?php if (empty($data['hotels'] ?? [])): ?>
            <div class="hotel-empty-state">
                <div class="hotel-icon-container">
                    <i class="fa-solid fa-hotel primary-icon"></i>
                    <i class="fa-solid fa-moon secondary-icon"></i>
                </div>
                <h3>Accommodations Coming Soon!</h3>
                <p>
                    We're currently partnering with the best hotels and homestays in 
                    <strong>
                        <?= htmlspecialchars($data['district']->district_name) ?> 
                    </strong>
                    to bring you comfortable and authentic places
                    to stay. Soon you'll be able to browse local accommodations, compare prices, and book directly through our
                    platform with exclusive deals.
                </p>
            </div>

        <?php else: ?>
            <div class="imageContainer" >
                <?php
                $positions = ['leftImg', 'midImg', 'rightImg'];
                $count = 0;
                foreach ($data['hotels'] as $hotel):
                    if ($count >= 3)
                        break;
                    $position = $positions[$count];
                    $count++;
                    ?>
                    <div class="<?= $position ?>">
                        <a href="<?= ROOT ?>/traveler/ViewParticularHotel/index/<?= $hotel->hotel_Id ?>">
                            <img src="<?= ROOT . '/' . $hotel->image_path ?>" alt="<?= htmlspecialchars($hotel->hotelName) ?>">
                            <p><?= htmlspecialchars($hotel->hotelName) ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
                
            </div>
            <?php
                if($count >= 3){
                    echo '
                        <button class="btn">See More</button>
                    ';
                }
            ?>
            
        <?php endif; ?>
    </div>

    <!-- <div class="detailsContainer">
        <h2>Places to Dine-In or Takeaway</h2>
        <div class="imageContainer">
            <div class="leftImg">
                <img src="<?= IMAGES ?>/travelers/topdistricts/nuwaraEliya/restaurants/deSilvaFoodCentre.jpg">
                <p>De Silva Food Centre</p>
            </div>
            <div class="midImg">
                <img src="<?= IMAGES ?>/travelers/topdistricts/nuwaraEliya/restaurants/salmiyaItali.jpg">
                <p>Salmiya Italian Restaurant</p>
            </div>
            <div class="rightImg">
                <img src="<?= IMAGES ?>/travelers/topdistricts/nuwaraEliya/restaurants/themparaduRest.jpg">
                <p>Themparadu</p>
            </div>
        </div>
        <button class="btn">See More</button>
    </div> -->
    <div class="detailsContainer">

        <h2>Places to Dine-In or Takeaway</h2>

        <div class="restaurant-empty-state">
            <div class="restaurant-icon-container">
                <i class="fa-solid fa-utensils primary-icon"></i>
                <i class="fa-solid fa-bell-concierge secondary-icon"></i>
            </div>
            <h3>Curated Dining Experiences Coming Soon!</h3>
            <p>
                We're carefully selecting the finest local restaurants and cafés to enhance your culinary journey through
                <strong>
                    <?= htmlspecialchars($data['district']->district_name) ?> .
                </strong>
            </p>
            <p>
                From authentic Sri Lankan flavors to international cuisine, our team is working to bring you the best
                dining options with verified reviews and exclusive offers.
            </p>
        </div>

    </div>

    <div class="foot">
        &copy; ExploreLK, 2024 | All Rights Reserved
    </div>
</body>

</html>