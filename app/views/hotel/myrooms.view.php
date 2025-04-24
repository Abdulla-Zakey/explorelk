<?php
    include_once APPROOT . '/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/myrooms.css?v=1.0">
 
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