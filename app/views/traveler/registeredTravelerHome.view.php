<?php 
    // var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/registeredUser.css">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/currentlyNoEvents.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Home - Traveler</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        .logo img{
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
    </style>

</head>

<body>
    <?php
        // show($data['eventData']);
        // exit();

    ?>
    <div class="mainContainer">

        <div class="leftPanel">
            <div class="logo">
                <!-- <img src="<?= ROOT ?>/assets/images/logos/logoWhite.svg" alt="Logo"> -->
                <img src="<?= !empty($data['userData']->profilePicture) 
                                ?  ROOT . '/assets/images/Travelers/userProfilePics/' . $data['userData']->profilePicture 
                                : ROOT . '/assets/images/Travelers/userProfilePics/defaultUserIcon.png' ?>" alt="Logo">
                <h1>
                    <!-- ExploreLK -->
                     <?= $data['userData']->username ?> 
                </h1>
            </div>

            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="linkItem" style="color:#002D40 ;"><i class="fa-solid fa-house"></i>Home</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Mytrips" class="linkItem"><i class="fa-solid fa-person-walking-luggage"></i>My Trips</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyBookings" class="linkItem"><i class="fa-solid fa-book-open"></i>My Bookings</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Messages" class="linkItem"><i class="fa-solid fa-message"></i>Messages</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Notifications" class="linkItem">
                    <i class="fa-solid fa-bell"></i>
                    Notifications
                    <?php if(($data['unreadNotifications']) > 0): ?>
                        <span id="notificationCount" class="notificationCountIndicator">
                            <?= $data['unreadNotifications'] ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/ViewProfile" class="linkItem"><i class="fa-solid fa-user"></i>View Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/EditProfile" class="linkItem"><i class="fa-solid fa-user-pen"></i></i>Edit Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>


        </div>

        <div class="rightContainer">
            <h1>
                <?php echo "Welcome back, " . htmlspecialchars($data['userData']->username) . "! Ready for your next adventure?";?>
            </h1>
            <div class="contentContainer">
                <h2>
                    Your Next Dream Adventure Awaits
                </h2>
                <p class = "subHead">
                    We’ve picked some amazing places for you to explore. Curious for more? Let’s keep going!
                </p>
                <div class="imageContainer">

                    <div class="leftImg">

                        <a href="<?= ROOT ?>/traveler/ParticularDistrict/index/9">
                            <img src="<?= ROOT ?>/assets/images/travelers/dashboard/nuwaraEliya.jpg">
                            <p>
                                Nuwara Eliya
                            </p>
                        </a>

                    </div>

                    <div class="midImg">
                        <a href = "<?= ROOT ?>/traveler/ParticularDistrict/index/1">
                            <img src="<?= ROOT ?>/assets/images/travelers/dashboard/anuradhapura.jpg">
                            <p>
                                Anuradhapura
                            </p>
                        </a>
                    </div>

                    <div class="rightImg">
                        <a href = "<?= ROOT ?>/traveler/ParticularDistrict/index/2">
                            <img src="<?= ROOT ?>/assets/images/travelers/dashboard/badhulla.png">
                            <p>
                                Badhulla
                            </p>
                        </a>
                        
                    </div>

                </div>

                <a href="<?= ROOT ?>/traveler/TopDistricts">
                    <button class="btn">See More</button>
                </a>


            </div>

            <div class="contentContainer">
                <h2>
                    Exciting Tours Just for You
                </h2>
                <p class = "subHead">
                    Join expert-led adventures and discover hidden gems across Sri Lanka. Find the perfect tour for your next journey!
                </p>
                <div class="imageContainer">

                    <div class="leftImg">

                        <a href = "<?= ROOT ?>/traveler/ViewParticularTour">
                            <img src="<?= ROOT ?>/assets/images/travelers/dashboard/guidedNatureHikes.jpg">
                            <p>
                                Ella Adventure
                            </p>
                        </a>

                    </div>

                    <div class="midImg">
                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/waterfallExploration.png">
                        <p>
                            Splash of Adventure
                        </p>
                    </div>

                    <div class="rightImg">
                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/sigiriyaTrip.jpg">
                        <p>
                            Conquer Sigiriya
                        </p>
                    </div>

                </div>

                <button class="btn">See More</button>

            </div>

            <div class="contentContainer">
                <h2>
                    Exciting Events Coming Up!
                </h2>
                
                <?php
                    if(!empty($data['eventData'])){
                        $counter = 0;
                        
                        foreach($data['eventData'] as $event){
                            if($counter % 3 == 0){
                                echo '<p class = "subHead">Join exclusive experiences organized just for you by local experts</p>';
                                echo '<div class="imageContainer">';
                            }
                ?>
                            <div class="<?= ($counter % 3 == 0) ? 'leftImg' : (($counter % 3 == 1) ? 'midImg' : 'rightImg') ?>">    
                                <a href = "<?= ROOT ?>/traveler/ViewParticularEvent/index/<?= $event->event_Id?>">  
                                    <img src="<?= IMAGES ?>/events/eventThumbnailPics/<?= $event->eventThumnailPic?>">
                                    <p>
                                        <?= $event->eventName ?>
                                    </p>
                                </a>
                            </div>
                <?php

                            $counter++;

                            if($counter == count($data['eventData'])){
                                echo '</div>';

                                if($counter % 3 == 0 ){
                                    echo '<a href=" '. ROOT .'/traveler/ViewAllEvents"><button class="btn">See More</button></a>';
                                }

                            }
                            
                        }

                    }else{
                        echo '<div class="no-events-container">';

                            echo '<div class="no-events-content">';

                                echo '<div class="calendar-icon">';
                                    echo '<div class="calendar-top"></div>';
                                    echo '<div class="calendar-body">';
                                        echo '<div class="cross">×</div>';
                                    echo '</div>';
                                echo '</div>';

                                echo '<h3>Currently No Upcoming Events</h3>';
                                echo '<p class = "para">We are working on bringing exciting new experiences your way. Check back soon!</p>';
        
                            echo '</div>';
                        echo '</div>';
                    }
                        
                ?>
                    
            </div>

            <div class="contentContainer">
                <h2>
                    Find Your Home Away from Home!
                </h2>
                <p class = "subHead">
                    Choose from a range of hotels, from budget-friendly stays to luxury resorts.
                </p>
                <div class="imageContainer">

                    <div class="imgOnLeft">

                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/room1.jpg">

                    </div>

                    <div class="imgOnRight">

                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/room2.jpg">

                    </div>

                </div>

                <a href="<?= ROOT ?>/traveler/FindAHotel">
                    <button class="btn">Book Now</button>
                </a>

            </div>

            <div class="contentContainer">
                <h2>
                    Drive Your Adventure!
                </h2>
                <p class = "subHead">
                    Discover your destination at your own pace with our reliable car rentals. Flexible options, great rates!
                </p>
                <div class="imageContainer">

                    <div class="imgOnLeft">

                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/car1.jpg">

                    </div>

                    <div class="imgOnRight">

                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/car2.png">

                    </div>

                </div>

                <a href="<?= ROOT ?>/traveler/RentACar">
                    <button class="btn">Book Now</button>
                </a>

            </div>

        </div>

    </div>
</body>

</html>