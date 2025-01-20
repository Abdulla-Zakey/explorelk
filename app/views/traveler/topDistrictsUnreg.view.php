<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/topDistricts.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title><?= $data['title'] ?></title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/Home">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </nav>
    </header>

    <section id="main">
        <h1>Discover Sri Lanka's Top Destinations to Explore!</h1>

        <div class="filter-search-container">
            <select class="filter-dropdown" id="sortDistricts">
                <option disabled selected>Sort by</option>
                <option value="alphabetical" <?= isset($_GET['sort']) && $_GET['sort'] == 'alphabetical' ? 'selected' : '' ?>>Alphabetical</option>
                <option value="reverse alphabetical" <?= isset($_GET['sort']) && $_GET['sort'] == 'reverse alphabetical' ? 'selected' : '' ?>>Reverse Alphabetical</option>
            </select>

            <div class="search-bar">
                <input type="text" id="searchDistricts" placeholder="Search a Destination" 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"/>
                <button type="submit" id="searchButton">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <div class="districts-container">
            <?php 
                if (!empty($data['districts'])) {
                    $counter = 0;
                    foreach ($data['districts'] as $district) {
                        // Start a new row after every 3 districts
                        if ($counter % 3 == 0) {
                            echo '<div class="row">';
                        }
            ?>
                    <div class = "<?= ($counter % 3 == 0) ? 'left' : (($counter % 3 == 1) ? 'middle' : 'right') ?>" title="Click to view more details">
                        <a href="<?= ROOT ?>/traveler/ParticularDistrictUnreg/index/<?= $district['id'] ?>">
                            <img src="<?= $district['image_path'] ?>" alt="<?= htmlspecialchars($district['name']) ?>">
                            <span><?= htmlspecialchars($district['name']) ?></span>
                        </a>
                    </div>
            <?php
                    // Close the row div after every 3 districts or at the end
                    if ($counter % 3 == 2 || $counter == count($data['districts']) - 1) {
                        echo '</div>';
                    }
                    $counter++;
                }
            } else {
                echo '<p class = "no-results"> No destinations found matching your search.</p>';
            }
            ?>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortSelect = document.getElementById('sortDistricts');
            const searchInput = document.getElementById('searchDistricts');
            const searchButton = document.getElementById('searchButton');
            
            // Handle sorting
            sortSelect.addEventListener('change', function() {
                updateURL();
            });

            // Handle search
            searchButton.addEventListener('click', function() {
                updateURL();
            });

            // Handle enter key in search
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    updateURL();
                }
            });

            function updateURL() {
                const searchTerm = searchInput.value.trim();
                const sortValue = sortSelect.value;
                let url = new URL(window.location.href);
                
                // Update or remove search parameter
                if (searchTerm) {
                    url.searchParams.set('search', searchTerm);
                } else {
                    url.searchParams.delete('search');
                }
                
                // Update or remove sort parameter
                if (sortValue && sortValue !== 'Sort by') {
                    url.searchParams.set('sort', sortValue);
                } else {
                    url.searchParams.delete('sort');
                }
                
                window.location.href = url.toString();
            }
        });
    </script>
</body>
</html>
