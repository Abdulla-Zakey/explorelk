<?php 
  $title = 'ExploreLK | EO - Home';
  include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eodashboard.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title><?= $title ?></title>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
</head>

<body>
<div class="dashboard">
        <div class="header">
            <h1>Event Organizer Dashboard</h1>
            <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
            <button class="create-event-btn" >Create Event</button>
            </a>
        </div>
        <div class="stats-container">
            <div class="stat-box">
                <h2>Total Events</h2>
                <p id="totalEvents">Loading...</p>
            </div>
            <div class="stat-box">
                <h2>Events in Processing</h2>
                <p id="eventsInProcessing">Loading...</p>
            </div>
            <div class="stat-box">
                <h2>Tickets Sold</h2>
                <p id="ticketsSold">Loading...</p>
            </div>
            <div class="stat-box">
                <h2>Total Revenue</h2>
                <p id="totalRevenue">Loading...</p>
            </div>
        </div>
        <div class="charts-container">
            <div class="chart-box">
                <h2>Monthly Ticket Sales</h2>
                <canvas id="monthlySalesChart"></canvas>
            </div>
            <div class="chart-box">
                <h2>Ticket Sales Progress</h2>
                <canvas id="ticketSalesProgressChart"></canvas>
                <button class="change-event-btn" onclick="changeEvent()">Change Event</button>
            </div>
            <div class="chart-box">
                <h2>Revenue by Event Type</h2>
                <canvas id="revenueByEventTypeChart"></canvas>
            </div>
        </div>
        <div class="chart-box">
            <h2>Upcoming Events</h2>
            <table id="upcomingEventsTable">
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Tickets Sold</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>


  <!-- <div class = "rightContainer">

    <div class="user-invite">
      <h1 >Welcome, Event Visionary!</h1>
    </div>

    <div class="event-create-outcontainer"> 
      <div class="event-create-container">
        <div class="event-create-img">
          <img src="<?php echo ROOT; ?>/assets/images/eo/pen-icon.png" alt="" class="round-img">
        </div>

        <div>
          <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
            <button class="create-event-btn" type="button">Create an Event</button>
          </a>
        </div>
    </div>

    <div class="event-creater-image">
        <img src="<?php echo ROOT; ?>/assets/images/eo/event-org-icon.svg" alt="event-org-icon">
    </div>



  </div> -->
  
  
  
  <!-- <div class="event-create-outcontainer"> 
    <div class="event-create-container" style = "margin-left: 175px; margin-top: 50px">
      <div class="event-create-img">
          <img src="<?php echo ROOT; ?>/assets/images/eo/pen-icon.png" alt="" class="round-img">
      </div>

      <div> -->
      <!--<button id="create-event-btn" class="create-event-btn">Create An Event</button>-->      
           <!-- <a href="<?= ROOT ?>/Eventorganizer/Eocreateevent">
            <button class="create-event-btn" type="button">Create An Event</button>
          </a>
        </div>
      </div>
      
      <div class="event-creater-image" style = "margin-top: 85px; margin-left: 100px;">
        <img src="<?php echo ROOT; ?>/assets/images/eo/event-org-icon.svg" alt="event-org-icon">
      </div>
  </div> -->
  
  <script>
    document.getElementById("create-event-btn").addEventListener("click", function() {
        console.log("Button clicked!");  // This will log in the console if the button is clicked
        window.location.href = "/ExploreLKWithMVC/eocreateevent";  // Redirect to the PHP page
    });
  </script>
  <script>
        // Simulated data
        const dashboardData = {
            totalEvents: 42,
            eventsInProcessing: 7,
            ticketsSold: 12845,
            totalRevenue: 572300,
            monthlySales: [
                { month: 'Jan', sales: 1200 },
                { month: 'Feb', sales: 1900 },
                { month: 'Mar', sales: 2400 },
                { month: 'Apr', sales: 1800 },
                { month: 'May', sales: 2800 },
                { month: 'Jun', sales: 2600 }
            ],
            ticketSalesProgress: [
                { name: 'Summer Music Festival', sold: 3500, total: 5000 },
                { name: 'Tech Conference 2023', sold: 1200, total: 2000 },
                { name: 'Food and Wine Expo', sold: 2000, total: 3000 },
                { name: 'Art Gallery Opening', sold: 300, total: 500 },
                { name: 'Sports Tournament', sold: 5000, total: 10000 }
            ],
            revenueByEventType: [
                { type: 'Concert', revenue: 250000 },
                { type: 'Conference', revenue: 180000 },
                { type: 'Festival', revenue: 120000 },
                { type: 'Workshop', revenue: 22300 }
            ],
            upcomingEvents: [
                { name: 'Summer Music Festival', date: '2023-07-15', ticketsSold: 3500, status: 'On Track' },
                { name: 'Tech Conference 2023', date: '2023-08-10', ticketsSold: 1200, status: 'Selling Fast' },
                { name: 'Food and Wine Expo', date: '2023-09-05', ticketsSold: 2000, status: 'On Track' },
                { name: 'Art Gallery Opening', date: '2023-07-22', ticketsSold: 300, status: 'Limited Tickets' },
                { name: 'Sports Tournament', date: '2023-08-20', ticketsSold: 5000, status: 'Almost Sold Out' }
            ]
        };

        let currentEventIndex = 0;

        document.addEventListener('DOMContentLoaded', function() {
            updateDashboard(dashboardData);
        });

        function updateDashboard(data) {
            document.getElementById('totalEvents').textContent = data.totalEvents;
            document.getElementById('eventsInProcessing').textContent = data.eventsInProcessing;
            document.getElementById('ticketsSold').textContent = data.ticketsSold.toLocaleString();
            document.getElementById('totalRevenue').textContent = '$' + data.totalRevenue.toLocaleString();

            createMonthlySalesChart(data.monthlySales);
            createTicketSalesProgressChart(data.ticketSalesProgress[currentEventIndex]);
            createRevenueByEventTypeChart(data.revenueByEventType);
            updateUpcomingEventsTable(data.upcomingEvents);
        }

        function createMonthlySalesChart(data) {
            const ctx = document.getElementById('monthlySalesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.month),
                    datasets: [{
                        label: 'Ticket Sales',
                        data: data.map(item => item.sales),
                        borderColor: '#002D40',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function createTicketSalesProgressChart(data) {
            const ctx = document.getElementById('ticketSalesProgressChart').getContext('2d');
            if (window.ticketSalesChart) {
                window.ticketSalesChart.destroy();
            }
            window.ticketSalesChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Sold', 'Remaining'],
                    datasets: [{
                        data: [data.sold, data.total - data.sold],
                        backgroundColor: [
                            '#002D40',
                            'rgba(189, 195, 199, 0.8)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: data.name
                        }
                    }
                }
            });
        }

        function createRevenueByEventTypeChart(data) {
            const ctx = document.getElementById('revenueByEventTypeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.type),
                    datasets: [{
                        label: 'Revenue',
                        data: data.map(item => item.revenue),
                        backgroundColor: '#002D40'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function updateUpcomingEventsTable(events) {
            const tableBody = document.querySelector('#upcomingEventsTable tbody');
            tableBody.innerHTML = '';

            events.forEach(event => {
                const row = tableBody.insertRow();
                row.insertCell(0).textContent = event.name;
                row.insertCell(1).textContent = new Date(event.date).toLocaleDateString();
                row.insertCell(2).textContent = event.ticketsSold.toLocaleString();
                row.insertCell(3).textContent = event.status;
            });
        }

        function createEvent() {
            alert('Create Event functionality to be implemented');
        }

        function changeEvent() {
            currentEventIndex = (currentEventIndex + 1) % dashboardData.ticketSalesProgress.length;
            createTicketSalesProgressChart(dashboardData.ticketSalesProgress[currentEventIndex]);
        }

        // Simulating real-time updates
        setInterval(() => {
            dashboardData.ticketsSold += Math.floor(Math.random() * 10);
            dashboardData.totalRevenue += Math.floor(Math.random() * 100);
            updateDashboard(dashboardData);
        }, 5000);
    </script>

</body>
</html>


