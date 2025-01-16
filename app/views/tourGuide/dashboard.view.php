<html>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
        <title>ExploreLK | Home - Tour Guide</title>
    </head>

    <body>
        <div class="flexContainer">

            <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

            <div class="body-container">
                <div class="heading">
                    <h1>Guide Dashboard</h1>
                </div>

                <div class="widget">
                    <div class="card">
                        <h3>50%</h3>
                        <h5>Profile Completion</h5>
                    </div>
                    
                    <div class="card">
                        <h3>3</h3>
                        <h5>Booking Requests</h5>
                    </div>
                    
                    <div class="card">
                        <h3>0</h3>
                        <h5>Upcoming Bookings</h5>
                    </div>
                    
                    <div class="card">
                        <h3>Rs 0.0</h3>
                        <h5>Total Earnings</h5>
                    </div>
                </div>

                <div class="sub-heading">
                    <h2>Alerts</h2>
                </div>

                <div class="alerts">
                    <div class="alert-box">
                        <h5 class="alert-message">You have a new booking request!</h5>
                        <a href="<?= ROOT?>/tourGuide/C_bookingRequests"><h5>View Request &rarr;</h5></a>
                    </div>

                    <div class="alert-box">
                        <h5 class="alert-message">Finish setting up your profile to get more bookings</h5>                    
                        <a href="<?= ROOT?>/tourGuide/C_profile"><h5>Complete your profile &rarr;</h5></a>
                    </div>
                </div>

                <div class="sub-heading">
                    <h2>Service Availability</h2>
                </div>

                <div class="service-availability">
                    <div class="icon">
                        <i class="fa-regular fa-calendar-check fa-lg"></i>
                    </div>

                    <div class="service-info">
                        <p>Currently taking bookings</p>
                    </div>
                </div>

                <div class="sub-heading">
                    <h2>Recent Activity</h2>
                </div>

                <div class="activity">
                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned Rs 13500 from a booking</p>
                            <span><p>Mar 24, 2023</p></span>
                        </div>
                    </div>

                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned Rs 6500 from a booking</p>
                            <span><p>April 12, 2023</p></span>
                        </div>
                    </div>

                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned Rs 9400 from a booking</p>
                            <span><p>Feb 12, 2023</p></span>
                        </div>
                    </div>

                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned Rs 8000 from a booking</p>
                            <span><p>Mar 12, 2023</p></span>
                        </div>
                    </div>
                </div>

                <div class="sub-heading">
                    <h2>Reviews </h2>
                </div>

                <div class="rating-container">
                    <!-- Main Rating and Stars -->
                    <div>
                        <div class="main-rating">4.5</div>
                        <div class="star-rating">★★★★☆</div>
                        <div class="review-count">100 reviews</div>
                    </div>
            
                    <!-- Progress Bars -->
                    <div class="progress-bars">
                        <div class="rating-row">
                            <div class="rating-label">5</div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 60%;"></div>
                            </div>
                            <div class="progress-value">60%</div>
                        </div>
                        <div class="rating-row">
                            <div class="rating-label">4</div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 10%;"></div>
                            </div>
                            <div class="progress-value">10%</div>
                        </div>
                        <div class="rating-row">
                            <div class="rating-label">3</div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 10%;"></div>
                            </div>
                            <div class="progress-value">10%</div>
                        </div>
                        <div class="rating-row">
                            <div class="rating-label">2</div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 10%;"></div>
                            </div>
                            <div class="progress-value">10%</div>
                        </div>
                        <div class="rating-row">
                            <div class="rating-label">1</div>
                            <div class="progress">
                                <div class="progress-bar" style="width: 10%;"></div>
                            </div>
                            <div class="progress-value">10%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </body>

    
    
</html>