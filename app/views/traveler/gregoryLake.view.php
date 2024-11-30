<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/gregoryLake.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Gregory Lake - Nuwara Eliya</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places"></script>
</head>
<body>
    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a  href="<?= ROOT ?>/traveler/NuwaraEliya">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>

            <ul class="nav-links">
                <li><a href = "<?= ROOT ?>/traveler/RegisteredTravelerHome">Home</a></li>
                <li><a href = "<?= ROOT ?>/traveler/FindAHotel" target = "_blank">Find a Hotel</a></li>
                <li><a href = "<?= ROOT ?>/traveler/RentACar" target = "_blank">Rent a Car</a></li>
                <li><a href = "#">Restaurants</a></li>
                <li><a href = "tourGuides.html">Join a Tour</a></li>
                <li><a href = "#">Upcoming Events</a></li>
            </ul>

        </nav>
    </header>

    <section id = "main">
        <h1>
            Gregory Lake
        </h1>
        
        <div class = "row">
            <div class="infoText">
                Discover the serene beauty of Gregory Lake, a jewel in the heart of Nuwara Eliya. This stunning man-made lake, 
                built in the 19th century during the British colonial era, is a perfect blend of natural charm and leisurely allure. 
                Surrounded by rolling hills and lush greenery, it offers an idyllic escape for anyone seeking relaxation amidst nature's 
                tranquility.
            
                <br><br>
                Stroll along the scenic pathways or enjoy a peaceful boat ride across the shimmering waters, where the crisp mountain air and 
                gentle ripples create a calming ambiance. Adventure seekers can engage in thrilling water sports, 
                while families can picnic on the grassy banks, taking in the breathtaking views of the surrounding highlands.
            
                <br><br>
                Whether you're looking for adventure, relaxation, or a romantic getaway, Gregory Lake promises an unforgettable experience. 
                Its enchanting scenery and versatile activities make it a must-visit destination in the cool, misty landscapes of Nuwara Eliya.
            </div>

            <div class = "mapHolder">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31683.563495645103!2d80.75773365606011!3d6.956666104786141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae380f70b675859%3A0x3362d6f28dc32189!2sLake%20Gregory!5e0!3m2!1sen!2slk!4v1731819821558!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                
            </div>
        </div>
        
    </section>

    <section class = "gallery-container">
        <div class = "slider-wrapper">
            <div class = "slider">
                <img id = "slide1" src = "<?= IMAGES ?>/travelers/nuwaraEliya/gregorLake/Image5.jpg">
                <img id = "slide2" src = "<?= IMAGES ?>/travelers/nuwaraEliya/gregorLake/Image1.jpg">
                <img id = "slide3" src = "<?= IMAGES ?>/travelers/nuwaraEliya/gregorLake/Image7.jpg">
                <img id = "slide4" src = "<?= IMAGES ?>/travelers/nuwaraEliya/gregorLake/Image8.jpg">
                <img id = "slide5" src = "<?= IMAGES ?>/travelers/nuwaraEliya/gregorLake/Image4.jpg">
                
                <div class = "slider-nav">
                    <a href = "#slide1"></a>
                    <a href = "#slide2"></a>
                    <a href = "#slide3"></a>
                    <a href = "#slide4"></a>
                    <a href = "#slide5"></a>
                </div>
                
            </div>

        </div>
    </section>

    <section id = "thingsToDo">
        <h1>
            Things to Do at Gregory Lake
        </h1>
        <div class = "todo-container">
            <div id = "todo1">

                <div class = "activityType">
                    <i class="fas fa-ship"></i> Boat Rides:
                </div>

                <div class = "activity">
                    Enjoy a leisurely pedal boat or motorboat ride across the calm, picturesque waters of the lake, perfect for soaking in the surrounding beauty.
                </div>
                
            </div>

            <div id = "todo2">

                <div class = "activityType">
                    <i class="fas fa-horse"></i>Horseback Riding:
                </div>

                <div class = "activity">
                    Explore the lake’s scenic trails on horseback, a popular and charming activity for visitors of all ages.
                </div>

            </div>

            <div id = "todo3">

                <div class = "activityType">
                    <i class="fas fa-water"></i>Water Sports:
                </div>

                <div class = "activity">
                    Thrill-seekers can indulge in activities like jet skiing and windsurfing for an adrenaline-pumping experience.
                </div>

            </div>

            <div id = "todo4">

                <div class = "activityType">
                    <i class="fas fa-utensils"></i>Picnics and Relaxation: 
                </div>

                <div class = "activity">
                    Pack a picnic and unwind on the well-maintained grassy banks, enjoying the fresh mountain air and serene environment.
                </div>

            </div>

            <div id = "todo5">

                <div class = "activityType">
                    <i class="fas fa-bicycle"></i>Cycling Around the Lake: 
                </div>

                <div class = "activity">
                    Rent a bicycle and pedal along the scenic pathways, taking in the lush greenery and stunning views of the surrounding hills.
                </div>

                 
            </div>

        </div>
    </section>

    <section id = "bestTimeToVisit">
        <h1>
            Best Time to Visit Gregory Lake
        </h1>

        <div class = "points-container">

            <div id = "point1">
                <div class = "icon">
                    <i class="fa-solid fa-square"></i>
                </div>

                <div>
                    The best time to visit Gregory Lake in Nuwara Eliya is during the dry season, which typically spans <b>February to April</b>. 
                    Here’s why:
                </div>
                
            </div>

            <div id = "point2">
                <div class = "icon">
                    <i class="fa-solid fa-square"></i>
                </div>
                <div>
                    <b>Pleasant Weather:</b> During this time, the climate is cool and sunny, 
                    making it ideal for outdoor activities like boating, cycling, and picnicking.
                </div>
            </div>

            <div id = "point3">
                <div  class = "icon">
                    <i class="fa-solid fa-square"></i>
                </div>
                <div>
                    <b>Peak Tourist Season:</b> The surrounding gardens and landscapes are at their best, 
                    especially with the famous <b>Nuwara Eliya flower season</b> in April.
                </div>
                
            </div>

            <div id = "point4">
                <div  class = "icon">
                    <i class="fa-solid fa-square"></i>
                </div>
                <div>
                    <b>Clear Views:</b> The dry season ensures minimal rainfall, 
                    offering clear skies and perfect views of the lush greenery and serene lake.
                </div>
                
            </div>

            <div id = "point5">
                <div  class = "icon">
                    <i class="fa-solid fa-square"></i>
                </div>

                <div>
                    While Gregory Lake can be visited year-round, the <b>monsoon months (May to September)</b> bring frequent rain, which might limit outdoor activities.
                </div>
                
            </div>
        </div>


    </section>

    
</body>
</html>