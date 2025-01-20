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

                <h1 class="heading">Create a New Package</h1>
                <form action="<?= ROOT ?>/tourGuide/C_addTour/add" method="POST" enctype="multipart/form-data">

                    <label for="package-name">Package name</label>
                    <input type="text" id="package-name" name="package-name" placeholder="Eg: Hiking in the tea fields" value="<?= htmlspecialchars($data['package-name'] ?? '') ?>">

                    <label for="tour-location">Tour Location</label>
                    <input type="text" id="tour-location" name="tour-location" placeholder="Tour Location" value="<?= htmlspecialchars($data['tour-location'] ?? '') ?>">

                    <label for="duration">Duration</label>
                    <input type="number" id="duration" name="duration" placeholder="No. of Days" value="<?= htmlspecialchars($data['duration'] ?? '') ?>">

                    <label for="number-of-people">Number of people</label>
                    <input type="number" id="number-of-people" name="number-of-people" placeholder="No. of People" value="<?= htmlspecialchars($data['number-of-people'] ?? '') ?>">

                    <label for="rate">Rate</label>
                    <input type="number" id="rate" name="rate" placeholder="Amount for your package" value="<?= htmlspecialchars($data['rate'] ?? '') ?>">

                    <label for="description">Add a detailed description</label>
                    <textarea id="description" name="description" rows="5" placeholder="Enter package details here"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>

                    <label for="activity-name">Add an activity or adventure</label>
                    <div id="activities-container">
                        <input type="text" class="activity-input" name="activity-name" placeholder="Activity name" value="<?= htmlspecialchars($data['activity-name-1'] ?? '') ?>">
                    </div>

                    <label for="upload-images">Upload an image</label>
                    <div class="upload-container" id="upload-area">
                    <img src="<?= ROOT ?>/assets/images/tourGuide/upload-image.svg" alt="Upload Icon" class="upload-icon">
    <p>Click here to upload an image</p>
    <input type="file" id="upload-images" name="images[]" accept="image/*" multiple>
    <div id="image-preview-container"></div> <!-- Added container for image preview -->
</div>


                    <button type="submit" class="submit-btn">Add Tour Package</button>
                </form>
            </div>             
        </div>
    </body>

    <script>
        const uploadArea = document.getElementById("upload-area");
const uploadInput = document.getElementById("upload-images");
const imagePreviewContainer = document.getElementById("image-preview-container");

// Trigger file input when the upload area is clicked
uploadArea.addEventListener("click", () => {
    uploadInput.click();
});

// Event listener to handle image preview
uploadInput.addEventListener("change", (event) => {
    // Clear previous preview images
    imagePreviewContainer.innerHTML = '';

    // Get the selected files
    const files = event.target.files;

    // Loop through each selected file
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        // When the file is loaded, create an image element to display it
        reader.onload = function (e) {
            const imgElement = document.createElement("img");
            imgElement.src = e.target.result;
            imgElement.style.maxWidth = "10%";
            imgElement.style.marginTop = "0px"; // Optional styling for margin
            imagePreviewContainer.appendChild(imgElement);
        };

        // Read the file as a Data URL
        reader.readAsDataURL(file);
    }
});

    </script>
</html>