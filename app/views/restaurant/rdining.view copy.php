<?php 
  include '../app/views/components/rnav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dining Reservation System</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #002D40;
            --primary-hover: #004D60;
            --background: #f8f9fa;
            --card-bg: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border-color: #e0e0e0;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-primary);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            margin-left: 265px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .controls {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            background-color: var(--border-color);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .date-navigation {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .current-date {
            font-size: 1.25rem;
            font-weight: 600;
            min-width: 200px;
            text-align: center;
        }

        .tables-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .table-card {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .table-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-card h3 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .table-info {
            display: grid;
            gap: 0.5rem;
        }

        .table-info-item {
            display: flex;
            justify-content: space-between;
            color: var(--text-secondary);
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .timeline-container {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--border-color);
            margin-top: 2rem;
            height: 600px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: var(--card-bg);
            color: var(--text-primary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .controls {
                flex-direction: column;
            }

            .date-navigation {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dining Reservation System</h1>
        </div>

        <div class="controls">
            <button class="btn btn-primary" id="addTableBtn">
                <span>+</span> Add Table
            </button>
            <button class="btn btn-primary" id="addReservationBtn">
                <span>+</span> Add Reservation
            </button>
        </div>

        <div class="date-navigation">
            <button class="btn btn-outline" id="prevDay">←</button>
            <div class="current-date" id="currentDate"></div>
            <button class="btn btn-outline" id="nextDay">→</button>
        </div>

        <div class="tables-grid" id="tablesGrid"></div>

        <div class="timeline-container">
            <div id="timeline"></div>
        </div>
    </div>

    <!-- Add Table Modal -->
    <div class="modal" id="tableModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Table</h2>
                <button class="close-modal" id="closeTableModal">×</button>
            </div>
            <form id="tableForm">
                <div class="form-group">
                    <label for="tableNumber">Table Number</label>
                    <input type="text" id="tableNumber" name="tableNumber" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input type="number" id="capacity" name="capacity" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label for="section">Section</label>
                    <select id="section" name="section" class="form-control" required>
                        <option value="">Select Section</option>
                        <option value="Main Dining">Main Dining</option>
                        <option value="Outdoor">Outdoor</option>
                        <option value="Private">Private</option>
                        <option value="Bar">Bar</option>
                        <option value="VIP">VIP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tableType">Table Type</label>
                    <select id="tableType" name="tableType" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="Regular">Regular</option>
                        <option value="High Top">High Top</option>
                        <option value="Booth">Booth</option>
                        <option value="Counter">Counter</option>
                        <option value="Private Room">Private Room</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="features">Features</label>
                    <textarea id="features" name="features" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price per Hour</label>
                    <input type="number" id="price" name="price" class="form-control" min="0" step="0.01" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" id="cancelTableBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Table</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Reservation Modal -->
    <div class="modal" id="reservationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Reservation</h2>
                <button class="close-modal" id="closeReservationModal">×</button>
            </div>
            <form id="reservationForm">
                <div class="form-group">
                    <label for="tableId">Select Table</label>
                    <select id="tableId" name="tableId" class="form-control" required></select>
                </div>
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" id="customerName" name="customerName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="people">Number of People</label>
                    <input type="number" id="people" name="people" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="startTime">Start Time</label>
                    <input type="time" id="startTime" name="startTime" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="endTime">End Time</label>
                    <input type="time" id="endTime" name="endTime" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" id="cancelReservationBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Reservation</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dummy data for tables
        const DUMMY_TABLES = [
            {
                id: '1',
                number: 'A1',
                capacity: 4,
                section: 'Main Dining',
                type: 'Regular',
                features: 'Window view, Power outlets',
                price: 50
            },
            {
                id: '2',
                number: 'A2',
                capacity: 6,
                section: 'Main Dining',
                type: 'Booth',
                features: 'Corner booth, USB charging',
                price: 75
            },
            {
                id: '3',
                number: 'B1',
                capacity: 2,
                section: 'Bar',
                type: 'High Top',
                features: 'Bar view',
                price: 30
            },
            {
                id: '4',
                number: 'P1',
                capacity: 8,
                section: 'Private',
                type: 'Private Room',
                features: 'Private TV, Sound system',
                price: 150
            },
            {
                id: '5',
                number: 'O1',
                capacity: 4,
                section: 'Outdoor',
                type: 'Regular',
                features: 'Garden view, Umbrella',
                price: 45
            }
        ];

        // Dummy data for reservations
        const DUMMY_RESERVATIONS = [
            {
                id: '1',
                tableId: '1',
                customerName: 'John Doe',
                people: 4,
                date: '2024-02-24',
                startTime: '12:00',
                endTime: '14:00',
                status: 'confirmed'
            },
            {
                id: '2',
                tableId: '2',
                customerName: 'Jane Smith',
                people: 6,
                date: '2024-02-24',
                startTime: '18:00',
                endTime: '20:00',
                status: 'confirmed'
            },
            {
                id: '3',
                tableId: '3',
                customerName: 'Mike Johnson',
                people: 2,
                date: '2024-02-24',
                startTime: '19:00',
                endTime: '21:00',
                status: 'confirmed'
            }
        ];

        // Initialize Google Charts
        google.charts.load('current', {'packages':['timeline']});
        let chart = null;
        let dataTable = null;
            // State management
        let tables = JSON.parse(localStorage.getItem('tables')) || DUMMY_TABLES;
        let reservations = JSON.parse(localStorage.getItem('reservations')) || DUMMY_RESERVATIONS;
        let currentDate = new Date();

        // DOM Elements
        const tableModal = document.getElementById('tableModal');
        const reservationModal = document.getElementById('reservationModal');
        const tableForm = document.getElementById('tableForm');
        const reservationForm = document.getElementById('reservationForm');
        const addTableBtn = document.getElementById('addTableBtn');
        const addReservationBtn = document.getElementById('addReservationBtn');
        const closeTableModal = document.getElementById('closeTableModal');
        const closeReservationModal = document.getElementById('closeReservationModal');
        const cancelTableBtn = document.getElementById('cancelTableBtn');
        const cancelReservationBtn = document.getElementById('cancelReservationBtn');
        const currentDateEl = document.getElementById('currentDate');
        const prevDayBtn = document.getElementById('prevDay');
        const nextDayBtn = document.getElementById('nextDay');
        const tablesGrid = document.getElementById('tablesGrid');

        // Event Listeners
        addTableBtn.addEventListener('click', () => {
            tableModal.style.display = 'block';
        });

        addReservationBtn.addEventListener('click', () => {
            populateTableSelect();
            reservationModal.style.display = 'block';
        });

        [closeTableModal, cancelTableBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                tableModal.style.display = 'none';
                tableForm.reset();
            });
        });

        [closeReservationModal, cancelReservationBtn].forEach(btn => {
            btn.addEventListener('click', () => {
                reservationModal.style.display = 'none';
                reservationForm.reset();
            });
        });

        prevDayBtn.addEventListener('click', () => {
            currentDate.setDate(currentDate.getDate() - 1);
            updateDateDisplay();
            drawTimeline();
        });

        nextDayBtn.addEventListener('click', () => {
            currentDate.setDate(currentDate.getDate() + 1);
            updateDateDisplay();
            drawTimeline();
        });

        tableForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const newTable = {
                id: Date.now().toString(),
                number: formData.get('tableNumber'),
                capacity: parseInt(formData.get('capacity')),
                section: formData.get('section'),
                type: formData.get('tableType'),
                features: formData.get('features'),
                price: parseFloat(formData.get('price'))
            };
            
            tables.push(newTable);
            localStorage.setItem('tables', JSON.stringify(tables));
            renderTables();
            tableModal.style.display = 'none';
            e.target.reset();
        });

        reservationForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const newReservation = {
                id: Date.now().toString(),
                tableId: formData.get('tableId'),
                customerName: formData.get('customerName'),
                people: parseInt(formData.get('people')),
                date: formData.get('date'),
                startTime: formData.get('startTime'),
                endTime: formData.get('endTime'),
                status: 'confirmed'
            };

            reservations.push(newReservation);
            localStorage.setItem('reservations', JSON.stringify(reservations));
            drawTimeline();
            reservationModal.style.display = 'none';
            e.target.reset();
        });

        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === tableModal) {
                tableModal.style.display = 'none';
                tableForm.reset();
            }
            if (e.target === reservationModal) {
                reservationModal.style.display = 'none';
                reservationForm.reset();
            }
        });

        // Update date display
        function updateDateDisplay() {
            currentDateEl.textContent = currentDate.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        // Populate table select in reservation form
        function populateTableSelect() {
            const tableSelect = document.getElementById('tableId');
            tableSelect.innerHTML = `
                <option value="">Select Table</option>
                ${tables.map(table => `
                    <option value="${table.id}">
                        Table ${table.number} (${table.capacity} people - ${table.section})
                    </option>
                `).join('')}
            `;
        }

        // Render tables
        function renderTables() {
            tablesGrid.innerHTML = tables.map(table => `
                <div class="table-card" data-table-id="${table.id}">
                    <h3>Table ${table.number}</h3>
                    <div class="table-info">
                        <div class="table-info-item">
                            <span>Capacity:</span>
                            <span>${table.capacity} people</span>
                        </div>
                        <div class="table-info-item">
                            <span>Section:</span>
                            <span>${table.section}</span>
                        </div>
                        <div class="table-info-item">
                            <span>Type:</span>
                            <span>${table.type}</span>
                        </div>
                        <div class="table-info-item">
                            <span>Price:</span>
                            <span>$${table.price}/hour</span>
                        </div>
                        ${table.features ? `
                            <div class="table-info-item">
                                <span>Features:</span>
                                <span>${table.features}</span>
                            </div>
                        ` : ''}
                    </div>
                    <div class="table-actions">
                        <button class="btn btn-outline btn-sm" onclick="editTable('${table.id}')">Edit</button>
                        <button class="btn btn-outline btn-sm" onclick="deleteTable('${table.id}')">Delete</button>
                    </div>
                </div>
            `).join('');
        }

        // Edit table
        function editTable(tableId) {
            const table = tables.find(t => t.id === tableId);
            if (!table) return;

            document.getElementById('tableNumber').value = table.number;
            document.getElementById('capacity').value = table.capacity;
            document.getElementById('section').value = table.section;
            document.getElementById('tableType').value = table.type;
            document.getElementById('features').value = table.features;
            document.getElementById('price').value = table.price;

            tableModal.style.display = 'block';
        }

        // Delete table
        function deleteTable(tableId) {
            if (confirm('Are you sure you want to delete this table?')) {
                tables = tables.filter(t => t.id !== tableId);
                localStorage.setItem('tables', JSON.stringify(tables));
                renderTables();
            }
        }

        // Draw timeline
        function initializeTimeline() {
        try {
            const container = document.getElementById('timeline');
            chart = new google.visualization.Timeline(container);
            dataTable = new google.visualization.DataTable();

            // Add columns
            dataTable.addColumn({ type: 'string', id: 'Table' });
            dataTable.addColumn({ type: 'string', id: 'Status' });
            dataTable.addColumn({ type: 'string', id: 'style', role: 'style' });
            dataTable.addColumn({ type: 'date', id: 'Start' });
            dataTable.addColumn({ type: 'date', id: 'End' });

            // Draw initial timeline
            drawTimeline();

            // Add window resize handler
            window.addEventListener('resize', debounce(drawTimeline, 250));
        } catch (error) {
            console.error('Error initializing timeline:', error);
        }
    }

    function drawTimeline() {
        if (!chart || !dataTable) return;

        try {
            // Clear existing rows
            dataTable.removeRows(0, dataTable.getNumberOfRows());

            const dateString = currentDate.toISOString().split('T')[0];
            const dayReservations = reservations.filter(r => r.date === dateString);

            // Add rows for each table (even without reservations)
            const timelineRows = [];
            
            // First, add all tables
            tables.forEach(table => {
                const tableReservations = dayReservations.filter(r => r.tableId === table.id);
                
                if (tableReservations.length === 0) {
                    // Add empty row for table with no reservations
                    timelineRows.push([
                        `Table ${table.number}`,
                        'Available',
                        '#e0e0e0',
                        new Date(dateString + 'T06:00'), // Start at 6 AM
                        new Date(dateString + 'T23:00')  // End at 11 PM
                    ]);
                } else {
                    // Add reservations for this table
                    tableReservations.forEach(reservation => {
                        timelineRows.push([
                            `Table ${table.number}`,
                            `${reservation.customerName} (${reservation.people} people)`,
                            '#002D40',
                            new Date(dateString + 'T' + reservation.startTime),
                            new Date(dateString + 'T' + reservation.endTime)
                        ]);
                    });
                }
            });

            // Add all rows to the dataTable
            dataTable.addRows(timelineRows);

            // Configure options
            const options = {
                timeline: {
                    showRowLabels: true,
                    showBarLabels: true,
                    rowLabelStyle: {
                        fontName: 'Inter',
                        fontSize: 14,
                        color: '#333'
                    },
                    barLabelStyle: {
                        fontName: 'Inter',
                        fontSize: 12
                    }
                },
                avoidOverlappingGridLines: true,
                height: tables.length * 50 + 50, // Dynamic height based on number of tables
                backgroundColor: '#ffffff',
                alternatingRowBackground: true,
                hAxis: {
                    format: 'HH:mm',
                    minValue: new Date(dateString + 'T06:00'),
                    maxValue: new Date(dateString + 'T23:00')
                }
            };

            // Draw the chart
            chart.draw(dataTable, options);

            // Add click handler for the chart
            google.visualization.events.addListener(chart, 'select', function() {
                const selection = chart.getSelection();
                if (selection.length > 0) {
                    const row = selection[0].row;
                    const tableInfo = dataTable.getValue(row, 0);
                    const reservationInfo = dataTable.getValue(row, 1);
                    if (reservationInfo !== 'Available') {
                        alert(`Reservation Details:\nTable: ${tableInfo}\n${reservationInfo}`);
                    }
                }
            });

        } catch (error) {
            console.error('Error drawing timeline:', error);
            const container = document.getElementById('timeline');
            container.innerHTML = '<p class="text-center text-red-500">Error loading timeline. Please try again.</p>';
        }
    }

    // Utility function for debouncing window resize
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initialize the timeline after Google Charts is loaded
    google.charts.setOnLoadCallback(() => {
        initializeTimeline();
        updateDateDisplay();
        renderTables();
    });

    // Update the date navigation handlers
    prevDayBtn.addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() - 1);
        updateDateDisplay();
        drawTimeline();
    });

    nextDayBtn.addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() + 1);
        updateDateDisplay();
        drawTimeline();
    });

    // Add validation to the reservation form
    reservationForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const startTime = formData.get('startTime');
        const endTime = formData.get('endTime');
        const date = formData.get('date');
        const tableId = formData.get('tableId');

        // Check for overlapping reservations
        const existingReservations = reservations.filter(r => 
            r.date === date && 
            r.tableId === tableId
        );

        const newStart = new Date(`${date}T${startTime}`);
        const newEnd = new Date(`${date}T${endTime}`);

        const hasOverlap = existingReservations.some(reservation => {
            const existingStart = new Date(`${reservation.date}T${reservation.startTime}`);
            const existingEnd = new Date(`${reservation.date}T${reservation.endTime}`);
            return (newStart < existingEnd && newEnd > existingStart);
        });

        if (hasOverlap) {
            alert('This table is already reserved during the selected time period.');
            return;
        }

        const newReservation = {
            id: Date.now().toString(),
            tableId: tableId,
            customerName: formData.get('customerName'),
            people: parseInt(formData.get('people')),
            date: date,
            startTime: startTime,
            endTime: endTime,
            status: 'confirmed'
        };

        reservations.push(newReservation);
        localStorage.setItem('reservations', JSON.stringify(reservations));
        drawTimeline();
        reservationModal.style.display = 'none';
        e.target.reset();
    });

    // Add some CSS for the timeline
    const style = document.createElement('style');
    style.textContent = `
        .google-visualization-tooltip {
            background-color: white !important;
            padding: 8px !important;
            border-radius: 4px !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
            border: 1px solid #e0e0e0 !important;
            font-family: 'Inter', sans-serif !important;
        }
        .google-visualization-tooltip-item-list {
            margin: 0 !important;
            padding: 0 !important;
        }
        .google-visualization-tooltip-item {
            margin: 0 !important;
            padding: 4px 0 !important;
            font-size: 12px !important;
            color: #333 !important;
        }
    `;
    document.head.appendChild(style);
             // Initialize
            google.charts.setOnLoadCallback(() => {
                updateDateDisplay();
                renderTables();
                drawTimeline();
            });
    </script>
</body>
</html>