<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dining Reservation System</title>
    <!-- Load Google Charts Library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        #nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            max-width: 500px;
        }

        .nav-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #002D40;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .nav-button:hover {
            background-color: #004D60;
        }

        #current-date {
            font-size: 18px;
            font-weight: bold;
        }

        #reservation_chart {
            margin: 20px auto;
            max-width: 90%;
            height: 1000px;
        }
    </style>
    <script type="text/javascript">
        // Load the Google Charts package for Timeline charts
        google.charts.load('current', { packages: ['timeline'] });

        // Base booking data
        const baseBookings = [
            ['Table 1', 'Alice: 4 People', new Date(2024, 10, 22, 12, 0), new Date(2024, 10, 22, 13, 30)],
            ['Table 1', 'Mark: 3 People', new Date(2024, 10, 22, 14, 0), new Date(2024, 10, 22, 16, 0)],
            ['Table 2', 'John: 2 People', new Date(2024, 10, 22, 11, 0), new Date(2024, 10, 22, 12, 30)],
            ['Table 2', 'Sophia: 5 People', new Date(2024, 10, 22, 15, 0), new Date(2024, 10, 22, 16, 30)],
            ['Table 3', 'Emma: 6 People', new Date(2024, 10, 22, 10, 0), new Date(2024, 10, 22, 12, 0)],
            ['Table 3', 'Chris: 4 People', new Date(2024, 10, 22, 13, 0), new Date(2024, 10, 22, 15, 30)],
            ['Table 4', 'Liam: 3 People', new Date(2024, 10, 22, 17, 0), new Date(2024, 10, 22, 18, 30)],
            ['Table 5', 'Noah: 2 People', new Date(2024, 10, 22, 19, 0), new Date(2024, 10, 22, 20, 30)],
            ['Table 6', 'Olivia: 5 People', new Date(2024, 10, 22, 9, 0), new Date(2024, 10, 22, 10, 30)],
            ['Table 7', 'David: 6 People', new Date(2024, 10, 22, 14, 0), new Date(2024, 10, 22, 15, 30)],
            ['Table 8', 'Sophia: 8 People', new Date(2024, 10, 22, 21, 0), new Date(2024, 10, 22, 23, 0)],
            ['Table 9', 'Chris: 3 People', new Date(2024, 10, 22, 12, 30), new Date(2024, 10, 22, 13, 30)],
            ['Table 10', 'Sophia: 4 People', new Date(2024, 10, 22, 18, 0), new Date(2024, 10, 22, 19, 30)]
        ];

        // Generate bookings for the next 7 days
        const bookingsData = {};
        const startDate = new Date(2024, 10, 22);
        for (let i = 0; i < 7; i++) {
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);
            const dateString = date.toISOString().split('T')[0];
            bookingsData[dateString] = baseBookings.map(booking => {
                const newStart = new Date(booking[2]);
                const newEnd = new Date(booking[3]);
                newStart.setDate(date.getDate());
                newEnd.setDate(date.getDate());
                return [booking[0], booking[1], newStart, newEnd];
            });
        }

        // Current selected date
        let currentDate = '2024-11-22';

        // Function to draw the chart for a specific date
        function drawChart(date) {
            const container = document.getElementById('reservation_chart');
            const chart = new google.visualization.Timeline(container);
            const dataTable = new google.visualization.DataTable();

            // Define columns for the Timeline chart
            dataTable.addColumn({ type: 'string', id: 'Table' });
            dataTable.addColumn({ type: 'string', id: 'Reservation' });
            dataTable.addColumn({ type: 'date', id: 'Start' });
            dataTable.addColumn({ type: 'date', id: 'End' });

            // Add rows for the selected date
            if (bookingsData[date]) {
                dataTable.addRows(bookingsData[date]);
            }

            // Define chart options
            const options = {
                timeline: {
                    groupByRowLabel: true,
                    rowLabelStyle: { fontSize: 14 },
                    barLabelStyle: { fontSize: 12 }
                },
                hAxis: {
                    minValue: new Date(date + 'T00:00'),
                    maxValue: new Date(date + 'T23:59'),
                    format: 'HH:mm'
                },
                height: 1000 // Adjust height to fit all tables
            };

            // Draw the chart
            chart.draw(dataTable, options);

            // Update current date display
            document.getElementById('current-date').textContent = `Bookings for ${new Date(date).toDateString()}`;
        }

        // Navigate to previous or next day
        function changeDate(direction) {
            const current = new Date(currentDate);
            current.setDate(current.getDate() + direction);
            const newDate = current.toISOString().split('T')[0];

            // Ensure the new date is within the next 7 days
            if (bookingsData[newDate]) {
                currentDate = newDate;
                drawChart(currentDate);
            }
        }

        // Initialize the chart with the default date
        google.charts.setOnLoadCallback(() => drawChart(currentDate));
    </script>
</head>
<body>
    <h1>Dining Reservation Schedule</h1>
    <div id="nav-container">
        <button class="nav-button" onclick="changeDate(-1)">←</button>
        <div id="current-date">Bookings for 2024-11-22</div>
        <button class="nav-button" onclick="changeDate(1)">→</button>
    </div>
    <div id="reservation_chart"></div>
</body>
</html>
