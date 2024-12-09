<html>
    <head>
        <title>Edit Tour Package - ExploreLK Tour Guide</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="flexContainer">
            <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

            <div class="body-container">
                <div class="sub-heading">
                    <a class="back_button" href="<?= ROOT ?>/tourGuide/C_tourPackages">&larr; Back</a>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="error-container">
                        <?php foreach ($errors as $field => $error): ?>
                            <p><?= ucfirst($field) ?>: <?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <h1 class="heading">Edit Tour Package</h1>
                <form action="<?= ROOT ?>/tourGuide/C_tourPackages/updateTour" method="POST" enctype="multipart/form-data">

                    <!-- Hidden field for the tour package ID -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($tourPackage->id) ?>">

                    <label for="package-name">Package name</label>
                    <input type="text" id="package-name" name="package-name" placeholder="Eg: Hiking in the tea fields" value="<?= htmlspecialchars($tourPackage->package_name) ?>" required>

                    <label for="tour-location">Tour Location</label>
                    <input type="text" id="tour-location" name="tour-location" placeholder="Tour Location" value="<?= htmlspecialchars($tourPackage->tour_location) ?>" required>

                    <label for="duration">Duration (in days)</label>
                    <input type="number" id="duration" name="duration" placeholder="No. of Days" value="<?= htmlspecialchars($tourPackage->duration) ?>" required>

                    <label for="number-of-people">Number of people</label>
                    <input type="number" id="number-of-people" name="number-of-people" placeholder="No. of People" value="<?= htmlspecialchars($tourPackage->number_of_people) ?>" required>

                    <label for="rate">Rate (Amount)</label>
                    <input type="number" id="rate" name="rate" placeholder="Amount for your package" value="<?= htmlspecialchars($tourPackage->rate) ?>" required>

                    <label for="description">Add a detailed description</label>
                    <textarea id="description" name="description" rows="5" placeholder="Enter package details here" required><?= htmlspecialchars($tourPackage->description) ?></textarea>

                    <label for="activity-name">Add an activity or adventure</label>
                    <div id="activities-container">
                        <input type="text" class="activity-input" name="activity-name" placeholder="Activity name" value="<?= htmlspecialchars($tourPackage->activity_name) ?>">
                    </div>

                    <label for="upload-images">Upload an image</label>
                    <div class="upload-container" id="upload-area">
                        <img src="<?= ROOT ?>/assets/images/tourGuide/upload-image.svg" alt="Upload Icon" class="upload-icon">
                        <p>Click here to upload an image</p>
                        <input type="file" id="upload-images" name="images[]" accept="image/*" multiple>
                    </div>

                    <button type="submit" class="submit-btn">Update Tour Package</button>
                </form>
            </div>             
        </div>
    </body>

    <script>
        const uploadArea = document.getElementById("upload-area");
        const uploadInput = document.getElementById("upload-images");

        uploadArea.addEventListener("click", () => {
            uploadInput.click();
        });
    </script>
</html>