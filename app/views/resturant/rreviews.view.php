<?php 
  include '../app/views/components/rnav.php';
  include '../app/views/components/rhotelhead.php';

?>
<html>
    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f5f5f5;
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px;
                margin: 0;
            }
            .review-card {
                display: flex;
                background-color: #ffffff;
                border-radius: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 100%;
                max-width: 1000px;
                margin-bottom: 20px; /* Adds space between cards */
                position: relative; /* Ensures proper stacking */
            }
            .profile-pic, .profile-initial {
                border-radius: 50%;
                width: 50px;
                height: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 24px;
                color: #ffffff;
                background-color: #333333;
            }
            .profile-pic {
                display: none;
            }
            .review-content {
                margin-left: 25px;
            }
            .review-header {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                margin-bottom: 10px;
            }
            .review-header h3 {
                margin: 0;
                font-size: 18px;
                color: #333333;
            }
            .review-date {
                font-size: 12px;
                color: #999999;
                margin-top: 5px;
            }
            .review-text {
                font-size: 14px;
                color: #666666;
                margin: 0;
            }
            .rating {
                display: flex;
                align-items: center;
                position: absolute;
                top: 20px;
                right: 60px;
            }
            .rating i {
                color: #f5c518;
                margin-right: 2px;
                cursor: pointer;
            }
            .rating i.unrated {
                color: #e0e0e0;
            }
            .rating i:last-child {
                margin-right: 0;
            }
            .more-options {
                position: absolute;
                top: 20px;
                right: 20px;
                cursor: pointer;
            }
            .more-options i {
                color: #999999;
                display: block;
                margin-bottom: 2px;
            }
            .options-popup {
                display: none;
                position: absolute;
                top: 40px;
                right: 20px;
                background-color: #ffffff;
                border: 1px solid #e0e0e0;
                border-radius: 5px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                z-index: 10;
            }
            .options-popup div {
                padding: 10px;
                cursor: pointer;
                font-size: 14px;
                color: #333333;
            }
            .options-popup div:hover {
                background-color: #f5f5f5;
            }
            .review-container{
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-top: 200px;
                margin-left: 240px;
            }
            .review-card:nth-child(1) {
                margin-top: 20px;
            }
        </style>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <script>
            // JavaScript remains the same
            function rateStar(starIndex, cardIndex) {
                const reviewCards = document.querySelectorAll('.review-card');
                const stars = reviewCards[cardIndex].querySelectorAll('.rating i');
                stars.forEach((star, index) => {
                    if (index <= starIndex) {
                        star.classList.remove('unrated');
                    } else {
                        star.classList.add('unrated');
                    }
                });
                console.log(`Review ${cardIndex + 1}: Rated ${starIndex + 1} stars`);
            }

            function toggleOptions() {
                const popup = document.querySelector('.options-popup');
                popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
            }

            window.onclick = function(event) {
                if (!event.target.matches('.more-options, .more-options i')) {
                    const popup = document.querySelector('.options-popup');
                    if (popup.style.display === 'block') {
                        popup.style.display = 'none';
                    }
                }
            }

            function setProfilePicture(imageUrl, name) {
                const profilePic = document.querySelector('.profile-pic');
                const profileInitial = document.querySelector('.profile-initial');
                if (imageUrl) {
                    profilePic.src = imageUrl;
                    profilePic.style.display = 'block';
                    profileInitial.style.display = ' none';
                } else {
                    profileInitial.textContent = name.charAt(0).toUpperCase();
                    profilePic.style.display = 'none';
                    profileInitial.style.display = 'flex';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const reviewCards = document.querySelectorAll('.review-card');

                reviewCards.forEach((card, cardIndex) => {
                    // Star rating logic
                    const stars = card.querySelectorAll('.rating i');
                    stars.forEach((star, starIndex) => {
                        star.addEventListener('click', () => {
                            stars.forEach((s, i) => {
                                if (i <= starIndex) {
                                    s.classList.remove('unrated');
                                } else {
                                    s.classList.add('unrated');
                                }
                            });
                            console.log(`Review ${cardIndex + 1}: Rated ${starIndex + 1} stars`);
                        });
                    });

                    // Popup toggle logic
                    const moreOptionsButton = card.querySelector('.more-options');
                    const optionsPopup = card.querySelector('.options-popup');

                    moreOptionsButton.addEventListener('click', (event) => {
                        // Close all other popups
                        document.querySelectorAll('.options-popup').forEach((popup, index) => {
                            if (index !== cardIndex) {
                                popup.style.display = 'none';
                            }
                        });

                        // Toggle the current popup
                        optionsPopup.style.display = optionsPopup.style.display === 'block' ? 'none' : 'block';

                        // Prevent event from propagating to window
                        event.stopPropagation();
                    });
                });

                // Close popup when clicking outside
                window.addEventListener('click', function () {
                    document.querySelectorAll('.options-popup').forEach((popup) => {
                        popup.style.display = 'none';
                    });
                });
            });

        </script>
    </head>
    <body>
        <div class="review-container">
        <!-- Review 1 -->
            <div class="review-card">
                <div class="profile-initial">V</div>
                <div class="review-content">
                    <div class="review-header">
                        <h3>Vijay Prasath</h3>
                        <p class="review-date">18 August</p>
                    </div>
                    <p class="review-text">
                        This hotel exceeded all expectations with its impeccable service, luxurious amenities, and beautifully designed spaces. Truly a gem in the heart of the city!
                    </p>
                </div>
                <div class="rating">
                    <i class="fas fa-star unrated" onclick="rateStar(0)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(1)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(2)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(3)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(4)">
                    </i>
                </div>
                <div class="more-options" onclick="toggleOptions()">
                    <i class="fas fa-ellipsis-h" style="transform: rotate(90deg);">
                    </i>
                </div>
                <div class="options-popup">
                    <div>
                        Reply
                    </div>
                    <div>
                        Highlight
                    </div>
                    <div>
                        Hide
                    </div>
                </div>
            </div>

            <!-- Review 2 -->
            <div class="review-card">
                <div class="profile-initial">A</div>
                <div class="review-content">
                    <div class="review-header">
                        <h3>Akila Perera</h3>
                        <p class="review-date">10 September</p>
                    </div>
                    <p class="review-text">
                        The food was amazing, and the staff went out of their way to make us feel comfortable. The view from the room was breathtaking!
                    </p>
                </div>
                <div class="rating">
                    <i class="fas fa-star unrated" onclick="rateStar(0)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(1)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(2)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(3)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(4)">
                    </i>
                </div>
                <div class="more-options" onclick="toggleOptions()">
                    <i class="fas fa-ellipsis-h" style="transform: rotate(90deg);">
                    </i>
                </div>
                <div class="options-popup">
                    <div>
                        Reply
                    </div>
                    <div>
                        Highlight
                    </div>
                    <div>
                        Hide
                    </div>
                </div>
            </div>

            <!-- Review 3 -->
            <div class="review-card">
                <div class="profile-initial">J</div>
                <div class="review-content">
                    <div class="review-header">
                        <h3>Jessica Lee</h3>
                        <p class="review-date">22 July</p>
                    </div>
                    <p class="review-text">
                        A perfect location for a weekend getaway. Clean rooms, friendly service, and amazing local cuisine. Highly recommend!
                    </p>
                </div>
                <div class="rating">
                    <i class="fas fa-star unrated" onclick="rateStar(0)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(1)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(2)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(3)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(4)">
                    </i>
                </div>
                <div class="more-options" onclick="toggleOptions()">
                    <i class="fas fa-ellipsis-h" style="transform: rotate(90deg);">
                    </i>
                </div>
                <div class="options-popup">
                    <div>
                        Reply
                    </div>
                    <div>
                        Highlight
                    </div>
                    <div>
                        Hide
                    </div>
                </div>
            </div>

            <!-- Review 4 -->
            <div class="review-card">
                <div class="profile-initial">M</div>
                <div class="review-content">
                    <div class="review-header">
                        <h3>Mohammed Faheem</h3>
                        <p class="review-date">5 June</p>
                    </div>
                    <p class="review-text">
                        I stayed here for a business trip and everything was on point. The WiFi was strong, and the hotel ambiance helped me relax after a long day.
                    </p>
                </div>
                <div class="rating">
                    <i class="fas fa-star unrated" onclick="rateStar(0)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(1)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(2)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(3)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(4)">
                    </i>
                </div>
                <div class="more-options" onclick="toggleOptions()">
                    <i class="fas fa-ellipsis-h" style="transform: rotate(90deg);">
                    </i>
                </div>
                <div class="options-popup">
                    <div>
                        Reply
                    </div>
                    <div>
                        Highlight
                    </div>
                    <div>
                        Hide
                    </div>
                </div>
            </div>

            <!-- Review 5 -->
            <div class="review-card">
                <div class="profile-initial">L</div>
                <div class="review-content">
                    <div class="review-header">
                        <h3>Lakshmi Patel</h3>
                        <p class="review-date">15 April</p>
                    </div>
                    <p class="review-text">
                        The spa treatments were absolutely rejuvenating! A great place for anyone looking to unwind and recharge.
                    </p>
                </div>
                <div class="rating">
                    <i class="fas fa-star unrated" onclick="rateStar(0)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(1)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(2)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(3)">
                    </i>
                    <i class="fas fa-star unrated" onclick="rateStar(4)">
                    </i>
                </div>
                <div class="more-options" onclick="toggleOptions()">
                    <i class="fas fa-ellipsis-h" style="transform: rotate(90deg);">
                    </i>
                </div>
                <div class="options-popup">
                    <div>
                        Reply
                    </div>
                    <div>
                        Highlight
                    </div>
                    <div>
                        Hide
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
