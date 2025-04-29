<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reviews</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/reviews.css?v=1.2">
</head>
<body>
    <main>
        <div class="reviews-container">
            <header>
                <!-- <h1>Reviews for <?= htmlspecialchars($data['hotelBasic']->name ?? 'Hotel') ?></h1> -->
                <?php if ($data['total_reviews'] > 0): ?>
                    <h3>Average Rating: <?= $data['average_rating'] ?> / 5 (<?= $data['total_reviews'] ?> reviews)</h3>
                <?php else: ?>
                    <h3>No reviews yet.</h3>
                <?php endif; ?>
            </header>

            <?php if (!empty($data['errors'])): ?>
                <?php foreach ($data['errors'] as $error): ?>
                    <div class="error"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="reviews-list">
                <?php if (!empty($data['reviews'])): ?>
                    <?php foreach ($data['reviews'] as $review): ?>
                        <div class="review">
                            <?php if (!empty($review->profilePicture)): ?>
                                <img class="profile-picture" src="<?= UPLOADS ?>/travelers/userProfilePics/<?= htmlspecialchars($review->profilePicture) ?>" alt="Profile Picture">
                            <?php else: ?>
                                <span class="profile-initial"><?= strtoupper(substr($review->fname, 0, 1)) ?></span>
                            <?php endif; ?>
                            <div class="review-content">
                                <div class="review-header">
                                    <span class="reviewer"><?= htmlspecialchars($review->username ?: ($review->fname . ' ' . $review->lname)) ?></span>
                                    <span class="rating"><?= str_repeat('★', $review->rating) . str_repeat('☆', 5 - $review->rating) ?></span>
                                    <!-- <div class="more-options">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <div class="options-popup">
                                            <div>Edit</div>
                                            <div>Delete</div>
                                        </div>
                                    </div> -->
                                </div>
                                <p class="review-text"><?= htmlspecialchars($review->review_text) ?></p>
                                <small class="review-date"><?= date('F j, Y', strtotime($review->created_at)) ?></small>
                                <div class="reply-box" style="display: none;">
                                    <textarea class="reply-textarea" placeholder="Write a reply..."></textarea>
                                    <button class="reply-submit">Submit Reply</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No reviews available for this hotel.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners for the more options buttons
        const moreOptions = document.querySelectorAll('.more-options');
        
        moreOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.stopPropagation();
                const popup = this.querySelector('.options-popup');
                popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
            });
        });
        
        // Close popup when clicking elsewhere
        document.addEventListener('click', function() {
            document.querySelectorAll('.options-popup').forEach(popup => {
                popup.style.display = 'none';
            });
        });
    });
    </script>
</body>
</html>