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

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tour Package - ExploreLK Tour Guide</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/addTour.css">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
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

    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2>Edit Tour Package</h2>
                <p>Update the details of your tour package</p>
            </div>

            <?php if (!empty($errors)): ?>
            <div class="error-container">
                <?php foreach ($errors as $field => $error): ?>
                <p><?= ucfirst($field) ?>: <?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form id="tourPackageForm" method="POST" action="<?= ROOT ?>/tourGuide/C_editTour/updatePackage"
                enctype="multipart/form-data">
                <input type="hidden" name="package_id" value="<?= htmlspecialchars($tourPackage['0']->package_id) ?>">

                <div class="form-grid">
                    <!-- Basic Information -->
                    <div class="form-group">
                        <label for="packageName" class="required">Package Name</label>
                        <input type="text" id="packageName" name="name" class="form-control"
                            placeholder="E.g., Ella Adventure" value="<?= htmlspecialchars($tourPackage['0']->name) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="packageLocation" class="required">Location</label>
                        <input type="text" id="packageLocation" name="location" class="form-control"
                            placeholder="E.g., Ella, Sri Lanka"
                            value="<?= htmlspecialchars($tourPackage['0']->location) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="packageDuration" class="required">Duration (days)</label>
                        <input type="number" id="packageDuration" name="duration_days" class="form-control" min="1"
                            placeholder="E.g., 2" value="<?= htmlspecialchars($tourPackage['0']->duration_days) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="packageGroupSize" class="required">Group Size</label>
                        <input type="text" id="packageGroupSize" name="group_size" class="form-control"
                            placeholder="E.g., 10-15 people"
                            value="<?= htmlspecialchars($tourPackage['0']->group_size) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="packagePrice" class="required">Price per person (LKR)</label>
                        <input type="number" id="packagePrice" name="package_price" class="form-control" min="0"
                            placeholder="E.g., 7500" value="<?= htmlspecialchars($tourPackage['0']->package_price) ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="packageLanguages">Languages</label>
                        <input type="text" id="packageLanguages" name="languages" class="form-control"
                            placeholder="E.g., English, Sinhala, Tamil"
                            value="<?= htmlspecialchars($tourPackage['0']->languages) ?>">
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group full-width">
                        <label>Package Images</label>
                        <div class="image-upload-container" id="imageUploadContainer">
                            <i class="fas fa-images"></i>
                            <p>Drag & drop images here or click to browse</p>
                            <label for="packageImages" class="upload-btn">Select Images</label>
                            <input type="file" id="packageImages" name="packageImages[]" multiple accept="image/*">
                        </div>
                        <div class="preview-images" id="previewImages">
                            <?php if (!empty($tourPackageImages)): ?>
                            <?php foreach ($tourPackageImages as $image): ?>
                            <div class="preview-image" data-image-id="<?= htmlspecialchars($image->image_id) ?>">
                                <img src="<?= ROOT ?>/<?= htmlspecialchars($image->image_path) ?>" alt="Tour Image">
                                <span class="remove-image">&times;</span>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group full-width">
                        <label for="packageDescription" class="required">Package Description</label>
                        <textarea id="packageDescription" name="description" class="form-control"
                            placeholder="Describe the tour package in detail..."
                            required><?= htmlspecialchars($tourPackage['0']->description) ?></textarea>
                    </div>

                    <!-- Tags -->
                    <div class="form-group full-width">
                        <label for="packageTags">Tags</label>
                        <input type="text" id="packageTags" name="tags" class="form-control"
                            placeholder="E.g., Hiking, Nature, Photography (comma separated)"
                            value="<?= htmlspecialchars($tourPackage['0']->tags) ?>">
                    </div>

                    <!-- Itinerary Section -->
                    <div class="form-group full-width">
                        <label class="required">Tour Itinerary</label>

                        <button type="button" class="add-day" id="addDayBtn">
                            <i class="fas fa-plus"></i>
                            Add Day
                        </button>

                        <div id="itineraryDays">
                            <!-- Days will be added here dynamically -->
                            <?php if (!empty($tourPackageItineraries)): ?>
                            <?php foreach ($tourPackageItineraries as $itinerary): 
                                $currentDayId = $itinerary->day_id;
                                $currentDayActivities = $dayActivities[$currentDayId] ?? [];
                            ?>
                            <div class="day-container" data-day-number="<?= $itinerary->day_number ?>">
                                <div class="day-header">
                                    <h3>Day <?= $itinerary->day_number ?></h3>
                                    <button type="button" class="remove-day" data-day="<?= $itinerary->day_number ?>">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="day-activities" id="dayActivities<?= $itinerary->day_number ?>">
                                    <?php foreach ($currentDayActivities as $activity): ?>
                                    <div class="activity" data-activity-id="<?= $activity->activity_id ?>">
                                        <div class="activity-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="activity-details">
                                            <div class="form-group">
                                                <label class="required">Activity Title</label>
                                                <input type="text" class="form-control activity-title"
                                                    name="day<?= $itinerary->day_number ?>_activity[]"
                                                    placeholder="E.g., Morning Hike to Little Adam's Peak"
                                                    value="<?= htmlspecialchars($activity->title) ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Activity Description</label>
                                                <textarea class="form-control activity-description"
                                                    name="day<?= $itinerary->day_number ?>_description[]"
                                                    placeholder="Describe the activity in detail..."><?= htmlspecialchars($activity->description) ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Activity Time</label>
                                                <input type="text" class="form-control activity-time"
                                                    name="day<?= $itinerary->day_number ?>_time[]"
                                                    placeholder="E.g., Morning, Afternoon, or specific time"
                                                    value="<?= htmlspecialchars($activity->activity_time) ?>">
                                            </div>
                                            <button type="button" class="btn btn-secondary remove-activity"
                                                style="padding: 0.5rem 1rem; font-size: 1.4rem;">
                                                Remove Activity
                                            </button>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="add-activity" data-day="<?= $itinerary->day_number ?>">
                                    <i class="fas fa-plus"></i>
                                    Add Activity
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <!-- Default empty day if no itinerary exists -->
                            <div class="day-container" data-day-number="1">
                                <div class="day-header">
                                    <h3>Day 1</h3>
                                    <button type="button" class="remove-day" data-day="1">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="day-activities" id="dayActivities1">
                                    <div class="activity" data-activity-id="<?= time() ?>">
                                        <div class="activity-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="activity-details">
                                            <div class="form-group">
                                                <label class="required">Activity Title</label>
                                                <input type="text" class="form-control activity-title"
                                                    name="day1_activity[]"
                                                    placeholder="E.g., Morning Hike to Little Adam's Peak" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Activity Description</label>
                                                <textarea class="form-control activity-description"
                                                    name="day1_description[]"
                                                    placeholder="Describe the activity in detail..."></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Activity Time</label>
                                                <input type="text" class="form-control activity-time" name="day1_time[]"
                                                    placeholder="E.g., Morning, Afternoon, or specific time">
                                            </div>
                                            <button type="button" class="btn btn-secondary remove-activity"
                                                style="padding: 0.5rem 1rem; font-size: 1.4rem;">
                                                Remove Activity
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-activity" data-day="1">
                                    <i class="fas fa-plus"></i>
                                    Add Activity
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Inclusions & Exclusions -->
                    <div class="form-group">
                        <label for="packageInclusions">What's Included</label>
                        <textarea id="packageInclusions" name="inclusions" class="form-control"
                            placeholder="List items separated by commas"><?= htmlspecialchars($tourPackage['0']->inclusions) ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="packageExclusions">What's Not Included</label>
                        <textarea id="packageExclusions" name="exclusions" class="form-control"
                            placeholder="List items separated by commas"><?= htmlspecialchars($tourPackage['0']->exclusions) ?></textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="resetBtn">Reset Changes</button>
                        <button type="submit" class="btn btn-primary">Update Tour Package</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    <div class="success-message" id="successMessage">
        <i class="fas fa-check-circle"></i>
        <span>Tour package updated successfully!</span>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Upload Functionality
        const imageUploadContainer = document.getElementById('imageUploadContainer');
        const packageImagesInput = document.getElementById('packageImages');
        const previewImagesContainer = document.getElementById('previewImages');

        // Handle drag and drop
        imageUploadContainer.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'darkcyan';
            this.style.backgroundColor = 'rgba(0, 139, 139, 0.1)';
        });

        imageUploadContainer.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = 'white';
        });

        imageUploadContainer.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#ddd';
            this.style.backgroundColor = 'white';

            if (e.dataTransfer.files.length > 0) {
                packageImagesInput.files = e.dataTransfer.files;
                previewImages();
            }
        });

        // Handle file selection
        packageImagesInput.addEventListener('change', previewImages);

        function previewImages() {
            const files = packageImagesInput.files;

            if (files.length === 0) {
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.match('image.*')) continue;

                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewImage = document.createElement('div');
                    previewImage.className = 'preview-image';

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-image';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.addEventListener('click', function() {
                        previewImage.remove();
                        updateFileList();
                    });

                    previewImage.appendChild(img);
                    previewImage.appendChild(removeBtn);
                    previewImagesContainer.appendChild(previewImage);
                }

                reader.readAsDataURL(file);
            }
        }

        function updateFileList() {
            const remainingImages = previewImagesContainer.querySelectorAll('.preview-image');
            if (remainingImages.length === 0) {
                packageImagesInput.value = '';
                return;
            }
        }

        // Remove existing images
        // Replace the existing image removal event listeners
        previewImagesContainer.querySelectorAll('.remove-image').forEach(btn => {
            btn.addEventListener('click', function() {
                const imageDiv = this.parentElement;
                const imagePath = imageDiv.querySelector('img').src;

                // Extract the image ID from the image div if it exists
                const imageId = imageDiv.dataset.imageId;

                if (imageId) {
                    // Create a hidden input to track this image for deletion
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'delete_images[]';
                    hiddenInput.value = imageId;
                    document.getElementById('tourPackageForm').appendChild(hiddenInput);
                }

                // Remove the preview
                imageDiv.remove();
            });
        });

        // Itinerary Functionality
        const addDayBtn = document.getElementById('addDayBtn');
        const itineraryDays = document.getElementById('itineraryDays');
        let dayCount = document.querySelectorAll('.day-container').length || 0;

        addDayBtn.addEventListener('click', function() {
            dayCount++;
            addDay(dayCount);
        });

        function addDay(dayNumber) {
            const dayContainer = document.createElement('div');
            dayContainer.className = 'day-container';
            dayContainer.dataset.dayNumber = dayNumber;

            dayContainer.innerHTML = `
                    <div class="day-header">
                        <h3>Day ${dayNumber}</h3>
                        <button type="button" class="remove-day" data-day="${dayNumber}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="day-activities" id="dayActivities${dayNumber}">
                        <!-- Activities will be added here -->
                    </div>
                    <div class="add-activity" data-day="${dayNumber}">
                        <i class="fas fa-plus"></i>
                        Add Activity
                    </div>
                `;

            itineraryDays.appendChild(dayContainer);

            // Add first activity by default
            addActivity(dayNumber);

            // Add event listener for remove day button
            dayContainer.querySelector('.remove-day').addEventListener('click', function() {
                if (confirm('Are you sure you want to remove this day and all its activities?')) {
                    dayContainer.remove();
                    renumberDays();
                }
            });

            // Add event listener for add activity button
            dayContainer.querySelector('.add-activity').addEventListener('click', function() {
                addActivity(dayNumber);
            });
        }

        function addActivity(dayNumber) {
            const activitiesContainer = document.getElementById(`dayActivities${dayNumber}`);
            const activityId = Date.now(); // Unique ID for each activity

            const activityDiv = document.createElement('div');
            activityDiv.className = 'activity';
            activityDiv.dataset.activityId = activityId;

            activityDiv.innerHTML = `
                    <div class="activity-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="activity-details">
                        <div class="form-group">
                            <label class="required">Activity Title</label>
                            <input type="text" class="form-control activity-title" name="day${dayNumber}_activity[]" placeholder="E.g., Morning Hike to Little Adam's Peak" required>
                        </div>
                        <div class="form-group">
                            <label>Activity Description</label>
                            <textarea class="form-control activity-description" name="day${dayNumber}_description[]" placeholder="Describe the activity in detail..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Activity Time</label>
                            <input type="text" class="form-control activity-time" name="day${dayNumber}_time[]" placeholder="E.g., Morning, Afternoon, or specific time">
                        </div>
                        <button type="button" class="btn btn-secondary remove-activity" style="padding: 0.5rem 1rem; font-size: 1.4rem;">
                            Remove Activity
                        </button>
                    </div>
                `;

            activitiesContainer.appendChild(activityDiv);

            // Add event listener for remove activity button
            activityDiv.querySelector('.remove-activity').addEventListener('click', function() {
                if (activitiesContainer.children.length > 1) {
                    activityDiv.remove();
                } else {
                    alert('Each day must have at least one activity.');
                }
            });
        }

        function renumberDays() {
            const dayContainers = itineraryDays.querySelectorAll('.day-container');
            dayCount = dayContainers.length;

            dayContainers.forEach((container, index) => {
                const dayNumber = index + 1;
                container.dataset.dayNumber = dayNumber;
                container.querySelector('h3').textContent = `Day ${dayNumber}`;
                container.querySelector('.add-activity').dataset.day = dayNumber;
                container.id = `dayActivities${dayNumber}`;

                // Update all activity input names
                const activities = container.querySelectorAll('.activity');
                activities.forEach(activity => {
                    activity.querySelector('.activity-title').name =
                        `day${dayNumber}_activity[]`;
                    activity.querySelector('.activity-description').name =
                        `day${dayNumber}_description[]`;
                    activity.querySelector('.activity-time').name = `day${dayNumber}_time[]`;
                });
            });
        }

        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-day').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm(
                        'Are you sure you want to remove this day and all its activities?')) {
                    this.closest('.day-container').remove();
                    renumberDays();
                }
            });
        });

        document.querySelectorAll('.remove-activity').forEach(btn => {
            btn.addEventListener('click', function() {
                const activitiesContainer = this.closest('.day-activities');
                if (activitiesContainer.children.length > 1) {
                    this.closest('.activity').remove();
                } else {
                    alert('Each day must have at least one activity.');
                }
            });
        });

        document.querySelectorAll('.add-activity').forEach(btn => {
            btn.addEventListener('click', function() {
                const dayNumber = this.dataset.day;
                addActivity(dayNumber);
            });
        });

        // Form Submission
        const tourPackageForm = document.getElementById('tourPackageForm');
        const resetBtn = document.getElementById('resetBtn');
        const successMessage = document.getElementById('successMessage');

        // Reset Form
        resetBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to reset all changes?')) {
                window.location.reload();
            }
        });
    });
    </script>
</body>

</html>