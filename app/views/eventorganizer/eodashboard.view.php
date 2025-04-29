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
    if (is_array($bookings) && count($bookings) > 0) {
        foreach ($bookings as $booking) {
            $totalRevenue += (float) $booking->totalAmount;
        }
    }
}

// 4. Table Data: Pending Events Counts
$pendingEventsTable = [];
$pendingEventsData = $eventModel->where([
    'organizer_Id' => $organizerId,
    'eventStatus' => 'pending'
]);

// Collect event names and total count
$pendingCount = is_array($pendingEventsData) ? count($pendingEventsData) : 0;
$pendingEventsTable = [
    'count' => $pendingCount,
    'events' => []
];

if (is_array($pendingEventsData) && count($pendingEventsData) > 0) {
    foreach ($pendingEventsData as $event) {
        $pendingEventsTable['events'][] = [
            'name' => $event->eventName ?? 'Unnamed Event'
        ];
    }
}

// 5. Chart Data: Pending Events (Pie Chart)
$pendingEvents = [
    'count' => $pendingCount,
    'byType' => []
];

// Group by eventType for pie chart
if (is_array($pendingEventsData) && count($pendingEventsData) > 0) {
    $eventTypes = array_unique(array_column($pendingEventsData, 'eventType'));
    foreach ($eventTypes as $type) {
        $typeCount = count(array_filter($pendingEventsData, function($event) use ($type) {
            return $event->eventType === $type;
        }));
        $pendingEvents['byType'][] = [
            'type' => $type,
            'count' => $typeCount
        ];
    }
}

// Debugging: Inspect pendingEvents and pendingEventsTable
// var_dump($pendingEventsTable, $pendingEvents); exit;

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
        if (is_array($bookings) && count($bookings) > 0) {
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
    <style>
        .pending-events-table {
            width: 100%;
            max-width: 400px;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: 'Poppins', sans-serif;
        }
        .pending-events-table th, .pending-events-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .pending-events-table th {
            background-color: #002D40;
            color: white;
        }
        .pending-events-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .pending-events-table tr.total {
            font-weight: bold;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
        }
    </style>
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
            <p id="totalRevenue">Rs<?= number_format($totalRevenue, 2) ?></p>
        </div>
    </div>
    <div class="charts-container">
        <div class="chart-box">
            <h2>Pending Events Counts</h2>
            <?php if ($pendingEventsTable['count'] > 0): ?>
                <table class="pending-events-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingEventsTable['events'] as $event): ?>
                            <tr>
                                <td><?= htmlspecialchars($event['name']) ?></td>
                                <td>Pending</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="total">
                            <td>Total</td>
                            <td><?= $pendingEventsTable['count'] ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">No pending events</p>
            <?php endif; ?>
        </div>
        <div class="chart-box">
            <h2>Pending Events</h2>
            <canvas id="pendingEventsChart"></canvas>
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
        pendingEvents: <?= json_encode($pendingEvents) ?>,
        revenueByEventType: <?= json_encode($revenueByEventType) ?>
    };

    document.addEventListener('DOMContentLoaded', function() {
        updateDashboard(dashboardData);
    });

    function updateDashboard(data) {
        createPendingEventsChart(data.pendingEvents);
        createRevenueByEventTypeChart(data.revenueByEventType);
    }

    function createPendingEventsChart(data) {
        const ctx = document.getElementById('pendingEventsChart').getContext('2d');
        if (!data || data.count === 0) {
            ctx.canvas.parentNode.innerHTML = '<p>No pending events</p>';
            return;
        }

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: data.byType.length > 0 ? data.byType.map(item => item.type) : ['Pending Events'],
                datasets: [{
                    label: 'Number of Pending Events',
                    data: data.byType.length > 0 ? data.byType.map(item => item.count) : [data.count],
                    backgroundColor: [
                        '#002D40', // Dark blue
                        '#005B7F', // Medium blue
                        '#0088B3', // Light blue
                        '#4DA8D9', // Sky blue
                        '#99C7E6'  // Pale blue
                    ],
                    borderColor: '#FFFFFF',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: 'Pending Events by Type' }
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
                scales: { y: { beginAtZero: true } }
            }
        });
    }
</script>
</body>
</html>