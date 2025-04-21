<?php
    $commission_rates = $data['commission_rates'];
    // show($commission_rates);
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
                                        <button class="btn btn-sm edit-btn" data-type="hotels">Edit</button>
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

                <div class="commission-card">
                    <div class="commission-card-header">Pending Payments</div>
                    <div class="commission-card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Provider Name</th>
                                    <th>Service Type</th>
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
                                    <td><span class="badge badge-primary">Hotel</span></td>
                                    <td>12</td>
                                    <td>$5,250.00</td>
                                    <td>$787.50</td>
                                    <td>$4,462.50</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm pay-now">Pay Now</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="provider-name">Adventure Tours Inc.</td>
                                    <td><span class="badge badge-primary">Tour Guide</span></td>
                                    <td>8</td>
                                    <td>$3,400.00</td>
                                    <td>$510.00</td>
                                    <td>$2,890.00</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm pay-now">Pay Now</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="pagination">
                            <div class="page-info">
                                Showing 1 to 2 of 26 providers
                            </div>
                            <div class="page-buttons">
                                <button class="page-btn">Previous</button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">Next</button>
                            </div>
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
                            <input type="text" class="form-input" id="providerName" value="Luxury Resort Spa" readonly>
                        </div>
                        <div class="form-group">
                            <label>Payment Amount</label>
                            <input type="text" class="form-input" id="paymentAmount" value="$4,462.50" readonly>
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

    <script>
    // Tab switching functionality
    document.querySelectorAll('.commission-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            document.querySelectorAll('.commission-tab').forEach(t => t.classList.remove('active'));

            // Add active class to clicked tab
            tab.classList.add('active');

            // Hide all tab content
            document.querySelectorAll('.commission-tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // Show the selected tab content
            const tabId = tab.getAttribute('data-tab');
            document.getElementById(tabId + '-tab').classList.add('active');
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
    const paySelectedBtn = document.getElementById('paySelected');
    const selectAllCheckbox = document.getElementById('selectAll');
    const providerCheckboxes = document.querySelectorAll('.provider-checkbox');

    // Modified event listeners for Pay Now buttons
    payNowButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            console.log('Pay Now button clicked'); // Debug message
            paymentModal.style.display = 'flex'; // Changed from classList.remove('hidden')
        });
    });

    paySelectedBtn.addEventListener('click', () => {
        const selected = Array.from(providerCheckboxes).some(cb => cb.checked);
        if (selected) {
            paymentModal.style.display = 'flex'; // Changed from classList.remove('hidden')
        } else {
            alert('Please select at least one provider.');
        }
    });

    selectAllCheckbox.addEventListener('change', () => {
        providerCheckboxes.forEach(cb => {
            cb.checked = selectAllCheckbox.checked;
        });
    });

    // Modified event listener for Cancel Payment button
    document.getElementById('cancelPayment').addEventListener('click', () => {
        paymentModal.style.display = 'none'; // Changed from classList.add('hidden')
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
        paymentModal.style.display = 'none'; // Changed from classList.add('hidden')
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
    </script>
</body>

</html>