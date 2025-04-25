<?php
    $pendingTourGuideComplaints = $data['pendingTourGuideComplaints'];
    $resolvedTourGuideComplaints = $data['resolvedTourGuideComplaints'];
    $tourGuides = $data['tourGuides'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/complaints.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>
        <div class="main-content">
            <h1>Complaints Management</h1>

            <!-- Main Tabs -->
            <div class="complaints-tabs">
                <div class="complaints-tab active" onclick="switchTab('tourguide')">Tour Guide Complaints</div>
                <div class="complaints-tab" onclick="switchTab('traveler')">Traveler Complaints</div>
                <div class="complaints-tab" onclick="switchTab('hotel')">Hotel Complaints</div>
                <div class="complaints-tab" onclick="switchTab('event')">Event Organizer Complaints</div>
            </div>

            <!-- Sub Tabs -->
            <div class="complaints-sub-tabs">
                <div class="complaints-sub-tab active" onclick="switchSubTab('unresolved')">Unresolved</div>
                <div class="complaints-sub-tab" onclick="switchSubTab('resolved')">Resolved</div>
            </div>

            <!-- Tour Guide Complaints (Unresolved) -->
            <div class="complaints-table-container" id="tourguide-unresolved">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pendingTourGuideComplaints as $complaint): ?>
                        <tr>
                            <?php
                                $guideData = [];
                                foreach($tourGuides as $tourGuide){
                                    if ($tourGuide->guide_Id == $complaint->guide_id) {
                                        $guideData = $tourGuide;
                                        break;
                                    }
                                }
                            ?>
                            <td><?= $complaint->complaint_id ?></td>
                            <td><?= $complaint->date_submitted ?></td>
                            <td><?= $guideData->firstName . ' ' . $guideData->lastName ?></td>
                            <td><?= $complaint->subject ?></td>
                            <td>
                                <button class="btn action-btn btn-primary"
                                    onclick="openDetailModal(<?= htmlspecialchars(json_encode($complaint), ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars(json_encode($guideData), ENT_QUOTES, 'UTF-8') ?>, 'tourGuide')">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn action-btn btn-success"
                                    onclick="openResolveModal(<?= htmlspecialchars(json_encode($complaint), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="fas fa-check-circle"></i> Resolve
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Tour Guide Complaints (Resolved) -->
            <div class="complaints-table-container" id="tourguide-resolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resolvedTourGuideComplaints as $complaint): ?>
                        <tr>
                            <?php
                                $guideData = [];
                                foreach($tourGuides as $tourGuide){
                                    if ($tourGuide->guide_Id == $complaint->guide_id) {
                                        $guideData = $tourGuide;
                                        break;
                                    }
                                }
                            ?>
                            <td><?= $complaint->complaint_id ?></td>
                            <td><?= $complaint->date_submitted ?></td>
                            <td><?= $guideData->firstName . ' ' . $guideData->lastName ?></td>
                            <td><?= $complaint->subject ?></td>
                            <td>
                                <button class="btn action-btn btn-primary"
                                    onclick="openResolvedModal(<?= htmlspecialchars(json_encode($complaint), ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars(json_encode($guideData), ENT_QUOTES, 'UTF-8') ?>)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Traveler Complaints (Unresolved) -->
            <div class="complaints-table-container" id="traveler-unresolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CP2001</td>
                            <td>Apr 9, 2025</td>
                            <td>Adventure Tours</td>
                            <td>Tour Guide</td>
                            <td>Customer no-show</td>
                            <td><span class="status status-new">New</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(2001)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn action-btn btn-success" onclick="openResolveModal(2001)">
                                    <i class="fas fa-check-circle"></i> Resolve
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#CP2002</td>
                            <td>Apr 8, 2025</td>
                            <td>Mountain Guides</td>
                            <td>Tour Guide</td>
                            <td>Customer late arrival</td>
                            <td><span class="status status-inprogress">In Progress</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(2002)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn action-btn btn-success" onclick="openResolveModal(2002)">
                                    <i class="fas fa-check-circle"></i> Resolve
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Traveler Complaints (Resolved) -->
            <div class="complaints-table-container" id="traveler-resolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CP2003</td>
                            <td>Apr 3, 2025</td>
                            <td>City Explorers</td>
                            <td>Tour Guide</td>
                            <td>Payment dispute</td>
                            <td><span class="status status-resolved">Resolved</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(2003)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Hotel Complaints (Unresolved) -->
            <div class="complaints-table-container" id="hotel-unresolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CP3001</td>
                            <td>Apr 10, 2025</td>
                            <td>Beach Resort</td>
                            <td>Hotel</td>
                            <td>Customer damaged room</td>
                            <td><span class="status status-new">New</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(3001)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn action-btn btn-success" onclick="openResolveModal(3001)">
                                    <i class="fas fa-check-circle"></i> Resolve
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Hotel Complaints (Resolved) -->
            <div class="complaints-table-container" id="hotel-resolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CP3002</td>
                            <td>Apr 7, 2025</td>
                            <td>Mountain Lodge</td>
                            <td>Hotel</td>
                            <td>Noise complaint</td>
                            <td><span class="status status-resolved">Resolved</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(3002)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#CP3003</td>
                            <td>Apr 5, 2025</td>
                            <td>City Hotel</td>
                            <td>Hotel</td>
                            <td>Billing issue</td>
                            <td><span class="status status-resolved">Resolved</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(3003)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Event Organizer Complaints (Unresolved) -->
            <div class="complaints-table-container" id="event-unresolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CP4001</td>
                            <td>Apr 9, 2025</td>
                            <td>Wedding Planners</td>
                            <td>Event Organizer</td>
                            <td>Venue availability issue</td>
                            <td><span class="status status-inprogress">In Progress</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(4001)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <button class="btn action-btn btn-success" onclick="openResolveModal(4001)">
                                    <i class="fas fa-check-circle"></i> Resolve
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Event Organizer Complaints (Resolved) -->
            <div class="complaints-table-container" id="event-resolved" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#CP4002</td>
                            <td>Apr 4, 2025</td>
                            <td>Corporate Events</td>
                            <td>Event Organizer</td>
                            <td>Catering service issue</td>
                            <td><span class="status status-resolved">Resolved</span></td>
                            <td>
                                <button class="btn action-btn btn-primary" onclick="openDetailModal(4002)">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detail View Modal for Unresolved Complaints -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal">
            <div class="modal-header">
                <h2>Complaint Details</h2>
                <button class="modal-close" onclick="closeModal('detailModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-section">
                    <h3 class="detail-header">Basic Information</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Complaint ID</div>
                            <div class="detail-value" id="detail-id"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Date Submitted</div>
                            <div class="detail-value" id="detail-date"></div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3 class="detail-header">User Information</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Name</div>
                            <div class="detail-value" id="detail-name"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">User Type</div>
                            <div class="detail-value" id="detail-type"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value" id="detail-email"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value" id="detail-phone"></div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3 class="detail-header">Complaint Information</h3>
                    <div class="detail-item">
                        <div class="detail-label">Subject</div>
                        <div class="detail-value" id="detail-subject"></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Message</div>
                        <div class="complaint-message" id="detail-message"></div>
                    </div>
                </div>

                <div class="detail-section" id="booking-section" style="display: none;">
                    <h3 class="detail-header">Related Booking</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Booking ID</div>
                            <div class="detail-value" id="detail-booking"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Service Provider</div>
                            <div class="detail-value" id="detail-provider"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Booking Date</div>
                            <div class="detail-value" id="detail-book-date"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Amount</div>
                            <div class="detail-value" id="detail-amount"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="openResolveModal(currentComplaintData)">Resolve this
                    Complaint</button>
            </div>
        </div>
    </div>

    <!-- Resolve Modal -->
    <div class="modal-overlay" id="resolveModal">
        <div class="modal">
            <div class="modal-header">
                <h2>Resolve Complaint</h2>
                <button class="modal-close" onclick="closeModal('resolveModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-item">
                    <div class="detail-label">Complaint ID</div>
                    <div class="detail-value" id="resolve-id"></div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Subject</div>
                    <div class="detail-value" id="resolve-subject"></div>
                </div>

                <form id="resolveForm" action="<?= ROOT ?>/admin/C_complaints/resolve" method="POST">
                    <input type="hidden" name="complaint_id" id="complaint_id_input">

                    <div class="form-group">
                        <label for="resolution-details">Resolution Details</label>
                        <textarea name="resolution_details" id="resolution-details"
                            placeholder="Describe the resolution in detail..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="resolution-note">Internal Note (not visible to user)</label>
                        <textarea name="resolution_note" id="resolution-note"
                            placeholder="Add notes for internal reference..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="resolveComplaint()">Submit Resolution</button>
                <button class="btn btn-danger" onclick="closeModal('resolveModal')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Resolved Complaint Detail View Modal -->
    <div class="modal-overlay" id="resolvedDetailModal">
        <div class="modal">
            <div class="modal-header">
                <h2>Resolved Complaint Details</h2>
                <button class="modal-close" onclick="closeModal('resolvedDetailModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="status-badge resolved">
                    <i class="fas fa-check-circle"></i> Resolved
                </div>

                <div class="detail-section">
                    <h3 class="detail-header">Basic Information</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Complaint ID</div>
                            <div class="detail-value" id="resolved-detail-id"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Date Submitted</div>
                            <div class="detail-value" id="resolved-detail-date"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Date Resolved</div>
                            <div class="detail-value" id="resolved-date"></div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3 class="detail-header">User Information</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Name</div>
                            <div class="detail-value" id="resolved-detail-name"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">User Type</div>
                            <div class="detail-value" id="resolved-detail-type"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value" id="resolved-detail-email"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value" id="resolved-detail-phone"></div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3 class="detail-header">Complaint Information</h3>
                    <div class="detail-item">
                        <div class="detail-label">Subject</div>
                        <div class="detail-value" id="resolved-detail-subject"></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Message</div>
                        <div class="complaint-message" id="resolved-detail-message"></div>
                    </div>
                </div>

                <div class="detail-section" id="resolved-booking-section" style="display: none;">
                    <h3 class="detail-header">Related Booking</h3>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Booking ID</div>
                            <div class="detail-value" id="resolved-detail-booking"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Service Provider</div>
                            <div class="detail-value" id="resolved-detail-provider"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Booking Date</div>
                            <div class="detail-value" id="resolved-detail-book-date"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Amount</div>
                            <div class="detail-value" id="resolved-detail-amount"></div>
                        </div>
                    </div>
                </div>

                <div class="detail-section resolution-section">
                    <h3 class="detail-header">Resolution Details</h3>
                    <div class="detail-item">
                        <div class="detail-label">Resolution Date</div>
                        <div class="detail-value" id="resolution-date"></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Resolution Provided</div>
                        <div class="resolution-message" id="resolution-details"></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Resolution Status</div>
                        <div class="detail-value" id="resolution-status"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="closeModal('resolvedDetailModal')">Close</button>
            </div>
        </div>
    </div>
    </div>

    <script>
    // Current active tab and sub-tab
    let currentTab = 'tourguide';
    let currentSubTab = 'unresolved';
    let currentComplaintData = null;
    let currentResolvedComplaintData = null;

    // Function to switch between main tabs
    function switchTab(tab) {
        // Hide all tables
        document.querySelectorAll('.complaints-table-container').forEach(table => {
            table.style.display = 'none';
        });

        // Update active tab styling
        document.querySelectorAll('.complaints-tab').forEach(t => {
            t.classList.remove('active');
        });
        event.target.classList.add('active');

        // Show the selected tab's content
        currentTab = tab;
        showCurrentTabContent();
    }

    // Function to switch between sub-tabs
    function switchSubTab(subTab) {
        // Update active sub-tab styling
        document.querySelectorAll('.complaints-sub-tab').forEach(st => {
            st.classList.remove('active');
        });
        event.target.classList.add('active');

        // Show the selected sub-tab content
        currentSubTab = subTab;
        showCurrentTabContent();
    }

    // Function to show the currently selected tab and sub-tab content
    function showCurrentTabContent() {
        // Hide all tables first
        document.querySelectorAll('.complaints-table-container').forEach(table => {
            table.style.display = 'none';
        });

        // Show the selected table
        const tableId = `${currentTab}-${currentSubTab}`;
        const tableElement = document.getElementById(tableId);
        if (tableElement) {
            tableElement.style.display = 'block';
        }
    }

    // Function to open the detail modal for unresolved complaints
    function openDetailModal(complaintData, guideData, userRole) {
        // Parse the complaint data if it's a string
        if (typeof complaintData === 'string') {
            complaintData = JSON.parse(complaintData);
            guideData = JSON.parse(guideData);
        }

        // Store current complaint data for later use
        currentComplaintData = complaintData;

        // Fill in the modal with the complaint data
        document.getElementById('detail-name').textContent = guideData.firstName + ' ' + guideData.lastName;
        document.getElementById('detail-type').textContent = 'Tour Guide';
        document.getElementById('detail-email').textContent = guideData.email;
        document.getElementById('detail-phone').textContent = guideData.mobileNum;

        document.getElementById('detail-id').textContent = complaintData.complaint_id;
        document.getElementById('detail-date').textContent = complaintData.date_submitted;
        document.getElementById('detail-subject').textContent = complaintData.subject;
        document.getElementById('detail-message').textContent = complaintData.message;

        // Check if booking data exists and show/hide booking section accordingly
        const bookingSection = document.getElementById('booking-section');
        if (complaintData.booking_id && complaintData.booking_id.trim() !== '') {
            bookingSection.style.display = 'block';
            document.getElementById('detail-booking').textContent = complaintData.booking_id;
            // Add other booking details if available
        } else {
            bookingSection.style.display = 'none';
        }

        // Show the modal
        document.getElementById('detailModal').style.display = 'flex';
    }

    // Function to open the resolve modal
    function openResolveModal(complaintData) {
        // Check if we have valid complaint data
        if (!complaintData) {
            console.error("No complaint data provided");
            return;
        }

        // Parse if it's a string
        if (typeof complaintData === 'string') {
            complaintData = JSON.parse(complaintData);
        }

        // Set the complaint ID in the resolve modal
        document.getElementById('resolve-id').textContent = complaintData.complaint_id;
        document.getElementById('resolve-subject').textContent = complaintData.subject;

        // Pre-fill the hidden input too
        document.getElementById('complaint_id_input').value = complaintData.complaint_id;

        // Show the modal
        document.getElementById('resolveModal').style.display = 'flex';
    }

    // Function to open resolved complaint modal
    function openResolvedModal(complaintData, guideData) {
        // Parse data if it's a string (from JSON encoded PHP)
        if (typeof complaintData === 'string') {
            complaintData = JSON.parse(complaintData);
            guideData = JSON.parse(guideData);
        }

        // Store current complaint data
        currentResolvedComplaintData = complaintData;

        // Fill in the modal with the complaint data
        document.getElementById('resolved-detail-id').textContent = complaintData.complaint_id;
        document.getElementById('resolved-detail-date').textContent = complaintData.date_submitted;
        document.getElementById('resolved-date').textContent = complaintData.date_resolved || 'N/A';
        document.getElementById('resolved-detail-name').textContent = guideData.firstName + ' ' + guideData.lastName;
        document.getElementById('resolved-detail-type').textContent = 'Tour Guide';
        document.getElementById('resolved-detail-email').textContent = guideData.email;
        document.getElementById('resolved-detail-phone').textContent = guideData.mobileNum;
        document.getElementById('resolved-detail-subject').textContent = complaintData.subject;
        document.getElementById('resolved-detail-message').textContent = complaintData.message;

        // Resolution details
        document.getElementById('resolution-date').textContent = complaintData.date_resolved || 'N/A';
        document.getElementById('resolution-details').textContent = complaintData.resolution_details ||
            'No details provided';
        document.getElementById('resolution-status').textContent = complaintData.resolution_status || 'Completed';

        // Booking information if available
        const bookingSection = document.getElementById('resolved-booking-section');
        if (complaintData.booking_id && complaintData.booking_id.trim() !== '') {
            bookingSection.style.display = 'block';
            document.getElementById('resolved-detail-booking').textContent = complaintData.booking_id;
            // Add other booking details if available
        } else {
            bookingSection.style.display = 'none';
        }

        // Show the modal
        document.getElementById('resolvedDetailModal').style.display = 'flex';
    }

    // Function to close any modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Function to resolve complaints
    function resolveComplaint() {
        // Get form values
        const resolutionDetails = document.getElementById('resolution-details').value;
        const resolutionNote = document.getElementById('resolution-note').value;

        // Validate form
        if (!resolutionDetails) {
            alert('Please fill in all required fields');
            return;
        }

        // Submit the form
        document.getElementById('resolveForm').submit();
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }
    </script>
</body>

</html>