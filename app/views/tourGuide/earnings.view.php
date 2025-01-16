<!DOCTYPE html>
<html lang="en">
<head>
    <title>ExploreLK Tour Guide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexContainer">
        
        <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

        <div class="body-container">
            <div class="heading">
                <h2>Payment Overview</h2>
            </div>

            <div class="tabs">
                <button class="tab active">All</button>
                <button class="tab">Pending</button>
                <button class="tab">Confirmed</button>
                <button class="tab">Canceled</button>
            </div>

            <div class="sub-heading">
                <h3>Payment History</h3>
            </div>

            <div class="dropdown-buttons">
                <div class="dropdown-btn">
                    <div class="dropdown">
                        <button class="dropbtn">Date Range &darr;</button>
                        <div class="dropdown-content">
                            <a href="#">Last 15 days</a>
                            <a href="#">Last 30 days</a>
                            <a href="#">Last 3 months</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown-btn">
                    <div class="dropdown">
                        <button class="dropbtn">Status &darr;</button>
                        <div class="dropdown-content">
                            <a href="#">Paid</a>
                            <a href="#">Pending</a>
                            <a href="#">Unpaid</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <!-- Booking List Table -->
                <div class="booking-list">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer &amp; Time</th>
                                <th>Amount</th>
                                <th>Commission</th>
                                <th>Net Amount</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12345</td>
                                <td>John Doe</td>
                                <td>Rs. 10000</td>
                                <td>Rs. 1000</td>
                                <td>Rs 9000</td>
                                <td>Jan 10, 2024</td>
                                <td><span class="status-pending">Pending</span></td>
                            </tr>
                            <tr>
                                <td>45611</td>
                                <td>Jane Smith</td>
                                <td>Rs. 5000</td>
                                <td>Rs. 500</td>
                                <td>Rs 4500</td>
                                <td>Feb 5, 2024</td>
                                <td><span class="status-confirmed">Paid</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="sub-heading" style="border-top: 1px solid #bcbcbc;">
                <h3>Commission Summary</h3>
            </div>

            <div class="commission-section">
                <div class="commission-item">
                    <span class="label">Commission Rate:</span>
                    <span class="value">10%</span>
                </div>
                <div class="commission-item">
                    <span class="label">Total Commission Charged:</span>
                    <span class="value">$500</span>
                </div>
                <button class="report-button">Report an Issue</button>
            </div>
        </div>

    </div>
</body>
</html>
