<?php
    $tourPackage = $data['tourPackage'];
    $tourPackageImages = $data['tourPackageImages'];
    $tourPackageItineraries = $data['tourPackageItinerary'];
    $dayActivities = $data['dayActivities'];
    // show($tourPackage);
    // show($tourPackageImages);
    // show($tourPackageItineraries);
    // show($dayActivities);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK | Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="icon" href="assets/images/logos/logoBlack.svg">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourPackageDetails.css">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
    /* Add this to your CSS file or in the head section */
    .delete-package-btn , .edit-package-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
        text-decoration: none;
    }

    .delete-package-btn {
        background-color:rgb(212, 6, 6);
    }

    .edit-package-btn:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .edit-package-btn i {
        margin-right: 8px;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
        gap: 10px;
    }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <a href="<?= ROOT ?>/tourGuide/C_tourPackages" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Tour Packages</span>
            </a>
            <a href="index.html" class="logo">
                <img src="<?= IMAGES ?>/logos/logoBlack.svg" alt="ExploreLK Logo">
                <h1>ExploreLK</h1>
            </a>
        </div>
    </header>

    <div class="main-container">

        <?php
            $tags = $tourPackage['0']->tags;
            $seperatedTags = explode(',', $tags);

            // Trim whitespace and remove empty entries
            $seperatedTags = array_map('trim', $seperatedTags);
            $seperatedTags = array_filter($seperatedTags);
        ?>
        <div class="tour-header">
            <div class="tour-title-container">
                <h1><?= $tourPackage['0']->name ?></h1>
                <?php if(!empty($seperatedTags)): ?>
                <div class="tour-tags">
                    <?php foreach($seperatedTags as $seperatedTag): ?>
                    <span class="tag"><?= $seperatedTag; ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="action-buttons">
                <a href="<?= ROOT ?>/tourGuide/C_tourPackageDetails/deletePackage/<?= $tourPackage['0']->package_id ?>"
                    class="delete-package-btn">
                    <i class="fas fa-edit"></i> Delete Package
                </a>
                <a href="<?= ROOT ?>/tourGuide/C_editTourPackage/<?= $tourPackage['0']->package_id ?>"
                    class="edit-package-btn">
                    <i class="fas fa-edit"></i> Edit Package
                </a>
            </div>
        </div>

        <!-- Rest of your HTML content remains the same -->
        <div class="tour-description">
            <p><?= $tourPackage['0']->description ?></p>
        </div>

        <div class="tour-quick-info">
            <div class="info-item">
                <i class="fa fa-calendar-alt"></i>
                <div>
                    <h3>Duration</h3>
                    <p><?= $tourPackage['0']->duration_days ?> days</p>
                </div>
            </div>
            <div class="info-item">
                <i class="fa fa-users"></i>
                <div>
                    <h3>Group Size</h3>
                    <p><?= $tourPackage['0']->group_size ?> people</p>
                </div>
            </div>
            <div class="info-item">
                <i class="fa fa-map-marker-alt"></i>
                <div>
                    <h3>Location</h3>
                    <p><?= $tourPackage['0']->location ?></p>
                </div>
            </div>
            <div class="info-item">
                <i class="fa fa-language"></i>
                <div>
                    <h3>Languages</h3>
                    <p><?= $tourPackage['0']->languages ?></p>
                </div>
            </div>
            <div class="tour-price-container">
                <div class="price"><?= $tourPackage['0']->package_price ?> LKR <span>for package</span></div>
            </div>
        </div>

        <div class="tour-gallery">
            <?php 
                $packageImages = array_filter($tourPackageImages, function($image) use ($tourPackage) {
                    return $image->package_id;
                });

                $mainImage = !empty($packageImages) ? reset($packageImages) : null;
            ?>
            <div class="main-image">
                <img src="<?= ROOT . $mainImage->image_path; ?>" alt="<?= $tourPackage['0']->name ?>">
            </div>
            <div class="thumbnail-images">
                <?php foreach ($packageImages as $packageImage): ?>
                <img src="<?= ROOT . $packageImage->image_path; ?>" alt="<?= $tourPackage['0']->name ?>"
                    class="thumbnail">
                <?php endforeach; ?>
            </div>
        </div>

        <div class="tour-sections">
            <div class="itinerary-section">
                <h2><i class="fas fa-route"></i> Tour Itinerary</h2>

                <?php foreach($tourPackageItineraries as $tourPackageItinerary): 
                    $currentDayId = $tourPackageItinerary->day_id;
                    $currentDayActivities = $dayActivities[$currentDayId] ?? [];
                ?>
                <div class="day-container">
                    <div class="day-header">
                        <h3>Day <?= $tourPackageItinerary->day_number ?></h3>
                        <span class="day-tag">Full Day</span>
                    </div>
                    <div class="day-content">
                        <?php foreach($currentDayActivities as $activity): ?>
                        <div class="activity">
                            <div class="activity-icon">
                                <i class="fas fa-sun"></i>
                            </div>
                            <div class="activity-details">
                                <h4><?= $activity->activity_time ?>: <?= $activity->title ?></h4>
                                <p><?= $activity->description ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
            $inclusions = $tourPackage['0']->inclusions;
            $exclusions = $tourPackage['0']->exclusions;

            $includedPoints = explode('.', $inclusions);
            $excludedPoints = explode('.', $exclusions);

            // Trim whitespace and remove empty entries
            $includedPoints = array_map('trim', $includedPoints);
            $includedPoints = array_filter($includedPoints);

            $excludedPoints = array_map('trim', $excludedPoints);
            $excludedPoints = array_filter($excludedPoints);
        ?>
        <div class="inclusions-exclusions">
            <?php if(!empty($includedPoints)): ?>
            <div class="inclusions">
                <h2><i class="fas fa-check-circle"></i> What's Included</h2>
                <ul>
                    <?php foreach($includedPoints as $includedPoint): ?>
                    <li><i class="fas fa-check"></i> <?= $includedPoint; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if(!empty($excludedPoints)): ?>
            <div class="exclusions">
                <h2><i class="fas fa-times-circle"></i> What's Not Included</h2>
                <ul>
                    <?php foreach($excludedPoints as $excludedPoint): ?>
                    <li><i class="fas fa-times"></i> <?= $excludedPoint; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main image gallery functionality
        const mainImage = document.querySelector('.main-image img');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                mainImage.src = this.src;

                // Add/remove active class from thumbnails
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
    </script>
</body>

</html>