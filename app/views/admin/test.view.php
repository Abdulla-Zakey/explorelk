<?php
// Assuming $data contains the passed information
$attractions = $data['attractions'] ?? [];
$districts = $data['districts'] ?? [];
$topDistricts = $data['top_districts'] ?? [];
$selectedDistrict = $data['selected_district'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/test.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <title>ExploreLK | Manage Attractions</title>
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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .district-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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

        .edit-btn,
        .delete-btn {
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

        .toggle-buttons {
            display: flex;
            margin-bottom: 20px;
        }

        .toggle-btn {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            background-color: #ccc;
            font-weight: bold;
            margin: 0 10px;
            border-radius: 5px;
        }

        .toggle-btn.active {
            background-color: #007bff;
            color: white;
        }

        .content-section {
            display: none;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>

        <div class="main-content">
            <h1>Manage Attractions</h1>

            <!-- Toggle Buttons -->
            <div class="toggle-buttons">
                <button id="attractions-btn" class="toggle-btn"
                    onclick="showSection('attractions')">Attractions</button>
                <button id="top-districts-btn" class="toggle-btn active" onclick="showSection('top-districts')">Top
                    Districts</button>
            </div>

            <!-- Top Districts Section -->
            <div id="top-districts-section" class="content-section">
                <!-- <?php if (empty($topDistricts)): ?>
                    <div class="no-data">
                        <p>No top districts found.</p>
                    </div>
                <?php else: ?>
                    <div class="districts-list">
                        <?php foreach ($topDistricts as $district): ?>
                            <div class="district-card">
                                <h3><?= htmlspecialchars($district->district_name) ?></h3>
                                <p><?= htmlspecialchars($district->description) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?> -->

                <div class="districts-grid">

                    <?php foreach ($data['districts'] as $district): ?>
                        <div class="district-card"
                            data-district-name="<?= htmlspecialchars(strtolower($district->district_name)) ?>">
                            <div class="district-image">
                                <?php if (isset($district->coverPic) && !empty($district->coverPic)): ?>
                                    <img src="<?= ROOT . '/' . $district->coverPic ?>"
                                        alt="<?= htmlspecialchars($district->district_name) ?>">
                                <?php else: ?>
                                    <img src="<?= ROOT ?>/assets/images/default-district.jpg" alt="Default District Image">
                                <?php endif; ?>
                            </div>
                            <div class="district-details">
                                <h3 class="district-name"><?= htmlspecialchars($district->district_name) ?></h3>
                                <p class="district-description">
                                    <?= htmlspecialchars(substr($district->about_the_district, 0, 120)) ?>...</p>
                                <div class="district-actions">
                                    <a href="<?= ROOT ?>/admin/TestController/edit/<?= $district->district_id ?>"
                                        class="edit-btn">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= ROOT ?>/traveler/particularDistrict/index/<?= $district->district_id ?>"
                                        target="_blank" class="edit-btn" style="background-color: #2196F3;">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>


            </div>

            <!-- Attractions Section -->
            <div id="attractions-section" class="content-section">
                <div class="action-panel">
                    <div class="filter-container">
                        <label for="district-filter">Filter by District:</label>
                        <select id="district-filter" name="district_id" onchange="filterByDistrict(this.value)">
                            <option value="">All Districts</option>
                            <?php foreach ($districts as $district): ?>
                                <option value="<?= $district->id ?>" <?= ($selectedDistrict == $district->id) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($district->district_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="add-attraction-btn" onclick="location.href='<?= ROOT ?>/admin/attractions/add'">
                        <i class="fa-solid fa-plus"></i> Add New Attraction
                    </button>
                </div>

                <div class="attractions-list">
                    <?php if (empty($attractions)): ?>
                        <div class="no-attractions">
                            <p>No attractions found. <?= $selectedDistrict ? 'Try selecting a different district or' : '' ?>
                                add a new attraction to get started.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($attractions as $attraction): ?>
                            <div class="attraction-card">
                                <div class="attraction-header">
                                    <h3><?= htmlspecialchars($attraction->attraction_name) ?></h3>
                                    <span
                                        class="district-tag"><?= htmlspecialchars($attraction->district_name ?? 'Unknown District') ?></span>
                                </div>

                                <div class="attraction-preview">
                                    <?php
                                    $previewImage = !empty($attraction->preview_image) ? ROOT . '/' . $attraction->preview_image : ROOT . '/assets/images/placeholders/attraction-placeholder.jpg';
                                    ?>
                                    <img src="<?= $previewImage ?>" alt="<?= htmlspecialchars($attraction->attraction_name) ?>"
                                        class="preview-image">

                                    <div class="attraction-details">
                                        <p class="description-preview">
                                            <?= substr(htmlspecialchars($attraction->description_paragraph1), 0, 150) . '...' ?>
                                        </p>

                                        <div class="attraction-stats">
                                            <span><i class="fa-solid fa-image"></i> <?= $attraction->image_count ?? 0 ?>
                                                Images</span>
                                            <span><i class="fa-solid fa-list-check"></i> <?= $attraction->todo_count ?? 0 ?>
                                                Activities</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="attraction-actions">
                                    <a href="<?= ROOT ?>/admin/attractions/view/<?= $attraction->id ?>"
                                        class="action-btn view-btn">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    <a href="<?= ROOT ?>/admin/attractions/edit/<?= $attraction->id ?>"
                                        class="action-btn edit-btn">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <button class="action-btn delete-btn"
                                        onclick="confirmDelete(<?= $attraction->id ?>, '<?= htmlspecialchars($attraction->attraction_name) ?>')">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(section) {
            const topDistrictsBtn = document.getElementById("top-districts-btn");
            const attractionsBtn = document.getElementById("attractions-btn");
            const topDistrictsSection = document.getElementById("top-districts-section");
            const attractionsSection = document.getElementById("attractions-section");

            if (section === "top-districts") {
                topDistrictsSection.style.display = "block";
                attractionsSection.style.display = "none";
                topDistrictsBtn.classList.add("active");
                attractionsBtn.classList.remove("active");
            } else {
                attractionsSection.style.display = "block";
                topDistrictsSection.style.display = "none";
                attractionsBtn.classList.add("active");
                topDistrictsBtn.classList.remove("active");
            }
        }

        function filterByDistrict(districtId) {
            window.location.href = '<?= ROOT ?>/admin/attractions' + (districtId ? '/district/' + districtId : '');
        }

        function confirmDelete(attractionId, attractionName) {
            if (confirm(`Are you sure you want to delete "${attractionName}"? This action cannot be undone.`)) {
                window.location.href = '<?= ROOT ?>/admin/attractions/delete/' + attractionId;
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            showSection("attractions");
        });
    </script>
</body>

</html>