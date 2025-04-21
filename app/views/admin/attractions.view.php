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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/attractions.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <title>ExploreLK</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>
<?php //show($data); ?>

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
                <div class="attractions-list">
                    <?php foreach ($districts as $district): ?>
                    <div class="attraction-card"
                        data-district-name="<?= htmlspecialchars(strtolower($district->district_name)) ?>">
                        <div class="attraction-header">
                            <h3><?= htmlspecialchars($district->district_name) ?></h3>
                        </div>
                        <div class="attraction-preview">
                            <?php if (isset($district->coverPic)): ?>
                            <img src="<?= ROOT . '/' . $district->coverPic ?>"
                                alt="<?= htmlspecialchars($district->district_name) ?>" class="preview-image">
                            <?php else: ?>
                            <img src="<?= ROOT ?>/assets/images/default-district.jpg" alt="Default District Image"
                                class="preview-image">
                            <?php endif; ?>
                            <div class="attraction-details">
                                <p class="description-preview">
                                    <?= htmlspecialchars(substr($district->about_the_district, 0, 150)) ?>...
                                </p>
                                <div class="attraction-stats">
                                    <span><i class="fa-solid fa-location-dot"></i> District</span>
                                    <span><i class="fa-solid fa-mountain-sun"></i> Top Location</span>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-actions">
                            <a href="#" class="action-btn view-btn">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <a href="#" class="action-btn edit-btn">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <button class="action-btn delete-btn" onclick="confirmDelete(1, 'Sunset Beach')">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
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
                            <option value="<?= $district->district_id ?>"
                                <?= ($selectedDistrict == $district->district_id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($district->district_name) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="add-attraction-btn" onclick="location.href='#'">
                        <i class="fa-solid fa-plus"></i> Add New Attraction
                    </button>
                </div>

                <?php
                $districtMap = [];
                foreach ($districts as $district) {
                    $districtMap[$district->district_id] = $district->district_name;
                }
                ?>

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
                            <span class="district-tag">
                                <?= isset($districtMap[$attraction->district_id]) ? htmlspecialchars($districtMap[$attraction->district_id]) : "Unknown District" ?></span>
                        </div>
                        <div class="attraction-preview">
                            <?php $previewImage = !empty($attraction->image_path) ? ROOT . '/' . $attraction->image_path : ROOT . '/assets/images/default-attraction.jpg'; ?>
                            <img src="<?= $previewImage ?>" alt="<?= htmlspecialchars($attraction->attraction_name) ?>"
                                class="preview-image">
                            <div class="attraction-details">
                                <p class="description-preview">
                                    <?= substr(htmlspecialchars($attraction->description_paragraph1), 0, 150) . '...' ?>
                                </p>
                                <div class="attraction-stats">
                                    <span><i class="fa-solid fa-image"></i><?= $attraction->image_count ?? 0 ?>
                                        Images</span>
                                    <span><i class="fa-solid fa-list-check"></i> <?= $attraction->todo_count ?? 0 ?>
                                        Activities</span>
                                </div>
                            </div>
                        </div>
                        <div class="attraction-actions">
                            <a href="#" class="action-btn view-btn"
                                onclick="viewAttraction(<?= $attraction->district_id ?>, '<?= htmlspecialchars($attraction->attraction_name) ?>')">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <a href="#" class="action-btn edit-btn"
                                onclick="editAttraction(<?= $attraction->district_id ?>, '<?= htmlspecialchars($attraction->attraction_name) ?>')">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <button class="action-btn delete-btn" onclick="confirmDelete(1, 'Sunset Beach')">
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
        // console.log("Filtering by district:", districtId);
        if (districtId) {
            window.location.href = '<?= ROOT ?>/admin/C_attractions/districtFilter/' + districtId;
        } else {
            window.location.href = '<?= ROOT ?>/admin/C_attractions'
        }
    }

    function confirmDelete(attraction_id, attraction_name) {
        if (confirm(`Are you sure you want to delete "${attractio_name}"? This action cannot be undone.`)) {
            window.location.href = '<?= ROOT ?>/admin/attractions/delete/' + attraction_id;
        }
    }

    function editAttraction(district_id, attraction_name) {
        window.location.href = '<?= ROOT ?>/admin/C_attractions/editAttraction?district_id=' + district_id +
            '&attraction_name=' + encodeURIComponent(attraction_name);
    }

    function viewAttraction(district_id, attraction_name) {
        window.location.href = '<?= ROOT ?>/admin/C_attractions/viewAttraction?district_id=' + district_id +
            '&attraction_name=' + encodeURIComponent(attraction_name);
    }

    document.addEventListener("DOMContentLoaded", function() {
        showSection("attractions");
    });
    </script>
</body>

</html>