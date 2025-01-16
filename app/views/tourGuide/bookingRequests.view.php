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
                <h1>Booking Requests</h1>
            </div>

            <div class="widget">
                <div class="card">
                    <h3>15  </h3>
                    <h5>Total Bookings</h5>
                </div>
                
                <div class="card">
                    <h3>3</h3>
                    <h5>Confirmed</h5>
                </div>
                
                <div class="card">
                    <h3>5</h3>
                    <h5>Pending</h5>
                </div>
                
                <div class="card">
                    <h3>2</h3>
                    <h5>Upcoming</h5>
                </div>

                <div class="card">
                    <h3>3</h3>
                    <h5>Completed</h5>
                </div>
            </div>

            <div class="table-container">
                <!-- Filter Tabs -->
                <div class="tabs">
                    <button class="tab active">All</button>
                    <button class="tab">Pending</button>
                    <button class="tab">Confirmed</button>
                    <button class="tab">Canceled</button>
                </div>
            
                <!-- Booking List Table -->
                <div class="booking-list">
                    <table>
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Date &amp; Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>Jan 10, 2024</td>
                                <td><span class="status_pending">Pending</span></td>
                                <td>
                                    <a href="<?= ROOT?>/tourGuide/C_bookingDetails" class="action">View</a>,
                                    <a href="#" class="action confirm">Confirm</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jane Smith</td>
                                <td>Feb 5, 2024</td>
                                <td><span class="status_confirmed">Confirmed</span></td>
                                <td>
                                    <a href="bookingDetails.html" class="action">View</a>,
                                    <a href="#" class="action cancel">Cancel</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
