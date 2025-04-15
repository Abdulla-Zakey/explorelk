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
</head>
<?php
// var_dump($data['accommodationBookingsData']);
?>

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
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="linkItem">
                    <i class="fa-solid fa-house"></i>Home
                </a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyTrips" class="linkItem">
                    <i class="fa-solid fa-person-walking-luggage"></i>
                    My Trips
                </a>
            </div>

            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/MyBookings" class="linkItem" style="color:#002D40 ;">
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
                    <i class="fa-solid fa-user-pen"></i></i>Edit Profile
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
                <!-- <button class="booking-tab" data-tab="all-bookings">
                    <i class="fa-solid fa-list"></i> All Bookings
                </button> -->
            </div>

            <!-- Accommodations Section -->
            <div id="accommodations" class="bookings-section active">
                <?php
                if (!empty($data['accommodationBookingsData'])):
                    ?>
                    <!-- Search and filter section -->
                    <div class="search-filter">
                        <input type="text" placeholder="Search bookings...">
                        <select>
                            <option value="all">All Statuses</option>
                            <option value="approved">Approved</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</optio>
                        </select>
                        <button><i class="fa-solid fa-search"></i> Search</button>
                    </div>
                    <?php
                    foreach ($data['accommodationBookingsData'] as $accommodationBooking):
                        ?>
                        <div class="bookingContainer">
                            <div class="bookingItemImage-Container">
                                <img src="<?= ROOT ?>/<?= htmlspecialchars($accommodationBooking->hotelPic) ?>">
                            </div>

                            <div class="bookingItemDetails">
                                <h2>
                                    <?= htmlspecialchars($accommodationBooking->hotelInfo->hotelName) ?>
                                    <?php
                                    if ($accommodationBooking->booking_status == 'Pending') {
                                        echo '<span class="status-badge pending">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
                                    } else if (($accommodationBooking->booking_status == 'Approved')) {
                                        echo '<span class="status-badge approved">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
                                    } else if (($accommodationBooking->booking_status == 'Confirmed') || ($accommodationBooking->booking_status == 'Completed')) {
                                        echo '<span class="status-badge completed">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
                                    } else if (($accommodationBooking->booking_status == 'Cancelled')) {
                                        echo '<span class="status-badge cancelled">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
                                    }
                                    ?>

                                </h2>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>Check-in Date:
                                    </div>
                                    <div class="secondKid">
                                        <?= htmlspecialchars($accommodationBooking->check_in) ?>
                                    </div>
                                </div>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>Check-out Date:
                                    </div>
                                    <div class="secondKid">
                                        <?= htmlspecialchars($accommodationBooking->check_out) ?>
                                    </div>
                                </div>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid">
                                        <i class="fas fa-credit-card"></i>Advanced Payment:
                                    </div>
                                    <div class="secondKid">
                                        <?= htmlspecialchars($accommodationBooking->advance_payment_status) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="bookingActionBtn-Holder">
                                <a
                                    href="<?= ROOT ?>/traveler/ViewAccommodationBooking/index/<?= $accommodationBooking->room_booking_Id ?>">
                                    <button id="viewBookingBtn" class="actionButtons">
                                        <i class="fas fa-eye"></i>View Details
                                    </button>
                                </a>

                                <?php
                                if ($accommodationBooking->booking_status == 'Pending') {

                                    echo '<a href="' . ROOT . '/traveler/EditAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="editBookingBtn" class="actionButtons">
                                                    <i class="fas fa-edit"></i>Edit Booking
                                                </button>
                                            </a>';

                                    echo '<a href="javascript:void(0)" onclick="showConfirmDeletionPopup(\'Are you sure you want to delete this booking request?\', \'' . ROOT . '/traveler/MyBookings/deleteAccommodationBooking/' . $accommodationBooking->room_booking_Id . '\')">
                                                <button id="cancelBookingBtn" class="actionButtons">
                                                    <i class="fas fa-trash"></i>Delete Request
                                                </button>
                                            </a>';



                                } else if ($accommodationBooking->booking_status == 'Approved') {

                                    echo '<a href="' . ROOT . '/traveler/ConfirmAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="confirmBookingBtn" class="actionButtons">
                                                    <i class="fas fa-check-circle"></i>Confirm Booking
                                                </button>
                                            </a>';

                                    echo '<button id="cancelBookingBtn" class="actionButtons">
                                                <i class="fas fa-ban"></i>Cancel Booking
                                            </button>';

                                } else if ($accommodationBooking->booking_status == 'Confirmed') {

                                    echo '<a href="' . ROOT . '/traveler/ViewAccommodationBookingPaymentReceipt/index/' . $accommodationBooking->room_booking_Id . '" target = "_blank">
                                                <button id="downloadBtn" class="actionButtons">
                                                    <i class="fas fa-download"></i>Download Voucher
                                                </button>
                                            </a>';

                                    echo '<a href = "' . ROOT . '/traveler/CancelAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="cancelBookingBtn" class="actionButtons">
                                                    <i class="fas fa-ban"></i>Cancel Booking
                                                </button>
                                            </a>';

                                } else if ($accommodationBooking->booking_status == 'Completed') {
                                    echo '<a>
                                                <button id="reviewBtn" class="actionButtons">
                                                    <i class="fas fa-star"></i>Leave a Review
                                                </button>
                                            </a>';

                                    echo '<a href="' . ROOT . '/traveler/BookAgain/accommodation/">
                                                <button id="bookAgainBtn" class="actionButtons">
                                                    <i class="fas fa-redo"></i>Book Again
                                                </button>
                                            </a>';

                                } else if ($accommodationBooking->booking_status == 'Cancelled') {
                                    echo '<a href="' . ROOT . '/traveler/TrackAccommodationBookingRefund/index/'. $accommodationBooking->room_booking_Id .'">
                                                <button id="rebookBtn" class="actionButtons">
                                                    <i class="fas fa-search"></i>Track Refund
                                                </button>
                                            </a>';

                                    echo '<a href="' . ROOT . '/traveler/ContactSupport/booking/">
                                                <button id="supportBtn" class="actionButtons">
                                                    <i class="fas fa-headset"></i>Contact Support
                                                </button>
                                            </a>';
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                    endforeach;
                else:
                    ?>
                    <div class="empty-bookings">
                        <i class="fa-solid fa-hotel"></i>
                        <h3>No Accommodation Bookings Yet</h3>
                        <p>Find and book comfortable stays for your next adventure.</p>
                        <a href="<?= ROOT ?>/traveler/SearchAccommodations">
                            <button class="buttonStyle" style="font-family: poppins;">Find Accommodations</button>
                        </a>
                    </div>
                    <?php
                endif;

                ?>

                <script>

                    // Pop-up handling function
                    function showConfirmDeletionPopup(message, deleteUrl) {
                        const popup = document.getElementById("popup");
                        const popupText = document.getElementById("popup-text");
                        const mainContainer = document.querySelector(".mainContainer");

                        popupText.textContent = message;
                        popup.style.display = "flex";

                        //This line is to trigger the animation
                        setTimeout(() => {
                            popup.classList.add("show");
                        }, 10);

                        mainContainer.classList.add("blur");

                        document.getElementById("closePopup").onclick = function () {
                            popup.classList.remove("show");
                            setTimeout(() => {
                                popup.style.display = "none";
                            }, 300); // Match transition time
                            mainContainer.classList.remove("blur");
                        };

                        document.getElementById("confirmDelete").onclick = function () {
                            window.location.href = deleteUrl;
                        };
                    }

                </script>
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


        </div>
    </div>

    <!-- Initially Hidden Container to display Deletion Confrmation Pop-Up Message -->
    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-text"></p>
            <button id="confirmDelete">Delete</button>
            <button id="closePopup">Cancel</button>
        </div>
    </div>

    <!-- Initially Hidden Container to display Success or Failure Pop-Up Message -->
    <div id="successPopup" class="popup-container">
        <div class="popup-content">
            <p id="successPopup-text"></p>
            <button id="closeSuccessPopup">Ok</button>
        </div>
    </div>

    <script>

        // Move this function to the main script block at the bottom
        function showSuccessPopup(message, bookingId = null) {
            const popup = document.getElementById("successPopup");
            const popupText = document.getElementById("successPopup-text");
            const mainContainer = document.querySelector(".mainContainer");

            popupText.innerHTML = message;
            popup.style.display = "flex";

            // Add this line to trigger the animation
            setTimeout(() => {
                popup.classList.add("show");
            }, 10);

            mainContainer.classList.add("blur");

            document.getElementById("closeSuccessPopup").onclick = function () {
                popup.classList.remove("show");
                setTimeout(() => {
                    popup.style.display = "none";
                }, 300); // Match transition time
                mainContainer.classList.remove("blur");
            };
        }

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

            // Check for URL parameters on page load
            // Function to get URL parameters
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            var successMsg = getUrlParameter('success');    // Check for success message
            var bookingId = getUrlParameter('booking_id');  // Get booking ID if available
            var errorMsg = getUrlParameter('error');        // Check for error message

            if (successMsg === 'booking_request_deleted') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold;"><i class="fa fa-check-circle"></i></span>Your booking request has been successfully deleted!', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            if (errorMsg === 'booking_request_deletion_failed') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> There was an error deleting your booking request. Please try again later!');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

        });
    </script>
</body>

</html>