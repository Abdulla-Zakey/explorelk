
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Basic resets */
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
            width: 250px;
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
            margin-bottom: 20px;
        }

        .logo-img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .logo h2 {
            color: white;
            font-size: 24px;
            margin-bottom: 40px;
            
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
        <img src="<?php echo ROOT; ?>/assets/images/eo/src/loko.png" alt="ExploreLK Logo" class="logo-img">
        <h2>ExploreLK</h2>
    </div>
    <ul class="nav-menu">
        <li><a href="Eodashboard"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="Eoevents"><i class="fa-regular fa-calendar"></i> Events</a></li>
        <li><a href="Eomyevents"><i class="fa-solid fa-list-ul"></i> My Events</a></li>
        <li><a href="Eopayments"><i class="fa-solid fa-money-check-dollar"></i> Payments</a></li>
<!--         <li><a href="message.php"><i class="fas fa-comments"></i> Messages</a></li>
 -->    <li><a href="Eosettings"><i class="fas fa-cog"></i> Settings</a></li>
    </ul>
</nav>



</body>
</html>
