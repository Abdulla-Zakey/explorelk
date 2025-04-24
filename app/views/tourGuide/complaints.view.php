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

                <!-- Complaint Card 1 -->
                <div class="complaint-card">
                    <div class="complaint-header">
                        <span class="complaint-id">#CP2003</span>
                        <span class="status status-resolved">Resolved</span>
                    </div>
                    <div class="complaint-date">Submitted on April 3, 2025</div>
                    <div class="complaint-subject">Payment dispute with customer</div>
                    <div class="complaint-message">
                        Customer BK5789 refused to pay the full amount after the tour, claiming the service wasn't as
                        described. We provided all services as agreed in the booking, including the extended hike they
                        requested. The customer only paid 70% of the agreed amount.
                    </div>

                    <div class="resolution-section">
                        <div class="resolution-header">Resolution</div>
                        <div class="resolution-date">Resolved on April 5, 2025</div>
                        <div class="resolution-message">
                            After reviewing the case, we've determined that the service was provided as agreed. The
                            remaining 30% has been charged to the customer's payment method as per our terms of service.
                            A $20 credit has been applied to their account as a goodwill gesture for any
                            misunderstanding.
                        </div>
                    </div>
                </div>

                <!-- Complaint Card 2 -->
                <div class="complaint-card">
                    <div class="complaint-header">
                        <span class="complaint-id">#CP2001</span>
                        <span class="status status-resolved">Resolved</span>
                    </div>
                    <div class="complaint-date">Submitted on March 28, 2025</div>
                    <div class="complaint-subject">Platform commission calculation error</div>
                    <div class="complaint-message">
                        The platform incorrectly calculated our commission for booking BK5214. Instead of the agreed
                        15%, the system deducted 20% from our payment. This has happened with 3 bookings this month.
                    </div>

                    <div class="resolution-section">
                        <div class="resolution-header">Resolution</div>
                        <div class="resolution-date">Resolved on March 30, 2025</div>
                        <div class="resolution-message">
                            Our technical team identified a bug in the commission calculation module that affected
                            certain account types. The overcharged commission (5% difference) has been refunded to your
                            account. A system update has been deployed to prevent this issue in future transactions. We
                            appreciate you bringing this to our attention.
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <!-- <div class="no-complaints">
                <i class="fas fa-check-circle" style="font-size: 40px; color: var(--success); margin-bottom: 15px;"></i>
                <h3>No Complaints</h3>
                <p>You haven't submitted any complaints yet.</p>
            </div> -->
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
                <form id="complaintForm">
                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" placeholder="Brief description of your complaint" required>
                    </div>

                    <div class="form-group">
                        <label for="booking-id">Related Booking ID (if applicable)</label>
                        <input type="text" id="booking-id" placeholder="Enter booking reference">
                    </div>

                    <div class="form-group">
                        <label for="complaint-type">Complaint Type *</label>
                        <select id="complaint-type" required>
                            <option value="">Select complaint type</option>
                            <option value="customer">Customer Issue</option>
                            <option value="payment">Payment Dispute</option>
                            <option value="service">Service Problem</option>
                            <option value="platform">Platform Issue</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Detailed Description *</label>
                        <textarea id="message" placeholder="Please describe your complaint in detail..."
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="attachments">Attachments (if any)</label>
                        <input type="file" id="attachments" multiple>
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
        const complaintType = document.getElementById('complaint-type').value;
        const message = document.getElementById('message').value;

        // Validate required fields
        if (!subject || !complaintType || !message) {
            alert('Please fill in all required fields');
            return;
        }

        // In a real application, you would send this data to the server
        console.log('Complaint submitted:', {
            subject,
            bookingId,
            complaintType,
            message
        });

        // Close complaint modal
        closeModal('complaintModal');

        // Show success modal
        document.getElementById('successModal').style.display = 'flex';

        // Reset form
        document.getElementById('complaintForm').reset();
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