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

                <h1 class="heading">Create a New Package</h1>
                <form action="submitPackage" method="POST">
                    <label for="package-name">Package name</label>
                    <input type="text" id="package-name" placeholder="Eg: Hiking in the tea fields">
        
                    <label for="tour-location">Tour Location</label>
                    <input type="text" id="tour-location" placeholder="Tour Location">
        
                    <label for="duration">Duration</label>
                    <input type="number" id="duration" placeholder="No. of Days">
        
                    <label for="number-of-people">Number of people</label>
                    <input type="number" id="number-of-people" placeholder="No. of People">
        
                    <label for="rate">Rate</label>
                    <input type="number" id="rate" placeholder="Amount for your package">
        
                    <label for="description">Add a detailed description</label>
                    <textarea id="description" rows="5" placeholder="Enter package details here"></textarea>
        
                    <label for="activity-name">Add activities or adventures</label>
                    <div id="activities-container">
                        <input type="text" class="activity-input" placeholder="Activity name">
                    </div>
                    <button type="button" id = "add-activity-btn" class="add-activity-btn">Add activity</button>
        
                    <label for="upload-images">Upload images</label>
                    <div class="upload-container" id="upload-area">
                        <img src="<?=ROOT?>/assets/images/tourGuide/upload-image.svg" alt="Upload Icon" class="upload-icon">
                        <p>Click here to upload images</p>
                        <input type="file" id="upload-images" accept="image/*" multiple>
                    </div>
        
                    <button type="submit" class="submit-btn">Add Tour Package</button>
                </form>
            </div>             
        </div>
    </body>

    <script>
        // Get references to the button and activities container
        const addActivityButton = document.getElementById("add-activity-btn");
        const activitiesContainer = document.getElementById("activities-container");

        // Add a new activity input when the button is clicked
        addActivityButton.addEventListener("click", () => {
            // Create a new input element
            const newActivityInput = document.createElement("input");
            newActivityInput.type = "text";
            newActivityInput.className = "activity-input";
            newActivityInput.placeholder = "Activity name";

            // Append the new input to the activities container
            activitiesContainer.appendChild(newActivityInput);
        });

        const uploadArea = document.getElementById("upload-area");
        const uploadInput = document.getElementById("upload-images");

        uploadArea.addEventListener("click", () => {
            uploadInput.click();
        });
    </script>
</html>