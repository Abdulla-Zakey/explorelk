<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/registeredUser.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/myTrips.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | My Trips</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        .leftPanel h1 {
            font-size: 3.2rem;
        }
    </style>
</head>

<body>

    <div class="mainContainer">
        <div class="leftPanel">
            <div class="logo">
                <img src="<?= IMAGES ?>/logos/logoWhite.svg" alt="Logo">
                <h1>ExploreLK</h1>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="linkItem">
                    <i class="fa-solid fa-house"></i>Home
                </a>
            </div>

            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyTrips" class="linkItem" style="color:#002D40;">
                    <i class="fa-solid fa-person-walking-luggage"></i>My Trips
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyBookings" class="linkItem">
                    <i class="fa-solid fa-book-open"></i>My Bookings
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Messages" class="linkItem">
                    <i class="fa-solid fa-message"></i>Messages
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Notifications" class="linkItem">
                    <i class="fa-solid fa-bell"></i>Notifications
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/ViewProfile" class="linkItem">
                    <i class="fa-solid fa-user"></i>View Profile
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/EditProfile" class="linkItem">
                    <i class="fa-solid fa-user-pen"></i>Edit Profile
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>
        </div>

        <div class="rightPanel">
            <div class="header-container">
                <h1>My Trips</h1>
                <button class="buttonStyle">
                    <a href="<?= ROOT ?>/traveler/CreateTrip">
                        <i class="fa-solid fa-plus"></i>Create a New Trip
                    </a>
                </button>
            </div>

            <?php if (empty($data['trips'])): ?>
                <div class="no-trips-message">
                    <p style = "font-size: 16px;">You haven't created any trips yet. Start planning your next adventure!</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['trips'] as $trip): ?>
                    <div class="bookingContainer">
                        <div class="bookingItemImage-Container">
                            <img src="<?= IMAGES ?>/travelers/myTripCoverPics/nuwaraEliyaCoverPic.png" alt="Trip Cover">
                        </div>

                        <div class="bookingItemDetails">
                            <h2><?= htmlspecialchars($trip->tripName) ?></h2>

                            <div class="bookingKeyInfo-Holder">
                                <div><i class="fa-solid fa-location-dot"></i>Main Destination:</div>
                                <div><?= htmlspecialchars($trip->destination) ?></div>
                            </div>

                            <div class="bookingKeyInfo-Holder">
                                <div><i class="fa-regular fa-calendar"></i>Trip Start Date:</div>
                                <div><?= date('d-m-Y', strtotime($trip->startDate)) ?></div>
                            </div>

                            <div class="bookingKeyInfo-Holder">
                                <div><i class="fa-regular fa-calendar"></i>Trip End Date:</div>
                                <div><?= date('d-m-Y', strtotime($trip->endDate)) ?></div>
                            </div>
                        </div>

                        <div class="bookingActionBtn-Holder">
                            <a href="<?= ROOT ?>/traveler/MyTrips/viewTrip/<?= $trip->trip_Id ?>">
                                <button id="viewBookingBtn" class="actionButtons">
                                    <i class="fas fa-eye"></i>View Trip Details
                                </button>
                            </a>

                            <a href="<?= ROOT ?>/traveler/MyTrips/editTrip/<?= $trip->trip_Id ?>">
                                <button id="editBookingBtn" class="actionButtons">
                                    <i class="fas fa-edit"></i>Edit Trip Details
                                </button>
                            </a>

                            <a href="<?= ROOT ?>/traveler/MyTrips/deleteTrip/<?= $trip->trip_Id ?>"
                                onclick="return confirm('Are you sure you want to delete this trip?');">
                                <button id="deleteBookingBtn" class="actionButtons">
                                    <i class="fas fa-trash"></i>Delete Trip
                                </button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>