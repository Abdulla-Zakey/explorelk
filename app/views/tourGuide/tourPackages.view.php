<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <!-- Main Content -->
        <div class="body-container">
            <!-- Header -->
            <div class="tour-package">
                <h1 class="heading">Your Tours</h1>
                <a href="<?= ROOT ?>/tourGuide/C_addTour"><button class="create-tour-button">Create New Tour</button></a>
            </div>

            <!-- Search Bar -->
            <div>
                <input type="text" class="search-input" placeholder="Search by name">
            </div>
            
            <!-- Tour List -->
            <div class="tour-list">
                <?php if (!empty($data['tourPackages'])): ?>
                    <?php foreach ($data['tourPackages'] as $tour): ?>

                        <div class="tour-item">
                        <img src="<?= ROOT ?><?= htmlspecialchars($tour->images) ?>" alt="<?= htmlspecialchars($tour->package_name) ?> Tour" class="tour-image">

                            <div class="tour-details">
                            <a href="<?= ROOT ?>/tourGuide/C_tourPackageDetails/index/<?= $tour->id ?>">
                                <h2 class="tour-title"><?= htmlspecialchars($tour->package_name) ?></h2>
                            </a>
                                <p class="tour-info"><?= htmlspecialchars($tour->duration) ?> &bull; Max <?= htmlspecialchars($tour->number_of_people) ?> people</p>
                            </div>
                            <div class="menu-container">
                                <div class="menu-icon" onclick="toggleMenu(this)">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </div>
                                <div class="menu-options">
                                    <a href="<?= ROOT ?>/tourGuide/C_tourPackages/editTour/<?= $tour->id ?>" class="menu-option">Edit</a>
                                    <button class="menu-option" onclick="deleteTour(<?= $tour->id ?>)">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No tour packages available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

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

        // Function to delete a tour
        function deleteTour(tourId) {
            alert("Are you sure you want to delete: " + tourId);
            window.location.href = '<?= ROOT ?>/tourGuide/C_tourPackages/deleteTour/${tourId}';
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
</body>
</html>