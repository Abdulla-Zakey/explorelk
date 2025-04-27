<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
// // ?>
<?php
    // var_dump($data);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/temp.css">


    <title>Hotel Management Dashboard</title>
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
</head>
<body>
    <div class="dashboard">
        
        
            <!-- Header -->
            
                
                
            

            <!-- Main Content -->
            <main class="content">
                <!-- Summary Cards -->
                <section class="summary-cards">
                    <div class="card">
                        <div class="card-icon rooms">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Total Rooms</h3>
                            <p class="card-value">42</p>
                            <p class="card-trend positive">+2 this month</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon bookings">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Active Bookings</h3>
                            <p class="card-value">28</p>
                            <p class="card-trend positive">+5 from last week</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon earnings">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Earnings</h3>
                            <p class="card-value">$12,845</p>
                            <p class="card-trend positive">+12% this month</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon reviews">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </div>
                        <div class="card-content">
                            <h3>Reviews</h3>
                            <p class="card-value">4.8/5</p>
                            <p class="card-trend positive">+0.2 this month</p>
                        </div>
                    </div>
                </section>

                

                <div class="dashboard-grid">
                    <!-- Booking Overview -->
                    <section class="booking-overview">
                        <h2>Booking Overview</h2>
                        
                        <div class="booking-list">
                            <div class="booking-item">
                                <div class="guest-info">
                                    <img src="https://via.placeholder.com/40" alt="Guest" class="avatar">
                                    <div>
                                        <h4>John Smith</h4>
                                        <p>Deluxe Ocean View</p>
                                    </div>
                                </div>
                                <div class="booking-details">
                                    <div class="booking-date">
                                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>Apr 28 - May 2, 2023</span>
                                    </div>
                                    <span class="booking-status confirmed">Confirmed</span>
                                </div>
                            </div>
                            <div class="booking-item">
                                <div class="guest-info">
                                    <img src="https://via.placeholder.com/40" alt="Guest" class="avatar">
                                    <div>
                                        <h4>Sarah Johnson</h4>
                                        <p>Executive Suite</p>
                                    </div>
                                </div>
                                <div class="booking-details">
                                    <div class="booking-date">
                                        <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>Apr 30 - May 5, 2023</span>
                                    </div>
                                    <span class="booking-status pending">Pending</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Financial Summary -->
                    <section class="financial-summary">
                        <h2>Financial Summary</h2>
                        <div class="finance-cards">
                            <div class="finance-card">
                                <h3>Today's Earnings</h3>
                                <p class="finance-value">$1,245</p>
                                <div class="finance-chart placeholder"></div>
                            </div>
                            <div class="finance-card">
                                <h3>Monthly Earnings</h3>
                                <p class="finance-value">$12,845</p>
                                <div class="finance-chart placeholder"></div>
                            </div>
                            
                        </div>
                    </section>

                    <!-- Review Section -->
                    <section class="review-section">
                        <h2>Recent Reviews</h2>
                        <div class="review-list">
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="https://via.placeholder.com/40" alt="Reviewer" class="avatar">
                                        <div>
                                            <h4>Michael Brown</h4>
                                            <div class="rating">
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                                <span class="star">★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="review-date">2 days ago</span>
                                </div>
                                <p class="review-text">Great hotel with amazing views. The staff was very friendly and helpful. Would definitely stay here again!</p>
                                <button class="btn btn-sm btn-outline">Respond</button>
                            </div>
                            <div class="review-item">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <img src="https://via.placeholder.com/40" alt="Reviewer" class="avatar">
                                        <div>
                                            <h4>Emily Davis</h4>
                                            <div class="rating">
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                                <span class="star filled">★</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="review-date">5 days ago</span>
                                </div>
                                <p class="review-text">Absolutely perfect stay! The room was clean and spacious, and the breakfast was delicious.</p>
                                <button class="btn btn-sm btn-outline">Respond</button>
                            </div>
                        </div>
                    </section>

                    

                    
                </div>
            </main>
        </div>
    </div>
