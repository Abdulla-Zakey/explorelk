<?php
    $newGuides = $data['newGuides'];
    $newHotels = $data['newHotels'];
    $newEventOrganizers = $data['newEventOrganizers'];
    // show($newEventOrganizers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/newRegistrations.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <title>ExploreLK</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="admin-container">

        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>

        <!-- Main Content -->
        <div class="main-content">
            <h1>New Registrations</h1>

            <!-- Filter Buttons -->
            <div class="filter-container">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-list"></i> All
                    <span
                        class="filter-badge"><?= count($newGuides) + count($newEventOrganizers) + count($newHotels) ?></span>
                </button>
                <button class="filter-btn" data-filter="tour-guide">
                    <i class="fas fa-hiking"></i> Tour Guides
                    <span class="filter-badge"><?= count($newGuides) ?></span>
                </button>
                <button class="filter-btn" data-filter="hotel">
                    <i class="fas fa-hotel"></i> Hotels
                    <span class="filter-badge"><?= count($newHotels) ?></span>
                </button>
                <button class="filter-btn" data-filter="restaurant">
                    <i class="fas fa-utensils"></i> Restaurants
                    <span class="filter-badge">0</span>
                </button>
                <button class="filter-btn" data-filter="transport">
                    <i class="fas fa-car"></i> Transport
                    <span class="filter-badge">0</span>
                </button>
                <button class="filter-btn" data-filter="event-organizer">
                    <i class="fas fa-monument"></i> Event Organizer
                    <span class="filter-badge"><?= count($newEventOrganizers) ?></span>
                </button>
            </div>

            <!-- Registrations Card -->
            <div class="newRegistrations-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Contact</th>
                                <th>Registered</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="registrations-table-body">
                            <!-- Tour Guide -->
                            <?php foreach($newGuides as $newGuide): ?>
                            <tr class="registration-row" data-type="tour-guide">
                                <td><?= $newGuide->guide_Id ?></td>
                                <td><?= $newGuide->firstName . ' ' . $newGuide->lastName ?></td>
                                <td><i class="fas fa-hiking"></i> Tour Guide</td>
                                <td>
                                    <div><?= $newGuide->email ?></div>
                                    <small><?= $newGuide->mobileNum ?></small>
                                </td>
                                <td>May 15, 2023</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn"
                                        onclick="openModal('tour-guide-modal', <?= $newGuide->guide_Id ?>)">
                                        <i class="fas fa-eye">&nbsp;</i> View
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <!-- Hotel -->
                            <?php foreach($newHotels as $newHotel): ?>
                            <tr class="registration-row" data-type="hotel">
                                <td><?= $newHotel->hotel_Id; ?></td>
                                <td><?= $newHotel->hotelName; ?></td>
                                <td><i class="fas fa-hotel"></i> Hotel</td>
                                <td>
                                    <div><?= $newHotel->hotelEmail; ?></div>
                                    <small><?= $newHotel->hotelMobileNum ?></small>
                                </td>
                                <td>May 18, 2023</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn"
                                        onclick="openModal('hotel-modal', <?= $newHotel->hotel_Id ?>)">
                                        <i class="fas fa-eye">&nbsp;</i> View
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <!-- Event Organizer -->
                            <?php foreach($newEventOrganizers as $newEventOrganizer): ?>
                            <tr class="registration-row" data-type="event-organizer">
                                <td><?= $newEventOrganizer->organizer_Id; ?></td>
                                <td><?= $newEventOrganizer->company_Name; ?></td>
                                <td><i class="fas fa-icons"></i> Event Organizer</td>
                                <td>
                                    <div><?= $newEventOrganizer->company_Email; ?></div>
                                    <small><?= $newEventOrganizer->company_MobileNum ?></small>
                                </td>
                                <td>May 18, 2023</td>
                                <td><span class="badge badge-pending">Pending</span></td>
                                <td>
                                    <button class="action-btn view-btn"
                                        onclick="openModal('event-organizer-modal', <?= $newEventOrganizer->organizer_Id ?>)">
                                        <i class="fas fa-eye">&nbsp;</i> View
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- No results message -->
                    <div id="no-results" class="no-results" style="display: none;">
                        <i class="fas fa-search"></i> No pending registrations found for this category.
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
                        <div class="detail-value">May 15, 2023</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Status:</div>
                        <div class="detail-value"><span class="badge badge-pending">Pending Review</span></div>
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
    const guideData = <?= json_encode($newGuides) ?>;
    const hotelData = <?= json_encode($newHotels) ?>;
    const eventOrganizerData = <?= json_encode($newEventOrganizers) ?>;

    // Modal functions
    function openModal(modalId, itemId) {
        if (modalId === 'tour-guide-modal') {
            // Find the specific guide data
            const guide = guideData.find(g => g.guide_Id == itemId);

            if (guide) {
                const modal = document.getElementById(modalId);

                // Update basic information
                const detailValues = modal.querySelectorAll('.detail-section:nth-of-type(1) .detail-row .detail-value');
                detailValues[0].textContent = guide.firstName + ' ' + guide.lastName;
                detailValues[1].textContent = guide.guide_Id;
                detailValues[2].textContent = guide.email;
                detailValues[3].textContent = guide.mobileNum;

                // Update business details
                const businessValues = modal.querySelectorAll(
                    '.detail-section:nth-of-type(2) .detail-row .detail-value');
                businessValues[0].textContent = guide.guideLocation;
                businessValues[1].textContent = guide.guideBio;

                // Update approval/rejection buttons to use the correct ID
                const approveBtn = modal.querySelector('.btn-approve');
                const rejectBtn = modal.querySelector('.btn-reject');
                approveBtn.setAttribute('onclick', `approveProvider('${guide.guide_Id}','tourGuide')`);
                rejectBtn.setAttribute('onclick', `rejectProvider('${guide.guide_Id}','tourGuide')`);
            }
        } else if (modalId === 'hotel-modal') {
            // Find the specific hotel data
            const hotel = hotelData.find(h => h.hotel_Id == itemId);

            if (hotel) {
                const modal = document.getElementById(modalId);

                // Update basic information
                const detailValues = modal.querySelectorAll('.detail-section:nth-of-type(1) .detail-row .detail-value');
                detailValues[0].textContent = hotel.hotelName;
                detailValues[1].textContent = hotel.hotel_Id;
                detailValues[2].textContent = hotel.hotelEmail;
                detailValues[3].textContent = hotel.hotelMobileNum;

                // Update business details
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

                // Update approval/rejection buttons to use the correct ID
                const approveBtn = modal.querySelector('.btn-approve');
                const rejectBtn = modal.querySelector('.btn-reject');
                approveBtn.setAttribute('onclick', `approveProvider('${hotel.hotel_Id}')`);
                rejectBtn.setAttribute('onclick', `rejectProvider('${hotel.hotel_Id}')`);
            }
        } else if (modalId === 'event-organizer-modal') {
            // Find the specific hotel data
            const eventOrganizer = eventOrganizerData.find(eo => eo.organizer_Id == itemId);

            if (eventOrganizer) {
                const modal = document.getElementById(modalId);

                // Update basic information
                const detailValues = modal.querySelectorAll('.detail-section:nth-of-type(1) .detail-row .detail-value');
                detailValues[0].textContent = eventOrganizer.company_Name;
                detailValues[1].textContent = eventOrganizer.organizer_Id;
                detailValues[2].textContent = eventOrganizer.company_Email;
                detailValues[3].textContent = eventOrganizer.company_MobileNum;

                // Update business details
                const businessValues = modal.querySelectorAll(
                    '.detail-section:nth-of-type(2) .detail-row .detail-value');
                businessValues[0].textContent = eventOrganizer.company_Address;
                businessValues[1].textContent = "2022";
                businessValues[2].textContent = "Good description";

                // Update approval/rejection buttons to use the correct ID
                const approveBtn = modal.querySelector('.btn-approve');
                const rejectBtn = modal.querySelector('.btn-reject');
                approveBtn.setAttribute('onclick', `approveProvider('${eventOrganizer.organizer_Id}')`);
                rejectBtn.setAttribute('onclick', `rejectProvider('${eventOrganizer.organizer_Id}')`);
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

    // Action functions
    function approveProvider(id, provider) {
        if (confirm(`Are you sure you want to approve provider ${id}?`)) {
            window.location.href = '<?= ROOT ?>/admin/C_newRegistrations/approve?id=' + id + '&provider=' + provider;
            alert(`Provider ${id} has been approved successfully!`);
            closeModal();
            // You would typically do an AJAX call here to update the status in the database
            // Then remove the row from the table or update its status
        }
    }

    function rejectProvider(id, provider) {
        const reason = prompt(`Please enter reason for rejecting provider ${id}:`);
        if (reason) {
            const encodedReason = encodeURIComponent(reason);
            alert(`Provider ${id} has been rejected. Reason: ${reason}`);
            window.location.href =
                `<?= ROOT ?>/admin/C_newRegistrations/reject?id=${id}&provider=${provider}&reason=${encodedReason}`;
            
            closeModal();
        }
    }


    // Filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));

                // Add active class to clicked button
                this.classList.add('active');

                // Get filter type
                const filterType = this.getAttribute('data-filter');

                // Filter table rows
                filterRegistrations(filterType);
            });
        });

        // Initial filter (show all)
        filterRegistrations('all');
    });

    function filterRegistrations(filterType) {
        const rows = document.querySelectorAll('.registration-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowType = row.getAttribute('data-type');

            if (filterType === 'all' || rowType === filterType) {
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
    </script>
</body>

</html>