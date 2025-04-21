<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewAccommodationBooking.css">

    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Booking Details</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        /* .payment-deadline-info {
            margin-top: 1.5rem;
            border-top: 1px dashed var(--warning-color);
            padding-top: 1.5rem;
        } */

        .deadline-highlight {
            color: var(--warning-color);
            font-weight: 700;
            font-size: 18px;
        }

        .deadline-note {
            font-size: 13px;
            color: var(--danger-color);
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/MyBookings">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </nav>
    </header>

    <div class="container" style="margin-top: 7.5%;">
        <div class="booking-details" id="bookingDetails">
            <div class="booking-content">
                <div class="booking-header">
                    <h1 class="booking-title">
                        <span id="hotelName"><?= htmlspecialchars($data['hotelData']->hotelName) ?></span>
                        <div class="booking-status status-<?= strtolower($data['bookingData']->booking_status) ?>"
                            id="bookingStatus">
                            <?= htmlspecialchars($data['bookingData']->booking_status) ?>
                        </div>
                    </h1>
                </div>

                <div class="booking-grid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- 1. Booking Date Details -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-calendar"></span>
                                Booking Details
                            </h2>

                            <div class="date-info">
                                <div class="date-box check-in">
                                    <div class="date-day" id="checkInDay">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_in))) ?>
                                    </div>

                                    <div class="info-label">Check-in</div>
                                </div>
                                <div class="date-divider">→</div>
                                <div class="date-box check-out">
                                    <div class="date-day" id="checkOutDay">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_out))) ?>
                                    </div>
                                    <div class="info-label">Check-out</div>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Total Nights</div>
                                <div class="info-value" id="totalNights">
                                    <?= htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) ?>
                                    Nights
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Total Rooms</div>
                                <div class="info-value" id="totalRooms">
                                    <?= htmlspecialchars($data['bookingData']->total_rooms) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Request Date</div>
                                <div class="info-value" id="requestDate">
                                    <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($data['bookingData']->requested_date))) ?>
                                </div>
                            </div>

                            <?php if ($data['bookingData']->booking_status == 'Pending'): ?>
                                <div class="info-group payment-deadline-info">
                                    <div class="info-label">Advance Payment Deadline</div>
                                    <div class="info-value deadline-highlight" id="paymentDeadline">
                                        <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($data['bookingData']->advance_payment_deadline))) ?>
                                        
                                    </div>
                                    <div class="deadline-note">
                                        <a href = "#payment-notice" title = "Click here for more details" style="text-decoration: none; color: var(--danger-color);">
                                            Your booking will be cancelled if payment is not received by this time
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>

                        <!-- 2. Room Details -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-bed"></span>
                                Room Details
                            </h2>

                            <div class="room-type-card">
                                <img src="<?= ROOT . '/' . htmlspecialchars($data['bookedRoomTypeDetails']->thumbnail_picPath) ?>"
                                    alt="<?= $data['bookedRoomTypeDetails']->roomTypeName ?>" class="room-image">
                                <div class="room-details">
                                    <div class="room-type" id="roomType">
                                        <?= $data['bookedRoomTypeDetails']->roomTypeName ?>
                                    </div>
                                    <div class="room-occupancy">
                                        <span class="occupancy-icon">👤 Maximum Occupancy</span>
                                        <span
                                            id="maxOccupancy"><?= $data['bookedRoomTypeDetails']->max_occupancy ?></span>
                                    </div>
                                    <div class="room-price">
                                        <span
                                            id="pricePerNight"><?= $data['bookedRoomTypeDetails']->pricePer_night ?></span>
                                        LKR per night
                                    </div>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="section-title">
                                    <span class="icon icon-request"></span>
                                    Special Requests
                                </div>
                                <div class="special-requests" id="specialRequests">
                                    <?= htmlspecialchars($data['bookingData']->special_requests) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="right-column">
                        <!-- 3. Guest Information -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-person"></span>
                                Guest Information
                            </h2>

                            <table class="guest-table">
                                <tbody id="guestTableBody">
                                    <tr>
                                        <th>Guest Name</th>
                                        <td><?= htmlspecialchars($data['guestData']->guest_full_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIC</th>
                                        <td><?= htmlspecialchars($data['guestData']->guest_nic) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= htmlspecialchars($data['guestData']->guest_email) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Num</th>
                                        <td><?= htmlspecialchars($data['guestData']->guest_mobile_num) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- 4. Hotel Information -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-hotel"></span>
                                Hotel Information
                            </h2>

                            <div class="info-group">
                                <div class="info-label">Hotel Name</div>
                                <div class="info-value" id="hotelNameInfo">
                                    <?= htmlspecialchars($data['hotelData']->hotelName) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Address</div>
                                <div class="info-value" id="hotelAddress">
                                    <?= htmlspecialchars($data['hotelData']->hotelAddress) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Contact</div>
                                <div class="info-value" id="hotelContact">
                                    <?= htmlspecialchars($data['hotelData']->hotelMobileNum) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Email</div>
                                <div class="info-value" id="hotelEmail">
                                    <?= htmlspecialchars($data['hotelData']->hotelEmail) ?>
                                </div>
                            </div>
                        </div>



                        <!-- 5. Payment Details (Last) -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-money"></span>
                                Payment Details
                            </h2>

                            <div class="payment-info">
                                <div class="payment-row">
                                    <div>Room Charges for the Complete Stay</div>
                                    <div><span
                                            id="roomCharges"><?= htmlspecialchars($data['bookingData']->total_amount) ?>
                                            LKR</span></div>
                                </div>
                                <div class="payment-row">
                                    <div>Taxes & Fees</div>
                                    <div><span id="taxesAndFees">0 LKR</span></div>
                                </div>
                                <div class="payment-row total">
                                    <div>Total Amount</div>
                                    <div><span
                                            id="totalAmount"><?= htmlspecialchars($data['bookingData']->total_amount) ?>
                                            LKR</span></div>
                                </div>

                                <div class="payment-row">
                                    <div>Advance Payment Required</div>
                                    <div><span
                                            id="advanceRequired"><?= htmlspecialchars($data['bookingData']->total_amount * 0.25) ?>
                                            LKR</span></div>
                                </div>
                                <div class="payment-row">
                                    <div>Paid Advance Payment Amount</div>
                                    <div><span
                                            id="paidAmount"><?= htmlspecialchars($data['bookingData']->paid_advance_payment_amount) ?>
                                            LKR</span></div>
                                </div>
                                <div class="payment-row">
                                    <div>Balance Due (at check-in)</div>
                                    <div><span
                                            id="balanceDue"><?= htmlspecialchars(($data['bookingData']->total_amount) - ($data['bookingData']->paid_advance_payment_amount)) ?>
                                            LKR</span></div>
                                </div>

                                <div class="payment-status <?= strtolower($data['bookingData']->advance_payment_status) ?>"
                                    id="paymentStatus">
                                    <?= htmlspecialchars($data['bookingData']->advance_payment_status) ?>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <?php if ($data['bookingData']->booking_status == 'Pending'): ?>
                    <div class="booking-section payment-notice-section">
                        <div class="payment-notice" id = "payment-notice">
                            <div class="notice-icon">⚠️</div>
                            <div class="notice-content">
                                <h3>Important Payment Notice</h3>
                                <p>
                                    To confirm your booking, please pay the 25% advance payment of
                                    <strong><?= htmlspecialchars($data['bookingData']->total_amount * 0.25) ?> LKR</strong>
                                    by 
                                    <strong>
                                        <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($data['bookingData']->advance_payment_deadline))) ?>
                                    </strong>.
                                </p>
                                <p class="warning-text">
                                    If payment is not received by the deadline, your booking will be automatically cancelled.
                                </p>

                                

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($data['bookingData']->booking_status == 'Pending'): ?>
                    <div class="payment-action">
                        <a href="<?= ROOT ?>/traveler/ConfirmAccommodationBooking/index/<?= $data['bookingData']->room_booking_Id ?>">
                            <button class="pay-now-btn">
                                <i class="fas fa-check-circle"></i> Confirm Booking
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>

</html>