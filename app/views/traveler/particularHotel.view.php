<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewParticularHotel.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/footer.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK |  Hotel Name</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>

        </nav>
    </header>

    <section id="main">
        <h1>
            Araliya Green Hills Hotel
        </h1>

        <div class="row">
            <div class="infoText">
                Nestled in the heart of Nuwara Eliya, Araliya Green Hills Hotel offers a perfect blend of luxury and relaxation. Surrounded by misty hill country landscapes, it provides an ideal retreat for travelers seeking comfort and elegance. Guests can enjoy well-appointed rooms, stunning views of rolling hills and vibrant gardens, and easy access to Nuwara Eliya’s charming attractions, making it a haven for nature lovers and adventurers alike.

                <br><br>

                The hotel offers well-appointed rooms with modern amenities, providing a relaxing escape after exploring Nuwara Eliya. Guests can start their day with fresh mountain air and breathtaking views of misty hills and vibrant gardens. On-site dining options cater to diverse palates with a variety of local and international cuisines, while the cozy outdoor seating areas create a serene atmosphere to unwind and take in the stunning scenery.

                <br><br>

                Conveniently located near the town’s iconic attractions, Araliya Green Hills Hotel is an ideal base for exploring Gregory Lake, 
                Hakgala Botanical Garden, and Horton Plains National Park. Whether seeking a romantic escape, a family vacation, 
                or a peaceful getaway, this luxurious hotel blends warm hospitality with unparalleled comfort, 
                ensuring a memorable stay in the heart of Sri Lanka’s hill country.
            </div>

            <div class="mapHolder">
                
                <iframe id="mapFrame" width="100%" height="100%" frameborder="0" style="border:0;" loading="lazy"allowfullscreen>
                </iframe>

                <center>
                    <div class = "caption">Distance from Nuwara Eliya Town</div>
                </center>
                
            </div>
        </div>

    </section>

    <section class="gallery-container">
        <div class="slider-wrapper">
            <div class="slider">
                <img id="slide1" src="<?= IMAGES ?>/Travelers/topDistricts/nuwaraEliya/hotels/araliyaGreenHills/image1.jpg">
                <img id="slide2" src="<?= IMAGES ?>/Travelers/topDistricts/nuwaraEliya/hotels/araliyaGreenHills/image2.jpg">
                <img id="slide3" src="<?= IMAGES ?>/Travelers/topDistricts/nuwaraEliya/hotels/araliyaGreenHills/image3.jpg">
                <img id="slide4" src="<?= IMAGES ?>/Travelers/topDistricts/nuwaraEliya/hotels/araliyaGreenHills/image4.jpg">
                <img id="slide5" src="<?= IMAGES ?>/Travelers/topDistricts/nuwaraEliya/hotels/araliyaGreenHills/image5.jpg">

                <div class="slider-nav">
                    <a href="#slide1"></a>
                    <a href="#slide2"></a>
                    <a href="#slide3"></a>
                    <a href="#slide4"></a>
                    <a href="#slide5"></a>
                </div>

            </div>

        </div>
    </section>

    <section id="roomTypes">
        <h1>
            Available Room Types
        </h1>

        <div class="container">
            <div class="roomItem">
                <div class="topic">
                    Single Rooms
                </div>

                <img src="./assets/images/findaHotel/Roomtypes/single-room.jpg">

                <div class="typeDescription">
                    Ideal for solo travelers, this room provides a comfortable and 
                    private retreat with all essential amenities for a relaxing stay.
                </div>

                <a href="roomDetails.html">
                    <div class="bookNow">
                        Book Now
                    </div>
                </a>


                <div class="price">
                    Rs. 7500.00/day
                </div>

            </div>

            <div class="roomItem">
                <div class="topic">
                    Double Rooms
                </div>

                <img src="./assets/images/findaHotel/Roomtypes/double rooms.jpg">

                <div class="typeDescription">
                    Perfect for couples or friends, this room provides a cozy space with modern amenities for comfort.
                </div>

                <a href="roomDetails.html">
                    <div class="bookNow">
                        Book Now
                    </div>
                </a>

                <div class="price">
                    Rs. 17500.00/day
                </div>

            </div>

            <div class="roomItem">
                <div class="topic">
                    Family Rooms
                </div>

                <img src="./assets/images/findaHotel/Roomtypes/family rooms.jpg">

                <div class="typeDescription">
                    Designed to accommodate families, it offers ample space for children and 
                    additional amenities tailored to their needs.
                </div>

                <a href="roomDetails.html">
                    <div class="bookNow">
                        Book Now
                    </div>
                </a>

                <div class="price">
                    Rs. 30000.00/day
                </div>

            </div>
        </div>

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
                    The room was basic but had everything we needed after a long day. Will definitely stay here again!
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
                    However, the room felt a bit outdated, and the cleanliness could have been improved. The staff was
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

        <button id="loadMore" class = "loadMore-Btn">
            See all reviews
        </button>

    </section>

    <div class="slider-wrapper" style="display: none;" id="reviewCarousal">

        
        <div class="slider">

            <div class="reviewSlide" id="reviewSlide1">

                <i class="fa-solid fa-rectangle-xmark" id ="closeCarousal" ></i>

                <div class="profilePic">
                    <img src="assets/images/findaHotel/reviews/img1.png">
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

                <i class="fa-solid fa-rectangle-xmark" id ="closeCarousal" ></i>

                <div class="profilePic">
                    <img src="assets/images/findaHotel/reviews/img2.png">
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

                <i class="fa-solid fa-rectangle-xmark" id ="closeCarousal" ></i>

                <div class="profilePic">
                    <img src="assets/images/findaHotel/reviews/img6.jpg">
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

                <i class="fa-solid fa-rectangle-xmark" id ="closeCarousal" ></i>

                <div class="profilePic">
                    <img src="assets/images/findaHotel/reviews/img4.png">
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

                <i class="fa-solid fa-rectangle-xmark" id ="closeCarousal" ></i>

                <div class="profilePic">
                    <img src="assets/images/findaHotel/reviews/img5.jpg">
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




    <section id="footer">
        <div class="foot">
            &copy; ExploreLK, 2024 | All Rights Reserved
        </div>
    </section>

    <!-- <script>
        function initMap() {
            
            const map = new google.maps.Map(document.getElementById('directionsMap'), {
                zoom: 13,
                center: { lat: 6.9271, lng: 79.8612 }, 
            });
    
            
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                panel: document.getElementById('directionsPanel'), 
            });
    
            
            const request = {
                origin: 'Nuwara Eliya Town, Sri Lanka', 
                destination: 'Delhousie Hotel, Nallathanniya, Sri Lanka',
                travelMode: 'DRIVING', 
            };
    
            
            directionsService.route(request, (response, status) => {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    console.error('Directions request failed due to ' + status);
                }
            });
        }
    </script> -->
    <script>
        // Static coordinates for the district (e.g., Ratnapura)
        const districtLatitude = 6.9498308221090515; // Example latitude for Ratnapura
        const districtLongitude = 80.79124531032397; // Example longitude for Ratnapura
    
        // Set the destination coordinates (e.g., Delhousie Hotel)
        const destinationLatitude =  6.967450380543361; // Example latitude for Delhousie,, 
        const destinationLongitude = 80.76490757322674; // Example longitude for Delhousie
    
        const mapFrame = document.querySelector('#mapFrame');
        mapFrame.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&&origin=${districtLatitude},${districtLongitude}&destination=${destinationLatitude},${destinationLongitude}&mode=driving`;
    </script>
    
    
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&callback=initMap">
        // myAPIKEYCOMESHERE
    </script>
    

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
</body>

</html>