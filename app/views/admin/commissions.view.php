<?php
    $commission_rates = $data['commission_rates'];
    $tourGuideCommissions = $data['tourGuideCommissions'];
    // show($tourGuideCommissions);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/commissions.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <title>ExploreLK</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
    .service-type-content {
        display: none;
        margin-top: 20px;
    }

    .service-type-content.active {
        display: block;
    }

    .commission-tabs {
        display: flex;
        margin-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .commission-tab {
        padding: 10px 20px;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        font-weight: 500;
    }

    .commission-tab.active {
        border-bottom: 2px solid #4A90E2;
        color: #4A90E2;
    }

    .commission-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .commission-card-header {
        padding: 15px 20px;
        font-size: 18px;
        font-weight: 600;
        border-bottom: 1px solid #e0e0e0;
    }

    .commission-card-body {
        padding: 20px;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background-color: #fff;
        border-radius: 8px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 20px;
    }

    .close {
        font-size: 24px;
        cursor: pointer;
    }

    .modal-body {
        padding: 20px;
    }

    .modal-footer {
        padding: 15px 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        border-top: 1px solid #e0e0e0;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
    }

    .form-input,
    .form-select,
    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea,
    select {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        display: inline-block;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }

    .btn-primary {
        background-color: #4A90E2;
        color: white;
    }

    .btn-secondary {
        background-color: #f2f2f2;
        color: #333;
    }

    .btn-success {
        background-color: #4CAF50;
        color: white;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    table th {
        font-weight: 600;
        background-color: #f9f9f9;
    }

    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .page-buttons {
        display: flex;
        gap: 5px;
    }

    .page-btn {
        padding: 6px 12px;
        border: 1px solid #ddd;
        background-color: #fff;
        cursor: pointer;
        border-radius: 4px;
    }

    .page-btn.active {
        background-color: #4A90E2;
        color: white;
        border-color: #4A90E2;
    }

    .page-info {
        font-size: 14px;
        color: #666;
    }
    </style>
</head>

<body>

    <div class="admin-container">

        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>
        <div class="main-content">
            <h1>Commission Management</h1>

            <div class="commission-tabs">
                <div class="commission-tab active" data-tab="commission">Commission Rates</div>
                <div class="commission-tab" data-tab="payments">Service Provider Payments</div>
            </div>

            <!-- Commission Rates Tab -->
            <div class="commission-tab-content active" id="commission-tab">
                <div class="commission-card">

                    <div class="commission-card-header"
                        style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p>Default Commission Rates by Service Type</p>
                        </div>
                        <div>
                            <button id="addCommissionBtn" class="btn">Add New Commission Rate</button>
                        </div>
                    </div>

                    <div class="commission-card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Commission Rate</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($commission_rates as $commission_rate): ?>
                                <tr>
                                    <td><?= $commission_rate->service_type; ?></td>
                                    <td><?= $commission_rate->commission_rate; ?>%</td>
                                    <td><?= $commission_rate->last_updated; ?></td>
                                    <td class="action-cell">
                                        <button class="btn btn-sm edit-btn"
                                            data-type="<?= strtolower($commission_rate->service_type); ?>">Edit</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Service Provider Payments Tab -->
            <div class="commission-tab-content" id="payments-tab">
                <h2 class="page-title">Service Provider Payments</h2>

                <div class="commission-tabs service-provider-tabs">
                    <div class="commission-tab active" data-tab="tour-guide">Tour Guides</div>
                    <div class="commission-tab" data-tab="hotel">Hotels</div>
                    <div class="commission-tab" data-tab="event-organizer">Event Organizers</div>
                    <div class="commission-tab" data-tab="restaurant">Restaurants</div>
                </div>

                <!-- Tour Guides Tab Content -->
                <div class="service-type-content active" id="tour-guide-content">
                    <div class="commission-card">
                        <div class="commission-card-header">Tour Guide Payments</div>
                        <?php if (empty($tourGuideCommissions)): ?>
                        <p style="padding: 20px;">No payments have been made by tour guides.</p>
                        <?php else: ?>
                        <div class="commission-card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Provider</th>
                                        <th>Payment Amount</th>
                                        <th>Payment Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tourGuideCommissions as $tourGuideCommission): ?>
                                    <tr>
                                        <td>Adventure Tours Inc.</td>
                                        <td>Rs. <?= $tourGuideCommission->amount ?></td>
                                        <td><?= $tourGuideCommission->payment_date ?></td>
                                        <td>
                                            <?php if (!empty($tourGuideCommission->receipt_path)): ?>
                                            <button class="btn btn-sm btn-primary view-receipt"
                                                data-receipt="<?= ROOT . '/' . $tourGuideCommission->receipt_path ?>">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <?php endif; ?>
                                            <button class="btn btn-sm btn-success"
                                                onclick="window.location.href='<?= ROOT ?>/admin/C_commissions/approve?user=tourGuide&commission_id=<?= $tourGuideCommission->commission_id ?>&current_tab=payments&service_tab=tour-guide'">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <!-- <tr>
                                        <td class="provider-name">Jungle Safari Experts</td>
                                        <td>5</td>
                                        <td>$2,100.00</td>
                                        <td>$315.00</td>
                                        <td>$1,785.00</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Jungle Safari Experts" data-amount="$1,785.00">Pay
                                                Now</button>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Hotels Tab Content -->
                <div class="service-type-content" id="hotel-content">
                    <div class="commission-card">
                        <div class="commission-card-header">Hotel Pending Payments</div>
                        <div class="commission-card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Provider Name</th>
                                        <th>Bookings</th>
                                        <th>Total Amount</th>
                                        <th>Commission</th>
                                        <th>Payable Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="provider-name">Luxury Resort Spa</td>
                                        <td>12</td>
                                        <td>$5,250.00</td>
                                        <td>$787.50</td>
                                        <td>$4,462.50</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Luxury Resort Spa" data-amount="$4,462.50">Pay
                                                Now</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="provider-name">Seaside Boutique Hotel</td>
                                        <td>7</td>
                                        <td>$3,850.00</td>
                                        <td>$577.50</td>
                                        <td>$3,272.50</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Seaside Boutique Hotel" data-amount="$3,272.50">Pay
                                                Now</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Event Organizers Tab Content -->
                <div class="service-type-content" id="event-organizer-content">
                    <div class="commission-card">
                        <div class="commission-card-header">Event Organizer Pending Payments</div>
                        <div class="commission-card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Provider Name</th>
                                        <th>Bookings</th>
                                        <th>Total Amount</th>
                                        <th>Commission</th>
                                        <th>Payable Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="provider-name">Festival Planners Ltd.</td>
                                        <td>4</td>
                                        <td>$6,800.00</td>
                                        <td>$1,020.00</td>
                                        <td>$5,780.00</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Festival Planners Ltd." data-amount="$5,780.00">Pay
                                                Now</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="provider-name">Cultural Events Co.</td>
                                        <td>3</td>
                                        <td>$4,200.00</td>
                                        <td>$630.00</td>
                                        <td>$3,570.00</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Cultural Events Co." data-amount="$3,570.00">Pay
                                                Now</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Restaurants Tab Content -->
                <div class="service-type-content" id="restaurant-content">
                    <div class="commission-card">
                        <div class="commission-card-header">Restaurant Pending Payments</div>
                        <div class="commission-card-body">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Provider Name</th>
                                        <th>Bookings</th>
                                        <th>Total Amount</th>
                                        <th>Commission</th>
                                        <th>Payable Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="provider-name">Seaside Dining Experience</td>
                                        <td>9</td>
                                        <td>$2,700.00</td>
                                        <td>$405.00</td>
                                        <td>$2,295.00</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Seaside Dining Experience" data-amount="$2,295.00">Pay
                                                Now</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="provider-name">Local Flavors Restaurant</td>
                                        <td>6</td>
                                        <td>$1,800.00</td>
                                        <td>$270.00</td>
                                        <td>$1,530.00</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm pay-now"
                                                data-provider="Local Flavors Restaurant" data-amount="$1,530.00">Pay
                                                Now</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for editing commission rates -->
            <div class="modal" id="editCommissionModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Edit Commission Rate</h3>
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="serviceType">Service Type</label>
                            <input type="text" id="serviceType" readonly>
                        </div>
                        <div class="form-group">
                            <label for="commissionRate">Commission Rate (%)</label>
                            <input type="number" id="commissionRate" min="0" max="100" step="0.5">
                        </div>
                        <div class="form-group">
                            <label for="effectiveDate">Effective Date</label>
                            <input type="date" id="effectiveDate">
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <input type="text" id="notes" placeholder="Reason for change">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" id="cancelEditBtn">Cancel</button>
                        <button class="btn btn-success" id="saveEditBtn">Save Changes</button>
                    </div>
                </div>
            </div>

            <!-- Payment Modal -->
            <div class="modal" id="paymentModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Process Payment</h3>
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Provider</label>
                            <input type="text" class="form-input" id="providerName" readonly>
                        </div>
                        <div class="form-group">
                            <label>Payment Amount</label>
                            <input type="text" class="form-input" id="paymentAmount" readonly>
                        </div>
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-select" id="paymentMethod">
                                <option value="">Select Payment Method</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="paypal">PayPal</option>
                                <option value="stripe">Stripe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Payment Date</label>
                            <input type="date" class="form-input" id="paymentDate">
                        </div>
                        <div class="form-group">
                            <label>Reference Number</label>
                            <input type="text" class="form-input" id="referenceNumber"
                                placeholder="Enter reference number">
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-input" id="paymentNotes" rows="3"
                                placeholder="Add payment notes"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" id="cancelPayment">Cancel</button>
                        <button class="btn btn-primary" id="processPayment">Process Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Receipt View Modal -->
    <div class="modal" id="receiptModal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h3>Payment Receipt</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body" style="text-align: center;">
                <div id="receiptContainer">
                    <!-- Receipt will be displayed here -->
                </div>
                <div style="margin-top: 20px;">
                    <button class="btn btn-primary" id="downloadReceiptBtn">Download Receipt</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="closeReceiptBtn">Close</button>
            </div>
        </div>
    </div>

    <script>
    // Main tab switching functionality (Commission Rates vs Service Provider Payments)
    document.querySelectorAll('.main-content > .commission-tabs .commission-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all main tabs
            document.querySelectorAll('.main-content > .commission-tabs .commission-tab').forEach(t => t
                .classList.remove('active'));

            // Add active class to clicked tab
            tab.classList.add('active');

            // Hide all main tab content
            document.querySelectorAll('.commission-tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // Show the selected main tab content
            const tabId = tab.getAttribute('data-tab');
            document.getElementById(tabId + '-tab').classList.add('active');
        });
    });

    // Service provider type tab switching functionality
    document.querySelectorAll('.service-provider-tabs .commission-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all service provider tabs
            document.querySelectorAll('.service-provider-tabs .commission-tab').forEach(t => t.classList
                .remove('active'));

            // Add active class to clicked tab
            tab.classList.add('active');

            // Hide all service type content
            document.querySelectorAll('.service-type-content').forEach(content => {
                content.classList.remove('active');
            });

            // Show the selected service type content
            const tabId = tab.getAttribute('data-tab');
            document.getElementById(tabId + '-content').classList.add('active');
        });
    });

    // Commission Modal functionality
    const editModal = document.getElementById('editCommissionModal');

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const serviceType = btn.getAttribute('data-type');
            document.getElementById('serviceType').value = serviceType ?
                serviceType.charAt(0).toUpperCase() + serviceType.slice(1) :
                'Selected Service';

            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            document.getElementById('effectiveDate').value = `${year}-${month}-${day}`;

            editModal.style.display = 'flex';
        });
    });

    document.querySelectorAll('.close, #cancelEditBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            editModal.style.display = 'none';
        });
    });

    document.getElementById('saveEditBtn').addEventListener('click', () => {
        alert('Commission rate updated successfully!');
        editModal.style.display = 'none';
    });

    document.getElementById('addCommissionBtn').addEventListener('click', () => {
        alert('This would open a form to add a new service type with commission rate.');
    });

    // Payment functionality
    const paymentModal = document.getElementById('paymentModal');
    const payNowButtons = document.querySelectorAll('.pay-now');

    // Modified event listeners for Pay Now buttons
    payNowButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Get the provider name and payment amount from data attributes
            const providerName = btn.getAttribute('data-provider');
            const paymentAmount = btn.getAttribute('data-amount');

            // Set the values in the payment modal
            document.getElementById('providerName').value = providerName;
            document.getElementById('paymentAmount').value = paymentAmount;

            // Set today's date as default
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            document.getElementById('paymentDate').value = `${year}-${month}-${day}`;

            // Show the payment modal
            paymentModal.style.display = 'flex';
        });
    });

    // Modified event listener for Cancel Payment button
    document.getElementById('cancelPayment').addEventListener('click', () => {
        paymentModal.style.display = 'none';
    });

    // Close button in payment modal
    document.querySelectorAll('#paymentModal .close').forEach(closeBtn => {
        closeBtn.addEventListener('click', () => {
            paymentModal.style.display = 'none';
        });
    });

    document.getElementById('processPayment').addEventListener('click', () => {
        if (!document.getElementById('paymentMethod').value) {
            alert('Please select a payment method.');
            return;
        }
        if (!document.getElementById('paymentDate').value) {
            alert('Please select a payment date.');
            return;
        }
        alert('Payment processed successfully!');
        paymentModal.style.display = 'none';
    });

    // Close modals when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
        if (event.target === paymentModal) {
            paymentModal.style.display = 'none';
        }
    });

    // Simple implementation to open receipt in new tab
    document.querySelectorAll('.view-receipt').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default behavior if it's a link
            const receiptUrl = btn.getAttribute('data-receipt');

            if (receiptUrl) {
                // Open the receipt in a new tab
                window.open(receiptUrl, '_blank');
            } else {
                alert('Receipt not found');
            }
        });
    });

    // At the end of your script, add this code to handle the tab activation on page load
document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const currentTab = urlParams.get('tab');
    const serviceTab = urlParams.get('service');

    // Activate the main tab if specified
    if (currentTab) {
        document.querySelectorAll('.main-content > .commission-tabs .commission-tab').forEach(tab => {
            tab.classList.remove('active');
            if (tab.getAttribute('data-tab') === currentTab) {
                tab.classList.add('active');
            }
        });

        document.querySelectorAll('.commission-tab-content').forEach(content => {
            content.classList.remove('active');
            if (content.id === currentTab + '-tab') {
                content.classList.add('active');
            }
        });
    }

    // Activate the service tab if specified
    if (serviceTab) {
        document.querySelectorAll('.service-provider-tabs .commission-tab').forEach(tab => {
            tab.classList.remove('active');
            if (tab.getAttribute('data-tab') === serviceTab) {
                tab.classList.add('active');
            }
        });

        document.querySelectorAll('.service-type-content').forEach(content => {
            content.classList.remove('active');
            if (content.id === serviceTab + '-content') {
                content.classList.add('active');
            }
        });
    }
});
    </script>
</body>

</html>