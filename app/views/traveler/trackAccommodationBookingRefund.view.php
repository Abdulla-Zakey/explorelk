<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Track Refund</title>
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
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        /* Refund Tracking Styling */
        .refund-tracking-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 30px;
            overflow: hidden;
        }

        .refund-header {
            background-color: var(--primary-color);
            color: white;
            padding: 30px;
            position: relative;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .refund-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .refund-content {
            padding: 40px;
        }

        .refund-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        @media (max-width: 768px) {
            .refund-grid {
                grid-template-columns: 1fr;
            }
        }

        .refund-section {
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

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
        }

        .status-processing {
            background-color: var(--approved-color);
            color: white;
        }

        .status-completed {
            background-color: var(--completed-color);
            color: white;
        }

        .status-notELigible {
            background-color: var(--danger-color);
            color: white;
        }

        /* Timeline Styling */
        .timeline {
            position: relative;
            margin: 20px 0;
            padding-left: 35px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: var(--medium-gray);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 25px;
            padding-left: 10px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: -30px;
            top: 0;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid var(--medium-gray);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .timeline-dot.active {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .timeline-dot.completed {
            background-color: var(--completed-color);
            border-color: var(--completed-color);
            color: white;
        }

        .timeline-content {
            background-color: var(--light-gray);
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .timeline-date {
            font-size: 12px;
            color: var(--dark-gray);
            margin-bottom: 5px;
        }

        .timeline-title {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 8px;
        }

        .timeline-description {
            font-size: 14px;
            color: var(--text-dark);
        }

        /* Add to your existing CSS */
        .ineligible-notice {
            padding: 25px;
        }

        .cancellation-policy {
            background-color: rgba(231, 76, 60, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }

        .next-steps ul li {
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            .cancellation-policy ul {
                margin-left: 10px;
            }

            .next-steps {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="javascript:history.back()">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </nav>
    </header>

    <?php
    // var_dump($data['bookingcancellationDetails']->refund_status);
    // exit();
    ?>

    <div class="container" style="margin-top: 7.5%;">
        <div class="refund-tracking-container">
            <div class="refund-header">
                <h1 class="refund-title">
                    <span>Refund Tracking -
                        <span id="hotelName"><?= htmlspecialchars($data['hotelData']->hotelName) ?></span>
                    </span>

                    <?php
                        if ($data['bookingcancellationDetails']->refund_status == 'Not Eligible') {
                            echo '
                                <div class="status-badge status-notELigible" id="refundStatus">
                                    ' . htmlspecialchars($data['bookingcancellationDetails']->refund_status) . '
                                </div>
                            ';
                        } else if ($data['bookingcancellationDetails']->refund_status == 'Processing') {
                            echo '
                                <div class="status-badge status-processing" id="refundStatus">
                                    ' . htmlspecialchars($data['bookingcancellationDetails']->refund_status) . '
                                </div>
                            ';
                        } else if ($data['bookingcancellationDetails']->refund_status == 'Refunded') {
                            echo '
                                <div class="status-badge status-completed" id="refundStatus">
                                    ' . htmlspecialchars($data['bookingcancellationDetails']->refund_status) . '
                                </div>
                            ';
                        }
                    ?>

                </h1>
            </div>

            <!-- Only for the users who are not eligible for a refund -->
            <?php if ($data['bookingcancellationDetails']->refund_status == 'Not Eligible'): ?>

                <div class="refund-content">
                    <div class="refund-grid">
                        <!-- Left Column -->
                        <div class="left-column">
                            <!-- Booking Summary Section -->
                            <div class="refund-section">
                                <h2 class="section-title">
                                    <span style="color: var(--primary-color);">
                                        <i class="fas fa-file-invoice" style="margin-right: 10px;"></i>
                                    </span>
                                    Booking Summary
                                </h2>

                                <div class="info-group">
                                    <div class="info-label">Room Type</div>
                                    <div class="info-value" id="roomType">
                                        <?= htmlspecialchars($data['bookedRoomTypeDetails']->roomTypeName) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Number of Rooms</div>
                                    <div class="info-value" id="bookingId">
                                        <?= htmlspecialchars($data['bookingData']->total_rooms) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Check-in Date</div>
                                    <div class="info-value" id="checkInDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_in))) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Check-out Date</div>
                                    <div class="info-value" id="checkOutDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_out))) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Cancellation Date</div>
                                    <div class="info-value" id="cancellationDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingcancellationDetails']->cancellation_date))) ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="right-column">
                            <div class="refund-section ineligible-notice">
                                <h2 class="section-title">
                                    <span style="color: var(--danger-color);">
                                        <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
                                    </span>
                                    Refund Ineligibility Notice
                                </h2>

                                <div class="info-group">
                                    <div class="info-value" style="color: var(--danger-color); margin-bottom: 15px;">
                                        Your booking is not eligible for a refund according to hotel's cancellation policy.
                                    </div>

                                    <div class="cancellation-policy">
                                        <p><strong>Applicable Cancellation Policy:</strong></p>
                                        <ul style="list-style-type: disc; margin-left: 20px; margin-top: 10px;">
                                            <li>100% refund for 7 days before check-in</li>
                                            <li>50% refund for cancellations 3-7 days before check-in</li>
                                            <li>No refund for cancellations less than 3 days before check-in</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Reason for Ineligibility</div>
                                    <div class="info-value">
                                        Your cancellation was made less than 72 hours before the check-in date.
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($data['bookingcancellationDetails']->refund_status == 'Processing' || $data['bookingcancellationDetails']->refund_status == 'Refunded'): ?>
                <div class="refund-content">
                    <div class="refund-grid">
                        <!-- Left Column -->
                        <div class="left-column">
                            <!-- Booking Summary Section -->
                            <div class="refund-section">
                                <h2 class="section-title">
                                    <span style="color: var(--primary-color);">
                                        <i class="fas fa-file-invoice" style="margin-right: 10px;"></i>
                                    </span>
                                    Booking Summary
                                </h2>

                                <div class="info-group">
                                    <div class="info-label">Room Type</div>
                                    <div class="info-value" id="roomType">
                                        <?= htmlspecialchars($data['bookedRoomTypeDetails']->roomTypeName) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Number of Rooms</div>
                                    <div class="info-value" id="bookingId">
                                        <?= htmlspecialchars($data['bookingData']->total_rooms) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Check-in Date</div>
                                    <div class="info-value" id="checkInDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_in))) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <di class="info-label">Check-out Date</di>
                                    <div class="info-value" id="checkOutDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_out))) ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Cancellation Date</div>
                                    <div class="info-value" id="cancellationDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingcancellationDetails']->cancellation_date))) ?>
                                    </div>
                                </div>
                            </div>

                        <!-- Bank Transfer Details -->
                        <?php if (!empty($data['refundBankAccountDetails'])): ?>
                            <div class="refund-section">
                                <h2 class="section-title">
                                    <span style="color: var(--primary-color);">
                                        <i class="fas fa-university" style="margin-right: 10px;"></i>
                                    </span>
                                    Bank Transfer Details
                                </h2>

                                <div class="info-group">
                                    <div class="info-label">Account Number (Hidden)</div>
                                    <div class="info-value" id="accountNumber">
                                        <?= isset($data['refundBankAccountDetails']->account_number) ? htmlspecialchars($data['refundBankAccountDetails']->account_number) : 'N/A' ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Account Holder Name</div>
                                    <div class="info-value" id="accountName">
                                        <?= isset($data['refundBankAccountDetails']->account_holder_name) ? htmlspecialchars($data['refundBankAccountDetails']->account_holder_name) : 'N/A' ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Bank Name</div>
                                    <div class="info-value" id="bankName">
                                        <?= isset($data['refundBankAccountDetails']->bank_name) ? htmlspecialchars($data['refundBankAccountDetails']->bank_name) : 'N/A' ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Branch</div>
                                    <div class="info-value" id="bankBranch">
                                        <?= isset($data['refundBankAccountDetails']->bank_branch) ? htmlspecialchars($data['refundBankAccountDetails']->bank_branch) : 'N/A' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Right Column -->
                        <div class="right-column">
                            <!-- Refund Details Section -->
                            <div class="refund-section">
                                <h2 class="section-title">
                                    <span style="color: var(--primary-color);">
                                        <i class="fas fa-hand-holding-dollar" style="margin-right: 10px;"></i>
                                    </span>
                                    Refund Details
                                </h2>

                                <div class="info-group">
                                    <div class="info-label">Paid Advance Payment Amount</div>
                                    <div class="info-value" id="originalAmount">
                                        <?= htmlspecialchars($data['bookingData']->paid_advance_payment_amount) ?> LKR
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Refund Amount</div>
                                    <div class="info-value" id="refundAmount">
                                        <?= htmlspecialchars($data['bookingcancellationDetails']->refund_amount) ?> LKR
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Refund Percentage</div>
                                    <div class="info-value" id="refundPercentage">
                                        <?php
                                            if ($data['bookingData']->paid_advance_payment_amount == $data['bookingcancellationDetails']->refund_amount) {
                                                echo '100%';
                                            } else if ($data['bookingcancellationDetails']->refund_amount == 0) {
                                                echo '0%';
                                            } else {
                                                echo '50%';
                                            }
                                        ?>
                                    </div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Payment Method</div>
                                    <div class="info-value" id="paymentMethod">Bank Transfer</div>
                                </div>

                                <div class="info-group">
                                    <div class="info-label">Refund Transfer Date(On or Before)</div>
                                    <div class="info-value" id="completionDate">
                                        <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingcancellationDetails']->cancellation_date . ' +14 days'))) ?>
                                    </div>
                                </div>
                            </div>


                            <!-- Refund Progress Tracker -->
                            <div class="refund-section">
                                <h2 class="section-title">
                                    <span style="color: var(--primary-color);">
                                        <i class="fas fa-chart-line" style="margin-right: 10px;"></i>
                                    </span>
                                    Refund Progress
                                </h2>

                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-dot completed">
                                            <i class="fas fa-check" style="font-size: 12px;"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-date">
                                                <?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['bookingcancellationDetails']->cancellation_date))) ?>
                                            </div>
                                            <div class="timeline-title">Booking Cancellation Request Submitted</div>
                                            <div class="timeline-description">
                                                Your booking cancellation request was successfully submitted.
                                            </div>
                                        </div>
                                    </div>
                            
                                    <?php if ($data['bookingcancellationDetails']->refund_status == 'Processing'): ?>
                                        <div class="timeline-item">
                                            <div class="timeline-dot active">
                                                <i class="fas fa-sync-alt" style="font-size: 12px;"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-date">
                                                    <?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['bookingcancellationDetails']->cancellation_date))) ?>
                                                </div>
                                                <div class="timeline-title">Refund Processing</div>
                                                <div class="timeline-description">
                                                    Your refund is being processed by our finance team. This typically takes 7-14 business days.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="timeline-item">
                                            <div class="timeline-dot">
                                                <i class="fas fa-hourglass-half" style="font-size: 12px;"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-date">
                                                    Expected: <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingcancellationDetails']->cancellation_date . ' +14 days'))) ?>
                                                </div>
                                                <div class="timeline-title">Refund Completion</div>
                                                <div class="timeline-description">
                                                    Refund will be transferred to your bank account on or before the expected date.
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($data['bookingcancellationDetails']->refund_status == 'Refunded'): ?>
                                        <div class="timeline-item">
                                            <div class="timeline-dot completed">
                                                <i class="fas fa-check" style="font-size: 12px;"></i>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-date">
                                                    <?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['refundDetails']->refund_initiated_date))) ?>
                                                </div>
                                                <div class="timeline-title">Refund Completed</div>
                                                <div class="timeline-description">
                                                    Refund has been transferred to your bank account. Please check your bank balance.
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php endif; ?>
    </div>

</body>

</html>