<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>

<html>
    <head>
        <title>Reviews</title>
        <style>
            body {
                font-family: 'poppins';
                background-color: #f5f5f5;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 20;
            }
            .review-card {
                background-color: #ffffff;
                border-radius: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 1000px;
                position: absolute;
                top: 220px;
                left: 330px;
            }
            .profile-pic, .profile-initial {
                border-radius: 50%;
                width: 50px;
                height: 50px;
                position: absolute;
                top: 20px;
                left: 20px;
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
                margin-left: 80px;
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
            .reply-box {
                margin-top: 20px;
                padding: 10px;
                border: 1px solid #e0e0e0;
                border-radius: 5px;
                background-color: #ffffff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                display: none;
            }
            .reply-textarea {
                width: 100%;
                height: 80px;
                padding: 10px;
                border: 1px solid #cccccc;
                border-radius: 5px;
                font-size: 14px;
                margin-bottom: 10px;
                resize: none;
            }
            .reply-submit {
                padding: 8px 12px;
                background-color: #007bff;
                color: #ffffff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .reply-submit:hover {
                background-color: #0056b3;
            }
        </style>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
        <script>
            function rateStar(star, reviewId) {
                const stars = document.querySelectorAll(`#review-${reviewId} .rating i`);
                let rating = 0;
                stars.forEach((s, index) => {
                    if (index <= star) {
                        s.classList.remove('unrated');
                        rating = index + 1;
                    } else {
                        s.classList.add('unrated');
                    }
                });
                console.log(`Rated: ${rating} stars for review-${reviewId}`);
            }

            function toggleOptions(reviewId) {
                const popup = document.querySelector(`#review-${reviewId} .options-popup`);
                popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
            }

            function showReplyBox(reviewId) {
                const replyBox = document.getElementById(`reply-box-${reviewId}`);
                replyBox.style.display = replyBox.style.display === 'none' ? 'block' : 'none';
            }

            function submitReply(reviewId) {
                const replyBox = document.getElementById(`reply-box-${reviewId}`);
                const textarea = replyBox.querySelector('.reply-textarea');
                const replyText = textarea.value.trim();

                if (replyText) {
                    console.log(`Reply submitted for review-${reviewId}: ${replyText}`);
                    textarea.value = '';
                    replyBox.style.display = 'none';
                } else {
                    alert('Reply cannot be empty!');
                }
            }

            window.onclick = function(event) {
                if (!event.target.matches('.more-options, .more-options i')) {
                    const popups = document.querySelectorAll('.options-popup');
                    popups.forEach(popup => {
                        if (popup.style.display === 'block') {
                            popup.style.display = 'none';
                        }
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Set profile pictures (example logic).
            });
        </script>
    </head>
    <body>
        <!-- Review 1 -->
        <div id="review-1" class="review-card">
            <img alt="Profile picture of the reviewer" class="profile-pic" height="50" src="" width="50"/>
            <div class="profile-initial"></div>
            <div class="review-content">
                <div class="review-header">
                    <h3>Vijay Prasath</h3>
                    <p class="review-date">18 August</p>
                </div>
                <p class="review-text">
                    This hotel exceeded all expectations with its impeccable service, luxurious amenities, and beautifully designed spaces. The attention to detail in every aspect of the stay. It's an unforgettable experience. Truly a gem in the heart of the city!
                </p>
            </div>
            <div class="rating">
                <i class="fas fa-star unrated" onclick="rateStar(0, 1)"></i>
                <i class="fas fa-star unrated" onclick="rateStar(1, 1)"></i>
                <i class="fas fa-star unrated" onclick="rateStar(2, 1)"></i>
                <i class="fas fa-star unrated" onclick="rateStar(3, 1)"></i>
                <i class="fas fa-star unrated" onclick="rateStar(4, 1)"></i>
            </div>
            <div class="more-options" onclick="toggleOptions(1)">
                <i class="fas fa-ellipsis-h" style="transform: rotate(90deg);"></i>
            </div>
            <div class="options-popup">
                <div onclick="showReplyBox(1)">Reply</div>
                <div>Highlight</div>
            </div>
            <div id="reply-box-1" class="reply-box">
                <textarea placeholder="Write your reply..." class="reply-textarea"></textarea>
                <button class="reply-submit" onclick="submitReply(1)">Submit</button>
            </div>
        </div>
        
        <!-- Repeat the above block for Review 2 and Review 3, updating IDs as needed. -->

    </body>
</html>
