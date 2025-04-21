<?php

    $districts = $data['districts'];
    $attraction = $data['attraction'];
    $thingsToDo = $data['thingsToDo'];
    $attractionPics = $data['attractionPics'];
    $attractionDistrict = $attraction->district_id;
    // show($thingsToDo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/editAttraction.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <title>ExploreLK</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Edit Attraction: <?= $attraction->attraction_name; ?></h1>

            <form id="edit-attraction-form" action="<?= ROOT ?>/admin/C_editAttraction/update" method="POST"
                enctype="multipart/form-data">
                <!-- Hidden input for attraction ID -->
                <input type="hidden" name="attraction_id" value="<?= $attraction->attraction_id ?>">

                <!-- Attraction Basic Details -->
                <div class="edit-attraction-card">
                    <h2>Basic Information</h2>
                    <div class="attraction-details">
                        <div class="form-group">
                            <label for="attraction-name">Attraction Name</label>
                            <input type="text" id="attraction-name" name="attraction_name"
                                value="<?= $attraction->attraction_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <select id="district" name="district_id">
                                <?php foreach ($districts as $district): ?>
                                <option value="<?= $district->district_id ?>"
                                    <?= ($attractionDistrict == $district->district_id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($district->district_name) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paragraph1">Description (Paragraph 1)</label>
                            <textarea id="paragraph1"
                                name="description_paragraph1"><?= $attraction->description_paragraph1; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="paragraph2">Description (Paragraph 2)</label>
                            <textarea id="paragraph2"
                                name="description_paragraph2"><?= $attraction->description_paragraph2; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="paragraph3">Description (Paragraph 3)</label>
                            <textarea id="paragraph3"
                                name="description_paragraph3"><?= $attraction->description_paragraph3; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="iframe">Google Maps Embed Code</label>
                            <textarea id="iframe" name="iframe"><?= $attraction->iframe; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Attraction Images -->
                <div class="edit-attraction-card">
                    <h2>Attraction Images</h2>
                    <div class="image-gallery">
                        <?php foreach ($attractionPics as $index => $attractionPic): ?>
                        <div class="image-item">
                            <img src="<?php echo ROOT . '/' . $attractionPic->image_location; ?>"
                                alt="Attraction Image">
                            <input type="hidden" name="attraction_pic_id[]"
                                value="<?= $attractionPic->attraction_pic_id ?>">
                            <div class="image-actions">
                                <button type="button" class="edit-image-btn" title="Edit"
                                    data-image-id="<?= $attractionPic->attraction_pic_id ?>"><i
                                        class="fas fa-edit"></i></button>
                                <button type="button" class="delete-image-btn" title="Delete"
                                    data-image-id="<?= $attractionPic->attraction_pic_id ?>"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="add-image" id="add-image-btn">
                            <i class="fas fa-plus"></i> Add Image
                        </div>
                    </div>
                </div>

                <!-- Things to Do -->
                <div class="edit-attraction-card">
                    <h2>Things to Do</h2>
                    <div class="things-todo">
                        <?php foreach ($thingsToDo as $index => $todo): ?>
                        <div class="todo-item">
                            <input type="hidden" name="todo_id[]" value="<?= $todo->todo_id ?>">
                            <div class="todo-actions">
                                <button type="button" class="edit-todo-btn" title="Edit"
                                    data-todo-id="<?= $todo->todo_id ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="delete-todo-btn" title="Delete"
                                    data-todo-id="<?= $todo->todo_id ?>"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="todo-header">
                                <div class="todo-icon">
                                    <i class="<?= $todo->icon_class; ?>"></i>
                                </div>
                                <div class="todo-title"><?= $todo->activity_name; ?></div>
                            </div>
                            <div class="todo-description">
                                <?= $todo->activity_description; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <div class="add-todo" id="add-todo-btn">
                            <i class="fas fa-plus"></i> Add New Activity
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn-cancel">Cancel</button>
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Image Modal -->
    <div class="modal" id="image-modal">
        <div class="modal-content">
            <button class="close-modal" id="close-image-modal"><i class="fas fa-times"></i></button>
            <div class="modal-header">
                <h3>Add New Image</h3>
            </div>
            <form id="image-upload-form" enctype="multipart/form-data">
                <input type="hidden" id="edit-image-id" name="edit_image_id" value="">
                <div class="form-group">
                    <label for="image-upload">Select Image</label>
                    <input type="file" id="image-upload" name="image_upload" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="cancel-image">Cancel</button>
                    <button type="button" class="btn-save" id="save-image">Save Image</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Activity Modal -->
    <div class="modal" id="todo-modal">
        <div class="modal-content">
            <button class="close-modal" id="close-todo-modal"><i class="fas fa-times"></i></button>
            <div class="modal-header">
                <h3 id="todo-modal-title">Add New Activity</h3>
            </div>
            <form id="activity-form">
                <input type="hidden" id="edit-todo-id" name="edit_todo_id" value="">
                <div class="form-group">
                    <label for="activity-name">Activity Name</label>
                    <input type="text" id="activity-name" name="activity_name" placeholder="e.g., Horseback Riding">
                </div>
                <div class="form-group">
                    <label for="activity-icon">Icon Class</label>
                    <input type="text" id="activity-icon" name="icon_class" placeholder="e.g., fas fa-horse">
                </div>
                <div class="form-group">
                    <label for="activity-description">Description</label>
                    <textarea id="activity-description" name="activity_description"
                        placeholder="Describe the activity..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="cancel-todo">Cancel</button>
                    <button type="button" class="btn-save" id="save-todo">Save Activity</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Initialize variables to track new images and activities
    let newImages = [];
    let newActivities = [];
    let deletedImageIds = [];
    let deletedActivityIds = [];

    // Image Modal Functionality
    const addImageBtn = document.getElementById('add-image-btn');
    const imageModal = document.getElementById('image-modal');
    const closeImageModal = document.getElementById('close-image-modal');
    const cancelImage = document.getElementById('cancel-image');
    const saveImage = document.getElementById('save-image');
    const imageForm = document.getElementById('image-upload-form');

    addImageBtn.addEventListener('click', () => {
        // Reset form for new image
        document.getElementById('edit-image-id').value = '';
        imageForm.reset();
        document.querySelector('#image-modal .modal-header h3').textContent = 'Add New Image';
        imageModal.style.display = 'flex';
    });

    closeImageModal.addEventListener('click', () => {
        imageModal.style.display = 'none';
    });

    cancelImage.addEventListener('click', () => {
        imageModal.style.display = 'none';
    });

    saveImage.addEventListener('click', () => {
        const imageFile = document.getElementById('image-upload').files[0];

        if (!imageFile) {
            alert('Please select an image to upload.');
            return;
        }

        // Create a proper file input for the main form
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.name = 'image_upload[]'; // Match the PHP expected name
        fileInput.style.display = 'none';

        // Create a new FileList containing our file
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(imageFile);
        fileInput.files = dataTransfer.files;

        // Add to main form
        document.getElementById('edit-attraction-form').appendChild(fileInput);

        // Add a temporary image entry to the gallery
        const imageGallery = document.querySelector('.image-gallery');
        const newImageElement = document.createElement('div');
        newImageElement.className = 'image-item temp-image';
        newImageElement.innerHTML = `
        <img src="${URL.createObjectURL(imageFile)}" alt="New image">
        <div class="image-actions">
            <button type="button" title="Delete" class="delete-temp-image"><i class="fas fa-trash"></i></button>
        </div>
    `;

        // Insert new image before the add button
        imageGallery.insertBefore(newImageElement, addImageBtn);

        alert('Image added successfully! It will be uploaded when you save changes.');
        imageModal.style.display = 'none';
    });

    // Todo Modal Functionality
    const addTodoBtn = document.getElementById('add-todo-btn');
    const todoModal = document.getElementById('todo-modal');
    const closeTodoModal = document.getElementById('close-todo-modal');
    const cancelTodo = document.getElementById('cancel-todo');
    const saveTodo = document.getElementById('save-todo');
    const activityForm = document.getElementById('activity-form');

    addTodoBtn.addEventListener('click', () => {
        // Reset form for new activity
        document.getElementById('edit-todo-id').value = '';
        activityForm.reset();
        document.getElementById('todo-modal-title').textContent = 'Add New Activity';
        todoModal.style.display = 'flex';
    });

    closeTodoModal.addEventListener('click', () => {
        todoModal.style.display = 'none';
    });

    cancelTodo.addEventListener('click', () => {
        todoModal.style.display = 'none';
    });

    saveTodo.addEventListener('click', () => {
        // Get form data
        const activityName = document.getElementById('activity-name').value;
        const iconClass = document.getElementById('activity-icon').value;
        const activityDescription = document.getElementById('activity-description').value;
        const editTodoId = document.getElementById('edit-todo-id').value;

        if (!activityName) {
            alert('Please enter an activity name.');
            return;
        }

        if (editTodoId) {
            // Handle edit activity logic
            alert('Activity updated successfully!');
        } else {
            // Handle new activity
            // For now, just track that we're adding a new activity
            const newActivityIndex = newActivities.length;
            newActivities.push({
                name: activityName,
                icon: iconClass,
                description: activityDescription
            });

            // Add a temporary activity entry to the list
            const todoList = document.querySelector('.things-todo');
            const newActivityElement = document.createElement('div');
            newActivityElement.className = 'todo-item temp-todo';
            newActivityElement.innerHTML = `
                <input type="hidden" name="new_activities[]" value="${newActivityIndex}">
                <div class="todo-actions">
                    <button type="button" title="Edit"><i class="fas fa-edit"></i></button>
                    <button type="button" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
                <div class="todo-header">
                    <div class="todo-icon">
                        <i class="${iconClass}"></i>
                    </div>
                    <div class="todo-title">${activityName}</div>
                </div>
                <div class="todo-description">
                    ${activityDescription}
                </div>
            `;

            // Insert new activity before the add button
            todoList.insertBefore(newActivityElement, addTodoBtn);

            alert('Activity added successfully! It will be saved when you save changes.');
        }

        todoModal.style.display = 'none';
    });

    // Edit and delete buttons functionality for images
    document.addEventListener('click', function(e) {
        // Handle edit image buttons
        if (e.target.closest('.edit-image-btn')) {
            const button = e.target.closest('.edit-image-btn');
            const imageId = button.getAttribute('data-image-id');

            // Set modal to edit mode
            document.getElementById('edit-image-id').value = imageId;
            document.querySelector('#image-modal .modal-header h3').textContent = 'Edit Image';

            // In a real implementation, you would pre-fill the form with existing data

            imageModal.style.display = 'flex';
        }

        // Handle delete image buttons
        if (e.target.closest('.delete-image-btn')) {
            const button = e.target.closest('.delete-image-btn');
            const imageId = button.getAttribute('data-image-id');
            const imageItem = button.closest('.image-item');

            if (confirm('Are you sure you want to delete this image?')) {
                // Add to deleted images list
                if (imageId) {
                    deletedImageIds.push(imageId);

                    // Add a hidden input to track deleted image
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'deleted_image_ids[]';
                    hiddenInput.value = imageId;
                    document.getElementById('edit-attraction-form').appendChild(hiddenInput);
                }

                // Remove from DOM
                imageItem.remove();
                alert('Image marked for deletion. Changes will apply when you save.');
            }
        }

        // Handle edit todo buttons
        if (e.target.closest('.edit-todo-btn')) {
            const button = e.target.closest('.edit-todo-btn');
            const todoId = button.getAttribute('data-todo-id');
            const todoItem = button.closest('.todo-item');

            // Set modal to edit mode
            document.getElementById('edit-todo-id').value = todoId;
            document.getElementById('todo-modal-title').textContent = 'Edit Activity';

            // Pre-fill the form with existing data
            document.getElementById('activity-name').value = todoItem.querySelector('.todo-title').textContent
                .trim();
            document.getElementById('activity-icon').value = todoItem.querySelector('.todo-icon i').className;
            document.getElementById('activity-description').value = todoItem.querySelector('.todo-description')
                .textContent.trim();

            todoModal.style.display = 'flex';
        }

        // Handle delete todo buttons
        if (e.target.closest('.delete-todo-btn')) {
            const button = e.target.closest('.delete-todo-btn');
            const todoId = button.getAttribute('data-todo-id');
            const todoItem = button.closest('.todo-item');

            if (confirm('Are you sure you want to delete this activity?')) {
                // Add to deleted activities list
                if (todoId) {
                    deletedActivityIds.push(todoId);

                    // Add a hidden input to track deleted activity
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'deleted_activity_ids[]';
                    hiddenInput.value = todoId;
                    document.getElementById('edit-attraction-form').appendChild(hiddenInput);
                }

                // Remove from DOM
                todoItem.remove();
                alert('Activity marked for deletion. Changes will apply when you save.');
            }
        }
    });

    // Close modals when clicking outside the modal content
    window.addEventListener('click', (event) => {
        if (event.target === imageModal) {
            imageModal.style.display = 'none';
        }
        if (event.target === todoModal) {
            todoModal.style.display = 'none';
        }
    });

    // Form submission handling
    document.getElementById('edit-attraction-form').addEventListener('submit', function(e) {
        // In a real implementation, you would handle file uploads and form submission
        // For now, just simulate the submission

        // Add new images data
        newImages.forEach((image, index) => {
            // In a real implementation, you would handle file uploads
            // For now, just ensure the hidden fields exist
            const imageExists = this.querySelector(`input[name="new_images[]"][value="${index}"]`);
            if (!imageExists) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'new_images[]';
                hiddenInput.value = index;
                this.appendChild(hiddenInput);
            }
        });

        // Add new activities data
        newActivities.forEach((activity, index) => {
            const hiddenName = document.createElement('input');
            hiddenName.type = 'hidden';
            hiddenName.name = `new_activity_name[${index}]`;
            hiddenName.value = activity.name;

            const hiddenIcon = document.createElement('input');
            hiddenIcon.type = 'hidden';
            hiddenIcon.name = `new_activity_icon[${index}]`;
            hiddenIcon.value = activity.icon;

            const hiddenDesc = document.createElement('input');
            hiddenDesc.type = 'hidden';
            hiddenDesc.name = `new_activity_desc[${index}]`;
            hiddenDesc.value = activity.description;

            this.appendChild(hiddenName);
            this.appendChild(hiddenIcon);
            this.appendChild(hiddenDesc);
        });
    });

    // Cancel button functionality
    document.querySelector('.btn-cancel').addEventListener('click', function() {
        if (confirm('Are you sure you want to discard all changes?')) {
            // Redirect to attractions list or reload the page
            window.location.href = '<?= ROOT ?>/admin/attractions';
        }
    });
    </script>
</body>

</html>