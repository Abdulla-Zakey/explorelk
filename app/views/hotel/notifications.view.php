<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
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
        
        <div class="booking-filters">
            <div class="filter-item">
                <label for="status-filter">Status:</label>
                <select id="status-filter">
                    <option value="all">All Bookings</option>
                    <option value="pending">Pending</option>
                    <option value="accepted">Accepted</option>
                    <option value="declined">Declined</option>
                </select>
            </div>
            
            <div class="filter-item">
                <label for="date-filter">Sort by:</label>
                <select id="date-filter">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="check-in">Check-in Date</option>
                </select>
            </div>
            
            <button id="refresh-btn">Refresh List</button>
        </div>
        
        <div id="bookings-container">
            <!-- Booking Card 1 (Pending) -->
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-id">Booking #RB00123</div>
                    <div class="booking-status status-pending">Pending</div>
                </div>
                
                <div class="booking-content">
                    <div class="booking-details">
                        <div class="detail-group">
                            <h3>Traveler Name</h3>
                            <p>Virat Kholi</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>NIC No</h3>
                            <p>200212345678</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Room Type</h3>
                            <p>Deluxe Suite</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Check-in</h3>
                            <p>Apr 15, 2025</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Check-out</h3>
                            <p>Apr 20, 2025</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Total Rooms</h3>
                            <p>2</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Requested Date</h3>
                            <p>Apr 05, 2025</p>
                        </div>
                    </div>
                    
                    <div class="special-requests">
                        <h3>Special Requests</h3>
                        <p>Early check-in if possible. Would prefer rooms on the same floor with ocean view.</p>
                    </div>
                    
                    <div class="payment-details">
                        <h3>Payment Information</h3>
                        <div class="payment-flex">
                            <span class="payment-label">Total Amount:</span>
                            <span class="payment-value">Rs.2000</span>
                        </div>
                        
                        <div class="payment-flex">
                            <span class="payment-label">Advance Payment Required:</span>
                            <span class="payment-value">Rs.2000</span>
                        </div>
                        
                        <div class="payment-flex">
                            <span class="payment-label">Advance Payment Status:</span>
                            <span class="payment-status payment-pending">Pending</span>
                        </div>
                        
                        <div class="payment-flex">
                            <span class="payment-label">Payment Deadline:</span>
                            <span class="payment-value">Apr 10, 2025</span>
                        </div>
                    </div>
                    
                    <div class="booking-actions">
                        <button class="btn-accept" onclick="openAcceptModal('RB00123')">Accept Booking</button>
                        <button class="btn-decline" onclick="openDeclineModal('RB00123')">Decline Booking</button>
                    </div>
                </div>
            </div>
            
            <!-- Booking Card 2 (Accepted) -->
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-id">Booking #RB00120</div>
                    <div class="booking-status status-accepted">Accepted</div>
                </div>
                
                <div class="booking-content">
                    <div class="booking-details">
                        <div class="detail-group">
                            <h3>Traveler ID</h3>
                            <p>T00389</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Hotel</h3>
                            <p>Grand Plaza</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Room Type</h3>
                            <p>Standard Twin</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Check-in</h3>
                            <p>Apr 12, 2025</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Check-out</h3>
                            <p>Apr 15, 2025</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Total Rooms</h3>
                            <p>1</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Requested Date</h3>
                            <p>Apr 01, 2025</p>
                        </div>
                        
                        <div class="detail-group">
                            <h3>Accepted Date</h3>
                            <p>Apr 02, 2025</p>
                        </div>
                    </div>
                    
                    <div class="special-requests">
                        <h3>Special Requests</h3>
                        <p>Non-smoking room.</p>
                    </div>
                    
                    <div class="payment-details">
                        <h3>Payment Information</h3>
                        <div class="payment-flex">
                            <span class="payment-label">Total Amount:</span>
                            <span class="payment-value">Rs.2000</span>
                        </div>
                        
                        <div class="payment-flex">
                            <span class="payment-label">Advance Payment Required:</span>
                            <span class="payment-value">$135.00</span>
                        </div>
                        
                        <div class="payment-flex">
                            <span class="payment-label">Advance Payment Status:</span>
                            <span class="payment-status payment-complete">Paid</span>
                        </div>
                        
                        <div class="payment-flex">
                            <span class="payment-label">Payment Date:</span>
                            <span class="payment-value">Apr 03, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Accept Booking Modal -->
    <div id="accept-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Accept Booking</h2>
                <span class="close" onclick="closeModal('accept-modal')">&times;</span>
            </div>
            
            <form id="accept-form" class="modal-form">
                <input type="hidden" id="accept-booking-id" value="">
                
                <div class="form-group">
                    <label for="advance-payment-deadline">Advance Payment Deadline</label>
                    <input type="date" id="advance-payment-deadline" required>
                </div>
                
                <div class="form-group">
                    <label for="special-notes">Special Notes (Optional)</label>
                    <input type="text" id="special-notes" placeholder="Any additional notes for the traveler">
                </div>
                
                <div class="modal-actions">
                    <button type="button" onclick="closeModal('accept-modal')">Cancel</button>
                    <button type="button" class="btn-accept" onclick="acceptBooking()">Confirm Acceptance</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Decline Booking Modal -->
    <div id="decline-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Decline Booking</h2>
                <span class="close" onclick="closeModal('decline-modal')">&times;</span>
            </div>
            
            <form id="decline-form" class="modal-form">
                <input type="hidden" id="decline-booking-id" value="">
                
                <div class="form-group">
                    <label for="decline-reason">Reason for Declining</label>
                    <input type="text" id="decline-reason" placeholder="Why is this booking being declined?" required>
                </div>
                
                <div class="modal-actions">
                    <button type="button" onclick="closeModal('decline-modal')">Cancel</button>
                    <button type="button" class="btn-decline" onclick="declineBooking()">Confirm Decline</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // DOM elements
        const statusFilter = document.getElementById('status-filter');
        const dateFilter = document.getElementById('date-filter');
        const refreshBtn = document.getElementById('refresh-btn');
        const bookingsContainer = document.getElementById('bookings-container');
        const acceptModal = document.getElementById('accept-modal');
        const declineModal = document.getElementById('decline-modal');
        
        // Sample data for bookings (in a real app, this would come from your PHP backend)
        let bookingsData = [
            {
                id: 'RB00123',
                guest_full_name: 'Virat Kholi',
                guest_nic: '200212345678',
                room_type: 'Deluxe Suite',
                check_in: 'Apr 15, 2025',
                check_out: 'Apr 20, 2025',
                total_rooms: 2,
                special_requests: 'Early check-in if possible. Would prefer rooms on the same floor with ocean view.',
                total_amount: 1250.00,
                advance_payment_amount: 375.00,
                paid_advance_payment_amount: 0,
                advance_payment_status: 'Pending',
                payment_deadline: 'Apr 10, 2025',
                booking_status: 'Pending',
                requested_date: 'Apr 05, 2025',
                accepted_date: null
            },
            {
                id: 'RB00120',
                guest_full_name: 'Sangeerthan Jabir',
                guest_nic: '200211112222',
                room_type: 'Standard Twin',
                check_in: 'Apr 12, 2025',
                check_out: 'Apr 15, 2025',
                total_rooms: 1,
                special_requests: 'Non-smoking room.',
                total_amount: 450.00,
                advance_payment_amount: 135.00,
                paid_advance_payment_amount: 135.00,
                advance_payment_status: 'Paid',
                payment_deadline: 'Apr 05, 2025',
                booking_status: 'Accepted',
                requested_date: 'Apr 01, 2025',
                accepted_date: 'Apr 02, 2025'
            }
        ];
        
        // Event listeners for filters
        statusFilter.addEventListener('change', filterBookings);
        dateFilter.addEventListener('change', filterBookings);
        refreshBtn.addEventListener('click', refreshBookings);
        
        // Function to filter bookings
        function filterBookings() {
            const statusValue = statusFilter.value;
            const dateValue = dateFilter.value;
            
            // Filter by status
            let filteredBookings = bookingsData;
            if (statusValue !== 'all') {
                filteredBookings = filteredBookings.filter(booking => 
                    booking.booking_status.toLowerCase() === statusValue
                );
            }
            
            // Sort by selected option
            if (dateValue === 'newest') {
                filteredBookings.sort((a, b) => new Date(b.requested_date) - new Date(a.requested_date));
            } else if (dateValue === 'oldest') {
                filteredBookings.sort((a, b) => new Date(a.requested_date) - new Date(b.requested_date));
            } else if (dateValue === 'check-in') {
                filteredBookings.sort((a, b) => new Date(a.check_in) - new Date(b.check_in));
            }
            
            renderBookings(filteredBookings);
        }
        
        // Function to refresh bookings (in a real app, this would fetch from server)
        function refreshBookings() {
            // Simulate loading
            bookingsContainer.innerHTML = '<p>Loading bookings...</p>';
            
            // In a real app, you would fetch from server here
            setTimeout(() => {
                renderBookings(bookingsData);
            }, 500);
        }
        
        // Function to render booking cards
        function renderBookings(bookings) {
            bookingsContainer.innerHTML = '';
            
            if (bookings.length === 0) {
                bookingsContainer.innerHTML = '<p>No bookings match your filters.</p>';
                return;
            }
            
            bookings.forEach(booking => {
                const card = document.createElement('div');
                card.className = 'booking-card';
                
                // Status class
                const statusClass = booking.booking_status.toLowerCase() === 'pending' ? 'status-pending' : 
                                    booking.booking_status.toLowerCase() === 'accepted' ? 'status-accepted' : 'status-declined';
                
                // Payment status class
                const paymentStatusClass = booking.advance_payment_status.toLowerCase() === 'paid' ? 'payment-complete' : 'payment-pending';
                
                card.innerHTML = `
                    <div class="booking-header">
                        <div class="booking-id">Booking #${booking.id}</div>
                        <div class="booking-status ${statusClass}">${booking.booking_status}</div>
                    </div>
                    
                    <div class="booking-content">
                        <div class="booking-details">
                            <div class="detail-group">
                                <h3>Guest Name</h3>
                                <p>${booking.guest_full_name}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h3>Guest NIC</h3>
                                <p>${booking.guest_nic}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h3>Room Type</h3>
                                <p>${booking.room_type}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h3>Check-in</h3>
                                <p>${booking.check_in}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h3>Check-out</h3>
                                <p>${booking.check_out}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h3>Total Rooms</h3>
                                <p>${booking.total_rooms}</p>
                            </div>
                            
                            <div class="detail-group">
                                <h3>Requested Date</h3>
                                <p>${booking.requested_date}</p>
                            </div>
                            
                            ${booking.accepted_date ? `
                            <div class="detail-group">
                                <h3>Accepted Date</h3>
                                <p>${booking.accepted_date}</p>
                            </div>
                            ` : ''}
                        </div>
                        
                        <div class="special-requests">
                            <h3>Special Requests</h3>
                            <p>${booking.special_requests || 'None'}</p>
                        </div>
                        
                        <div class="payment-details">
                            <h3>Payment Information</h3>
                            <div class="payment-flex">
                                <span class="payment-label">Total Amount:</span>
                                <span class="payment-value">$${booking.total_amount.toFixed(2)}</span>
                            </div>
                            
                            <div class="payment-flex">
                                <span class="payment-label">Advance Payment Required:</span>
                                <span class="payment-value">$${booking.advance_payment_amount.toFixed(2)}</span>
                            </div>
                            
                            <div class="payment-flex">
                                <span class="payment-label">Advance Payment Status:</span>
                                <span class="payment-status ${paymentStatusClass}">${booking.advance_payment_status}</span>
                            </div>
                            
                            <div class="payment-flex">
                                <span class="payment-label">${booking.advance_payment_status === 'Paid' ? 'Payment Date:' : 'Payment Deadline:'}</span>
                                <span class="payment-value">${booking.advance_payment_status === 'Paid' ? booking.advance_payment_paid_date : booking.payment_deadline}</span>
                            </div>
                        </div>
                        
                        ${booking.booking_status === 'Pending' ? `
                        <div class="booking-actions">
                            <button class="btn-accept" onclick="openAcceptModal('${booking.id}')">Accept Booking</button>
                            <button class="btn-decline" onclick="openDeclineModal('${booking.id}')">Decline Booking</button>
                        </div>
                        ` : ''}
                    </div>
                `;
                
                bookingsContainer.appendChild(card);
            });
        }
        
        // Modal functions
        function openAcceptModal(bookingId) {
            document.getElementById('accept-booking-id').value = bookingId;
            acceptModal.style.display = 'block';
        }
        
        function openDeclineModal(bookingId) {
            document.getElementById('decline-booking-id').value = bookingId;
            declineModal.style.display = 'block';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        // Handle accept booking
        function acceptBooking() {
            const bookingId = document.getElementById('accept-booking-id').value;
            const paymentDeadline = document.getElementById('advance-payment-deadline').value;
            const specialNotes = document.getElementById('special-notes').value;
            
            // In a real app, you would send this to your PHP backend
            console.log(`Accepting booking ${bookingId} with payment deadline ${paymentDeadline}`);
            
            // Update local data for demo purposes
            const bookingIndex = bookingsData.findIndex(b => b.id === bookingId);
            if (bookingIndex !== -1) {
                bookingsData[bookingIndex].booking_status = 'Accepted';
                bookingsData[bookingIndex].accepted_date = new Date().toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
                bookingsData[bookingIndex].payment_deadline = new Date(paymentDeadline)
                    .toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    });
            }
            
            // Close modal and refresh
            closeModal('accept-modal');
            document.getElementById('accept-form').reset();
            filterBookings();
            
            // Show confirmation (in a real app, use a better notification system)
            alert(`Booking #${bookingId} has been accepted successfully.`);
        }
        
        // Handle decline booking
        function declineBooking() {
            const bookingId = document.getElementById('decline-booking-id').value;
            const reason = document.getElementById('decline-reason').value;
            
            // In a real app, you would send this to your PHP backend
            console.log(`Declining booking ${bookingId} because: ${reason}`);
            
            // Update local data for demo purposes
            const bookingIndex = bookingsData.findIndex(b => b.id === bookingId);
            if (bookingIndex !== -1) {
                bookingsData[bookingIndex].booking_status = 'Declined';
            }
            
            // Close modal and refresh
            closeModal('decline-modal');
            document.getElementById('decline-form').reset();
            filterBookings();
            
            // Show confirmation (in a real app, use a better notification system)
            alert(`Booking #${bookingId} has been declined.`);
        }
        
        // Initialize the page
        filterBookings();
        
        // Close modals if user clicks outside
        window.onclick = function(event) {
            if (event.target === acceptModal) {
                closeModal('accept-modal');
            } else if (event.target === declineModal) {
                closeModal('decline-modal');
            }
        }
    </script>
</body>
</html>