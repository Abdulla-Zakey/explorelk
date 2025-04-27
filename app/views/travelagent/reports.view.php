<?php
include_once APPROOT . '/views/travelagent/nav.php';
include_once APPROOT . '/views/travelagent/travelagenthead.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['title']) ?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/travelagent/reports.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main style="margin-left: 250px;">
        <div class="container">
            <header>
                <div>
                    <h1>Issues</h1>
                </div>
            </header>

            <!-- Submit New Issue Button -->
            <button class="btn btn-primary" onclick="openIssueModal()">
                <i class="fas fa-plus"></i> Submit New Issue
            </button>

            <!-- Issues List -->
            <div class="issues-container">
                <h2 class="issues-header">Your Issues</h2>
                
                <?php if (empty($data['issues'])): ?>
                    <div class="no-issues">No issues found.</div>
                <?php else: ?>
                    <?php foreach ($data['issues'] as $issue): ?>
                        <div class="issue-card">
                            <div class="issue-header">
                                <span class="issue-id">Issue ID: <?= htmlspecialchars($issue->issue_id ?? 'N/A') ?></span>
                                <span class="status status-<?= strtolower($issue->status ?? 'pending') ?>">
                                    <?= htmlspecialchars($issue->status ?? 'Pending') ?>
                                </span>
                            </div>
                            <div class="issue-date">
                                Submitted on <?= date('F j, Y', strtotime($issue->date_submitted ?? 'now')) ?>
                            </div>
                            <div class="issue-subject">
                                <?= htmlspecialchars($issue->subject ?? 'No Subject') ?>
                            </div>
                            <div class="issue-message">
                                <?= htmlspecialchars($issue->message ?? 'No Message') ?>
                            </div>
                            
                            <?php if (($issue->status ?? '') === 'Resolved' && !empty($issue->resolution_notes)): ?>
                                <div class="resolution-section">
                                    <div class="resolution-header">Resolution</div>
                                    <div class="resolution-date">
                                        Resolved on <?= date('F j, Y', strtotime($issue->date_resolved ?? 'now')) ?>
                                    </div>
                                    <div class="resolution-message">
                                        <?= htmlspecialchars($issue->resolution_notes) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Issue Modal -->
        <div class="modal-overlay" id="issueModal">
            <div class="modal">
                <div class="modal-header">
                    <h2>Submit New Issue</h2>
                    <button class="modal-close" onclick="closeModal('issueModal')">×</button>
                </div>
                <div class="modal-body">
                    <form id="issueForm" method="POST" action="<?= ROOT ?>/travelagent/Treports/create">
                        <input type="hidden" name="traveler_Id" value="<?= htmlspecialchars($data['traveler_Id'] ?? '') ?>">
                        <input type="hidden" name="travelagent_Id" value="<?= htmlspecialchars($data['travelagent_Id'] ?? '') ?>">
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" placeholder="Brief description of your issue" required value="<?= htmlspecialchars($data['subject'] ?? '') ?>">
                            <?php if (!empty($data['errors']['subject'])): ?>
                                <div class="error"><?= htmlspecialchars($data['errors']['subject']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="booking_id">Related Booking ID (if applicable)</label>
                            <input type="text" id="booking_id" name="booking_id" placeholder="Enter booking reference" value="<?= htmlspecialchars($data['booking_id'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="message">Detailed Description *</label>
                            <textarea id="message" name="message" placeholder="Please describe your issue in detail..." required maxlength="500"><?= htmlspecialchars($data['message'] ?? '') ?></textarea>
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
                    <button class="btn btn-primary" onclick="submitIssue()">Submit Issue</button>
                    <button class="btnFa fa-plus"></i> Submit Issue</button>
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
                    <p style="font-size: 16px; margin-bottom: 20px;">Your issue has been submitted successfully!</p>
                    <p style="font-size: 14px; color: #666;">Our team will review it and get back to you soon.</p>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <button class="btn btn-primary" onclick="closeModal('successModal')">OK</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        try {
            console.log('Reports JavaScript loaded');

            // Define ROOT constant safely
            const ROOT = <?php echo json_encode(ROOT ?? '') ?>;

            function openIssueModal() {
                console.log('openIssueModal called');
                const modal = document.getElementById('issueModal');
                if (modal) {
                    modal.style.display = 'flex';
                    console.log('Issue modal opened');
                } else {
                    console.error('Issue modal not found');
                }
            }

            function closeModal(modalId) {
                console.log(`closeModal called for ${modalId}`);
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'none';
                    console.log(`${modalId} closed`);
                } else {
                    console.error(`Modal with ID ${modalId} not found`);
                }
            }

            function submitIssue() {
                console.log('submitIssue called');
                const form = document.getElementById('issueForm');
                if (form) {
                    form.submit();
                    console.log('Issue form submitted');
                } else {
                    console.error('Issue form not found');
                }
            }

            function cancelReport() {
                console.log('cancelReport called');
                Swal.fire({
                    title: 'Cancel Issue?',
                    text: "Are you sure you want to cancel? All entered information will be lost.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel',
                    cancelButtonText: 'No, continue editing'
                }).then((result) => {
                    if (result.isConfirmed) {
                        closeModal('issueModal');
                        const form = document.getElementById('issueForm');
                        if (form) {
                            form.reset();
                            console.log('Issue form reset');
                        }
                        updateCounts();
                    }
                });
            }

            function updateCounts() {
                console.log('updateCounts called');
                const descriptionField = document.getElementById('message');
                const charCountElement = document.getElementById('charCount');
                const wordCountElement = document.getElementById('wordCount');

                if (descriptionField && charCountElement && wordCountElement) {
                    const text = descriptionField.value;
                    const chars = text.length;
                    const words = text.trim() ? text.trim().split(/\s+/).length : 0;
                    charCountElement.textContent = 500 - chars;
                    wordCountElement.textContent = words;
                    console.log(`Character count: ${500 - chars}, Word count: ${words}`);
                } else {
                    console.error('Text counting elements not found');
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM fully loaded');
                const descriptionField = document.getElementById('message');
                if (descriptionField) {
                    descriptionField.addEventListener('input', updateCounts);
                    updateCounts();
                    console.log('Description field event listener added');
                }

                // Show success modal if flash message exists
                <?php if (flash('issue_success')): ?>
                    console.log('Showing success modal');
                    const successModal = document.getElementById('successModal');
                    if (successModal) {
                        successModal.style.display = 'flex';
                    }
                <?php endif; ?>

                window.onclick = function(event) {
                    if (event.target.classList.contains('modal-overlay')) {
                        event.target.style.display = 'none';
                        console.log('Modal closed via overlay click');
                    }
                };
            });
        } catch (error) {
            console.error('JavaScript error in reports view:', error);
        }
    </script>
</body>
</html>