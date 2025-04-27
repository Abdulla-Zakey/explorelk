<?php
$title = 'ExploreLK | EO - Home';
include '../app/views/components/eonavbar.php';

// Check if organizer_id is set in session
if (!isset($_SESSION['organizer_id'])) {
    header('Location: /login');
    exit;
}

// Instantiate models
$eventModel = new Event();
$eventBookingModel = new EventBookingModel();
$ticketPurchasersModel = new EventTicketPurchasersModel();

// Get organizer ID from session
$organizerId = $_SESSION['organizer_id'];

// 1. Completed Events: Events with eventDate < today
$completedEvents = $eventModel->where([
    'organizer_Id' => $organizerId,
    'eventStatus' => 'approved',
    'eventDate<' => date('Y-m-d')
]);
$completedEventsCount = is_array($completedEvents) ? count($completedEvents) : 0;

// Debugging: Uncomment to inspect Completed Events query result
// var_dump($completedEvents); exit;

// 2. Events in Processing: Approved events with eventDate >= today
$eventsInProcessing = $eventModel->where([
    'organizer_Id' => $organizerId,
    'eventStatus' => 'approved',
    'eventDate>=' => date('Y-m-d')
]);
$eventsInProcessingCount = is_array($eventsInProcessing) ? count($eventsInProcessing) : 0;

// 3. Total Revenue: Sum of totalAmount from event_booking
$organizerEvents = $eventModel->where(['organizer_Id' => $organizerId]);
$totalRevenue = 0;

foreach ($organizerEvents as $event) {
    $bookings = $eventBookingModel->where(['event_Id' => $event->event_Id]);
    if (is_array($bookings)) {
        foreach ($bookings as $booking) {
            $totalRevenue += (float) $booking->totalAmount;
        }
    }
}

// Debugging: Check if events exist
// var_dump(array_column($organizerEvents, 'event_Id')); exit;

// 4. Chart Data: Monthly Ticket Sales (using EventTicketPurchasersModel)
$monthlySales = [];
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$year = '2024'; // Adjust to match your data (e.g., 2023, 2024)

foreach ($months as $index => $month) {
    $monthNum = sprintf("%02d", $index + 1);
    $startDate = "$year-$monthNum-01";
    $endDate = date('Y-m-d', strtotime("$startDate +1 month"));
    $ticketCount = 0;

    foreach ($organizerEvents as $event) {
        $bookings = $eventBookingModel->where(['event_Id' => $event->event_Id]);
        if (is_array($bookings)) {
            foreach ($bookings as $booking) {
                $purchasers = $ticketPurchasersModel->where([
                    'booking_Id' => $booking->booking_Id,
                    'created_at>=' => $startDate,
                    'created_at<' => $endDate
                ]);
                if (is_array($purchasers)) {
                    $ticketCount += count($purchasers);
                }
            }
        }
    }
    $monthlySales[] = [
        'month' => $month,
        'sales' => $ticketCount
    ];
}

// Debugging: Uncomment to inspect Monthly Ticket Sales data
// var_dump($monthlySales); exit;

// 5. Chart Data: Ticket Sales Progress (using EventTicketPurchasersModel)
$ticketSalesProgress = [];
$upcomingEvents = $eventModel->where([
    'organizer_Id' => $organizerId,
    'eventStatus' => 'approved',
    'eventDate>=' => date('Y-m-d')
], ['limit' => 5]);

foreach ($upcomingEvents as $event) {
    $bookings = $eventBookingModel->where(['event_Id' => $event->event_Id]);
    $sold = 0;
    if (is_array($bookings)) {
        foreach ($bookings as $booking) {
            $purchasers = $ticketPurchasersModel->where(['booking_Id' => $booking->booking_Id]);
            if (is_array($purchasers)) {
                $sold += count($purchasers);
            }
        }
    }
    $total = isset($event->ticketCount) ? (int) $event->ticketCount : 0;
    $ticketSalesProgress[] = [
        'name' => $event->eventName,
        'sold' => $sold,
        'total' => $total
    ];
}

// 6. Chart Data: Revenue by Event Type
$revenueByEventType = [];
$eventTypes = array_unique(array_column($organizerEvents, 'eventType'));

foreach ($eventTypes as $type) {
    $typeEvents = $eventModel->where([
        'organizer_Id' => $organizerId,
        'eventType' => $type
    ]);
    $typeRevenue = 0;
    foreach ($typeEvents as $event) {
        $bookings = $eventBookingModel->where(['event_Id' => $event->event_Id]);
        if (is_array($bookings)) {
            foreach ($bookings as $booking) {
                $typeRevenue += (float) $booking->totalAmount;
            }
        }
    }
    $revenueByEventType[] = [
        'type' => $type,
        'revenue' => $typeRevenue
    ];
}
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
            <button class="create-event-btn">Create Event</button>
        </a>
    </div>
    <div class="stats-container">
        <div class="stat-box">
            <h2>Completed Events</h2>
            <p id="completedEvents"><?= $completedEventsCount ?></p>
        </div>
        <div class="stat-box">
            <h2>Events in Processing</h2>
            <p id="eventsInProcessing"><?= $eventsInProcessingCount ?></p>
        </div>
        <div class="stat-box">
            <h2>Total Revenue</h2>
            <p id="totalRevenue">$<?= number_format($totalRevenue, 2) ?></p>
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
</div>

<script>
    // Use PHP-provided data for charts
    const dashboardData = {
        completedEvents: <?= $completedEventsCount ?>,
        eventsInProcessing: <?= $eventsInProcessingCount ?>,
        totalRevenue: <?= $totalRevenue ?>,
        monthlySales: <?= json_encode($monthlySales) ?>,
        ticketSalesProgress: <?= json_encode($ticketSalesProgress) ?>,
        revenueByEventType: <?= json_encode($revenueByEventType) ?>
    };

    let currentEventIndex = 0;

    document.addEventListener('DOMContentLoaded', function() {
        updateDashboard(dashboardData);
    });

    function updateDashboard(data) {
        createMonthlySalesChart(data.monthlySales);
        createTicketSalesProgressChart(data.ticketSalesProgress[currentEventIndex]);
        createRevenueByEventTypeChart(data.revenueByEventType);
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

    function changeEvent() {
        currentEventIndex = (currentEventIndex + 1) % dashboardData.ticketSalesProgress.length;
        createTicketSalesProgressChart(dashboardData.ticketSalesProgress[currentEventIndex]);
    }
</script>
</body>
</html>