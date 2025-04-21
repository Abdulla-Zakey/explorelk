<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Traveler/navbar.css">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Traveler/index.css">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Traveler/ourServices.css">
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Traveler/footer.css">
    <link rel="icon" href="<?php echo ROOT; ?>/assets/images/logos/logoBlack.svg">

    <title>ExploreLK | Home</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>

        .navbar {
            width: 100vw;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .nav-links li {
            margin: 0 30px;
            width: auto;
        }

        .nav-links a {
            font-size: 1rem;
            font-weight: bold;
        }

        .nav-links .dropdown-content {
            margin-top: 2.5px;
            padding: 0px 10px;
        }
        
        .nav-links .dropdown-content li:hover{
            background-color: darkgray;
            margin: 0px -10px;
            padding-left: 40px;
            padding-right: 40px;
            box-sizing: border-box;
        }

        .login-btn {
            margin-right: 2.5rem;
            padding: 10px 30px;
            font-size: 1rem;
        }

    </style>
    
</head>
<body>
    <header>
        <nav class="navbar">

            <div class="logo">
                <img src="<?php echo ROOT; ?>/assets/images/logos/logoWhite.svg" alt="ExploreLK Logo">
                <span>ExploreLK</span>
            </div>

            <ul class="nav-links">
                <li><a href="<?= ROOT ?>/traveler/Home">Home</a></li>
                <li><a href="#aboutContainer">About Us</a></li>
                <li><a href="<?= ROOT ?>/traveler/TopDistrictsUnreg">Top Destinations</a></li>

                <li class="dropdown">
                    <a href="#">Sign Up <i class="arrow down"></i></a>
                    <ul class="dropdown-content">
                        <li><a href="<?= ROOT ?>/traveler/Signup">Sign Up as a Traveler</a></li>
                        <li><a href="<?= ROOT ?>/signup/TourGuideSignup">Sign Up as a Tour Guide</a></li>
                        <li><a href="<?= ROOT ?>/signup/Signup">Sign Up as a Service Provider</a></li>
                        <li><a href="../eventorganizer/eosignup">Sign Up as an Event Organizer</a></li>
                    </ul>
                </li>

                <li><a href="#footer">Contact Us</a></li>
            </ul>

            <a href="<?= ROOT ?>/traveler/Login">
                <button class="login-btn">Login</button>
            </a>
            
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="overlay">                       <!--By this overlay class i redused the brightness of the background image-->
            <div class="hero-content">
                <h1>Plan Your Perfect Vacation</h1>
                <p>Discover the best destinations, hotels, restaurants, tour guides and many more. <br>
                    Everything you need for a memorable journey is right here. <br>
                    Travel with us and make your dream vacation a reality!
                </p>

                <!-- <div class="search-bar">
                    <input type="text" placeholder="Search a Destination">
                    <button class="search-btn">Search</button>
                </div> -->
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id = "aboutContainer">                                 <!--Start of the section which contain the About Us and the logo-->
        <div class = "aboutUs">                                     <!--Start of the About Us will be on the left handed side of the page-->
            <h1 class = "aboutUs-heading">
                About Us
            </h1>
  
            <p class = "aboutUS-content">
                Welcome to ExploreLK, where every journey becomes an unforgettable adventure! We are not just a tour planning website, 
                we are architects of extraordinary travel experiences, infusing each trip with wonder and excitement. 
                We understand that every voyage is a unique exploration of life, culture, and discovery. 
                Our passion lies in transforming your travel dreams into reality, one destination at a time.
                <br><br>
                We are dedicated to excellence in travel planning. Founded with the belief that every trip deserves to be extraordinary, 
                we bring together a team of expert travel enthusiasts, meticulous planners, and dedicated professionals. 
                Our collective goal is to create travel experiences that leave an indelible mark on your memories.
                <br><br>
                With us, you can effortlessly view detailed information on Sri Lanka's top tourist destinations, renowned restaurants, 
                and book accommodations that suit your preferences. Whether you need a knowledgeable tour guide, reliable vendors, 
                or online tickets for exciting events happening around Sri Lanka, we've got you covered.
                <br><br>
                Join ExploreLK, where you can not only browse pre-built itinerary plans but also craft your own personalized journeys and 
                create memorable group trips. Manage every aspect of your trip seamlessly and embark on an adventure like no other. 
                Let's explore Sri Lanka together and turn every journey into an extraordinary celebration!
                <br>
            </p>
        </div>
  
         <div class = "logo-container">                                <!--Code segment to place the logo on the right side-->
            <img src ="<?php echo ROOT; ?>/assets/images/logos/logoBlack.svg" style="width: 100%;">
        </div>
                
    </section>

    <section id = "ourService">
        <h1>
            Our Services
        </h1>
        <div class = "row">
            <div class = "left">
                <img src="<?php echo ROOT; ?>/assets/images/Travelers/index/travelerIcon.png">
                <h2>
                    Discover the Adventure
                </h2>
    
                <p>
                    Discover the best tourist destinations in Sri Lanka with 
                    ExploreLK. Our user-friendly search feature allows you to 
                    find detailed information about top attractions, hidden gems, 
                    and must-visit places across the island.
                </p>
            </div>

            <div class = "middle">
                <img src="<?php echo ROOT; ?>/assets/images/Travelers/index/hotelIcon.png">
                <h2>
                    Find Your Perfect Stay
                </h2>
    
                <p>
                    Find your perfect stay with ExploreLK's comprehensive 
                    accommodation booking service. Browse a wide range of options, 
                    from luxurious hotels to cozy guesthouses and budget-friendly 
                    hostels, all tailored to fit your travel needs.
                </p>
            </div>

            <div class = "right">
                <img src="<?php echo ROOT; ?>/assets/images/Travelers/index/carIcon.png">
                <h2>
                    Drive Your Adventure
                </h2>
    
                <p>
                    Hit the road with ease using ExploreLK's car rental service. 
                    Choose from a variety of vehicles to suit your travel style and 
                    budget, from compact cars to spacious SUVs and start 
                    exploring the island at your own pace.
                </p>
            </div>
    
        </div>
    
        <div class="row">
            <div class = "left">
                <img src="<?php echo ROOT; ?>/assets/images/Travelers/index/tourGuideIcon.png">
                <h2>
                    Expert Guidance Awaits
                </h2>
    
                <p>
                    Explore Sri Lanka like never before with expert tour guides on ExploreLK. 
                    Our friendly and experienced guides bring the island’s culture, history, and beauty to life and
                    make every moment of your journey unforgettable!
                </p>
            </div>

            <div class = "middle">
                <img src="<?php echo ROOT; ?>/assets/images/Travelers/index/restaurantIcon.png">
                <h2>
                    Savor the Flavors
                </h2>
    
                <p>
                    Delight your taste buds with ExploreLK's restaurant discovery. 
                    Find the best dining spots across Sri Lanka and 
                    browse descriptions, menus, photos, and reviews to choose the perfect place for your next meal.
                </p>
            </div>
        
            <div class = "right">
                <img src="<?php echo ROOT; ?>/assets/images/Travelers/index/eventsIcon.png">
                <h2>
                    Catch the Excitement
                </h2>
    
                <p>
                    Stay in the loop with ExploreLK's event discovery and ticket booking service. 
                    Explore a wide array of ongoing and upcoming events across Sri Lanka, 
                    from cultural festivals and concerts to sporting events and local fairs.
                </p>
            </div>
        </div>
    
    </section>

    <section id = "footer">
        <div class = "footerContainer">

            <div class = "footerLogo-Holder">
                <img src = "<?php echo ROOT; ?>/assets/images/logos/logoWhite.svg">
            </div>

            <div class = "reachUS">
                <h3>
                    Reach Out to Us
                </h3>

                <div class= "iconAndDescription-Holder">

                    <div class="reachUS-iconContainer">
                        <i class="fa-solid fa-phone"></i>
                    </div>

                    <div class="reachUS-description">
                        +94 71 577 0109 | +94 75 674 2490
                    </div>

                </div>
                
                
                <div class= "iconAndDescription-Holder">

                    <div class="reachUS-iconContainer">
                        <i class="fa-solid fa-envelope"></i> 
                    </div>
    
                    <div class="reachUS-description">
                        info@explorelk.com
                    </div>

                </div>
                
                <div class= "iconAndDescription-Holder">

                    <div class="reachUS-iconContainer">
                        <i class="fa-solid fa-location-dot"></i>  
                    </div>
                    
                    <div class="reachUS-description">
                        ExploreLK Headquarters No 123, <br>Paradise Road, Colombo 01, <br>Sri Lanka 
                    </div>

                </div>
                                                                                          
            </div>

            <div class="followUS">
                <h3>
                    Follow Us on Social Media
                </h3>

                <div class="followUS-description">
                    Stay connected and up-to-date with the 
                    latest travel tips, destination highlights, 
                    and special offers.
                </div>

                <a>
                    <i class="fa-brands fa-instagram"></i>
                </a>
                
                <a>
                    <i class="fa-brands fa-facebook"></i>
                </a>
                
                <a>
                    <i class="fa-brands fa-twitter"></i>
                </a>
                
                
            </div>
        </div>
        <div class = "foot">
            &copy; ExploreLK, 2024 | All Rights Reserved
        </div>
    </section>
        
    
</body>
</html>

