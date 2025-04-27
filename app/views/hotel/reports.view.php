<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/reports.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main style="margin-left: 250px;">
        <div class="container">
            <header>
                <div>
                    <h1>Complaints</h1>
                </div>
            </header>

            <!-- Submit New Complaint Button -->
            <button class="btn btn-primary" onclick="openComplaintModal()">
                <i class="fas fa-plus"></i> Submit New Complaint
            </button>

            <!-- Complaints List -->
            <div class="complaints-container">
                <h2 class="complaints-header">Your Complaints</h2>
                
                <?php if (empty($data['complaints'])): ?>
                    <div class="no-complaints">No complaints found.</div>
                <?php else: ?>
                    <?php foreach ($data['complaints'] as $complaint): ?>
                        <?php //show($complaint); ?>
                        <div class="complaint-card">
                            <div class="complaint-header">
                                <span class="complaint-id">Complaint ID: <?= htmlspecialchars($complaint->complaint_id ?? 'N/A') ?></span>
                                <span class="status status-<?= strtolower($complaint->status ?? 'pending') ?>">
                                    <?= htmlspecialchars($complaint->status ?? 'Pending') ?>
                                </span>
                            </div>
                            <div class="complaint-date">
                                Submitted on <?= date('F j, Y', strtotime($complaint->date_submitted ?? 'now')) ?>
                            </div>
                            <div class="complaint-subject">
                                <?= htmlspecialchars($complaint->subject ?? 'No Subject') ?>
                            </div>
                            <div class="complaint-message">
                                <?= htmlspecialchars($complaint->message ?? 'No Message') ?>
                            </div>
                            
                            <?php if (($complaint->status ?? '') === 'Resolved' && !empty($complaint->resolution_notes)): ?>
                                <div class="resolution-section">
                                    <div class="resolution-header">Resolution</div>
                                    <div class="resolution-date">
                                        Resolved on <?= date('F j, Y', strtotime($complaint->date_resolved ?? 'now')) ?>
                                    </div>
                                    <div class="resolution-message">
                                        <?= htmlspecialchars($complaint->resolution_notes) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Complaint Modal -->
        <div class="modal-overlay" id="complaintModal">
            <div class="modal">
                <div class="modal-header">
                    <h2>Submit New Complaint</h2>
                    <button class="modal-close" onclick="closeModal('complaintModal')">×</button>
                </div>
                <div class="modal-body">
                    <form id="complaintForm" method="POST" action="<?= ROOT ?>/Hotel/Hreports/create" enctype="multipart/form-data">
                        <input type="hidden" name="hotel_id" value="<?= htmlspecialchars($data['hotel_id'] ?? '') ?>">
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" placeholder="Brief description of your complaint" required value="<?= htmlspecialchars($data['subject'] ?? '') ?>">
                            <?php if (!empty($data['errors']['subject'])): ?>
                                <div class="error"><?= htmlspecialchars($data['errors']['subject']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="booking-id">Related Booking ID (if applicable)</label>
                            <input type="text" id="booking-id" name="booking_id" placeholder="Enter booking reference" value="<?= htmlspecialchars($data['booking_id'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="message">Detailed Description *</label>
                            <textarea id="message" name="description" placeholder="Please describe your complaint in detail..." required maxlength="500"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                            <div class="word-count">
                                Characters remaining: <span id="charCount">500</span> | Words: <span id="wordCount">0</span>
                            </div>
                            <?php if (!empty($data['errors']['message'])): ?>
                                <div class="error"><?= htmlspecialchars($data['errors']['message']) ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="submitComplaint()">Submit Complaint</button>
                    <button class="btn btn-danger" onclick="cancelReport()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Success Modal -->
        <div class="modal-overlay" id="successModal">
            <div class="modal" style="max-width: 400px;">
                <div class="modal-header">
                    <h2>Success</h2>
                    <button class="modal-close" onclick="closeModal('successModal')">×</button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <i class="fas fa-check-circle" style="font-size: 50px; color: #2ecc71; margin-bottom: 20px;"></i>
                    <p style="font-size: 16px; margin-bottom: 20px;">Your complaint has been submitted successfully!</p>
                    <p style="font-size: 14px; color: #666;">Our team will review it and get back to you soon.</p>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button class="btn btn-primary" onclick="closeModal('successModal')">OK</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        const ROOT = <?= json_encode(ROOT) ?>;

        function openComplaintModal() {
            document.getElementById('complaintModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function submitComplaint() {
            const form = document.getElementById('complaintForm');
            form.submit(); // This will submit the form and redirect to the action URL
        }

        function cancelReport() {
            Swal.fire({
                title: 'Cancel Complaint?',
                text: "Are you sure you want to cancel? All entered information will be lost.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel',
                cancelButtonText: 'No, continue editing'
            }).then((result) => {
                if (result.isConfirmed) {
                    closeModal('complaintModal');
                    document.getElementById('complaintForm').reset();
                    updateCounts();
                }
            });
        }

        function updateCounts() {
            const descriptionField = document.getElementById('message');
            const charCountElement = document.getElementById('charCount');
            const wordCountElement = document.getElementById('wordCount');

            const text = descriptionField.value;
            const chars = text.length;
            const words = text.trim() ? text.trim().split(/\s+/).length : 0;
            charCountElement.textContent = 500 - chars;
            wordCountElement.textContent = words;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const descriptionField = document.getElementById('message');
            descriptionField.addEventListener('input', updateCounts);
            updateCounts();

            window.onclick = function(event) {
                if (event.target.classList.contains('modal-overlay')) {
                    event.target.style.display = 'none';
                }
            };
        });
    </script>
</body>
</html>