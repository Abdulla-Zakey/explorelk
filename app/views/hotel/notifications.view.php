<?php 
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking Management</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/notifications.css?v=1.0">
</head>
<body>
    <div class="container">
        <?php if(isset($data['error'])): ?>
            <div class="error-message">
                <?= esc($data['error']) ?>
            </div>
        <?php endif; ?>
        
        <div class="booking-filters">
            <div class="filter-item">
                <label for="date-filter">Sort by:</label>
                <select id="date-filter" onchange="applyFilters()">
                    <option value="newest" <?= ($data['currentSort'] ?? '') === 'newest' ? 'selected' : '' ?>>Newest First</option>
                    <option value="oldest" <?= ($data['currentSort'] ?? '') === 'oldest' ? 'selected' : '' ?>>Oldest First</option>
                    <option value="check-in" <?= ($data['currentSort'] ?? '') === 'check-in' ? 'selected' : '' ?>>Check-in Date</option>
                </select>
            </div>
            
            <div class="filter-item">
                <label for="status-filter">Status:</label>
                <select id="status-filter" onchange="applyFilters()">
                    <option value="all" <?= ($data['currentStatus'] ?? '') === 'all' ? 'selected' : '' ?>>All Statuses</option>
                    <option value="Pending" <?= ($data['currentStatus'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= ($data['currentStatus'] ?? '') === 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Confirmed" <?= ($data['currentStatus'] ?? '') === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                    <option value="Cancelled" <?= ($data['currentStatus'] ?? '') === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            
            <button id="refresh-btn">Refresh List</button>
        </div>

        <div id="bookings-container">
            <?php if (!empty($data['bookings'])): ?>
                <?php foreach ($data['bookings'] as $booking): ?>
                    <div class="booking-card">
                        <div class="booking-header">
                            <div class="booking-id">Booking #<?= esc($booking->room_booking_Id) ?></div>
                            <div class="booking-status status-<?= strtolower($booking->booking_status) ?>">
                                <?= esc($booking->booking_status) ?>
                            </div>
                        </div>

                        <div class="booking-content">
                            <div class="booking-details">
                                <div class="detail-group">
                                    <h3>Guest Name</h3>
                                    <p><?= esc($booking->guest_full_name ?? 'N/A') ?></p>
                                </div>
                                <div class="detail-group">
                                    <h3>NIC No</h3>
                                    <p><?= esc($booking->guest_nic ?? 'N/A') ?></p>
                                </div>
                                <div class="detail-group">
                                    <h3>Room Type</h3>
                                    <p><?= esc($booking->roomType_name ?? 'N/A') ?></p>
                                </div>
                                <div class="detail-group">
                                    <h3>Total Rooms</h3>
                                    <p><?= esc($booking->total_rooms ?? 'N/A') ?></p>
                                </div>
                                <div class="detail-group">
                                    <h3>Check-in</h3>
                                    <p>
                                        <?= !empty($booking->check_in) && strtotime($booking->check_in) 
                                            ? esc(date('M d, Y', strtotime($booking->check_in))) 
                                            : 'N/A' ?>
                                    </p>
                                </div>
                                <div class="detail-group">
                                    <h3>Check-out</h3>
                                    <p>
                                        <?= !empty($booking->check_out) && strtotime($booking->check_out) 
                                            ? esc(date('M d, Y', strtotime($booking->check_out))) 
                                            : 'N/A' ?>
                                    </p>
                                </div>
                            </div>

                            <div class="special-requests">
                                <h3>Special Requests</h3>
                                <p><?= esc($booking->special_requests ?? 'None') ?></p>
                            </div>

                            <div class="payment-details">
                                <h3>Payment Information</h3>
                                <div class="payment-flex">
                                    <span class="payment-label">Total Amount:</span>
                                    <span class="payment-value">Rs.<?= esc(number_format($booking->total_amount ?? 0, 2)) ?></span>
                                </div>
                                <div class="payment-flex">
                                    <span class="payment-label">Advance Payment Required:</span>
                                    <span class="payment-value">Rs.<?= esc(number_format($booking->advance_payment_amount ?? 0, 2)) ?></span>
                                </div>
                                <div class="payment-flex">
                                    <span class="payment-label">Advance Payment Status:</span>
                                    <span class="payment-status payment-<?= strtolower($booking->advance_payment_status) ?>">
                                        <?= esc($booking->advance_payment_status ?? 'N/A') ?>
                                    </span>
                                </div>
                                <div class="payment-flex">
                                    <span class="payment-label">Payment Deadline:</span>
                                    <span class="payment-value">
                                        <?= !empty($booking->advance_payment_deadline) && strtotime($booking->advance_payment_deadline) 
                                            ? esc(date('M d, Y', strtotime($booking->advance_payment_deadline))) 
                                            : 'N/A' ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="booking-card">
                    <div class="booking-content">
                        <div class="booking-details">
                            <p style="text-align: center; width: 100%;">No bookings found.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Server-side filtering and sorting
        function applyFilters() {
            const sortBy = document.getElementById('date-filter').value;
            const statusFilter = document.getElementById('status-filter').value;
            
            // Redirect with query parameters
            window.location.href = `<?= ROOT ?>/Hotel/Hnotifications?sort=${sortBy}&status=${statusFilter}`;
        }
        
        // Refresh button
        document.getElementById('refresh-btn').addEventListener('click', () => {
            window.location.reload();
        });
        
        // Client-side sorting (for demonstration, but we're using server-side sorting now)
        const bookings = <?php echo json_encode($data['bookings'] ?? []); ?>;
    </script>
</body>
</html>