<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/paymentdetails.css?v=1.0">
    <title>Hotel Payment Details</title>
    <style>
        /* General styles */
        
    </style>
</head>
<body>
    <main>
        <div class="container">
            <!-- Payment Summary Cards -->
            <div class="payment-summary">
                <div class="summary-card">
                    <h3>Total Revenue</h3>
                    <p class="amount">LKR <?= number_format($totalRevenue, 2) ?></p>
                </div>
                <div class="summary-card">
                    <h3>Current month Revenue</h3>
                    <p class="amount">LKR <?= number_format($currentMonthRevenue, 2) ?></p>
                </div>
                <div class="summary-card">
                    <h3>Current month Commission</h3>
                    <p class="amount">LKR <?= number_format($currentMonthCommission, 2) ?></p>
                </div>
            </div>

            <!-- Chart for visualizing revenue and commission trends -->
            

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
                    <!-- <a href="<?= ROOT ?>/Hpaymentdetails/exportPaymentHistory<?= isset($_GET['month']) && isset($_GET['year']) ? '?month='.$_GET['month'].'&year='.$_GET['year'] : '' ?>" class="btn btn-export">Export to CSV</a> -->
                </form>
            </div>

            <!-- Payment Details Table -->
            <div class="payment-history">
                <h2>Payment History</h2>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error'] ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
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
        </div>
    </main>

    <!-- Booking Details Modal -->
    <div id="bookingDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script>
        // Initialize the chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            // Revenue data for the past 6 months
            const revenueData = <?= json_encode($monthlyData ?? []) ?>;
            
            const monthNames = revenueData.map(item => item.month);
            const revenues = revenueData.map(item => item.revenue);
            const commissions = revenueData.map(item => item.commission);
            
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: monthNames,
                    datasets: [
                        {
                            label: 'Revenue',
                            data: revenues,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Commission',
                            data: commissions,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Amount (LKR)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        });

        // Modal functionality
        const modal = document.getElementById('bookingDetailsModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const closeModalX = document.querySelector('.close-modal');
        const printBookingBtn = document.getElementById('printBookingBtn');
        const cancelBookingBtn = document.getElementById('cancelBookingBtn');

        // Function to open modal with booking details
        function viewBookingDetails(bookingId) {
            // In a real application, you would fetch the booking details from the server
            // Here we just show the modal with sample data
            modal.style.display = 'block';
            
            // For demonstration, update the booking ID dynamically
            document.getElementById('bookingId').textContent = 'BK-' + bookingId;
            
            // You would typically load the actual booking data here
            // For example:
            // fetch(`/api/bookings/${bookingId}`)
            //     .then(response => response.json())
            //     .then(data => updateBookingDetails(data))
            //     .catch(error => console.error('Error fetching booking details:', error));
        }

        // For demonstration, this function would update the booking details in the modal
        function updateBookingDetails(data) {
            // Update booking information with real data
            document.getElementById('bookingDate').textContent = data.bookingDate;
            document.getElementById('paymentStatus').textContent = data.paymentStatus;
            // ... and so on for all fields
        }

        // Close modal when clicking the close button
        closeModalBtn.onclick = function() {
            modal.style.display = 'none';
        }

        // Close modal when clicking the X
        closeModalX.onclick = function() {
            modal.style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        }

        // Print booking functionality
        printBookingBtn.onclick = function() {
            window.print();
        }

        // Cancel booking functionality
        cancelBookingBtn.onclick = function() {
            if (confirm('Are you sure you want to cancel this booking? This action cannot be undone.')) {
                // Here you would typically make an AJAX call to your backend
                alert('Booking cancellation request submitted. The hotel will be notified.');
                // In a real application:
                // fetch(`/api/bookings/${bookingId}/cancel`, { method: 'POST' })
                //     .then(response => response.json())
                //     .then(data => {
                //         if (data.success) {
                //             alert('Booking has been cancelled successfully.');
                //             modal.style.display = 'none';
                //             // Refresh the page or update the table
                //         } else {
                //             alert('Error: ' + data.message);
                //         }
                //     })
                //     .catch(error => console.error('Error cancelling booking:', error));
            }
        }
    </script>
</body>
</html>