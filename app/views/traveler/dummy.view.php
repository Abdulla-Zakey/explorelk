<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/registeredUser.css">
    <link rel="stylesheet" href="<?= CSS ?>/traveler/myBookings.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | My Bookings</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        /* Tabs styling */
        .bookings-tabs {
            display: flex;
            gap: 2rem;
            margin: 0rem;
        }

        .booking-tab {
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

        .booking-tab i {
            margin-right: 0.25rem;
        }

        .booking-tab.active {
            color: #1E7A8F;
            border-bottom: 3px solid #1E7A8F;
            font-weight: 600;
        }

        .booking-tab:hover {
            color: #1E7A8F;
        }

        .bookings-section {
            display: none;
        }

        .bookings-section.active {
            display: block;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 0.5rem;
            font-size: 1.2rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .status-badge.approved {
            background-color: rgba(76, 175, 80, 0.15);
            color: #4CAF50;
        }

        .status-badge.pending {
            background-color: rgba(255, 152, 0, 0.15);
            color: #FF9800;
        }

        .status-badge.completed {
            background-color: rgba(3, 169, 244, 0.15);
            color: #03A9F4;
        }

        .status-badge.cancelled {
            background-color: rgba(244, 67, 54, 0.15);
            color: #F44336;
        }

        /* Empty state */
        .empty-bookings {
            display: flex;
            border: 1px solid #d3d3d3;
            border-radius: 1rem;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5rem;
            text-align: center;
            min-height: 30vh;
            margin-top: 2%;
        }

        .empty-bookings i {
            font-size: 5rem;
            color: #1E7A8F;
            margin-bottom: 2rem;
            opacity: 0.7;
        }

        .empty-bookings h3 {
            font-size: 2.4rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .empty-bookings p {
            font-size: 1.6rem;
            color: #666;
            margin-bottom: 2rem;
        }

        /* Pop-up container (initially hidden) */
        .popup-container {
            font-size: 1.35rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* Dark transparent overlay */
            display: none;
            /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 999;
            /* Above other content */
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

        /* Buttons */
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

        /* Add new booking button */
        .header-container {
            display: flex;
            width: 100%;
        }

        .header-container h1 {
            font-size: 4.8rem;
            margin-top: 2.5%;
            width: 85%;
        }

        .search-filter {
            display: flex;
            align-items: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        .search-filter input {
            flex: 1;
            padding: 1rem;
            border: 1px solid #d3d3d3;
            border-radius: 0.5rem;
            font-size: 1.4rem;
        }

        .search-filter select {
            padding: 1rem 15rem 1rem 1rem;
            border: 1px solid #d3d3d3;
            border-radius: 0.5rem;
            font-size: 1.4rem;
        }

        .search-filter button {
            padding: 1rem 2.5rem 1rem 2.5rem;
            background-color: #1E7A8F;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            cursor: pointer;
        }

        .search-filter button:hover {
            background-color: #3DA4BF;
        }
    </style>
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

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="linkItem"><i
                        class="fa-solid fa-house"></i>Home</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyTrips" class="linkItem"><i
                        class="fa-solid fa-person-walking-luggage"></i>My Trips</a>
            </div>

            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyBookings" class="linkItem" style="color:#002D40 ;"><i
                        class="fa-solid fa-book-open"></i>My Bookings</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Messages" class="linkItem"><i class="fa-solid fa-message"></i>Messages</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Notifications" class="linkItem"><i
                        class="fa-solid fa-bell"></i>Notifications</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/ViewProfile" class="linkItem"><i class="fa-solid fa-user"></i>View
                    Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/EditProfile" class="linkItem"><i class="fa-solid fa-user-pen"></i></i>Edit
                    Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem"><i
                        class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>

        <div class="rightPanel">
            <div class="header-container">
                <h1>My Bookings</h1>
            </div>

            <!-- Tabs for switching between different booking types -->
            <div class="bookings-tabs">
                <button class="booking-tab active" data-tab="accommodations">
                    <i class="fa-solid fa-bed"></i> Accommodations
                </button>
                <button class="booking-tab" data-tab="car-rentals">
                    <i class="fa-solid fa-car"></i> Car Rentals
                </button>
                <button class="booking-tab" data-tab="tour-guides">
                    <i class="fa-solid fa-map"></i> Tour Guides
                </button>
                <button class="booking-tab" data-tab="all-bookings">
                    <i class="fa-solid fa-list"></i> All Bookings
                </button>
            </div>

            <!-- Search and filter section -->
            <div class="search-filter">
                <input type="text" placeholder="Search bookings...">
                <select>
                    <option value="all">All Statuses</option>
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button><i class="fa-solid fa-search"></i> Search</button>
            </div>

            <!-- Accommodations Section -->
            <div id="accommodations" class="bookings-section active">
                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/findHotel/Delhousie/Delhousie Hotel.jpg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Delhousie Hotel
                            <span class="status-badge completed">Completed</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Check-in Date:
                            </div>
                            <div class="secondKid">
                                20-10-2024
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Check-out Date:
                            </div>
                            <div class="secondKid">
                                22-10-2024
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Completed
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/accommodation/1">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Write Review
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-receipt"></i>View Receipt
                        </button>
                    </div>
                </div>

                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/findHotel/Amaya/Amaya Hills.jpg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Amaya Hills Resort
                            <span class="status-badge approved">Approved</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Check-in Date:
                            </div>
                            <div class="secondKid">
                                05-05-2025
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Check-out Date:
                            </div>
                            <div class="secondKid">
                                08-05-2025
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Pending
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/accommodation/2">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Edit Booking
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-ban"></i>Cancel Booking
                        </button>
                    </div>
                </div>
            </div>

            <!-- Car Rentals Section -->
            <div id="car-rentals" class="bookings-section">
                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/carRental/Alto.jpeg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Suzuki Alto 800
                            <span class="status-badge approved">Approved</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Pickup Date:
                            </div>
                            <div class="secondKid">
                                15-11-2024
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Return Date:
                            </div>
                            <div class="secondKid">
                                18-11-2024
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Pending
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/carRental/1">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Edit Booking
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-ban"></i>Cancel Booking
                        </button>
                    </div>
                </div>

                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/carRental/Aqua.jpg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Toyota Aqua
                            <span class="status-badge pending">Pending</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Pickup Date:
                            </div>
                            <div class="secondKid">
                                10-04-2025
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Return Date:
                            </div>
                            <div class="secondKid">
                                15-04-2025
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Not Paid
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/carRental/2">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Edit Booking
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-ban"></i>Cancel Booking
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tour Guides Section -->
            <div id="tour-guides" class="bookings-section">
                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/tourGuides/guide1.jpg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Sigiriya Tour with John Perera
                            <span class="status-badge pending">Pending</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Tour Date:
                            </div>
                            <div class="secondKid">
                                25-04-2025
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>Duration:
                            </div>
                            <div class="secondKid">
                                Full Day (8 hours)
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Not Paid
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/tourGuide/1">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Edit Booking
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-ban"></i>Cancel Booking
                        </button>
                    </div>
                </div>

                <!-- Empty state for tour guides if needed -->
                <div class="empty-bookings" style="display: none;">
                    <i class="fa-solid fa-map-marked-alt"></i>
                    <h3>No Tour Guide Bookings Yet</h3>
                    <p>Enhance your travel experience by booking a local guide for your next adventure.</p>
                    <a href="<?= ROOT ?>/traveler/SearchTourGuides">
                        <button class="buttonStyle">Find Tour Guides</button>
                    </a>
                </div>
            </div>

            <!-- All Bookings Section -->
            <div id="all-bookings" class="bookings-section">
                <!-- Car Rental Booking -->
                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/carRental/Alto.jpeg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Suzuki Alto 800
                            <span class="status-badge approved">Approved</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa-solid fa-tag"></i>Booking Type:
                            </div>
                            <div class="secondKid">
                                Car Rental
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Booking Date:
                            </div>
                            <div class="secondKid">
                                15-11-2024
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Pending
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/carRental/1">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Edit Booking
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-ban"></i>Cancel Booking
                        </button>
                    </div>
                </div>

                <!-- Accommodation Booking -->
                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/findHotel/Delhousie/Delhousie Hotel.jpg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Delhousie Hotel
                            <span class="status-badge completed">Completed</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa-solid fa-tag"></i>Booking Type:
                            </div>
                            <div class="secondKid">
                                Accommodation
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Booking Date:
                            </div>
                            <div class="secondKid">
                                20-10-2024
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Completed
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/accommodation/1">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Write Review
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-receipt"></i>View Receipt
                        </button>
                    </div>
                </div>

                <!-- Tour Guide Booking -->
                <div class="bookingContainer">
                    <div class="bookingItemImage-Container">
                        <img src="<?= IMAGES ?>/travelers/tourGuides/guide1.jpg">
                    </div>

                    <div class="bookingItemDetails">
                        <h2>
                            Sigiriya Tour with John Perera
                            <span class="status-badge pending">Pending</span>
                        </h2>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa-solid fa-tag"></i>Booking Type:
                            </div>
                            <div class="secondKid">
                                Tour Guide
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>Booking Date:
                            </div>
                            <div class="secondKid">
                                25-04-2025
                            </div>
                        </div>

                        <div class="bookingKeyInfo-Holder">
                            <div class="firstKid">
                                <i class="fas fa-credit-card"></i>Payment Status:
                            </div>
                            <div class="secondKid">
                                Not Paid
                            </div>
                        </div>
                    </div>

                    <div class="bookingActionBtn-Holder">
                        <a href="<?= ROOT ?>/traveler/ViewBookings/tourGuide/1">
                            <button id="viewBookingBtn" class="actionButtons">
                                <i class="fas fa-eye"></i>View Details
                            </button>
                        </a>

                        <button id="editBookingBtn" class="actionButtons">
                            <i class="fas fa-edit"></i>Edit Booking
                        </button>

                        <button id="deleteBookingBtn" class="actionButtons">
                            <i class="fas fa-ban"></i>Cancel Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-Up Message -->
    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-message">Can't edit the booking details as the booking status is Approved or Completed.</p>
            <button id="closePopup">OK</button>
        </div>
    </div>

    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.booking-tab');
            const sections = document.querySelectorAll('.bookings-section');

            // Function to set active tab
            function setActiveTab(tabId) {
                // Remove active class from all tabs and sections
                tabs.forEach(t => t.classList.remove('active'));
                sections.forEach(s => s.classList.remove('active'));

                // Add active class to clicked tab and corresponding section
                const clickedTab = document.querySelector(`.booking-tab[data-tab="${tabId}"]`);
                if (clickedTab) clickedTab.classList.add('active');

                const activeSection = document.getElementById(tabId);
                if (activeSection) activeSection.classList.add('active');
            }

            // Add click event to tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    setActiveTab(tab.dataset.tab);
                });
            });

            // Pop-up handling
            const editButtons = document.querySelectorAll('#editBookingBtn');
            const deleteButtons = document.querySelectorAll('#deleteBookingBtn');
            const popup = document.getElementById('popup');
            const closePopup = document.getElementById('closePopup');
            const popupMessage = document.getElementById('popup-message');
            const mainContainer = document.querySelector('.mainContainer');

            // Function to show popup
            function showPopup(message) {
                popupMessage.textContent = message;
                popup.style.display = 'flex';
                mainContainer.classList.add('blur');
            }

            // Handle edit booking buttons
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bookingContainer = this.closest('.bookingContainer');
                    const statusBadge = bookingContainer.querySelector('.status-badge');
                    const buttonText = this.innerText.trim();

                    if (buttonText === "Write Review") {
                        // Redirect to review page
                        console.log("Redirecting to write review page");
                        // You could add actual redirect here
                        // window.location.href = "<?= ROOT ?>/traveler/WriteReview/" + bookingId;
                    } else if (statusBadge && statusBadge.classList.contains('completed')) {
                        showPopup("Can't edit the booking details as the booking status is Completed.");
                    } else if (statusBadge && statusBadge.classList.contains('approved')) {
                        showPopup("Editing an approved booking may result in additional fees. Do you want to proceed?");
                        // You could modify this to have Yes/No buttons for confirmation
                    } else {
                        // For pending bookings, redirect to edit page
                        console.log("Redirecting to edit page");
                        // Actual redirect would go here
                        // window.location.href = "<?= ROOT ?>/traveler/EditBooking/" + bookingType + "/" + bookingId;
                    }
                });
            });

            // Handle cancel/delete booking buttons
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const bookingContainer = this.closest('.bookingContainer');
                    const statusBadge = bookingContainer.querySelector('.status-badge');
                    const buttonText = this.innerText.trim();

                    if (buttonText === "View Receipt") {
                        // Redirect to receipt page
                        console.log("Redirecting to view receipt page");
                        // Actual redirect would go here
                        // window.location.href = "<?= ROOT ?>/traveler/ViewReceipt/" + bookingId;
                    } else if (statusBadge && statusBadge.classList.contains('completed')) {
                        showPopup("Can't cancel a completed booking.");
                    } else if (statusBadge && statusBadge.classList.contains('approved')) {
                        showPopup("Cancelling an approved booking may result in cancellation fees. Do you want to proceed?");
                        // You could modify this to have Yes/No buttons for confirmation
                    } else {
                        // For pending bookings, show cancellation confirmation
                        showPopup("Are you sure you want to cancel this booking?");
                        // You could modify this to have Yes/No buttons for confirmation
                    }
                });
            });

            // Close popup
            closePopup.addEventListener('click', function () {
                popup.style.display = 'none';
                mainContainer.classList.remove('blur');
            });

            // Search and filter functionality
            const searchInput = document.querySelector('.search-filter input');
            const statusFilter = document.querySelector('.search-filter select');
            const searchButton = document.querySelector('.search-filter button');

            searchButton.addEventListener('click', function () {
                const searchTerm = searchInput.value.toLowerCase();
                const filterStatus = statusFilter.value;

                document.querySelectorAll('.bookingContainer').forEach(booking => {
                    const bookingTitle = booking.querySelector('h2').textContent.toLowerCase();
                    const statusBadge = booking.querySelector('.status-badge');
                    const status = statusBadge ? statusBadge.classList[1] : '';

                    // Check if booking matches search term and filter
                    const matchesSearch = searchTerm === '' || bookingTitle.includes(searchTerm);
                    const matchesFilter = filterStatus === 'all' || status === filterStatus;

                    // Show or hide booking based on matches
                    if (matchesSearch && matchesFilter) {
                        booking.style.display = 'flex';
                    } else {
                        booking.style.display = 'none';
                    }
                });

                // Check if any bookings are visible in the current tab
                const currentTab = document.querySelector('.booking-tab.active').dataset.tab;
                const currentSection = document.getElementById(currentTab);
                const visibleBookings = Array.from(currentSection.querySelectorAll('.bookingContainer')).filter(b => b.style.display !== 'none');

                // Show empty state if no bookings match the search/filter
                const emptyState = currentSection.querySelector('.empty-bookings');
                if (emptyState) {
                    emptyState.style.display = visibleBookings.length === 0 ? 'flex' : 'none';
                }
            });
        });
    </script>