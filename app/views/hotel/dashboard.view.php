<?php 
    include_once APPROOT . '/views/hotel/nav.php';
    include_once APPROOT . '/views/hotel/hotelhead.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/dashboard.css">
    <title>Hotel Management Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
</head>

<body>

    <div class="dashboard">
        <!-- Main Content -->
        <main class="content">
            <!-- Summary Cards -->
            <section class="summary-cards">
                <div class="card">
                    <div class="card-icon rooms">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        </svg>
                    </div>
                    <div class="card-content">
                        <h3>Total Rooms</h3>
                        <p class="card-value"><?= $data['totalRooms'] ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon bookings">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="card-content">
                        <h3>Active Bookings</h3>
                        <p class="card-value"><?= $data['activeBookings'] ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon earnings">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <div class="card-content">
                        <h3>Earnings</h3>
                        <p class="card-value"><?= $data['earnings'] . ' LKR' ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon reviews">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                            </polygon>
                        </svg>
                    </div>
                    <div class="card-content">
                        <h3>Reviews</h3>
                        <p class="card-value"><?= $data['avgRating'] ?></p>
                    </div>
                </div>
            </section>

            <div class="dashboard-grid">
                <!-- Booking Overview -->
                <!-- <section class="booking-overview">
                    <h2>Booking Overview</h2>
                    <div class="booking-list">
                        <?php foreach ($data['recentBookings'] as $booking): ?>
                        <div class="booking-item">
                            <div class="guest-info">
                                <img src="https://via.placeholder.com/40" alt="Guest" class="avatar">
                                <div>
                                    <h4><?= htmlspecialchars($booking->traveler_name ?: 'Unknown') ?></h4>
                                    <p>Booking #<?= htmlspecialchars($booking->commission_Id) ?></p>
                                </div>
                            </div>
                            <div class="booking-details">
                                <div class="booking-date">
                                    <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor"
                                        stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span><?= date('M d, Y', strtotime($booking->created_at)) ?></span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section> -->

                <!-- Financial Summary -->
                <section class="financial-summary">
                    <h2>Financial Summary</h2>
                    <div class="finance-cards">
                        <div class="finance-card">
                            <h3>Today's Earnings</h3>
                            <p class="finance-value"><?= $data['todayEarnings'] ?></p>
                            <!-- <div class="finance-chart placeholder"></div> -->
                        </div>
                        <div class="finance-card">
                            <h3>Monthly Earnings</h3>
                            <p class="finance-value"><?= $data['earnings'] ?></p>
                            <!-- <div class="finance-chart placeholder"></div> -->
                        </div>
                    </div>
                </section>

                <!-- Review Section -->
                <section class="review-section">
                    <h2>Recent Reviews</h2>
                    <div class="review-list">
                        <?php foreach ($data['recentReviews'] as $review): ?>
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-info">
                                    <!-- <img src="<?= htmlspecialchars($review->profilePicture ?: 'https://via.placeholder.com/40') ?>" alt="Reviewer" class="avatar">
                                        <div> -->
                                    <h4><?= htmlspecialchars($review->reviewer_name ?: 'Anonymous') ?></h4>
                                    <div class="rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="star <?= $i <= $review->rating ? 'filled' : '' ?>">★</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <span class="review-date"><?= date('M d, Y', strtotime($review->created_at)) ?></span>

                            <p class="review-text"><?= htmlspecialchars($review->review_text) ?></p>
                            <!-- <button class="btn btn-sm btn-outline">Respond</button> -->
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
            </section>
    </div>
    </main>
    </div>
</body>

</html>