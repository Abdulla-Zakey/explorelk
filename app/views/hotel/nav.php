<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <link rel ="stylesheet" href="<?= ROOT ?>/assets/css/hotel/nav.css">
    <!-- <title>ExploreLK</title> -->
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="<?=ROOT?>/assets/images/serviceProviders/logow.png" alt="ExploreLK Logo" class="logo-img">
            <h2>ExploreLK</h2>
        </div>

        <?php
        // Get the current URL path
        $current_page = $_SERVER['REQUEST_URI'];
        ?>

        <ul class="nav-menu">
            <li><a href="<?=ROOT?>/Hotel/Hdashboard" class="<?= strpos($current_page, '/Hotel/Hdashboard') !== false ? 'active' : '' ?>"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="<?=ROOT?>/Hotel/TestController" class="<?= strpos($current_page, '/Hotel/Hmyrooms') !== false ? 'active' : '' ?>"><i class="fas fa-bed"></i> My Rooms</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hguest" class="<?= strpos($current_page, '/Hotel/Hguest') !== false ? 'active' : '' ?>"><i class="fa-solid fa-users"></i> Guests</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hnotifications" class="<?= strpos($current_page, '/Hotel/Hnotifications') !== false ? 'active' : '' ?>"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hpaymentdetails" class="<?= strpos($current_page, '/Hotel/Hpaymentdetails') !== false ? 'active' : '' ?>"><i class="fas fa-credit-card"></i> Payment Details</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hreviews" class="<?= strpos($current_page, '/Hotel/Hreviews') !== false ? 'active' : '' ?>"><i class="fa-solid fa-star"></i>Reviews</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hmessages" class="<?= strpos($current_page, '/Hotel/Hmessages') !== false ? 'active' : '' ?>"><i class="fas fa-comments"></i> Messages</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hreports" class="<?= strpos($current_page, '/Hotel/Hreports') !== false ? 'active' : '' ?>"><i class="fas fa-file-alt"></i> Complain </a></li>
            <li><a href="<?=ROOT?>/Hotel/Hsettings" class="<?= strpos($current_page, '/Hotel/Hsettings') !== false ? 'active' : '' ?>"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>

        <div class="logout">
            <a href="<?= ROOT ?>/traveler/Login/logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </div>
</body>
</html>