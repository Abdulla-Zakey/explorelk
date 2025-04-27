<?php
    $newBookings = $data['newBookings'];
    $tourPackages = $data['tourPackages'];
    $travelers = $data['travelers'];
    $tourPackageImages = $data['tourPackageImages'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/bookingRequests.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <div class="main-container">
            <div class="page-header">
                <h1>Booking Requests</h1>
            </div>

            <!-- Search Bar -->
            <div class="search-container">
                <input type="text" class="search-bar" placeholder="Search requests...">
            </div>

            <!-- Booking Request List -->
            <div class="request-list">
                <?php if ($newBookings) : ?>
                    <?php foreach ($newBookings as $booking) : ?>
                        <?php
                            // Find corresponding package
                            $packageData = null;
                            foreach ($tourPackages as $tourPackage) {
                                if ($tourPackage->package_id == $booking->package_id) {
                                    $packageData = $tourPackage;
                                    break;
                                }
                            }
                            
                            // Find corresponding traveler
                            $travelerData = null;
                            foreach ($travelers as $traveler) {
                                if ($traveler->traveler_Id == $booking->traveler_Id) {
                                    $travelerData = $traveler;
                                    break;
                                }
                            }
                            
                            // Skip if package or traveler not found
                            if (!$packageData || !$travelerData) continue;
                        ?>
                        <div class="request-item">
                            <div class="request-details">
                                <span class="status pending"><?= $booking->request_status; ?></span>
                                <h3 class="title"><?= $travelerData->fName . ' ' . $travelerData->lName; ?></h3>
                                <h4 class="title"><?= $packageData->name; ?></h4>
                                <p class="location"><?= $packageData->location; ?></p>
                                <p class="date"><?= $booking->tour_date; ?> - <?= $booking->start_time; ?></p>
                                <p class="package-price"><?= $packageData->package_price; ?> LKR</p>
                            </div>
                            <div class="request-actions">
                                <button class="action-button view-btn" onclick="openRequestModal('<?= $booking->booking_id; ?>')">View</button>
                                <button class="action-button accept-btn" onclick="updateBookingStatus('<?= $booking->booking_id; ?>', 'accept')">Accept</button>
                                <button class="action-button reject-btn" onclick="updateBookingStatus('<?= $booking->booking_id; ?>', 'reject')">Reject</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No new booking requests.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Booking Request Details Modal -->
    <div id="requestModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-title">Booking Request Details</h2>
                <span class="close" onclick="closeModal()">×</span>
            </div>
            <div class="modal-body">
                <div class="modal-image">
                    <img id="modal-image" src="" alt="Request Image">
                </div>
                <div class="modal-details">
                    <div class="detail-row">
                        <i class="fas fa-info-circle detail-icon"></i>
                        <span class="detail-label">Status</span>
                        <span id="modal-status" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-map-marker-alt detail-icon"></i>
                        <span class="detail-label">Location</span>
                        <span id="modal-location" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-calendar-alt detail-icon"></i>
                        <span class="detail-label">Date & Time</span>
                        <span id="modal-date" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-clock detail-icon"></i>
                        <span class="detail-label">Duration</span>
                        <span id="modal-duration" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-users detail-icon"></i>
                        <span class="detail-label">Tourists</span>
                        <span id="modal-tourists" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-phone-alt detail-icon"></i>
                        <span class="detail-label">Customer Contact</span>
                        <span id="modal-contact" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-comment-dots detail-icon"></i>
                        <span class="detail-label">Special Requests</span>
                        <span id="modal-requests" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-money-bill-wave detail-icon"></i>
                        <span class="detail-label">Payment Status</span>
                        <span id="modal-payment" class="detail-value"></span>
                    </div>
                    <div class="detail-row">
                        <i class="fas fa-route detail-icon"></i>
                        <span class="detail-label">Itinerary</span>
                        <span id="modal-itinerary" class="detail-value"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="modal-action-button modal-secondary-btn" onclick="closeModal()">Close</button>
                <button id="accept-modal-btn" class="modal-action-button accept-btn" data-id="">Accept</button>
                <button id="reject-modal-btn" class="modal-action-button reject-btn" data-id="">Reject</button>
            </div>
        </div>
    </div>

    <script>
        // Store booking data in JavaScript
        const bookingData = <?= json_encode($newBookings) ?>;
        const packageData = <?= json_encode($tourPackages) ?>;
        const travelerData = <?= json_encode($travelers) ?>;
        const tourPackageImages = <?= json_encode($tourPackageImages) ?>;
        
        // Helper function to find objects by ID
        function findById(array, idField, idValue) {
            return array.find(item => item[idField] == idValue);
        }
        
        // Function to open the modal with booking details
        function openRequestModal(bookingId) {
            // Find the specific booking
            const booking = findById(bookingData, 'booking_id', bookingId);
            if (!booking) return;
            
            // Find associated package and traveler and the package image
            const package = findById(packageData, 'package_id', booking.package_id);
            const traveler = findById(travelerData, 'traveler_Id', booking.traveler_Id);
            const image = findById(tourPackageImages, 'package_id', booking.package_id)
            if (!package || !traveler) return;
            
            // Get the modal
            const modal = document.getElementById('requestModal');
            
            // Update modal with booking data
            document.getElementById('modal-title').textContent = package.name;
            
            const statusElement = document.getElementById('modal-status');
            statusElement.textContent = booking.request_status.charAt(0).toUpperCase() + booking.request_status.slice(1);
            statusElement.className = 'detail-value ' + booking.request_status.toLowerCase();
            
            document.getElementById('modal-location').textContent = package.location;
            document.getElementById('modal-date').textContent = `${booking.tour_date} - ${booking.start_time}`;
            document.getElementById('modal-duration').textContent = package.duration || 'Not specified';
            document.getElementById('modal-tourists').textContent = `${booking.num_travelers || '1'} travelers`;
            document.getElementById('modal-contact').textContent = `${traveler.fName} ${traveler.lName} (${traveler.email}, ${traveler.contactNum || 'No phone'})`;
            document.getElementById('modal-requests').textContent = booking.special_requests || 'None';
            document.getElementById('modal-payment').textContent = booking.payment_status || 'Pending';
            document.getElementById('modal-itinerary').innerHTML = package.description || 'No detailed itinerary available';
            
            // Set image or use placeholder
            if (image.image_path) {
                document.getElementById('modal-image').src = `<?= ROOT ?>/${image.image_path}`;
            }else {
                document.getElementById('modal-image').src = '<?= IMAGES ?>/placeholder-tour.jpg';
            }
            
            // Set action button data attributes
            document.getElementById('accept-modal-btn').setAttribute('data-id', bookingId);
            document.getElementById('reject-modal-btn').setAttribute('data-id', bookingId);
            
            // Add event listeners to modal buttons
            document.getElementById('accept-modal-btn').onclick = function() {
                updateBookingStatus(this.getAttribute('data-id'), 'accept');
            };
            
            document.getElementById('reject-modal-btn').onclick = function() {
                updateBookingStatus(this.getAttribute('data-id'), 'reject');
            };
            
            // Show the modal
            modal.style.display = 'block';
        }
        
        // Function to close modal
        function closeModal() {
            document.getElementById('requestModal').style.display = 'none';
        }
        
        // Close modal when clicking outside content
        window.onclick = function(event) {
            const modal = document.getElementById('requestModal');
            if (event.target == modal) {
                closeModal();
            }
        }
        
        // Function to update booking status
        function updateBookingStatus(bookingId, status) {
            if (confirm(`Are you sure you want to ${status} this booking request?`)) {
                if (status == 'accept') {
                    window.location.href="<?= ROOT ?>/tourGuide/C_bookingRequests/accept/" + bookingId; 
                } else {
                    window.location.href="<?= ROOT ?>/tourGuide/C_bookingRequests/reject/" + bookingId; 
                }
            }
        }
        
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchBar = document.querySelector('.search-bar');
            
            searchBar.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const requestItems = document.querySelectorAll('.request-item');
                
                requestItems.forEach(item => {
                    const title = item.querySelector('.title').textContent.toLowerCase();
                    const location = item.querySelector('.location').textContent.toLowerCase();
                    
                    if (title.includes(searchTerm) || location.includes(searchTerm)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Show/hide no results message if needed
                const visibleItems = document.querySelectorAll('.request-item[style="display: flex;"]');
                const noResults = document.querySelector('.no-results');
                
                if (visibleItems.length === 0 && searchTerm !== '') {
                    // Create no results message if it doesn't exist
                    if (!noResults) {
                        const message = document.createElement('p');
                        message.className = 'no-results';
                        message.textContent = 'No matching booking requests found.';
                        document.querySelector('.request-list').appendChild(message);
                    } else {
                        noResults.style.display = 'block';
                    }
                } else if (noResults) {
                    noResults.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>