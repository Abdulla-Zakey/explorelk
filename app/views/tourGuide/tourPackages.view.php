<?php
    $tourPackages = $data['tourPackages'];
    $tourPackageImages = $data['tourPackageImages'];
    // show($tourPackages);
    // show($tourPackageImages);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourPackages.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <div class="main-container">
            <div class="page-header">
                <div>
                    <h1>Your Tour Packages</h1>
                </div>
                <a href="<?= ROOT ?>/tourGuide/C_addTour" class="add-tour-btn">
                    <i class="fas fa-plus"></i> Add Tour Package
                </a>
            </div>

            <div class="tour-packages-grid">
                <!-- Tour Package Card 1 -->
                <?php foreach ($tourPackages as $tourPackage): ?>
                <?php 
                    // show($tourPackage); 
                    // Find images for this specific tour package
                    $packageImages = array_filter($tourPackageImages, function($image) use ($tourPackage) {
                        return $image->package_id == $tourPackage->package_id;
                    });

                    $displayImage = !empty($packageImages) ? reset($packageImages) : null;
                    // show($packageImages);
                    // show($tourPackage);
                ?>
                <div class="tour-card">
                    <div class="tourPackage-image">
                        <img src= "<?= ROOT . $displayImage->image_path ?>" alt="Ella Adventure">
                        <div class="tour-duration"><i class="far fa-clock"></i> 1 Day</div>
                    </div>
                    <div class="tour-content">
                        <h3><?= $tourPackage->name ?></h3>
                        <div class="tour-highlights">
                            <span><i class="fa fa-map-marker"></i><?= $tourPackage->location ?></span>
                            <span><i class="fa fa-users"></i> <?= $tourPackage->group_size ?> people</span>
                        </div>
                        <p><?php echo substr($tourPackage->description, 0, 250); ?>&nbsp;. . .</p>
                        <div class="tour-footer">
                            <div class="tour-price"><?= $tourPackage->package_price ?> LKR <span>for package</span></div>
                            <button onclick="viewDetails(<?= $tourPackage->package_id ?>)" class="view-btn">View Details</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <script>
        function viewDetails(packageId) {
            window.location.href = "<?= ROOT ?>/tourGuide/C_tourPackageDetails?packageId=" + packageId;
        }
    </script>
</body>

</html>