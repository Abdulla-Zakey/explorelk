<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report an Issue</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/reports.css?v=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main>
        <div class="container">
            <header>
                <h1>Report an Issue</h1>
                <h3>Let us know about any issues or concerns you are facing.</h3>
                <h3>We're here to help!</h3>
            </header>

            <form id="reportForm" method="POST" action="<?= ROOT ?>/hotel/Hreports/submit" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category">Issue Category</label>
                    <select id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="technical" <?= isset($data['category']) && $data['category'] == 'technical' ? 'selected' : '' ?>>Technical Issue</option>
                        <option value="payment" <?= isset($data['category']) && $data['category'] == 'payment' ? 'selected' : '' ?>>Payment Problem</option>
                        <option value="booking" <?= isset($data['category']) && $data['category'] == 'booking' ? 'selected' : '' ?>>Booking Discrepancy</option>
                        <option value="feedback" <?= isset($data['category']) && $data['category'] == 'feedback' ? 'selected' : '' ?>>Feedback/Suggestions</option>
                        <option value="other" <?= isset($data['category']) && $data['category'] == 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                    <?php if (!empty($data['errors']['category'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['category']) ?></div>
                    <?php endif; ?>

                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" type="text" required value="<?= isset($data['subject']) ? htmlspecialchars($data['subject']) : '' ?>">
                    <?php if (!empty($data['errors']['subject'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['subject']) ?></div>
                    <?php endif; ?>

                    <label for="description">Description</label>
                    <textarea id="description" name="description" maxlength="500" placeholder="Provide a detailed description of the issue or concern..." required><?= isset($data['description']) ? htmlspecialchars($data['description']) : '' ?></textarea>
                    <div class="word-count">
                        Characters remaining: <span id="charCount">500</span> | Words: <span id="wordCount">0</span>
                    </div>
                    <?php if (!empty($data['errors']['description'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['description']) ?></div>
                    <?php endif; ?>

                    <!-- <label for="fileUpload">Attach Supporting Files (Optional)</label>
                    <input type="file" id="fileUpload" name="files[]" accept=".png,.jpg,.pdf,.doc,.docx" multiple>
                    <small>Allowed file types: PNG, JPG, PDF, DOC, DOCX. Maximum size: 5MB per file.</small>
                    <?php if (!empty($data['errors']['files'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['files']) ?></div>
                    <?php endif; ?> -->

                    <label for="email">Your Email Address</label>
                    <input type="email" id="email" name="email" required value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : '' ?>">
                    <?php if (!empty($data['errors']['email'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['email']) ?></div>
                    <?php endif; ?>

                    <label class="priority-label">Priority Level</label>
                    <div class="priority-options">
                        <div class="priority-item">
                            <input type="radio" id="low" name="priority" value="low" <?= isset($data['priority']) && $data['priority'] == 'low' ? 'checked' : '' ?> required>
                            <label for="low">Low</label>
                        </div>
                        <div class="priority-item">
                            <input type="radio" id="medium" name="priority" value="medium" <?= isset($data['priority']) && $data['priority'] == 'medium' ? 'checked' : '' ?>>
                            <label for="medium">Medium</label>
                        </div>
                        <div class="priority-item">
                            <input type="radio" id="high" name="priority" value="high" <?= isset($data['priority']) && $data['priority'] == 'high' ? 'checked' : '' ?>>
                            <label for="high">High</label>
                        </div>
                    </div>
                    <?php if (!empty($data['errors']['priority'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['priority']) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($data['errors']['hotel_id'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['hotel_id']) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($data['errors']['db'])): ?>
                        <div class="error"><?= htmlspecialchars($data['errors']['db']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Submit Report</button>
                    <button type="button" class="btn-cancel" onclick="cancelReport()">Cancel</button>
                </div>
            </form>
        </div>
    </main>

    <script

 

>
        const ROOT = <?= json_encode(ROOT) ?>;

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reportForm');
            const descriptionField = document.getElementById('description');
            const charCountElement = document.getElementById('charCount');
            const wordCountElement = document.getElementById('wordCount');

            // Update character and word count
            function updateCounts() {
                const text = descriptionField.value;
                const chars = text.length;
                const words = text.trim() ? text.trim().split(/\s+/).length : 0;
                charCountElement.textContent = 500 - chars;
                wordCountElement.textContent = words;
            }

            descriptionField.addEventListener('input', updateCounts);
            updateCounts();

            // Handle form submission
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const submitButton = document.querySelector('.btn-submit');
                submitButton.disabled = true;
   submitButton.innerHTML = '<span class="spinner"></span> Submitting...';

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Submit Report';

                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your report was submitted successfully! We will review it shortly.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.reset();
                                updateCounts();
                                window.location.href = `${ROOT}/hotel/Hreports`;
                            }
                        });
                    } else {
                        let errorMessage = data.message || 'There was an error submitting your report.';
                        if (data.errors) {
                            errorMessage = Object.values(data.errors).join('<br>');
                        }

                        Swal.fire({
                            title: 'Error!',
                            html: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Submit Report';

                    Swal.fire({
                        title: 'Error!',
                        html: `An error occurred: ${error.message}`,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });

                    console.error('Fetch error:', error);
                });
            });
        });

        function cancelReport() {
            Swal.fire({
                title: 'Cancel Report?',
                text: "Are you sure you want to cancel? All entered information will be lost.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel',
                cancelButtonText: 'No, continue editing'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `${ROOT}/hotel/dashboard`;
                }
            });
        }
    </script>
</body>
</html>