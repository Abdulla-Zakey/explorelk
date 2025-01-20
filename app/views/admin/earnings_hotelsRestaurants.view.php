<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ExploreLK Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
        <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
    </head>
    
    <body>
        <div class="flexContainer">
        
            <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

            <div class="body-container">
                <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

                <div>
                    <h1 class="heading" style="margin-bottom: -3%;">Hotels and Restaurants Payment</h1>
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
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Commission</th>
                                    <th>Net Amount</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>12345</td>
                                    <td>Adam Smith</td>
                                    <td>Rs. 44000</td>
                                    <td>Rs. 4400</td>
                                    <td>Rs 39600</td>
                                    <td>Sep 10, 2024</td>
                                    <td><span class="status-pending">Unpaid</span></td>
                                    <td><button class="detail-button" style="background-color: green;">Pay</button></td>
                                </tr>
                                <tr>
                                    <td>45611</td>
                                    <td>Jude Mark</td>
                                    <td>Rs. 51000</td>
                                    <td>Rs. 5100</td>
                                    <td>Rs 45900</td>
                                    <td>Aug 5, 2024</td>
                                    <td><span class="status-confirmed">Paid</span></td>
                                    <td><button class="detail-button" style="background-color: blue;">Paid</button></td>
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
                        <span class="value">Rs. 9500</span>
                    </div>
                    <div class="commission-item">
                        <span class="label">Balance To Be Paid:</span>
                        <span class="value">Rs. 39600</span>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
