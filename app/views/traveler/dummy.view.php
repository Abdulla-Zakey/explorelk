<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/registeredUser.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Home - Traveler</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="mainContainer">
       
        <div class = "fake"></div>

        <div class="leftPanel">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/images/logos/logoWhite.svg" alt="Logo">
                <h1>
                    ExploreLK
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
                <a href="<?= ROOT ?>/traveler/Notifications" class="linkItem"><i class="fa-solid fa-bell"></i>Notifications</a>
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
                Welcome back, ready for another adventure?
            </h1>
            <div class="contentContainer">
                <h2>
                    Your Next Dream Adventure Awaits
                </h2>
                <p>
                    We’ve picked some amazing places for you to explore. Curious for more? Let’s keep going!
                </p>
                <div class="imageContainer">

                    <div class="leftImg">

                        <a href="<?= ROOT ?>/traveler/NuwaraEliya">
                            <img src="<?= ROOT ?>/assets/images/travelers/dashboard/nuwaraEliya.jpg">
                            <p>
                                Nuwara Eliya
                            </p>
                        </a>

                    </div>

                    <div class="midImg">
                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/galle.jpg">
                        <p>
                            Galle
                        </p>
                    </div>

                    <div class="rightImg">
                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/anuradhapura.jpg">
                        <p>
                            Anuradhapura
                        </p>
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
                <p>
                    Join expert-led adventures and discover hidden gems across Sri Lanka. Find the perfect tour for your next journey!
                </p>
                <div class="imageContainer">

                    <div class="leftImg">

                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/guidedNatureHikes.jpg">
                        <p>
                            Ella Adventure
                        </p>

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
                <p>
                    Join exclusive experiences organized just for you by local experts.
                </p>
                <div class="imageContainer">

                    <div class="leftImg">

                        <a href="<?= ROOT ?>/traveler/WhimsicalWonderfest">
                            <img src="<?= ROOT ?>/assets/images/travelers/dashboard/carnival.jpg">
                            <p>
                                Whimsical Wonderfest
                            </p>
                        </a>

                    </div>

                    <div class="midImg">
                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/horseRace.jpg">
                        <p>
                            Thundering Hooves Race
                        </p>
                    </div>

                    <div class="rightImg">
                        <img src="<?= ROOT ?>/assets/images/travelers/dashboard/magicShow.jpg">
                        <p>
                            The Great Magic Extravaganza
                        </p>
                    </div>

                </div>

                <button class="btn">See More</button>

            </div>

            <div class="contentContainer">
                <h2>
                    Find Your Home Away from Home!
                </h2>
                <p>
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
                <p>
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