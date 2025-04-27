<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewTourGuideProfile.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | View Guide Profile</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        .backToHome,
        .nav-links {
            font-size: 1.6rem;
        }

        .foot {
            font-size: 1.4rem;
        }
    </style>
</head>

<body>
    <?php
        // show($data);
        // exit();
    ?>

    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a href="javascript:void(0);" onclick="window.history.back();">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

        </nav>
    </header>

    <div class="main-container">

        <div class="profilePicAndDetails-container">

            <div class="guideProfilePic-container">
                <img src = "<?= IMAGES ?>/Travelers/userProfilePics/defaultUserIcon.png">
            </div>

            <div class="profileDetails-container">

                <span id="guideName" class="guideName">
                    <?= $data['guideData']->firstName . $data['guideData']->lastName ?>
                </span>

                <p id="guideBio" class="guideBio">
                    <?= $data['guideData']->guideBio ?>
                </p>

                <div class="basicInfo">

                    <div class="row">

                        <div>
                            <i class="fas fa-birthday-cake"></i><span class="highlight">Age:</span> &nbsp;<?= $data['guideData']->age ?>
                        </div>

                        <div>
                            <i class="fas fa-award"></i><span class="highlight">Experience:</span> &nbsp;<?= $data['guideData']->experience ?> Years
                        </div>

                        <div>
                            <i class="fas fa-route"></i><span class="highlight">Field of Expertise:</span>
                            &nbsp;&nbsp;&nbsp;<i class="fas fa-hiking"></i><?= $data['guideData']->fieldsOfExpertise ?> &nbsp;&nbsp;&nbsp;
                        </div>
                        
                    </div>

                </div>

            </div>

        </div>

        <div class="upcomingTours">
            <span class="subTopic">
                Upcoming Tours of <?= $data['guideData']->firstName . $data['guideData']->lastName ?>
            </span>

            <div class="imageContainer">

                <?php
                    if(!empty($data['upcomingTours'])){
                        $counter = 0;
                        
                        foreach($data['upcomingTours'] as $upcomingTour){
                            if($counter % 3 == 0){
                                echo '<div class="imageContainer">';
                            }
                ?>
                            <div class="<?= ($counter % 3 == 0) ? 'leftImg' : (($counter % 3 == 1) ? 'midImg' : 'rightImg') ?>">    
                                <a href = "<?= ROOT ?>/traveler/ViewParticularTour/index/<?= $upcomingTour->package_id?>">  
                                    <img src="<?= ROOT . $upcomingTour->primaryImage ?>">
                                    <p>
                                        <?= $upcomingTour->name ?>
                                    </p>
                                </a>
                            </div>
                <?php

                            $counter++;

                            if($counter == count($data['upcomingTours'])){                          
                                
                                echo '</div>';

                            }
                            
                        }

                    }else{
                        echo '<div class="no-events-container">';

                            echo '<div class="no-events-content">';

                                echo '<div class="calendar-icon">';
                                    echo '<div class="calendar-top"></div>';
                                    echo '<div class="calendar-body">';
                                        echo '<div class="cross">×</div>';
                                    echo '</div>';
                                echo '</div>';

                                echo '<h3>Currently No Upcoming Events</h3>';
                                echo '<p class = "para">We are working on bringing exciting new experiences your way. Check back soon!</p>';
        
                            echo '</div>';
                        echo '</div>';
                    }
                        
                ?>

            </div>

        </div>

        <section id="guest-reviews">

            <h1>
                User Testimonials
            </h1>

            <div class="reviews-row">
                <!-- Review 1 -->
                <div class="review-card">
                    <p>
                        Stayed at Delhousie Hotel before climbing Adam’s Peak.
                        The mountain view is breathtaking, and rooms were clean and comfy.
                        Friendly staff gave great hiking tips. Highly recommend for anyone visiting!
                    </p>
                    <div class="review-footer">
                        <img src="assets/images/findaHotel/reviews/img1.png" alt="Profile Picture" class="review-dp">
                        <div class="user-info">
                            <span class="username">Michel Johnson</span>
                            <span class="posted-date">13 December 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="review-card">
                    <p>
                        Delhousie Hotel is great for Adam’s Peak visitors. The room was basic but met needs.
                        Staff was polite, though service was sometimes slow.
                        It’s a decent choice for a convenient, no-frills stay before the hike.
                    </p>
                    <div class="review-footer">
                        <img src="assets/images/findaHotel/reviews/img2.png" alt="Profile Picture" class="review-dp">
                        <div class="user-info">
                            <span class="username">Lara Brown</span>
                            <span class="posted-date">19 September 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reviews-row">
                <!-- Review 1 -->
                <div class="review-card">
                    <p>
                        Delhousie Hotel is in the perfect spot for those planning to climb Adam's Peak.
                        The early breakfast and proximity to the trailhead made everything so convenient.
                        The room was basic but had everything we needed after a long day. Will definitely stay here
                        again!
                    </p>
                    <div class="review-footer">
                        <img src="assets/images/findaHotel/reviews/img6.jpg" alt="Profile Picture" class="review-dp">
                        <div class="user-info">
                            <span class="username">Ammy Jackson</span>
                            <span class="posted-date">06 July 2024</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="review-card">
                    <p>
                        I stayed at Delhousie Hotel for its convenient location near Adam’s Peak, which was a plus.
                        However, the room felt a bit outdated, and the cleanliness could have been improved. The staff
                        was
                        helpful, but the service was a bit slow.
                        It’s an okay choice if you're just looking for a place to crash before the hike.

                    </p>
                    <div class="review-footer">
                        <img src="assets/images/findaHotel/reviews/img5.jpg" alt="Profile Picture" class="review-dp">
                        <div class="user-info">
                            <span class="username">Emma Watson</span>
                            <span class="posted-date">08 June 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <button id="loadMore" class="btn">
                See All Reviews
            </button>

        </section>

        <div class="slider-wrapper" style="display: none;" id="reviewCarousal">

            <div class="slider">

                <div class="reviewSlide" id="reviewSlide1">

                    <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                    <div class="profilePic">
                        <img src="pf6.jpeg">
                    </div>

                    <div class="username">
                        Michel Johnson
                    </div>

                    <div class="review">
                        Stayed at Delhousie Hotel before climbing Adam’s Peak.
                        The mountain view is breathtaking, and rooms were clean and comfy.
                        Friendly staff gave great hiking tips. Highly recommend for anyone visiting!
                    </div>
                </div>

                <div class="reviewSlide" id="reviewSlide2">

                    <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                    <div class="profilePic">
                        <img src="pf6.jpeg">
                    </div>

                    <div class="username">
                        Lara Brown
                    </div>

                    <div class="review">
                        Delhousie Hotel is great for Adam’s Peak visitors. The room was basic but met needs.
                        Staff was polite, though service was sometimes slow.
                        It’s a decent choice for a convenient, no-frills stay before the hike.
                    </div>
                </div>

                <div class="reviewSlide" id="reviewSlide3">

                    <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                    <div class="profilePic">
                        <img src="pf6.jpeg">
                    </div>

                    <div class="username">
                        Ammy Jackson
                    </div>

                    <div class="review">
                        Delhousie Hotel is in the perfect spot for those planning to climb Adam's Peak.
                        The early breakfast and proximity to the trailhead made everything so convenient.
                        The room was basic but had everything we needed after a long day. Will definitely stay here
                        again!
                    </div>
                </div>

                <div class="reviewSlide" id="reviewSlide4">

                    <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                    <div class="profilePic">
                        <img src="pf6.jpeg">
                    </div>

                    <div class="username">
                        Ahmadh Rafeek
                    </div>

                    <div class="review">
                        I had a wonderful experience at Delhousie Hotel. The staff were very helpful,
                        and the views from the hotel were stunning. The rooms were simple but comfortable.
                        It’s a great budget-friendly option for travelers looking to explore Adam’s Peak.
                    </div>
                </div>

                <div class="reviewSlide" id="reviewSlide5">

                    <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                    <div class="profilePic">
                        <img src="pf6.jpeg">
                    </div>

                    <div class="username">
                        Emma Watson
                    </div>

                    <div class="review">
                        I stayed at Delhousie Hotel for its convenient location near Adam’s Peak, which was a plus.
                        However, the room felt a bit outdated, and the cleanliness could have been improved. The staff
                        was helpful, but the service was a bit slow.
                        It’s an okay choice if you're just looking for a place to crash before the hike.
                    </div>
                </div>

            </div>

        </div>



    </div>

    <script>

        const loadMoreBtn = document.getElementById('loadMore');
        const reviewCarousel = document.getElementById('reviewCarousal');
        const mainContainer = document.querySelector('.main-container');
        const slider = document.querySelector('.slider');
        const reviews = document.querySelectorAll('.reviewSlide');
        const closeCarousal = document.getElementById('closeCarousal');

        let currentIndex = 0;

        const showReviews = () => {
            reviewCarousel.style.display = 'flex';
            reviewCarousel.style.justifyContent = 'center';
            reviewCarousel.style.alignItems = 'center';
            reviewCarousel.style.position = 'fixed';
            reviewCarousel.style.top = '0';
            reviewCarousel.style.left = '25%';
            reviewCarousel.style.width = '100%';
            reviewCarousel.style.height = '100%';
            reviewCarousel.style.zIndex = '1000';
            // reviewCarousel.style.backgroundColor = 'rgba(0, 0, 0, 0.2)';

            // Blur everything except the carousel
            Array.from(mainContainer.children).forEach(child => {
                if (child !== reviewCarousel) {
                    child.style.filter = 'blur(5px)';
                }
            });

            mainContainer.style.overflow = 'hidden';
            showSlide(currentIndex);
        };

        const hideReviews = () => {
            reviewCarousel.style.display = 'none';
            Array.from(mainContainer.children).forEach(child => {
                child.style.filter = 'none';
            });
            mainContainer.style.overflow = 'auto';
        };

        const showSlide = (index) => {
            reviews.forEach((review, i) => {
                review.style.display = i === index ? 'block' : 'none';
            });
        };

        const nextSlide = () => {
            currentIndex = (currentIndex + 1) % reviews.length;
            showSlide(currentIndex);
        };

        const prevSlide = () => {
            currentIndex = (currentIndex - 1 + reviews.length) % reviews.length;
            showSlide(currentIndex);
        };

        // Event Listeners
        loadMoreBtn.addEventListener('click', showReviews);
        reviewCarousel.addEventListener('click', (e) => {
            if (e.target === reviewCarousel) {
                hideReviews();
            }
        });

        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (reviewCarousel.style.display === 'flex') {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'Escape') {
                    hideReviews();
                }
            }
        });

        // Add navigation buttons
        const addNavigationButtons = () => {
            const prevButton = document.createElement('button');
            const nextButton = document.createElement('button');

            prevButton.innerHTML = '&#10094;';
            nextButton.innerHTML = '&#10095;';

            const buttonStyle = `
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 16px;
        cursor: pointer;
        font-size: 18px;
        border-radius: 50%;
    `;

            prevButton.style.cssText = buttonStyle + 'left: 20px;';
            nextButton.style.cssText = buttonStyle + 'right: 20px;';
          

            prevButton.addEventListener('click', (e) => {
                e.stopPropagation();
                prevSlide();
            });

            nextButton.addEventListener('click', (e) => {
                e.stopPropagation();
                nextSlide();
            });

            reviewCarousel.appendChild(prevButton);
            reviewCarousel.appendChild(nextButton);
        };

        addNavigationButtons();

        closeCarousal.addEventListener('click', () => {
            hideReviews();
        });

    </script>

</body>

</html>