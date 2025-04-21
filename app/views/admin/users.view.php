<!DOCTYPE html>
<html lang="en">

<head>
    <title>ExploreLK Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/newRegistrations.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <style>
    /* Additional styling for Users page */
    .filter-container {
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        margin-bottom: 20px;
        gap: 10px;
    }

    .search-input {
        flex-grow: 1;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-family: 'Poppins', sans-serif;
    }

    .search-btn {
        background-color: #4361ee;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background-color: #3a56d4;
    }

    .detail-button {
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        font-size: 0.8em;
        font-weight: 500;
        cursor: pointer;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    /* Updated button colors */
    .btn-approve {
        background-color: #10b981;
        /* Green color for enable */
        color: white;
    }

    .btn-approve:hover {
        background-color: #059669;
    }

    .btn-reject {
        background-color: #ef4444;
        /* Red color for disable */
        color: white;
    }

    .btn-reject:hover {
        background-color: #dc2626;
    }

    /* User type badge */
    .user-type {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 0.8em;
        font-weight: 500;
        color: white;
        color: black;
    }

    .user-type i {
        margin-right: 5px;
        color: black;
    }

    .user-type.traveller {
        /* background-color: #8b5cf6; Purple for travelers */
    }

    .user-type.guide {
        /* background-color: #f59e0b; Amber for tour guides */
    }

    .user-type.hotel {
        /* background-color: #3b82f6; Blue for hotels */
    }

    .user-type.organizer {
        /* background-color: #10b981; Green for organizers */
    }

    /* Show no results message with better styling */
    .no-results {
        padding: 30px;
        text-align: center;
        color: #6c757d;
        font-style: italic;
        background-color: #f8f9fa;
        border-radius: 5px;
        margin-top: 20px;
    }

    /* Fix the admin container layout */
    .admin-container {
        display: flex;
        width: 100%;
    }

    .body-container {
        flex-grow: 1;
        padding: 2%;
        margin-left: 20%;
    }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="main-content">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <h1>Users</h1>

            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search User" class="search-input">
                <button class="search-btn"><i class="fa fa-search"></i> Search</button>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-list"></i> All Users
                    <span
                        class="filter-badge"><?= count($data['travelers']) + count($data['tourGuides']) + count($data['hotels']) + count($data['organizers']) ?></span>
                </button>
                <button class="filter-btn" data-filter="guide">
                    <i class="fas fa-hiking"></i> Tour Guides
                    <span class="filter-badge"><?= count($data['tourGuides']) ?></span>
                </button>
                <button class="filter-btn" data-filter="traveller">
                    <i class="fas fa-user"></i> Travellers
                    <span class="filter-badge"><?= count($data['travelers']) ?></span>
                </button>
                <button class="filter-btn" data-filter="hotel">
                    <i class="fas fa-hotel"></i> Hotels
                    <span class="filter-badge"><?= count($data['hotels']) ?></span>
                </button>
                <button class="filter-btn" data-filter="organizer">
                    <i class="fas fa-monument"></i> Event Organizers
                    <span class="filter-badge"><?= count($data['organizers']) ?></span>
                </button>
            </div>

            <!-- Users Card -->
            <div class="newRegistrations-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="users-table-body">
                            <!-- Travelers -->
                            <?php if(!empty($data['travelers'])): 
                                foreach($data['travelers'] as $traveler): ?>
                            <tr class="registration-row" data-user-type="traveller">
                                <td><i class="fas fa-user-circle"></i></td>
                                <td><?= htmlspecialchars($traveler->traveler_Id) ?></td>
                                <td><?= htmlspecialchars($traveler->travelerEmail) ?></td>
                                <td><?= htmlspecialchars($traveler->fName) . " " . htmlspecialchars($traveler->lName) ?>
                                </td>
                                <td>
                                    <span class="user-type traveller">
                                        <i class="fas fa-user"></i> Traveller
                                    </span>
                                </td>
                                <td>
                                    <button class="action-btn view-btn">
                                        <i class="fas fa-eye">&nbsp;</i> Detail
                                    </button>
                                    <button onclick="<?= $traveler->status === 'enabled' ? 
                                        "disableUser('{$traveler->traveler_Id}', '{$traveler->status}', 'traveler')" : 
                                        "enableUser('{$traveler->traveler_Id}', '{$traveler->status}', 'traveler')"?>"
                                        class="action-btn <?= $traveler->status === 'enabled' ? 'btn-reject' : 'btn-approve' ?>"
                                        data-status="<?= htmlspecialchars($traveler->status) ?>">
                                        <i
                                            class="fas <?= $traveler->status === 'enabled' ? 'fa-times' : 'fa-check' ?>">&nbsp;</i>
                                        <?= $traveler->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach;
                            endif; ?>

                            <!-- Tour Guides -->
                            <?php if(!empty($data['tourGuides'])): 
                                foreach($data['tourGuides'] as $guide): ?>
                            <tr class="registration-row" data-user-type="guide">
                                <td><i class="fas fa-hiking"></i></td>
                                <td><?= htmlspecialchars($guide->guide_Id) ?></td>
                                <td><?= htmlspecialchars($guide->email) ?></td>
                                <td><?= htmlspecialchars($guide->firstName) . " " . htmlspecialchars($guide->lastName) ?>
                                </td>
                                <td>
                                    <span class="user-type guide">
                                        <i class="fas fa-hiking"></i> Tour Guide
                                    </span>
                                </td>
                                <td>
                                    <button class="action-btn view-btn"
                                        onclick="openModal('tour-guide-modal', '<?= $guide->guide_Id ?>')">
                                        <i class="fas fa-eye">&nbsp;</i> Detail
                                    </button>
                                    <button onclick="<?= $guide->status === 'enabled' ? 
                                        "disableUser('{$guide->guide_Id}', '{$guide->status}', 'guide')" : 
                                        "enableUser('{$guide->guide_Id}', '{$guide->status}', 'guide')"?>"
                                        class="action-btn <?= $guide->status === 'enabled' ? 'btn-reject' : 'btn-approve' ?>"
                                        data-status="<?= htmlspecialchars($guide->status) ?>">
                                        <i
                                            class="fas <?= $guide->status === 'enabled' ? 'fa-times' : 'fa-check' ?>">&nbsp;</i>
                                        <?= $guide->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach;
                            endif; ?>

                            <!-- Hotels -->
                            <?php if(!empty($data['hotels'])): 
                                foreach($data['hotels'] as $hotel): ?>
                            <tr class="registration-row" data-user-type="hotel">
                                <td><i class="fas fa-hotel"></i></td>
                                <td><?= htmlspecialchars($hotel->hotel_Id) ?></td>
                                <td><?= htmlspecialchars($hotel->hotelEmail) ?></td>
                                <td><?= htmlspecialchars($hotel->hotelName) ?></td>
                                <td>
                                    <span class="user-type hotel">
                                        <i class="fas fa-hotel"></i> Hotel
                                    </span>
                                </td>
                                <td>
                                    <button class="action-btn view-btn"
                                        onclick="openModal('hotel-modal', '<?= $hotel->hotel_Id  ?>')">
                                        <i class="fas fa-eye">&nbsp;</i> Detail
                                    </button>
                                    <button onclick="<?= $hotel->status === 'enabled' ? 
                                        "disableUser('{$hotel->hotel_Id}', '{$hotel->status}', 'hotel')" : 
                                        "enableUser('{$hotel->hotel_Id}', '{$hotel->status}', 'hotel')"?>"
                                        class="action-btn <?= $hotel->status === 'enabled' ? 'btn-reject' : 'btn-approve' ?>"
                                        data-status="<?= htmlspecialchars($hotel->status) ?>">
                                        <i
                                            class="fas <?= $hotel->status === 'enabled' ? 'fa-times' : 'fa-check' ?>">&nbsp;</i>
                                        <?= $hotel->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach;
                            endif; ?>

                            <!-- Event Organizers -->
                            <?php if(!empty($data['organizers'])): 
                                foreach($data['organizers'] as $organizer): ?>
                            <tr class="registration-row" data-user-type="organizer">
                                <td><i class="fas fa-monument"></i></td>
                                <td><?= htmlspecialchars($organizer->organizer_Id) ?></td>
                                <td><?= htmlspecialchars($organizer->company_Email) ?></td>
                                <td><?= htmlspecialchars($organizer->company_Name) ?></td>
                                <td>
                                    <span class="user-type organizer">
                                        <i class="fas fa-monument"></i> Event Organizer
                                    </span>
                                </td>
                                <td>
                                    <button class="action-btn view-btn"
                                        onclick="openModal('event-organizer-modal', '<?= $organizer->organizer_Id ?>')">
                                        <i class="fas fa-eye">&nbsp;</i> Detail
                                    </button>
                                    <button
                                        onclick="<?= $organizer->status === 'enabled' ? 
                                        "disableUser('{$organizer->organizer_Id}', '{$organizer->status}', 'eventOrganizer')" : 
                                        "enableUser('{$organizer->organizer_Id}', '{$organizer->status}', 'eventOrganizer')"?>"
                                        class="action-btn <?= $organizer->status === 'enabled' ? 'btn-reject' : 'btn-approve' ?>"
                                        data-status="<?= htmlspecialchars($organizer->status) ?>">
                                        <i
                                            class="fas <?= $organizer->status === 'enabled' ? 'fa-times' : 'fa-check' ?>">&nbsp;</i>
                                        <?= $organizer->status === 'enabled' ? 'Disable' : 'Enable' ?>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>

                    <!-- No results message -->
                    <div id="no-results" class="no-results" style="display: none;">
                        <i class="fas fa-search"></i> No users found for this category.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tour Guide Modal -->
    <div id="tour-guide-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tour Guide Details</h3>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="detail-section">
                    <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Registration ID:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Contact Email:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Phone Number:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Registration Date:</div>
                        <div class="detail-value"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status:</div>
                        <div class="detail-value"><span class="badge badge-pending"></span></div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3><i class="fas fa-briefcase"></i> Business Details</h3>
                    <div class="detail-row">
                        <div class="detail-label">Business Address:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Description:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-approve">
                    <i class="fas fa-check"></i> Approve
                </button>
                <button class="btn btn-reject">
                    <i class="fas fa-times"></i> Reject
                </button>
            </div>
        </div>
    </div>

    <!-- Hotel Modal -->
    <div id="hotel-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Hotel Details</h3>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="detail-section">
                    <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
                    <div class="detail-row">
                        <div class="detail-label">Hotel Name:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Registration ID:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Contact Email:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Phone Number:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="detail-section">
                    <h3><i class="fas fa-briefcase"></i> Business Details</h3>
                    <div class="detail-row">
                        <div class="detail-label">Business Address:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">District:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Total Rooms:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Business Registration No:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Year Started:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Description:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-approve">
                    <i class="fas fa-check"></i> Approve
                </button>
                <button class="btn btn-reject">
                    <i class="fas fa-times"></i> Reject
                </button>
            </div>
        </div>
    </div>

    <!-- Event Organizer Modal -->
    <div id="event-organizer-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Event Organizer Details</h3>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="detail-section">
                    <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
                    <div class="detail-row">
                        <div class="detail-label">Name:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Registration ID:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Contact Email:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Phone Number:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="detail-section">
                    <h3><i class="fas fa-briefcase"></i> Business Details</h3>
                    <div class="detail-row">
                        <div class="detail-label">Company Address:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Year Started:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Description:</div>
                        <div class="detail-value">
                            <!-- Will be populated by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-approve">
                    <i class="fas fa-check"></i> Approve
                </button>
                <button class="btn btn-reject">
                    <i class="fas fa-times"></i> Reject
                </button>
            </div>
        </div>
    </div>

    <script>
    // Store data in JavaScript objects
    const guideData = <?= json_encode($data['tourGuides']) ?>;
    const hotelData = <?= json_encode($data['hotels']) ?? json_encode([]) ?>;
    const eventOrganizerData = <?= json_encode($data['organizers']) ?? json_encode([]) ?>;

    // Modal functions
    // Modify the openModal function for each modal type

    function openModal(modalId, itemId) {
        if (modalId === 'tour-guide-modal') {
            // Find the specific guide data
            const guide = guideData.find(g => g.guide_Id == itemId);

            if (guide) {
                const modal = document.getElementById(modalId);

                // Update basic information - keeping your existing code
                const detailValues = modal.querySelectorAll('.detail-section:nth-of-type(1) .detail-row .detail-value');
                detailValues[0].textContent = guide.firstName + ' ' + guide.lastName;
                detailValues[1].textContent = guide.guide_Id;
                detailValues[2].textContent = guide.email;
                detailValues[3].textContent = guide.mobileNum;
                detailValues[4].textContent = guide.registrationDate || 'Not available';

                // Current status of the user
                const statusElement = detailValues[5];
                statusElement.innerHTML = '';
                const statusBadge = document.createElement('span');
                statusBadge.className = `badge ${guide.status === 'enabled' ? 'badge-success' : 'badge-pending'}`;
                statusBadge.textContent = guide.status === 'enabled' ? 'Enabled' : 'Disabled';
                statusElement.appendChild(statusBadge);

                // Update business details - keeping your existing code
                const businessValues = modal.querySelectorAll(
                    '.detail-section:nth-of-type(2) .detail-row .detail-value');
                businessValues[0].textContent = guide.guideLocation;
                businessValues[1].textContent = guide.guideBio;

                // Update footer with a single button that's either enable or disable
                const modalFooter = modal.querySelector('.modal-footer');
                modalFooter.innerHTML = ''; // Clear existing buttons

                const actionButton = document.createElement('button');

                if (guide.status === 'enabled') {
                    actionButton.className = 'btn btn-reject';
                    actionButton.innerHTML = '<i class="fas fa-times"></i> Disable';
                    actionButton.onclick = function() {
                        disableUser(guide.guide_Id, guide.status, 'guide');
                    };
                } else {
                    actionButton.className = 'btn btn-approve';
                    actionButton.innerHTML = '<i class="fas fa-check"></i> Enable';
                    actionButton.onclick = function() {
                        enableUser(guide.guide_Id, guide.status, 'guide');
                    };
                }

                modalFooter.appendChild(actionButton);
            }
        } else if (modalId === 'hotel-modal') {
            // Find the specific hotel data
            const hotel = hotelData.find(h => h.hotel_Id == itemId);

            if (hotel) {
                const modal = document.getElementById(modalId);

                // Update basic information - keeping your existing code
                const detailValues = modal.querySelectorAll('.detail-section:nth-of-type(1) .detail-row .detail-value');
                detailValues[0].textContent = hotel.hotelName;
                detailValues[1].textContent = hotel.hotel_Id;
                detailValues[2].textContent = hotel.hotelEmail;
                detailValues[3].textContent = hotel.hotelMobileNum;

                // Update business details - keeping your existing code
                const businessValues = modal.querySelectorAll(
                    '.detail-section:nth-of-type(2) .detail-row .detail-value');
                businessValues[0].textContent = hotel.hotelAddress;
                businessValues[1].textContent = hotel.district;
                businessValues[2].textContent = hotel.totalRooms;
                businessValues[3].textContent = hotel.BRNum;
                businessValues[4].textContent = hotel.yearStarted;

                // Format description with paragraphs
                let description = hotel.description_para1;
                if (hotel.description_para2) {
                    description += '<br><br>' + hotel.description_para2;
                }
                if (hotel.description_para3) {
                    description += '<br><br>' + hotel.description_para3;
                }
                businessValues[5].innerHTML = description;

                // Update footer with a single button that's either enable or disable
                const modalFooter = modal.querySelector('.modal-footer');
                modalFooter.innerHTML = ''; // Clear existing buttons

                const actionButton = document.createElement('button');

                if (hotel.status === 'enabled') {
                    actionButton.className = 'btn btn-reject';
                    actionButton.innerHTML = '<i class="fas fa-times"></i> Disable';
                    actionButton.onclick = function() {
                        disableUser(hotel.hotel_Id, hotel.status, 'hotel');
                    };
                } else {
                    actionButton.className = 'btn btn-approve';
                    actionButton.innerHTML = '<i class="fas fa-check"></i> Enable';
                    actionButton.onclick = function() {
                        enableUser(hotel.hotel_Id, hotel.status, 'hotel');
                    };
                }

                modalFooter.appendChild(actionButton);
            }
        } else if (modalId === 'event-organizer-modal') {
            // Find the specific event organizer data
            const eventOrganizer = eventOrganizerData.find(eo => eo.organizer_Id == itemId);

            if (eventOrganizer) {
                const modal = document.getElementById(modalId);

                // Update basic information - keeping your existing code
                const detailValues = modal.querySelectorAll('.detail-section:nth-of-type(1) .detail-row .detail-value');
                detailValues[0].textContent = eventOrganizer.company_Name;
                detailValues[1].textContent = eventOrganizer.organizer_Id;
                detailValues[2].textContent = eventOrganizer.company_Email;
                detailValues[3].textContent = eventOrganizer.company_MobileNum;

                // Update business details - keeping your existing code
                const businessValues = modal.querySelectorAll(
                    '.detail-section:nth-of-type(2) .detail-row .detail-value');
                businessValues[0].textContent = eventOrganizer.company_Address;
                businessValues[1].textContent = "2022";
                businessValues[2].textContent = "Good description";

                // Update footer with a single button that's either enable or disable
                const modalFooter = modal.querySelector('.modal-footer');
                modalFooter.innerHTML = ''; // Clear existing buttons

                const actionButton = document.createElement('button');

                if (eventOrganizer.status === 'enabled') {
                    actionButton.className = 'btn btn-reject';
                    actionButton.innerHTML = '<i class="fas fa-times"></i> Disable';
                    actionButton.onclick = function() {
                        disableUser(eventOrganizer.organizer_Id, eventOrganizer.status, 'eventOrganizer');
                    };
                } else {
                    actionButton.className = 'btn btn-approve';
                    actionButton.innerHTML = '<i class="fas fa-check"></i> Enable';
                    actionButton.onclick = function() {
                        enableUser(eventOrganizer.organizer_Id, eventOrganizer.status, 'eventOrganizer');
                    };
                }

                modalFooter.appendChild(actionButton);
            }
        }

        // Show the modal
        document.getElementById(modalId).style.display = 'flex';
    }

    function closeModal() {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.style.display = 'none';
        });
    }

    // Close modal when clicking outside content
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            closeModal();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const searchInput = document.getElementById('searchInput');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');
                localStorage.setItem('activeTab', filterValue); // Save active tab
                filterTable(filterValue, searchInput.value);
            });
        });

        searchInput.addEventListener('input', function() {
            const activeFilter = document.querySelector('.filter-btn.active');
            const filterValue = activeFilter ? activeFilter.getAttribute('data-filter') : 'all';
            filterTable(filterValue, this.value);
        });

        function filterTable(filterValue, searchText) {
            const tableRows = document.querySelectorAll('.registration-row');
            const searchLower = searchText.toLowerCase();
            let visibleCount = 0;

            tableRows.forEach(row => {
                const userType = row.getAttribute('data-user-type');
                const text = row.textContent.toLowerCase();
                const matchesFilter = filterValue === 'all' || userType === filterValue;
                const matchesSearch = searchText === '' || text.includes(searchLower);

                if (matchesFilter && matchesSearch) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide no results message
            const noResultsDiv = document.getElementById('no-results');
            if (visibleCount === 0) {
                noResultsDiv.style.display = 'block';
            } else {
                noResultsDiv.style.display = 'none';
            }
        }

        // Load saved tab or default to 'all'
        const savedTab = localStorage.getItem('activeTab') || 'all';
        const targetButton = document.querySelector(`.filter-btn[data-filter="${savedTab}"]`);
        if (targetButton) {
            targetButton.click();
        } else {
            document.querySelector('.filter-btn[data-filter="all"]').click();
        }
    });

    function disableUser(userId, currentStatus, role) {
        Swal.fire({
            title: `Are you sure you want to disable this user?`,
            text: `The user will be disabled.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: `Yes, disable it!`
        }).then((result) => {
            if (result.isConfirmed) {
                const activeTab = document.querySelector('.filter-btn.active').getAttribute('data-filter');
                window.location.href =
                    `<?= ROOT ?>/admin/C_users/disableUser/${userId}/${role}?tab=${activeTab}`;
            }
        });
    }

    function enableUser(userId, currentStatus, role) {
        Swal.fire({
            title: `Are you sure you want to enable this user?`,
            text: `The user will be enabled.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10b981', // Green color matching our enable button
            cancelButtonColor: '#6c757d',
            confirmButtonText: `Yes, enable it!`
        }).then((result) => {
            if (result.isConfirmed) {
                const activeTab = document.querySelector('.filter-btn.active').getAttribute('data-filter');
                window.location.href =
                    `<?= ROOT ?>/admin/C_users/enableUser/${userId}/${role}?tab=${activeTab}`;
            }
        });
    }
    </script>
</body>

</html>