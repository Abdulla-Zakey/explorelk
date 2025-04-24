<?php 
  include '../app/views/components/rnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Payments Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?= CSS ?>/restaurant/rpaymentsdetails.css">

  
</head>
<body>
  <div class="flex flex-col min-h-screen">
    <main class="main">
      <!-- Summary Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Total Earnings</div>
          </div>
          <div class="card-content">
            <div class="text-2xl font-bold">$128,546.00</div>
            <p class="text-xs text-muted-foreground">Lifetime earnings from reservations</p>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">This Month</div>
          </div>
          <div class="card-content">
            <div class="text-2xl font-bold">$12,350.00</div>
            <p class="text-xs text-muted-foreground">+18.2% from last month</p>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Last Month</div>
          </div>
          <div class="card-content">
            <div class="text-2xl font-bold">$10,450.00</div>
            <p class="text-xs text-muted-foreground">+5.4% from previous month</p>
          </div>
        </div>
      </div>

      <!-- Tabs -->
      <div class="tabs">
        <div class="tabs-list">
          <div class="tab active" data-tab="overview">Overview</div>
          <div class="tab" data-tab="analytics">Analytics</div>
        </div>

        <!-- Overview Tab -->
        <div class="tab-content active" id="overview-tab">
          <!-- Filter Panel -->
          <div class="card mb-4">
            <div class="card-content p-4">
              <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                  <h3 class="text-lg font-medium">Filter Payments</h3>
                  <button class="button button-ghost button-sm" id="close-filter">
                    <i class="fas fa-times"></i>
                    <span class="sr-only">Close</span>
                  </button>
                </div>
                <div class="grid gap-4 md:grid-cols-3">
                  <div class="space-y-2">
                    <label class="form-label">Date Range</label>
                    <input type="date" class="input" value="2023-06-01">
                    <input type="date" class="input mt-2" value="2023-06-15">
                  </div>
                  <div class="space-y-2">
                    <label class="form-label">Payment Status</label>
                    <select class="input">
                      <option value="all">All Statuses</option>
                      <option value="paid">Paid</option>
                      <option value="pending">Pending</option>
                      <option value="failed">Failed</option>
                    </select>
                  </div>
                  <div class="space-y-2">
                    <label class="form-label">Refund Status</label>
                    <select class="input">
                      <option value="all">All Refund Statuses</option>
                      <option value="none">No Refund</option>
                      <option value="partial">Partial Refund</option>
                      <option value="full">Full Refund</option>
                    </select>
                  </div>
                </div>
                <div class="flex justify-end gap-2">
                  <button class="button button-outline">Reset</button>
                  <button class="button button-primary">Apply Filters</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Payments Table -->
          <div class="table-container">
            <table class="table" id="payments-table">
              <thead>
                <tr>
                  <th width="50">
                    <div class="checkbox-wrapper">
                      <input type="checkbox" class="checkbox" id="select-all">
                    </div>
                  </th>
                  <th>
                    <button class="table-sort-button" data-sort="customerName">
                      Customer
                      <i class="fas fa-sort table-sort-icon"></i>
                    </button>
                  </th>
                  <th class="hidden md:table-cell">Email</th>
                  <th class="hidden md:table-cell">
                    <button class="table-sort-button" data-sort="tableNumber">
                      Table
                      <i class="fas fa-sort table-sort-icon"></i>
                    </button>
                  </th>
                  <th>
                    <button class="table-sort-button" data-sort="reservationDate">
                      Date
                      <i class="fas fa-sort-down table-sort-icon"></i>
                    </button>
                  </th>
                  <th>
                    <button class="table-sort-button" data-sort="amount">
                      Amount
                      <i class="fas fa-sort table-sort-icon"></i>
                    </button>
                  </th>
                  <th>Status</th>
                  <th class="hidden lg:table-cell">Card</th>
                  <th class="hidden lg:table-cell">Transaction ID</th>
                  <th class="hidden md:table-cell">Refund</th>
                  <th class="text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Table rows will be populated by JavaScript -->
              </tbody>
            </table>
          </div>
        </div>

        <!-- Analytics Tab -->
        <div class="tab-content" id="analytics-tab">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Advanced Analytics</div>
              <div class="card-description">Detailed payment analytics will be displayed here</div>
            </div>
            <div class="card-content" style="height: 400px; display: flex; align-items: center; justify-content: center;">
              <p class="text-muted-foreground">Advanced analytics coming soon</p>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Refund Dialog -->
  <div class="dialog-overlay hidden" id="refund-dialog">
    <div class="dialog">
      <button class="dialog-close" id="close-refund-dialog">
        <i class="fas fa-times"></i>
      </button>
      <div class="dialog-header">
        <h2 class="dialog-title">Process Refund</h2>
        <p class="dialog-description" id="refund-description">Issue a refund for reservation</p>
      </div>
      <form id="refund-form">
        <div class="grid gap-4 py-4">
          <div class="grid grid-cols-2 gap-4 rounded bg-muted p-4" id="refund-payment-details">
            <!-- Payment details will be populated by JavaScript -->
          </div>

          <div class="space-y-2">
            <label class="form-label">Refund Type</label>
            <div class="radio-group">
              <div class="radio-item">
                <input type="radio" name="refund-type" id="full-refund" value="full" checked>
                <label for="full-refund" class="text-sm">Full Refund (<span id="full-refund-amount">$0.00</span>)</label>
              </div>
              <div class="radio-item">
                <input type="radio" name="refund-type" id="partial-refund" value="partial">
                <label for="partial-refund" class="text-sm">Partial Refund</label>
              </div>
            </div>
          </div>

          <div class="space-y-2 hidden" id="refund-amount-container">
            <label class="form-label" for="refund-amount">Refund Amount</label>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2">$</span>
              <input type="text" id="refund-amount" class="input pl-7" placeholder="0.00">
            </div>
            <p class="text-xs text-muted-foreground" id="max-refund-text">Maximum refund amount: $0.00</p>
          </div>

          <div class="space-y-2">
            <label class="form-label" for="refund-reason">Reason for Refund (Optional)</label>
            <textarea id="refund-reason" class="textarea" placeholder="Enter the reason for the refund"></textarea>
          </div>
        </div>
        <div class="dialog-footer flex-col">
          <div class="text-sm text-muted-foreground mb-2">
            <i class="fas fa-exclamation-circle mr-1"></i>
            This action cannot be undone. The customer will be notified.
          </div>
          <div class="flex w-full gap-2">
            <button type="button" class="button button-outline flex-1" id="cancel-refund">Cancel</button>
            <button type="submit" class="button button-destructive flex-1" id="process-refund">Process Refund</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Refund Success Dialog -->
  <div class="dialog-overlay hidden" id="refund-success-dialog">
    <div class="dialog">
      <div class="dialog-header">
        <div class="mx-auto my-4 flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
          <i class="fas fa-check-circle text-green-600 text-xl"></i>
        </div>
        <h2 class="dialog-title text-center text-xl">Refund Successful</h2>
        <p class="dialog-description text-center">
          The refund has been processed successfully. The customer will receive the refund within 5-7 business days.
        </p>
      </div>
      <div class="dialog-footer">
        <button class="button button-primary w-full" id="close-success-dialog">Close</button>
      </div>
    </div>
  </div>

  <!-- Refund Details Dialog -->
  <div class="dialog-overlay hidden" id="refund-details-dialog">
    <div class="dialog">
      <button class="dialog-close" id="close-refund-details-dialog">
        <i class="fas fa-times"></i>
      </button>
      <div class="dialog-header">
        <h2 class="dialog-title">Refund Details</h2>
        <p class="dialog-description" id="refund-details-description">Details for refund on reservation</p>
      </div>
      <div class="grid gap-4 py-4">
        <div class="flex justify-between items-center">
          <h3 class="text-lg font-medium">Refund Information</h3>
          <span class="badge badge-outline badge-refund-full" id="refund-status-badge">Full Refund</span>
        </div>

        <div class="grid grid-cols-2 gap-4" id="refund-details-info">
          <!-- Refund details will be populated by JavaScript -->
        </div>

        <hr class="border-t border-border">

        <div>
          <p class="text-sm font-medium text-muted-foreground">Refund Reason</p>
          <p class="mt-1" id="refund-details-reason">Customer requested cancellation due to change of plans</p>
        </div>

        <hr class="border-t border-border">

        <div class="rounded bg-muted p-4">
          <h4 class="font-medium mb-2">Original Reservation Details</h4>
          <div class="grid grid-cols-2 gap-4" id="refund-details-reservation">
            <!-- Reservation details will be populated by JavaScript -->
          </div>
        </div>

        <div class="bg-blue-50 rounded p-4">
          <div class="flex items-start">
            <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
            <div>
              <p class="text-sm font-medium text-blue-800">Refund Status</p>
              <p class="text-sm text-blue-700" id="refund-details-status">
                The refund has been processed and will be credited to the customer's original payment method.
                Estimated arrival: 5-7 business days.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="dialog-footer">
        <button class="button button-primary" id="close-details-dialog">Close</button>
      </div>
    </div>
  </div>

  <script>
    // Sample data for the table
    const payments = [
      {
        id: "INV-001",
        customerName: "Sarah Johnson",
        customerEmail: "sarah.j@example.com",
        tableNumber: 12,
        reservationDate: new Date(2023, 5, 15, 19, 30),
        amount: 85.00,
        status: "paid",
        cardLast4: "4242",
        cardType: "Visa",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4Iq",
        refundStatus: "none"
      },
      {
        id: "INV-002",
        customerName: "Michael Chen",
        customerEmail: "michael.c@example.com",
        tableNumber: 8,
        reservationDate: new Date(2023, 5, 14, 20, 0),
        amount: 120.50,
        status: "paid",
        cardLast4: "5555",
        cardType: "Mastercard",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4Ir",
        refundStatus: "none"
      },
      {
        id: "INV-003",
        customerName: "Emily Rodriguez",
        customerEmail: "emily.r@example.com",
        tableNumber: 15,
        reservationDate: new Date(2023, 5, 14, 18, 15),
        amount: 95.75,
        status: "pending",
        cardLast4: "3456",
        cardType: "Amex",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4Is",
        refundStatus: "none"
      },
      {
        id: "INV-004",
        customerName: "David Kim",
        customerEmail: "david.k@example.com",
        tableNumber: 4,
        reservationDate: new Date(2023, 5, 13, 19, 0),
        amount: 45.25,
        status: "paid",
        cardLast4: "9876",
        cardType: "Discover",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4It",
        refundStatus: "none"
      },
      {
        id: "INV-005",
        customerName: "Jessica Taylor",
        customerEmail: "jessica.t@example.com",
        tableNumber: 9,
        reservationDate: new Date(2023, 5, 12, 20, 30),
        amount: 75.00,
        status: "failed",
        cardLast4: "1234",
        cardType: "Visa",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4Iu",
        refundStatus: "none"
      },
      {
        id: "INV-006",
        customerName: "Robert Wilson",
        customerEmail: "robert.w@example.com",
        tableNumber: 6,
        reservationDate: new Date(2023, 5, 11, 18, 45),
        amount: 110.25,
        status: "paid",
        cardLast4: "4321",
        cardType: "Mastercard",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4Iv",
        refundStatus: "partial"
      },
      {
        id: "INV-007",
        customerName: "Amanda Lee",
        customerEmail: "amanda.l@example.com",
        tableNumber: 10,
        reservationDate: new Date(2023, 5, 10, 19, 15),
        amount: 65.50,
        status: "paid",
        cardLast4: "8765",
        cardType: "Visa",
        transactionId: "txn_1K2OnjHSaWXyvFpK5I3Xf4Iw",
        refundStatus: "full"
      },
    ];

    // Current state
    let currentSort = { column: 'reservationDate', direction: 'desc' };
    let selectedRows = [];
    let currentPayment = null;

    // DOM Elements
    const tableBody = document.querySelector('#payments-table tbody');
    const filterPanel = document.getElementById('filter-panel');
    const closeFilterButton = document.getElementById('close-filter');
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');
    const selectAllCheckbox = document.getElementById('select-all');

    // Refund Dialog Elements
    const refundDialog = document.getElementById('refund-dialog');
    const refundDescription = document.getElementById('refund-description');
    const refundPaymentDetails = document.getElementById('refund-payment-details');
    const closeRefundDialogButton = document.getElementById('close-refund-dialog');
    const cancelRefundButton = document.getElementById('cancel-refund');
    const fullRefundRadio = document.getElementById('full-refund');
    const partialRefundRadio = document.getElementById('partial-refund');
    const refundAmountContainer = document.getElementById('refund-amount-container');
    const refundAmountInput = document.getElementById('refund-amount');
    const fullRefundAmount = document.getElementById('full-refund-amount');
    const maxRefundText = document.getElementById('max-refund-text');
    const refundForm = document.getElementById('refund-form');
    const processRefundButton = document.getElementById('process-refund');

    // Refund Success Dialog Elements
    const refundSuccessDialog = document.getElementById('refund-success-dialog');
    const closeSuccessDialogButton = document.getElementById('close-success-dialog');

    // Refund Details Dialog Elements
    const refundDetailsDialog = document.getElementById('refund-details-dialog');
    const refundDetailsDescription = document.getElementById('refund-details-description');
    const refundStatusBadge = document.getElementById('refund-status-badge');
    const refundDetailsInfo = document.getElementById('refund-details-info');
    const refundDetailsReason = document.getElementById('refund-details-reason');
    const refundDetailsReservation = document.getElementById('refund-details-reservation');
    const refundDetailsStatus = document.getElementById('refund-details-status');
    const closeRefundDetailsDialogButton = document.getElementById('close-refund-details-dialog');
    const closeDetailsDialogButton = document.getElementById('close-details-dialog');

    // Format date
    function formatDate(date, includeTime = false) {
      const options = { year: 'numeric', month: 'short', day: 'numeric' };
      if (includeTime) {
        return new Date(date).toLocaleString('en-US', { ...options, hour: 'numeric', minute: 'numeric', hour12: true });
      }
      return new Date(date).toLocaleDateString('en-US', options);
    }

    // Format currency
    function formatCurrency(amount) {
      return '$' + parseFloat(amount).toFixed(2);
    }

    // Render status badge
    function renderStatusBadge(status) {
      let badgeClass = '';
      let icon = '';
      let text = '';

      switch (status) {
        case 'paid':
          badgeClass = 'badge-paid';
          icon = '<i class="fas fa-check-circle mr-1"></i>';
          text = 'Paid';
          break;
        case 'pending':
          badgeClass = 'badge-pending';
          icon = '<i class="fas fa-clock mr-1"></i>';
          text = 'Pending';
          break;
        case 'failed':
          badgeClass = 'badge-failed';
          icon = '<i class="fas fa-times-circle mr-1"></i>';
          text = 'Failed';
          break;
      }

      return `<span class="badge badge-outline ${badgeClass}">${icon}${text}</span>`;
    }

    // Render refund status
    function renderRefundStatus(status) {
      switch (status) {
        case 'full':
          return '<span class="badge badge-outline badge-refund-full">Full Refund</span>';
        case 'partial':
          return '<span class="badge badge-outline badge-refund-partial">Partial Refund</span>';
        case 'none':
        default:
          return '<span class="text-muted-foreground text-sm">None</span>';
      }
    }

    // Sort payments
    function sortPayments() {
      return [...payments].sort((a, b) => {
        if (currentSort.direction === 'asc') {
          return a[currentSort.column] > b[currentSort.column] ? 1 : -1;
        } else {
          return a[currentSort.column] < b[currentSort.column] ? 1 : -1;
        }
      });
    }

    // Render table
    function renderTable() {
      const sortedPayments = sortPayments();
      tableBody.innerHTML = '';

      sortedPayments.forEach(payment => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>
            <div class="checkbox-wrapper">
              <input type="checkbox" class="checkbox payment-checkbox" data-id="${payment.id}" ${selectedRows.includes(payment.id) ? 'checked' : ''}>
            </div>
          </td>
          <td class="font-medium">${payment.customerName}</td>
          <td class="hidden md:table-cell text-muted-foreground">${payment.customerEmail}</td>
          <td class="hidden md:table-cell">${payment.tableNumber}</td>
          <td>
            <div class="flex flex-col">
              <span>${formatDate(payment.reservationDate)}</span>
              <span class="text-xs text-muted-foreground">${new Date(payment.reservationDate).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })}</span>
            </div>
          </td>
          <td>${formatCurrency(payment.amount)}</td>
          <td>${renderStatusBadge(payment.status)}</td>
          <td class="hidden lg:table-cell">
            <div class="flex flex-col">
              <span>${payment.cardType}</span>
              <span class="text-xs text-muted-foreground">•••• ${payment.cardLast4}</span>
            </div>
          </td>
          <td class="hidden lg:table-cell">
            <span class="text-xs text-muted-foreground" title="${payment.transactionId}">
              ${payment.transactionId.substring(0, 12)}...
            </span>
          </td>
          <td class="hidden md:table-cell">${renderRefundStatus(payment.refundStatus)}</td>
          <td class="text-right">
            <div class="dropdown">
              <button class="button button-ghost button-icon dropdown-toggle">
                <i class="fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu">
                <div class="dropdown-label">Actions</div>
                <div class="dropdown-item">
                  <i class="fas fa-external-link-alt mr-2"></i>
                  View details
                </div>
                <div class="dropdown-item">
                  <i class="fas fa-download mr-2"></i>
                  Download receipt
                </div>
                <div class="dropdown-separator"></div>
                ${payment.status === 'paid' && payment.refundStatus === 'none' ? `
                  <div class="dropdown-item process-refund" data-id="${payment.id}">
                    <i class="fas fa-undo-alt mr-2 text-destructive"></i>
                    <span class="text-destructive">Process refund</span>
                  </div>
                ` : ''}
                ${payment.refundStatus !== 'none' ? `
                  <div class="dropdown-item view-refund-details" data-id="${payment.id}">
                    <i class="fas fa-info-circle mr-2"></i>
                    View refund details
                  </div>
                ` : ''}
                <div class="dropdown-item">
                  Send to customer
                </div>
              </div>
            </div>
          </td>
        `;
        tableBody.appendChild(row);
      });

      // Add event listeners to checkboxes
      document.querySelectorAll('.payment-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          const id = this.getAttribute('data-id');
          if (this.checked) {
            selectedRows.push(id);
          } else {
            selectedRows = selectedRows.filter(rowId => rowId !== id);
          }
          updateSelectAllCheckbox();
        });
      });

      // Add event listeners to dropdowns
      document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', function(e) {
          e.stopPropagation();
          const menu = this.nextElementSibling;
          document.querySelectorAll('.dropdown-menu.show').forEach(openMenu => {
            if (openMenu !== menu) {
              openMenu.classList.remove('show');
            }
          });
          menu.classList.toggle('show');
        });
      });

      // Add event listeners to refund buttons
      document.querySelectorAll('.process-refund').forEach(button => {
        button.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          openRefundDialog(id);
        });
      });

      // Add event listeners to view refund details buttons
      document.querySelectorAll('.view-refund-details').forEach(button => {
        button.addEventListener('click', function() {
          const id = this.getAttribute('data-id');
          openRefundDetailsDialog(id);
        });
      });
    }

    // Update select all checkbox state
    function updateSelectAllCheckbox() {
      selectAllCheckbox.checked = selectedRows.length > 0 && selectedRows.length === payments.length;
    }

    // Open refund dialog
    function openRefundDialog(id) {
      currentPayment = payments.find(p => p.id === id);
      if (!currentPayment) return;

      // Update dialog content
      refundDescription.textContent = `Issue a refund for reservation #${currentPayment.id} for ${currentPayment.customerName}`;
      refundPaymentDetails.innerHTML = `
        <div>
          <p class="text-sm font-medium text-muted-foreground">Customer</p>
          <p class="font-medium">${currentPayment.customerName}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Reservation Date</p>
          <p class="font-medium">${formatDate(currentPayment.reservationDate)}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Table</p>
          <p class="font-medium">#${currentPayment.tableNumber}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Original Amount</p>
          <p class="font-medium">${formatCurrency(currentPayment.amount)}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Payment Method</p>
          <p class="font-medium">${currentPayment.cardType} •••• ${currentPayment.cardLast4}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Transaction ID</p>
          <p class="text-xs font-medium">${currentPayment.transactionId.substring(0, 16)}...</p>
        </div>
      `;

      // Set refund amount
      fullRefundAmount.textContent = formatCurrency(currentPayment.amount);
      maxRefundText.textContent = `Maximum refund amount: ${formatCurrency(currentPayment.amount)}`;
      
      // Reset form
      refundForm.reset();
      fullRefundRadio.checked = true;
      refundAmountContainer.classList.add('hidden');
      processRefundButton.textContent = 'Process Full Refund';
      processRefundButton.classList.remove('button-primary');
      processRefundButton.classList.add('button-destructive');

      // Show dialog
      refundDialog.classList.remove('hidden');

      // Close any open dropdowns
      document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
        menu.classList.remove('show');
      });
    }

    // Open refund details dialog
    function openRefundDetailsDialog(id) {
      currentPayment = payments.find(p => p.id === id);
      if (!currentPayment) return;

      // Mock refund data - in a real app, this would come from your database
      const refundData = {
        refundId: "ref_" + Math.random().toString(36).substring(2, 10),
        refundDate: new Date(2023, 5, 12),
        refundAmount: currentPayment.refundStatus === "full" ? currentPayment.amount : currentPayment.amount * 0.5,
        refundReason: "Customer requested cancellation due to change of plans",
        refundedBy: "Admin User",
        refundMethod: currentPayment.cardType,
        refundStatus: currentPayment.refundStatus,
        estimatedArrival: "5-7 business days",
      };

      // Update dialog content
      refundDetailsDescription.textContent = `Details for refund on reservation #${currentPayment.id} for ${currentPayment.customerName}`;
      
      // Update refund status badge
      refundStatusBadge.textContent = refundData.refundStatus === "full" ? "Full Refund" : "Partial Refund";
      refundStatusBadge.className = `badge badge-outline ${refundData.refundStatus === "full" ? "badge-refund-full" : "badge-refund-partial"}`;

      // Update refund details
      refundDetailsInfo.innerHTML = `
        <div>
          <p class="text-sm font-medium text-muted-foreground">Refund ID</p>
          <p class="font-medium">${refundData.refundId}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Refund Date</p>
          <p class="font-medium">${formatDate(refundData.refundDate)}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Refund Amount</p>
          <p class="font-medium">${formatCurrency(refundData.refundAmount)}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Original Amount</p>
          <p class="font-medium">${formatCurrency(currentPayment.amount)}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Refund Method</p>
          <p class="font-medium">${refundData.refundMethod} •••• ${currentPayment.cardLast4}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Processed By</p>
          <p class="font-medium">${refundData.refundedBy}</p>
        </div>
      `;

      // Update refund reason
      refundDetailsReason.textContent = refundData.refundReason;

      // Update reservation details
      refundDetailsReservation.innerHTML = `
        <div>
          <p class="text-sm font-medium text-muted-foreground">Customer</p>
          <p class="font-medium">${currentPayment.customerName}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Email</p>
          <p class="font-medium">${currentPayment.customerEmail}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Reservation Date</p>
          <p class="font-medium">${formatDate(currentPayment.reservationDate)}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Table</p>
          <p class="font-medium">#${currentPayment.tableNumber}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-muted-foreground">Transaction ID</p>
          <p class="text-xs font-medium">${currentPayment.transactionId}</p>
        </div>
      `;

      // Update refund status text
      refundDetailsStatus.textContent = `The refund has been processed and will be credited to the customer's original payment method. Estimated arrival: ${refundData.estimatedArrival}.`;

      // Show dialog
      refundDetailsDialog.classList.remove('hidden');

      // Close any open dropdowns
      document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
        menu.classList.remove('show');
      });
    }

    // Initialize the page
    function init() {
      // Render table
      renderTable();

      // Add event listeners
      document.addEventListener('click', function(e) {
        // Close dropdowns when clicking outside
        if (!e.target.closest('.dropdown')) {
          document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
            menu.classList.remove('show');
          });
        }
      });

      // Close filter button
      closeFilterButton.addEventListener('click', function() {
        filterPanel.classList.add('hidden');
      });

      // Tab switching
      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          const tabName = this.getAttribute('data-tab');
          
          // Update active tab
          tabs.forEach(t => t.classList.remove('active'));
          this.classList.add('active');
          
          // Show active content
          tabContents.forEach(content => {
            content.classList.remove('active');
            if (content.id === `${tabName}-tab`) {
              content.classList.add('active');
            }
          });
        });
      });

      // Table sorting
      document.querySelectorAll('.table-sort-button').forEach(button => {
        button.addEventListener('click', function() {
          const column = this.getAttribute('data-sort');
          
          if (currentSort.column === column) {
            currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
          } else {
            currentSort.column = column;
            currentSort.direction = 'asc';
          }
          
          // Update sort icons
          document.querySelectorAll('.table-sort-icon').forEach(icon => {
            icon.className = 'fas fa-sort table-sort-icon';
          });
          
          const icon = this.querySelector('.table-sort-icon');
          icon.className = `fas fa-sort-${currentSort.direction === 'asc' ? 'up' : 'down'} table-sort-icon`;
          
          renderTable();
        });
      });

      // Select all checkbox
      selectAllCheckbox.addEventListener('change', function() {
        if (this.checked) {
          selectedRows = payments.map(p => p.id);
        } else {
          selectedRows = [];
        }
        renderTable();
      });

      // Refund type radio buttons
      fullRefundRadio.addEventListener('change', function() {
        if (this.checked) {
          refundAmountContainer.classList.add('hidden');
          processRefundButton.textContent = 'Process Full Refund';
        }
      });

      partialRefundRadio.addEventListener('change', function() {
        if (this.checked) {
          refundAmountContainer.classList.remove('hidden');
          processRefundButton.textContent = 'Process Partial Refund';
        }
      });

      // Refund amount input validation
      refundAmountInput.addEventListener('input', function() {
        const value = this.value;
        // Only allow numbers and a single decimal point
        if (/^\d*\.?\d{0,2}$/.test(value)) {
          const amount = parseFloat(value || '0');
          if (amount > currentPayment.amount) {
            this.value = currentPayment.amount.toFixed(2);
          }
        } else {
          this.value = this.value.slice(0, -1);
        }
      });

      // Close refund dialog
      closeRefundDialogButton.addEventListener('click', function() {
        refundDialog.classList.add('hidden');
      });

      // Cancel refund button
      cancelRefundButton.addEventListener('click', function() {
        refundDialog.classList.add('hidden');
      });

      // Process refund form
      refundForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable button and show processing state
        processRefundButton.textContent = 'Processing...';
        processRefundButton.disabled = true;
        
        // Simulate API call with timeout
        setTimeout(function() {
          // Hide refund dialog
          refundDialog.classList.add('hidden');
          
          // Show success dialog
          refundSuccessDialog.classList.remove('hidden');
          
          // Update payment in our data (in a real app, this would be done via API)
          const paymentIndex = payments.findIndex(p => p.id === currentPayment.id);
          if (paymentIndex !== -1) {
            payments[paymentIndex].refundStatus = fullRefundRadio.checked ? 'full' : 'partial';
          }
          
          // Re-render table to show updated status
          renderTable();
          
          // Reset button state
          processRefundButton.disabled = false;
        }, 1500);
      });

      // Close success dialog
      closeSuccessDialogButton.addEventListener('click', function() {
        refundSuccessDialog.classList.add('hidden');
      });

      // Close refund details dialog
      closeRefundDetailsDialogButton.addEventListener('click', function() {
        refundDetailsDialog.classList.add('hidden');
      });

      // Close details dialog button
      closeDetailsDialogButton.addEventListener('click', function() {
        refundDetailsDialog.classList.add('hidden');
      });
    }

    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', init);
  </script>
</body>
</html>