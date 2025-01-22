<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/registeredUser.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/notifications.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Notifications</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="mainContainer">

        <div class="leftPanel">
            <div class="logo">
                <img src="<?= IMAGES ?>/logos/logoWhite.svg" alt="Logo">
                <h1>
                    ExploreLK
                </h1>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/RegisteredTravelerHome" class = "linkItem"><i class="fa-solid fa-house"></i>Home</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyTrips" class = "linkItem"><i class="fa-solid fa-person-walking-luggage"></i>My Trips</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyBookings" class = "linkItem"><i class="fa-solid fa-book-open"></i>My Bookings</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Messages" class = "linkItem" ><i class="fa-solid fa-message"></i>Messages</a>
            </div>


            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Notifications" class="linkItem" style="color:#002D40 ;"><i class="fa-solid fa-bell"></i>Notifications</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/ViewProfile" class = "linkItem"><i class="fa-solid fa-user"></i>View Profile</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/EditProfile" class = "linkItem"><i class="fa-solid fa-user-pen"></i></i>Edit Profile</a>
            </div>

            <div class = "linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>


        </div>

        <div class = "rightPanel">
            <h1>
                Notifications
            </h1>

            <div id = "thisWeekNotifications" class = "notificationHolder">
                
                <h2>
                    This Week
                </h2>
                
                <div id = "paymentReceivedConfirmation" class = "notificationItem">

                    <div class = "profilePic">
                        <img src = "<?= IMAGES ?>/travelers/messages/eoChat.avif" alt = "profilePic">
                    </div>

                    <div class = "notificationText">
                        Payment received successfully for the <b>Whimsical Wonderfest event.</b>
                    </div>

                    <div class = "actionButtons">
                        <button>
                            View Tickets
                        </button>
                    </div>
                    
                </div>

            </div>

            <div id = "thisMonthNotifications" class = "notificationHolder">
                
                <h2>
                    This Month
                </h2>
                
                <div id = "acceptBookingNotification" class = "notificationItem">

                    <div class = "profilePic">
                        <img src = "<?= IMAGES ?>/travelers/messages/newLankaTransport.png" alt = "profilePic">
                    </div>

                    <div class = "notificationText">
                        <b>New Lanka Transports</b> accepted your booking request.
                    </div>

                    <div class = "actionButtons">
                        <button>
                            View Booking
                        </button>
                    </div>
                    
                </div>

                <div id = "rejectBookingNotification" class = "notificationItem">
                    <div class = "profilePic">
                        <img src = "<?= IMAGES ?>/travelers/messages/hotelChatIcon.webp" alt = "profilePic">
                    </div>

                    <div class = "notificationText">
                        <b>Luxury Hotel</b> declined your booking request.
                    </div>

                    <div class = "actionButtons">
                        <button>
                            View Reason
                        </button>
                    </div>
                </div>

                <div id = "joinTripRequest"  class = "notificationItem">
                    <div class = "profilePic">
                        <img src = "<?= IMAGES ?>/travelers/messages/chatIcon3.png" alt = "profilePic">
                    </div>

                    <div class = "notificationText">
                        <b>Amanda Nethmini</b> wants you to join their trip.
                    </div>

                    <div class = "actionButtons">
                        <button id = "joinTripButton">
                            Confirm
                        </button>

                        <button id = "deleteTripButton" class = "deleteTripButton">
                            Delete
                        </button>
                    </div>
                </div>

                <!-- <div id = "paymentReceivedConfirmation"  class = "notificationItem">

                </div> -->

            </div>
        </div>

    </div>
</body>

</html>