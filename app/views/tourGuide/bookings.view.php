<?php
    $newBookings = $data['newBookings'];
    $tourPackages = $data['tourPackages'];
    $travelers = $data['travelers'];
    $tourPackageImages = $data['tourPackageImages'];
    // show($newBookings);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/bookings.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <div class="main-container">
            <div class="page-header">
                <h1>My Bookings</h1>
            </div>

            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" class="search-bar"
                    placeholder="Search bookings by tourist name, package, or location...">
            </div>

            <!-- Tabs -->
            <div class="tabs">
                <button class="tab active">All</button>
                <button class="tab">Started</button>
                <button class="tab">Upcoming</button>
                <button class="tab">Completed</button>
                <button class="tab">Canceled</button>
            </div>

            <!-- Booking List -->
            <div class="booking-list">
                <!-- Elia Adventure Booking -->
                <?php if ($newBookings) : ?>
                <?php foreach($newBookings as $booking): ?>
                    <?php
                            // Find corresponding package
                            $packageData = null;
                            foreach ($tourPackages as $tourPackage) {
                                if ($tourPackage->package_id == $booking->package_id) {
                                    $packageData = $tourPackage;
                                    break;
                                }
                            }
                            
                            // Find corresponding traveler
                            $travelerData = null;
                            foreach ($travelers as $traveler) {
                                if ($traveler->traveler_Id == $booking->traveler_Id) {
                                    $travelerData = $traveler;
                                    break;
                                }
                            }

                            $displayImage = null;
                            foreach ($tourPackageImages as $image) {
                                if ($image['package_id'] == $booking->package_id) {
                                    $displayImage = $image;
                                    break;
                                }
                            }
                            
                            // Skip if package or traveler not found
                            if (!$packageData || !$travelerData) continue;
                            // show($displayImage);
                        ?>
                <div class="booking-item">
                    <div class="booking-details">
                        <span class="status <?= $booking->status ?>"><?= $booking->status ?></span>
                        <h3 class="title"><?= $travelerData->fName . ' ' . $travelerData->lName; ?></h3>
                        <h3 class="title"><?= $packageData->name ?></h3>
                        <p class="package-name"><?= $packageData->group_size; ?> peoples</p>
                        <p class="location"><i class="fas fa-map-marker-alt"></i><?= $packageData->location; ?></p>
                        <p class="date"><i class="far fa-calendar-alt"></i><?= $booking->tour_date; ?> - <?= $booking->start_time; ?></p>

                        <a href="<?= ROOT ?>/tourGuide/C_bookingDetails?booking_id=<?= $booking->booking_id; ?>" class="details-button">View
                            details</a>
                    </div>
                    <div class="booking-image">
                        <img src="<?= ROOT . '/' . $displayImage['image_path']; ?>" alt="Elia Adventure">
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                    <p>No bookings.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
    // Tab functionality
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            // Filter bookings based on tab
            const status = this.textContent.toLowerCase();
            const bookings = document.querySelectorAll('.booking-item');

            bookings.forEach(booking => {
                if (status === 'all') {
                    booking.style.display = 'flex';
                } else {
                    const bookingStatus = booking.querySelector('.status').classList[1];
                    if (bookingStatus === status) {
                        booking.style.display = 'flex';
                    } else {
                        booking.style.display = 'none';
                    }
                }
            });
        });
    });

    // Search functionality
    const searchBar = document.querySelector('.search-bar');
    searchBar.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const bookingItems = document.querySelectorAll('.booking-item');

        bookingItems.forEach(item => {
            const title = item.querySelector('.title').textContent.toLowerCase();
            const package = item.querySelector('.package-name').textContent.toLowerCase();
            const location = item.querySelector('.location').textContent.toLowerCase();
            const tourist = item.querySelector('.tourist-info span').textContent.toLowerCase();

            if (title.includes(searchTerm) || package.includes(searchTerm) ||
                location.includes(searchTerm) || tourist.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
    </script>
</body>

</html>