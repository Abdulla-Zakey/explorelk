<?php
// var_dump($data['districtData']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewParticularHotel.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/footer.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | <?= $data['hotelData']->hotelName ?></title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        /* Modal Styles */
        .custom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        .model-container {
            background-color: #fff;
            border-radius: 2rem;
            /* width: 90%; */
            max-width: 80rem;
            max-height: 80vh;
            overflow: hidden;
            position: relative;
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                transform: translateY(2rem);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            background-color: #f8f9fa;
            padding: 2rem 3rem;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            color: #002D40;
            font-size: 2.4rem;
            font-weight: 600;
            margin: 0;
            padding-top: 0.5rem;
        }

        .modal-body {
            padding: 3rem;
            overflow-y: auto;
            max-height: calc(85vh - 150px);
        }

        .closebutton {
            background: none;
            border: none;
            font-size: 2rem;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
            padding: 0.5rem;
        }

        .closebutton:hover {
            color: #dc3545;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .model-container {
                width: 95%;
                margin: 1rem;
            }
        }

        .details-tabs {
            display: flex;
            gap: 1rem;
            border-bottom: 1px solid #e9ecef;
            padding: 0 2rem;
            margin-bottom: 2rem;
        }

        .tab-button {
            padding: 1.2rem 2rem;
            border: none;
            background: none;
            color: #6c757d;
            cursor: pointer;
            font-size: 1.8rem;
            font-family: 'poppins';
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-button i {
            margin-right: 0.8rem;
        }

        .tab-button.active {
            color: #002D40;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #002D40;
        }

        /* Tab Content Styles */
        .tab-content {
            display: none;
            padding: 2rem;
        }

        .tab-content.active {
            display: block;
        }

        /* Room Type Details Styles */
        .room-type-details {
            display: grid;
            grid-template-columns: 30rem 1fr;
            gap: 3rem;
        }

        .room-image-container {
            width: 100%;
            border-radius: 1rem;
            overflow: hidden;
        }

        .room-image-container img {
            width: 100%;
            height: 25rem;
            object-fit: cover;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .detail-item {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.8rem;
        }

        .detail-item.full-width {
            grid-column: 1 / -1;
        }

        .detail-label {
            display: block;
            color: #002D40;
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #6c757d;
            font-weight: 500;
            font-size: 1.4rem;
        }

        /* Amenities List Styles */
        .amenities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .amenity-tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 5px;
            width: 45%;
        }

        .amenity-tag i {
            font-size: 1rem;
        }

        /*Availability section */
        .availability-section {
            padding: 2rem;
            font-family: 'poppins';
        }

        .filter-section,
        .room-summary {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            display: flex;
            gap: 1.5rem;
            align-items: center;
            flex-wrap: wrap;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            min-width: 50rem;
        }

        .date-filter {
            flex: 1;
            min-width: 20rem;
        }

        .date-filter label,
        .summary-label,
        .selection-header h3 {
            display: block;
            font-size: 1.5rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .date-input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            transition: all 0.3s ease;
            background-color: white;
            box-sizing: border-box;
        }

        .date-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .room-summary {
            /*Declared with .filter-section*/
        }

        .summary-box {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            height: 6rem;
        }

        .summary-box i {
            font-size: 1.5rem;
            color: #4299e1;
        }

        .summary-info {
            display: flex;
            flex-direction: column;
        }

        .summary-label {
            /*declared with .date-filter label */
        }

        .summary-value {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2d3748;
        }

        .room-selection {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .selection-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .selection-header h3 {
            /*main styles of this part is declared with .date-filter label */
            margin: 0;
        }

        .room-counter {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 1rem;
            font-size: 1.4rem;
        }

        .counter-btn {
            background: white;
            border: 1px solid #e2e8f0;
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #4a5568;
            transition: all 0.2s ease;
        }

        .counter-btn:hover {
            background: #4299e1;
            color: white;
            border-color: #4299e1;
        }

        .counter-btn:disabled {
            background: #edf2f7;
            color: #a0aec0;
            cursor: not-allowed;
            border-color: #edf2f7;
        }

        #roomCount {
            font-size: 1.3rem;
            font-weight: 500;
            color: #2d3748;
            min-width: 2rem;
            text-align: center;
        }

        .booking-summary {
            background: white;
            padding: 1.5rem;
            border-radius: 0.8rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .summary-details {
            margin-bottom: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            color: #4a5568;
            font-size: 1.4rem;
            font-weight: 500;
        }

        .summary-row.total {
            border-top: 1px solid #e2e8f0;
            margin-top: 0.5rem;
            padding-top: 1rem;
            font-weight: 600;
            color: #4a5568;
            font-size: 1.5rem;
        }

        .book-button {
            width: 100%;
            background: #4299e1;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 1.5rem;
            font-family: 'poppins';
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .book-button:hover {
            background: #3182ce;
            transform: translateY(-1px);
        }

        .book-button:disabled {
            background: #e2e8f0;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 768px) {
            .filter-section {
                flex-direction: column;
            }

            .date-filter {
                width: 100%;
            }

            .room-summary {
                flex-direction: column;
            }

            .selection-header {
                flex-direction: column;
                gap: 1rem;
            }
        }


        /* Guest Information Section Styles */
        .guest-information {
            /* margin-top: 2rem; */
            padding: 1rem 1.5rem;
        }

        .guest-info-title {
            font-size: 1.8rem;
            color: #002D40;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .guest-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 1.4rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .guest-input {
            margin-bottom: 1rem;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            font-family: 'poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .guest-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        textarea.guest-input {
            resize: vertical;
            min-height: 8rem;
        }

        .confirm-button {
            width: 100%;
            /* background: #38a169; */
            background: darkcyan;
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 1.5rem;
            font-family: 'poppins';
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .confirm-button:hover {
            background: #007777;
            transform: translateY(-1px);
        }

        .confirm-button:disabled {
            background: #e2e8f0;
            cursor: not-allowed;
            transform: none;
        }

        /* Form validation styles */
        .guest-input.error {
            border-color: #e53e3e;
        }

        .error-message {
            color: #e53e3e;
            font-size: 1.2rem;
            margin-top: 0.5rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .guest-form {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }
        }

        /* Pop-up container (initially hidden) to show successfull or failed booking requests */
        .popup-container {
            font-size: 1.35rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* Dark transparent overlay */
            display: none;
            /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 999;
            /* Above other content */
        }

        /* Pop-up content */
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            font-size: 16px;
        }

        /* Close button */
        .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        /* Blur background effect when pop-up is visible */
        .blur {
            filter: blur(5px);
            pointer-events: none;
        }
    </style>

</head>

<body>
    <?php
        // var_dump($data['hotelReviews']);
        // exit();
    ?>
    <header>
        <nav class="navbar">

            <div class="backToHome">
            <a href="javascript:history.back()">
                <!-- <a href="<?= ROOT ?>/traveler/ParticularDistrict/index/9"> -->
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

        </nav>
    </header>

    <section id="main">
        <h1>
            <?= htmlspecialchars($data['hotelData']->hotelName) ?>
        </h1>

        <div class="row">
            <div class="infoText">
                <span class="subtopic">
                    A Picturesque Location
                </span>
                <br>
                <?= htmlspecialchars($data['hotelData']->description_para1) ?>
                <br><br>

                <span class="subtopic">
                    Exceptional Comfort and Elegance
                </span>
                <br>
                <?= htmlspecialchars($data['hotelData']->description_para2) ?>
                <br><br>

                <span class="subtopic">
                    Explore Nearby Attractions
                </span>
                <br>
                <?= htmlspecialchars($data['hotelData']->description_para3) ?>
            </div>

            <div class="mapHolder">

                <iframe id="mapFrame" width="100%" height="100%" frameborder="0" style="border:0;" loading="lazy"
                    allowfullscreen>
                </iframe>

                <center>
                    <div class="caption">Distance from <?= $data['districtData'][0]->district_name ?> Town</div>
                </center>

            </div>
        </div>

    </section>

    <section class="gallery-container">

        <div class="slider-wrapper">

            <div class="slider">
                <?php foreach ($data['hotelPics'] as $index => $pic): ?>
                    <img id="slide<?= $index + 1 ?>" src="<?= ROOT . '/' . $pic->image_path ?>" alt="Hotel Picture">
                <?php endforeach; ?>

                <div class="slider-nav">
                    <?php foreach ($data['hotelPics'] as $index => $pic): ?>
                        <a herf="#slide<?= $index + 1 ?>"></a>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>
    </section>

    <section id="roomTypes">
        <h1>
            Available Room Types
        </h1>
        <?php
        $index = 0;
        $totalRoomTypes = count($data['hotelRoomTypes']);
        if ($totalRoomTypes <= 3) {
            echo '<div class="container">';
            foreach ($data['hotelRoomTypes'] as $roomType) {
                echo '
                                <div class="roomItem">
                                    <div class="topic">' . $data['hotelRoomTypesNames'][$index]->roomType_name . '</div>
                                    <img src="' . ROOT . '/' . $roomType->thumbnail_picPath . '">

                                    <div class="typeDescription">' . $roomType->customized_description . '</div>

                                    <div id="bookNowBtn' . ($index + 1) . '" class="bookNow" onclick="showRoomTypeDetails(' . $index . ')">
                                        Book Now
                                    </div>

                                    <div class="price">' . $roomType->pricePer_night . ' LKR per day </div>
                                </div>
                        ';
                $index++;
            }
            echo '</div>';
        } else if ($totalRoomTypes > 3) {
            $isVisible = $index < 3;
            echo '
                        <div class="carousel-container">
                            <div class="carousel-navigation prev" id="prevBtn">&lt;</div>
                            <div class="carousel-content" id="roomTypesCarousel">
                ';
            foreach ($data['hotelRoomTypes'] as $roomType) {
                echo '
                                        <div class="roomItem ' . (!$isVisible ? 'hidden' : '') . '" data-index="' . $index . '">
                                            <div class="topic">' . $data['hotelRoomTypesNames'][$index]->roomType_name . '</div>
                                            <img src="' . ROOT . '/' . $roomType->thumbnail_picPath . '">

                                            <div class="typeDescription">' . $roomType->customized_description . '</div>

                                            <div id="bookNowBtn' . ($index + 1) . '" class="bookNow" onclick="showRoomTypeDetails(' . $index . ')">
                                                Book Now             
                                            </div>
                       
                                            <div class="price">' . $roomType->pricePer_night . ' LKR per day</div>
                                        </div>
                                    ';

                $index++;
            }
            echo '
                            </div>
                            <div class="carousel-navigation next" id="nextBtn">&gt;</div>
                        </div>

                ';
        }


        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const roomItems = document.querySelectorAll('.roomItem'); // NodeList
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const totalItems = roomItems.length;

                // Show carousel only if there are at least 3 room types
                if (totalItems < 3) {
                    console.error("Not enough room types for carousel rotation.");
                    return;
                }

                // Array to store current visible indices (start with first 3)
                let visibleIndices = [0, 1, 2];

                // Function to update visibility of room items
                function updateVisibility() {
                    roomItems.forEach((item, index) => {
                        if (visibleIndices.includes(index)) {
                            item.classList.remove('hidden'); // Show selected items
                        } else {
                            item.classList.add('hidden'); // Hide other items
                        }
                    });
                }

                // **Left Rotation: Move first index to the end**
                function handleLeftNavigation() {
                    visibleIndices = visibleIndices.map(index => (index - 1 + totalItems) % totalItems);
                    updateVisibility();
                }

                // **Right Rotation: Move last index to the front**
                function handleRightNavigation() {
                    visibleIndices = visibleIndices.map(index => (index + 1) % totalItems);
                    updateVisibility();
                }

                // Attach event listeners
                prevBtn.addEventListener('click', handleLeftNavigation);
                nextBtn.addEventListener('click', handleRightNavigation);

                // Initial display setup
                updateVisibility();
            });


        </script>
    </section>

    <section id="guest-reviews">

        <h1>
            Guest Reviews
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
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img1.png" alt="Profile Picture" class="review-dp">
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
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img2.png" alt="Profile Picture" class="review-dp">
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
                    The room was basic but had everything we needed after a long day. Will definitely stay here again!
                </p>
                <div class="review-footer">
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img4.jpg" alt="Profile Picture" class="review-dp">
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
                    However, the room felt a bit outdated, and the cleanliness could have been improved. The staff was
                    helpful, but the service was a bit slow.
                    It’s an okay choice if you're just looking for a place to crash before the hike.

                </p>
                <div class="review-footer">
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img5.jpg" alt="Profile Picture" class="review-dp">
                    <div class="user-info">
                        <span class="username">Emma Watson</span>
                        <span class="posted-date">08 June 2024</span>
                    </div>
                </div>
            </div>
        </div>

        <button id="loadMore" class="loadMore-Btn">
            See all reviews
        </button>

    </section>

    <div class="slider-wrapper" style="display: none;" id="reviewCarousal">


        <div class="slider">

            <div class="reviewSlide" id="reviewSlide1">

                <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                <div class="profilePic">
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img1.png">
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
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img2.png">
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
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img4.jpg">
                </div>

                <div class="username">
                    Ammy Jackson
                </div>

                <div class="review">
                    Delhousie Hotel is in the perfect spot for those planning to climb Adam's Peak.
                    The early breakfast and proximity to the trailhead made everything so convenient.
                    The room was basic but had everything we needed after a long day. Will definitely stay here again!
                </div>
            </div>

            <div class="reviewSlide" id="reviewSlide4">

                <i class="fa-solid fa-rectangle-xmark" id="closeCarousal"></i>

                <div class="profilePic">
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img3.png">
                </div>

                <div class="username">
                    Alexandra Green
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
                    <img src="<?= IMAGES ?>/Travelers/userProfilePics/img5.jpg">
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

    <!--Room type details popup-->
    <div class="custom-modal" id="viewDetailsModal">
        <div class="model-container">
            <div class="modal-header">
                <h2 class="modal-title"></h2>
                <button id="closeBtn" class="closebutton" onclick="closeModal('viewDetailsModal')">&times;</button>
            </div>

            <div class="modal-body">
                <!-- Tab Navigation -->
                <div class="details-tabs">
                    <button class="tab-button active" onclick="switchTab(event, 'roomTypeInfo')">
                        <i class="fas fa-info-circle"></i> Room Type Details
                    </button>
                    <button class="tab-button" onclick="switchTab(event, 'roomsList')">
                        <i class="fa-solid fa-hourglass-half"></i> Check Availability
                    </button>
                </div>

                <!-- Room Type Details Tab -->
                <div id="roomTypeInfo" class="tab-content active">
                    <div class="room-type-details">
                        <div class="room-image-container">
                            <img id="roomTypeImage" src="" alt="Room Type Image">
                        </div>
                        <div class="details-grid">

                            <div class="detail-item">
                                <span class="detail-label">Price per Night</span>
                                <span id="detailPrice" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Max Occupancy</span>
                                <span id="detailOccupancy" class="detail-value"></span>
                            </div>
                            <div class="detail-item full-width">
                                <span class="detail-label">Description</span>
                                <p id="detailDescription" class="detail-value"></p>
                            </div>
                        </div>
                        <div class="detail-item full-width">
                            <span class="detail-label">Amenities</span>
                            <div id="detailAmenities" class="amenities-list"></div>
                        </div>
                    </div>
                </div>

                <!-- Rooms selection and proceed to booking Tab -->
                <div id="roomsList" class="tab-content">
                    <div class="availability-section">
                        <div class="filter-section">
                            <div class="date-filter">
                                <label for="checkIn">Check-in Date</label>
                                <input type="date" id="checkIn" class="date-input">
                            </div>
                            <div class="date-filter">
                                <label for="checkOut">Check-out Date</label>
                                <input type="date" id="checkOut" class="date-input">
                            </div>
                        </div>

                        <div class="room-summary">
                            <div class="summary-box">
                                <i class="fas fa-bed"></i>
                                <div class="summary-info">
                                    <span class="summary-label">Available Rooms</span>
                                    <span class="summary-value"></span>
                                </div>
                            </div>
                            <div class="summary-box">
                                <i class="fas fa-hourglass-half"></i>
                                <div class="summary-info">
                                    <span class="summary-label">Pending Reservations</span>
                                    <!-- <span id="pricePerNightInCheckAvailability" class="summary-value"></span> -->
                                    <span id="reservedRoomsCount" class="summary-value"></span>
                                </div>
                            </div>
                        </div>

                        <div class="room-selection">
                            <div class="selection-header">
                                <h3>Select Number of Rooms</h3>
                                <div class="room-counter">
                                    <button class="counter-btn" id="decrementBtn" onclick="decrementRooms()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span id="roomCount">0</span>
                                    <button class="counter-btn" id="incrementBtn" onclick="incrementRooms()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden content to collect booking person's details -->
                        <div class="guest-information" id="guestInformationSection" style="display: none;">
                            <h3 class="guest-info-title">Guest Information</h3>
                            <div class="guest-form">
                                <div class="form-group">
                                    <label for="guestFullName">Full Name</label>
                                    <input type="text" id="guestFullName" class="guest-input"
                                        placeholder="Enter your full name"
                                        value="<?= $data['userData']->fName . ' ' . $data['userData']->lName ?>">
                                </div>
                                <div class="form-group">
                                    <label for="guestEmail">Email Address</label>
                                    <input type="email" id="guestEmail" class="guest-input"
                                        placeholder="Enter your email address"
                                        value="<?= $data['userData']->travelerEmail ?>">
                                </div>
                                <div class="form-group">
                                    <label for="guestPhone">Phone Number</label>
                                    <input type="tel" id="guestPhone" class="guest-input"
                                        placeholder="Enter your phone number"
                                        value="<?= $data['userData']->travelerMobileNum ?>">
                                </div>
                                <div class="form-group">
                                    <label for="guestNIC">NIC / Passport Number</label>
                                    <input type="text" id="guestNIC" class="guest-input"
                                        placeholder="Enter your NIC or passport num">
                                </div>
                                <div class="form-group full-width">
                                    <label for="specialRequests">Special Requests (Optional)</label>
                                    <textarea id="specialRequests" class="guest-input" rows="3" style="resize: none;"
                                        placeholder="Any special requests or notes for your stay"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="availability-cards" id="availabilityList">
                            <!-- Room cards will be generated dynamically -->
                        </div>

                        <div class="booking-summary">
                            <div class="summary-details">
                                <div class="summary-row">
                                    <span>Selected Rooms</span>
                                    <span id="selectedRoomCount">0 Room</span>
                                </div>
                                <div class="summary-row">
                                    <span>Total Nights</span>
                                    <span id="totalNights">0 Nights</span>
                                </div>
                                <div class="summary-row total">
                                    <span>Total Amount</span>
                                    <span id="totalAmount">0 LKR</span>
                                </div>
                            </div>



                            <button class="book-button" id="bookNowBtn" style="margin-bottom: 1.5rem;">
                                <i class="fas fa-check-circle"></i>
                                Continue
                            </button>

                            <button class="confirm-button" id="confirmBookingBtn" style="display: none;"
                                onclick="prepareBookingRequest()">
                                <i class="fa-solid fa-thumbs-up"></i>
                                Confirm Booking Request
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="<?= ROOT ?>/traveler/ViewParticularHotel/recordBookingRequest">
        <input type="hidden" name="hotelId" id="hotel_Id" value="<?= $data['hotelData']->hotel_Id ?>">
        <input type="hidden" name="hotelRoomTypeId" id="hotel_roomType_id" value="">
        <input type="hidden" name="finalCheckInDate" id="final_checkIn_date" value="">
        <input type="hidden" name="finalCheckOutDate" id="final_checkOut_date" value="">
        <input type="hidden" name="bookedRoomCount" id="booked_room_count" value="">
        <input type="hidden" name="totalAmount" id="total_amount" value="">

        <!--Guest Details-->
        <input type="hidden" name="guestFullName" id="geust_full_name" value="">
        <input type="hidden" name="guestEmail" id="geust_email" value="">
        <input type="hidden" name="guestMobileNum" id="geust_mobile_num" value="">
        <input type="hidden" name="guestNIC" id="geust_nic" value="">
        <input type="hidden" name="guestSpecialRequests" id="geust_special_requests" value="">
    </form>

    <script>
        function prepareBookingRequest() {

            validateGuestInformation();

            document.getElementById("hotel_roomType_id").value = currentRoomTypeId;
            document.getElementById("final_checkIn_date").value = document.getElementById("checkIn").value;
            document.getElementById("final_checkOut_date").value = document.getElementById("checkOut").value;
            document.getElementById("booked_room_count").value = document.getElementById("selectedRoomCount").innerText;
            document.getElementById("total_amount").value = document.getElementById("totalAmount").innerText;

            document.getElementById("geust_full_name").value = document.getElementById("guestFullName").value;
            document.getElementById("geust_email").value = document.getElementById("guestEmail").value;
            document.getElementById("geust_mobile_num").value = document.getElementById("guestPhone").value;
            document.getElementById("geust_nic").value = document.getElementById("guestNIC").value;
            document.getElementById("geust_special_requests").value = document.getElementById("specialRequests").value;

            // Submit the form
            document.querySelector('form').submit();
        }
    </script>

    <!-- Pop-Up Message ------------------------------------------------------------------------------------>
    <div id="popup" class="popup-container">

        <div class="popup-content">
            <p id="popup-text"></p>
            <button id="closePopup">Ok</button>
        </div>

    </div>

    <!-- Footer -------------------------------------------->
    <section id="footer">
        <div class="foot">
            &copy; ExploreLK, 2024 | All Rights Reserved
        </div>
    </section>

    <script>
        //Coordinates for the district 
        const districtLatitude = <?= $data['districtData'][0]->districtLatitude ?>;
        const districtLongitude = <?= $data['districtData'][0]->districtLongitude ?>;

        //Coordinates for the hotel
        const destinationLatitude = <?= json_encode($data['hotelData']->hotelLatitude) ?>;
        const destinationLongitude = <?= json_encode($data['hotelData']->hotelLongtitude) ?>;

        const mapFrame = document.querySelector('#mapFrame');
        mapFrame.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&&origin=${districtLatitude},${districtLongitude}&destination=${destinationLatitude},${destinationLongitude}&mode=driving&zoom=13.5`;
    </script>


    <!--myAPIKEYCOMESHERE-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&callback=initMap"
        async defer></script>


    <!--Script for switch tabs in the room details popup-->
    <script>
        // Tab switching functionality
        function switchTab(event, tabId) {
            // Get all tab buttons and contents
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');

            // Remove active class from all buttons and contents
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });

            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            // Add active class to clicked button and corresponding content
            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }

    </script>

    <script>
        let currentRoomCount = 0;
        let maxAvailableRooms; // This will be dynamically set
        let numberOfNights = 0; // Variable to store number of nights
        let pricePerNight = 10000;

        // Initialize date inputs with restrictions
        document.addEventListener('DOMContentLoaded', function () {
            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');

            // Set minimum date as today for check-in
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            const todayFormatted = today.toISOString().split('T')[0];
            const tomorrowFormatted = tomorrow.toISOString().split('T')[0];

            checkInInput.min = todayFormatted;
            checkOutInput.min = tomorrowFormatted;

            // Function to calculate date difference
            function calculateDateDifference() {
                if (checkInInput.value && checkOutInput.value) {
                    const checkIn = new Date(checkInInput.value);
                    const checkOut = new Date(checkOutInput.value);

                    // Calculate the time difference in milliseconds
                    const timeDifference = checkOut.getTime() - checkIn.getTime();

                    // Convert to days
                    numberOfNights = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

                    // Update the display
                    const stayDurationDisplay = document.getElementById('totalNights');
                    if (stayDurationDisplay) {
                        stayDurationDisplay.textContent = `${numberOfNights} night${numberOfNights !== 1 ? 's' : ''}`;
                    }

                    calculateTotalAmount();
                }
            }

            // Update check-out minimum date when check-in date changes
            checkInInput.addEventListener('change', function () {
                const selectedDate = new Date(this.value);
                const nextDay = new Date(selectedDate);
                nextDay.setDate(nextDay.getDate() + 1);
                checkOutInput.min = nextDay.toISOString().split('T')[0];

                if (checkOutInput.value && new Date(checkOutInput.value) <= new Date(this.value)) {
                    checkOutInput.value = nextDay.toISOString().split('T')[0];
                }

                calculateDateDifference();
                checkAvailability();

            });

            // Calculate difference when check-out date changes
            checkOutInput.addEventListener('change', function () {
                calculateDateDifference();
                checkAvailability();
            });

            // Initial calculation if both dates are set
            calculateDateDifference();
            checkAvailability();

        });

        function incrementRooms() {
            if (currentRoomCount < maxAvailableRooms) {
                currentRoomCount++;
                updateRoomCount();
            }
        }

        function decrementRooms() {
            if (currentRoomCount > 0) {
                currentRoomCount--;
                updateRoomCount();
            }
        }

        function updateRoomCount() {
            const roomCountElement = document.getElementById('roomCount');
            const selectedRoomCountDisplayElement = document.getElementById('selectedRoomCount');
            const decrementBtn = document.getElementById('decrementBtn');
            const incrementBtn = document.getElementById('incrementBtn');

            roomCountElement.textContent = currentRoomCount;
            selectedRoomCountDisplayElement.textContent = currentRoomCount + " Room";

            // Update button states
            decrementBtn.disabled = currentRoomCount <= 0;
            incrementBtn.disabled = currentRoomCount >= maxAvailableRooms;

            calculateTotalAmount();
        }

        // Function to Calculate and display total amount
        function calculateTotalAmount() {
            const totalPrice = numberOfNights * pricePerNight * currentRoomCount;
            document.getElementById('totalAmount').textContent = `${totalPrice} LKR`;
        }

        function submitBooking() {
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;

            if (!checkIn || !checkOut) {
                alert('Please select both check-in and check-out dates');
                return;
            }

            // Here you can add your booking submission logic
            const bookingDetails = {
                checkIn: checkIn,
                checkOut: checkOut,
                numberOfRooms: currentRoomCount
            };

            console.log('Booking details:', bookingDetails);
            // Add your API call or form submission here
        }

    </script>

    <script>

        let currentRoomTypeId;

        function showRoomTypeDetails(index) {
            const modal = document.getElementById('viewDetailsModal');
            const closeBtn = document.getElementById('closeBtn');

            // Create PHP arrays in JavaScript format
            const roomTypeNames = <?php echo json_encode($data['hotelRoomTypesNames']); ?>;
            const roomTypes = <?php echo json_encode($data['hotelRoomTypes']); ?>;
            currentRoomTypeId = roomTypes[index].hotel_roomType_Id;
            const roomAmenities = <?php echo json_encode($data['hotelRoomTypeAmenityList']); ?>;

            // Set the price per night for the selected room type
            pricePerNight = parseInt(roomTypes[index].pricePer_night);

            // Update modal content dynamically - Room Type Details Section
            document.querySelector('.modal-title').innerText = roomTypeNames[index].roomType_name;
            document.getElementById('roomTypeImage').src = '<?php echo ROOT; ?>/' + roomTypes[index].thumbnail_picPath;
            document.getElementById('detailDescription').innerText = roomTypes[index].customized_description;
            document.getElementById('detailPrice').innerText = roomTypes[index].pricePer_night + ' LKR';
            document.getElementById('detailOccupancy').innerText = roomTypes[index].max_occupancy;

            const amenitiesContainer = document.getElementById('detailAmenities');
            amenitiesContainer.innerHTML = ''; // Clear existing amenities

            if (roomAmenities[index] && roomAmenities[index].length > 0) {
                roomAmenities[index].forEach(amenity => {
                    const amenityDiv = document.createElement('div');
                    amenityDiv.className = 'amenity-tag';
                    amenityDiv.innerHTML = `
                <i class="${amenity.icon_class}"></i>
                ${amenity.amenity_name}
            `;
                    amenitiesContainer.appendChild(amenityDiv);
                });
            }

            // Update modal content dynamically - Check Availability Section
            // document.getElementById('pricePerNightInCheckAvailability').innerText = roomTypes[index].pricePer_night + ' LKR';

            // Show modal
            modal.style.display = 'flex';

            // Close modal functionality
            closeBtn.onclick = function () {

                document.getElementById('checkIn').value = "";
                document.getElementById('checkOut').value = "";
                document.querySelector('.summary-box .summary-value').innerText = "";
                document.getElementById('reservedRoomsCount').innerText = "";
                document.getElementById('totalNights').textContent = "0 Nights";

                // Reset room count to default
                currentRoomCount = 1;
                updateRoomCount();

                // Reset availability UI
                maxAvailableRooms = 0;
                numberOfNights = 0;

                calculateTotalAmount();

                // Manually add active class to roomTypeInfo tab and its button
                document.querySelector('.tab-button[onclick*="roomTypeInfo"]').classList.add('active');
                document.getElementById('roomTypeInfo').classList.add('active');
                document.getElementById('roomsList').classList.remove('active');
                document.querySelector('.tab-button[onclick*="roomsList"]').classList.remove('active');

                modal.style.display = 'none';
                document.getElementById('guestInformationSection').style.display = 'none';
                document.getElementById('confirmBookingBtn').style.display = 'none';
                document.getElementById('bookNowBtn').style.display = 'block';
            };

            // Close when clicking outside the modal
            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.getElementById('guestInformationSection').style.display = 'none';
                }
            };

            checkAvailability();
        }

        function checkAvailability() {
            const checkIn = document.getElementById('checkIn').value;
            const checkOut = document.getElementById('checkOut').value;

            if (!checkIn || !checkOut) {
                return;
            }

            // Make AJAX call to check availability
            fetch(`<?= ROOT ?>/traveler/RoomBookingController/checkAvailability/${currentRoomTypeId}/${checkIn}/${checkOut}`)
                .then(response => response.json())
                .then(data => {
                    updateAvailabilityUI(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function updateAvailabilityUI(data) {

            // Update available rooms count
            const availableRoomsElement = document.querySelector('.summary-box .summary-value');
            availableRoomsElement.textContent = `${data.available_rooms} of ${data.total_rooms}`;

            const reservedRoomsElement = document.getElementById('reservedRoomsCount');
            reservedRoomsElement.textContent = `${data.reserved_rooms} of ${data.total_rooms}`;

            // Update max available rooms for selection
            maxAvailableRooms = data.available_rooms;

            // Reset room count if current selection exceeds availability
            if (currentRoomCount > maxAvailableRooms) {
                currentRoomCount = maxAvailableRooms;
                updateRoomCount();
            }

            // Update increment button state
            document.getElementById('incrementBtn').disabled = currentRoomCount >= maxAvailableRooms;

            // Enable/disable booking button based on availability
            const bookButton = document.getElementById('bookNowBtn');
            bookButton.disabled = !data.available;

            if (!data.available) {
                bookButton.textContent = 'No Rooms Available';
            } else {
                // bookButton.textContent = '<i class="fas fa-check-circle"></i> Continue';
                bookButton.innerHTML = '<i class="fas fa-check-circle"></i> Continue';
            }
        }

    </script>

    <script>
        // Flag to track if guest info section is visible
        let guestInfoVisible = false;

        // Function to handle click on the Continue button
        function showGuestInformation() {

            const checkInInput = document.getElementById('checkIn');
            const checkOutInput = document.getElementById('checkOut');

            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;

            // Clear any existing error messages
            document.querySelectorAll('.error-message').forEach(element => {
                element.remove();
            });

            if (checkIn === "" && checkOut === "") {
                showValidationError(checkInInput, 'Please select a Check-In date');
                showValidationError(checkOutInput, 'Please select a Check-Out date');
                scrollToElement(checkInInput);
                return;
            }

            if (checkIn === "") {
                showValidationError(checkInInput, 'Please select a check-in date first');
                scrollToElement(checkInInput);
                return;
            }

            if (checkOut === "") {
                showValidationError(checkOutInput, 'Please select a check-out date');
                checkOutInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                scrollToElement(checkOutInput);
                return;
            }

            // Get elements
            const guestInfoSection = document.getElementById('guestInformationSection');
            const continueButton = document.getElementById('bookNowBtn');
            const confirmBookingBtn = document.getElementById('confirmBookingBtn');

            // Show guest information section and hide continue button
            guestInfoSection.style.display = 'block';
            confirmBookingBtn.style.display = 'block';
            continueButton.style.display = 'none';

            // Set flag to true
            guestInfoVisible = true;

            // Scroll to the guest information section
            scrollToElement(guestInfoSection);
        }

        function scrollToElement(element) {
            // Find the modal content container
            const modalBody = document.querySelector('.modal-body');

            if (modalBody) {
                // Calculate the scroll position
                const elementTop = element.getBoundingClientRect().top;
                const modalBodyTop = modalBody.getBoundingClientRect().top;
                const scrollOffset = elementTop - modalBodyTop - 60; // 50px offset for better visibility

                // Scroll the modal body container
                modalBody.scrollBy({
                    top: scrollOffset,
                    behavior: 'smooth'
                });
            }
        }

        // Function to validate guest information
        function validateGuestInformation() {
            let isValid = true;

            // Clear all previous error messages
            document.querySelectorAll('.error-message').forEach(element => {
                element.remove();
            });

            // Reset all input borders
            document.querySelectorAll('.guest-input').forEach(input => {
                input.classList.remove('error');
            });

            // Validate full name
            const fullName = document.getElementById('guestFullName');
            if (!fullName.value.trim()) {
                showValidationError(fullName, 'Full name is required');
                scrollToElement(fullName);
                isValid = false;
            }

            // Validate email
            const email = document.getElementById('guestEmail');
            if (!email.value.trim()) {
                showValidationError(email, 'Email address is required');
                scrollToElement(email);
                isValid = false;
            } else if (!isValidEmail(email.value)) {
                showValidationError(email, 'Please enter a valid email address');
                scrollToElement(email);
                isValid = false;
            }

            // Validate phone
            const phone = document.getElementById('guestPhone');
            if (!phone.value.trim()) {
                showValidationError(phone, 'Phone number is required');
                scrollToElement(phone);
                isValid = false;
            }

            // Validate NIC/Passport
            const nic = document.getElementById('guestNIC');
            if (!nic.value.trim()) {
                showValidationError(nic, 'NIC or passport number is required');
                scrollToElement(nic);
                isValid = false;
            }

            return isValid;
        }

        // Helper function to show validation errors
        function showValidationError(inputElement, message) {
            inputElement.classList.add('error');

            const errorMessage = document.createElement('div');
            errorMessage.className = 'error-message';
            errorMessage.innerText = message;

            inputElement.parentNode.appendChild(errorMessage);
        }

        // Helper function to validate email format
        function isValidEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }


        // Add these event listeners in your DOMContentLoaded or initialization function
        document.addEventListener('DOMContentLoaded', function () {
            // ... your existing code ...

            // Add event listener for Continue button
            const bookNowBtn = document.getElementById('bookNowBtn');
            if (bookNowBtn) {
                bookNowBtn.addEventListener('click', showGuestInformation);
            }

            // Add event listener for Confirm Booking Request button
            const confirmBookingBtn = document.getElementById('confirmBookingBtn');
            if (confirmBookingBtn) {
                confirmBookingBtn.addEventListener('click', confirmBookingRequest);
            }
        });

        // Update the closeModal function to reset the guest information section
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);

            // Reset guest information section
            if (guestInfoVisible) {
                document.getElementById('guestInformationSection').style.display = 'none';
                document.getElementById('bookNowBtn').style.display = 'flex';
                guestInfoVisible = false;

                // Clear all inputs
                document.querySelectorAll('.guest-input').forEach(input => {
                    input.value = '';
                    input.classList.remove('error');
                });

                // Remove all error messages
                document.querySelectorAll('.error-message').forEach(element => {
                    element.remove();
                });

                // Reset all input borders
                document.querySelectorAll('.guest-input').forEach(input => {
                    input.classList.remove('error');
                });
            }


            // Hide modal
            modal.style.display = 'none';
        }
    </script>


    <!--This is script is to load all the user reviews and its carousal view-->
    <script>
        const loadMoreBtn = document.getElementById('loadMore');
        const reviewCarousel = document.getElementById('reviewCarousal');
        const body = document.body;
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

            // Blur everything except the carousel
            Array.from(document.body.children).forEach(child => {
                if (child !== reviewCarousel) {
                    child.style.filter = 'blur(5px)';

                }
            });

            body.style.overflow = 'hidden';
            showSlide(currentIndex);
        };

        const hideReviews = () => {
            reviewCarousel.style.display = 'none';
            Array.from(document.body.children).forEach(child => {
                child.style.filter = 'none';
            });
            body.style.overflow = 'auto';
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

    <!-- Below script is used to check the url detect the success
    or error message display messages accordingly while placing 
    room booking reuqests -->
    <script>

        function showPopup(message, bookingId = null) {
            const popup = document.getElementById("popup");
            const popupText = document.getElementById("popup-text");
            const container = document.querySelector("#main");

            popupText.innerHTML = message;

            // Show the pop-up
            popup.style.display = "flex";

            // Blur the background
            container.classList.add("blur");

            // Remove any existing listeners to prevent multiple bindings
            const closePopup = document.getElementById("closePopup");

            // Remove any existing "View Details" button if present
            const existingViewDetailsBtn = document.getElementById("viewDetailsBtn");
            if (existingViewDetailsBtn) {
                existingViewDetailsBtn.remove();
            }

            if (bookingId) {
                const viewDetailsBtn = document.createElement("a");
                viewDetailsBtn.id = "viewDetailsBtn";
                viewDetailsBtn.href = "<?= ROOT ?>/traveler/MyBookings?booking_id=" + bookingId; // Change to your actual details page
                viewDetailsBtn.innerText = "View";
                viewDetailsBtn.style.background = "#007bff";
                viewDetailsBtn.style.color = "white";
                viewDetailsBtn.style.padding = "8.625px 20px";
                viewDetailsBtn.style.marginRight = "10px";
                viewDetailsBtn.style.border = "none";
                viewDetailsBtn.style.cursor = "pointer";
                viewDetailsBtn.style.textDecoration = "none";
                viewDetailsBtn.style.borderRadius = "5px";
                viewDetailsBtn.style.fontSize = "14px";

                viewDetailsBtn.addEventListener("mouseover", function () {
                    viewDetailsBtn.style.backgroundColor = "#0056b3"; // Change background on hover
                });

                viewDetailsBtn.addEventListener("mouseout", function () {
                    viewDetailsBtn.style.backgroundColor = "#007bff"; // Reset background when not hovering
                });


                // closePopup.appendChild(viewDetailsBtn);
                popupContent = document.querySelector('.popup-content');
                popupContent.insertBefore(viewDetailsBtn, closePopup);

                closePopup.innerText = "Close";
            }
            else{
                closePopup.innerText = "Ok";
            }

            closePopup.onclick = function () {
                // Hide the pop-up
                popup.style.display = "none";

                // Remove the blur effect
                container.classList.remove("blur");
            };
        }

        // Check for URL parameters on page load
        document.addEventListener('DOMContentLoaded', function () {
            // Function to get URL parameters
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            var successMsg = getUrlParameter('success');    // Check for success message
            var bookingId = getUrlParameter('booking_id');  // Get booking ID if available
            var errorMsg = getUrlParameter('error');        // Check for error message

            if (successMsg === 'booking_request_submitted') {
                showPopup('<span style="color: #4CAF50; font-weight: bold;"><i class="fa fa-check-circle"></i></span>Your booking request has been successfully recorded!', bookingId);

                // Remove the success parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }

            if (errorMsg === 'booking_request_failed') {
                showPopup('<span style="color: #F44336; font-weight: bold;"><i class="fa fa-times-circle"></i></span> There was an error processing your booking request. Please try again later!');

                // Remove the error parameter from URL
                var url = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, url);
            }
        });
    </script>



</body>

</html>