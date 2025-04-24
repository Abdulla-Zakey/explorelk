<?php 
  include '../app/views/components/rnav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        body {
            background-color: #f9fafb;
            color: #1f2937;
            line-height: 1.5;
        }

        /* Container Styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: #6b7280;
        }

        /* Review Card Styles */
        .reviews-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .review-card {
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            position: relative;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .review-card.highlighted {
            border: 2px solid #fbbf24;
            background-color: #fffbeb;
        }

        .review-card.hidden {
            display: none;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .reviewer-info {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .avatar {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background-color: #1f2937;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .reviewer-details {
            display: flex;
            flex-direction: column;
        }

        .reviewer-name-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .reviewer-name {
            font-weight: 600;
            color: #111827;
        }

        .highlight-badge {
            font-size: 0.75rem;
            padding: 0.125rem 0.5rem;
            background-color: #fef3c7;
            border: 1px solid #fbbf24;
            border-radius: 9999px;
            color: #92400e;
            font-weight: 500;
        }

        .review-date {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        .review-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Star Rating Styles */
        .star-rating {
            display: flex;
            gap: 0.125rem;
        }

        .star {
            color: #d1d5db;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .star.filled {
            color: #f59e0b;
        }

        /* Dropdown Menu Styles */
        .dropdown {
            position: relative;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            cursor: pointer;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            transition: background-color 0.2s ease;
        }

        .dropdown-toggle:hover {
            background-color: #f3f4f6;
        }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 12rem;
            z-index: 10;
            overflow: hidden;
            display: none;
            border: 1px solid #e5e7eb;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f3f4f6;
        }

        .dropdown-item.danger {
            color: #dc2626;
        }

        .dropdown-item i {
            font-size: 0.875rem;
            width: 1rem;
        }

        /* Review Text Styles */
        .review-text {
            color: #4b5563;
            line-height: 1.625;
        }

        /* Show Hidden Reviews Button */
        .show-hidden-btn {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: none;
        }

        .show-hidden-btn.visible {
            display: inline-block;
        }

        .show-hidden-btn:hover {
            background-color: #f3f4f6;
        }

        /* Responsive Styles */
        @media (max-width: 640px) {
            .review-header {
                flex-direction: column;
                gap: 1rem;
            }

            .review-actions {
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Guest Reviews</h1>
            <p>See what our guests have to say about their experience</p>
        </div>

        <div class="reviews-container" id="reviews-container">
            <!-- Reviews will be dynamically inserted here -->
        </div>

        <button id="show-hidden-btn" class="show-hidden-btn">
            Show <span id="hidden-count">0</span> hidden reviews
        </button>
    </div>

    <script>
        // Review data
        const reviewsData = [
            {
                id: "1",
                name: "Vijay Prasath",
                initial: "V",
                date: "18 August",
                text: "This hotel exceeded all expectations with its impeccable service, luxurious amenities, and beautifully designed spaces. Truly a gem in the heart of the city!",
                rating: 0,
                highlighted: false
            },
            {
                id: "2",
                name: "Akila Perera",
                initial: "A",
                date: "10 September",
                text: "The food was amazing, and the staff went out of their way to make us feel comfortable. The view from the room was breathtaking!",
                rating: 0,
                highlighted: false
            },
            {
                id: "3",
                name: "Jessica Lee",
                initial: "J",
                date: "22 July",
                text: "A perfect location for a weekend getaway. Clean rooms, friendly service, and amazing local cuisine. Highly recommend!",
                rating: 0,
                highlighted: false
            },
            {
                id: "4",
                name: "Mohammed Faheem",
                initial: "M",
                date: "5 June",
                text: "I stayed here for a business trip and everything was on point. The WiFi was strong, and the hotel ambiance helped me relax after a long day.",
                rating: 0,
                highlighted: false
            },
            {
                id: "5",
                name: "Lakshmi Patel",
                initial: "L",
                date: "15 April",
                text: "The spa treatments were absolutely rejuvenating! A great place for anyone looking to unwind and recharge.",
                rating: 0,
                highlighted: false
            }
        ];

        // Track hidden reviews
        const hiddenReviews = [];

        // DOM elements
        const reviewsContainer = document.getElementById('reviews-container');
        const showHiddenBtn = document.getElementById('show-hidden-btn');
        const hiddenCountSpan = document.getElementById('hidden-count');

        // Render all reviews
        function renderReviews() {
            reviewsContainer.innerHTML = '';
            
            reviewsData.forEach(review => {
                const isHidden = hiddenReviews.includes(review.id);
                if (!isHidden) {
                    const reviewElement = createReviewElement(review);
                    reviewsContainer.appendChild(reviewElement);
                }
            });

            // Update hidden reviews button
            if (hiddenReviews.length > 0) {
                showHiddenBtn.classList.add('visible');
                hiddenCountSpan.textContent = hiddenReviews.length;
            } else {
                showHiddenBtn.classList.remove('visible');
            }
        }

        // Create a single review element
        function createReviewElement(review) {
            const reviewCard = document.createElement('div');
            reviewCard.className = `review-card ${review.highlighted ? 'highlighted' : ''}`;
            reviewCard.dataset.id = review.id;

            reviewCard.innerHTML = `
                <div class="review-header">
                    <div class="reviewer-info">
                        <div class="avatar">${review.initial}</div>
                        <div class="reviewer-details">
                            <div class="reviewer-name-container">
                                <span class="reviewer-name">${review.name}</span>
                                ${review.highlighted ? '<span class="highlight-badge">Highlighted</span>' : ''}
                            </div>
                            <span class="review-date">${review.date}</span>
                        </div>
                    </div>
                    <div class="review-actions">
                        <div class="star-rating" data-review-id="${review.id}">
                            ${generateStars(review.rating)}
                        </div>
                        <div class="dropdown">
                            <button class="dropdown-toggle">
                                <i class="fas fa-ellipsis-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-item" data-action="reply">
                                    <i class="fas fa-reply"></i>
                                    <span>Reply</span>
                                </div>
                                <div class="dropdown-item" data-action="highlight">
                                    <i class="fas fa-star"></i>
                                    <span>${review.highlighted ? 'Unhighlight' : 'Highlight'}</span>
                                </div>
                                <div class="dropdown-item danger" data-action="hide">
                                    <i class="fas fa-eye-slash"></i>
                                    <span>Hide</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="review-text">${review.text}</p>
            `;

            // Add event listeners
            setupReviewEventListeners(reviewCard, review);

            return reviewCard;
        }

        // Generate star HTML based on rating
        function generateStars(rating) {
            let starsHtml = '';
            for (let i = 1; i <= 5; i++) {
                starsHtml += `<i class="star fas fa-star ${i <= rating ? 'filled' : ''}" data-value="${i}"></i>`;
            }
            return starsHtml;
        }

        // Setup event listeners for a review card
        function setupReviewEventListeners(reviewCard, review) {
            // Star rating
            const starRating = reviewCard.querySelector('.star-rating');
            const stars = starRating.querySelectorAll('.star');
            
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = parseInt(star.dataset.value);
                    updateRating(review.id, value);
                });
            });

            // Dropdown toggle
            const dropdownToggle = reviewCard.querySelector('.dropdown-toggle');
            const dropdownMenu = reviewCard.querySelector('.dropdown-menu');
            
            dropdownToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                // Close all other dropdowns first
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    if (menu !== dropdownMenu) {
                        menu.classList.remove('show');
                    }
                });
                dropdownMenu.classList.toggle('show');
            });

            // Dropdown actions
            const dropdownItems = reviewCard.querySelectorAll('.dropdown-item');
            
            dropdownItems.forEach(item => {
                item.addEventListener('click', () => {
                    const action = item.dataset.action;
                    
                    if (action === 'reply') {
                        alert(`Reply to ${review.name}'s review`);
                    } else if (action === 'highlight') {
                        toggleHighlight(review.id);
                    } else if (action === 'hide') {
                        hideReview(review.id);
                    }
                    
                    dropdownMenu.classList.remove('show');
                });
            });
        }

        // Update rating for a review
        function updateRating(reviewId, rating) {
            const reviewIndex = reviewsData.findIndex(r => r.id === reviewId);
            if (reviewIndex !== -1) {
                reviewsData[reviewIndex].rating = rating;
                
                // Update stars in the UI
                const starContainer = document.querySelector(`.star-rating[data-review-id="${reviewId}"]`);
                const stars = starContainer.querySelectorAll('.star');
                
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('filled');
                    } else {
                        star.classList.remove('filled');
                    }
                });
            }
        }

        // Toggle highlight for a review
        function toggleHighlight(reviewId) {
            const reviewIndex = reviewsData.findIndex(r => r.id === reviewId);
            if (reviewIndex !== -1) {
                reviewsData[reviewIndex].highlighted = !reviewsData[reviewIndex].highlighted;
                renderReviews();
            }
        }

        // Hide a review
        function hideReview(reviewId) {
            if (!hiddenReviews.includes(reviewId)) {
                hiddenReviews.push(reviewId);
                renderReviews();
            }
        }

        // Show all hidden reviews
        function showHiddenReviews() {
            hiddenReviews.length = 0;
            renderReviews();
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
        });

        // Show hidden reviews button click handler
        showHiddenBtn.addEventListener('click', showHiddenReviews);

        // Initial render
        renderReviews();
    </script>
</body>
</html>