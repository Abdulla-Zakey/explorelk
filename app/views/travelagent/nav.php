<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/travelagent/nav.css">
    </style>
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
            <li><a href="<?=ROOT?>/TravelAgent/Tdashboard"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tmyvehicles"><i class="fas fa-car"></i> My Vechicle</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tbookings"><i class="fa-solid fa-bookmark"></i> Bookings</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tcustomer"><i class="fa-solid fa-users"></i> Customers</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tnotifications"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tpaymentdetails"><i class="fas fa-credit-card"></i> Payment Details</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Treviews"><i class="fa-solid fa-star"></i>Reviews</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tmessages"><i class="fas fa-comments"></i> Messages</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Treports"><i class="fas fa-file-alt"></i> Complain</a></li>
            <li><a href="<?=ROOT?>/TravelAgent/Tsettings"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>

        <div class="logout">
        <a href="<?= ROOT ?>/traveler/Login/logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </div>

   </body>
</html>