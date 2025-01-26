<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href = "<?= CSS ?>/Traveler/viewParticularTour.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Tour Name</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        .backToHome,
        .nav-links {
            font-size: 1.6rem;
        }

        .foot {
            font-size: 1.4rem;
        }
    </style>

</head>

<body>

    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

        </nav>
    </header>

    <div class="main-container">

        <div class="hero">

            <div class="hero-left">

                <div class="tourName-conatiner">
                    Ella Adventure <!--Tour Name-->
                </div>

                <div class="tourDescription-container">
                    Immerse yourself in the breathtaking beauty of lush green hills,
                    cascading waterfalls, and serene tea plantations as you explore one of Sri Lanka’s most picturesque
                    destinations.
                    The Ella Adventure tour is designed for nature lovers, thrill-seekers, and anyone looking to escape
                    the ordinary.

                </div>

            </div>

            <div class="hero-right">
                <img src="<?= ROOT ?>/assets/images/travelers/dashboard/guidedNatureHikes.jpg" alt = "Tour Image">
            </div>

        </div>

        <div class="basic-info">
            <div>
                <i class="fa fa-usd" aria-hidden="true"></i>Price per Person: 7500 LKR
            </div>
            <div>
                <i class="fa fa-users" aria-hidden="true"></i> Group Size: 10 - 15 people
            </div>
            <div>
                <i class="fa-regular fa-clock"></i>Duration: 1 day
            </div>

            <button class="bookNow-btn">
                Book Now
            </button>

        </div>

        <div class = "itenaryAndAvailableDates-container">

            <div class="itinerary-conatiner">

                <span class="topic">Tour Itinerary</span>
    
                <ul type="none" class="timeline">
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>6:00 AM</strong> - Pickup from Ella Railway Station
                            <p>Meet your guide and fellow travelers</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>6:30 AM</strong> - Little Adam's Peak Hike
                            <p>Begin your hike to enjoy stunning sunrise views from the top.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>8:30 AM</strong> - Refreshment Break
                            <p>Enjoy a light snack and bottled water provided by your guide.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>9:00 AM </strong> - Visit Nine Arches Bridge
                            <p>Walk to the iconic bridge, one of Sri Lanka's architectural marvels</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>11:30 AM</strong> - Ravana Falls
                            <p>Stop at this majestic waterfall for photos and exploration.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>12:30 PM</strong> - Local Lunch
                            <p>Savor traditional Sri Lankan dishes at a handpicked local restaurant.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>2:00 PM</strong> - Ella Rock Hike
                            <p>Embark on a guided hike to the summit of Ella Rock.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>6:00 PM</strong> - Drop-off at Ella Railway Station
                            <p>End the adventure-packed day with a safe return and Say goodbye to your guide and fellow
                                travelers.</p>
                    </li>
                </ul>
    
            </div>

            <div class = "availableDates-container">

                <div class = "availableDates">
                    <span class="topic">Available Dates</span>

                    <ul type = "none">
                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-07" readonly>
                            </div>
                        </li>
                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-14" readonly>
                            </div>
                        </li>
                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-21" readonly>
                            </div>
                        </li>

                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-28" readonly>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class = "linkToGuideProfile-container">

                    <span class="topic">Other Tours from this Guide</span>

                    <p>
                        This experienced guide has curated a variety of immersive tours to showcase the best of Sri Lanka. 
                    </p>

                    <center>
                        <a href = "<?= ROOT ?>/traveler/ViewTourGuideProfile">
                            <button class = "bookNow-btn" style="width: 60%; margin: auto;">
                                <i class="fa fa-search"></i> View Guide Profile
                            </button>
                        </a>
    
                    </center>
                    
                </div>
            </div>

        </div>

        <div class="inclusionAndexclusion-container">
            <div class='inclusions'>
                <span class="topic">
                    What is Included
                </span>
                <br>

                <ul type="none">
                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Pickup and drop-off from Ella Railway Station in an air-conditioned vehicle.
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Guided hike to Ella Rock, Little Adam’s Peak, Nine Arches Bridge, and Ravana Falls
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Complimentary breakfast/snacks, bottled water, and lunch at a local restaurant
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Sinhala, Tamil and English speaking guide to ensure a seamless and informative experience
                        </div>
                    </li>

                </ul>

            </div>

            <div class="exclusions">
                <span class="topic">
                    What is Excluded
                </span>
                <br>

                <ul type="none">

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Dinner & Alcoholic Beverages are not included
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Optional Activities: Ziplining at Flying Ravana Adventure Park or similar activities.
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Personal Expenses: Souvenirs, additional snacks, or purchases during the tour.
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Insurance: Travel or medical insurance is not provided
                        </div>
                    </li>

                </ul>


            </div>

        </div>

        <!-- <div class = "warning">

            <div class = "heading-container">

                <div style="font-size: 2rem; color: lightcoral;">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                </div>
                <div class = "topic">
                    Important Notice
                </div>
                
            </div>

            <ul type="none">
                <li>
                    <div>
                        <i class="fa-solid fa-circle-dot"></i>
                    </div>
                    <div>
                        Please arrive 15 minutes before the scheduled pickup time
                    </div>
                </li>

                <li>
                    <div>
                        <i class="fa-solid fa-circle-dot"></i>
                    </div>
                    <div>
                        Carry a bottle of water to stay hydrated during the tour.
                    </div>
                </li>

                <li>
                    <div>
                        <i class="fa-solid fa-circle-dot"></i>
                    </div>
                    <div>
                        Wear comfortable walking shoes and bring sun protection if needed
                    </div>
                </li>

        </div> -->

    </div>

</body>

</html>