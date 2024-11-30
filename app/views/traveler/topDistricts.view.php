<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel = "stylesheet" href =  "<?= ROOT ?>/assets/css/Traveler/topDistricts.css">
    <link rel = "icon" href = "<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Top Destinations in Sri Lanka</title>
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

    <section id = "main">
        <h1>
            Discover Sri Lanka's Top Destinations to Explore!
        </h1>

        <div class="filter-search-container">

            <select class="filter-dropdown">
                <option disabled selected>Sort by</option>
                <option value="popular">Popular</option>
                <option value="alphabetical">Alphabetical</option>
                <option value="reverse alphabetical">Reverse Alphabetical</option>
                
            </select>

            <div class="search-bar">
                <input type="text" placeholder="Search a Destination" />
                <button type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        

        <div class = "row">

            <div class="left" title="Click to view to more details">
                <a href="adamspeek.html">
                    <img src="<?= ROOT ?>/assets/images/travelers/topDistricts/anuradhapura.jpg">
                    <span>
                        Anuradhapura
                    </span>
                </a>
            </div>
           

            <div class = "middle" title="Click to view to more details">
                <a href="">
                    <img src="<?= ROOT ?>/assets/images/travelers/topDistricts/badulla.jpg">
                    <span>
                        Badulla
                    </span>
                </a>
            </div>

            <div class = "right" title="Click to view to more details">
                <a href="">
                    <img src="<?= ROOT ?>/assets/images/travelers/topDistricts/colombo.jpg">
                    <span>
                        Colombo
                    </span>
                </a>
            </div>

        </div>

        <div class = "row">

            <div class = "left" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/galle fort.jpg">
                <span>
                    Galle
                </span>
            </div>

            <div class = "middle" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/hambantota.jpg">
                <span>
                    Hambantota
                </span>
            </div>

            <div class = "right" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/jaffna.jpg">
                <span>
                    Jaffna
                </span>
            </div>

        </div>

        <div class = "row">

            <div class = "left" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/kandy.jpg">
                <span>
                    Kandy
                </span>
            </div>

            <div class = "middle" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/Kegalle.jpg">
                <span>
                    Kegalle
                </span>
            </div>

            <div class = "right" title="Click to view to more details">
                <a href="<?= ROOT ?>/traveler/NuwaraEliya">
                    <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/nuwaraEliya.jpg">
                    <span>
                        Nuwara Eliya
                    </span>
                </a>
                
            </div>

        </div>

        <div class = "row">

            <div class = "left" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/polonnaruwa.jpg">
                <span>
                    Polonnaruwa
                </span>
            </div>

            <div class = "middle" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/ratnapura.jpg">
                <span>
                    Ratnapura
                </span>
            </div>

            <div class = "right" title="Click to view to more details">
                <img src = "<?= ROOT ?>/assets/images/travelers/topDistricts/trinco.jpg">
                <span>
                    Trincomalee
                </span>
            </div>

        </div>

    </section>

</body>
</html>