<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resturent</title>
    <link rel="icon" href="loko.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #002D40;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
        }

        .logo {
            align-items: center;
            display: flex;
            margin-bottom: 20px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .logo h2 {
            color: white;
            font-size: 26px;
            margin-bottom: 25px;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-menu li {
            margin-bottom: 20px;
            height: 40px;
        }

        .nav-menu li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .nav-menu li a:hover {
            background-color: #B3D9FF;
            border-radius: 5px;
            color: #002D40;
        }

        .nav-menu li a i {
            margin-right: 10px;
        }

        .logout {
            margin-top: auto;
        }

        .logout a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: #B3D9FF;
            border-radius: 5px;
            color: #002D40;
        }

        .logout a i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="<?php echo ROOT; ?>/assets/images/eo/src/loko.png" alt="ExploreLK Logo" class="logo-img">
            <h2>ExploreLK</h2>
        </div>

        <ul class="nav-menu">
            <li><a href="Rdashboard"><i class="fas fa-th-large"></i> Status</a></li>
            <li><a href="Rmenu"><i class="fas fa-burger"></i> Menu</a></li>
            <li><a href="Rdining"><i class="fas fa-utensils"></i> Dining</a></li>
            <!-- <li><a href="Rpromotion"><i class="fas fa-bullhorn"></i> Promotions & Discounts</a></li> -->
            <li><a href="Rpaymentdetails"><i class="fas fa-credit-card"></i> Payment Details</a></li>
            <!-- <li><a href="Rreviews"><i class="fas fa-comments"></i> Reviews</a></li> -->
            <!-- <li><a href="Rnotifications"><i class="fas fa-bell"></i> Notifications</a></li> -->
            <li><a href="Rsetting"><i class="fas fa-cog"></i> Settings</a></li>

        </ul>

        <div class="logout">
            <a href="<?= ROOT ?>/traveler/Login/logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </div>

   </body>
</html>