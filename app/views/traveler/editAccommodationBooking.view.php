<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/editAccommodationBooking.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Edit Booking</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        :root {
            --primary-color: #1E7A8F;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-gray: #f5f7fa;
            --medium-gray: #e6e9ed;
            --dark-gray: #7f8c8d;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --pending-color: #f39c12;
            --approved-color: #2196F3;
            --completed-color: #2ecc71;
            --cancelled-color: #e74c3c;
            --text-light: #FFFFFF;
            --text-dark: #333333;
            --border-radius: 12px;
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Booking Details Styling */
        .booking-edit-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 30px;
            overflow: hidden;
        }

        .booking-header {
            background-color: var(--primary-color);
            color: white;
            padding: 30px;
            position: relative;
            border-radius: 1rem;
        }

        .booking-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .booking-status {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            background-color: var(--medium-gray);
        }

        .status-confirmed {
            background-color: var(--success-color);
            color: white;
        }

        .status-pending {
            background-color: var(--pending-color);
            color: white;
        }

        .status-cancelled {
            background-color: var(--danger-color);
            color: white;
        }

        .booking-content {
            padding: 40px;
        }

        .booking-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        @media (max-width: 768px) {
            .booking-grid {
                grid-template-columns: 1fr;
            }

            .date-inputs {
                flex-direction: column;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .cancel-button,
            .save-button {
                width: 100%;
                justify-content: center;
            }
        }

        .booking-section {
            margin-bottom: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 25px;
        }

        .section-title {
            font-size: 20px;
            color: var(--secondary-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--medium-gray);
            display: flex;
            align-items: center;
        }

        .date-inputs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
            font-size: 14px;
        }

        .input-group input,
        .input-group textarea,
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            background-color: var(--light-gray);
            transition: border-color 0.3s ease;
        }

        .input-group input:focus,
        .input-group textarea:focus,
        .input-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(30, 122, 143, 0.2);
        }

        .input-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-label {
            font-size: 14px;
            color: var(--dark-gray);
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 500;
        }

        .roomAvailability-summary {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 1.5rem;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            min-width: 32.5rem;
        }

        .summary-box {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            height: 6rem;
        }

        .summary-box i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .summary-info {
            display: flex;
            flex-direction: column;
        }

        .summary-label {
            /*declared with .date-filter label */
        }

        .summary-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
        }

        .room-selection {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .selection-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .selection-header h3 {
            display: block;
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 0.5rem;
            font-weight: 500;
            margin: 0;
        }

        .room-counter {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 1rem;
            font-size: 1.4rem;
        }

        .counter-btn {
            background: white;
            border: 1px solid #e2e8f0;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #4a5568;
            transition: all 0.2s ease;
        }

        .counter-btn:hover {
            background: var(--primary-color);
            color: white;
            border-color: #4299e1;
        }

        .counter-btn:disabled {
            background: #edf2f7;
            color: #a0aec0;
            cursor: not-allowed;
            border-color: #edf2f7;
        }

        #roomCount {
            font-size: 1.3rem;
            font-weight: 500;
            color: #2d3748;
            min-width: 2rem;
            text-align: center;
        }

        .room-type-card {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: var(--light-gray);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .room-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .room-details {
            flex: 1;
        }

        .room-type {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--secondary-color);
        }

        .room-occupancy,
        .room-price {
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--dark-gray);
        }

        .room-price {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 16px;
            margin-top: 5px;
        }

        textarea {
            padding: 1rem;
            box-sizing: border-box;
            border-radius: 1rem;
            min-width: 32.5rem;
            resize: none;
            background-color: var(--light-gray);
            color: #333;

        }

        .note-box {
            background-color: rgba(46, 204, 113, 0.1);
            border-left: 4px solid var(--success-color);
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 20px;
        }

        .note-box i {
            color: var(--success-color);
            margin-right: 8px;
        }

        .payment-info {
            background-color: var(--light-gray);
            padding: 25px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 5px 0;
            font-size: 15px;
        }

        .payment-row.total {
            border-top: 1px solid var(--medium-gray);
            margin-top: 15px;
            padding-top: 15px;
            font-weight: 700;
            font-size: 18px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding: 25px 40px;
            background-color: var(--light-gray);
            border-top: 1px solid var(--medium-gray);
        }

        .cancel-button,
        .save-button {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            min-width: 12.5rem;
            justify-content: center;
        }

        .cancel-button {
            background-color: white;
            color: var(--dark-gray);
            border: 1px solid var(--medium-gray);
        }

        .save-button {
            background-color: var(--primary-color);
            color: white;
        }

        .cancel-button:hover {
            background-color: #f0f0f0;
            border: 0.1px solid red;
        }

        .save-button:hover {
            background-color: #186a7d;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius);
            max-width: 500px;
            width: 90%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: var(--dark-gray);
            transition: color 0.3s ease;
        }

        .close:hover {
            color: var(--text-dark);
        }

        .modal h2 {
            margin-top: 0;
            color: var(--secondary-color);
            font-size: 22px;
            margin-bottom: 15px;
        }

        .modal p {
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        .icon {
            margin-right: 10px;
        }

        /* Icons using Font Awesome classes */
        .icon-calendar::before {
            content: "\f073";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
        }

        .icon-bed::before {
            content: "\f236";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
        }

        .icon-person::before {
            content: "\f007";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
        }

        .icon-hotel::before {
            content: "\f594";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
        }

        .icon-money::before {
            content: "\f0d6";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
        }

        .icon-request::before {
            content: "\f0f3";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
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
        <div class="booking-edit-container">
            <div class="booking-content">
                <div class="booking-header">
                    <h1 class="booking-title">
                        <span>Edit Booking - <?= htmlspecialchars($data['hotelData']->hotelName) ?></span>
                        <div class="booking-status status-pending">
                            <?= htmlspecialchars($data['bookingData']->booking_status) ?>
                        </div>
                    </h1>
                </div>

                <form
                    action="<?= ROOT ?>/traveler/EditAccommodationBooking/index/<?= $data['bookingData']->room_booking_Id ?>"
                    method="POST" id="editBookingForm">
                    <div class="booking-grid">
                        <!-- Left Column -->
                        <div class="left-column">
                            <!-- 1. Booking Date Details -->
                            <div class="booking-section">
                                <h2 class="section-title">
                                    <span class="icon icon-calendar"></span>
                                    Booking Dates
                                </h2>

                                <div class="date-inputs">
                                    <div class="input-group">
                                        <label for="check_in">Check-in Date</label>
                                        <input type="date" id="check_in" name="check_in"
                                            value="<?= htmlspecialchars($data['bookingData']->check_in) ?>" required>
                                    </div>
                                    <div class="input-group">
                                        <label for="check_out">Check-out Date</label>
                                        <input type="date" id="check_out" name="check_out"
                                            value="<?= htmlspecialchars($data['bookingData']->check_out) ?>" required>
                                    </div>
                                </div>

                                <div class="roomAvailability-summary">

                                    <div class="summary-box">
                                        <i class="fas fa-bed"></i>
                                        <div class="summary-info">
                                            <span class="summary-label">Available Rooms</span>
                                            <span class="summary-value"></span>
                                        </div>
                                    </div>

                                    <div class="summary-box">
                                        <i class="fas fa-hourglass-half"></i>
                                        <div class="summary-info">
                                            <span class="summary-label">Pending Reservations</span>
                                            <span id="reservedRoomsCount" class="summary-value"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="room-selection">

                                    <div class="selection-header">
                                        <h3>Number of Selected Rooms</h3>

                                        <div class="room-counter">
                                            <button type="button" class="counter-btn" id="decrementBtn"
                                                onclick="decrementRooms()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <span
                                                id="roomCount"><?= htmlspecialchars($data['bookingData']->total_rooms) ?></span>

                                            <button type="button" class="counter-btn" id="incrementBtn"
                                                onclick="incrementRooms()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>

                                </div>

                                <div class="info-group">
                                    <div class="info-label">Total Nights</div>
                                    <div class="info-value" id="totalNights">
                                        <span
                                            id="nights-count"><?= htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) ?>
                                            Nights</span>
                                    </div>
                                </div>

                                <input type="hidden" id="total_rooms" name="total_rooms" min="1"
                                    value="<?= htmlspecialchars($data['bookingData']->total_rooms) ?>" required>

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
                                        <div class="room-type"><?= $data['bookedRoomTypeDetails']->roomTypeName ?></div>
                                        <div class="room-occupancy">
                                            <span class="occupancy-icon">👤 Maximum Occupancy</span>
                                            <span><?= $data['bookedRoomTypeDetails']->max_occupancy ?></span>
                                        </div>
                                        <div class="room-price">
                                            <span
                                                id="pricePerNight"><?= $data['bookedRoomTypeDetails']->pricePer_night ?></span>
                                            LKR per night
                                        </div>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <label for="special_requests">Special Requests</label>
                                    <textarea name="special_requests" id="special_requests"
                                        rows="4"><?= htmlspecialchars($data['bookingData']->special_requests) ?></textarea>
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

                                <div class="input-group">
                                    <label for="guest_full_name">Guest Name</label>
                                    <input type="text" id="guest_full_name" name="guest_full_name"
                                        value="<?= htmlspecialchars($data['guestData']->guest_full_name) ?>" required>
                                </div>

                                <div class="input-group">
                                    <label for="guest_nic">NIC</label>
                                    <input type="text" id="guest_nic" name="guest_nic"
                                        value="<?= htmlspecialchars($data['guestData']->guest_nic) ?>" required>
                                </div>

                                <div class="input-group">
                                    <label for="guest_email">Email</label>
                                    <input type="email" id="guest_email" name="guest_email"
                                        value="<?= htmlspecialchars($data['guestData']->guest_email) ?>" required>
                                </div>

                                <div class="input-group">
                                    <label for="guest_mobile_num">Mobile Number</label>
                                    <input type="tel" id="guest_mobile_num" name="guest_mobile_num"
                                        value="<?= htmlspecialchars($data['guestData']->guest_mobile_num) ?>" required>
                                </div>
                            </div>

                            <!-- 4. Hotel Information (Read-only) -->
                            <div class="booking-section">
                                <h2 class="section-title">
                                    <span class="icon icon-hotel"></span>
                                    Hotel Information
                                </h2>

                                <div class="info-group">
                                    <div class="info-label">Hotel Name</div>
                                    <div class="info-value"><?= htmlspecialchars($data['hotelData']->hotelName) ?></div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Address</div>
                                    <div class="info-value"><?= htmlspecialchars($data['hotelData']->hotelAddress) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Contact</div>
                                    <div class="info-value"><?= htmlspecialchars($data['hotelData']->hotelMobileNum) ?>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Payment Summary -->
                            <div class="booking-section">
                                <h2 class="section-title">
                                    <span class="icon icon-money"></span>
                                    Payment Summary
                                </h2>

                                <div class="payment-info">
                                    <div class="payment-row">
                                        <div>Room Rate (per night)</div>
                                        <div><span
                                                id="room-rate"><?= htmlspecialchars($data['bookedRoomTypeDetails']->pricePer_night) ?></span>
                                            LKR</div>
                                    </div>
                                    <div class="payment-row">
                                        <div>Total Nights</div>
                                        <div><span
                                                id="total-nights-payment"><?= htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) ?></span>
                                            Nights</div>
                                    </div>
                                    <div class="payment-row">
                                        <div>Number of Rooms</div>
                                        <div><span
                                                id="room-count"><?= htmlspecialchars($data['bookingData']->total_rooms) ?></span>
                                        </div>
                                    </div>
                                    <div class="payment-row total">
                                        <div>Estimated Total Amount</div>
                                        <div><span
                                                id="estimated-total"><?= htmlspecialchars($data['bookedRoomTypeDetails']->pricePer_night * $data['bookingData']->total_rooms * ((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24))) ?></span>
                                            LKR</div>
                                            <input type = "hidden" id = "final_total_amount" name = "total_amount" value = "">
                                    </div>
                                    <div class="payment-row">
                                        <div>Required Advance Payment (25%)</div>
                                        <div><span
                                                id="advance-required"><?= htmlspecialchars($data['bookedRoomTypeDetails']->pricePer_night * $data['bookingData']->total_rooms * ((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) * 0.25) ?></span>
                                            LKR</div>
                                            <input type = "hidden" id = "final_advance_payment_amount" name = "advance_payment_amount" value = "">
                                    </div>
                                </div>

                                <div class="note-box">
                                    <p><i class="fa-solid fa-circle-info"></i> Note: Final price may vary if the hotel
                                        approves your changes. You will need to pay the advance payment within 3 days of
                                        approval to secure your booking.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="cancel-button" onclick="window.location.href='<?= ROOT ?>/traveler/MyBookings'">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="save-button">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for confirmation -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Confirm Changes</h2>
            <p>Are you sure you want to save these changes to your booking?</p>
            <div class="modal-actions">
                <button id="cancelChanges" class="cancel-button">Cancel</button>
                <button id="confirmChanges" class="save-button">Confirm</button>
            </div>
        </div>
    </div>

    <script>

        // Global variables
        let currentRoomTypeId = <?= htmlspecialchars($data['bookingData']->hotel_roomType_Id) ?>;
        let currentRoomCount = <?= htmlspecialchars($data['bookingData']->total_rooms) ?>;
        let maxAvailableRooms = 0; // Will be set dynamically
        let numberOfNights = <?= htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) ?>;
        let pricePerNight = <?= htmlspecialchars($data['bookedRoomTypeDetails']->pricePer_night) ?>;

        // Initialize date inputs with restrictions
        document.addEventListener('DOMContentLoaded', function () {
            const checkInInput = document.getElementById('check_in');
            const checkOutInput = document.getElementById('check_out');
            const roomCountElement = document.getElementById('roomCount');
            const totalRoomsInput = document.getElementById('total_rooms');

            // Set minimum date as today for check-in
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            const todayFormatted = today.toISOString().split('T')[0];
            const tomorrowFormatted = tomorrow.toISOString().split('T')[0];

            checkInInput.min = todayFormatted;
            checkOutInput.min = tomorrowFormatted;

            // Initial setup
            calculateDateDifference();
            checkAvailability();

            // Ensure room count input is synchronized
            totalRoomsInput.value = currentRoomCount;
            roomCountElement.textContent = currentRoomCount;

            // Function to calculate date difference
            function calculateDateDifference() {
                if (checkInInput.value && checkOutInput.value) {
                    const checkIn = new Date(checkInInput.value);
                    const checkOut = new Date(checkOutInput.value);

                    // Calculate the time difference in milliseconds
                    const timeDifference = checkOut.getTime() - checkIn.getTime();

                    // Convert to days
                    numberOfNights = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

                    // Update the display
                    const stayDurationDisplay = document.getElementById('nights-count');
                    if (stayDurationDisplay) {
                        stayDurationDisplay.textContent = `${numberOfNights} Night${numberOfNights !== 1 ? 's' : ''}`;
                    }

                    // Update payment summary
                    document.getElementById('total-nights-payment').textContent = numberOfNights;

                    calculateTotalAmount();
                }
            }

            // Update check-out minimum date when check-in date changes
            checkInInput.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const nextDay = new Date(selectedDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkOutInput.min = nextDay.toISOString().split('T')[0];

                if (checkOutInput.value && new Date(checkOutInput.value) <= new Date(this.value)) {
                    checkOutInput.value = nextDay.toISOString().split('T')[0];
                }

                calculateDateDifference();
                checkAvailability();
            });

            // Calculate difference when check-out date changes
            checkOutInput.addEventListener('change', function () {
                calculateDateDifference();
                checkAvailability();
            });
        });

        // Function to increment room count
        function incrementRooms() {
            if (currentRoomCount < maxAvailableRooms) {
                currentRoomCount++;
                updateRoomCount();
            }
        }

        // Function to decrement room count
        function decrementRooms() {
            if (currentRoomCount > 1) { // Ensure at least 1 room is selected
                currentRoomCount--;
                updateRoomCount();
            }
        }

        // Function to update room count display and related fields
        function updateRoomCount() {
            const roomCountElement = document.getElementById('roomCount');
            const totalRoomsInput = document.getElementById('total_rooms');
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            const roomCountDisplay = document.getElementById('room-count');

            // Update visible and hidden room count
            roomCountElement.textContent = currentRoomCount;
            totalRoomsInput.value = currentRoomCount;

            // Update display in payment summary
            if (roomCountDisplay) {
                roomCountDisplay.textContent = currentRoomCount;
            }

            // Update button states
            decrementBtn.disabled = currentRoomCount <= 1; // Can't go below 1 room
            incrementBtn.disabled = currentRoomCount >= maxAvailableRooms;

            calculateTotalAmount();
        }

        // Function to Calculate and display total amount
        function calculateTotalAmount() {
            const totalPrice = numberOfNights * pricePerNight * currentRoomCount;
            const advancePayment = totalPrice * 0.25; // 25% advance

            document.getElementById('estimated-total').textContent = totalPrice.toFixed(2);
            document.getElementById('advance-required').textContent = advancePayment.toFixed(2);
        }

        // Function to check room availability
        function checkAvailability() {
            const checkIn = document.getElementById('check_in').value;
            const checkOut = document.getElementById('check_out').value;

            if (!checkIn || !checkOut) {
                return;
            }

            // Make AJAX call to check availability
            fetch(`<?= ROOT ?>/traveler/RoomBookingController/checkAvailability/${currentRoomTypeId}/${checkIn}/${checkOut}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    updateAvailabilityUI(data);
                })
                .catch(error => {
                    console.error('Error checking availability:', error);
                });
        }

        // Function to update UI with availability data
        function updateAvailabilityUI(data) {
            // Update available rooms count
            const availableRoomsElement = document.querySelector('.summary-box .summary-value');
            if (availableRoomsElement) {
                availableRoomsElement.textContent = `${data.available_rooms} of ${data.total_rooms}`;
            }

            const reservedRoomsElement = document.getElementById('reservedRoomsCount');
            if (reservedRoomsElement) {
                reservedRoomsElement.textContent = `${data.reserved_rooms} of ${data.total_rooms}`;
            }

            // Update max available rooms for selection
            maxAvailableRooms = data.available_rooms;

            // Reset room count if current selection exceeds availability
            if (currentRoomCount > maxAvailableRooms && maxAvailableRooms > 0) {
                currentRoomCount = maxAvailableRooms;
                updateRoomCount();
            } else if (maxAvailableRooms === 0) {
                // If no rooms available, set to minimum (1)
                currentRoomCount = 1;
                updateRoomCount();
            }

            // Update button states
            const incrementBtn = document.getElementById('incrementBtn');
            const decrementBtn = document.getElementById('decrementBtn');

            if (incrementBtn) {
                incrementBtn.disabled = currentRoomCount >= maxAvailableRooms || maxAvailableRooms === 0;
            }

            if (decrementBtn) {
                decrementBtn.disabled = currentRoomCount <= 1;
            }
        }

        // Modal handling
        document.addEventListener('DOMContentLoaded', function () {
            const editBookingForm = document.getElementById('editBookingForm');
            const confirmationModal = document.getElementById('confirmationModal');
            const closeModalBtn = document.querySelector('.close');
            const cancelChangesBtn = document.getElementById('cancelChanges');
            const confirmChangesBtn = document.getElementById('confirmChanges');

            // When form is submitted, show confirmation modal instead
            if (editBookingForm) {
                editBookingForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Update hidden fields with current values immediately before showing modal
                    document.getElementById('final_total_amount').value = document.getElementById('estimated-total').textContent;
                    document.getElementById('final_advance_payment_amount').value = document.getElementById('advance-required').textContent;
                    
                    confirmationModal.style.display = 'flex';
                });
            }

            // Close modal functions
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function () {
                    confirmationModal.style.display = 'none';
                });
            }

            if (cancelChangesBtn) {
                cancelChangesBtn.addEventListener('click', function () {
                    confirmationModal.style.display = 'none';
                });
            }

            // Submit form when confirmed
            if (confirmChangesBtn) {
                confirmChangesBtn.addEventListener('click', function () {
                    
                    document.getElementById('final_total_amount').value = document.getElementById('estimated-total').textContent;
                    document.getElementById('final_advance_payment_amount').value = document.getElementById('advance-required').textContent;
                    
                    editBookingForm.submit();
                });
            }

            // Close modal when clicking outside
            window.addEventListener('click', function (event) {
                if (event.target === confirmationModal) {
                    confirmationModal.style.display = 'none';
                }
            });
        });

    </script>

</body>

</html>