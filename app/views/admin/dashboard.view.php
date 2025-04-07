<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ExploreLK Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/dashboard.css?v=1.0" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0" />
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="main-content">
            <div class="dashboard-header">
                <h2>Dashboard</h2>

                <div style="display: flex; gap: 20px">
                    <div class="user-profile">
                        <img src="<?= ROOT ?>/assets/images/admin/adminProfilePhotos/profile.png" alt="Admin profile" class="user-avatar" />
                        <div>Abdulla Zakey</div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- KPI Cards -->
                <div class="kpi-card">
                    <div class="kpi-title">BOOKINGS THIS MONTH</div>
                    <div class="kpi-value">156</div>
                    <div class="kpi-trend trend-up"><span>↑ 8%</span> vs last month</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-title">TOTAL REVENUE</div>
                    <div class="kpi-value">$23,892</div>
                    <div class="kpi-trend trend-up"><span>↑ 12%</span> vs last month</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-title">NEW SIGN-UPS</div>
                    <div class="kpi-value">78</div>
                    <div class="kpi-trend trend-up"><span>↑ 15%</span> vs last month</div>
                </div>

                <div class="chart-card">
                    <div class="card-header">
                        <div class="card-title">User Distribution</div>
                    </div>

                    <div class="chart-container">
                        <canvas id="donutChart" width="300" height="300"></canvas>
                    </div>

                    <!-- Upcoming Events Section -->
                    <div class="events-section">
                        <div class="section-header">
                            <div class="section-title">Upcoming Events & Ticket Sales</div>
                            <div class="view-all">View All Events →</div>
                        </div>

                        <!-- Event Card 1 -->
                        <div class="event-card">
                            <div class="event-image" style="background-image: url('<?= ROOT ?>/assets/images/events/eventThumbnailPics/magicShow.jpg')">
                                <div class="event-date-badge">Mar 5, 2025</div>
                            </div>
                            <div class="event-content">
                                <div class="event-organizer">
                                    <div class="organizer-icon">📅</div>
                                    Mountain Adventures
                                </div>
                                <div class="event-title">Spring Mountain Trek</div>

                                <div class="ticket-progress">
                                    <div class="progress-header">
                                        <div class="progress-label">Ticket Sales</div>
                                        <div class="progress-value">85%</div>
                                    </div>
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill high-sales"></div>
                                    </div>
                                </div>

                                <div class="event-footer">
                                    <div class="event-metric">
                                        <span class="metric-icon">🎟️</span>
                                        170/200 tickets
                                    </div>
                                    <div class="event-metric">
                                        <span class="metric-icon">💰</span>
                                        $8,500
                                    </div>
                                </div>

                                <div class="event-actions">
                                    <div class="action-button">View Details</div>
                                    <div class="action-button">Contact Organizer</div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Card 2 -->
                        <div class="event-card">
                            <div class="event-image" style="background-image: url('<?= ROOT ?>/assets/images/events/eventThumbnailPics/carnivalNew.jpg')">
                                <div class="event-date-badge">Mar 10, 2025</div>
                            </div>
                            <div class="event-content">
                                <div class="event-organizer">
                                    <div class="organizer-icon">📅</div>
                                    City Explorers
                                </div>
                                <div class="event-title">Historical Downtown Tour</div>

                                <div class="ticket-progress">
                                    <div class="progress-header">
                                        <div class="progress-label">Ticket Sales</div>
                                        <div class="progress-value">65%</div>
                                    </div>
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill medium-sales"></div>
                                    </div>
                                </div>

                                <div class="event-footer">
                                    <div class="event-metric">
                                        <span class="metric-icon">🎟️</span>
                                        78/120 tickets
                                    </div>
                                    <div class="event-metric">
                                        <span class="metric-icon">💰</span>
                                        $3,900
                                    </div>
                                </div>

                                <div class="event-actions">
                                    <div class="action-button">View Details</div>
                                    <div class="action-button">Contact Organizer</div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Card 3 -->
                        <div class="event-card">
                            <div class="event-image" style="background-image: url('<?= ROOT ?>/assets/images/events/eventThumbnailPics/horseRace.jpg')">
                                <div class="event-date-badge">Mar 15, 2025</div>
                            </div>
                            <div class="event-content">
                                <div class="event-organizer">
                                    <div class="organizer-icon">📅</div>
                                    Beach Getaways
                                </div>
                                <div class="event-title">Sunset Beach Party</div>

                                <div class="ticket-progress">
                                    <div class="progress-header">
                                        <div class="progress-label">Ticket Sales</div>
                                        <div class="progress-value">40%</div>
                                    </div>
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill low-sales"></div>
                                    </div>
                                </div>

                                <div class="event-footer">
                                    <div class="event-metric">
                                        <span class="metric-icon">🎟️</span>
                                        60/150 tickets
                                    </div>
                                    <div class="event-metric">
                                        <span class="metric-icon">💰</span>
                                        $4,200
                                    </div>
                                </div>

                                <div class="event-actions">
                                    <div class="action-button">View Details</div>
                                    <div class="action-button">Contact Organizer</div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Card 4 -->
                        <div class="event-card">
                            <div class="event-image" style="background-image: url('<?= ROOT ?>/assets/images/events/eventThumbnailPics/carnivalNew.jpg')">
                                <div class="event-date-badge">Mar 20, 2025</div>
                            </div>
                            <div class="event-content">
                                <div class="event-organizer">
                                    <div class="organizer-icon">📅</div>
                                    Food Tours Inc.
                                </div>
                                <div class="event-title">Culinary Experience Tour</div>

                                <div class="ticket-progress">
                                    <div class="progress-header">
                                        <div class="progress-label">Ticket Sales</div>
                                        <div class="progress-value">15%</div>
                                    </div>
                                    <div class="progress-bar-container">
                                        <div class="progress-bar-fill very-low-sales"></div>
                                    </div>
                                </div>

                                <div class="event-footer">
                                    <div class="event-metric">
                                        <span class="metric-icon">🎟️</span>
                                        12/80 tickets
                                    </div>
                                    <div class="event-metric">
                                        <span class="metric-icon">💰</span>
                                        $1,440
                                    </div>
                                </div>

                                <div class="event-actions">
                                    <div class="action-button">View Details</div>
                                    <div class="action-button">Contact Organizer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Status Table -->
                <div class="table-card">
                    <div class="card-header">
                        <div class="card-title">Recent Bookings</div>
                        <div>
                            <button>View All</button>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Tour</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#BK-2542</td>
                                <td>City Explorer</td>
                                <td>John Smith</td>
                                <td>Feb 24, 2025</td>
                                <td>
                                    <span class="status-badge status-confirmed">Confirmed</span>
                                </td>
                            </tr>
                            <tr>
                                <td>#BK-2541</td>
                                <td>Mountain Trek</td>
                                <td>Emily Johnson</td>
                                <td>Feb 23, 2025</td>
                                <td>
                                    <span class="status-badge status-pending">Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>#BK-2540</td>
                                <td>Beach Resort</td>
                                <td>Michael Brown</td>
                                <td>Feb 22, 2025</td>
                                <td>
                                    <span class="status-badge status-canceled">Canceled</span>
                                </td>
                            </tr>
                            <tr>
                                <td>#BK-2539</td>
                                <td>Historical Tour</td>
                                <td>Sarah Davis</td>
                                <td>Feb 22, 2025</td>
                                <td>
                                    <span class="status-badge status-confirmed">Confirmed</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Activity Feed -->
                <div class="activity-card">
                    <div class="card-header">
                        <div class="card-title">System Activity</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-booking">🎫</div>
                        <div class="activity-content">
                            <div class="activity-title">New booking created</div>
                            <div class="activity-text">
                                City Tour package booked by John Smith
                            </div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-user">👤</div>
                        <div class="activity-content">
                            <div class="activity-title">New guide registered</div>
                            <div class="activity-text">
                                Maria Lopez registered as a tour guide
                            </div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-alert">⚠️</div>
                        <div class="activity-content">
                            <div class="activity-title">Tour capacity alert</div>
                            <div class="activity-text">
                                Mountain Trek tour is at 90% capacity
                            </div>
                        </div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-icon icon-booking">🎫</div>
                        <div class="activity-content">
                            <div class="activity-title">Booking updated</div>
                            <div class="activity-text">
                                Emily Johnson rescheduled their booking
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Wait for DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Donut Chart for User Distribution
        const donutChartCtx = document
            .getElementById("donutChart")
            .getContext("2d");
        const donutChart = new Chart(donutChartCtx, {
            type: "doughnut",
            data: {
                labels: ["Travelers", "Tour Guides", "Event Organizers", "Hotels"],
                datasets: [{
                    data: [1054, 125, 67, 38],
                    backgroundColor: [
                        "#70e000", // Traveler color
                        "#4cc9f0", // Guide color
                        "#f9c74f", // Organizer color
                        "#4361ee", // Hotel color
                    ],
                    borderWidth: 0,
                    hoverOffset: 4,
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: "70%",
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            font: {
                                size: 12,
                            },
                        },
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || "";
                                const value = context.raw || 0;
                                const total = context.chart.data.datasets[0].data.reduce(
                                    (a, b) => a + b,
                                    0
                                );
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            },
                        },
                    },
                },
            },
        });
    });
    </script>
</body>

</html>