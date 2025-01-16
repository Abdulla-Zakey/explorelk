<html>
    <head>
        <title>ExploreLK Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
        <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
    </head>

    <body>
        <div class="flexContainer">

            <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

            <div class="body-container">
                <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

                <div>
                    <h1 class="heading">Overview</h1>
                    <h3 class="sub-heading">Here's your overview today,</h3>
                </div>

                <div class="widget">
                    <div class="card">
                        <h3>7</h3>
                        <h5>Total Admins</h5>
                    </div>
                    
                    <div class="card">
                        <h3>37</h3>
                        <h5>Service Providers</h5>
                    </div>
                    
                    <div class="card">
                        <h3>234</h3>
                        <h5>Travellers</h5>
                    </div>
                    
                    <div class="card">
                        <h3>9</h3>
                        <h5>New Registration Requests</h5>
                    </div>
                    
                    <div class="card">
                        <h3>2</h3>
                        <h5>Complaints</h5>
                    </div>
                    
                    <div class="card">
                        <h3>19</h3>
                        <h5>Bookings</h5>
                    </div>
                </div>

                <div class="sub-heading">
                    <h2>Alerts</h2>
                </div>

                <div class="alerts">
                    <div class="alert-box">
                        <h5 class="alert-message">You have 9 new registration requests!</h5>
                        <a href="<?= ROOT?>/admin/C_newRegistrations"><h5>View Requests &rarr;</h5></a>
                    </div>

                    <div class="alert-box">
                        <h5 class="alert-message">2 Service Providers made complaints</h5>                    
                        <a href="<?= ROOT?>/admin/C_complaints"><h5>View Complaints &rarr;</h5></a>
                    </div>
                </div>

                <div class="sub-heading">
                    <h2>Recent Activity</h2>
                </div>

                <div class="activity">
                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned a commission of Rs 4500 from a tour guide booking</p>
                            <span><p>Mar 12, 2023</p></span>
                        </div>
                    </div>

                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned a commission of Rs 8000 from a hotel booking</p>
                            <span><p>Mar 12, 2023</p></span>
                        </div>
                    </div>

                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned a commission of Rs 5800 from a tour guide booking</p>    
                            <span><p>Mar 12, 2023</p></span>
                        </div>
                    </div>

                    <div class="service-availability">
                        <div class="icon">
                            <i class="fa-solid fa-money-bill fa-lg"></i>
                        </div>

                        <div class="activity-info">
                            <p>You have earned a commission of Rs 3000 from a  hotel booking</p>
                            <span><p>Mar 12, 2023</p></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>