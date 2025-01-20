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
    
                <div class="booking-list">
                    <h1 class="heading">Hotels & Restaurants Booking List</h1>
                    <div class="search-bar">
                        <input type="text" class="search-input" placeholder="Search Service Provider">
                        <button class="search-btn"><i class="fa fa-search"></i> Search</button>
                    </div>
                    <table class="booking-table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>User Name</th>
                                <th>Booking Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BK001</td>
                                <td>John</td>
                                <td>21/01/2025</td>
                                <td>Confirmed</td>
                                <td><a href="#">View</a> / <a href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>BK002</td>
                                <td>Binura</td>
                                <td>21/01/2025</td>
                                <td>Pending</td>
                                <td><a href="#">View</a> / <a href="#">Delete</a></td>
                            </tr>
                            <tr>
                                <td>BK003</td>
                                <td>Aamir</td>
                                <td>21/01/2025</td>
                                <td>Cancelled</td>
                                <td><a href="#">View</a> / <a href="#">Delete</a></td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </body>
</html>