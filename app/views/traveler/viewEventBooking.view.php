<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewEventBooking.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Event Booking Details</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        /* Cancellation Section Styles */
.cancellation-section {
    /* border: 1px solid #ffcccc; */
    /* background-color: #fff8f8; */

    margin-bottom: 20px;
}

.cancellation-section .section-title {
    color: #d9534f;
}

.cancellation-section .section-title i {
    color: #d9534f;
}

.refund-status {
    font-weight: 600;
    color: #f39c12;
    margin-top: 5px;
}

.refund-tracking {
    margin-top: 20px;
    text-align: center;
}

.refund-tracking-btn {
    display: inline-block;
    background-color: #28a745;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.refund-tracking-btn:hover {
    background-color: #218838;
}

.refund-tracking-btn i {
    margin-right: 8px;
}
    </style>
    
</head>
<?php
    // show($data);
    // exit();
?>

<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="javascript:void(0);" onclick="window.history.back();">
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
                        <span id="eventName"><?= htmlspecialchars($data['eventInfo']->eventName) ?></span>
                        <div class="event-status status-<?= strtolower($data['eventInfo']->eventStatus) ?>"
                             id="bookingStatus">
                            <?php
                                if($data['eventInfo']->eventStatus == 'cancelled'){
                                    echo 'Cancelled';
                                }
                                else if($data['eventInfo']->eventStatus == 'approved' && $data['eventInfo']->eventDate == date('Y-m-d')){
                                    echo 'Happening Today';
                                }
                                else if($data['eventInfo']->eventStatus == 'approved'){
                                    echo 'Upcoming';
                                }
                                else if($data['eventInfo']->eventStatus == 'completed'){
                                    echo 'Completed';
                                }

                            ?>
                        </div>
                    </h1>
                </div>

                <div class="booking-grid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- 1. Event Details -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-calendar-days"></i>
                                Event Details
                            </h2>

                            <div class="event-card">
                                <img src="<?= IMAGES . '/events/eventWebBannerPics/' . htmlspecialchars($data['eventInfo']->eventWebBannerPath) ?>"
                                    alt="<?= htmlspecialchars($data['eventInfo']->eventName) ?>" class="event-image">
                                <div class="event-details">
                                    <div class="event-name" id="eventDetailName">
                                        <?= htmlspecialchars($data['eventInfo']->eventName) ?>
                                    </div>
                                    
                                    <div class="info-group">
                                        <div class="info-label">Date</div>
                                        <div class="info-value" id="eventDate">
                                            <?= htmlspecialchars(date('l, F d, Y', strtotime($data['eventInfo']->eventDate))) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="time-info">
                                        <div class="time-box start-time">
                                            <div class="time-value" id="startTime">
                                                <?= htmlspecialchars(date('h:i A', strtotime($data['eventInfo']->eventStartTime))) ?>
                                            </div>
                                            <div class="info-label">Start Time</div>
                                        </div>
                                        <div class="date-divider">→</div>
                                        <div class="time-box end-time">
                                            <div class="time-value" id="endTime">
                                                <?= htmlspecialchars(date('h:i A', strtotime($data['eventInfo']->eventEndTime))) ?>
                                            </div>
                                            <div class="info-label">End Time</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Location</div>
                                <iframe id = "mapFrame" width="100%" height="100%" frameborder="0" style="border:0; min-height: 50vh;" loading="lazy" allowfullscreen></iframe>
                            </div>
                            
                            <div class="info-group">
                                <div class="info-label">About Event</div>
                                <div class="info-value" id="aboutEvent" style="text-align: justify; line-height: 1.6;">
                                    <?= htmlspecialchars($data['eventInfo']->aboutEvent) ?>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Organizer Information -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-building"></i>
                                Organizer Information
                            </h2>

                            <div class="info-group">
                                <div class="info-label">Event Organizer</div>
                                <div class="info-value" id="organizerName">
                                    <?= htmlspecialchars($data['eventOrganizerInfo']->company_Name) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Email</div>
                                <div class="info-value" id="organizerEmail">
                                    <?= htmlspecialchars($data['eventOrganizerInfo']->company_Email) ?>
                                </div>
                            </div>

                            <div class="info-group">
                                <div class="info-label">Mobile Num</div>
                                <div class="info-value" id="organizerContact">
                                    <?= htmlspecialchars($data['eventOrganizerInfo']->company_MobileNum) ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="right-column">

                        <!-- Right after the Booking Information section and before Ticket Details -->
                        <?php if($data['eventInfo']->eventStatus == 'cancelled'): ?>
                            <!-- Cancellation Information -->
                            <div class="booking-section cancellation-section">
                                <h2 class="section-title">
                                    <i class="fa-solid fa-ban"></i>
                                    Event Cancellation Notice
                                </h2>

                                <div class="cancellation-details">
                                    <div class="info-group">
                                        <div class="info-value" id="cancellation-note" style="text-align: justify;">
                                            The event organizer has cancelled this event. 
                                            You will receive a 100% refund within 7–14 business days from the event cancellation date.
                                        </div>
                                    </div>

                                    <div class="info-group">
                                        <div class="info-label">Cancellation Date</div>
                                        <div class="info-value" id="cancellationDate">
                                            <?= isset($data['cancellationInfo']->cancellation_date) ? 
                                                htmlspecialchars(date('F d, Y', strtotime($data['cancellationInfo']->cancellation_date))) : 
                                                'Information not available' ?>
                                        </div>
                                    </div>

                                    
                                    <div class="info-group">
                                        <div class="info-label">Reason for Cancellation</div>
                                        <div class="info-value" id="cancellationReason">
                                            <?= isset($data['cancellationInfo']->cancellation_reason) ? 
                                                    htmlspecialchars($data['cancellationInfo']->cancellation_reason) : 
                                                    'This event has been cancelled due to unavoidable circumstances.'
                                            ?>
                                        </div>
                                    </div>

                                    <div class="info-group">
                                        <div class="info-label">Refund Status</div>
                                            <div class="refund-status" id="refundStatus">
                                            <?= isset($data['refundInfo']->refund_status) ? 
                                                htmlspecialchars($data['refundInfo']->refund_status) : 
                                                'Processing' ?>
                                        </div>
                                    </div>

                                    <div class="refund-tracking">
                                        <a href="<?= ROOT ?>/traveler/TrackEventBookingRefund/index/<?= htmlspecialchars($data['bookingInfo']->booking_Id) ?>" class="refund-tracking-btn">
                                            <i class="fa-solid fa-money-bill-transfer"></i>
                                            Track Your Refund
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- 3. Booking Information -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-receipt"></i>
                                Booking Information
                            </h2>

                            <div class="info-group">
                                <div class="info-label">Reference Number</div>
                                <div class="reference-number" id="referenceNumber">
                                    <?= htmlspecialchars($data['bookingInfo']->referenceNum) ?>
                                </div>
                            </div>
                            
                            <div class="info-group">
                                <div class="info-label">Purchase Date</div>
                                <div class="info-value" id="purchaseDate">
                                    <?= htmlspecialchars(date('F d, Y, h:i A', strtotime($data['bookingInfo']->purchasedDate))) ?>
                                </div>
                            </div>
                        </div>

                        

                        <!-- 2. Ticket Details -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-ticket"></i>
                                Ticket Details
                            </h2>
                            
                            <div class="ticket-details">
                                <?php foreach($data['purchasedEventTicketTypes'] as $ticket): ?>
                                <div class="ticket-type">
                                    <div class="ticket-type-name"><?= htmlspecialchars($ticket['ticketTypeName']) ?></div>
                                    <div class="ticket-type-desc"><?= htmlspecialchars($ticket['ticketTypeDesc']) ?></div>
                                    
                                    <div class="ticket-quantity">
                                        <span>Quantity</span>
                                        <span><?= htmlspecialchars($ticket['ticketTypeQuantity']) ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="qr-section">
                                <img src="<?= ROOT . '/' . htmlspecialchars($data['bookingInfo']->pathToQR) ?>" 
                                     alt="QR Code" class="qr-code">
                                <div class="qr-note">
                                    Show this QR code at the event entrance for verification
                                </div>
                            </div>
                        </div>

                        <!-- 4. Traveler Information -->
                        <!-- <div class="booking-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-user"></i>
                                Traveler Information
                            </h2>

                            <table class="guest-table">
                                <tbody id="travelerTableBody">
                                    <tr>
                                        <th>Name</th>
                                        <td><?= htmlspecialchars($data['travelerData']->name) ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIC</th>
                                        <td><?= htmlspecialchars($data['travelerData']->nic) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= htmlspecialchars($data['travelerData']->email) ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile Number</th>
                                        <td><?= htmlspecialchars($data['travelerData']->mobile_num) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->

                        
                        <!-- 6. Payment Details -->
                        <div class="booking-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-credit-card"></i>
                                Payment Details
                            </h2>

                            <div class="payment-info">
                                <?php foreach($data['purchasedEventTicketTypes'] as $ticket): ?>
                                <div class="payment-row">
                                    <div><?= htmlspecialchars($ticket['ticketTypeName']) ?> (<?= htmlspecialchars($ticket['ticketTypeQuantity']) ?>)</div>
                                    <div><?= htmlspecialchars($ticket['ticketTypePrice'] * $ticket['ticketTypeQuantity']) ?> LKR</div>
                                </div>
                                <?php endforeach; ?>
                                
                                <div class="payment-row total">
                                    <div>Total Amount</div>
                                    <div><?= htmlspecialchars($data['bookingInfo']->totalAmount) ?> LKR</div>
                                </div>

                                <div class="payment-status paid">
                                    Paid
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const eventLocation = "<?php echo urlencode($data['eventInfo']->eventLocation); ?>";
                const latitude = position.coords.latitude;
                console.log(latitude);
                const longitude = position.coords.longitude;
                const mapFrame = document.querySelector('#mapFrame');
                mapFrame.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&origin=${latitude},${longitude}&destination=${eventLocation}&mode=driving`;
            },
            (error) => {
                alert('Unable to retrieve your location. Please check your settings.');
            }
        );

    </script>
</body>

</html>