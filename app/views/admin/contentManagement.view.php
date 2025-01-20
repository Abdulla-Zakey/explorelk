<html lang="en">
<head>
    <title>ExploreLK Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
</head>
<body>
    <div class="flexContainer">
    
        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="body-container">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div class="content-management-container">
                <h1 class="heading">Contents of Tourist Places</h1>
        
                <div class="search-bar">
                    <input type="text" placeholder="Search for a Place" class="search-input"/>
                    <!-- <button class="search-btn">Add New Content <span class="content-icon">+</span></button> -->
                    <!-- <a href="contentManagementDetailedView.html"><button class="content-detail-btn">Search</button></a> -->
                    <a href="<?=ROOT?>/admin/C_contentManagementDetailedView"><button class="search-button">Add New Content</button></a>
                </div>
        
                <div class="tourist-place">
                    <img src="<?=ROOT?>/assets/images/tourGuide/Fishing hut.png" alt="Fishing Hut">
                    <div class="place-info">
                        <h3>Fishing Hut</h3>
                        <p>Uncover the tranquil charm of Fishing Hut, a secluded haven tucked away in the pristine wilderness of Sri Lanka. Located along the banks of a gently flowing river, this serene retreat offers an idyllic escape into nature...</p>
                    </div>
                    <a href="<?=ROOT?>/admin/C_contentManagementDetailedView.html"><button class="content-detail-btn">Detail &rarr;</button></a>
                    
                </div>
        
                <div class="tourist-place">
                    <img src="<?=ROOT?>/assets/images/tourGuide/sandagalathenna.png" alt="Sandagalathenna">
                    <div class="place-info">
                        <h3>Sandagalathenna</h3>
                        <p>Discover the serene beauty of Sandagalathenna, a picturesque hilltop nestled in the heart of Sri Lanka's rolling landscapes. Perched at an elevation that offers panoramic views of lush valleys and distant mountains...</p>
                    </div>
                    <a href="<?=ROOT?>/admin/C_contentManagementDetailedView.html"><button class="content-detail-btn">Detail &rarr;</button></a>
                </div>
        
                <div class="tourist-place">
                    <img src="<?=ROOT?>/assets/images/tourGuide/gartmore falls.png" alt="Gartmore Falls">
                    <div class="place-info">
                        <h3>Gartmore Falls</h3>
                        <p>Gartmore Falls offers a peaceful retreat where you can relax and immerse yourself in the natural surroundings. The misty spray from the falls, combined with the cool mountain breeze, creates a refreshing atmosphere...</p>
                    </div>
                    <a href="<?=ROOT?>/admin/C_contentManagementDetailedView.html"><button class="content-detail-btn">Detail &rarr;</button></a>
                </div>
        
                <div class="tourist-place">
                    <img src="<?=ROOT?>/assets/images/tourGuide/morrey.png" alt="Moray Falls">
                    <div class="place-info">
                        <h3>Moray Falls</h3>
                        <p>Experience the mesmerizing beauty of Moray Falls, a captivating waterfall tucked away in the lush hills of Sri Lanka's central highlands. As the water cascades down from a height of...</p>
                    </div>
                    <a href="<?=ROOT?>/admin/C_contentManagementDetailedView.html"><button class="content-detail-btn">Detail &rarr;</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>