<!DOCTYPE html>
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

        <div class="body-container">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div class="booking-list">

                <h1 class="heading">All Hotels & Restaurant Users (28)</h1>

                <div class="search-bar">
                    <input type="text" placeholder="Search Traveler" class="search-input">
                    <button class="search-btn"><i class="fa fa-search"></i> Search</button>
                </div>

                <table class="booking-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>User ID</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>H 001</td>
                            <td>pramith1@gmail.com</td>
                            <td>Pramin Jonson</td>
                            <td>
                                <a href="serviceProviderDetails.html"><button class="detail-button">Detail ></button></a>
                                <button class="detail-button" style="background-color: brown;">Disable </button>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>H 002</td>
                            <td>jabir21@gmail.com</td>
                            <td>Nihmath Jabir</td>
                            <td>
                                <button class="detail-button">Detail ></button>
                                <button class="detail-button" style="background-color: green;">Enable </button>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>H 003</td>
                            <td>mzabdulla25@gmail.com</td>
                            <td>Abdulla Zakey</td>
                            <td>
                                <button class="detail-button">Detail ></button>
                                <button class="detail-button" style="background-color: brown;">Disable </button>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>H 004</td>
                            <td>athagshan43@gmail.com</td>
                            <td>Thagshan Arulsivam</td>
                            <td>
                                <button class="detail-button">Detail ></button>
                                <button class="detail-button" style="background-color: green;">Enable </button>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-circle"></i></td>
                            <td>H 005</td>
                            <td>sarmay@gmail.com</td>
                            <td>Y. Sarma</td>
                            <td>
                                <button class="detail-button">Detail ></button>
                                <button class="detail-button" style="background-color: brown;">Disable </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>
</html>
