<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';

    $approvedCommissions = $data['approvedCommissions']; // these are arrays
    $pendingCommissions = $data['pendingCommissions'];
    // show($approvedCommissions);

    $totalApprovedCommission = 0;
    $totalPendingCommission = 0;
    foreach ($approvedCommissions as $approvedCommission) {
        $totalApprovedCommission += $approvedCommission->total_amount;
    }
    
    foreach ($pendingCommissions as $pendingCommission) {
        $totalPendingCommission += $pendingCommission->total_amount;
    }
    $commissionToPay = $totalCommission - $totalApprovedCommission - $totalPendingCommission;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Hotel Payment Details</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            margin-top: 220px;
            margin-left: 240px;
            padding: 0;
            background-color: #f7f9fc;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Payment summary cards */
        .payment-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .summary-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .summary-card h3 {
            margin-top: 0;
            color: #555;
            font-size: 1.1rem;
        }

        .amount {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
            margin: 10px 0 0;
        }

        /* Filter controls */
        .filter-controls {
            margin-bottom: 20px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
        }

        .form-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group label {
            font-weight: 500;
            color: #555;
        }

        .form-group select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            border: none;
            transition: opacity 0.2s;
        }

        .btn-filter {
            background-color: #007bff;
            color: white;
        }

        .btn-reset {
            background-color: #6c757d;
            color: white;
        }

        .btn-export {
            background-color: #28a745;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Tabbed interface */
        .payment-earning-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .tabs {
            list-style: none;
            padding: 0;
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .tab-link {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            color: #555;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .tab-link:hover {
            background-color: #f1f1f1;
        }

        .tab-link.active {
            border-bottom: 2px solid #007bff;
            color: #007bff;
            font-weight: 600;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .tab-content h2 {
            margin-top: 0;
            color: #333;
            font-size: 1.3rem;
            margin-bottom: 20px;
        }

        /* Earnings commission payment */
        .earnings-commission-payment {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .earnings-payment-info {
            display: flex;
            flex-direction: column;
        }

        .earnings-payment-label {
            font-size: 1rem;
            color: #555;
            font-weight: 500;
        }

        .earnings-payment-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-top: 5px;
        }

        .earnings-btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .earnings-btn-primary:hover {
            background-color: #0056b3;
        }

        /* Tables */
        .payment-table, .earning-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .payment-table th, .payment-table td,
        .earning-table th, .earning-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .payment-table th, .earning-table th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: 600;
        }

        .payment-table tr:hover, .earning-table tr:hover {
            background-color: #f8f9fa;
        }

        .status-active {
            color: #28a745;
            font-weight: 500;
        }

        .status-inactive {
            color: #dc3545;
            font-weight: 500;
        }

        .no-records {
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .btn-view:hover {
            background-color: #138496;
        }

        /* Alerts */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Booking details modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            max-width: 900px;
            margin: 30px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            animation-name: modalopen;
            animation-duration: 0.3s;
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-right: 15px;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: #000;
        }

        @keyframes modalopen {
            from {opacity: 0; transform: translateY(-60px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .booking-container {
            padding: 25px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .booking-info {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section h2 {
            color: #444;
            font-size: 1.3rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }

        .full-width {
            grid-column: span 2;
        }

        .label {
            font-size: 0.85rem;
            color: #777;
            margin-bottom: 5px;
        }

        .value {
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .price-summary {
            border-top: 1px solid #eee;
            margin-top: 20px;
            padding-top: 20px;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price-total {
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            body {
                margin-left: 0;
                margin-top: 100px;
            }

            .container {
                padding: 10px;
            }

            .payment-summary {
                grid-template-columns: 1fr;
            }

            .filter-form {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-export {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }

            .payment-table, .earning-table {
                font-size: 0.85rem;
            }

            .payment-table th, .payment-table td,
            .earning-table th, .earning-table td {
                padding: 8px 10px;
            }

            .tabs {
                flex-direction: column;
            }

            .tab-link {
                padding: 10px;
                border-bottom: none;
                border-left: 2px solid transparent;
            }

            .tab-link.active {
                border-bottom: none;
                border-left: 2px solid #007bff;
            }

            .earnings-commission-payment {
                flex-direction: column;
                gap: 10px;
            }

            .earnings-btn-primary {
                width: 100%;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: span 1;
            }

            .actions {
                flex-direction: column;
            }

            .actions a, .actions button {
                width: 100%;
                margin-bottom: 10px;
                text-align: center;
            }

            .modal-content {
                margin: 10px;
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <?php 
    // show($data);
    // exit();
    ?>
    <main>
        <div class="container">
            <!-- Payment Summary Cards -->
            <div class="payment-summary">
                <div class="summary-card">
                    <h3>Total Revenue</h3>
                    <p class="amount">LKR <?= number_format($totalRevenue, 2) ?></p>
                </div>
                <div class="summary-card">
                    <h3>Current Month Revenue</h3>
                    <p class="amount">LKR <?= number_format($currentMonthRevenue, 2) ?></p>
                </div>
                <div class="summary-card">
                    <h3>Current Month Commission</h3>
                    <p class="amount">LKR <?= number_format($currentMonthCommission, 2) ?></p>
                </div>
            </div>

            <!-- Filter Controls -->
            <div class="filter-controls">
                <form method="GET" action="<?= ROOT ?>/Hpaymentdetails" class="filter-form">
                    <div class="form-group">
                        <label for="month">Month:</label>
                        <select name="month" id="month">
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?= sprintf('%02d', $i) ?>" <?= $currentMonth == sprintf('%02d', $i) ? 'selected' : '' ?>>
                                    <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year">Year:</label>
                        <select name="year" id="year">
                            <?php for ($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                <option value="<?= $i ?>" <?= $currentYear == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-filter">Filter</button>
                    <a href="<?= ROOT ?>/Hpaymentdetails" class="btn btn-reset">Reset</a>
                </form>
            </div>

            <!-- Payment and Earning Tabs -->
            <div class="payment-earning-container">
                <!-- Tab Navigation -->
                <ul class="tabs">
                    <li class="tab-link" data-tab="payment-history">Commission Payment</li>
                    <li class="tab-link active" data-tab="earning">Earning History</li>
                </ul>

                <!-- Payment History Tab Content -->
                <div id="payment-history" class="tab-content">
                    <h2>Payment History</h2>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <?= $_SESSION['error'] ?>
                            <?php unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="earnings-commission-payment">
                        <div class="earnings-payment-info">
                            <span class="earnings-payment-label">Outstanding Commission</span>
                            <span class="earnings-payment-amount">Rs <?= number_format($commissionToPay, 2) ?></span>
                        </div>
                        <button class="earnings-btn earnings-btn-primary">Pay Now</button>
                    </div>

                    <table class="payment-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Booking ID</th>
                                <th>Total Amount</th>
                                <th>Commission Rate</th>
                                <th>Commission Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($paymentHistory)): ?>
                                <?php foreach ($paymentHistory as $payment): ?>
                                    <tr>
                                        <td><?= date('Y-m-d', strtotime($payment->created_at)) ?></td>
                                        <td><?= $payment->room_booking_Id ?></td>
                                        <td>LKR <?= number_format($payment->total_amount, 2) ?></td>
                                        <td><?= $payment->commission_rate ?>%</td>
                                        <td>LKR <?= number_format($payment->commission_amount, 2) ?></td>
                                        <td>
                                            <?= $payment->is_applicable_for_commission ? 
                                                 '<span class="status-active">Active</span>' : 
                                                 '<span class="status-inactive">Not Applicable</span>' ?>
                                        </td>
                                        <td>
                                            <button class="btn-view" onclick="viewBookingDetails(<?= $payment->room_booking_Id ?>)">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="no-records">No payment records found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Earning Tab Content -->
                <div id="earning" class="tab-content active">
                    <h2>Earning</h2>
                    <table class="earning-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Booking ID</th>
                                <th>Total Amount</th>
                                <th>Advance Amount</th>
                                <th>Booking Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($earningHistory)): ?>
                                <?php foreach ($earningHistory as $earning): ?>
                                    <tr>
                                        <td><?= date('Y-m-d', strtotime($earning->created_at)) ?></td>
                                        <td><?= $earning->room_booking_Id ?></td>
                                        <td>LKR <?= number_format($earning->total_amount, 2) ?></td>
                                        <td>LKR <?= number_format(property_exists($earning, 'advance_amount') ? $earning->advance_amount : 0, 2) ?></td>
                                        <td>
                                            <?php 
                                                $status = property_exists($earning, 'booking_status') ? $earning->booking_status : 'Unknown';
                                                $statusClass = $status === 'Confirmed' ? 'status-active' : 'status-inactive';
                                            ?>
                                            <span class="<?= $statusClass ?>"><?= htmlspecialchars($status) ?></span>
                                        </td>
                                        <td>
                                            <button class="btn-view" onclick="viewBookingDetails(<?= $earning->room_booking_Id ?>)">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="no-records">No earning records found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Booking Details Modal -->
    <div id="bookingDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">×</span>
            <div class="booking-container">
                <h1>Booking Details <span id="bookingStatus" class="badge badge-success">Confirmed</span></h1>
                
                <div class="booking-info">
                    <div class="info-section">
                        <h2>Reservation Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Booking ID</span>
                                <span id="bookingId" class="value">BK-2023-04589</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Booking Date</span>
                                <span id="bookingDate" class="value">April 15, 2023</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Status</span>
                                <span id="paymentStatus" class="value status-active">Active</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Payment Status</span>
                                <span id="paymentStatusValue" class="value">Paid</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h2>Guest Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Guest Name</span>
                                <span id="guestName" class="value">John Doe</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Email</span>
                                <span id="guestEmail" class="value">john.doe@example.com</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Phone</span>
                                <span id="guestPhone" class="value">+1 (555) 123-4567</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Number of Guests</span>
                                <span id="guestCount" class="value">2 Adults, 1 Child</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h2>Stay Details</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="label">Check-in Date</span>
                                <span id="checkInDate" class="value">May 10, 2023</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Check-out Date</span>
                                <span id="checkOutDate" class="value">May 15, 2023</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Duration</span>
                                <span id="stayDuration" class="value">5 Nights</span>
                            </div>
                            <div class="info-item">
                                <span class="label">Room Type</span>
                                <span id="roomType" class="value">Deluxe Ocean View</span>
                            </div>
                            <div class="info-item full-width">
                                <span class="label">Special Requests</span>
                                <span id="specialRequests" class="value">Early check-in if possible. Need an extra pillow.</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h2>Price Details</h2>
                        <div class="price-summary">
                            <div class="price-item">
                                <span id="roomRate">Room Rate (5 nights × $150)</span>
                                <span id="roomRateTotal">$750.00</span>
                            </div>
                            <div class="price-item">
                                <span>Resort Fee</span>
                                <span id="resortFee">$50.00</span>
                            </div>
                            <div class="price-item">
                                <span id="taxRate">Taxes (12%)</span>
                                <span id="taxAmount">$96.00</span>
                            </div>
                            <div class="price-total">
                                <span>Total</span>
                                <span id="totalAmount">$896.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <button id="closeModalBtn" class="btn btn-secondary">Close</button>
                    <button id="printBookingBtn" class="btn btn-primary">Print Booking</button>
                    <button id="cancelBookingBtn" class="btn btn-danger">Cancel Booking</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('bookingDetailsModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const closeModalX = document.querySelector('.close-modal');
        const printBookingBtn = document.getElementById('printBookingBtn');
        const cancelBookingBtn = document.getElementById('cancelBookingBtn');

        function viewBookingDetails(bookingId) {
            modal.style.display = 'block';
            document.getElementById('bookingId').textContent = 'BK-' + bookingId;
        }

        closeModalBtn.onclick = function() {
            modal.style.display = 'none';
        }

        closeModalX.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        printBookingBtn.onclick = function() {
            window.print();
        }

        cancelBookingBtn.onclick = function() {
            if (confirm('Are you sure you want to cancel this booking? This action cannot be undone.')) {
                alert('Booking cancellation request submitted. The hotel will be notified.');
            }
        }

        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab-link');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    contents.forEach(c => c.classList.remove('active'));

                    // Add active class to clicked tab and corresponding content
                    this.classList.add('active');
                    document.getElementById(this.dataset.tab).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>