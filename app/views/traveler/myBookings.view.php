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
// var_dump($data['eventBookingsData']);
// exit();
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
                    <i class="fa-solid fa-bell"></i>
                    Notifications
                    <?php if(($data['unreadNotifications']) > 0): ?>
                        <span id="notificationCount" class="notificationCountIndicator">
                            <?= $data['unreadNotifications'] ?>
                        </span>
                    <?php endif; ?>
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

                <button class="booking-tab" data-tab="event-tickets">
                    <i class="fa-solid fa-ticket"></i> Event Tickets
                </button>

                <button class="booking-tab" data-tab="tour-guides">
                    <i class="fa-solid fa-map"></i> Tour Guides
                </button>

                <button class="booking-tab" data-tab="archived-bookings">
                    <i class="fa-solid fa-archive"></i> Archived Bookings
                </button>
            </div>

            <!-- Accommodations Section -->
            <div id="accommodations" class="bookings-section active">
                <?php if (!empty($data['accommodationBookingsData'])): ?>

                    <!-- Search and filter section -->
                    <div class="search-filter">
                        <input type="text" placeholder="Search bookings...">
                        <select>
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</optio>
                        </select>
                        <button><i class="fa-solid fa-search"></i> Search</button>
                    </div>
                    <?php foreach ($data['accommodationBookingsData'] as $accommodationBooking): ?>
                        <?php if ($accommodationBooking->is_archived == 0): ?>
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
                                        } 
                                        else if ($accommodationBooking->booking_status == 'Confirmed') {
                                            echo '<span class="status-badge completed">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
                                        } 
                                        else if (($accommodationBooking->booking_status == 'Completed')) {
                                            echo '<span class="status-badge approved">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
                                        }
                                        else if (($accommodationBooking->booking_status == 'Cancelled')) {
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

                                        echo '<a href="' . ROOT . '/traveler/ConfirmAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="confirmBookingBtn" class="actionButtons">
                                                    <i class="fas fa-check-circle"></i>Confirm Booking
                                                </button>
                                            </a>';

                                        echo '<a href="javascript:void(0)" onclick="showConfirmDeletionPopup(\'Are you sure you want to delete this booking request?\', \'' . ROOT . '/traveler/MyBookings/deleteAccommodationBooking/' . $accommodationBooking->room_booking_Id . '\')">
                                                <button id="cancelBookingBtn" class="actionButtons">
                                                    <i class="fas fa-trash"></i>Delete Request
                                                </button>
                                            </a>';

                                    } else if ($accommodationBooking->booking_status == 'Confirmed') {

                                        echo '<a href="' . ROOT . '/traveler/ViewAccommodationBookingPaymentReceipt/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="downloadBtn" class="actionButtons">
                                                    <i class="fas fa-download"></i>Download Receipt
                                                </button>
                                            </a>';

                                        echo '<a href = "' . ROOT . '/traveler/CancelAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="cancelBookingBtn" class="actionButtons">
                                                    <i class="fas fa-ban"></i>Cancel Booking
                                                </button>
                                            </a>';

                                    } else if ($accommodationBooking->booking_status == 'Completed') {
                                        echo '<a href = "' . ROOT . '/traveler/LeaveReviewForAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="reviewBtn" class="actionButtons">
                                                    <i class="fas fa-star"></i>Leave a Review
                                                </button>
                                            </a>';

                                        echo '<a href="' . ROOT . '/traveler/ViewParticularHotel/index/' . $accommodationBooking->hotel_Id . '">
                                                <button id="bookAgainBtn" class="actionButtons">
                                                    <i class="fas fa-redo"></i>Book Again
                                                </button>
                                            </a>';

                                    } else if ($accommodationBooking->booking_status == 'Cancelled') {
                                        echo '<a href="' . ROOT . '/traveler/TrackAccommodationBookingRefund/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="rebookBtn" class="actionButtons">
                                                    <i class="fas fa-search"></i>Track Refund
                                                </button>
                                            </a>';

                                        if (($accommodationBooking->refund_status == 'Not Eligible') || ($accommodationBooking->refund_status == 'Refunded')) {
                                            echo '<a href="' . ROOT . '/traveler/MyBookings/archiveAccommodationBooking/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="supportBtn" class="actionButtons">
                                                    <i class="fa-solid fa-archive"></i>Archive Booking
                                                </button>
                                            </a>';
                                        } else {
                                            echo '<a href="' . ROOT . '/traveler/ContactSupport/booking/">
                                                <button id="supportBtn" class="actionButtons">
                                                    <i class="fas fa-headset"></i>Contact Support
                                                </button>
                                            </a>';
                                        }

                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="empty-bookings">
                        <i class="fa-solid fa-hotel"></i>
                        <h3>No Accommodation Bookings Yet</h3>
                        <p>Find and book comfortable stays for your next adventure.</p>
                        <a href="<?= ROOT ?>/traveler/SearchAccommodations">
                            <button class="buttonStyle" style="font-family: poppins;">
                                Find Accommodations
                            </button>
                        </a>
                    </div>

                <?php endif; ?>

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

            <div id="event-tickets" class="bookings-section">
                <?php if (!empty($data['eventBookingsData'])): ?>
                    <!-- Search and filter section -->
                    <div class="search-filter">
                        <input type="text" placeholder="Search bookings...">
                        <select>
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</optio>
                        </select>
                        <button><i class="fa-solid fa-search"></i> Search</button>
                    </div>

                    <?php foreach ($data['eventBookingsData'] as $eventBooking): ?>
                        <div class="bookingContainer">
                            <div class="bookingItemImage-Container">
                                <img src="<?= IMAGES . '/events/eventThumbnailPics/' . htmlspecialchars($eventBooking->eventInfo->eventThumnailPic) ?>">
                            </div>

                            <div class="bookingItemDetails">
                                <h2>
                                    <?= htmlspecialchars($eventBooking->eventInfo->eventName) ?>
                                    <?php
                                        if ($eventBooking->eventInfo->eventStatus == 'approved' && $eventBooking->eventInfo->eventDate == date('Y-m-d')) {
                                            echo '<span class="status-badge completed">Live Today</span>';
                                        } 
                                        else if ($eventBooking->eventInfo->eventStatus == 'approved') {
                                            echo '<span class="status-badge pending">Upcoming</span>';
                                        } 
                                        else if ($eventBooking->eventInfo->eventStatus == 'cancelled') {
                                            echo '<span class="status-badge cancelled">Cancelled</span>';
                                        } 
                                        else if($eventBooking->eventInfo->eventStatus == 'completed') {
                                            echo '<span class="status-badge approved">Completed</span>';
                                        } 

                                    ?>
                                </h2>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid">
                                        <i class="fa fa-calendar-o" aria-hidden="true"></i>Event Date:
                                    </div>
                                    <div class="secondKid">
                                    <?= (date('F d, Y', strtotime(htmlspecialchars($eventBooking->eventInfo->eventDate)))) ?>
                                    </div>
                                </div>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid">
                                        <i class="fa-solid fa-hourglass-start" aria-hidden="true"></i>Event Start Time:
                                    </div>
                                    <div class="secondKid">
                                        <?= (date('h:i A', strtotime(htmlspecialchars($eventBooking->eventInfo->eventStartTime)))) ?>
                                    </div>
                                </div>

                                <div class="bookingKeyInfo-Holder">
                                    <div class="firstKid">
                                        <i class="fa-solid fa-hourglass-end" aria-hidden="true"></i>Event End Time:
                                    </div>
                                    <div class="secondKid">
                                        <?= (date('h:i A', strtotime(htmlspecialchars($eventBooking->eventInfo->eventEndTime)))) ?>
                                    </div>
                                </div>

                            </div>

                            <div class="bookingActionBtn-Holder">
                                <a href="<?= ROOT ?>/traveler/ViewEventBooking/index/<?= $eventBooking->booking_Id ?>">
                                    <button id="viewBookingBtn" class="actionButtons">
                                        <i class="fas fa-eye"></i>View Details
                                    </button>
                                </a>

                                <?php
                                    if ($eventBooking->eventInfo->eventStatus == 'approved') {
                                        echo '<a href="' . ROOT . '/traveler/ViewEventBookingTickets/index/' . $eventBooking->booking_Id . '">
                                                <button id="downloadBtn" class="actionButtons">
                                                    <i class="fas fa-download"></i>Download Ticket
                                                </button>
                                            </a>';
                                    } 

                                    else if ($eventBooking->eventInfo->eventStatus == 'cancelled') {
                                        echo '<a href="' . ROOT . '/traveler/TrackEventBookingRefund/index/' . $eventBooking->booking_Id . '">
                                                <button id="rebookBtn" class="actionButtons">
                                                    <i class="fas fa-search"></i>Track Refund
                                                </button>
                                            </a>';
                                    }
                                    else if($eventBooking->eventInfo->eventStatus == 'completed'){
                                        echo '<a href = "' . ROOT . '/traveler/LeaveReviewForAccommodationBooking/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="reviewBtn" class="actionButtons">
                                                    <i class="fas fa-star"></i>Leave a Review
                                                </button>
                                            </a>';
                                        
                                        echo '<a href="' . ROOT . '/traveler/ViewParticularHotel/index/' . $accommodationBooking->hotel_Id . '">
                                            <button id="bookAgainBtn" class="actionButtons">
                                                <i class="fas fa-redo"></i>Book Similar Events
                                            </button>
                                        </a>';
                                    }

                                    if (($eventBooking->eventInfo->eventStatus == 'approved')||($eventBooking->eventInfo->eventStatus == 'cancelled')) {
                                        echo '<a href="' . ROOT . '/traveler/ContactSupport/booking/">
                                                <button id="supportBtn" class="actionButtons">
                                                    <i class="fas fa-headset"></i>Contact Support
                                                </button>
                                            </a>';
                                    }
                                ?>

                            </div>
                                
                        </div>
                    
                    <?php endforeach; ?>

                <?php else:?>

                    <div class="empty-bookings">
                        <i class="fa-solid fa-ticket"></i>
                        <h3>No Event Tickets Booked Yet</h3>
                        <p>Discover exciting events and grab your tickets now.</p>
                        <a href="<?= ROOT ?>/traveler/ViewAllEvents">
                            <button class="buttonStyle" style="font-family: poppins;">
                            Browse Events
                            </button>
                        </a>
                    </div>

                <?php endif; ?>

            </div>

            <!-- Tour Guides Section -->
            <div id="tour-guides" class="bookings-section">
                <?php if (!empty($data['tourBookingsData'])): ?>
                    <!-- Search and filter section -->
                    <div class="search-filter">
                        <input type="text" placeholder="Search bookings...">
                        <select>
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</optio>
                        </select>
                        <button><i class="fa-solid fa-search"></i> Search</button>
                    </div>

                    <?php foreach ($data['tourBookingsData'] as $tourBooking): ?>
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
                    <?php endforeach; ?>
                <?php else: ?>

                    <!-- Empty state for tour guides if needed -->
                    <div class="empty-bookings" style="display: none;">
                        <i class="fa-solid fa-map-marked-alt"></i>
                        <h3>No Tour Guide Bookings Yet</h3>
                        <p>Enhance your travel experience by booking a local guide for your next adventure.</p>
                        <a href="<?= ROOT ?>/traveler/SearchTourGuides">
                            <button class="buttonStyle">Find Tour Guides</button>
                        </a>
                    </div>
                <?php endif; ?>

            </div>

            <div id="archived-bookings" class="bookings-section">
                <div class="search-filter">
                    <input type="text" id="past-search" placeholder="Search past bookings...">

                    <select id="past-booking-type">
                        <option value="all">All Booking Types</option>
                        <option value="accommodation">Accommodations</option>
                        <option value="car-rental">Car Rentals</option>
                        <option value="tour-guide">Tour Guides</option>
                    </select>

                    <button id="past-search-btn">
                        <i class="fa-solid fa-search"></i>
                        Search
                    </button>
                </div>

                <?php if (!empty($data['accommodationBookingsData'])): ?>
                    <?php foreach ($data['accommodationBookingsData'] as $accommodationBooking): ?>
                        <?php if ($accommodationBooking->is_archived == 1): ?>
                            <div class="bookingContainer">
                                <div class="bookingItemImage-Container">
                                    <img src="<?= ROOT ?>/<?= htmlspecialchars($accommodationBooking->hotelPic) ?>">
                                </div>

                                <div class="bookingItemDetails">
                                    <h2>
                                        <?= htmlspecialchars($accommodationBooking->hotelInfo->hotelName) ?>
                                        <!-- Since am archiving the cancelled bookings only I use cancell badge only -->
                                        <?php
                                        echo '<span class="status-badge cancelled">' . htmlspecialchars($accommodationBooking->booking_status) . '</span>';
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

                                    if ($accommodationBooking->booking_status == 'Cancelled') {
                                        echo '<a href="' . ROOT . '/traveler/TrackAccommodationBookingRefund/index/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="rebookBtn" class="actionButtons">
                                                    <i class="fas fa-search"></i>Track Refund
                                                </button>
                                            </a>';

                                        if (($accommodationBooking->refund_status == 'Not Eligible') || ($accommodationBooking->refund_status == 'Refunded')) {
                                            echo '<a href="' . ROOT . '/traveler/MyBookings/unarchiveAccommodationBooking/' . $accommodationBooking->room_booking_Id . '">
                                                <button id="supportBtn" class="actionButtons">
                                                    <i class="fa-solid fa-rotate-left"></i>Unarchive Booking
                                                </button>
                                            </a>';
                                        } else {
                                            echo '<a href="' . ROOT . '/traveler/ContactSupport/booking/">
                                                <button id="supportBtn" class="actionButtons">
                                                    <i class="fas fa-headset"></i>Contact Support
                                                </button>
                                            </a>';
                                        }

                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php else: ?>
                    <div class="empty-bookings">
                        <i class="fa-solid fa-hotel"></i>
                        <h3>No Accommodation Bookings Yet</h3>
                        <p>Find and book comfortable stays for your next adventure.</p>
                        <a href="<?= ROOT ?>/traveler/SearchAccommodations">
                            <button class="buttonStyle" style="font-family: poppins;">Find Accommodations</button>
                        </a>
                    </div>

                <?php endif; ?>

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
            <button id="closeSuccessPopup">OK</button>
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

            // This is to indicate booking deletion success
            if (successMsg === 'booking_request_deleted') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold;"><i class="fa fa-check-circle"></i></span>Your booking request has been successfully deleted!', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate booking deletion failure
            if (errorMsg === 'booking_request_deletion_failed') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> There was an error deleting your booking request. Please try again later!');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate booking update success
            if (successMsg === 'Accommodation_Booking_Updated_Successfully!') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold; margin-right: 5px;"><i class="fa fa-check-circle"></i></span> Your booking details have been updated successfully.', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate booking update failure
            if (errorMsg === 'Accommodation_Booking_Updation_Failed!') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> Unable to update booking details. Please try again later');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate booking cancellation success
            if (successMsg === 'booking_cancelled_successfully') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold; margin-right: 5px;"><i class="fa fa-check-circle"></i></span> Your booking has been cancelled successfully', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate booking cancellation failure
            if (errorMsg === 'failed_to_create_cancellation_record') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> Unable to cancel your booking. Please try again later');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate booking review submission success
            if (successMsg === 'review_submitted_successfully') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold;"><i class="fa fa-check-circle"></i></span> Your review has been submitted successfully. <br>You can now find it under the hotel\'s reviews section', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            if (errorMsg === 'existing_review_found_for_the_booking') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> You’ve already submitted a review for this booking. Only one review is allowed per booking');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate archieving booking success
            if (successMsg === 'booking_archived_successfully') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold;"><i class="fa fa-check-circle"></i></span> Your booking has been archieved successfully. <br>You can now find it under the Archieved Bookings', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate archieving booking failure
            if (errorMsg === 'failed_to_archive_booking') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> Unable to archieve your booking. Please try again later');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate unArchieving booking success
            if (successMsg === 'booking_unarchived_successfully') {
                showSuccessPopup('<span style="color: #4CAF50; font-weight: bold;"><i class="fa fa-check-circle"></i></span> Your booking has been unarchieved successfully. <br>You can now find it under the Accommodation Bookings', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            // This is to indicate archieving booking failure
            if (errorMsg === 'failed_to_unarchive_booking') {
                showSuccessPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> Unable to unarchieve your booking. Please try again later');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

        });
    </script>
</body>

</html>