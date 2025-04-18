<?php
// var_dump($data);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | <?= isset($data['success']) && $data['success'] ? 'Booking Confirmation' : 'Booking Error' ?>
    </title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.js"></script>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            box-sizing: border-box;
        }

        .booking-container {
            align-items: center;
            max-width: 800px;
            margin: 1rem auto 1rem auto;
            padding: 1rem 1.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .booking-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .booking-details {
            margin-bottom: 30px;
        }

        .qr-container {
            text-align: center;
            margin: 30px 0;
        }

        .success-message {
            color: #28a745;
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .error-message {
            color: #dc3545;
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8d7da;
            border-radius: 5px;
        }

        .booking-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .booking-info div,
        .hotel-address,
        .special-requests {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .download-button {
            display: inline-block;
            background: darkcyan;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            border: none;
            border-radius: 10px;
            min-width: 15rem;
            margin: 1rem 1rem 1rem 0rem;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .download-button:hover {
            box-shadow: 0px 0px 5px white;
            color: #1E293B;
            background-color: #B3D9FF;
            cursor: pointer;
        }

        .download-button i {
            margin-left: 5px;
        }

        .total-amount {
            text-align: left;
            margin-top: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .payment-details-container {
            border: 2px solid #f8f9fa;
            margin-top: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        .payment-details-container .heading {
            margin-bottom: 5px;
        }

        .room-details-container {
            border: 2px solid #f8f9fa;
            margin-top: 20px;
            padding: 20px;
            box-sizing: border-box;
        }

        .room-image {
            width: 100%;
            max-height: 180px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .status-paid {
            color: #28a745;
            font-weight: bold;
        }

        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
        }

        .payment-row.total {
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .guest-info table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .guest-info th,
        .guest-info td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .guest-info th {
            width: 40%;
        }

        .redirect-message {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
        }

        .support-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 5px;
            text-align: center;
        }

        .home-button {
            display: inline-block;
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .home-button:hover {
            background: #5a6268;
            cursor: pointer;
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

            <button id="download" class="download-button">
                Download Confirmation
                <i class="fa-solid fa-file-arrow-down"></i>
            </button>

        </nav>
    </header>

    <?php if (isset($data['success']) && $data['success']): ?>

        <!-- <button id="download" class="download-button">
            Download Confirmation
            <i class="fa-solid fa-file-arrow-down"></i>
        </button> -->

        <div style="margin-top: 10rem;">
            <div id="receipt" class="booking-container">

                <div class="booking-header">
                    <h1><?php echo isset($data['hotelData']->hotelName) ? htmlspecialchars($data['hotelData']->hotelName) : 'Hotel Booking'; ?>
                    </h1>
                    <div class="success-message">✅ Booking Confirmed!</div>
                </div>

                <div class="booking-details">

                    <div class="booking-info">
                        <div>
                            <strong>Booking Reference:</strong><br>
                            <?php echo isset($data['bookingData']->room_booking_Id) ? htmlspecialchars($data['bookingData']->room_booking_Id) : 'N/A'; ?>
                        </div>

                        <div>
                            <strong>Booking Date:</strong><br>
                            <?php echo isset($data['bookingData']->requested_date) ? htmlspecialchars($data['bookingData']->requested_date) : 'N/A'; ?>
                        </div>

                        <div>
                            <strong>Check-in Date:</strong><br>
                            <?php echo isset($data['bookingData']->check_in) ? htmlspecialchars($data['bookingData']->check_in) : 'N/A'; ?>
                        </div>

                        <div>
                            <strong>Check-out Date:</strong><br>
                            <?php echo isset($data['bookingData']->check_out) ? htmlspecialchars($data['bookingData']->check_out) : 'N/A'; ?>
                        </div>

                        <div>
                            <strong>Total Nights:</strong><br>
                            <?php
                            if (isset($data['bookingData']->check_in) && isset($data['bookingData']->check_out)) {
                                echo htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) . ' Nights';
                            } else {
                                echo 'N/A';
                            }
                            ?>
                        </div>

                        <div>
                            <strong>Total Rooms:</strong><br>
                            <?php echo isset($data['bookingData']->total_rooms) ? htmlspecialchars($data['bookingData']->total_rooms) : 'N/A'; ?>
                        </div>

                    </div>

                    <div class="hotel-address">
                        <strong>Special Requests:</strong><br>
                        <?php echo isset($data['bookingData']->special_requests) && !empty($data['bookingData']->special_requests) ? htmlspecialchars($data['bookingData']->special_requests) : 'None'; ?>
                    </div>

                    <div class="hotel-address" style="margin-top: 1rem;">
                        <strong>Hotel Address:</strong><br>
                        <?php echo isset($data['hotelData']->hotelAddress) ? htmlspecialchars($data['hotelData']->hotelAddress) : 'Address not available'; ?>
                    </div>

                    <?php if (isset($data['bookedRoomTypeDetails'])): ?>
                        <div class="room-details-container">
                            <strong class="heading">Room Details:</strong>

                            <div>

                                <div class="booking-info">
                                    <div>
                                        <strong>Room Type:</strong><br>
                                        <?php echo isset($data['bookedRoomTypeDetails']->roomTypeName) ? htmlspecialchars($data['bookedRoomTypeDetails']->roomTypeName) : 'N/A'; ?>
                                    </div>

                                    <div>
                                        <strong>Maximum Occupancy:</strong><br>
                                        <?php echo isset($data['bookedRoomTypeDetails']->max_occupancy) ? htmlspecialchars($data['bookedRoomTypeDetails']->max_occupancy) . ' people' : 'N/A'; ?>
                                    </div>

                                    <div>
                                        <strong>Price Per Night:</strong><br>
                                        <?php echo isset($data['bookedRoomTypeDetails']->pricePer_night) ? 'LKR ' . htmlspecialchars($data['bookedRoomTypeDetails']->pricePer_night) : 'N/A'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>



                    <?php if (isset($data['guestData'])): ?>
                        <div class="guest-info" style="margin-top: 2rem;">
                            <strong>Guest Information:</strong>
                            <table>
                                <tr>
                                    <th>Guest Name</th>
                                    <td><?php echo isset($data['guestData']->guest_full_name) ? htmlspecialchars($data['guestData']->guest_full_name) : 'N/A'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>NIC</th>
                                    <td><?php echo isset($data['guestData']->guest_nic) ? htmlspecialchars($data['guestData']->guest_nic) : 'N/A'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo isset($data['guestData']->guest_email) ? htmlspecialchars($data['guestData']->guest_email) : 'N/A'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mobile Number</th>
                                    <td><?php echo isset($data['guestData']->guest_mobile_num) ? htmlspecialchars($data['guestData']->guest_mobile_num) : 'N/A'; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($data['bookingData']->total_amount)): ?>
                        <div class="payment-details-container" style="margin-top: 4rem;">
                            <strong class="heading">Payment Details:</strong>

                            <div class="payment-row">
                                <div>Room Charges for Complete Stay</div>
                                <div>LKR <?php echo htmlspecialchars($data['bookingData']->total_amount); ?></div>
                            </div>

                            <div class="payment-row">
                                <div>Taxes & Fees</div>
                                <div>LKR 0.00</div>
                            </div>

                            <div class="payment-row total">
                                <div>Total Amount</div>
                                <div>LKR <?php echo htmlspecialchars($data['bookingData']->total_amount); ?></div>
                            </div>

                            <div class="payment-row">
                                <div>Advance Payment Required (25%)</div>
                                <div>LKR <?php echo htmlspecialchars($data['bookingData']->total_amount * 0.25); ?></div>
                            </div>

                            <div class="payment-row">
                                <div>Paid Advance Payment</div>
                                <div>LKR
                                    <?php echo isset($data['bookingData']->paid_advance_payment_amount) ? htmlspecialchars($data['bookingData']->paid_advance_payment_amount) : htmlspecialchars($data['bookingData']->advance_payment_amount); ?>
                                </div>
                            </div>

                            <div class="payment-row">
                                <div>Balance Due (at check-in)</div>
                                <div>LKR <?php
                                $paidAmount = isset($data['bookingData']->paid_advance_payment_amount) ?
                                    $data['bookingData']->paid_advance_payment_amount :
                                    $data['bookingData']->advance_payment_amount;
                                echo htmlspecialchars($data['bookingData']->total_amount - $paidAmount);
                                ?></div>
                            </div>

                            <div class="payment-row">
                                <div><strong>Advance Payment Status</strong></div>
                                <div class="status-paid">PAID</div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="qr-container">
                    <h3>Your Booking QR Code</h3>

                    <?php if (isset($data['qr_image']) && file_exists($data['qr_image'])): ?>
                        <img src="<?php echo ROOT . "/" . htmlspecialchars($data['qr_image']); ?>" alt="Booking QR Code">
                        <p>Please present this QR code at check-in</p>
                    <?php else: ?>
                        <p>QR code generation in progress. Please check your email for the booking confirmation.</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    <?php else: ?>

        <div class="booking-container">
            <div class="booking-header">
                <h1>Booking Error</h1>
                <div class="error-message">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?php echo isset($data['message']) ? htmlspecialchars($data['message']) : 'Unable to generate booking confirmation.'; ?>
                </div>

                <?php if (isset($data['booking_reference']) && $data['booking_reference'] !== 'Unknown'): ?>
                    <p>Your booking reference: <strong><?php echo htmlspecialchars($data['booking_reference']); ?></strong></p>
                    <p>Please save this reference number for future communications.</p>
                <?php endif; ?>

                <div class="support-info">
                    <p>For assistance, please contact our support team:</p>
                    <p><i class="fa-solid fa-envelope"></i> support@explorelk.com</p>
                    <p><i class="fa-solid fa-phone"></i> +94 11 234 5678</p>
                </div>

                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome" class="home-button">
                    <i class="fa-solid fa-home"></i> Return to Home
                </a>

                <p class="redirect-message">You will be redirected to the home page in 10 seconds...</p>
            </div>
        </div>

        <!-- Auto redirect after error -->
        <script>
            setTimeout(function () {
                window.location.href = '<?= ROOT ?>/traveler/RegisteredTravelerHome';
            }, 10000);
        </script>

    <?php endif; ?>

</body>

<script>
    window.onload = function () {
        // Check if download button exists
        const downloadBtn = document.getElementById('download');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', () => {
                const content = this.document.getElementById("receipt");
                if (content) {
                    try {
                        html2pdf().from(content).save();
                    } catch (error) {
                        console.error("Error generating PDF: ", error);
                        alert("There was an error generating your PDF. Please try again later.");
                    }
                } else {
                    console.error("Receipt element not found");
                    alert("Unable to generate PDF at this time.");
                }
            });
        }
    }
</script>

</html>