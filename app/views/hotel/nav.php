<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
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
            <img src="<?=ROOT?>/assets/images/logow.png" alt="ExploreLK Logo" class="logo-img">
            <h2>ExploreLK</h2>
        </div>

        <ul class="nav-menu">
            <li><a href="<?=ROOT?>/Hotel/Hdashboard"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hmyrooms"><i class="fas fa-bed"></i> My Rooms</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hguest"><i class="fa-solid fa-users"></i> Guests</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hnotifications"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hpaymentdetails"><i class="fas fa-credit-card"></i> Payment Details</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hreviews"><i class="fa-solid fa-star"></i>Reviews</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hmessages"><i class="fas fa-comments"></i> Messages</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hreports"><i class="fas fa-file-alt"></i> Reports</a></li>
            <li><a href="<?=ROOT?>/Hotel/Hsettings"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>

        <div class="logout">
            <a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a>
        </div>
    </div>

   </body>
</html>