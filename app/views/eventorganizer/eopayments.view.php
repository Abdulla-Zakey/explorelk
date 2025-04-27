<?php
    $title = "ExploreLK | EO - Payments";
    include '../app/views/components/eonavbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <style>
    :root {
        --primary-color: #002d40;
        --secondary-color: #005c7a;
        --accent-color: #00a8e8;
        --background-color: #f0f4f8;
        --text-color: #333;
        --card-background: #ffffff;
        --positive-color: #28a745;
        --negative-color: #dc3545;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Poppins', sans-serif;
        line-height: 1.6;
        color: var(--text-color);
        background-color: var(--background-color);
        min-height: 100vh;
        overflow-y: auto;
    }

    .container {
        margin-left: 300px;
        padding: 20px;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background-color: var(--primary-color);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 28px;
        color: #fff;
        font-weight: 600;
    }

    button {
        padding: 10px 20px;
        background-color: var(--secondary-color);
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #002d40;
    }

    .action-btn {
        padding: 8px 12px;
        font-size: 14px;
        margin-right: 5px;
    }

    .update-btn {
        background-color: var(--accent-color);
    }

    .update-btn:hover {
        background-color: #0086b3;
    }

    .delete-btn {
        background-color: var(--negative-color);
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .metric-card {
        background-color: var(--card-background);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .metric-card h3 {
        font-size: 16px;
        color: var(--secondary-color);
        margin-bottom: 10px;
        font-weight: 600;
    }

    .metric-value {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 5px;
        color: var(--primary-color);
    }

    .metric-change {
        font-size: 14px;
        font-weight: 600;
    }

    .metric-change.positive {
        color: var(--positive-color);
    }

    .metric-change.negative {
        color: var(--negative-color);
    }

    .charts-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
    }

    .chart-card {
        background-color: var(--card-background);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .chart-card h3 {
        font-size: 20px;
        margin-bottom: 15px;
        color: var(--primary-color);
        font-weight: 600;
    }

    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: var(--card-background);
        margin: 15% auto;
        padding: 30px;
        border-radius: 10px;
        width: 80%;
        max-width: 500px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close:hover,
    .close:focus {
        color: var(--primary-color);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: var(--secondary-color);
        font-weight: 600;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(0, 168, 232, 0.2);
    }

    .table-container {
        margin-top: 30px;
        background-color: var(--card-background);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table-container h2 {
        font-size: 24px;
        color: var(--primary-color);
        margin-bottom: 15px;
        font-weight: 600;
    }

    .bank-details-table {
        width: 100%;
        border-collapse: collapse;
    }

    .bank-details-table th,
    .bank-details-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .bank-details-table th {
        background-color: var(--primary-color);
        color: #fff;
        font-weight: 600;
    }

    .bank-details-table tr:hover {
        background-color: #f5f5f5;
    }

    .no-data {
        text-align: center;
        color: var(--text-color);
        font-style: italic;
    }

    @media (max-width: 768px) {
        .metrics-grid {
            grid-template-columns: 1fr 1fr;
        }

        .charts-container {
            grid-template-columns: 1fr;
        }

        .bank-details-table th,
        .bank-details-table td {
            padding: 8px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .metrics-grid {
            grid-template-columns: 1fr;
        }

        header {
            flex-direction: column;
            align-items: flex-start;
        }

        header button {
            margin-top: 10px;
        }

        h1 {
            font-size: 24px;
        }

        .metric-value {
            font-size: 24px;
        }

        .bank-details-table th,
        .bank-details-table td {
            font-size: 12px;
        }

        .action-btn {
            padding: 6px 10px;
            font-size: 12px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Finance Dashboard</h1>
            <button id="addBankDetailsBtn">Add Bank Details</button>
        </header>

        <!-- <div class="metrics-grid">
            <div class="metric-card">
                <h3>Total Earnings</h3>
                <p class="metric-value">Rs45,231.89</p>
            </div>
            <div class="metric-card">
                <h3>Events Organized</h3>
                <p class="metric-value">5</p>
            </div>
            <div class="metric-card">
                <h3>Average Event Price</h3>
                <p class="metric-value">Rs584.00</p>
            </div>
            <div class="metric-card">
                <h3>Current Event Earning</h3>
                <p class="metric-value">Rs25,000</p>
            </div>
        </div> -->

        <!-- <div class="charts-container">
            <div class="chart-card">
                <h3>Income Details</h3>
                <div class="chart-container">
                    <canvas id="incomeChart">Your browser does not support the canvas element.</canvas>
                </div>
            </div>
            <div class="chart-card">
                <h3>Earnings Analysis</h3>
                <div class="chart-container">
                    <canvas id="earningsChart">Your browser does not support the canvas element.</canvas>
                </div>
            </div>
        </div> -->

        <!-- Bank Details Table -->
        <div class="table-container">
            <h2>Bank Details</h2>
            <table class="bank-details-table">
                <thead>
                    <tr>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="bankDetailsTableBody">
                    <?php if (!empty($data['bankDetails'])): ?>
                        <?php foreach ($data['bankDetails'] as $bank): ?>
                            <tr data-id="<?php echo htmlspecialchars($bank->id); ?>">
                                <td><?php echo htmlspecialchars($bank->account_name); ?></td>
                                <td><?php echo htmlspecialchars($bank->account_number); ?></td>
                                <td><?php echo htmlspecialchars($bank->bank_name); ?></td>
                                <td>
                                    <button class="action-btn update-btn" onclick="openUpdateModal(<?php echo htmlspecialchars($bank->id); ?>, '<?php echo htmlspecialchars($bank->account_name); ?>', '<?php echo htmlspecialchars($bank->account_number); ?>', '<?php echo htmlspecialchars($bank->bank_name); ?>')">Update</button>
                                    <button class="action-btn delete-btn" onclick="deleteBankDetails(<?php echo htmlspecialchars($bank->id); ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="no-data">No bank details available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Bank Details Modal -->
    <div id="bankDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Add Bank Details</h2>
            <form id="bankDetailsForm">
                <div class="form-group">
                    <label for="accountName">Account Name</label>
                    <input type="text" id="accountName" required>
                </div>
                <div class="form-group">
                    <label for="accountNumber">Account Number</label>
                    <input type="text" id="accountNumber" required>
                </div>
                <div class="form-group">
                    <label for="bankName">Bank Name</label>
                    <input type="text" id="bankName" required>
                </div>
                <button type="submit">Save Bank Details</button>
            </form>
        </div>
    </div>

    <!-- Update Bank Details Modal -->
    <div id="updateBankDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Update Bank Details</h2>
            <form id="updateBankDetailsForm">
                <input type="hidden" id="updateBankId">
                <div class="form-group">
                    <label for="updateAccountName">Account Name</label>
                    <input type="text" id="updateAccountName" required>
                </div>
                <div class="form-group">
                    <label for="updateAccountNumber">Account Number</label>
                    <input type="text" id="updateAccountNumber" required>
                </div>
                <div class="form-group">
                    <label for="updateBankName">Bank Name</label>
                    <input type="text" id="updateBankName" required>
                </div>
                <button type="submit">Update Bank Details</button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Add Bank Details Modal
        const addModal = document.getElementById("bankDetailsModal");
        const addBtn = document.getElementById("addBankDetailsBtn");
        const addSpan = addModal.getElementsByClassName("close")[0];
        const addForm = document.getElementById("bankDetailsForm");

        // Update Bank Details Modal
        const updateModal = document.getElementById("updateBankDetailsModal");
        const updateSpan = updateModal.getElementsByClassName("close")[0];
        const updateForm = document.getElementById("updateBankDetailsForm");

        // Open Add Modal
        addBtn.onclick = () => {
            addModal.style.display = "block";
        };

        // Close Add Modal
        addSpan.onclick = () => {
            addModal.style.display = "none";
        };

        // Close Update Modal
        updateSpan.onclick = () => {
            updateModal.style.display = "none";
        };

        // Close modals when clicking outside
        window.onclick = (event) => {
            if (event.target == addModal) {
                addModal.style.display = "none";
            }
            if (event.target == updateModal) {
                updateModal.style.display = "none";
            }
        };

        // Handle Add Bank Details Form Submission
        addForm.onsubmit = async (e) => {
            e.preventDefault();

            const bankDetails = {
                accountName: document.getElementById("accountName").value,
                accountNumber: document.getElementById("accountNumber").value,
                bankName: document.getElementById("bankName").value
            };

            try {
                const response = await fetch('<?= ROOT ?>/Eventorganizer/Eopayments/saveBankDetails', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(bankDetails)
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    addModal.style.display = "none";
                    addForm.reset();
                    // Refresh the table
                    location.reload(); // Can be optimized later
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error("Error saving bank details:", error);
                alert("An error occurred while saving bank details.");
            }
        };

        // Open Update Modal and Populate Fields
        window.openUpdateModal = (id, accountName, accountNumber, bankName) => {
            document.getElementById("updateBankId").value = id;
            document.getElementById("updateAccountName").value = accountName;
            document.getElementById("updateAccountNumber").value = accountNumber;
            document.getElementById("updateBankName").value = bankName;
            updateModal.style.display = "block";
        };

        // Handle Update Bank Details Form Submission
        updateForm.onsubmit = async (e) => {
            e.preventDefault();

            const bankDetails = {
                id: document.getElementById("updateBankId").value,
                accountName: document.getElementById("updateAccountName").value,
                accountNumber: document.getElementById("updateAccountNumber").value,
                bankName: document.getElementById("updateBankName").value
            };

            try {
                const response = await fetch('<?= ROOT ?>/Eventorganizer/Eopayments/updateBankDetails', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(bankDetails)
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    updateModal.style.display = "none";
                    updateForm.reset();
                    // Refresh the table
                    location.reload(); // Can be optimized later
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error("Error updating bank details:", error);
                alert("An error occurred while updating bank details.");
            }
        };

        // Handle Delete Bank Details
        window.deleteBankDetails = async (id) => {
            if (!confirm("Are you sure you want to delete this bank detail?")) {
                return;
            }

            try {
                const response = await fetch('<?= ROOT ?>/Eventorganizer/Eopayments/deleteBankDetails', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                });

                const result = await response.json();

                if (result.success) {
                    alert(result.message);
                    // Remove the row from the table
                    const row = document.querySelector(`#bankDetailsTableBody tr[data-id="${id}"]`);
                    if (row) {
                        row.remove();
                    }
                    // Check if table is empty
                    const tableBody = document.getElementById("bankDetailsTableBody");
                    if (tableBody.children.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="4" class="no-data">No bank details available</td></tr>';
                    }
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.error("Error deleting bank details:", error);
                alert("An error occurred while deleting bank details.");
            }
        };

        // Chart functionality
        function createChart(canvasId, type, labels, data, label, backgroundColor, borderColor) {
            const ctx = document.getElementById(canvasId).getContext('2d');

            if (window.myCharts && window.myCharts[canvasId]) {
                window.myCharts[canvasId].destroy();
            }

            window.myCharts = window.myCharts || {};
            window.myCharts[canvasId] = new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        const incomeData = [12000, 19000, 15000, 22000, 18000, 25000];
        const earningsData = [3000, 4500, 3800, 5500, 4200, 6000];

        createChart('incomeChart', 'bar', months, incomeData, 'Income', '#002d40', 'rgba(0, 168, 232, 1)');
        createChart('earningsChart', 'line', months, earningsData, 'Earnings', 'rgba(0, 92, 122, 0.1)', 'rgb(0, 92, 122)');

        window.addEventListener('resize', () => {
            if (window.myCharts) {
                Object.values(window.myCharts).forEach(chart => chart.resize());
            }
        });
    });
    </script>
</body>

</html>