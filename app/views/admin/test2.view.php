<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Admin - Districts</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            margin-left: 20%;
        }
        
        .district-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .add-district-btn {
            padding: 10px 15px;
            background-color: #002D40;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        
        .districts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 20px;
        }
        
        .district-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .district-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        .district-image {
            height: 180px;
            overflow: hidden;
        }
        
        .district-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .district-details {
            padding: 15px;
        }
        
        .district-name {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 10px 0;
        }
        
        .district-description {
            font-size: 14px;
            color: #555;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 15px;
        }
        
        .district-actions {
            display: flex;
            gap: 10px;
        }
        
        .edit-btn, .delete-btn {
            flex: 1;
            padding: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
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
        
        .search-box {
            width: 100%;
            max-width: 400px;
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <?php include_once APPROOT . '/views/inc/adminNavBar.php'; ?>

    <div class="container">
        <div class="district-header">
            <h1>Manage Districts</h1>
            <a href="<?= ROOT ?>/admin/TestController/create" class="add-district-btn">
                <i class="fa-solid fa-plus"></i> Add New District
            </a>
        </div>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="flash-message flash-error">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="flash-message flash-success">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <input type="text" class="search-box" id="districtSearch" placeholder="Search districts...">
        
        <div class="districts-grid">
            <?php foreach($data['districts'] as $district): ?>
                <div class="district-card" data-district-name="<?= htmlspecialchars(strtolower($district->district_name)) ?>">
                    <div class="district-image">
                        <?php if(isset($district->coverPic) && !empty($district->coverPic)): ?>
                            <img src="<?= ROOT . '/' . $district->coverPic ?>" alt="<?= htmlspecialchars($district->district_name) ?>">
                        <?php else: ?>
                            <img src="<?= ROOT ?>/assets/images/default-district.jpg" alt="Default District Image">
                        <?php endif; ?>
                    </div>
                    <div class="district-details">
                        <h3 class="district-name"><?= htmlspecialchars($district->district_name) ?></h3>
                        <p class="district-description"><?= htmlspecialchars(substr($district->about_the_district, 0, 120)) ?>...</p>
                        <div class="district-actions">
                            <a href="<?= ROOT ?>/admin/TestController/edit/<?= $district->district_id ?>" class="edit-btn">
                                <i class="fa-solid fa-edit"></i> Edit
                            </a>
                            <a href="<?= ROOT ?>/traveler/particularDistrict/index/<?= $district->district_id ?>" target="_blank" class="edit-btn" style="background-color: #2196F3;">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if(count($data['districts']) == 0): ?>
            <div style="text-align: center; padding: 30px;">
                <p>No districts found. Add a new district to get started.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        // Search functionality
        const searchBox = document.getElementById('districtSearch');
        const districtCards = document.querySelectorAll('.district-card');
        
        searchBox.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            
            districtCards.forEach(card => {
                const districtName = card.getAttribute('data-district-name');
                
                if(districtName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>