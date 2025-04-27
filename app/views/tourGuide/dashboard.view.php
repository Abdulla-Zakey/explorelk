<?php
    $guideBookingData = $data['guideBookingData'];
    $tourPackages = $data['tourPackages'];
    $travelers = $data['travelers'];
    $holidays = $data['holidays'];
    $bookingCount = count($guideBookingData);
    // show($bookingCount);
?>

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
                        <h3><?= $bookingCount > 0 ? $bookingCount : '0'; ?></h3>
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
                            <a href="<?= ROOT ?>/tourGuide/C_bookings"
                                style="text-decoration: none; color: #09b290;">See All</a> <i
                                class="fas fa-chevron-right"></i>
                        </span>
                    </div>

                    <ul class="dashboard-booking-list">
                        <?php $count = 0; ?>
                        <?php if(empty($guideBookingData)): ?>
                        <div class="no-bookings-message">
                            <div class="no-bookings-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h3>No Pending Bookings</h3>
                            <p>You don’t have any upcoming bookings yet. Check your booking requests to see new
                                inquiries.</p>
                            <a href="<?= ROOT ?>/tourGuide/C_bookingRequests" class="booking-requests-btn">Go to Booking
                                Requests</a>
                        </div>
                        <?php else: ?>
                        <?php foreach($guideBookingData as $booking): ?>
                        <?php if($count >= 4) break; 
                            $relatedTourPackage = null;
                            // show($booking);
                            foreach($tourPackages as $package) {
                                if($package->package_id == $booking->package_id) { // Changed to object access
                                    $relatedTourPackage = $package;
                                    break;
                                }
                            }

                            $relatedTraveler = null;
                            // show($booking);
                            foreach($travelers as $traveler) {
                                if($traveler->traveler_Id == $booking->traveler_Id) { // Changed to object access
                                    $relatedTraveler = $traveler;
                                    break;
                                }
                            }

                            $bookingDateTime = new DateTime($booking->tour_date);
                            $day = $bookingDateTime->format('d');
                            $month = $bookingDateTime->format('M'); 
                            $time = $bookingDateTime->format('H:i');
                            ?>
                        <a href="<?= ROOT ?>/tourGuide/C_bookingDetails?booking_id=<?= $booking->booking_id ?>" style="color: ; text-decoration: none;">
                            <li class="dashboard-booking-item">
                                <div class="dashboard-booking-date">
                                    <div class="day"><?= $day ?></div>
                                    <div class="month"><?= $month ?></div>
                                </div>
                                <div class="dashboard-booking-info">
                                    <div class="dashboard-booking-title" style="color: black;"><?= $relatedTourPackage->name ?></div>
                                    <div class="dashboard-booking-details">
                                        <span><i class="fas fa-user"></i> <?= $relatedTraveler->fName . ' ' . $relatedTraveler->lName ?></span>
                                        <span><i class="fas fa-clock"></i> <?= $booking->start_time ?></span>
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
                        </a>
                        <?php $count++; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="dashboard-card">
                    <div class="dashboard-card-header">
                        <h2 class="dashboard-card-title">Upcoming Holidays</h2>
                        <!-- <span class="see-all">
                            See All <i class="fas fa-chevron-right"></i>
                        </span> -->
                    </div>

                    <ul class="holiday-list">
                    <?php foreach($holidays as $holiday): ?>
                    <?php 
                        $holidayDateTime = new DateTime($holiday['date']);
                        $holidayDay = $holidayDateTime->format('d');
                        $holidayMonth = $holidayDateTime->format('M'); 
                    ?>
                        <li class="holiday-item">
                            <div class="holiday-date">
                                <div class="day"><?= $holidayDay ?></div>
                                <div class="month"><?= $holidayMonth ?></div>
                            </div>
                            <div class="holiday-info">
                                <div class="holiday-name"><?= $holiday['name'] ?></div>
                                <!-- <div class="holiday-details">
                                    National holiday - Countrywide
                                </div> -->
                            </div>
                            <!-- <span class="holiday-category">National</span> -->
                        </li>
                    <?php endforeach; ?>
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