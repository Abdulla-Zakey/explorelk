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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
        }
        
        .container {
            max-width: 1100px;
            margin-left: 280px;
            margin-top: 210px;
            padding: 20px;
        }
        
        header {
            background-color: #002D40;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .booking-filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .filter-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        select, button {
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            font-size: 14px;
        }
        
        button {
            background-color: #002D40;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        button:hover {
            background-color: #B3D9FF;
        }
        
        .booking-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .booking-header {
            background-color: #B3D9FF;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .booking-id {
            font-weight: bold;
            color: #002D40;
        }
        
        .booking-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pending {
            background-color: #ffecb3;
            color: #ff6f00;
        }
        
        .status-accepted {
            background-color: #c8e6c9;
            color: #2e7d32;
        }
        
        .status-declined {
            background-color: #ffcdd2;
            color: #c62828;
        }
        
        .booking-content {
            padding: 20px;
        }
        
        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .detail-group h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 5px;
        }
        
        .detail-group p {
            font-size: 16px;
            color: #333;
        }
        
        .special-requests {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .special-requests h3 {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 10px;
        }
        
        .special-requests p {
            font-size: 14px;
            line-height: 1.5;
        }
        
        .booking-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        
        .btn-accept {
            background-color: #4caf50;
        }
        
        .btn-accept:hover {
            background-color: #388e3c;
        }
        
        .btn-decline {
            background-color: #f44336;
        }
        
        .btn-decline:hover {
            background-color: #d32f2f;
        }
        
        .payment-details {
            background-color: #f1f8e9;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .payment-details h3 {
            font-size: 14px;
            color: #33691e;
            margin-bottom: 10px;
        }
        
        .payment-flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .payment-label {
            color: #64748b;
        }
        
        .payment-value {
            font-weight: bold;
        }
        
        .payment-status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .payment-pending {
            background-color: #fff9c4;
            color: #f57f17;
        }
        
        .payment-complete {
            background-color: #c8e6c9;
            color: #2e7d32;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-header h2 {
            font-size: 20px;
        }
        
        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .close:hover {
            color: black;
        }
        
        .modal-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .form-group label {
            font-size: 14px;
            color: #002D40;
        }
        
        .form-group input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .booking-details {
                grid-template-columns: 1fr;
            }
            
            .booking-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .booking-actions {
                justify-content: flex-start;
                flex-wrap: wrap;
            }
        }
    </style>
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