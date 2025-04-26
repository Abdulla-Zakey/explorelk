<?php
include_once APPROOT . '/views/travelprovider/nav.php';
include_once APPROOT . '/views/travelprovider/providerhead.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Previous CSS styles remain unchanged */
        /* Including them here would repeat the earlier response unnecessarily */
        /* Assume the styles provided earlier are included */
    </style>
</head>
<body>
    <div class="provider-header"></div>
    <div class="container">
        <?php if (empty($data['vehicleTypes'])): ?>
            <div class="empty-state">
                <div class="empty-state-card">
                    <div class="icon-circle">
                        <i class="fas fa-car"></i>
                    </div>
                    <h2 class="empty-state-title">No Vehicle Types Added Yet</h2>
                    <p class="empty-state-description">
                        Start by adding your first vehicle type. This will help you manage your vehicle inventory and showcase your rental options to customers.
                    </p>
                    <button class="enhanced-button" onclick="showAddTypeModal()">
                        <i class="fas fa-plus-circle"></i>
                        Add Your First Vehicle Type
                    </button>
                </div>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Vehicle Types Overview</h2>
                    <button class="enhanced-button" onclick="showAddTypeModal()">
                        <i class="fas fa-plus-circle"></i>
                        Add Vehicle Type
                    </button>
                </div>
                <div class="table-stats">
                    <div class="stat-card">
                        <div class="stat-title">Total Vehicle Types</div>
                        <div class="stat-value"><?= count($data['vehicleTypes']) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-title">Total Vehicles</div>
                        <div class="stat-value"><?php
                        $totalVehicles = 0;
                        foreach ($data['vehicleTypes'] as $vehicleType) {
                            $totalVehicles += $vehicleType->total_vehicles ?? 0;
                        }
                        echo $totalVehicles;
                        ?></div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Vehicle Type</th>
                            <th>Description</th>
                            <th>Capacity</th>
                            <th>Price Per Day</th>
                            <th>Vehicle Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['vehicleTypes'] as $index => $type): ?>
                            <tr>
                                <td>
                                    <div class="vehicle-type-cell">
                                        <div class="vehicle-type-info">
                                            <div class="vehicle-type-name"><?= htmlspecialchars($data['vehicleTypeNames'][$index]->vehicleType_name) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="description-cell">
                                    <?= htmlspecialchars($type->customized_description ?? $type->standard_description ?? 'No description') ?>
                                </td>
                                <td>
                                    <div class="capacity-badge">
                                        <i class="fas fa-user"></i>
                                        <?= $type->max_capacity ?> Passengers
                                    </div>
                                </td>
                                <td>
                                    <div class="price-badge">
                                        Rs.<?= number_format($type->pricePer_day, 2) ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="vehicle-count-cell">
                                        <div class="vehicle-badge">
                                            <?= $type->total_vehicles ?? 0 ?> Vehicles
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="enhanced-button secondary" onclick="showAddVehicleModal(<?= $type->vehicleType_Id ?>)">
                                            <i class="fas fa-plus"></i>
                                            Add Vehicles
                                        </button>
                                        <button class="enhanced-button secondary" onclick="showBookVehicleModal(<?= $type->vehicleType_Id ?>)">
                                            <i class="fas fa-calendar-check"></i>
                                            Book Vehicle
                                        </button>
                                        <button class="enhanced-button secondary" onclick="confirmDeleteVehicleType(<?= $type->vehicleType_Id ?>)">
                                            <i class="fas fa-trash"></i>
                                            Remove
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Add Vehicle Type Modal -->
    <div class="custom-modal" id="addTypeModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Add New Vehicle Type</h2>
                <button class="closebutton" onclick="closeModal('addTypeModal')" aria-label="Close Modal">×</button>
            </div>
            <form action="<?= ROOT ?>/TravelProvider/Tmyvehicles/addVehicleType" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-grid">
                        <!-- Basic Vehicle Type Information -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">Vehicle Type Name <span class="input-required">*</span></label>
                                <input type="text" name="vehicleType_name" class="editable-input" required placeholder="e.g., Sedan, SUV, Van" aria-required="true">
                                <span class="input-helper">Enter a custom vehicle type name</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-label">Price per Day <span class="input-required">*</span></label>
                                <input type="number" name="pricePer_day" class="editable-input" required min="0" step="0.01" placeholder="Enter price in Rs." aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-label">Maximum Capacity <span class="input-required">*</span></label>
                                <input type="number" name="max_capacity" class="editable-input" required min="1" placeholder="Enter maximum passengers" aria-required="true">
                            </div>
                        </div>
                        <!-- Vehicle Amenities Section -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">Vehicle Amenities <span class="input-required">*</span></label>
                                <p class="input-helper">Select amenities available in this vehicle type</p>
                                <div class="amenities-grid">
                                    <?php foreach ($data['commonVehicleAmenities'] as $amenity): ?>
                                        <label class="amenity-checkbox">
                                            <input type="checkbox" name="amenities[]" value="<?= $amenity->amenity_Id ?>">
                                            <i class="<?= htmlspecialchars($amenity->icon_class) ?>"></i>
                                            <?= htmlspecialchars($amenity->amenity_name) ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Image Upload Section -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">Vehicle Type Photo <span class="input-required">*</span></label>
                                <div class="file-upload-container" onclick="document.getElementById('vehicleTypeImage').click()">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload vehicle type image</div>
                                    <div class="file-upload-helper">Supported formats: JPG, PNG, WEBP (Max size: 5MB)</div>
                                </div>
                                <input type="file" id="vehicleTypeImage" name="vehicleTypeImage" accept="image/jpeg,image/png,image/webp" style="display: none;" required aria-required="true">
                            </div>
                        </div>
                        <!-- Custom Description -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">Vehicle Type Description <span class="input-required">*</span></label>
                                <textarea name="customized_description" class="editable-textarea" placeholder="Enter a detailed description of the vehicle type..." required aria-required="true"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="enhanced-button secondary" onclick="closeModal('addTypeModal')">
                        Cancel
                    </button>
                    <button type="submit" class="enhanced-button">
                        Add Vehicle Type
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Vehicle Modal -->
    <div class="custom-modal" id="addVehicleModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Add Vehicles to <span id="vehicleTypeName"></span></h2>
                <button class="closebutton" onclick="closeModal('addVehicleModal')" aria-label="Close Modal">×</button>
            </div>
            <form action="<?= ROOT ?>/TravelProvider/Tmyvehicles/addVehicles" method="POST">
                <input type="hidden" id="vehicleTypeId" name="vehicleType_Id">
                <div class="modal-body">
                    <div class="vehicle-form-section">
                        <h3>Vehicle Details</h3>
                        <p class="input-helper">Add registration numbers for vehicles of this type</p>
                        <div class="vehicle-numbers-container" id="vehicleNumbersContainer">
                            <div class="vehicle-input-group">
                                <input type="text" name="vehicle_numbers[]" class="vehicle-number-input" placeholder="Registration No." required aria-required="true">
                                <button type="button" class="remove-vehicle-btn" onclick="removeVehicleInput(this)">×</button>
                            </div>
                        </div>
                        <button type="button" class="add-vehicle-number-btn" onclick="addVehicleNumberInput()">
                            <i class="fas fa-plus"></i> Add Another Vehicle
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="enhanced-button secondary" onclick="closeModal('addVehicleModal')">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="enhanced-button">
                        <i class="fas fa-plus-circle"></i>
                        Add Vehicles
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Book Vehicle Modal -->
    <div class="custom-modal" id="bookVehicleModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Book Vehicle - <span id="bookVehicleTypeName"></span></h2>
                <button class="closebutton" onclick="closeModal('bookVehicleModal')" aria-label="Close Modal">×</button>
            </div>
            <div class="modal-body">
                <!-- Tab Navigation -->
                <div class="details-tabs">
                    <button class="tab-button active" onclick="switchBookingTab(event, 'vehicleAvailability')">
                        <i class="fas fa-calendar-alt"></i> Check Availability
                    </button>
                    <button class="tab-button" onclick="switchBookingTab(event, 'customerDetails')" id="customerDetailsTabBtn" disabled>
                        <i class="fas fa-user"></i> Customer Details
                    </button>
                </div>
                <!-- Vehicle Availability Tab -->
                <div id="vehicleAvailability" class="tab-content active">
                    <div class="availability-section">
                        <div class="filter-section">
                            <div class="date-filter">
                                <label for="startDate">Start Date <span class="input-required">*</span></label>
                                <input type="date" id="startDate" class="date-input" required aria-required="true">
                            </div>
                            <div class="date-filter">
                                <label for="endDate">End Date <span class="input-required">*</span></label>
                                <input type="date" id="endDate" class="date-input" required aria-required="true">
                            </div>
                            <button class="enhanced-button" id="checkAvailabilityBtn" onclick="checkVehicleAvailability()">
                                <i class="fas fa-search"></i> Check Availability
                            </button>
                        </div>
                        <div class="vehicle-summary">
                            <div class="summary-box">
                                <i class="fas fa-car"></i>
                                <div class="summary-info">
                                    <span class="summary-label">Available Vehicles</span>
                                    <span class="summary-value" id="availableVehiclesCount">-</span>
                                </div>
                            </div>
                            <div class="summary-box">
                                <i class="fas fa-hourglass-half"></i>
                                <div class="summary-info">
                                    <span class="summary-label">Booked Vehicles</span>
                                    <span id="bookedVehiclesCount" class="summary-value">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="vehicle-selection">
                            <div class="selection-header">
                                <h3>Select Number of Vehicles</h3>
                                <div class="vehicle-counter">
                                    <button class="counter-btn" id="decrementBtn" onclick="decrementVehicles()" disabled>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span id="vehicleCount">0</span>
                                    <button class="counter-btn" id="incrementBtn" onclick="incrementVehicles()" disabled>
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="booking-summary">
                            <div class="summary-details">
                                <div class="summary-row">
                                    <span>Selected Vehicles</span>
                                    <span id="selectedVehicleCount">0 Vehicle</span>
                                </div>
                                <div class="summary-row">
                                    <span>Total Days</span>
                                    <span id="totalDays">0 Days</span>
                                </div>
                                <div class="summary-row total">
                                    <span>Total Amount</span>
                                    <span id="totalAmount">0 LKR</span>
                                </div>
                            </div>
                            <button class="enhanced-button" id="continueToCustomerBtn" disabled onclick="continueToCustomerDetails()">
                                <i class="fas fa-arrow-right"></i> Continue to Customer Details
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Customer Details Tab -->
                <div id="customerDetails" class="tab-content">
                    <div class="customer-information">
                        <h3 class="customer-info-title">Customer Information</h3>
                        <div class="customer-form">
                            <div class="form-group">
                                <label for="customerFullName">Full Name <span class="input-required">*</span></label>
                                <input type="text" id="customerFullName" class="customer-input" placeholder="Enter customer full name" required aria-required="true">
                                <span class="error-message" id="customerFullNameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="customerEmail">Email Address <span class="input-required">*</span></label>
                                <input type="email" id="customerEmail" class="customer-input" placeholder="Enter customer email address" required aria-required="true">
                                <span class="error-message" id="customerEmailError"></span>
                            </div>
                            <div class="form-group">
                                <label for="customerPhone">Phone Number <span class="input-required">*</span></label>
                                <input type="tel" id="customerPhone" class="customer-input" placeholder="Enter customer phone number" required aria-required="true">
                                <span class="error-message" id="customerPhoneError"></span>
                            </div>
                            <div class="form-group">
                                <label for="customerNIC">NIC / Passport Number <span class="input-required">*</span></label>
                                <input type="text" id="customerNIC" class="customer-input" placeholder="Enter customer NIC or passport number" required aria-required="true">
                                <span class="error-message" id="customerNICError"></span>
                            </div>
                            <div class="form-group full-width">
                                <label for="specialRequests">Special Requests (Optional)</label>
                                <textarea id="specialRequests" class="customer-input" rows="3" style="resize: none;" placeholder="Any special requests or notes for the rental"></textarea>
                            </div>
                            <div class="form-group full-width">
                                <label for="bookingSource">Booking Source <span class="input-required">*</span></label>
                                <select id="bookingSource" class="customer-input" required aria-required="true">
                                    <option value="walk-in">Walk-in</option>
                                    <option value="phone">Phone Call</option>
                                    <option value="email">Email</option>
                                    <option value="third-party">Third-party Site</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group full-width">
                                <label for="paymentStatus">Payment Status <span class="input-required">*</span></label>
                                <select id="paymentStatus" class="customer-input" required aria-required="true">
                                    <option value="fully-paid">Fully Paid</option>
                                    <option value="advance-paid">Advance Paid</option>
                                    <option value="pending">Payment Pending</option>
                                </select>
                            </div>
                            <div class="form-group" id="advanceAmountGroup" style="display: none;">
                                <label for="advanceAmount">Advance Amount <span class="input-required">*</span></label>
                                <input type="number" id="advanceAmount" class="customer-input" placeholder="Enter advance amount" min="0" step="0.01" aria-required="true">
                                <span class="error-message" id="advanceAmountError"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="enhanced-button secondary" onclick="closeModal('bookVehicleModal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="enhanced-button" id="confirmBookingBtn" onclick="confirmDirectBooking()" style="display: none;">
                    <i class="fas fa-check-circle"></i> Confirm Booking
                </button>
            </div>
            <form id="directBookingForm" method="POST" action="<?= ROOT ?>/TravelProvider/Tmyvehicles/recordDirectBooking" style="display: none;">
                <input type="hidden" name="vehicleTypeId" id="booking_vehicleType_id">
                <input type="hidden" name="startDate" id="booking_start_date">
                <input type="hidden" name="endDate" id="booking_end_date">
                <input type="hidden" name="bookedVehicleCount" id="booking_vehicle_count">
                <input type="hidden" name="totalAmount" id="booking_total_amount">
                <input type="hidden" name="customerFullName" id="booking_customer_name">
                <input type="hidden" name="customerEmail" id="booking_customer_email">
                <input type="hidden" name="customerMobileNum" id="booking_customer_phone">
                <input type="hidden" name="customerNIC" id="booking_customer_nic">
                <input type="hidden" name="specialRequests" id="booking_special_requests">
                <input type="hidden" name="bookingSource" id="booking_source">
                <input type="hidden" name="paymentStatus" id="booking_payment_status">
                <input type="hidden" name="advanceAmount" id="booking_advance_amount">
            </form>
        </div>
    </div>

    <!-- Popup for confirm deletion -->
    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-text"></p>
            <button id="closePopup">Cancel</button>
            <button id="confirmDelete">Delete</button>
        </div>
    </div>

    <!-- Popup for success/failure messages -->
    <div id="popupType1" class="popup-container">
        <div class="popup-content">
            <p id="popup-textType1"></p>
            <button id="closePopupType1">OK</button>
        </div>
    </div>

    <script>
        // Utility Functions
        function showAlert(message) {
            const popup = document.getElementById("popupType1");
            const popupText = document.getElementById("popup-textType1");
            popupText.innerHTML = message;
            popup.style.display = "flex";
            const closePopup = document.getElementById("closePopupType1");
            closePopup.onclick = function () {
                popup.style.display = "none";
            };
        }

        function showSuccessPopupFromURL() {
            const urlParams = new URLSearchParams(window.location.search);
            const successMessage = urlParams.get('success');
            const errorMessage = urlParams.get('error');
            if (successMessage) {
                showAlert(decodeURIComponent(successMessage));
                history.replaceState(null, '', window.location.pathname);
            } else if (errorMessage) {
                showAlert(decodeURIComponent(errorMessage));
                history.replaceState(null, '', window.location.pathname);
            }
        }

        window.onload = showSuccessPopupFromURL;

        // Modal Management
        function showAddTypeModal() {
            document.getElementById('addTypeModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            if (modalId === 'bookVehicleModal') {
                resetBookingModal();
            }
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('custom-modal')) {
                event.target.style.display = 'none';
                if (event.target.id === 'bookVehicleModal') {
                    resetBookingModal();
                }
            }
        }

        // Vehicle Type Deletion
        let currentVehicleTypeToDelete = null;

        function confirmDeleteVehicleType(vehicleTypeId) {
            currentVehicleTypeToDelete = vehicleTypeId;
            const popup = document.getElementById('popup');
            const popupText = document.getElementById('popup-text');
            const confirmButton = document.getElementById('confirmDelete');
            const cancelButton = document.getElementById('closePopup');
            popupText.textContent = 'Are you sure you want to delete this vehicle type?';
            popup.style.display = 'flex';
            confirmButton.onclick = function () {
                popup.style.display = 'none';
                proceedDeleteVehicleType();
            };
            cancelButton.onclick = function () {
                popup.style.display = 'none';
            };
        }

        function proceedDeleteVehicleType() {
            if (currentVehicleTypeToDelete) {
                window.location.href = `<?= ROOT ?>/TravelProvider/Tmyvehicles/deleteVehicleType/${currentVehicleTypeToDelete}`;
            }
        }

        // Vehicle Management
        function showAddVehicleModal(vehicleTypeId) {
            fetch(`<?= ROOT ?>/TravelProvider/Tmyvehicles/getVehicleTypeDetails/${vehicleTypeId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('vehicleTypeId').value = vehicleTypeId;
                    document.getElementById('vehicleTypeName').textContent = data.vehicleType_name;
                    document.getElementById('addVehicleModal').style.display = 'flex';
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Failed to load vehicle type details.');
                });
        }

        function addVehicleNumberInput() {
            const container = document.getElementById('vehicleNumbersContainer');
            const newInput = document.createElement('div');
            newInput.className = 'vehicle-input-group';
            newInput.innerHTML = `
                <input type="text" name="vehicle_numbers[]" class="vehicle-number-input" placeholder="Registration No." required aria-required="true">
                <button type="button" class="remove-vehicle-btn" onclick="removeVehicleInput(this)">×</button>
            `;
            container.appendChild(newInput);
        }

        function removeVehicleInput(button) {
            const container = document.getElementById('vehicleNumbersContainer');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }

        // Booking Modal
        let currentVehicleTypeId;
        let maxAvailableVehicles = 0;
        let currentVehicleCount = 0;
        let numberOfDays = 0;
        let pricePerDay = 0;

        function resetBookingModal() {
            document.getElementById('startDate').value = '';
            document.getElementById('endDate').value = '';
            document.getElementById('availableVehiclesCount').textContent = '-';
            document.getElementById('bookedVehiclesCount').textContent = '-';
            document.getElementById('vehicleCount').textContent = '0';
            document.getElementById('selectedVehicleCount').textContent = '0 Vehicle';
            document.getElementById('totalDays').textContent = '0 Days';
            document.getElementById('totalAmount').textContent = '0 LKR';
            document.getElementById('decrementBtn').disabled = true;
            document.getElementById('incrementBtn').disabled = true;
            document.getElementById('continueToCustomerBtn').disabled = true;
            document.getElementById('customerDetailsTabBtn').disabled = true;
            document.getElementById('customerFullName').value = '';
            document.getElementById('customerEmail').value = '';
            document.getElementById('customerPhone').value = '';
            document.getElementById('customerNIC').value = '';
            document.getElementById('specialRequests').value = '';
            document.getElementById('bookingSource').value = 'walk-in';
            document.getElementById('paymentStatus').value = 'fully-paid';
            document.getElementById('advanceAmount').value = '';
            document.getElementById('advanceAmountGroup').style.display = 'none';
            document.querySelectorAll('.customer-input.error').forEach(input => input.classList.remove('error'));
            document.querySelectorAll('.error-message').forEach(error => error.textContent = '');
            currentVehicleCount = 0;
            maxAvailableVehicles = 0;
            numberOfDays = 0;
            pricePerDay = 0;
        }

        function showBookVehicleModal(vehicleTypeId) {
            currentVehicleTypeId = vehicleTypeId;
            resetBookingModal();
            fetch(`<?= ROOT ?>/TravelProvider/Tmyvehicles/getVehicleTypeDetails/${vehicleTypeId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('bookVehicleTypeName').textContent = data.vehicleType_name;
                    pricePerDay = parseFloat(data.pricePer_day);
                    document.getElementById('bookVehicleModal').style.display = 'flex';
                    switchBookingTab({ currentTarget: document.querySelector('#bookVehicleModal .tab-button.active') }, 'vehicleAvailability');
                    initializeDateInputs();
                })
                .catch(error => {
                    console.error('Error fetching vehicle details:', error);
                    showAlert('Failed to load vehicle type details. Please try again.');
                });
        }

        function initializeDateInputs() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const todayFormatted = today.toISOString().split('T')[0];
            const tomorrowFormatted = tomorrow.toISOString().split('T')[0];
            startDateInput.min = todayFormatted;
            endDateInput.min = tomorrowFormatted;

            startDateInput.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const nextDay = new Date(selectedDate);
                nextDay.setDate(nextDay.getDate() + 1);
                endDateInput.min = nextDay.toISOString().split('T')[0];
                if (endDateInput.value && new Date(endDateInput.value) <= new Date(this.value)) {
                    endDateInput.value = nextDay.toISOString().split('T')[0];
                }
                calculateDateDifference();
            });

            endDateInput.addEventListener('change', function () {
                calculateDateDifference();
            });
        }

        function calculateDateDifference() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            if (startDateInput.value && endDateInput.value) {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                const timeDifference = endDate.getTime() - startDate.getTime();
                numberOfDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                const rentalDurationDisplay = document.getElementById('totalDays');
                if (rentalDurationDisplay) {
                    rentalDurationDisplay.textContent = `${numberOfDays} day${numberOfDays !== 1 ? 's' : ''}`;
                }
                calculateTotalAmount();
            }
        }

        function checkVehicleAvailability() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            if (!startDate || !endDate) {
                showAlert('Please select both start and end dates');
                return;
            }
            fetch(`<?= ROOT ?>/TravelProvider/Tmyvehicles/checkVehicleAvailability/${currentVehicleTypeId}/${startDate}/${endDate}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        showAlert(data.error);
                    } else {
                        updateAvailabilityUI(data);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Failed to check vehicle availability. Please try again.');
                });
        }

        function updateAvailabilityUI(data) {
            const availableVehiclesElement = document.getElementById('availableVehiclesCount');
            availableVehiclesElement.textContent = `${data.available_vehicles} of ${data.total_vehicles}`;
            const bookedVehiclesElement = document.getElementById('bookedVehiclesCount');
            bookedVehiclesElement.textContent = `${data.booked_vehicles} of ${data.total_vehicles}`;
            maxAvailableVehicles = data.available_vehicles;
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            const continueToCustomerBtn = document.getElementById('continueToCustomerBtn');
            if (maxAvailableVehicles > 0) {
                incrementBtn.disabled = false;
                currentVehicleCount = 1;
                document.getElementById('vehicleCount').textContent = currentVehicleCount;
                document.getElementById('selectedVehicleCount').textContent = `${currentVehicleCount} Vehicle`;
                decrementBtn.disabled = currentVehicleCount <= 1;
                incrementBtn.disabled = currentVehicleCount >= maxAvailableVehicles;
                continueToCustomerBtn.disabled = false;
                calculateTotalAmount();
            } else {
                showAlert('No vehicles available for the selected dates');
                decrementBtn.disabled = true;
                incrementBtn.disabled = true;
                continueToCustomerBtn.disabled = true;
                currentVehicleCount = 0;
                document.getElementById('vehicleCount').textContent = currentVehicleCount;
                document.getElementById('selectedVehicleCount').textContent = `${currentVehicleCount} Vehicle`;
                calculateTotalAmount();
            }
        }

        function incrementVehicles() {
            if (currentVehicleCount < maxAvailableVehicles) {
                currentVehicleCount++;
                updateVehicleCount();
            }
        }

        function decrementVehicles() {
            if (currentVehicleCount > 1) {
                currentVehicleCount--;
                updateVehicleCount();
            }
        }

        function updateVehicleCount() {
            const vehicleCountElement = document.getElementById('vehicleCount');
            const selectedVehicleCountElement = document.getElementById('selectedVehicleCount');
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            vehicleCountElement.textContent = currentVehicleCount;
            selectedVehicleCountElement.textContent = `${currentVehicleCount} Vehicle${currentVehicleCount !== 1 ? 's' : ''}`;
            decrementBtn.disabled = currentVehicleCount <= 1;
            incrementBtn.disabled = currentVehicleCount >= maxAvailableVehicles;
            calculateTotalAmount();
        }

        function calculateTotalAmount() {
            const totalPrice = numberOfDays * pricePerDay * currentVehicleCount;
            document.getElementById('totalAmount').textContent = `${totalPrice.toFixed(2)} LKR`;
        }

        function continueToCustomerDetails() {
            document.getElementById('customerDetailsTabBtn').disabled = false;
            switchBookingTab({ currentTarget: document.getElementById('customerDetailsTabBtn') }, 'customerDetails');
            const paymentStatusSelect = document.getElementById('paymentStatus');
            paymentStatusSelect.addEventListener('change', function () {
                const advanceAmountGroup = document.getElementById('advanceAmountGroup');
                if (this.value === 'advance-paid') {
                    advanceAmountGroup.style.display = 'flex';
                } else {
                    advanceAmountGroup.style.display = 'none';
                }
            });
        }

        function switchBookingTab(event, tabId) {
            const tabButtons = document.querySelectorAll('#bookVehicleModal .tab-button');
            const tabContents = document.querySelectorAll('#bookVehicleModal .tab-content');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
            const confirmBookingBtn = document.getElementById('confirmBookingBtn');
            if (tabId === 'customerDetails') {
                confirmBookingBtn.style.display = 'inline-flex';
            } else {
                confirmBookingBtn.style.display = 'none';
            }
        }

        function validateCustomerDetails() {
            let isValid = true;
            const fields = [
                { id: 'customerFullName', errorId: 'customerFullNameError', message: 'Full name is required' },
                { id: 'customerEmail', errorId: 'customerEmailError', message: 'Valid email is required', validate: value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) },
                { id: 'customerPhone', errorId: 'customerPhoneError', message: 'Phone number is required' },
                { id: 'customerNIC', errorId: 'customerNICError', message: 'NIC or passport number is required' }
            ];

            fields.forEach(field => {
                const input = document.getElementById(field.id);
                const errorElement = document.getElementById(field.errorId);
                if (!input.value.trim()) {
                    input.classList.add('error');
                    errorElement.textContent = field.message;
                    isValid = false;
                } else if (field.validate && !field.validate(input.value)) {
                    input.classList.add('error');
                    errorElement.textContent = field.message;
                    isValid = false;
                } else {
                    input.classList.remove('error');
                    errorElement.textContent = '';
                }
            });

            const paymentStatus = document.getElementById('paymentStatus').value;
            if (paymentStatus === 'advance-paid') {
                const advanceAmount = document.getElementById('advanceAmount');
                const advanceAmountError = document.getElementById('advanceAmountError');
                if (!advanceAmount.value || parseFloat(advanceAmount.value) <= 0) {
                    advanceAmount.classList.add('error');
                    advanceAmountError.textContent = 'Advance amount must be greater than 0';
                    isValid = false;
                } else {
                    advanceAmount.classList.remove('error');
                    advanceAmountError.textContent = '';
                }
            }

            return isValid;
        }

        function confirmDirectBooking() {
            if (!validateCustomerDetails()) {
                showAlert('Please fill in all required fields correctly.');
                return;
            }

            document.getElementById('booking_vehicleType_id').value = currentVehicleTypeId;
            document.getElementById('booking_start_date').value = document.getElementById('startDate').value;
            document.getElementById('booking_end_date').value = document.getElementById('endDate').value;
            document.getElementById('booking_vehicle_count').value = currentVehicleCount;
            document.getElementById('booking_total_amount').value = document.getElementById('totalAmount').textContent.replace(' LKR', '');
            document.getElementById('booking_customer_name').value = document.getElementById('customerFullName').value;
            document.getElementById('booking_customer_email').value = document.getElementById('customerEmail').value;
            document.getElementById('booking_customer_phone').value = document.getElementById('customerPhone').value;
            document.getElementById('booking_customer_nic').value = document.getElementById('customerNIC').value;
            document.getElementById('booking_special_requests').value = document.getElementById('specialRequests').value;
            document.getElementById('booking_source').value = document.getElementById('bookingSource').value;
            document.getElementById('booking_payment_status').value = document.getElementById('paymentStatus').value;
            const paymentStatus = document.getElementById('paymentStatus').value;
            if (paymentStatus === 'advance-paid') {
                document.getElementById('booking_advance_amount').value = document.getElementById('advanceAmount').value;
            } else if (paymentStatus === 'fully-paid') {
                document.getElementById('booking_advance_amount').value = document.getElementById('booking_total_amount').value;
            } else {
                document.getElementById('booking_advance_amount').value = '0';
            }

            document.getElementById('directBookingForm').submit();
        }
    </script>
</body>
</html>