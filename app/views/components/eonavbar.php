<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title><?= $title ?></title>

    <style>
        /* Basic resets */

        body {
            background-color: #fff;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }

        a{
            text-decoration: none;
        }
        
        h1, ul {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #042A3B;
        }

        .left-navbar {
            list-style: none;
            /* width: 250px; */
            width: 18%;
            box-sizing: border-box;
            height: 100vh;
            background-color: #002D40;
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
        }

        .logo {
            align-items: center;
            display: flex;
            margin-top: 22.5px;
            margin-bottom: 12.5px;
        }

        .logo-img {
            margin-top: 12.5px;
            width: 60px;
            height: 60px;
            margin-bottom: 20px;
            margin-right: 7.5px;
        }

        .logo h2 {
            color: white;
            font-size: 32px;
            margin-bottom: 30px;
            
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
            color:#002D40 ;
        }

        .nav-menu li a i {
            margin-right: 10px;
        }

    </style>
</head>
<body>

    <nav class="left-navbar">

        <div class="logo">
            <img src="<?= IMAGES ?>/eo/src/loko.png" alt="ExploreLK Logo" class="logo-img">
            <h2>ExploreLK</h2>
        </div>
    
        <ul class="nav-menu">
            <li><a href = "<?= ROOT ?>/Eventorganizer/Eodashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href = "<?= ROOT ?>/Eventorganizer/Eoevents"><i class="fas fa-hourglass-half"></i> Pending Events</a></li>
            <li><a href = "<?= ROOT ?>/Eventorganizer/Eomyevents"><i class="fas fa-check-circle"></i>Approved Events</a></li>

            <!--Here we have to display the events with the status of completed in the database, Also we have to have link to view the earnings of the event-->
            <li><a href = "<?= ROOT ?>/Eventorganizer/Eomyevents"><i class="fas fa-flag-checkered"></i>Completed Events</a></li>    
            
            <li><a href = "<?= ROOT ?>/Eventorganizer/Eopayments"><i class="fa-solid fa-money-check-dollar"></i> Payments</a></li>  
            <li><a href = "<?= ROOT ?>/Eventorganizer/Eosettings"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href = "<?= ROOT ?>/traveler/Login/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>"
        </ul>

    </nav>

</body>
</html>
