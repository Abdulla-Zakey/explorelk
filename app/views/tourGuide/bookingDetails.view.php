<?php
    $bookingDetails = $data['bookingDetails'];
    $tourPackage = $data['tourPackage'];
    $traveler = $data['traveler'];
    $image = $data['image'];
    $tourPackageItineraries = $data['tourPackageItinerary'];
    $dayActivities = $data['dayActivities'];
    // show($image);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/bookingDetails.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal {
        background: white;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .modal-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .modal-btn {
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    .modal-btn-primary {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .modal-btn-secondary {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <div class="main-container">
            <div class="sub-heading">
                <a class="back_button" href="<?= ROOT ?>/tourGuide/C_bookings"><i class="fas fa-arrow-left"></i> Back to
                    Bookings</a>
            </div>

            <div class="booking-detail-container">
                <div class="booking-header">
                    <h1 class="booking-title"><?= $tourPackage['0']->name ?> - <?= $tourPackage['0']->duration_days ?>
                        Day</h1>
                    <span
                        class="booking-status <?= $bookingDetails['0']->status ?>"><?= $bookingDetails['0']->status ?></span>
                </div>

                <img src="<?= ROOT . '/' .$image->image_path ?>" alt="Elia Adventure" class="tour-image">

                <div class="booking-content">
                    <div class="tourist-info-section">
                        <h3 class="section-title"><i class="fas fa-user"></i> Tourist Information</h3>

                        <div class="info-grid">
                            <div class="info-item">
                                <p class="info-label">Name</p>
                                <p class="info-value"><?= $traveler['0']->fName . ' ' . $traveler['0']->lName ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Email</p>
                                <p class="info-value"><?= $traveler['0']->travelerEmail ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Phone</p>
                                <p class="info-value"><?= $traveler['0']->travelerMobileNum ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Language</p>
                                <p class="info-value"><?= $tourPackage['0']->languages ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Number of Guests</p>
                                <p class="info-value"><?= $tourPackage['0']->group_size ?></p>
                            </div>
                        </div>

                        <?php if($bookingDetails['0']->special_instructions): ?>
                        <div class="special-instructions">
                            <p class="instructions-title"><i class="fas fa-exclamation-circle"></i> Special Instructions
                            </p>
                            <p class="instructions-content"><?= $bookingDetails['0']->special_instructions ?></p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="tour-info-section">
                        <h3 class="section-title"><i class="fas fa-map-marked-alt"></i> Tour Information</h3>

                        <div class="info-grid">
                            <div class="info-item">
                                <p class="info-label">Package Name</p>
                                <p class="info-value"><?= $tourPackage['0']->name; ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Duration</p>
                                <p class="info-value"><?= $tourPackage['0']->duration_days; ?> days</p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Date</p>
                                <p class="info-value"><?= $bookingDetails['0']->tour_date ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Start Time</p>
                                <p class="info-value"><?= $bookingDetails['0']->start_time ?></p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Meeting Point</p>
                                <p class="info-value">Elia Bus Station</p>
                            </div>

                            <div class="info-item">
                                <p class="info-label">Price</p>
                                <p class="info-value">LKR <?= $tourPackage['0']->package_price; ?>
                                    (<?= $bookingDetails['0']->payment_status ?>)</p>
                            </div>
                        </div>

                        <h3 class="section-title" style="margin-top: 30px;"><i class="fas fa-route"></i> Itinerary</h3>

                        <?php foreach($tourPackageItineraries as $tourPackageItinerary): 
                            $currentDayId = $tourPackageItinerary->day_id;
                            $currentDayActivities = $dayActivities[$currentDayId] ?? [];
                        ?>
                        <div style="margin-top: 15px;">
                            <h4 style="color: #002D40; margin-bottom: 10px;">Day
                                <?= $tourPackageItinerary->day_number ?></h4>

                            <ul style="list-style-type: none;">
                                <?php foreach($currentDayActivities as $activity): ?>
                                <li style="margin-bottom: 10px; padding-left: 20px; position: relative;">
                                    <i class="fas fa-sun" style="position: absolute; left: 0; color: #28a745;"></i>
                                    <strong><?= $activity->activity_time ?>:</strong> <?= $activity->title ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="action-button contact-button"><i class="fas fa-comment-dots"></i> Contact
                        Tourist</button>

                    <?php if($bookingDetails['0']->status != 'completed' && $bookingDetails['0']->status != 'started'): ?>
                    <button class="action-button cancel-button"><i class="fas fa-times-circle"></i> Cancel Tour</button>
                    <?php endif; ?>

                    <?php if($bookingDetails['0']->status == 'started'): ?>
                    <button class="action-button complete-button"><i class="fas fa-check-circle"></i> Mark as
                        Completed</button>
                    <?php elseif($bookingDetails['0']->status == 'upcoming'): ?>
                    <button class="action-button complete-button"><i class="fas fa-check-circle"></i> Start
                        tour</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- //Modal for start tour and end tour -->
    <div class="modal-overlay" id="customModal">
        <div class="modal">
            <div class="modal-icon">
                <i id="modalIcon" class="fas fa-check-circle"></i>
            </div>
            <h3 class="modal-title" id="modalTitle">Start Tour</h3>
            <p class="modal-message" id="modalMessage">Are you sure you want to start this tour?</p>
            <div class="modal-buttons">
                <button class="modal-btn modal-btn-secondary" id="modalCancel">Cancel</button>
                <button class="modal-btn modal-btn-primary" id="modalConfirm">Confirm</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get elements
        const modal = document.getElementById('customModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const modalIcon = document.getElementById('modalIcon');
        const modalConfirm = document.getElementById('modalConfirm');
        const modalCancel = document.getElementById('modalCancel');

        // Get booking ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        const bookingId = urlParams.get('booking_id');

        console.log(`Loading details for booking ${bookingId}`);

        // Cancel button event
        document.querySelector('.cancel-button').addEventListener('click', function() {
            showModal(
                'Cancel Tour',
                'Are you sure you want to cancel this tour?',
                'fa-times-circle',
                'red',
                function() {
                    // Here you would make an API call to cancel the booking
                    // For example: window.location.href = `<?= ROOT ?>/tourGuide/cancelTour?id=${bookingId}`;
                    alert('Tour cancellation request sent.');
                    hideModal();
                }
            );
        });

        // Complete/Start tour button event
        document.querySelector('.complete-button').addEventListener('click', function() {
            const status = '<?= $bookingDetails['0']->status ?>' === 'upcoming' ? 'start' : 'complete';
            if (status === 'start') {
                showModal(
                    'Start Tour',
                    'Are you ready to start this tour?',
                    'fa-play-circle',
                    '#28a745',
                    function() {
                        // Here you would make an API call to start the tour
                        window.location.href =
                            `<?= ROOT ?>/tourGuide/C_bookingDetails/startTour?id=${bookingId}`;
                        // alert('Tour marked as started.');
                        hideModal();
                    }
                );
            } else {
                showModal(
                    'Complete Tour',
                    'Mark this tour as completed?',
                    'fa-check-circle',
                    '#28a745',
                    function() {
                        // Here you would make an API call to complete the tour
                        window.location.href =
                            `<?= ROOT ?>/tourGuide/C_bookingDetails/completeTour?id=${bookingId}`;
                        // alert('Tour marked as completed.');
                        hideModal();
                    }
                );
            }
        });

        // Modal cancel button event
        modalCancel.addEventListener('click', hideModal);

        // Function to show modal
        function showModal(title, message, iconClass, iconColor, confirmCallback) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modalIcon.className = `fas ${iconClass}`;
            modalIcon.style.color = iconColor;

            // Set confirm button action
            modalConfirm.onclick = confirmCallback;

            // Show modal
            modal.style.display = 'flex';
        }

        // Function to hide modal
        function hideModal() {
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideModal();
            }
        });
    });
    </script>
</body>

</html>