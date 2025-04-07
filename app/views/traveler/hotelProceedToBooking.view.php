<?php
// Ensure the user is logged in and has selected room details
if (!isset($data['roomDetails']) || !isset($_SESSION['user'])) {
    // Redirect or show error
    header('Location: ' . ROOT . '/traveler/error');
    exit();
}

$roomDetails = $data['roomDetails'];
$userDetails = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Booking | ExploreLK</title>

    <!-- Style Imports -->
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/booking.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .booking-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .booking-header {
            background-color: #002D40;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .booking-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 20px;
        }

        .summary-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }

        .summary-details .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .summary-details .detail-row.total {
            font-weight: bold;
            border-top: 2px solid #002D40;
        }

        .booking-form {
            background: white;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4a5568;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
        }

        .booking-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background-color: #4299e1;
            color: white;
            border: none;
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .booking-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="booking-container">
        <div class="booking-header">
            <h1>Complete Your Booking</h1>
            <p>Almost there! Just a few more details to confirm your stay.</p>
        </div>

        <div class="booking-content">
            <div class="booking-summary">
                <div class="summary-card">
                    <h2>Booking Summary</h2>
                    <div class="summary-details">
                        <div class="detail-row">
                            <span>Hotel:</span>
                            <strong><?= htmlspecialchars($roomDetails['hotelName']) ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Room Type:</span>
                            <strong><?= htmlspecialchars($roomDetails['roomTypeName']) ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Check-in:</span>
                            <strong><?= htmlspecialchars($roomDetails['checkInDate']) ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Check-out:</span>
                            <strong><?= htmlspecialchars($roomDetails['checkOutDate']) ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Total Nights:</span>
                            <strong><?= htmlspecialchars($roomDetails['totalNights']) ?></strong>
                        </div>
                        <div class="detail-row">
                            <span>Rooms Selected:</span>
                            <strong><?= htmlspecialchars($roomDetails['roomCount']) ?></strong>
                        </div>
                        <div class="detail-row total">
                            <span>Total Amount:</span>
                            <strong><?= htmlspecialchars($roomDetails['totalAmount']) ?> LKR</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-form">
                <form id="bookingForm" action="<?= ROOT ?>/traveler/BookingController/processBooking" method="POST">
                    <!-- Hidden inputs for room details -->
                    <input type="hidden" name="hotelId" value="<?= $roomDetails['hotelId'] ?>">
                    <input type="hidden" name="roomTypeId" value="<?= $roomDetails['roomTypeId'] ?>">
                    <input type="hidden" name="checkInDate" value="<?= $roomDetails['checkInDate'] ?>">
                    <input type="hidden" name="checkOutDate" value="<?= $roomDetails['checkOutDate'] ?>">
                    <input type="hidden" name="roomCount" value="<?= $roomDetails['roomCount'] ?>">
                    <input type="hidden" name="totalAmount" value="<?= $roomDetails['totalAmount'] ?>">

                    <h2>Guest Information</h2>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName"
                                value="<?= htmlspecialchars($userDetails['firstName']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName"
                                value="<?= htmlspecialchars($userDetails['lastName']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email"
                                value="<?= htmlspecialchars($userDetails['email']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" id="phoneNumber" name="phoneNumber"
                                value="<?= htmlspecialchars($userDetails['phoneNumber']) ?>" required>
                        </div>
                    </div>

                    <h2>Special Requests</h2>
                    <div class="form-group full-width">
                        <label for="specialRequests">Additional Notes (Optional)</label>
                        <textarea id="specialRequests" name="specialRequests"
                            placeholder="Any special requests or requirements for your stay?"></textarea>
                    </div>

                    <div class="form-group full-width">
                        <label class="checkbox-label">
                            <input type="checkbox" name="agreeTerms" required>
                            I agree to the Terms and Conditions and Privacy Policy
                        </label>
                    </div>

                    <div class="booking-actions">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check-circle"></i> Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('bookingForm').addEventListener('submit', function (e) {
            const agreeTerms = document.querySelector('input[name="agreeTerms"]');
            if (!agreeTerms.checked) {
                e.preventDefault();
                alert('Please agree to the Terms and Conditions');
            }
        });
    </script>
</body>

</html>