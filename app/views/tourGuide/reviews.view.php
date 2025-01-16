<!DOCTYPE html>
<html lang="en">
<head>
    <title>ExploreLK Tour Guide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexContainer">
        
        <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

        <div class="reviews">
            <div class="heading">
                <h2>Your reviews</h2>
            </div>

            <div class="rating-container">
                <!-- Main Rating and Stars -->
                <div>
                    <div class="main-rating">4.5</div>
                    <div class="star-rating">★★★★☆</div>
                    <div class="review-count">100 reviews</div>
                </div>
        
                <!-- Progress Bars -->
                <div class="progress-bars">
                    <div class="rating-row">
                        <div class="rating-label">5</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 60%;"></div>
                        </div>
                        <div class="progress-value">60%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">4</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 10%;"></div>
                        </div>
                        <div class="progress-value">10%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">3</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 10%;"></div>
                        </div>
                        <div class="progress-value">10%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">2</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 10%;"></div>
                        </div>
                        <div class="progress-value">10%</div>
                    </div>
                    <div class="rating-row">
                        <div class="rating-label">1</div>
                        <div class="progress">
                            <div class="progress-bar" style="width: 10%;"></div>
                        </div>
                        <div class="progress-value">10%</div>
                    </div>
                </div>
            </div>
        
            <!-- Individual Reviews -->
            <div class="review">
                <div class="review-header">
                    <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="User profile" class="profile-pic">
                    <div>
                        <strong>Abby</strong>
                        <span>June 2023</span>
                    </div>
                </div>
                <div class="stars">★★★★★</div>
                <p>The perfect place! Everything was exactly as described/pictured</p>
                <div class="review-actions">
                    <span>👍</span>
                    <span>👎</span>
                </div>
            </div>
        
            <div class="review">
                <div class="review-header">
                    <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="User profile" class="profile-pic">
                    <div>
                        <strong>Joe</strong>
                        <span>May 2023</span>
                    </div>
                </div>
                <div class="stars">★★★★★</div>
                <p>Beautifully decorated, very clean and comfortable for 9 adults. The kitchen was extremely well stocked which made cooking group dinners simple. The deck area was perfect with the added convenience of the private beach being steps from the door...</p>
                <div class="review-actions">
                    <span>👍</span>
                    <span>👎</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
