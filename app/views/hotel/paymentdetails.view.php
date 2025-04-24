<?php include_once APPROOT.'/views/hotel/nav.php'; include_once APPROOT.'/views/hotel/hotelhead.php'; ?>

<head>
    <title>Payment Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/paymentdetails.css?v=1.0">
    <style>
        .detail-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .detail-container h3 {
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px dashed #f0f0f0;
        }
        
        .detail-label {
            width: 40%;
            font-weight: bold;
        }
        
        .detail-value {
            width: 60%;
        }
        
        .button-row {
            margin-top: 20px;
            text-align: right;
        }
        
        .back-button {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>

<main>
    <div class="payment-container">
        <h4>Payment Details for Booking #<?= $booking->roomBooking_Id ?></h4>
        
        <!-- Booking Details -->
        <div class="detail-container">
            <h3>Booking Information</h3>
            
            <div class="detail-row">
                <div class="detail-label">Booking ID:</div>
                <div class="detail-value">#<?= $booking->roomBooking_Id ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Check-in Date:</div>
                <div class="detail-value"><?= date('Y-m-d', strtotime($booking->checkInDate)) ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Check-out Date:</div>
                <div class="detail-value"><?= date('Y-m-d', strtotime($booking->checkOutDate)) ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Total Days:</div>
                <div class="detail-value">
                    <?php
                        $checkIn = new DateTime($booking->checkInDate);
                        $checkOut = new DateTime($booking->checkOutDate);
                        $interval = $checkIn->diff($checkOut);
                        echo $interval->days;
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Guest Information -->
        <div class="detail-container">
            <h3>Guest Information</h3>
            
            <div class="detail-row">
                <div class="detail-label">Name:</div>
                <div class="detail-value"><?= $guest->guest_full_name ?? 'N/A' ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Email:</div>
                <div class="detail-value"><?= $guest->guest_email ?? 'N/A' ?></div>
            </div>
            
            <?php if(!empty($guest->guest_mobile_num)): ?>
            <div class="detail-row">
                <div class="detail-label">Phone:</div>
                <div class="detail-value"><?= $guest->guest_mobile_num ?></div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Payment Details -->
        <div class="detail-container">
            <h3>Payment Information</h3>
            
            <div class="detail-row">
                <div class="detail-label">Total Amount:</div>
                <div class="detail-value">LKR <?= number_format($booking->total_amount ?? 0, 2) ?></div>
            </div>
            
            <?php if(!empty($commission)): ?>
            <div class="detail-row">
                <div class="detail-label">Commission Rate:</div>
                <div class="detail-value"><?= number_format($commission->commission_rate ?? 0, 2) ?>%</div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Commission Amount:</div>
                <div class="detail-value">LKR <?= number_format($commission->commission_amount ?? 0, 2) ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Net Amount:</div>
                <div class="detail-value">LKR <?= number_format(($booking->total_amount - $commission->commission_amount) ?? 0, 2) ?></div>
            </div>
            <?php endif; ?>
            
            <div class="detail-row">
                <div class="detail-label">Payment Date:</div>
                <div class="detail-value"><?= !empty($booking->bookedDate) ? date('Y-m-d', strtotime($booking->bookedDate)) : 'N/A' ?></div>
            </div>
            
            <div class="detail-row">
                <div class="detail-label">Payment Status:</div>
                <div class="detail-value">
                    <span class="status-<?= strtolower($booking->bookingStatus) ?>"><?= ucfirst($booking->bookingStatus) ?></span>
                </div>
            </div>
        </div>
        
        <div class="button-row">
            <a href="<?= ROOT ?>/hpaymentdetails" class="back-button">Back to Payment List</a>
        </div>
    </div>
</main>