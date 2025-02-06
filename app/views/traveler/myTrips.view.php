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

       
        /* Pop-up container (initially hidden) */
        .popup-container {
            font-size: 1.35rem;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Dark transparent overlay */
        display: none; /* Initially hidden */
        justify-content: center;
        align-items: center;
        z-index: 999; /* Above other content */
        }

        /* Pop-up content */
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            font-size: 16px;
        }

        /* Close button */
        .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        /* Blur background effect when pop-up is visible */
        .blur {
            filter: blur(5px);
            pointer-events: none;
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
            
                <div class="empty-state-container">

                    <div class="empty-state-icon">
                        <svg class="map-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6l6-3l6 3l6-3v15l-6 3l-6-3l-6 3V6z"></path>
                            <path d="M9 3v15"></path>
                            <path d="M15 6v15"></path>
                        </svg>

                        <svg class="compass-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M16.24 7.76l-2.12 6.36l-6.36 2.12l2.12-6.36l6.36-2.12z"></path>
                        </svg>
                    </div>
        
                    <h2 class="empty-state-title">Your Journey Begins Here</h2>
        
                    <p class="empty-state-description">
                        Ready to explore the beauty of Sri Lanka? Start planning your next amazing adventure by creating your first trip!
                     </p>

                </div>

            <?php else: ?>
                <?php foreach ($data['trips'] as $trip): ?>
                    <div class="bookingContainer">
                        <div class="bookingItemImage-Container">
                            <img src="<?= IMAGES ?>/travelers/myTripCoverPics/nuwaraEliyaCoverPic.png" alt="Trip Cover Pic">
                        </div>

                        <div class="bookingItemDetails">
                            <h2><?= htmlspecialchars($trip->tripName) ?></h2>

                            <div class="bookingKeyInfo-Holder">
                                <div class = "firstKid"><i class="fa-solid fa-location-dot"></i>Main Destination:</div>
                                <div class = "secondKid"><?= htmlspecialchars($trip->destination) ?></div>
                            </div>

                            <div class="bookingKeyInfo-Holder">
                                <div class = "firstKid"><i class="fa-regular fa-calendar"></i>Trip Start Date:</div>
                                <div class = "secondKid"><?= date('d-m-Y', strtotime($trip->startDate)) ?></div>
                            </div>

                            <div class="bookingKeyInfo-Holder">
                                <div class = "firstKid"><i class="fa-regular fa-calendar"></i>Trip End Date:</div>
                                <div class = "secondKid"><?= date('d-m-Y', strtotime($trip->endDate)) ?></div>
                            </div>
                        </div>

                        <div class="bookingActionBtn-Holder">
                            <a href="<?= ROOT ?>/traveler/MyTrips/viewTrip/<?= $trip->trip_Id ?>">
                                <button id="viewBookingBtn" class="actionButtons">
                                    <i class="fas fa-eye"></i>View Trip Details
                                </button>
                            </a>

                            <a href="<?= ROOT ?>/traveler/MyTrips/editTrip/<?= $trip->trip_Id ?>?edit=true">
                                <button id="editBookingBtn" class="actionButtons">
                                    <i class="fas fa-edit"></i>Edit Trip Details
                                </button>
                            </a>

                            <!-- <a href="<?= ROOT ?>/traveler/MyTrips/deleteTrip/<?= $trip->trip_Id ?>"
                                onclick = "showPopup('Are you sure you want to delete this trip?');"> -->
                            <a href="javascript:void(0)" onclick="showPopup('Are you sure you want to delete this trip?', '<?= ROOT ?>/traveler/MyTrips/deleteTrip/<?= $trip->trip_Id ?>')">

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

    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-text"></p>
            <button id="closePopup">Cancel</button>
            <button id="confirmDelete">Delete</button>
        </div>
    </div>

    <script>

        // Pop-up handling function
        function showPopup(message, deleteUrl) {
            const popup = document.getElementById("popup");
            const popupText = document.getElementById("popup-text");
            //const mainContainer = document.querySelector(".mainContainer");
            const leftPanel = document.querySelector(".leftPanel");
            const rightPanel = document.querySelector(".rightPanel");

            popupText.textContent = message;
            popup.style.display = "flex";
            //mainContainer.classList.add("blur");
            leftPanel.classList.add("blur");
            rightPanel.classList.add("blur");

            document.getElementById("closePopup").onclick = function() {
                popup.style.display = "none";
                //mainContainer.classList.remove("blur");
                leftPanel.classList.remove("blur");
                rightPanel.classList.remove("blur");
            };

            document.getElementById("confirmDelete").onclick = function() {
                window.location.href = deleteUrl;
            };
        }

    </script>

    
</body>

</html>

