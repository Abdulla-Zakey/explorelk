<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/confirmAccommodationBooking.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Confirm Booking</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

</head>

<?php
    // var_dump($data['bookingData']);
    // exit();
?>

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
        <div class="booking-confirm-container">
            <div class="booking-content">
                <div class="booking-header">
                    <h1 class="booking-title">
                        <span>Confirm Booking - <?= htmlspecialchars($data['hotelData']->hotelName) ?></span>
                        <div class="booking-status status-approved">
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

                            <div class="info-group">
                                <div class="info-label">Check-in Date</div>
                                <div class="info-value">
                                    <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_in))) ?>
                                </div>
                            </div>
                            <div class="info-group">
                                <div class="info-label">Check-out Date</div>
                                <div class="info-value">
                                    <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_out))) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Total Nights</div>
                                <div class="info-value">
                                    <span
                                        id="nights-count"><?= htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) ?>
                                        Nights</span>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Number of Rooms</div>
                                <div class="info-value">
                                    <?= htmlspecialchars($data['bookingData']->total_rooms) ?>
                                </div>
                            </div>

                            <div class="note-box">
                                <p>
                                    <i class="fa-solid fa-circle-info"></i> 
                                    Your booking has been approved by the hotel. Please complete the advance payment  to confirm your reservation.
                                </p>
                            </div>
                        </div>

                        <!-- 2. Room Details -->
                        <div class="booking-section" style="min-height: 22.5rem;">
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

                            <?php if (!empty($data['bookingData']->special_requests)): ?>
                                <div class="info-group">
                                    <div class="info-label">Special Requests</div>
                                    <div class="info-value">
                                        <?= htmlspecialchars($data['bookingData']->special_requests) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- 3. Payment Summary -->
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
                                    <div>Total Amount</div>
                                    <div><span
                                            id="total-amount"><?= htmlspecialchars($data['bookingData']->total_amount) ?></span>
                                        LKR</div>
                                </div>
                                <div class="payment-row advance">
                                    <div>Required Advance Payment (25%)</div>
                                    <div class="payment-amount">
                                        <span id="advance-payment"><?= htmlspecialchars($data['bookingData']->advance_payment_amount) ?></span>
                                        LKR</div>
                                </div>
                            </div>

                            <div class="warning-box">
                                <p>
                                    <i class="fa-solid fa-triangle-exclamation"></i> 
                                    You must complete the advance payment by<br>
                                    <b><?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['bookingData']->advance_payment_deadline))) ?></b>
                                    or your booking will be automatically cancelled.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="right-column">

                        <!-- 4. Guest Information -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-person"></span>
                                Guest Information
                            </h2>

                            <div class="info-group">
                                <div class="info-label">Guest Name</div>
                                <div class="info-value"><?= htmlspecialchars($data['guestData']->guest_full_name) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">NIC</div>
                                <div class="info-value"><?= htmlspecialchars($data['guestData']->guest_nic) ?></div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Email</div>
                                <div class="info-value"><?= htmlspecialchars($data['guestData']->guest_email) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Mobile Number</div>
                                <div class="info-value">
                                    <?= htmlspecialchars($data['guestData']->guest_mobile_num) ?>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Hotel Information -->
                        <div class="booking-section" style="min-height: 23.25rem;">
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

                        <!-- 6. Payment Section -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-credit-card"></span>
                                Payment Details
                            </h2>

                            <div class="payment-section">
                                <div class="payment-section-title">Advance Payment Required</div>

                                <div class="payment-amount-highlight">
                                    <div class="amount-label">Amount to Pay Now</div>
                                    <div class="amount-value">
                                        <?= htmlspecialchars($data['bookingData']->advance_payment_amount) ?> LKR
                                    </div>
                                </div>

                                <div class="payment-section-title"><span
                                        style="color: red; margin-right: 5px;">*</span>Select Payment Method</div>

                                <div class="payment-options-grid">
                                    <div class="payment-option" data-method="credit-card"
                                        onclick="selectPaymentMethod('credit-card')">
                                        <div class="payment-option-icon">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div class="payment-option-label">Credit Card</div>
                                    </div>

                                    <div class="payment-option" data-method="debit-card"
                                        onclick="selectPaymentMethod('debit-card')">
                                        <div class="payment-option-icon">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div class="payment-option-label">Debit Card</div>
                                    </div>

                                </div>

                                <input type="hidden" id="payment_method" name="payment_method" value="">
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Terms and Conditions Section -->
                <div class="terms-section">
                    <div class="terms-tabs">
                        <div class="terms-tab active" data-tab="terms">Terms & Conditions</div>
                        <div class="terms-tab" data-tab="refund">Cancellation & Refund Policy</div>
                    </div>

                    <div class="terms-content">
                        <div class="terms-panel active" id="terms-panel">
                            <h3>Booking Terms and Conditions</h3>
                            <p>These Terms and Conditions govern the booking of accommodation services through
                                ExploreLK. By confirming your booking, you agree to these terms in full.</p>

                            <ul>
                                <li><strong>Booking Confirmation:</strong> Your booking is not confirmed until you
                                    have paid the required advance payment and received a confirmation email.</li>
                                <li><strong>Check-in/Check-out:</strong> Standard check-in time is 2:00 PM and
                                    check-out time is 12:00 PM. Early check-in or late check-out may result in
                                    additional charges.</li>
                                <li><strong>Guest Identification:</strong> All guests must present valid
                                    identification at check-in.</li>
                                <li><strong>Payment:</strong> The advance payment (25% of the total amount) is
                                    required to confirm your booking. The remaining balance must be paid at
                                    check-in.</li>
                                <li><strong>Hotel Policies:</strong> Guests must adhere to all hotel policies and
                                    rules during their stay.</li>
                                <li><strong>Special Requests:</strong> Special requests are subject to availability
                                    and cannot be guaranteed.</li>
                                <li><strong>Damage:</strong> Guests will be held responsible for any damage caused
                                    to hotel property during their stay.</li>
                            </ul>
                        </div>

                        <div class="terms-panel" id="refund-panel">
                            <h3>Cancellation and Refund Policy</h3>
                            <p>We understand that plans can change. Please review our cancellation and refund policy
                                carefully:</p>

                            <ul>
                                <li><strong>Free Cancellation Period:</strong> Cancellations made more than 7 days
                                    before check-in date are eligible for a full refund of the advance payment.</li>
                                <li><strong>Partial Refund Period:</strong> Cancellations made between 3-7 days
                                    before check-in date are eligible for a 50% refund of the advance payment.</li>
                                <li><strong>No Refund Period:</strong> Cancellations made less than 3 days before
                                    check-in date are not eligible for a refund.</li>
                                <li><strong>No-show:</strong> If you fail to check-in on your scheduled arrival date
                                    without prior notice, it will be treated as a no-show and no refund will be
                                    provided.</li>
                                <li><strong>Early Departure:</strong> No refund will be provided for early departure
                                    or unused nights.</li>
                                <li><strong>Refund Processing:</strong> Approved refunds will be processed within
                                    7-14 business days to the original payment method.</li>
                                <li><strong>Force Majeure:</strong> In case of events beyond our control (natural
                                    disasters, government actions), alternative arrangements or refunds may be
                                    provided at our discretion.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="checkbox-container">
                        <input type="checkbox" id="terms-agreement" name="terms-agreement" required>
                        <label for="terms-agreement" class="checkbox-label">I have read and agree to the Terms &
                            Conditions and Cancellation & Refund Policy</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" id="cancelButton" class="cancel-button" onclick="openCancelModal()">
                        <i class="fas fa-times"></i> Cancel Booking
                    </button>
                    <button id="payButton" class="pay-button" style="min-width: 15rem;" disabled>
                        <i class="fas fa-credit-card"></i> Proceed to Payment
                    </button>
                </div>

            </div>
        </div>

        <!-- Cancellation Modal -->
        <div id="cancelModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeCancelModal()">&times;</span>
                <h2><i class="fas fa-exclamation-triangle" style="color: var(--danger-color);"></i> Cancel Booking</h2>
                <p>Are you sure you want to cancel your booking? This action cannot be undone.</p>
                <p>Please note our cancellation policy:</p>
                <ul>
                    <li>Cancellations more than 7 days before check-in receive a full refund.</li>
                    <li>Cancellations 3-7 days before check-in receive a 50% refund.</li>
                    <li>Cancellations less than 3 days before check-in receive no refund.</li>
                </ul>
                <div class="modal-actions">
                    <button class="cancel-button" onclick="closeCancelModal()">Keep Booking</button>
                    <button class="pay-button" style="background-color: var(--danger-color);"
                        onclick="confirmCancellation()">Confirm Cancellation</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to select payment method
        function selectPaymentMethod(method) {
            // Remove selected class from all options
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('selected');
            });

            // Add selected class to the clicked option
            document.querySelector(`.payment-option[data-method="${method}"]`).classList.add('selected');

            // Update hidden input value
            document.getElementById('payment_method').value = method;

            // Enable pay button if terms are also checked
            updatePayButtonState();
        }

        // Function to update pay button state
        function updatePayButtonState() {
            const termsAgreed = document.getElementById('terms-agreement').checked;
            const paymentSelected = document.getElementById('payment_method').value !== '';

            document.getElementById('payButton').disabled = !(termsAgreed && paymentSelected);
        }

        // Function to handle terms checkbox change
        document.getElementById('terms-agreement').addEventListener('change', updatePayButtonState);

        // Function to handle tab switching
        document.querySelectorAll('.terms-tab').forEach(tab => {
            tab.addEventListener('click', function () {
                // Remove active class from all tabs
                document.querySelectorAll('.terms-tab').forEach(t => t.classList.remove('active'));

                // Add active class to clicked tab
                this.classList.add('active');

                // Hide all panels
                document.querySelectorAll('.terms-panel').forEach(panel => panel.classList.remove('active'));

                // Show selected panel
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-panel`).classList.add('active');
            });
        });

        // Redirect to checkout on "Proceed" click
        const proceedToPayButton = document.getElementById('payButton');

        proceedToPayButton.addEventListener('click', () => {
            
            const advancePaymentAmount = <?= htmlspecialchars($data['bookingData']->advance_payment_amount) ?>;
            
            if (advancePaymentAmount > 0) {
                const rootUrl = "<?= ROOT ?>";

                // Build the URL with ticket data
                let checkoutUrl = `${rootUrl}/traveler/CheckoutForAccommodationBooking?total=${Math.round(advancePaymentAmount * 100)}`;

                // Add booking information
                checkoutUrl += `&bookingType=accommodation`;
                checkoutUrl += `&bookingId=<?= htmlspecialchars($data['bookingData']->room_booking_Id) ?>`;
                checkoutUrl += `&hotelName=<?= urlencode($data['hotelData']->hotelName) ?>`;

                // window.location.href = checkoutUrl;
                window.open(checkoutUrl, '_blank');
            } else {
                alert('Something went wrong!');
            }
        });

        // Cancel booking modal functions
        function openCancelModal() {
            document.getElementById('cancelModal').style.display = 'flex';
        }

        function closeCancelModal() {
            document.getElementById('cancelModal').style.display = 'none';
        }

        function confirmCancellation() {
            // Redirect to cancellation handler
            window.location.href = `<?= ROOT ?>/traveler/CancelBooking/index/<?= $data['bookingData']->room_booking_Id ?>`;
        }

        // Close modal if clicked outside
        window.onclick = function (event) {
            const modal = document.getElementById('cancelModal');
            if (event.target == modal) {
                closeCancelModal();
            }
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function () {
            // Calculate and display total amount
            const pricePerNight = parseFloat(document.getElementById('pricePerNight').textContent);
            const totalNights = parseInt(document.getElementById('nights-count').textContent);
            const roomCount = parseInt(document.getElementById('room-count').textContent);

            // Set initial button state
            updatePayButtonState();
        });
    </script>
</body>

</html>