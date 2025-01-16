<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>
<main>
    <div class="payment-container">
        <h4>Payment Details Overview</h4>
        
        <!-- Payment Summary Cards -->
        <div class="payment-summary">
            <div class="summary-card">
                <h3>Total Revenue</h3>
                <p class="amount">LKR 250,000</p>
            </div>
            <div class="summary-card">
                <h3>Pending Payments</h3>
                <p class="amount">LKR 45,000</p>
            </div>
            <div class="summary-card">
                <h3>Today's Earnings</h3>
                <p class="amount">LKR 35,000</p>
            </div>
        </div>

        <!-- Payment Details Table -->
        <div class="payment-details">
            <h3>Recent Payments</h3>
            <table>
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Guest Name</th>
                        <th>Room Number</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#BK001</td>
                        <td>John Doe</td>
                        <td>101</td>
                        <td>LKR 15,000</td>
                        <td>2023-12-01</td>
                        <td><span class="status-paid">Paid</span></td>
                        <td><button onclick="viewDetails('#BK001')">View</button></td>
                    </tr>
                    <tr>
                        <td>#BK002</td>
                        <td>Jane Smith</td>
                        <td>204</td>
                        <td>LKR 25,000</td>
                        <td>2023-12-02</td>
                        <td><span class="status-pending">Pending</span></td>
                        <td><button onclick="viewDetails('#BK002')">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <style>
    .payment-container {
        padding: 20px;
        margin-top: 200px;
    }

    .payment-summary {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        margin-bottom: 30px;
        gap: 20px;
        padding: 0 20px;
    }

    .summary-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        flex: 1;
    }

    .amount {
        font-size: 24px;
        color: #002D40;
        font-weight: bold;
    }

    .payment-details {
        margin: 0 20px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .payment-details table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .payment-details th, 
    .payment-details td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .payment-details th {
        background: #f8f9fa;
        color: #002D40;
    }

    .status-paid {
        background: #28a745;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
    }

    .status-pending {
        background: #ffc107;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
    }

    button {
        background: #002D40;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background: #B3D9FF;
        color: #002D40;
    }

    h2, h3 {
        color: #002D40;
    }
    h4 {
        color: #002D40;
        margin-left: 25px;
        font-size: 24px;
    }
    </style>

    <script>
    function viewDetails(bookingId) {
        alert(`Viewing details for booking ${bookingId}`);
    }
    </script>
</main>
