<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/registeredUser.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/traveler/myBookings.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Home</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    

    <style>
        body{
            margin: 0px;
        }
        .leftPanel h1{
            font-size: 3.2rem;
        }
    </style>
</head>
<body>
    <div class = "mainContainer">

        <div class = "leftPanel">
            <div class = "logo">
                <img src = "<?= IMAGES ?>/logos/logoWhite.svg" alt = "Logo">
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

            <div id = "activeLink" class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyBookings" class = "linkItem" style="color:#002D40 ;"><i class="fa-solid fa-book-open"></i>My Bookings</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Messages" class = "linkItem"><i class="fa-solid fa-message"></i>Messages</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Notifications" class = "linkItem"><i class="fa-solid fa-bell"></i>Notifications</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/ViewProfile" class = "linkItem"><i class="fa-solid fa-user"></i>View Profile</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/EditProfile" class = "linkItem"><i class="fa-solid fa-user-pen"></i></i>Edit Profile</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Home" class = "linkItem"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
            
            
        </div>

        <div class = "rightPanel">
            <h1>
                My Bookings
            </h1>

            <div class = "bookingContainer">

                <div class = "bookingItemImage-Container">
                    <img src = "<?= IMAGES ?>/travelers/carRental/Alto.jpeg">
                </div>

                <div class = "bookingItemDetails">
                    <h2>
                        Suzuki Alto 800
                    </h2>

                    <div class = "bookingKeyInfo-Holder">
                        <div>
                            <i class="fa fa-calendar-o" aria-hidden="true"></i>Booked Date:
                        </div>
                        <div>
                            15-11-2024
                        </div>
                    </div>

                    <div class = "bookingKeyInfo-Holder">
                        <div>
                            <i class="fas fa-hourglass-half"></i>Booking Status:
                        </div>

                        <div id = "bookingStatus">
                            Approved
                        </div>
                    </div>

                    <div class = "bookingKeyInfo-Holder">
                        <div>
                            <i class="fas fa-credit-card"></i>Payment Status:
                        </div>

                        <div>
                            Pending
                        </div>
                    </div>

                </div>

                <div class = "bookingActionBtn-Holder">

                    <button id = "viewBookingBtn" class = "actionButtons">
                        <a href = "<?= ROOT ?>/traveler/ViewBookings">
                            <i class="fas fa-eye"></i>View Booking
                        </a>
                    </button>

                    <button id = "editBookingBtn" class = "actionButtons">
                        <i class="fas fa-edit"></i> Edit Booking
                    </button>

                    <button id ="deleteBookingBtn" class = "actionButtons">
                        <i class="fas fa-ban"></i>Cancel Booking
                    </button>

                </div>
                
            </div>

            <div class = "bookingContainer">

                <div class = "bookingItemImage-Container">
                    <img src = "<?= IMAGES ?>/travelers/findHotel/Delhousie/Delhousie Hotel.jpg">
                </div>

                <div class = "bookingItemDetails">
                    <h2>
                        Delhousie Hotel
                    </h2>

                    <div class = "bookingKeyInfo-Holder">

                        <div>
                            <i class="fa fa-calendar-o" aria-hidden="true"></i>Booked Date:
                        </div>
                        <div>
                            20-10-2024
                        </div>

                    </div>

                    <div class = "bookingKeyInfo-Holder">
                        <div>
                            <i class="fas fa-hourglass-half"></i>Booking Status:
                        </div>

                        <div>
                            Completed
                        </div>
                    </div>

                    <div class = "bookingKeyInfo-Holder">
                        <div>
                            <i class="fas fa-credit-card"></i>Payment Status:
                        </div>

                        <div>
                            Completed
                        </div>
                    </div>

                </div>

                <div class = "bookingActionBtn-Holder">

                    <button id = "viewBookingBtn" class = "actionButtons">
                        <i class="fas fa-eye"></i>View Booking
                    </button>

                    <button id = "editBookingBtn" class = "actionButtons">
                        <i class="fas fa-edit"></i> Edit Booking
                    </button>

                    <button id ="deleteBookingBtn" class = "actionButtons">
                        <i class="fas fa-ban"></i>Cancel Booking
                    </button>

                </div>
                
            </div>

        </div>

    </div>
    
    <!-- Pop-Up Message ------------------------------------------------------------------------------------>
    <div id="popup" class="popup-container">

        <div class="popup-content">
            <p>Can't edit the booking details as the booking status is Approved or Completed.</p>
            <button id="closePopup">OK</button>
        </div>

    </div>

    <script>
        // Get references to elements
        const bookingStatusElement = document.getElementById("bookingStatus");
        const editButton = document.getElementById("editBookingBtn");
        const popup = document.getElementById("popup");
        const closePopup = document.getElementById("closePopup");
        const bookingContainer = document.querySelector(".bookingContainer");

        // Add event listener to the Edit button
        editButton.addEventListener("click", function () {
            const bookingStatus = bookingStatusElement.textContent.trim();

            // Check if booking status is "Approved"
            if (bookingStatus === "Approved" || bookingStatus === "Completed") {
                // Show the pop-up
                popup.style.display = "flex";
                // Blur the background
                bookingContainer.classList.add("blur");
            } else {
                // Redirect to the edit page or other logic
                window.location.href = "editBooking.html";
            }
        });

        // Add event listener to close the pop-up
        closePopup.addEventListener("click", function () {
            // Hide the pop-up
            popup.style.display = "none";
            // Remove the blur effect
            bookingContainer.classList.remove("blur");
        });

    </script>
</body>

</html>
