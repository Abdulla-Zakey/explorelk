<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/dashboard.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>
        <div class="main-container">
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>

            <div class="dashboard-overview-cards">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="dashboard-stat-icon dashboard-bookings">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="dashboard-stat-info">
                        <h3>24</h3>
                        <span>Active Bookings</span>
                    </div>
                </div>

                <div class="dashboard-card dashboard-stat-card">
                    <div class="dashboard-stat-icon earnings">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="dashboard-stat-info">
                        <h3>₨ 45,200</h3>
                        <span>This Month</span>
                    </div>
                </div>

                <div class="dashboard-card dashboard-stat-card">
                    <div class="dashboard-stat-icon dashboard-reviews">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="dashboard-stat-info">
                        <h3>4.8</h3>
                        <span>Average dashboard-rating</span>
                    </div>
                </div>

                <div class="dashboard-card dashboard-stat-card">
                    <div class="dashboard-stat-icon rate">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="dashboard-stat-info">
                        <h3>95%</h3>
                        <span>Completion Rate</span>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <h2 class="dashboard-card-title">Upcoming Bookings</h2>
                        <span class="see-all">
                            See All <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>

                    <ul class="dashboard-booking-list">
                        <li class="dashboard-booking-item">
                            <div class="dashboard-booking-date">
                                <div class="day">23</div>
                                <div class="month">Apr</div>
                            </div>
                            <div class="dashboard-booking-info">
                                <div class="dashboard-booking-title">Kandy Heritage Tour</div>
                                <div class="dashboard-booking-details">
                                    <span><i class="fas fa-user"></i> 2 Travelers</span>
                                    <span><i class="fas fa-clock"></i> 08:00 AM</span>
                                </div>
                            </div>
                            <div class="dashboard-booking-actions">
                                <button class="action-btn">
                                    <i class="fas fa-phone"></i>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </li>

                        <li class="dashboard-booking-item">
                            <div class="dashboard-booking-date">
                                <div class="day">25</div>
                                <div class="month">Apr</div>
                            </div>
                            <div class="dashboard-booking-info">
                                <div class="dashboard-booking-title">Sigiriya Adventure</div>
                                <div class="dashboard-booking-details">
                                    <span><i class="fas fa-user"></i> 4 Travelers</span>
                                    <span><i class="fas fa-clock"></i> 07:30 AM</span>
                                </div>
                            </div>
                            <div class="dashboard-booking-actions">
                                <button class="action-btn">
                                    <i class="fas fa-phone"></i>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </li>

                        <li class="dashboard-booking-item">
                            <div class="dashboard-booking-date">
                                <div class="day">28</div>
                                <div class="month">Apr</div>
                            </div>
                            <div class="dashboard-booking-info">
                                <div class="dashboard-booking-title">Beaches of South</div>
                                <div class="dashboard-booking-details">
                                    <span><i class="fas fa-user"></i> 2 Travelers</span>
                                    <span><i class="fas fa-clock"></i> 09:00 AM</span>
                                </div>
                            </div>
                            <div class="dashboard-booking-actions">
                                <button class="action-btn">
                                    <i class="fas fa-phone"></i>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </li>

                        <li class="dashboard-booking-item">
                            <div class="dashboard-booking-date">
                                <div class="day">02</div>
                                <div class="month">May</div>
                            </div>
                            <div class="dashboard-booking-info">
                                <div class="dashboard-booking-title">Tea Country Experience</div>
                                <div class="dashboard-booking-details">
                                    <span><i class="fas fa-user"></i> 3 Travelers</span>
                                    <span><i class="fas fa-clock"></i> 08:30 AM</span>
                                </div>
                            </div>
                            <div class="dashboard-booking-actions">
                                <button class="action-btn">
                                    <i class="fas fa-phone"></i>
                                </button>
                                <button class="action-btn">
                                    <i class="fas fa-comment"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <h2 class="dashboard-card-title">Upcoming Holidays</h2>
                        <span class="see-all">
                            See All <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>

                    <ul class="holiday-list">
                        <li class="holiday-item">
                            <div class="holiday-date">
                                <div class="day">01</div>
                                <div class="month">May</div>
                            </div>
                            <div class="holiday-info">
                                <div class="holiday-name">May Day</div>
                                <div class="holiday-details">
                                    National holiday - Countrywide
                                </div>
                            </div>
                            <span class="holiday-category">National</span>
                        </li>

                        <li class="holiday-item">
                            <div class="holiday-date">
                                <div class="day">15</div>
                                <div class="month">May</div>
                            </div>
                            <div class="holiday-info">
                                <div class="holiday-name">Vesak Poya</div>
                                <div class="holiday-details">
                                    Buddhist festival - Major celebrations in Colombo
                                </div>
                            </div>
                            <span class="holiday-category">Religious</span>
                        </li>

                        <li class="holiday-item">
                            <div class="holiday-date">
                                <div class="day">16</div>
                                <div class="month">May</div>
                            </div>
                            <div class="holiday-info">
                                <div class="holiday-name">Day after Vesak Poya</div>
                                <div class="holiday-details">
                                    Public holiday - Countrywide
                                </div>
                            </div>
                            <span class="holiday-category">Religious</span>
                        </li>

                        <li class="holiday-item">
                            <div class="holiday-date">
                                <div class="day">04</div>
                                <div class="month">Jun</div>
                            </div>
                            <div class="holiday-info">
                                <div class="holiday-name">Poson Poya</div>
                                <div class="holiday-details">
                                    Major Buddhist festival - Anuradhapura celebrations
                                </div>
                            </div>
                            <span class="holiday-category">Cultural</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <h2 class="dashboard-card-title">Latest Reviews</h2>
                    <span class="see-all">
                        See All <i class="fas fa-chevron-right"></i>
                    </span>
                </div>

                <ul class="dashboard-review-list">
                    <li class="dashboard-review-item">
                        <div class="dashboard-review-header">
                            <img src="/api/placeholder/40/40" alt="reviewer" class="dashboard-reviewer-pic">
                            <div class="dashboard-reviewer-info">
                                <div class="dashboard-reviewer-name">Sarah Johnson</div>
                                <div class="dashboard-review-date">April 15, 2025</div>
                            </div>
                            <div class="dashboard-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="dashboard-review-text">
                            "Amazing experience! Anura was extremely knowledgeable about Sigiriya's history and took
                            us to some hidden spots that weren't crowded with tourists. Highly recommend this guide!"
                        </div>
                    </li>

                    <li class="dashboard-review-item">
                        <div class="dashboard-review-header">
                            <img src="/api/placeholder/40/40" alt="reviewer" class="dashboard-reviewer-pic">
                            <div class="dashboard-reviewer-info">
                                <div class="dashboard-reviewer-name">David Chen</div>
                                <div class="dashboard-review-date">April 12, 2025</div>
                            </div>
                            <div class="dashboard-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <div class="dashboard-review-text">
                            "The beaches of South tour was beautiful. Our guide was friendly and accommodating.
                            Would have liked a bit more time at Mirissa beach, but overall a great day trip."
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>