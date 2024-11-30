<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/nuwaraEliya.css">
    <link rel = "icon" href = "<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | About Nuwara Eliya</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a  href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>

        </nav>
    </header>

    <div class = "top">

        <div class = "placeIntro">
            <h1>
                Nuwara Eliya
            </h1>
            <p>
                Nuwara Eliya, often called "Little England," is a charming town nestled in the heart of Sri Lanka's hill country. 
                Known for its cool climate, lush green tea plantations, and colonial architecture, this picturesque destination 
                offers breathtaking landscapes and a tranquil escape. Visitors can explore vibrant gardens, visit historic tea estates, 
                and enjoy scenic boat rides on Gregory Lake. With misty mountains, cascading waterfalls, and a touch of old-world charm, 
                Nuwara Eliya is a perfect blend of natural beauty and cultural heritage.
            </p>
        </div>

        <div class="gallery-container">
        
            <div class="slider-wrapper">

                <div class="slider">
                    <img id="slide1" src="<?= IMAGES ?>/travelers/nuwaraEliya/carousalGallery/Image1.jpg">
                    <img id="slide2" src="<?= IMAGES ?>/travelers/nuwaraEliya/carousalGallery/image2.jpg">
                    <img id="slide3" src="<?= IMAGES ?>/travelers/nuwaraEliya/carousalGallery/image3.jpg">
                    <img id="slide4" src="<?= IMAGES ?>/travelers/nuwaraEliya/carousalGallery/image4.jpg">
                    <img id="slide5" src="<?= IMAGES ?>/travelers/nuwaraEliya/carousalGallery/Image5.jpg">
        
                    <div class="slider-nav">
                        <a href="#slide1"></a>
                        <a href="#slide2"></a>
                        <a href="#slide3"></a>
                        <a href="#slide4"></a>
                        <a href="#slide5"></a>
                    </div>
        
                </div>
        
            </div>
        
        </div>

    </div>

    <div class = "detailsContainer">
        <h2>
            Places to Visit
        </h2>

        <p>
            Discover the top 3 must visit places in Nuwara Eliya, that we've handpicked just for you!
        </p>
        
        <div class = "imageContainer">

            <div class = "leftImg">

                <a href="<?= ROOT ?>/traveler/GregoryLake" title="Click here to view more details">

                    <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/topAttractions/greoryLake.jpg">

                     <p>
                        Gregory Lake
                     </p>

                </a>
                
            </div>

            <div class = "midImg">
                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/topAttractions/HortonPlains.jpg">
                <p>
                    Horton Plains
                </p>
            </div>

            <div class = "rightImg">
                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/topAttractions/victoriaPark.jpg">
                <p>
                    Victoria Park
                </p>
            </div>

        </div>

    </div>

    <div class = "detailsContainer">
        <h2>
            Places to Stay
        </h2>
        
        <div class = "imageContainer">

            <div class = "leftImg">

                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/hotels/araliya green hills.jpg">
                <p>
                    Araliya Green Hills Hotel
                </p>

            </div>

            <div class = "midImg">
                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/hotels/GrandHotelNuwaraEliya.jpg">
                <p>
                    The Grand Hotel - Heritage Grand
                </p>
            </div>

            <div class = "rightImg">
                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/hotels/the golden ridge hotel.jpg">
                <p>
                    The Golden Ridge Hotel
                </p>
            </div>

        </div>

        <button class="btn">See More</button>

    </div>

    <div class = "detailsContainer">
        <h2>
            Places to Dine-In or Takeaway
        </h2>
        
        <div class = "imageContainer">

            <div class = "leftImg">

                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/restaurants/deSilvaFoodCentre.jpg">
                <p>
                    De Silva Food Centre
                </p>

            </div>

            <div class = "midImg">
                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/restaurants/salmiyaItali.jpg">
                <p>
                    Salmiya Italian Restaurant
                </p>
            </div>

            <div class = "rightImg">
                <img src = "<?= IMAGES ?>/travelers/nuwaraEliya/restaurants/themparaduRest.jpg">
                <p>
                    Themparadu
                </p>
            </div>

        </div>

        <button class="btn">See More</button>

    </div>

    <div class = "foot">
        &copy; ExploreLK, 2024 | All Rights Reserved
    </div>
    
    
    
</body>
</html>