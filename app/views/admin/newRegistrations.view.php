<html lang="en">
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

        <div class="mainPart">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div>
                <h1 class="heading">New Registrations (14)</h1>
            
                <!-- Search Bar -->
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search Service Provider">
                    <button class="search-btn"><i class="fa fa-search"></i> Search</button>
                </div>

                <div class="table-container">
                    <!-- Filter Tabs -->
                    <div class="tabs">
                        <button class="tab active">All</button>
                        <button class="tab">Travellers</button>
                        <button class="tab">Service Providers</button>
                        <button class="tab">Tour Guides</button>
                    </div>
                
                    <!-- Booking List Table -->
                    <div class="booking-list">
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sineth</td>
                                    <td>sineth122@gmail.com</td>
                                    <td>22/05/2024</td>
                                    <td>Tour Guide</td>
                                    <td>
                                        <a href="<?=ROOT?>/admin/C_newRegistrationDetails" class="action">View</a>,
                                        <a href="#" class="action confirm">Confirm, </a>
                                        <a href="#" class="action confirm">Cancel</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dimuthu</td>
                                    <td>dimuthu122@gmail.com</td>
                                    <td>22/05/2024</td>
                                    <td>Hotel</td>
                                    <td>
                                        <a href="<?=ROOT?>/admin/C_newRegistrationDetails" class="action">View</a>,
                                        <a href="#" class="action cancel">Confirm, </a>
                                        <a href="#" class="action confirm">Cancel</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</body>
</html>