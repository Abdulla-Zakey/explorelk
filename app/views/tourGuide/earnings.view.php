<?php
    $bookings = $data['bookings'];
    $tourPackages = $data['tourPackages'];
    $travelers = $data['travelers'];
    $commissions = $data['commissions'];
    // show($bookings);
    
    // Calculate totals
    $totalEarnings = 0;
    $totalCommission = 0;
    $totalNet = 0;
    // show($totalEarnings);
    foreach($bookings as $booking) {
        $totalEarnings = $totalEarnings + $booking->total_price;
        // show($totalEarnings);
        
        // Find package data for commission calculation
        foreach($tourPackages as $tourPackage) {
            if ($tourPackage->package_id == $booking->package_id) {
                $packageCommission = $tourPackage->package_price * 0.15; // 15% commission
                $totalCommission += $packageCommission;
                $totalNet += ($tourPackage->package_price - $packageCommission);
                break;
            }
        }
    }

    $approvedCommissions = $data['approvedCommissions']; // theese are arrays
    $pendingCommissions = $data['pendingCommissions'];
    // show($approvedCommissions);

    $totalApprovedCommission = 0;
    $totalPendingCommission = 0;
    foreach ($approvedCommissions as $approvedCommission) {
        $totalApprovedCommission += $approvedCommission->amount;
    }
    
    foreach ($pendingCommissions as $pendingCommission) {
        $totalPendingCommission += $pendingCommission->amount;
    }
    $commissionToPay = $totalCommission - $totalApprovedCommission - $totalPendingCommission;
    // show($commissionToPay);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/earnings.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
    
    </style>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>
        <div class="main-container">
            <div class="page-header">
                <h1>Earnings</h1>
            </div>
            <div class="earnings-stats-grid">
                <div class="earnings-stat-card">
                    <h3>Total Earnings</h3>
                    <div class="value">Rs <?= $totalEarnings ?></div>
                </div>
                <!-- <div class="earnings-stat-card">
                    <h3>Current Month</h3>
                    <div class="value">Rs 45,200</div>
                </div> -->
                <div class="earnings-stat-card">
                    <h3>Pending Commission</h3>
                    <div class="value">Rs <?= $totalCommission ?></div>
                </div>
                <div class="earnings-stat-card">
                    <h3>Commission Rate</h3>
                    <div class="value">15%</div>
                </div>
            </div>


            <div class="earnings-card">
                <div class="earnings-tabs">
                    <div class="earnings-tab active" data-tab="earnings-history">Earnings History</div>
                    <div class="earnings-tab" data-tab="commission-payments">Commission Payments</div>
                </div>

                <?php if(empty($bookings)): ?>
                <p>No earnings or commissions to display. Create a tour package to begin earning.</p>
                <?php else: ?>
                <div class="earnings-tab-content active" id="earnings-history">


                    <table class="earnings-table">
                        <tr>
                            <th>Date</th>
                            <th>Tour Package</th>
                            <th>Traveler</th>
                            <th>Gross Amount</th>
                            <th>Commission</th>
                            <th>Net</th>
                        </tr>
                        <?php foreach($bookings as $booking): ?>
                        <?php 
                                $packageData = NULL;
                                foreach($tourPackages as $tourPackage) {
                                    if ($tourPackage->package_id == $booking->package_id) {
                                        $packageData[] = $tourPackage;
                                        break;
                                    }
                                }
                                // show($packageData);

                                $travelerData = NULL;
                                foreach($travelers as $traveler) {
                                    if($traveler->traveler_Id == $booking->traveler_Id) {
                                        $travelerData[] = $traveler;
                                        break;
                                    }
                                }
                                // show($travelerData);

                                $packageCommission = ($packageData['0']->package_price) * 15/100;
                                $net = $packageData['0']->package_price - $packageCommission;
                                // show($net);
                            ?>
                        <tr>
                            <td><?= $booking->booking_date ?></td>
                            <td><?= $packageData['0']->name ?></td>
                            <td><?= $travelerData['0']->fName . ' ' . $travelerData['0']->fName ?></td>
                            <td>Rs <?= $packageData['0']->package_price ?></td>
                            <td class="commission-negative">-Rs <?= $packageCommission ?> (15%)</td>
                            <td>Rs <?= $net ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="earnings-tab-content" id="commission-payments">
                    <div class="earnings-commission-payment">
                        <div class="earnings-payment-info">
                            <span class="earnings-payment-label">Outstanding Commission</span>
                            <span class="earnings-payment-amount">Rs <?= $commissionToPay ?></span>
                            <!-- <span class="earnings-payment-due">Due by: April 25, 2025</span> -->
                        </div>
                        <button class="earnings-btn earnings-btn-primary">Pay Now</button>
                    </div>

                    <div style="margin-top: 20px;">
                        <h3 style="margin-bottom: 10px; font-size: 16px;">Previous Payments</h3>
                        <table class="earnings-table">
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Reference Number</th>
                            </tr>
                            <?php foreach($commissions as $commission): ?>
                            <tr>
                                <td><?= $commission->payment_date ?></td>
                                <td>Rs <?= $commission->amount ?></td>
                                <td><span
                                        class="earnings-status earnings-status-<?= $commission->status ?>"><?= $commission->status ?></span>
                                </td>
                                <td><?= $commission->reference_number ?></td>
                            </tr>
                            <?php endforeach; ?>

                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Add this modal HTML code just before the closing </body> tag -->
    <div id="paymentModal" class="payment-modal">
        <div class="payment-modal-content">
            <span class="payment-modal-close">&times;</span>
            <h2>Submit Commission Payment</h2>

            <form id="commissionPaymentForm" method="post" action="<?= ROOT ?>/tourGuide/C_earnings/commissionPayment"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="payment_amount">Amount to Pay (Rs)</label>
                    <input type="text" id="payment_amount" name="amount" value="<?= $commissionToPay ?>">
                </div>

                <div class="form-group">
                    <label for="payment_reference">Payment Reference Number</label>
                    <input type="text" id="payment_reference" name="reference_number"
                        placeholder="Enter bank reference/transaction ID">
                </div>

                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <input type="date" id="payment_date" name="payment_date" value="">
                </div>

                <div class="form-group">
                    <label for="payment_receipt">Upload Payment Receipt (Click here)</label>
                    <input type="file" id="payment_receipt" name="payment_receipt"
                        accept="image/jpeg,image/png,application/pdf">
                    <small>Accepted formats: JPG, PNG, PDF (Max: 2MB)</small>
                </div>

                <div class="form-group">
                    <label for="payment_notes">Additional Notes (Optional)</label>
                    <textarea id="payment_notes" name="notes" rows="3"
                        placeholder="Any additional information about your payment"></textarea>
                </div>

                <div class="form-actions">
                    <button type="button"
                        class="earnings-btn earnings-btn-secondary payment-modal-cancel">Cancel</button>
                    <button type="submit" class="earnings-btn earnings-btn-primary">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabs = document.querySelectorAll('.earnings-tab');
        const tabContents = document.querySelectorAll('.earnings-tab-content');

        // Function to activate a specific tab
        function activateTab(tabId) {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Add active class to selected tab
            const selectedTab = document.querySelector(`.earnings-tab[data-tab="${tabId}"]`);
            if (selectedTab) {
                selectedTab.classList.add('active');
            }

            // Hide all tab contents
            tabContents.forEach(content => content.classList.remove('active'));

            // Show the corresponding tab content
            const tabContent = document.getElementById(tabId);
            if (tabContent) {
                tabContent.classList.add('active');
            }
        }

        // Check URL parameters for tab selection
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');

        if (tabParam) {
            // Activate the tab specified in the URL
            activateTab(tabParam);
        }

        // Tab click event listeners
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                activateTab(tabId);
            });
        });

        // Modal functionality
        const modal = document.getElementById('paymentModal');
        const payNowBtn = document.querySelector('.earnings-commission-payment .earnings-btn-primary');
        const closeBtn = document.querySelector('.payment-modal-close');
        const cancelBtn = document.querySelector('.payment-modal-cancel');

        // Open modal when "Pay Now" is clicked
        if (payNowBtn) {
            payNowBtn.addEventListener('click', function() {
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
            });
        }

        // Close modal when X is clicked
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            });
        }

        // Close modal when Cancel is clicked
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        });

        document.getElementById('payment_receipt').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'No file selected';
            // Create or update a label to show the filename
            let label = this.nextElementSibling.querySelector('.file-selected');
            if (!label) {
                label = document.createElement('div');
                label.className = 'file-selected';
                this.nextElementSibling.appendChild(label);
            }
            label.textContent = `Selected: ${fileName}`;
        });
    });
    </script>
</body>

</html>