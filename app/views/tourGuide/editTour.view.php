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
                    <input type="text" id="package-name" value="Explore Nuwaraeliya">
        
                    <label for="tour-location">Tour Location</label>
                    <input type="text" id="tour-location" value="Nuwara Eliya, Sri Lanka">
        
                    <label for="duration">Duration (Days)</label>
                    <input type="number" id="duration" value="2">
        
                    <label for="number-of-people">Number of people (Max)</label>
                    <input type="number" id="number-of-people" value="5">
        
                    <label for="rate">Rate</label>
                    <input type="number" id="rate" value="15000">
        
                    <label for="description">Add a detailed description</label>
                    <textarea id="description" rows="5">Nuwara Eliya is a city in the tea country hills of central Sri Lanka. The naturally landscaped Hakgala Botanical Gardens displays roses and tree ferns, and shelters monkeys and blue magpies. Nearby Seetha Amman Temple, a colorful Hindu shrine, is decorated with religious figures. The Gregory Lake sits at the center of the city. The city is known for producing Ceylon tea, and for its cool climate.</textarea>
        
                    <label for="activity-name">Add activities or adventures</label>
                    <div id="activities-container">
                        <input type="text" class="activity-input" value="Visit Hakgala Botanical Gardens">
                    </div>
                    <div id="activities-container">
                        <input type="text" class="activity-input" value="Explore Seetha Amman Temple">
                    </div>
                    <div id="activities-container">
                        <input type="text" class="activity-input" value="Relax at Gregory Lake">
                    </div>
                    <div id="activities-container">
                        <input type="text" class="activity-input" value="">
                    </div>
                    <div id="activities-container">
                        <input type="text" class="activity-input" value="">
                    </div>
        
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
            newActivityInput.value = "Activity name";

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