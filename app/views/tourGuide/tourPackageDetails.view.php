<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Package Details</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flexContainer">
        <?php include_once APPROOT . '\views\inc\tourGuideNavBar.php'; ?>

        <!-- Main Content -->
        <div class="body-container">
            <div class="sub-heading">
                <a class="back_button" href="<?= ROOT ?>/tourGuide/C_tourPackages">&larr; Back</a>
            </div>

            <?php if (!empty($data['tourPackage'])): ?>
                <div class="packageDetailHead">
                    <div>
                        <h1 id="heading">
                            <?= htmlspecialchars($data['tourPackage']->package_name ?? 'N/A') ?>
                        </h1>
                        <h2 id="sub-heading">
                            <?= htmlspecialchars($data['tourPackage']->tour_location ?? 'N/A') ?>
                        </h2>
                    </div>
                    <div class="package-save-btn">
                        <a href="<?= ROOT ?>/tourGuide/C_tourPackages/editTour/<?= $data['tourPackage']->id ?>">Edit</a>
                    </div>
                </div>
                
                <div class="image-gallery">
                    <?php if (!empty($data['tourPackage']->images)): ?>
                        <?php foreach ($data['tourPackage']->images as $image): ?>
                            <img src="<?= ROOT ?> <?= htmlspecialchars($image) ?>" 
                                alt="<?= htmlspecialchars($data['tourPackage']->package_name ?? 'Tour Image') ?>">
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No images available</p>
                    <?php endif; ?>
                </div>

                <div class="package-details">
                    <p><strong>Duration:</strong> <?= htmlspecialchars($data['tourPackage']->duration ?? 'N/A') ?></p>
                    <p><strong>Max people:</strong> <?= htmlspecialchars($data['tourPackage']->number_of_people ?? 'N/A') ?></p>
                    <p><strong>Rate:</strong> Rs. <?= htmlspecialchars($data['tourPackage']->rate ?? 'N/A') ?></p>
                </div>

                <div class="package-description">
                    <?= htmlspecialchars($data['tourPackage']->description ?? 'No description available') ?>
                </div>

                <div class="activities">
                    <?php if (!empty($data['tourPackage']->activities)): ?>
                        <?php foreach ($data['tourPackage']->activities as $activity): ?>
                            <p>• <?= htmlspecialchars($activity) ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No activities listed</p>
                    <?php endif; ?>
                </div>

                <!-- Delete Button -->
                <div class="delete-package-container">
                    <form action="<?= ROOT ?>/tourGuide/C_tourPackages/deleteTour/<?= $data['tourPackage']->id ?>" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this package?');">
                        <button type="submit" class="delete-button" style="width: 20%">Delete package</button>
                    </form>
                </div>
            <?php else: ?>
                <div class="error-message">
                    <p>Tour package not found</p>
                </div>
            <?php endif; ?>
        </div>              
    </div>
</body>
</html>