</body>
</html>
<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/myrooms.css?v=1.0">
    <style>
        /* Booking Modal Styles */
        .details-tabs {
            display: flex;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 12px 20px;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-button.active {
            color: #4A6FA5;
            border-bottom: 3px solid #4A6FA5;
        }

        .tab-button:disabled {
            color: #ccc;
            cursor: not-allowed;
        }

        .tab-button i {
            font-size: 16px;
        }

        .tab-content {
            display: none;
            padding: 10px 0;
        }

        .tab-content.active {
            display: block;
        }

        .availability-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .filter-section {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: flex-end;
        }

        .date-filter {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 180px;
        }

        .date-filter label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .date-input {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
        }

        .room-summary {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .summary-box {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            flex: 1;
            min-width: 200px;
        }

        .summary-box i {
            font-size: 22px;
            color: #4A6FA5;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(74, 111, 165, 0.1);
            border-radius: 50%;
        }

        .summary-info {
            display: flex;
            flex-direction: column;
        }

        .summary-label {
            font-size: 13px;
            color: #666;
        }

        .summary-value {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .room-selection {
            margin-top: 15px;
        }

        .selection-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .selection-header h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .room-counter {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .counter-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .counter-btn:hover:not(:disabled) {
            background-color: #f0f0f0;
        }

        .counter-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        #roomCount {
            font-size: 18px;
            font-weight: 600;
            min-width: 30px;
            text-align: center;
        }

        .booking-summary {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .summary-details {
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .summary-row.total {
            font-weight: 600;
            color: #4A6FA5;
            border-bottom: none;
            font-size: 18px;
        }

        .guest-information {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }

        .guest-info-title {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
        }

        .guest-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .guest-input {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
        }

        .guest-input.error {
            border-color: #ff5252;
        }

        .input-required {
            color: #ff5252;
        }

        .error-message {
            color: #ff5252;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .guest-form {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }
        }
    </style>

</head>

<body>
    <div class="hotel-header">

    </div>

    <div class="container">
        <?php if (empty($data['hotelRoomTypes'])): ?>
            <div class="empty-state">
                <div class="empty-state-card">
                    <div class="icon-circle">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <h2 class="empty-state-title">No Room Types Added Yet</h2>
                    <p class="empty-state-description">
                        Start by adding your first room type. This will help you manage your hotel inventory and showcase
                        your accommodations to guests.
                    </p>
                    <button class="enhanced-button" onclick="showAddTypeModal()">
                        <i class="fas fa-plus-circle"></i>
                        Add Your First Room Type
                    </button>
                </div>
            </div>
        <?php else: ?>
            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Room Types Overview</h2>
                    <button class="enhanced-button" onclick="showAddTypeModal()">
                        <i class="fas fa-plus-circle"></i>
                        Add Room Type
                    </button>
                </div>

                <div class="table-stats">
                    <div class="stat-card">
                        <div class="stat-title">Total Room Types</div>
                        <div class="stat-value"><?= count($data['hotelRoomTypes']) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-title">Total Rooms</div>
                        <div class="stat-value"><?php
                        $totalRooms = 0;
                        foreach ($data['hotelRoomTypes'] as $hotelRoomType) {
                            $totalRooms += $hotelRoomType->total_rooms;
                        }
                        echo $totalRooms;
                        ?>
                        </div>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Occupancy</th>
                            <th>Price Per Night</th>
                            <th>Rooms Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($data['hotelRoomTypes'] as $type):
                            ?>
                            <tr>
                                <td>
                                    <div class="room-type-cell">
                                        <div class="room-type-info">
                                            <div class="room-type-name"><?= $data['hotelRoomTypesNames'][$i]->roomType_name ?>
                                            </div>
                                        </div>
                                </td>
                                <td class="description-cell">
                                    <?= $type->customized_description ?? $type->standard_description ?>
                                </td>
                                <td>
                                    <div class="occupancy-badge">
                                        <i class="fas fa-user"></i>
                                        <?= $type->max_occupancy ?> Guests
                                    </div>
                                </td>
                                <td>
                                    <div class="price-badge">
                                        Rs.<?= number_format($type->pricePer_night, 2) ?>
                                    </div>
                                </td>

                                <td>
                                    <div class="room-count-cell">
                                        <div class="room-badge">
                                            <?= $type->total_rooms ?? 0 ?> Rooms
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="enhanced-button secondary"
                                            onclick="showAddRoomModal(<?= $type->hotel_roomType_Id ?>)">
                                            <i class="fas fa-plus"></i>
                                            Add Rooms
                                        </button>

                                        <button class="enhanced-button secondary"
                                            onclick="showBookRoomModal(<?= $type->hotel_roomType_Id ?>)">
                                            <i class="fas fa-calendar-check"></i>
                                            Book Room
                                        </button>

                                        <button class="enhanced-button secondary"
                                            onclick="confirmDeleteRoomType(<?= $type->hotel_roomType_Id ?>)">
                                            <i class="fas fa-trash"></i>
                                            Remove
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Add Room Type Modal -->
    <div class="custom-modal" id="addTypeModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Add New Room Type</h2>
                <button class="closebutton" onclick="closeModal('addTypeModal')">&times;</button>
            </div>

            <form action="<?= ROOT ?>/Hotel/Hmyrooms/addRoomType" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-grid">
                        <!-- Basic Room Type Information -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">
                                    Select Room Type
                                    <span class="input-required">*</span>
                                </label>
                                <select name="roomType_Id" class="editable-input" required>
                                    <option value="">Choose a room type...</option>
                                    <?php foreach ($data['commonlyAvailableRoomTypesForAllHotels'] as $type): ?>
                                        <option value="<?= $type->roomType_Id ?>"><?= $type->roomType_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="input-helper">Select from commonly available room types</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-label">
                                    Price per Night
                                    <span class="input-required">*</span>
                                </label>
                                <input type="number" name="pricePer_night" class="editable-input" required min="0"
                                    step="0.01" placeholder="Enter price in Rs.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-label">
                                    Maximum Occupancy
                                    <span class="input-required">*</span>
                                </label>
                                <input type="number" name="max_occupancy" class="editable-input" required min="1"
                                    placeholder="Enter maximum guests allowed">
                            </div>
                        </div>

                        <!-- Room Amenities Section -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">
                                    Room Amenities
                                    <span class="input-required">*</span>
                                </label>
                                <p class="input-helper">Select amenities available in this room type</p>

                                <div class="amenities-grid">
                                    <?php foreach ($data['commonRoomAmenities'] as $amenity): ?>
                                        <label class="amenity-checkbox">
                                            <input type="checkbox" name="amenities[]" value="<?= $amenity->amenity_Id ?>">
                                            <i class="<?= $amenity->icon_class ?>"></i>
                                            <?= $amenity->amenity_name ?>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload Section -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">
                                    Room Type Photo
                                    <span class="input-required">*</span>
                                </label>
                                <div class="file-upload-container"
                                    onclick="document.getElementById('roomTypeImage').click()">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload room type image</div>
                                    <div class="file-upload-helper">Supported formats: JPG, PNG, WEBP (Max size: 5MB)
                                    </div>
                                </div>
                                <input type="file" id="roomTypeImage" name="roomTypeImage" accept="image/*"
                                    style="display: none;" required>
                            </div>
                        </div>

                        <!-- Custom Description -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">
                                    Room Type Description
                                    <span class="input-required">*</span>
                                </label>
                                <textarea name="customized_description" class="editable-textarea"
                                    placeholder="Enter a detailed description of the room type..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="enhanced-button secondary" onclick="closeModal('addTypeModal')">
                        Cancel
                    </button>
                    <button type="submit" class="enhanced-button">
                        Add Room Type
                    </button>
                </div>3
            </form>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="custom-modal" id="addRoomModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Add Rooms to <span id="roomTypeName"></span></h2>
                <button class="closebutton" onclick="closeModal('addRoomModal')">&times;</button>
            </div>

            <form action="<?= ROOT ?>/Hotel/Hmyrooms/addRooms" method="POST">
                <input type="hidden" id="hotelRoomTypeId" name="hotel_roomType_Id">

                <div class="modal-body">
                    <div class="room-form-section">
                        <h3>Room Numbers</h3>
                        <p class="input-helper">Add room numbers for this room type</p>

                        <div class="room-numbers-container" id="roomNumbersContainer">
                            <div class="room-input-group">
                                <input type="text" name="room_numbers[]" class="room-number-input"
                                    placeholder="Room No." required>
                                <button type="button" class="remove-room-btn" onclick="removeRoomInput(this)">×</button>
                            </div>
                        </div>

                        <button type="button" class="add-room-number-btn" onclick="addRoomNumberInput()">
                            <i class="fas fa-plus"></i> Add Another Room
                        </button>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="enhanced-button secondary" onclick="closeModal('addRoomModal')">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="enhanced-button">
                        <i class="fas fa-plus-circle"></i>
                        Add Rooms
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Book Room Modal -->
    <div class="custom-modal" id="bookRoomModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Book Room - <span id="bookRoomTypeName"></span></h2>
                <button class="closebutton" onclick="closeModal('bookRoomModal')">&times;</button>
            </div>

            <div class="modal-body">
                <!-- Tab Navigation -->
                <div class="details-tabs">
                    <button class="tab-button active" onclick="switchBookingTab(event, 'roomAvailability')">
                        <i class="fas fa-calendar-alt"></i> Check Availability
                    </button>
                    <button class="tab-button" onclick="switchBookingTab(event, 'guestDetails')" id="guestDetailsTabBtn"
                        disabled>
                        <i class="fas fa-user"></i> Guest Details
                    </button>
                </div>

                <!-- Room Availability Tab -->
                <div id="roomAvailability" class="tab-content active">
                    <div class="availability-section">
                        <div class="filter-section">
                            <div class="date-filter">
                                <label for="checkIn">Check-in Date</label>
                                <input type="date" id="checkIn" class="date-input">
                            </div>
                            <div class="date-filter">
                                <label for="checkOut">Check-out Date</label>
                                <input type="date" id="checkOut" class="date-input">
                            </div>
                            <button class="enhanced-button" id="checkAvailabilityBtn" onclick="checkRoomAvailability()">
                                <i class="fas fa-search"></i> Check Availability
                            </button>
                        </div>

                        <div class="room-summary">
                            <div class="summary-box">
                                <i class="fas fa-bed"></i>
                                <div class="summary-info">
                                    <span class="summary-label">Available Rooms</span>
                                    <span class="summary-value" id="availableRoomsCount">-</span>
                                </div>
                            </div>
                            <div class="summary-box">
                                <i class="fas fa-hourglass-half"></i>
                                <div class="summary-info">
                                    <span class="summary-label">Pending Reservations</span>
                                    <span id="reservedRoomsCount" class="summary-value">-</span>
                                </div>
                            </div>
                        </div>

                        <div class="room-selection">
                            <div class="selection-header">
                                <h3>Select Number of Rooms</h3>
                                <div class="room-counter">
                                    <button class="counter-btn" id="decrementBtn" onclick="decrementRooms()" disabled>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span id="roomCount">0</span>
                                    <button class="counter-btn" id="incrementBtn" onclick="incrementRooms()" disabled>
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="booking-summary">
                            <div class="summary-details">
                                <div class="summary-row">
                                    <span>Selected Rooms</span>
                                    <span id="selectedRoomCount">0 Room</span>
                                </div>
                                <div class="summary-row">
                                    <span>Total Nights</span>
                                    <span id="totalNights">0 Nights</span>
                                </div>
                                <div class="summary-row total">
                                    <span>Total Amount</span>
                                    <span id="totalAmount">0 LKR</span>
                                </div>
                            </div>

                            <button class="enhanced-button" id="continueToGuestBtn" disabled
                                onclick="continueToGuestDetails()">
                                <i class="fas fa-arrow-right"></i> Continue to Guest Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Guest Details Tab -->
                <div id="guestDetails" class="tab-content">
                    <div class="guest-information">
                        <h3 class="guest-info-title">Guest Information</h3>
                        <div class="guest-form">
                            <div class="form-group">
                                <label for="guestFullName">Full Name <span class="input-required">*</span></label>
                                <input type="text" id="guestFullName" class="guest-input"
                                    placeholder="Enter guest full name">
                            </div>
                            <div class="form-group">
                                <label for="guestEmail">Email Address <span class="input-required">*</span></label>
                                <input type="email" id="guestEmail" class="guest-input"
                                    placeholder="Enter guest email address">
                            </div>
                            <div class="form-group">
                                <label for="guestPhone">Phone Number <span class="input-required">*</span></label>
                                <input type="tel" id="guestPhone" class="guest-input"
                                    placeholder="Enter guest phone number">
                            </div>
                            <div class="form-group">
                                <label for="guestNIC">NIC / Passport Number <span
                                        class="input-required">*</span></label>
                                <input type="text" id="guestNIC" class="guest-input"
                                    placeholder="Enter guest NIC or passport number">
                            </div>
                            <div class="form-group full-width">
                                <label for="specialRequests">Special Requests (Optional)</label>
                                <textarea id="specialRequests" class="guest-input" rows="3" style="resize: none;"
                                    placeholder="Any special requests or notes for the stay"></textarea>
                            </div>
                            <div class="form-group full-width">
                                <label for="bookingSource">Booking Source <span class="input-required">*</span></label>
                                <select id="bookingSource" class="guest-input">
                                    <option value="walk-in">Walk-in</option>
                                    <option value="phone">Phone Call</option>
                                    <option value="email">Email</option>
                                    <option value="third-party">Third-party Site</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group full-width">
                                <label for="paymentStatus">Payment Status <span class="input-required">*</span></label>
                                <select id="paymentStatus" class="guest-input">
                                    <option value="fully-paid">Fully Paid</option>
                                    <option value="advance-paid">Advance Paid</option>
                                    <option value="pending">Payment Pending</option>
                                </select>
                            </div>
                            <div class="form-group" id="advanceAmountGroup" style="display: none;">
                                <label for="advanceAmount">Advance Amount <span class="input-required">*</span></label>
                                <input type="number" id="advanceAmount" class="guest-input"
                                    placeholder="Enter advance amount">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="enhanced-button secondary" onclick="closeModal('bookRoomModal')">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="button" class="enhanced-button" id="confirmBookingBtn" onclick="confirmDirectBooking()">
                    <i class="fas fa-check-circle"></i> Confirm Booking
                </button>
            </div>

            <form id="directBookingForm" method="POST" action="<?= ROOT ?>/Hotel/Hmyrooms/recordDirectBooking"
                style="display: none;">
                <input type="hidden" name="hotelRoomTypeId" id="booking_roomType_id">
                <input type="hidden" name="checkInDate" id="booking_checkIn_date">
                <input type="hidden" name="checkOutDate" id="booking_checkOut_date">
                <input type="hidden" name="bookedRoomCount" id="booking_room_count">
                <input type="hidden" name="totalAmount" id="booking_total_amount">

                <!-- Guest Details -->
                <input type="hidden" name="guestFullName" id="booking_guest_name">
                <input type="hidden" name="guestEmail" id="booking_guest_email">
                <input type="hidden" name="guestMobileNum" id="booking_guest_phone">
                <input type="hidden" name="guestNIC" id="booking_guest_nic">
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

    <!--popup to inform deletion success or failure-->
    <div id="popupType1" class="popup-container">
        <div class="popup-content">
            <p id="popup-textType1"></p>
            <button id="closePopupType1">OK</button>
        </div>
    </div>

    <script>
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

            if (successMessage) {
                showAlert(decodeURIComponent(successMessage));
                history.replaceState(null, '', window.location.pathname);
            }
        }

        // Call this when the page loads
        window.onload = showSuccessPopupFromURL;

        let currentRoomTypeToDelete = null;

        function confirmDeleteRoomType(roomTypeId) {
            currentRoomTypeToDelete = roomTypeId;
            const popup = document.getElementById('popup');
            const popupText = document.getElementById('popup-text');
            const confirmButton = document.getElementById('confirmDelete');
            const cancelButton = document.getElementById('closePopup');

            popupText.textContent = 'Are you sure you want to delete this room type?';
            popup.style.display = 'flex';

            confirmButton.onclick = function () {
                popup.style.display = 'none';
                proceedDeleteRoomType();
            };

            cancelButton.onclick = function () {
                popup.style.display = 'none';
            };
        }

        function proceedDeleteRoomType() {
            if (currentRoomTypeToDelete) {
                window.location.href = `<?= ROOT ?>/Hotel/Hmyrooms/deleteRoomType/${currentRoomTypeToDelete}`;
            }
        }
    </script>

    <!-- Add new script for room management -->
    <script>
        function showAddRoomModal(hotelRoomTypeId) {
            document.getElementById('hotelRoomTypeId').value = hotelRoomTypeId;
            document.getElementById('addRoomModal').style.display = 'flex';
        }

        function addRoomNumberInput() {
            const container = document.getElementById('roomNumbersContainer');
            const newInput = document.createElement('div');
            newInput.className = 'room-input-group';
            newInput.innerHTML = `
                <input type="text" name="room_numbers[]" class="room-number-input" placeholder="Room No." required>
                <button type="button" class="remove-room-btn" onclick="removeRoomInput(this)">×</button>
            `;
            container.appendChild(newInput);
        }

        function removeRoomInput(button) {
            const container = document.getElementById('roomNumbersContainer');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }
    </script>

    <script>
        <?php
        $messageToShow = '';
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            $messageToShow = implode(', ', $_SESSION['errors']);
            unset($_SESSION['errors']);
        } else if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
            $messageToShow = implode(', ', $_SESSION['success']);
            // var_dump($_SESSION['success']);
            unset($_SESSION['success']);
        }
        ?>

        const serverMessage = <?= json_encode($messageToShow) ?>;

        if (serverMessage) {
            showAlert(serverMessage);
        }
    </script>

    <script>
        function showAddTypeModal() {
            document.getElementById('addTypeModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target.classList.contains('custom-modal')) {
                event.target.style.display = 'none';
            }
        }

        document.getElementById('roomTypeImage').addEventListener('change', function (e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const container = document.querySelector('.file-upload-text');
                container.textContent = `Selected file: ${fileName}`;
            }
        });
    </script>

    <script>
        // Variables for booking functionality
        let currentRoomTypeId;
        let maxAvailableRooms = 0;
        let currentRoomCount = 0;
        let numberOfNights = 0;
        let pricePerNight = 0;

        // Show booking modal with room type information
        function showBookRoomModal(roomTypeId) {
            currentRoomTypeId = roomTypeId;

            // Reset modal values
            document.getElementById('checkIn').value = '';
            document.getElementById('checkOut').value = '';
            document.getElementById('availableRoomsCount').textContent = '-';
            document.getElementById('reservedRoomsCount').textContent = '-';
            document.getElementById('roomCount').textContent = '0';
            document.getElementById('selectedRoomCount').textContent = '0 Room';
            document.getElementById('totalNights').textContent = '0 Nights';
            document.getElementById('totalAmount').textContent = '0 LKR';

            // Disable buttons initially
            document.getElementById('decrementBtn').disabled = true;
            document.getElementById('incrementBtn').disabled = true;
            document.getElementById('continueToGuestBtn').disabled = true;
            document.getElementById('guestDetailsTabBtn').disabled = true;

            // Reset room counter
            currentRoomCount = 0;

            // Find room type information
            fetch(`<?= ROOT ?>/Hotel/Hmyrooms/getRoomTypeDetails/${roomTypeId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('bookRoomTypeName').textContent = data.roomType_name;
                    pricePerNight = parseFloat(data.pricePer_night);

                    // Show modal
                    document.getElementById('bookRoomModal').style.display = 'flex';

                    // Set active tab
                    switchBookingTab({ currentTarget: document.querySelector('#bookRoomModal .tab-button.active') }, 'roomAvailability');

                    // Set date restrictions for the booking
                    initializeDateInputs();
                })
                .catch(error => {
                    console.error('Error fetching room details:', error);
                    showAlert('Failed to load room type details. Please try again.');
                });
        }

        // Initialize date inputs with restrictions
        function initializeDateInputs() {
            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');

            // Set minimum date as today for check-in
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            const todayFormatted = today.toISOString().split('T')[0];
            const tomorrowFormatted = tomorrow.toISOString().split('T')[0];

            checkInInput.min = todayFormatted;
            checkOutInput.min = tomorrowFormatted;

            // Update check-out minimum date when check-in date changes
            checkInInput.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const nextDay = new Date(selectedDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkOutInput.min = nextDay.toISOString().split('T')[0];

                if (checkOutInput.value && new Date(checkOutInput.value) <= new Date(this.value)) {
                    checkOutInput.value = nextDay.toISOString().split('T')[0];
                }

                calculateDateDifference();
            });

            // Calculate difference when check-out date changes
            checkOutInput.addEventListener('change', function () {
                calculateDateDifference();
            });
        }

        // Calculate date difference
        function calculateDateDifference() {
            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');

            if (checkInInput.value && checkOutInput.value) {
                const checkIn = new Date(checkInInput.value);
                const checkOut = new Date(checkOutInput.value);

                // Calculate the time difference in milliseconds
                const timeDifference = checkOut.getTime() - checkIn.getTime();

                // Convert to days
                numberOfNights = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

                // Update the display
                const stayDurationDisplay = document.getElementById('totalNights');
                if (stayDurationDisplay) {
                    stayDurationDisplay.textContent = `${numberOfNights} night${numberOfNights !== 1 ? 's' : ''}`;
                }

                calculateTotalAmount();
            }
        }

        // Check room availability
        function checkRoomAvailability() {
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;

            // Validate inputs
            if (!checkIn || !checkOut) {
                showAlert('Please select both check-in and check-out dates');
                return;
            }

            // Make AJAX call to check availability
            fetch(`<?= ROOT ?>/traveler/RoomBookingController/checkAvailability/${currentRoomTypeId}/${checkIn}/${checkOut}`)
                // fetch(`<?= ROOT ?>/Hotel/Hmyrooms/checkRoomAvailability/${currentRoomTypeId}/${checkIn}/${checkOut}`)
                .then(response => response.json())
                .then(data => {
                    updateAvailabilityUI(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Failed to check room availability. Please try again.');
                });
        }

        // Update UI with availability data
        function updateAvailabilityUI(data) {
            // Update available rooms count
            const availableRoomsElement = document.getElementById('availableRoomsCount');
            availableRoomsElement.textContent = `${data.available_rooms} of ${data.total_rooms}`;

            const reservedRoomsElement = document.getElementById('reservedRoomsCount');
            reservedRoomsElement.textContent = `${data.reserved_rooms} of ${data.total_rooms}`;

            // Update max available rooms for selection
            maxAvailableRooms = data.available_rooms;

            // Enable buttons if rooms are available
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');
            const continueToGuestBtn = document.getElementById('continueToGuestBtn');

            if (maxAvailableRooms > 0) {
                incrementBtn.disabled = false;

                // Reset room count
                currentRoomCount = 1;
                document.getElementById('roomCount').textContent = currentRoomCount;
                document.getElementById('selectedRoomCount').textContent = `${currentRoomCount} Room`;

                // Update button states
                decrementBtn.disabled = currentRoomCount <= 1;
                incrementBtn.disabled = currentRoomCount >= maxAvailableRooms;

                // Enable continue button
                continueToGuestBtn.disabled = false;

                calculateTotalAmount();
            } else {
                showAlert('No rooms available for the selected dates');
                decrementBtn.disabled = true;
                incrementBtn.disabled = true;
                continueToGuestBtn.disabled = true;

                // Reset room count
                currentRoomCount = 0;
                document.getElementById('roomCount').textContent = currentRoomCount;
                document.getElementById('selectedRoomCount').textContent = `${currentRoomCount} Room`;

                calculateTotalAmount();
            }
        }

        // Increment room count
        function incrementRooms() {
            if (currentRoomCount < maxAvailableRooms) {
                currentRoomCount++;
                updateRoomCount();
            }
        }

        // Decrement room count
        function decrementRooms() {
            if (currentRoomCount > 1) {
                currentRoomCount--;
                updateRoomCount();
            }
        }

        // Update room count UI
        function updateRoomCount() {
            const roomCountElement = document.getElementById('roomCount');
            const selectedRoomCountElement = document.getElementById('selectedRoomCount');
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');

            roomCountElement.textContent = currentRoomCount;
            selectedRoomCountElement.textContent = `${currentRoomCount} Room${currentRoomCount !== 1 ? 's' : ''}`;

            // Update button states
            decrementBtn.disabled = currentRoomCount <= 1;
            incrementBtn.disabled = currentRoomCount >= maxAvailableRooms;

            calculateTotalAmount();
        }

        // Calculate total booking amount
        function calculateTotalAmount() {
            const totalPrice = numberOfNights * pricePerNight * currentRoomCount;
            document.getElementById('totalAmount').textContent = `${totalPrice.toFixed(2)} LKR`;
        }

        // Continue to guest details tab
        function continueToGuestDetails() {
            // Enable guest details tab
            document.getElementById('guestDetailsTabBtn').disabled = false;

            // Switch to guest details tab
            switchBookingTab({ currentTarget: document.getElementById('guestDetailsTabBtn') }, 'guestDetails');

            // Initialize payment status change event
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

        // Switch between tabs in booking modal
        function switchBookingTab(event, tabId) {
            // Get all tab buttons and contents
            const tabButtons = document.querySelectorAll('#bookRoomModal .tab-button');
            const tabContents = document.querySelectorAll('#bookRoomModal .tab-content');

            // Remove active class from all buttons and contents
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });

            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            // Add active class to clicked button and corresponding content
            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');

            // Adjust confirm button visibility
            const confirmBookingBtn = document.getElementById('confirmBookingBtn');
            if (tabId === 'guestDetails') {
                confirmBookingBtn.style.display = 'inline-flex';
            } else {
                confirmBookingBtn.style.display = 'none';
            }
        }

        // Confirm the direct booking
        function confirmDirectBooking() {
            // Validate guest information
            // if (!validateGuestInformation()) {
            //     return;
            // }

            // Prepare form data
            document.getElementById('booking_roomType_id').value = currentRoomTypeId;
            document.getElementById('booking_checkIn_date').value = document.getElementById('checkIn').value;
            document.getElementById('booking_checkOut_date').value = document.getElementById('checkOut').value;
            document.getElementById('booking_room_count').value = currentRoomCount;
            document.getElementById('booking_total_amount').value = document.getElementById('totalAmount').textContent.replace(' LKR', '');

            document.getElementById('booking_guest_name').value = document.getElementById('guestFullName').value;
            document.getElementById('booking_guest_email').value = document.getElementById('guestEmail').value;
            document.getElementById('booking_guest_phone').value = document.getElementById('guestPhone').value;
            document.getElementById('booking_guest_nic').value = document.getElementById('guestNIC').value;
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

            // Submit form
            document.getElementById('directBookingForm').submit();
        }

        // Validate guest information
        function validateGuestInformation() {
            let isValid = true;

            // Clear all previous error messages
            document.querySelectorAll('.error-message').forEach(element => {
                element.remove();
            });

            // Reset all input borders
            document.querySelectorAll('.guest-input').forEach(input => {
                input.classList.remove('error');
            });

            // Validate full name
            const fullName = document.getElementById('guestFullName');
            if (!fullName.value.trim()) {
                showValidationError(fullName, 'Guest full name is required');
                isValid = false;
            }

            // Validate email
            const email = document.getElementById('guestEmail');
            if (!email.value.trim()) {
                showValidationError(email, 'Email address is required');
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showValidationError(email, 'Please enter a valid email address');
                isValid = false;
            }

            // Validate phone
            const phone = document.getElementById('guestPhone');
            if (!phone.value.trim()) {
                showValidationError(phone, 'Phone number is required');
                isValid = false;
            }

            // Validate NIC/Passport
            const nic = document.getElementById('guestNIC');
            if (!nic.value.trim()) {
                showValidationError(nic, 'NIC or passport number is required');
                isValid = false;
            }
        }
    </script>
</body>

</html>