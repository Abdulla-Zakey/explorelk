<!DOCTYPE html>
<html lang="en">
<head>
    <title>ExploreLK Tour Guide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexContainer">
        
        <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

        <div class="body-container">
            <div class="heading">
                <h2>Bookings</h2>
            </div>

            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search bookings">
            </div>

            <!-- Tabs -->
            <div class="tabs">                
                <button class="tab active">All</button>
                <button class="tab">Upcoming</button>
                <button class="tab">Completed</button>
                <button class="tab">Canceled</button>
            </div>

            <!-- Booking List -->
            <div class="booking-item">
                <div class="booking-details">
                    <p class="status">Upcoming</p>
                    <h3 class="title">Gartmore Falls Tour</h3>
                    <p class="location">Maskeliya, Sri Lanka</p>
                    <a class="details-button" href="<?= ROOT?>/tourGuide/C_bookingDetails">View details</a>
                </div>
                <div class="booking-image">
                    <img src="<?= ROOT ?>/assets/images/tourGuide/gartmore 1.png" alt="gartmore">
                </div>
            </div>

            <div class="booking-item">
                <div class="booking-details">
                    <p class="status">Upcoming</p>
                    <h3 class="title">Sandagalathenna Tour</h3>
                    <p class="location">Hatton, Sri Lanka</p>
                    <a class="details-button" href="<?= ROOT?>/tourGuide/C_bookingDetails">View details</a>
                </div>
                <div class="booking-image">
                    <img src="<?= ROOT ?>/assets/images/tourGuide/sandagalathenna.png" alt="morrey falls">
                </div>
            </div>

            <div class="booking-item">
                <div class="booking-details">
                    <p class="status">Cancelled</p>
                    <h3 class="title">Gartmore Falls Tour</h3>
                    <p class="location">Hatton, Sri Lanka</p>
                    <a class="details-button" href="<?= ROOT?>/tourGuide/C_bookingDetails">View details</a>
                </div>
                <div class="booking-image">
                    <img src="<?= ROOT ?>/assets/images/tourGuide/gartmore 3.png" alt="gartmore3">
                </div>
            </div>

            <div class="booking-item">
                <div class="booking-details">
                    <p class="status">Completed</p>
                    <h3 class="title">Gartmore Falls Tour</h3>
                    <p class="location">Hatton, Sri Lanka</p>
                    <a class="details-button" href="<?= ROOT?>/tourGuide/C_bookingDetails">View details</a>
                </div>
                <div class="booking-image">
                    <img src="<?= ROOT ?>/assets/images/tourGuide/gartmore 2.png" alt="gartmore2">
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>
