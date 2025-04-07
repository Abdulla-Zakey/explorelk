<?php
    include_once APPROOT . '/views/hotel/nav.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f8f9fa;
        }

        .hotel-header {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .container {
            position: relative;
            z-index: 20;
            margin-top: 15%; 
            margin-left: 250px;
            padding-bottom: 50px;
        }

        /* Empty State Styles */
        .empty-state {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50vh;
            padding: 2.5rem;
        }

        .empty-state-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 0px 10px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: #cfe2f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .icon-circle i {
            font-size: 2.5rem;
            color: #002D40;
        }

        .empty-state-title {
            color: #333;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .empty-state-description {
            color: #666;
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 2rem;
        }

        /* Table Container Styles */
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin: 20px auto;
            width: 95%;
            max-width: 1400px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 0 10px;
        }

        .table-title {
            font-size: 1.5rem;
            color: #002D40;
            font-weight: 600;
        }

        .table-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            padding: 0 10px;
        }

        .stat-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px 20px;
            flex: 1;
        }

        .stat-title {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.25rem;
            color: #002D40;
            font-weight: 600;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #e9ecef;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            color: #495057;
            vertical-align: middle;
            font-size: 0.95rem; 
        }

        tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s ease;
        }

        /* Room Type Cell Styles */
        .room-type-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .room-type-info {
            display: flex;
            flex-direction: column;
        }

        .room-type-name {
            font-weight: 600;
            color: #002D40;
            margin-bottom: 4px;
        }
        

        /* Price and Occupancy Badges */
        .price-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .occupancy-badge {
            background-color: #f3e5f5;
            color: #7b1fa2;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            min-width: 112.5px;
        }

        /* Status Indicators */
        .status-badge {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 500;
            text-align: center;
            width: fit-content;
        }

        .status-available {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-limited {
            background-color: #fff3e0;
            color: #ef6c00;
        }

        .status-full {
            background-color: #ffebee;
            color: #c62828;
        }

        /* Enhanced Button Styles */
        .enhanced-button {
            background-color: #002D40;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .enhanced-button:hover {
            background-color: #004666;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 45, 64, 0.15);
        }

        .enhanced-button.secondary {
            background-color: #e9ecef;
            color: #002D40;
        }

        .enhanced-button.secondary:hover {
            background-color: #dee2e6;
        }

        .action-buttons {
            display: flex;
            min-width: 375px;
            gap: 8px;
        }

        /* Description Cell Styling */
        .description-cell {
            max-width: 275px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .description-cell:hover {
            white-space: normal;
            overflow: visible;
            background-color: white;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 10px;
        }

        /* Modal Styles */
        .custom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .model-container {
            background-color: #fff;
            border-radius: 20px;
            width: 90%;
            max-width: 800px;
            max-height: 85vh;
            overflow: hidden;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            background-color: #f8f9fa;
            padding: 20px 30px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            color: #002D40;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .modal-body {
            padding: 30px;
            overflow-y: auto;
            max-height: calc(85vh - 150px);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-full-width {
            grid-column: 1 / -1;
        }

        .form-group {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-group:hover {
            border-color: #002D40;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group:last-child {
            margin-bottom: 0;
        }

        .input-label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .input-required {
            color: #dc3545;
            margin-left: 4px;
        }

        .input-helper {
            display: block;
            margin-top: 5px;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .editable-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
        }

        .editable-input:focus {
            outline: none;
            border-color: #002D40;
            box-shadow: 0 0 0 3px rgba(0, 45, 64, 0.1);
        }

        .editable-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            min-height: 120px;
            resize: none;
            transition: all 0.3s ease;
            background-color: white;
        }

        .editable-textarea:focus {
            outline: none;
            border-color: #002D40;
            box-shadow: 0 0 0 3px rgba(0, 45, 64, 0.1);
        }

        .file-upload-container {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-container:hover {
            border-color: #002D40;
            background-color: #f8f9fa;
        }

        .file-upload-icon {
            font-size: 2rem;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .file-upload-text {
            color: #495057;
            margin-bottom: 5px;
        }

        .file-upload-helper {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .modal-footer {
            padding: 20px 30px;
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .closebutton {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
            padding: 5px;
        }

        .closebutton:hover {
            color: #dc3545;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .model-container {
                width: 95%;
                margin: 10px;
            }
        }

        /* New styles for room management */
        .room-count-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .room-badge {
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .room-actions {
            display: flex;
            gap: 5px;
        }

        /* Add Room Modal specific styles */
        .room-form-section {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .room-numbers-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }

        .room-input-group {
            position: relative;
        }

        .room-number-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .remove-room-btn {
            position: absolute;
            right: -8px;
            top: -8px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-room-number-btn {
            width: 100%;
            margin-top: 12.5px;
            padding: 8px;
            background-color: #e9ecef;
            border: 2px dashed #ced4da;
            border-radius: 6px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .add-room-number-btn:hover {
            background-color: #dee2e6;
            border-color: #002D40;
        }

        .room-features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .feature-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feature-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        /* Modified and new styles */
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .amenity-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background-color: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .amenity-checkbox:hover {
            border-color: #002D40;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .amenity-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        .amenity-checkbox i {
            width: 20px;
            color: #002D40;
        }

        .room-numbers-section {
            margin-top: 20px;
        }

        .room-numbers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .room-number-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .room-number-input:focus {
            border-color: #002D40;
            box-shadow: 0 0 0 3px rgba(0, 45, 64, 0.1);
        }

        .add-room-button {
            width: 100%;
            padding: 10px;
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
            border-radius: 8px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .add-room-button:hover {
            background-color: #e9ecef;
            border-color: #002D40;
        }

        /* Pop-up container (initially hidden) */
        .popup-container {
            font-size: 1.35rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Dark transparent overlay */
            display: none; /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 999; /* Above other content */
        }

        /* Tab Navigation Styles */
.details-tabs {
    display: flex;
    gap: 10px;
    border-bottom: 1px solid #e9ecef;
    padding: 0 20px;
    margin-bottom: 20px;
}

.tab-button {
    padding: 12px 20px;
    border: none;
    background: none;
    color: #6c757d;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    position: relative;
    transition: all 0.3s ease;
}

.tab-button i {
    margin-right: 8px;
}

.tab-button.active {
    color: #002D40;
}

.tab-button.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: #002D40;
}

/* Tab Content Styles */
.tab-content {
    display: none;
    padding: 20px;
}

.tab-content.active {
    display: block;
}

/* Room Type Details Styles */
.room-type-details {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
}

.room-image-container {
    width: 100%;
    border-radius: 12px;
    overflow: hidden;
}

.room-image-container img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.detail-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
}

.detail-item.full-width {
    grid-column: 1 / -1;
}

.detail-label {
    display: block;
    color: #002D40;
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.detail-value {
    color: #6c757d;
    font-weight: 500;
}

/* Rooms Grid Styles */
.rooms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 15px;
}

.room-card {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
}

.room-number {
    font-size: 1.1rem;
    font-weight: 600;
    color: #002D40;
}

.room-status {
    font-size: 0.9rem;
    margin-top: 5px;
}

.room-status.available {
    color: #2e7d32;
}

.room-status.occupied {
    color: #c62828;
}

/* Amenities List Styles */
.amenities-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.amenity-tag {
    background: #e3f2fd;
    color: #1976d2;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.amenity-tag i {
    font-size: 1rem;
}

@media (max-width: 768px) {
    .room-type-details {
        grid-template-columns: 1fr;
    }
}

        /* Pop-up content */
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            font-size: 16px;
        }

        /* Close button */
        .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        /* Blur background effect when pop-up is visible */
        .blur {
            filter: blur(5px);
            pointer-events: none;
        }

    </style>
</head>

<body>
    <div class="hotel-header">
        <?php include_once APPROOT . '/views/hotel/hotelhead.php'; ?>
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
                        Start by adding your first room type. This will help you manage your hotel inventory and showcase your accommodations to guests.
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
                            foreach($data['hotelRoomTypes'] as $type): 
                        ?>
                        <tr>
                            <td>
                                <div class="room-type-cell">
                                    <div class="room-type-info">
                                        <div class="room-type-name"><?= $data['hotelRoomTypesNames'][$i]->roomType_name ?></div>
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
                                        <button class="enhanced-button secondary" onclick="showAddRoomModal(<?= $type->hotel_roomType_Id ?>)">
                                            <i class="fas fa-plus"></i>
                                            Add Rooms
                                        </button>

                                    <button class="enhanced-button secondary" onclick="showRoomDetails(<?= $type->hotel_roomType_Id ?>)">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>
                                    <button class="enhanced-button secondary" onclick="confirmDeleteRoomType(<?= $type->hotel_roomType_Id ?>)">
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
                                    <?php foreach($data['commonlyAvailableRoomTypesForAllHotels'] as $type): ?>
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
                                <input type="number" 
                                       name="pricePer_night" 
                                       class="editable-input" 
                                       required 
                                       min="0" 
                                       step="0.01"
                                       placeholder="Enter price in Rs.">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-label">
                                    Maximum Occupancy
                                    <span class="input-required">*</span>
                                </label>
                                <input type="number" 
                                       name="max_occupancy" 
                                       class="editable-input" 
                                       required 
                                       min="1"
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
                                    <?php foreach($data['commonRoomAmenities'] as $amenity): ?>
                                    <label class="amenity-checkbox">
                                        <input type="checkbox" 
                                               name="amenities[]" 
                                               value="<?= $amenity->amenity_Id ?>">
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
                                <div class="file-upload-container" onclick="document.getElementById('roomTypeImage').click()">
                                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                    <div class="file-upload-text">Click to upload room type image</div>
                                    <div class="file-upload-helper">Supported formats: JPG, PNG, WEBP (Max size: 5MB)</div>
                                </div>
                                <input type="file" 
                                       id="roomTypeImage"
                                       name="roomTypeImage" 
                                       accept="image/*"
                                       style="display: none;"
                                       required>
                            </div>
                        </div>

                        <!-- Custom Description -->
                        <div class="form-group form-full-width">
                            <div class="input-group">
                                <label class="input-label">
                                    Room Type Description
                                    <span class="input-required">*</span>
                                </label>
                                <textarea name="customized_description" 
                                          class="editable-textarea"
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

            <form action = "<?= ROOT ?>/Hotel/Hmyrooms/addRooms" method="POST">
                <input type = "hidden" id="hotelRoomTypeId" name = "hotel_roomType_Id">
                
                <div class="modal-body">
                    <div class="room-form-section">
                        <h3>Room Numbers</h3>
                        <p class="input-helper">Add room numbers for this room type</p>
                        
                        <div class="room-numbers-container" id="roomNumbersContainer">
                            <div class="room-input-group">
                                <input type="text" name="room_numbers[]" class="room-number-input" placeholder="Room No." required>
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

    <!--View More details section-->
    <div class="custom-modal" id="viewDetailsModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title">Room Type Details</h2>
                <button class="closebutton" onclick="closeModal('viewDetailsModal')">&times;</button>
            </div>
        
            <div class="modal-body">
                <!-- Tab Navigation -->
                <div class="details-tabs">
                    <button class="tab-button active" onclick="switchTab(event, 'roomTypeInfo')">
                        <i class="fas fa-info-circle"></i> Room Type Details
                    </button>
                    <button class="tab-button" onclick="switchTab(event, 'roomsList')">
                        <i class="fas fa-bed"></i> Room Numbers
                    </button>
                </div>

                <!-- Room Type Details Tab -->
                <div id="roomTypeInfo" class="tab-content active">
                    <div class="room-type-details">
                        <div class="room-image-container">
                            <img id="roomTypeImage" src = "" alt="Room Type Image">
                        </div>
                        <div class="details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Room Type</span>
                                <span id="detailRoomType" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Price per Night</span>
                                <span id="detailPrice" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Max Occupancy</span>
                                <span id="detailOccupancy" class="detail-value"></span>
                            </div>
                            <div class="detail-item full-width">
                                <span class="detail-label">Description</span>
                                <p id="detailDescription" class="detail-value"></p>
                            </div>
                            <div class="detail-item full-width">
                                <span class="detail-label">Amenities</span>
                                <div id="detailAmenities" class="amenities-list"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room Numbers Tab -->
                <div id="roomsList" class="tab-content">
                    <div class="rooms-grid">
                        <!-- Room numbers will be populated here -->
                    </div>
                </div>
            </div>
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
            closePopup.onclick = function() {
                popup.style.display = "none";
            
            };
        }

        let currentRoomTypeToDelete = null;

        function confirmDeleteRoomType(roomTypeId) {
            currentRoomTypeToDelete = roomTypeId;
            const popup = document.getElementById('popup');
            const popupText = document.getElementById('popup-text');
            const confirmButton = document.getElementById('confirmDelete');
            const cancelButton = document.getElementById('closePopup');

            popupText.textContent = 'Are you sure you want to delete this room type?';
            popup.style.display = 'flex';

            confirmButton.onclick = function() {
                popup.style.display = 'none';
                proceedDeleteRoomType();
            };

            cancelButton.onclick = function() {
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
            }
            else if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                $messageToShow = implode(', ', $_SESSION['success']);
                var_dump($_SESSION['success']);
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

        window.onclick = function(event) {
            if (event.target.classList.contains('custom-modal')) {
                event.target.style.display = 'none';
            }
        }

        document.getElementById('roomTypeImage').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                const container = document.querySelector('.file-upload-text');
                container.textContent = `Selected file: ${fileName}`;
            }
        });
    </script>

    <script>
        function showRoomDetails(hotelRoomTypeId) {
            fetch(`<?= ROOT ?>/Hotel/Hmyrooms/getRoomTypeDetails/${hotelRoomTypeId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Populate modal with data
                console.log('Parsed data:', data);
                document.getElementById('detailRoomType').textContent = data.roomType_name;
                document.getElementById('detailPrice').textContent = `Rs.${data.pricePer_night.toFixed(2)}`;
                document.getElementById('detailOccupancy').textContent = `${data.max_occupancy} Guests`;
                document.getElementById('detailDescription').textContent = data.customized_description;

                // Populate amenities
                const amenitiesContainer = document.getElementById('detailAmenities');
                amenitiesContainer.innerHTML = data.amenities.map(amenity => `
                    <div class="amenity-tag">
                        <i class="${amenity.icon_class}"></i>
                        ${amenity.amenity_name}
                    </div>
                `).join('');

                // Populate rooms grid
                const roomsGrid = document.querySelector('.rooms-grid');
                roomsGrid.innerHTML = data.rooms.map(room => `
                    <div class="room-card">
                        <div class="room-number">${room.room_number}</div>
                        <div class="room-status ${room.status ? room.status.toLowerCase() : 'available'}">
                            ${room.status || 'Available'}
                        </div>
                    </div>
                `).join('');

                // Show modal
                document.getElementById('viewDetailsModal').style.display = 'flex';

                if (data.image_url) {
                    const imageElement = document.getElementById('roomTypeImage');
                    const imageUrl = data.image_url.startsWith('/') 
                        ? `<?= ROOT ?>${data.image_url}`
                        : `<?= ROOT ?>/${data.image_url}`;

                        // Clear any previous image
                        imageElement.src = '';
                
                        imageElement.onerror = function(e) {
                            console.error('Image load error:', e);
                        };

                        imageElement.onload = function() {
                            console.log('Image loaded successfully:');
                        };

                        // Set new image source
                        imageElement.src = imageUrl;
                    }

            })
    
            .catch(error => {
                console.error('Error fetching room details:', error);
                showAlert('Failed to load room details. Please try again.');
            });
        }
        
        function switchTab(event, tabId) {
            // Remove active class from all tabs and content
            document.querySelectorAll('.tab-button').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
    
            // Add active class to clicked tab and corresponding content
            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>

</body>
</html>