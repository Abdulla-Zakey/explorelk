<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Cancel Booking</title>
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

        /* Cancel Booking Styling */
        .cancel-booking-container {
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
            border-radius: var(--border-radius);
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

            .form-actions {
                flex-direction: column-reverse;
            }

            .back-button,
            .cancel-button {
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

        /* Refund Calculation Styling */
        .calculator-section {
            background-color: var(--light-gray);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .calculator-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .refund-calculator {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .calculator-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed var(--medium-gray);
        }

        .calculator-row:last-child {
            border-bottom: none;
        }

        .calculator-row.total {
            margin-top: 15px;
            padding-top: 15px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .refund-status {
            margin-top: 20px;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .refund-status.full {
            background-color: rgba(46, 204, 113, 0.1);
            border-left: 4px solid var(--success-color);
        }

        .refund-status.partial {
            background-color: rgba(243, 156, 18, 0.1);
            border-left: 4px solid var(--warning-color);
        }

        .refund-status.none {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--danger-color);
        }

        .refund-status i {
            font-size: 1.5rem;
            color: var(--success-color);
        }

        .refund-status.partial i {
            color: var(--warning-color);
        }

        .refund-status.none i {
            color: var(--danger-color);
        }

        .policy-reminder {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(33, 150, 243, 0.1);
            border-radius: 10px;
            border-left: 4px solid var(--approved-color);
        }

        .policy-reminder h4 {
            display: flex;
            align-items: center;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .policy-reminder h4 i {
            margin-right: 10px;
            color: var(--approved-color);
        }

        .policy-reminder ul {
            padding-left: 20px;
        }

        .policy-reminder li {
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Cancellation Reason Styling */
        .reason-textarea {
            width: 100%;
            min-height: 150px;
            padding: 15px;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            resize: vertical;
            font-family: 'Poppins', sans-serif;
            margin-top: 15px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            resize: none;
        }

        .reason-textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 122, 143, 0.1);
        }

        select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 122, 143, 0.1);
        }

        #bankDetails {
            margin-top: 20px;
            padding: 20px;
            background-color: var(--light-gray);
            border-radius: 10px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #bankDetails input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        #bankDetails input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 122, 143, 0.1);
        }

        #bankDetails h4 {
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        /* Form Actions Styling */
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding: 25px 40px;
            background-color: var(--light-gray);
            border-top: 1px solid var(--medium-gray);
        }

        .back-button,
        .cancel-button {
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            min-width: 12.5rem;
            justify-content: center;
        }

        .back-button {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .cancel-button {
            background-color: var(--danger-color);
            color: white;
            border: none;
        }

        .back-button:hover {
            background-color: #f0f0f0;
        }

        .cancel-button:hover {
            background-color: #c0392b;
        }

        /* Terms Checkbox Styling */
        .checkbox-container {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-top: 20px;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-label {
            font-size: 14px;
            cursor: pointer;
        }

        /* Success Message */
        .success-message {
            display: none;
            background-color: rgba(46, 204, 113, 0.1);
            border-left: 4px solid var(--success-color);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success-message i {
            color: var(--success-color);
            font-size: 18px;
        }

        /* Error Messages */
        .error-message {
            color: var(--danger-color);
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
            font-size: 14px;
        }

        .error-message i {
            font-size: 16px;
        }

        /* Modal Styling */
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
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal h2 i {
            color: var(--danger-color);
        }

        .modal p {
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 25px;
        }

        #keepBookingBtn {
            background-color: white;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #keepBookingBtn:hover {
            background-color: #f0f0f0;
        }

        #confirmCancelBtn {
            background-color: var(--danger-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        #confirmCancelBtn:hover {
            background-color: #c0392b;
        }

        /* Loading Animation */
        .loader {
            display: none;
            border: 4px solid var(--medium-gray);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Icons */
        .icon {
            margin-right: 10px;
            color: var(--primary-color);
        }

        /* Make sure icons are properly styled */
        .icon-calendar::before,
        .icon-bed::before,
        .icon-person::before,
        .icon-hotel::before,
        .icon-money::before,
        .icon-refund::before,
        .icon-reason::before {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--primary-color);
        }

        .icon-calendar::before {
            content: "\f073";
        }

        .icon-bed::before {
            content: "\f236";
        }

        .icon-money::before {
            content: "\f3d1";
        }

        .icon-refund::before {
            content: "\f53a";
        }

        .icon-reason::before {
            content: "\f086";
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

    <div class="container" style="margin-top: 7.5%;">
        <div class="cancel-booking-container">
            <div class="booking-content">
                <div class="booking-header">
                    <h1 class="booking-title">
                        <span>Cancel Booking - <span
                                id="hotelName"><?= htmlspecialchars($data['hotelData']->hotelName) ?></span></span>
                        <div class="booking-status status-confirmed" id="bookingStatus">
                            <?= htmlspecialchars($data['bookingData']->booking_status) ?>
                        </div>
                    </h1>
                </div>

                <?php

                /**
                 * I'm calculating the refund percentage up here because I need it to decide 
                 * whether to show the bank details section or not. If the traveler isn't 
                 * getting any refund (0%), there's no point asking for their bank info.
                 * 
                 * Originally I had this calculation down in the refund display section,
                 * but that was causing an "undefined variable" error when I tried to use
                 * $refundPercentage up here before it was defined.
                 * 
                 * Quick reminder on our refund rules:
                 * - 7+ days before check-in: full refund (100%)
                 * - 3-6 days before: half refund (50%)
                 * - 0-2 days before: no refund (0%)
                 * 
                 * Note: This same calculation happens again later in the code for display purposes.
                 * If the refund policy changes, update both places!
                 */

                // Calculate days until check-in
                $daysUntilCheckin = (strtotime($data['bookingData']->check_in) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);

                // Calculate refund percentage
                $refundPercentage = 0;
                if ($daysUntilCheckin >= 7) {
                    $refundPercentage = 100;
                } else if (($daysUntilCheckin >= 3) && ($daysUntilCheckin < 7)) {
                    $refundPercentage = 50;
                } else if ($daysUntilCheckin < 3) {
                    $refundPercentage = 0;
                }
                ?>

                <div class="booking-grid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- 1. Booking Date Details -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-calendar"></span>
                                Booking Summary
                            </h2>

                            <div class="info-group">
                                <div class="info-label">Room Type</div>
                                <div class="info-value" id="roomType">
                                    <?= $data['bookedRoomTypeDetails']->roomTypeName ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Number of Rooms</div>
                                <div class="info-value" id="roomCount">
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
                                <div class="info-label">Total Nights</div>
                                <div class="info-value">
                                    <span
                                        id="nightsCount"><?= htmlspecialchars((strtotime($data['bookingData']->check_out) - strtotime($data['bookingData']->check_in)) / (60 * 60 * 24)) ?></span>
                                    Nights
                                </div>
                            </div>

                        </div>

                        <!-- 3. Cancellation Reason -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span style="color: var(--primary-color);">
                                    <i class="fas fa-hand-holding-dollar" style="margin-right: 10px;"></i>
                                </span>
                                Refund Information

                            </h2>

                            <form method="POST" action = "<?= ROOT ?>/traveler/CancelAccommodationBooking/index/<?= $data['bookingData']->room_booking_Id ?>">
                                <?php if ($refundPercentage > 0): ?>
                                    <div style="margin-top: 1rem;">

                                        <div id="bankDetails"
                                            style="margin-top: 1rem; padding: 1rem; background-color: #f9f9f9; border-radius: 8px;">
                                            <h4 style="margin-bottom: 0.5rem;">Bank Account Details</h4>

                                            <div class="info-group">
                                                <div class="info-label">Account Number</div>
                                                <div class="info-value">
                                                    <input type="text" name="bankAccountNumber"
                                                        style="padding: 0.5rem; border-radius: 4px; border: 1px solid var(--medium-gray); width: 100%;"
                                                        value="<?php
                                                        if (isset($data['travelerBankAccountDetails'])) {
                                                            echo htmlspecialchars($data['travelerBankAccountDetails']->traveler_accountNum);
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?>">
                                                </div>
                                            </div>

                                            <div class="info-group">
                                                <div class="info-label">Account Holder Name</div>
                                                <div class="info-value">
                                                    <input type="text" name="bankAccountHolderName"
                                                        style="padding: 0.5rem; border-radius: 4px; border: 1px solid var(--medium-gray); width: 100%;"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="info-group">
                                                <div class="info-label">Bank Name</div>
                                                <div class="info-value">
                                                    <input type="text" name="bankName"
                                                        style="padding: 0.5rem; border-radius: 4px; border: 1px solid var(--medium-gray); width: 100%;"
                                                        value="<?php
                                                        if (isset($data['travelerBankAccountDetails'])) {
                                                            echo htmlspecialchars($data['travelerBankAccountDetails']->traveler_bankName);
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?>">
                                                </div>
                                            </div>

                                            <div class="info-group">
                                                <div class="info-label">Branch</div>
                                                <div class="info-value">
                                                    <input type="text" name="bankBranch"
                                                        style="padding: 0.5rem; border-radius: 4px; border: 1px solid var(--medium-gray); width: 100%;"
                                                        value="<?php
                                                        if (isset($data['travelerBankAccountDetails'])) {
                                                            echo htmlspecialchars($data['travelerBankAccountDetails']->traveler_bankBranch);
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div style="margin-top: 1.5rem;">

                                    <div id="reasonError"
                                        style="color: var(--danger-color); display: none; margin-bottom: 1rem;">
                                        <i class="fa-solid fa-exclamation-circle"></i>
                                        Please provide a reason for cancellation
                                    </div>

                                    <p>
                                        Please let us know why you're cancelling this booking. 
                                        This helps us improve our services.
                                    </p>
                                    <textarea id="cancellationReason" name="cancellationReason" class="reason-textarea"
                                        placeholder="Please provide a reason for cancellation..."></textarea>

                                </div>
                                <input type = "hidden" name = "refundAmount" value = "<?= htmlspecialchars($data['bookingData']->paid_advance_payment_amount) * ($refundPercentage / 100) ?>">
                            </form>
                        </div>

                    </div>


                    <!-- Right Column -->
                    <div class="right-column">

                        <!-- 2. Refund Calculation -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <span class="icon icon-refund"></span>
                                Payment Breakdown
                            </h2>

                            <div class="calculator-section">
                                <div class="calculator-title">Refund Calculation</div>
                                <div class="refund-calculator">
                                    <div class="calculator-row">
                                        <div>Total Booking Amount</div>
                                        <div><span
                                                id="totalAmount"><?= htmlspecialchars($data['bookingData']->total_amount) ?></span>
                                            LKR</div>
                                    </div>
                                    <div class="calculator-row">
                                        <div>Required Advance Payment (25%)</div>
                                        <div><span
                                                id="advanceAmount"><?= htmlspecialchars($data['bookingData']->advance_payment_amount) ?></span>
                                            LKR</div>
                                    </div>

                                    <div class="calculator-row">
                                        <div>Paid Advance Payment</div>
                                        <div><span
                                                id="advanceAmount"><?= htmlspecialchars($data['bookingData']->paid_advance_payment_amount) ?></span>
                                            LKR</div>
                                    </div>

                                    <div class="calculator-row">
                                        <div>Days Remaining to Check-in</div>
                                        <div><span
                                                id="daysUntilCheckin"><?= htmlspecialchars((strtotime($data['bookingData']->check_in) - strtotime(date('Y-m-d'))) / (60 * 60 * 24)) ?></span>
                                            days</div>
                                    </div>
                                    <div class="calculator-row">
                                        <div>Refund Percentage</div>
                                        <div>
                                            <span id="refundPercentage">
                                                <?php
                                                $daysUntilCheckin = htmlspecialchars((strtotime($data['bookingData']->check_in) - strtotime(date('Y-m-d'))) / (60 * 60 * 24));
                                                $refundPercentage = 0;
                                                if ($daysUntilCheckin >= 7) {
                                                    $refundPercentage = 100;
                                                } else if (($daysUntilCheckin >= 3) && ($daysUntilCheckin < 7)) {
                                                    $refundPercentage = 50;
                                                } else if ($daysUntilCheckin < 3) {
                                                    $refundPercentage = 0;
                                                }
                                                ?>

                                                <?= $refundPercentage ?>
                                            </span>%
                                        </div>
                                    </div>

                                    <div class="calculator-row total">
                                        <div>Refund Amount</div>
                                        <div>
                                            <span id="refundAmount">
                                                <?= htmlspecialchars($data['bookingData']->paid_advance_payment_amount) * ($refundPercentage / 100) ?>
                                            </span>
                                            LKR
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if ($refundPercentage == 100) {
                                    echo '
                                            <div id="refundStatus" class="refund-status full">
                                                <i class="fa-solid fa-circle-check"></i>
                                                <div>
                                                    <strong>Full Refund Available</strong>
                                                    <div>Your cancellation is eligible for a full refund as per our policy.</div>
                                                </div>
                                            </div>
                                        ';
                                } else if ($refundPercentage == 50) {
                                    echo '
                                            <div id="refundStatus" class="refund-status partial">
                                                <i class="fas fa-adjust"></i>
                                                <div>
                                                    <strong>Partial Refund Available</strong>
                                                    <div>Your cancellation is eligible for a partial refund as per our policy.</div>
                                                </div>
                                            </div>
                                        ';
                                } else if ($refundPercentage == 0) {
                                    echo '
                                            <div id="refundStatus" class="refund-status none">
                                                <i class="fas fa-times-circle"></i>
                                                <div>
                                                    <strong>No Refund Available</strong>
                                                    <div>Your cancellation is not eligible for a refund as per our policy.</div>
                                                </div>
                                            </div>
                                        ';
                                }
                                ?>

                            </div>

                            <!-- 4. Terms Reminder -->
                            <div class="booking-section">
                                <h2 class="section-title">
                                    <span style="color: var(--primary-color);"><i class="fas fa-scroll"
                                            style="margin-right: 10px;"></i></span>
                                    Cancellation Terms
                                </h2>

                                <div class="policy-reminder">
                                    <h4><i class="fa-solid fa-info-circle"></i> Refund Policy Reminder</h4>
                                    <ul>
                                        <li><strong>Full Refund (100%):</strong> Cancellations more than 7 days before
                                            check-in</li>
                                        <li><strong>Partial Refund (50%):</strong> Cancellations 3-7 days before
                                            check-in
                                        </li>
                                        <li><strong>No Refund (0%):</strong> Cancellations less than 3 days before
                                            check-in
                                        </li>
                                        <li>Refunds will be processed within 7-14 business days.</li>
                                    </ul>
                                </div>

                                <div
                                    style="background-color: rgba(244, 67, 54, 0.05); padding: 1rem; border-radius: 8px; margin: 1rem 0rem;">
                                    <p>
                                        <i class="fa-solid fa-exclamation-triangle"
                                            style="color: var(--danger-color); margin-right: 0.5rem;"></i>
                                        <strong>Please Note:</strong>
                                        Cancellation is final and cannot be undone. Once confirmed,
                                        your booking will be cancelled according to our policies.
                                    </p>
                                </div>

                                <div style="margin-top: 1.5rem;">
                                    <label style="display: flex; align-items: flex-start; cursor: pointer;">
                                        <input type="checkbox" id="termsAgreement"
                                            style="margin-right: 0.75rem; margin-top: 0.25rem;">
                                        <span>I understand and agree to the cancellation terms and refund policy</span>
                                    </label>
                                </div>

                                <div id="termsError"
                                    style="color: var(--danger-color); display: none; margin-top: 0.5rem;">
                                    <i class="fa-solid fa-exclamation-circle"></i>
                                    You must agree to the terms to proceed.
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="form-actions">
                <button class="back-button" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i> Keep Booking
                </button>
                <button id="cancelBookingBtn" class="cancel-button" onclick="showConfirmModal()">
                    <i class="fas fa-ban"></i> Cancel Booking
                </button>
            </div>

            <div class="loader" id="processingLoader"></div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeConfirmModal()">&times;</span>
            <h2><i class="fas fa-exclamation-triangle" style="color: var(--danger-color);"></i> Confirm Cancellation
            </h2>
            <p>Are you sure you want to cancel this booking? This action cannot be undone.</p>
            <p><strong>Refund Amount:</strong> <span id="modalRefundAmount"><?= htmlspecialchars($data['bookingData']->paid_advance_payment_amount) * ($refundPercentage / 100) ?></span> LKR</p>
            <p><strong>Refund Method:</strong> <span id="modalRefundMethod">Bank Transfer</span></p>
            <div class="modal-actions">
                <button id="keepBookingBtn" onclick="closeConfirmModal()">Keep Booking</button>
                <button id="confirmCancelBtn" onclick="processCancellation()">Confirm Cancellation</button>
            </div>
        </div>
    </div>
    </div>

    <script>

        // Navigation functions
        function goBack() {
            window.history.back();
        }

        // Modal functions
        function showConfirmModal() {
            console.log("running");
            // Validate form before showing modal
            if (!validateCancellationForm()) {
                return;
            }

            const modal = document.getElementById('confirmModal');

            // Show modal
            modal.style.display = 'flex';
        }

        function closeConfirmModal() {
            const modal = document.getElementById('confirmModal');
            modal.style.display = 'none';
        }

        // Form validation
        function validateCancellationForm() {
            let isValid = true;
            const termsCheckbox = document.getElementById('termsAgreement');
            const termsError = document.getElementById('termsError');
            const reasonTextarea = document.getElementById('cancellationReason');
            const reasonError = document.getElementById('reasonError');

            // Validate terms agreement
            if (!termsCheckbox.checked) {
                termsError.style.display = 'block';
                isValid = false;
            } else {
                termsError.style.display = 'none';
            }

            // Validate cancellation reason
            if (!reasonTextarea.value.trim()) {
                reasonError.style.display = 'block';
                isValid = false;
            } else {
                reasonError.style.display = 'none';
            }

            // Validate bank details if bank transfer is selected
            
            const refundPercentage = <?= $refundPercentage ?>

            if (refundPercentage > 0) {
                const accountName = document.querySelector('input[name="bankAccountHolderName"]').value;
                const bankName = document.querySelector('input[name="bankName"]').value;
                const accountNumber = document.querySelector('input[name="bankAccountNumber"]').value;
                const bankBranch = document.querySelector('input[name="bankBranch"]').value;

                if (!accountName || !bankName || !accountNumber || !bankBranch) {
                    alert('Please fill in all bank details for the refund transfer.');
                    isValid = false;
                }
            }

            return isValid;
        }

        // Process cancellation
        function processCancellation() {
            // Disable buttons to prevent multiple submissions
            document.querySelector('form').submit();
           
        }

        // Close modal if clicked outside
        window.onclick = function (event) {
            const modal = document.getElementById('confirmModal');
            if (event.target === modal) {
                closeConfirmModal();
            }
        };

        // Add keypress event listener for ESC key to close modal
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeConfirmModal();
            }
        });
    </script>
</body>

</html>