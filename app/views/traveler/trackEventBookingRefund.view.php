<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Track Event Refund</title>
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

        .status-pending {
            background-color: var(--pending-color);
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

        .event-banner {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: var(--border-radius);
            margin-bottom: 15px;
        }

        .note-box {
            background-color: rgba(33, 150, 243, 0.1);
            border-left: 4px solid var(--approved-color);
            padding: 15px;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 15px 0;
        }

        .cancellation-reason {
            background-color: rgba(231, 76, 60, 0.05);
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
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
        <div class="refund-tracking-container">
            <div class="refund-header">
                <h1 class="refund-title">
                    <span>Refund Tracking -
                        <span id="eventName"><?= htmlspecialchars($data['eventData']->eventName) ?></span>
                    </span>

                    <div class="status-badge status-<?= strtolower($data['refundData']->refund_status) ?>" id="refundStatus">
                        <?= htmlspecialchars($data['refundData']->refund_status) ?>
                    </div>
                </h1>
            </div>

            <div class="refund-content">
                <div class="refund-grid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Event Summary Section -->
                        <div class="refund-section">
                            <h2 class="section-title">
                                <span style="color: var(--primary-color);">
                                    <i class="fas fa-calendar-alt" style="margin-right: 10px;"></i>
                                </span>
                                Event Details
                            </h2>

                            <?php if(!empty($data['eventData']->eventWebBannerPath)): ?>
                                <img src="<?= IMAGES ?>/events/eventWebBannerPics/<?= htmlspecialchars($data['eventData']->eventWebBannerPath) ?>" 
                                     alt="<?= htmlspecialchars($data['eventData']->eventName) ?>" class="event-banner">
                            <?php endif; ?>

                            <div class="info-group">
                                <div class="info-label">Booking Reference Number</div>
                                <div class="info-value" id="referenceNumber">
                                    <?= htmlspecialchars($data['bookingData']->referenceNum) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Event Date & Time</div>
                                <div class="info-value" id="eventDateTime">
                                    <?= htmlspecialchars(date('F d, Y', strtotime($data['eventData']->eventDate))) ?> | 
                                    <?= htmlspecialchars(date('h:i A', strtotime($data['eventData']->eventStartTime))) ?> - 
                                    <?= htmlspecialchars(date('h:i A', strtotime($data['eventData']->eventEndTime))) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Event Location</div>
                                <div class="info-value" id="eventLocation">
                                    <?= htmlspecialchars($data['eventData']->eventLocation) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Purchase Date</div>
                                <div class="info-value" id="purchaseDate">
                                    <?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['bookingData']->purchasedDate))) ?>
                                </div>
                            </div>

                            <div class="cancellation-reason">
                                <p><strong>Event Cancellation Reason:</strong></p>
                                <p style="margin-top: 8px;">
                                    <?= htmlspecialchars($data['cancellationData']->cancellation_reason) ?>
                                </p>
                                <p style="margin-top: 8px; font-size: 14px; color: var(--dark-gray);">
                                    Cancelled on: <?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['cancellationData']->cancellation_date))) ?>
                                </p>
                            </div>
                        </div>
                    </div>

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
                                <div class="info-label">Total Amount Paid for Tickets</div>
                                <div class="info-value" id="ticketAmount">
                                    <?= htmlspecialchars($data['bookingData']->totalAmount) ?> LKR
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Refund Amount</div>
                                <div class="info-value" id="refundAmount">
                                    <?= htmlspecialchars($data['refundData']->refund_amount) ?> LKR
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Refund Percentage</div>
                                <div class="info-value" id="refundPercentage">
                                    <?php
                                        $percentage = ($data['refundData']->refund_amount / $data['bookingData']->totalAmount) * 100;
                                        echo number_format($percentage, 0) . '%';
                                    ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Payment Method</div>
                                <div class="info-value" id="paymentMethod">Bank Transfer</div>
                            </div>

                            <div class="note-box">
                                <p><i class="fas fa-info-circle" style="margin-right: 8px; color: var(--approved-color);"></i> 
                                For event cancellations, full refunds are processed within 14 business days.</p>
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
                                        <i class="fas fa-ban" style="font-size: 12px;"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            <?= htmlspecialchars(date('F d, Y h:i A', strtotime($data['cancellationData']->cancellation_date))) ?>
                                        </div>
                                        <div class="timeline-title">Event Cancellation</div>
                                        <div class="timeline-description">
                                            The event was cancelled by the organizer.
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-dot completed">
                                        <i class="fas fa-check" style="font-size: 12px;"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">
                                            Immediate
                                        </div>
                                        <div class="timeline-title">Refund Eligibility Confirmed</div>
                                        <div class="timeline-description">
                                            Full refund approved for the cancelled event.
                                        </div>
                                    </div>
                                </div>
                            
                                <?php if ($data['refundData']->refund_status == 'Processing'): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-dot active">
                                            <i class="fas fa-sync-alt" style="font-size: 12px;"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-date">
                                                Current Status
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
                                                Expected: <?= htmlspecialchars(date('F d, Y', strtotime($data['cancellationData']->cancellation_date . ' +14 days'))) ?>
                                            </div>
                                            <div class="timeline-title">Refund Completion</div>
                                            <div class="timeline-description">
                                                Refund will be transferred to your bank account on or before the expected date.
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($data['refundData']->refund_status == 'Completed'): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-dot completed">
                                            <i class="fas fa-check" style="font-size: 12px;"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <div class="timeline-date">
                                                <?= $data['refundData']->refund_initiated_date ? htmlspecialchars(date('F d, Y h:i A', strtotime($data['refundData']->refund_initiated_date))) : 'Date not available' ?>
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
    </div>
</body>

</html>