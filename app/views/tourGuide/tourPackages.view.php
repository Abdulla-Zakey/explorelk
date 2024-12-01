<html>
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

            <!-- Main Content -->
            <div class="body-container">
                <!-- Header -->
                <div class="tour-package">
                    <h1 class="heading">Your tours</h1>
                    <a href="<?= ROOT?>/tourGuide/C_addTour"><button class="create-tour-button">Create new tour</button></a>
                </div>

                <!-- Search Bar -->
                <div>
                    <input type="text" class="search-input" placeholder="Search by name">
                </div>

                <!-- Tour List -->
                <div class="tour-list">
                    <!-- Tour Item 1 -->
                    <div class="tour-item">
                        <img src="<?= ROOT?>/assets/images/tourGuide/gartmore 1.png" alt="Gartmore Tour" class="tour-image">
                        <div class="tour-details">
                            <a href="<?= ROOT?>/tourGuide/C_tourPackageDetails"><h2 class="tour-title">Gartmore Falls</h2></a>
                            <p class="tour-info">1 Day &bull; Max 8 people</p>
                        </div>
                        <div class="menu-container">
                            <div class="menu-icon" onclick="toggleMenu(this)">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="menu-options">
                                <a href="<?=ROOT?>/tourGuide/C_editTour" style="text-decoration:none"><button class="menu-option">Edit</button></a>
                                <button class="menu-option" onclick="deleteTour()">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tour Item 2 -->
                    <div class="tour-item">
                        <img src="<?= ROOT?>/assets/images/tourGuide/nuwaraeliya.jpg" alt="Nuwara Eliya Tour" class="tour-image">
                        <div class="tour-details">
                            <a href="<?= ROOT?>/tourGuide/C_tourPackageDetails"><h2 class="tour-title">Nuwara Eliya</h2></a>
                            <p class="tour-info">2 Days &bull; Max 10 people</p>
                        </div>
                        <div class="menu-container">
                            <div class="menu-icon" onclick="toggleMenu(this)">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </div>
                            <div class="menu-options">
                                <a href="<?=ROOT?>/tourGuide/C_editTour" style="text-decoration:none"><button class="menu-option">Edit</button></a>
                                <button class="menu-option" onclick="deleteTour()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>

    <script>
        // Toggles the visibility of the menu options
        function toggleMenu(menuIcon) {
    const menuOptions = menuIcon.nextElementSibling;

    // Toggle display of menu options
    const isMenuOpen = menuOptions.style.display === "block";
    menuOptions.style.display = isMenuOpen ? "none" : "block";

    // Add or remove the expanded class for width adjustment
    if (!isMenuOpen) {
        menuOptions.classList.add("menu-options-expanded");
    } else {
        menuOptions.classList.remove("menu-options-expanded");
    }

    // Close any other open menus
    document.querySelectorAll(".menu-options").forEach((menu) => {
        if (menu !== menuOptions) {
            menu.style.display = "none";
            menu.classList.remove("menu-options-expanded");
        }
    });
}


        // Function to edit a tour
        function editTour() {
            alert("Edit functionality coming soon!");
        }

        // Function to delete a tour
        function deleteTour() {
            alert("Delete functionality coming soon!");
        }

        // Close menu options when clicking outside
        document.addEventListener("click", (event) => {
            const isMenuClick = event.target.closest(".menu-container");
            if (!isMenuClick) {
                document.querySelectorAll(".menu-options").forEach((menu) => {
                    menu.style.display = "none";
                });
            }
        });
    </script>
</html>
