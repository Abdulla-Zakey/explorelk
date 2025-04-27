<?php
    $pendingComplaints = $data['pendingComplaints'] ;
    $resolvedComplaints = $data['resolvedComplaints'];
    // show($resolvedComplaints);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/complaints.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>
        <div class="main-container">
            <div class="page-header">
                <h1>Complaint Management</h1>
            </div>

            <!-- Submit New Complaint Button -->
            <button class="btn btn-primary" onclick="openComplaintModal()">
                <i class="fas fa-plus"></i> Submit New Complaint
            </button>

            <!-- Resolved Complaints List -->
            <div class="complaints-container">
                <h2 class="complaints-header">Your Complaints</h2>

                <?php if(empty($pendingComplaints) || empty($resolvedComplaints)): ?>
                <!-- Empty State -->
                <div class="no-complaints">
                    <i class="fas fa-check-circle"
                        style="font-size: 40px; color: var(--success); margin-bottom: 15px;"></i>
                    <h3>No Complaints</h3>
                    <p>You haven't submitted any complaints yet.</p>
                </div>
                <?php else: ?>
                <?php foreach($pendingComplaints as $complaint): ?>
                <div class="complaint-card">
                    <div class="complaint-header">
                        <span class="complaint-id">Complaint ID: <?= $complaint->complaint_id ?></span>
                        <span
                            class="status <?= $complaint->status=='Pending' ? 'status-pending':'status-resolved'?>"><?= $complaint->status ?></span>
                    </div>
                    <div class="complaint-date"><?= $complaint->date_submitted ?></div>
                    <div class="complaint-subject"><?= $complaint->subject ?></div>
                    <div class="complaint-message"><?= $complaint->message ?></div>

                    <?php if(!empty($complaint->resolution_details)): ?>
                    <div class="resolution-section">
                        <div class="resolution-header">Resolution</div>
                        <div class="resolution-date">Resolved on <?= $complaint->date_resolved ?></div>
                        <div class="resolution-message"><?= $complaint->resolution_details ?></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>

                <?php foreach($resolvedComplaints as $complaint): ?>
                <div class="complaint-card">
                    <div class="complaint-header">
                        <span class="complaint-id">Complaint ID: <?= $complaint->complaint_id ?></span>
                        <span
                            class="status <?= $complaint->status=='Pending' ? 'status-pending':'status-resolved'?>"><?= $complaint->status ?></span>
                    </div>
                    <div class="complaint-date"><?= $complaint->date_submitted ?></div>
                    <div class="complaint-subject"><?= $complaint->subject ?></div>
                    <div class="complaint-message"><?= $complaint->message ?></div>

                    <?php if(!empty($complaint->resolution_details)): ?>
                    <div class="resolution-section">
                        <div class="resolution-header">Resolution</div>
                        <div class="resolution-date">Resolved on <?= $complaint->date_resolved ?></div>
                        <div class="resolution-message"><?= $complaint->resolution_details ?></div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>


            </div>
        </div>
    </div>

    <!-- Complaint Modal -->
    <div class="modal-overlay" id="complaintModal">
        <div class="modal">
            <div class="modal-header">
                <h2>Submit New Complaint</h2>
                <button class="modal-close" onclick="closeModal('complaintModal')">&times;</button>
            </div>
            <div class="modal-body">
                <form id="complaintForm" method='post' action="<?= ROOT ?>/tourGuide/C_complaints/newComplaint">
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" placeholder="Brief description of your complaint" required>
                    </div>

                    <div class="form-group">
                        <label for="booking-id">Related Booking ID (if applicable)</label>
                        <input type="text" id="booking-id" name="booking_id" placeholder="Enter booking reference">
                    </div>

                    <div class="form-group">
                        <label for="message">Detailed Description *</label>
                        <textarea id="message" name="message" placeholder="Please describe your complaint in detail..."
                            required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="submitComplaint()">Submit Complaint</button>
                <button class="btn btn-danger" onclick="closeModal('complaintModal')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal-overlay" id="successModal">
        <div class="modal" style="max-width: 400px;">
            <div class="modal-header">
                <h2>Success</h2>
                <button class="modal-close" onclick="closeModal('successModal')">&times;</button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <i class="fas fa-check-circle" style="font-size: 50px; color: var(--success); margin-bottom: 20px;"></i>
                <p style="font-size: 16px; margin-bottom: 20px;">Your complaint has been submitted successfully!</p>
                <p style="font-size: 14px; color: #666;">Our team will review it and get back to you soon.</p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button class="btn btn-primary" onclick="closeModal('successModal')">OK</button>
            </div>
        </div>
    </div>

    <script>
    // Function to open complaint modal
    function openComplaintModal() {
        document.getElementById('complaintModal').style.display = 'flex';
    }

    // Function to close any modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Function to handle complaint submission
    function submitComplaint() {
        // Get form values
        const subject = document.getElementById('subject').value;
        const bookingId = document.getElementById('booking-id').value;
        const message = document.getElementById('message').value;

        // Validate required fields
        if (!subject || !message) {
            alert('Please fill in all required fields');
            return;
        }
        document.getElementById('successModal').style.display = 'flex';
        // Submit the form
        document.getElementById('complaintForm').submit();
        
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