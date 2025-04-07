<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/test.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Admin - Edit District</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        .container {
            margin-left: 20%;
            padding: 20px;
            width: 80%;
        }
        
        .district-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .back-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #002D40;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        
        .admin-sections {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .admin-section {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }
        
        .form-group textarea {
            min-height: 150px;
        }
        
        .submit-btn {
            background-color: #002D40;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .gallery-item {
            position: relative;
            height: 150px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .delete-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .attractions-list {
            margin-top: 20px;
        }
        
        .attraction-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .attraction-image {
            width: 80px;
            height: 80px;
            border-radius: 5px;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .attraction-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .attraction-details {
            flex-grow: 1;
        }
        
        .attraction-actions {
            display: flex;
            gap: 10px;
        }
        
        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        
        .flash-message {
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .flash-error {
            background-color: #ffe6e6;
            border: 1px solid #ff8080;
            color: #ff0000;
        }
        
        .flash-success {
            background-color: #e6ffe6;
            border: 1px solid #80ff80;
            color: #008000;
        }
        
        .section-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        
        .section-tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }
        
        .section-tab.active {
            border-bottom: 3px solid #002D40;
            font-weight: bold;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    
    <?php include_once APPROOT . '/views/inc/adminNavBar.php'; ?>

    <div class="container">
        <div class="district-header">
            <h1>Edit District: <?= htmlspecialchars($data['district']->district_name) ?></h1>
            <a href="<?= ROOT ?>/admin/TestController" class="back-button">
                <i class="fa-solid fa-arrow-left"></i> Back to Districts
            </a>
        </div>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="flash-message flash-error">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['errors']) && is_array($_SESSION['errors'])): ?>
            <div class="flash-message flash-error">
                <ul>
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; unset($_SESSION['errors']); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="flash-message flash-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <div class="section-tabs">
            <div class="section-tab active" data-tab="district-info">District Information</div>
            <div class="section-tab" data-tab="gallery">Gallery Images</div>
            <div class="section-tab" data-tab="attractions">Attractions</div>
            <div class="section-tab" data-tab="hotels">Hotels</div>
            <div class="section-tab" data-tab="restaurants">Restaurants</div>
        </div>
        
        <div class="admin-sections">
            <!-- District Information Tab -->
            <div id="district-info" class="tab-content active">
                <div class="admin-section">
                    <div class="section-header">
                        <h2>District Information</h2>
                    </div>
                    
                    <form action="<?= ROOT ?>/admin/TestController/update/<?= $data['district']->district_id ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="district_name">District Name</label>
                            <input type="text" id="district_name" name="district_name" value="<?= htmlspecialchars($data['district']->district_name) ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="about_the_district">About the District</label>
                            <textarea id="about_the_district" name="about_the_district" required><?= htmlspecialchars($data['district']->about_the_district) ?></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="coverPic">Cover Image</label>
                            <?php if(isset($data['district']->coverPic) && !empty($data['district']->coverPic)): ?>
                                <div>
                                    <img src="<?= ROOT . '/' . $data['district']->coverPic ?>" alt="Cover Image" style="max-width: 300px; margin-bottom: 10px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" id="coverPic" name="coverPic" accept="image/*">
                            <small>Leave empty to keep current image</small>
                        </div>
                        
                        <button type="submit" class="submit-btn">Update District Information</button>
                    </form>
                </div>
            </div>
            
            <!-- Gallery Images Tab -->
            <div id="gallery" class="tab-content">
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Gallery Images</h2>
                    </div>
                    
                    <form action="<?= ROOT ?>/admin/TestController/addGalleryImage/<?= $data['district']->district_id ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="gallery_image">Add New Gallery Image</label>
                            <input type="file" id="gallery_image" name="gallery_image" accept="image/*" required>
                        </div>
                        
                        <button type="submit" class="submit-btn">Add Image</button>
                    </form>
                    
                    <div class="gallery-grid">
                        <?php foreach($data['gallery_pics'] as $pic): ?>
                            <div class="gallery-item">
                                <img src="<?= ROOT . '/' . $pic->image_location ?>" alt="Gallery Image">
                                <form action="<?= ROOT ?>/admin/TestController/deleteGalleryImage/<?= $pic->id ?>/<?= $data['district']->district_id ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                    <button type="submit" class="delete-image">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Attractions Tab -->
            <div id="attractions" class="tab-content">
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Attractions</h2>
                    </div>
                    
                    <form action="<?= ROOT ?>/admin/TestController/addAttraction/<?= $data['district']->district_id ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="attraction_name">Attraction Name</label>
                            <input type="text" id="attraction_name" name="attraction_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="attraction_image">Attraction Image</label>
                            <input type="file" id="attraction_image" name="attraction_image" accept="image/*" required>
                        </div>
                        
                        <button type="submit" class="submit-btn">Add Attraction</button>
                    </form>
                    
                    <div class="attractions-list">
                        <h3>Current Attractions</h3>
                        <p>The first 3 attractions will be displayed on the district page.</p>
                        
                        <?php foreach($data['attractions'] as $index => $attraction): ?>
                            <div class="attraction-item">
                                <div class="attraction-image">
                                    <img src="<?= ROOT . '/' . $attraction->image_path ?>" alt="<?= htmlspecialchars($attraction->attraction_name) ?>">
                                </div>
                                <div class="attraction-details">
                                    <h4><?= htmlspecialchars($attraction->attraction_name) ?></h4>
                                    <p><?= $index < 3 ? '<strong>[Featured]</strong>' : '' ?></p>
                                </div>
                                <div class="attraction-actions">
                                    <a href="<?= ROOT ?>/admin/TestController/editAttraction/<?= $attraction->id ?>" class="edit-btn">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <form action="<?= ROOT ?>/admin/TestController/deleteAttraction/<?= $attraction->id ?>/<?= $data['district']->district_id ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this attraction?');">
                                        <button type="submit" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Hotels Tab -->
            <div id="hotels" class="tab-content">
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Hotels</h2>
                    </div>
                    
                    <p>Manage hotels in this district.</p>
                    <a href="<?= ROOT ?>/admin/TestController/manageHotels/<?= $data['district']->district_id ?>" class="submit-btn" style="display: inline-block; margin-top: 10px; text-decoration: none;">
                        Manage Hotels
                    </a>
                </div>
            </div>
            
            <!-- Restaurants Tab -->
            <div id="restaurants" class="tab-content">
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Restaurants</h2>
                    </div>
                    
                    <p>Manage restaurants in this district.</p>
                    <a href="<?= ROOT ?>/admin/TestController/manageRestaurants/<?= $data['district']->district_id ?>" class="submit-btn" style="display: inline-block; margin-top: 10px; text-decoration: none;">
                        Manage Restaurants
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Tab functionality
        const tabs = document.querySelectorAll('.section-tab');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const tabId = tab.getAttribute('data-tab');
                
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
</body>
</html>