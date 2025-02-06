<?php
    // var_dump($data['sharedTrips']);
    // show($_SESSION['success']);
?>

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
        /* Additional styles for tabs and shared trips */
        .pendingApprovalsNotification {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            background-color: rgba(255, 0, 0, 0.6); 
            border-radius: 50%;
            min-width: 2.5rem;
            height: 2.5rem;
            padding: 0.2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-left: 0.5rem;
            font-size: 1.5rem;
            font-weight: 500;
            animation: pulse 1.5s infinite;
            transform-origin: center;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .trips-tabs {
            display: flex;
            gap: 2rem;
            margin: 0rem;
        }

        .trip-tab {
            font-size: 2rem;
            padding: 1rem 2rem;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
            font-family: 'poppins';
        }

        .trip-tab i{
            margin-right: 0.25rem;
        }

        .trip-tab.active {
            color: #1E7A8F;
            border-bottom: 3px solid #1E7A8F;
            font-weight: 600;
        }

        .trip-tab:hover {
            color: #1E7A8F;
        }

        .trips-section {
            display: none;
        }

        .trips-section.active {
            display: block;
        }

        .trip-owner {
            font-size: 1.4rem;
            color: #666;
            margin-top: 0.5rem;
            margin-left: 2rem;
        }

        .permission-badge {
            font-size: 1.2rem;
            padding: 0.3rem 0.8rem;
            border-radius: 0.5rem;
            margin-left: 0.5rem;
        }

        .permission-badge.editor {
            background: #E3F2FD;
            color: #1E88E5;
        }

        .permission-badge.viewer {
            background: #E8F5E9;
            color: #43A047;
        }

        /* Empty state for shared trips */
        .empty-shared-trips {
            text-align: center;
            padding: 4rem 2rem;
            background: #f8f9fa;
            border-radius: 1rem;
            margin-top: 2rem;
        }

        .empty-shared-trips i {
            font-size: 5rem;
            color: #1E7A8F;
            margin-bottom: 2rem;
        }

        .empty-shared-trips h3 {
            font-size: 2.4rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .empty-shared-trips p {
            font-size: 1.6rem;
            color: #666;
        }

        /* Status indicator for shared trips */
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.3rem;
            margin-left: 1rem;
        }

        .status-indicator.pending {
            color: #F57C00;
        }

        .status-indicator.accepted {
            color: #43A047;
        }

        .status-indicator i {
            font-size: 1.2rem;
        }

        /* Response buttons for pending invites */
        .invite-response {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .invite-response button {
            padding: 0.8rem 1.6rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .accept-invite, .decline-invite{
            color: #FFFFFF;
            width: 100%;
            font-size: 1.3rem;
            border-radius: 1rem;
            padding: 1.5rem;
            box-sizing: border-box;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.2s ease;
            margin-bottom: 7.5%;
        }

        .accept-invite i, .decline-invite i{
            margin-right: 5%;
        }
        .accept-invite {
            /* background: #4CAF50; */
            /* background-color: #4ade80; */
            /* background-color: rgba(50, 140, 85, 0.75); */
            background-color: rgb(45, 225, 45);
            color: white;
        }

        .decline-invite {
            background-color: rgba(255, 0, 0, 0.75);
            /* background: #F44336; */
            color: white;
        }

        .accept-invite:hover {
            background: rgb(25, 225, 25);
            transform: scale(1.05);
        }

        .decline-invite:hover {
            background-color: #E53935;
            transform: scale(1.05);
        }

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
        <!-- Left Panel (Same as original) -->
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

            <!-- Tabs for switching between My Trips and Shared Trips -->
            <div class="trips-tabs">
                <button class="trip-tab active" data-tab="my-trips">
                    <i class="fa-solid fa-person-walking-luggage"></i> My Trips
                </button>
                <button class="trip-tab" data-tab="shared-trips">
                    <i class="fa-solid fa-users"></i> Invited Trips
                    <?php
                        $pendingApprovalCount = 0;
                        if(!empty($data['sharedTrips'])){
                            foreach($data['sharedTrips'] as $trip){
                                if($trip->request_status == 'pending'){
                                    $pendingApprovalCount++;
                                }
                            }
                            if($pendingApprovalCount > 0){
                                echo '<span class = "pendingApprovalsNotification">'. $pendingApprovalCount .'</span>';
                            }
                            else{
                                echo '';
                            }
                        }
                    ?>
                    
                </button>
                
            </div>

            <!-- My Trips Section -->
            <div id = "my-trips" class = "trips-section active">
                <?php if (empty($data['trips'])): ?>
                    <!-- Empty state for my trips (Keep existing empty state) -->
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
                            Start planning your next amazing adventure by creating your first trip!
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

            <!-- Shared Trips Section -->
            <div id="shared-trips" class="trips-section">
                <?php if (empty($data['sharedTrips'])): ?>
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

                        <h2 class="empty-state-title">No Shared Trips Yet</h2>

                        <p class="empty-state-description">
                            When friends share their trips with you, they'll appear here.
                        </p>
                    </div>
                <?php else: ?>
                
                    <?php foreach ($data['sharedTrips'] as $sharedTrip): ?>
                        <div class="bookingContainer">
                            <div class="bookingItemImage-Container">
                                <img src="<?= IMAGES ?>/travelers/myTripCoverPics/nuwaraEliyaCoverPic.png" alt="Trip Cover Pic">
                            </div>

                            <div class="bookingItemDetails">
                                <h2>
                                    <?= htmlspecialchars($sharedTrip->tripName) ?>
                                   
                                    <span class="trip-owner">
                                        <i class="fa-solid fa-user"></i> Created by: <?= htmlspecialchars($sharedTrip->ownerName) ?>
                                        <span class="permission-badge <?= $sharedTrip->role ?>">
                                            <?= ucfirst($sharedTrip->role) ?>
                                        </span>
                                    </span>
                                </h2>
                                
                               

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid"><i class="fa-solid fa-location-dot"></i>Main Destination:</div>
                                    <div class="secondKid"><?= htmlspecialchars($sharedTrip->destination) ?></div>
                                </div>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid"><i class="fa-regular fa-calendar"></i>Trip Start Date:</div>
                                    <div class="secondKid"><?= date('d-m-Y', strtotime($sharedTrip->startDate)) ?></div>
                                </div>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid"><i class="fa-regular fa-calendar"></i>Trip End Date:</div>
                                    <div class="secondKid"><?= date('d-m-Y', strtotime($sharedTrip->endDate)) ?></div>
                                </div>
                            </div>

                                <?php if ($sharedTrip->request_status === 'pending'): ?>
                                   
                                    <div class="bookingActionBtn-Holder">
                                        <a href="<?= ROOT ?>/traveler/MyTrips/handleTripInvitations/<?= $sharedTrip->collaborator_Id ?>/accepted">
                                            <button class="accept-invite">
                                                <i class="fa-solid fa-check"></i> Accept
                                            </button>
                                        </a>

                                        <a href="<?= ROOT ?>/traveler/MyTrips/handleTripInvitations/<?= $sharedTrip->collaborator_Id ?>/declined">
                                            <button class="decline-invite">
                                                <i class="fa-solid fa-xmark"></i> Decline
                                            </button>
                                        </a>
                                    </div>
                                    <?php else: ?>
                                        <div class="bookingActionBtn-Holder">
                                             <a href = "<?= ROOT ?>/traveler/MyTrips/viewTrip/<?= $sharedTrip->trip_Id ?>/<?= $sharedTrip->collaborator_Id ?>">
                                                <button id="viewBookingBtn" class="actionButtons">
                                                    <i class="fas fa-eye"></i>View Trip Details
                                                </button>
                                            </a>
                                             <?php if ($sharedTrip->role === 'editor'): ?>
                                                <a href="<?= ROOT ?>/traveler/MyTrips/editTrip/<?= $sharedTrip->trip_Id ?>/<?= $sharedTrip->collaborator_Id ?>?edit=true">
                                                    <button id="editBookingBtn" class="actionButtons">
                                                        <i class="fas fa-edit"></i>Edit Trip Details
                                                    </button>
                                                </a>
                                            <?php endif; ?>
                                    </div>

                                <?php endif; ?>
                    
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="popupType1" class="popup-container">
        <div class="popup-content">
            <p id="popup-textType1"></p>
            <button id="closePopupType1">OK</button>
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
        function showAlert(message) {
            const popup = document.getElementById("popupType1");
            const popupText = document.getElementById("popup-textType1");
            const leftPanel = document.querySelector(".leftPanel");
            const rightPanel = document.querySelector(".rightPanel");
    
            popupText.innerHTML = message;
    
            // Show the pop-up
            popup.style.display = "flex";
    
            // Blur the background
            leftPanel.classList.add("blur");
            rightPanel.classList.add("blur");
    
            // Remove any existing listeners to prevent multiple bindings
            const closePopup = document.getElementById("closePopupType1");

            closePopup.onclick = function() {
                // Hide the pop-up
                popup.style.display = "none";
        
                // Remove the blur effect
                leftPanel.classList.remove("blur");
                rightPanel.classList.remove("blur");
            };

        }

    </script>

    <script>
        // Create a PHP variable containing the message
        <?php 
            $messageToShow = '';
            if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                $messageToShow = implode(', ', $_SESSION['errors']);
                unset($_SESSION['errors']);
            }
            else if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                $messageToShow = implode(', ', $_SESSION['success']);
                unset($_SESSION['success']); 
            }
        ?>

        // passing the PHP message to JavaScript
        const serverMessage = <?= json_encode($messageToShow) ?>;
    
        // Show popup if there's a message
        if (serverMessage) {
            showAlert(serverMessage);
        }
    </script>

    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.trip-tab');
            const sections = document.querySelectorAll('.trips-section');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs and sections
                    tabs.forEach(t => t.classList.remove('active'));
                    sections.forEach(s => s.classList.remove('active'));

                    // Add active class to clicked tab and corresponding section
                    tab.classList.add('active');
                    document.getElementById(tab.dataset.tab).classList.add('active');
                });
            });
        });

    </script>

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