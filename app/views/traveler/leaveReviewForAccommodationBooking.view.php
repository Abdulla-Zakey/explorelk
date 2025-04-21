<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/leaveReviewForAccommodationBooking.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Leave Review</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/MyBookings">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </nav>
    </header>

    <div class="container" style="margin-top: 7.5%;">
        <div class="review-container">
            <div class="review-content">
                <div class="review-header">
                    <h1 class="review-title">
                        <span>Leave a Review - <?= htmlspecialchars($data['hotelData']->hotelName) ?></span>
                        <div class="booking-status status-completed">
                            <?= htmlspecialchars($data['bookingData']->booking_status) ?>
                        </div>
                    </h1>
                </div>

                <h2 class="section-title" style="margin-top: 30px;">
                    <span class="icon icon-hotel"></span>
                    Hotel Information
                </h2>

                <div class="hotel-card">
                    <img 
                        src="<?= ROOT . '/' . htmlspecialchars($data['hotelData']->thumbnail_picPath) ?>" 
                        alt="<?= htmlspecialchars($data['hotelData']->hotelName) ?>" 
                        class="hotel-image"
                    >

                    <div class="hotel-details">
                        <div class="hotel-name">
                            <?= htmlspecialchars($data['hotelData']->hotelName) ?>
                        </div>

                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                <?= htmlspecialchars($data['hotelData']->hotelAddress) ?>
                            </span>
                        </div>

                        <div class="booking-dates">
                            <i class="fas fa-calendar-alt"></i>
                            <span>
                                <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_in))) ?> -
                                <?= htmlspecialchars(date('F d, Y', strtotime($data['bookingData']->check_out))) ?>
                            </span>
                        </div>

                    </div>
                </div>

                <form id = "reviewForm" action="<?= ROOT ?>/traveler/LeaveReviewForAccommodationBooking/submitReview" method="POST">
                    <input type="hidden" name="room_booking_Id" value="<?= htmlspecialchars($data['bookingData']->room_booking_Id) ?>">
                    <input type="hidden" name="hotel_Id" value="<?= htmlspecialchars($data['hotelData']->hotel_Id) ?>">

                    <div class="review-grid">
                        <!-- Left Column -->
                        <div class="left-column">
                            <!-- Review Section -->
                            <div class="review-section">
                                <h2 class="section-title">
                                    <span class="icon icon-comment"></span>
                                    Your Review
                                </h2>

                                <div class="review-form-group">
                                    <label for="review_text">Your Review<span class="required">*</span></label>
                                    <textarea style="resize: none;" id="review_text" name="review_text" rows="9"
                                        placeholder="Tell others about your experience. What did you like or dislike? What would you recommend to other travelers?"
                                        required></textarea>
                                    <div class="char-count">
                                        <span id="char-counter">0</span>/500 characters
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="right-column">
                            <!-- Rating Section -->
                            <div class="review-section">
                                <h2 class="section-title">
                                    <span class="icon icon-star"></span>
                                    Your Rating
                                </h2>

                                <div class="rating-categories">
                                    <div class="rating-category">
                                        <div class="category-label">
                                            Overall Rating
                                        </div>
                                        <div class="star-rating">
                                            <i class="far fa-star" data-value="1"></i>
                                            <i class="far fa-star" data-value="2"></i>
                                            <i class="far fa-star" data-value="3"></i>
                                            <i class="far fa-star" data-value="4"></i>
                                            <i class="far fa-star" data-value="5"></i>
                                            <input type = "hidden" name = "tempRatingHolder" id = "tempRatingHolder" value = "0">
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="overall-rating">
                                    <div class="overall-label">
                                        Overall Rating
                                    </div>

                                    <div class="overall-stars">
                                        <span id="overall-score">0</span>/5
                                    </div>
                                    <input type="hidden" name="overall_rating" id="overall_rating" value="0">
                                </div>

                            </div>

                        </div>
                    </div>
                </form>

                <div class="review-disclaimer">
                    <p>
                        <i class="fas fa-info-circle"></i> 
                        By submitting this review, you agree to our review guidelines and 
                        confirm that this is your genuine experience at this accommodation.
                    </p>
                </div>

            </div>

        </div>

        <div class="form-actions">
            <button type="button" class="cancel-button" onclick="window.location.href='<?= ROOT ?>/traveler/MyBookings'">
                <i class="fas fa-times"></i> 
                Cancel
            </button>

            <button type="button" id="submitReviewBtn" class="submit-button" disabled>
                <i class="fas fa-paper-plane"></i> 
                Submit Review
            </button>
        </div>
    </div>


    <script>
        // Star rating functionality
        document.querySelectorAll('.star-rating').forEach(ratingGroup => {
            const stars = ratingGroup.querySelectorAll('i');
            const hiddenInput = document.getElementById('tempRatingHolder');

            stars.forEach(star => {
                star.addEventListener('mouseover', function () {
                    const rating = this.getAttribute('data-value');
                    highlightStars(stars, rating);
                });

                star.addEventListener('mouseout', function () {
                    const currentRating = hiddenInput.value;
                    highlightStars(stars, currentRating);
                });

                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-value');
                    hiddenInput.value = rating;
                    highlightStars(stars, rating);
                    updateOverallRating();
                    checkFormValidity();
                });
            });
        });

        // Helper function to highlight stars
        function highlightStars(stars, rating) {
            stars.forEach(star => {
                const value = star.getAttribute('data-value');
                if (value <= rating) {
                    star.classList.remove('far');
                    star.classList.add('fas');
                } else {
                    star.classList.remove('fas');
                    star.classList.add('far');
                }
            });
        }

        // Update overall rating - simplified to just use the single cleanliness rating
        function updateOverallRating() {
            const rating = parseInt(document.querySelector('input[name="tempRatingHolder"]').value) || 0;
            document.getElementById('overall-score').textContent = rating;
            document.getElementById('overall_rating').value = rating;
        }

        // Character counter for review text
        const reviewTextArea = document.getElementById('review_text');
        const charCounter = document.getElementById('char-counter');

        reviewTextArea.addEventListener('input', function () {
            const charCount = this.value.length;
            charCounter.textContent = charCount;

            if (charCount > 500) {
                charCounter.style.color = 'var(--danger-color)';
                this.value = this.value.substring(0, 500);
                charCounter.textContent = 500;
            } else {
                charCounter.style.color = '';
            }

            checkFormValidity();
        });

        // Check form validity to enable/disable submit button
        function checkFormValidity() {
            const reviewText = document.getElementById('review_text').value.trim();
            const overallRating = parseFloat(document.getElementById('overall_rating').value);

            const isValid = ((reviewText.length > 0 || reviewText.length <= 500) && overallRating > 0);

            document.getElementById('submitReviewBtn').disabled = !isValid;
        }

        // Initialize form validation on page load
        document.addEventListener('DOMContentLoaded', function () {
            checkFormValidity();
        });

        // Submit button click event
        document.getElementById('submitReviewBtn').addEventListener('click', function () {
            document.getElementById('reviewForm').submit();
        });
    </script>
</body>

</html>