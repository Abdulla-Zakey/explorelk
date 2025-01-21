<?php 
    include_once APPROOT.'/views/travelagent/nav.php';
    include_once APPROOT.'/views/travelagent/travelagenthead.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        main {
            position: absolute;
            top: 0;
            left: 250px;
            width: calc(100% - 250px);
        }

        .reports-container {
            margin-top: 200px;
            padding: 30px;
        }

        .graph-row {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }

        .graph-container {
            flex: 1;
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 400px;
        }

        .graph-title {
            font-size: 20px;
            color: #002D40;
            margin-bottom: 20px;
            font-weight: bold;
        }

        @media screen and (max-width: 1200px) {
            .graph-row {
                flex-direction: column;
            }
            .graph-container {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="reports-container">
            <div class="graph-row">
                <!-- Pie Chart -->
                <div class="graph-container">
                    <h2 class="graph-title">Vehicle Type Distribution</h2>
                    <canvas id="pieChart"></canvas>
                </div>
                
                <!-- Line Graph with Dots -->
                <div class="graph-container">
                    <h2 class="graph-title">Monthly Booking Trends</h2>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Motor Bicycle', 'Tuks', 'Cars', 'Vans'],
                datasets: [{
                    data: [30, 25, 25, 20],
                    backgroundColor: [
                        '#002D40',
                        '#004D66',
                        '#006B8F',
                        '#0089B3'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Line Chart with Dots
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Bookings',
                    data: [65, 59, 80, 81, 56, 55],
                    borderColor: '#002D40',
                    backgroundColor: '#002D40',
                    pointBackgroundColor: '#002D40',
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
