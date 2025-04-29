<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/newRegistrations.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/profile.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>

        <div class="main-content">
            <h1>User Profile</h1>

            <div class="profile-card">
                <div class="profile-container">
                    <div class="profile-header">
                        <div class="profile-picture">
                            <img src="<?= ROOT ?>/assets/images/admin/adminProfilePhotos/<?= $data['profile_picture'] ?? 'profile.png' ?>" alt="Profile Picture">
                        </div>
                        <div class="profile-basic-info">
                            <h2 class="profile-name"><?= $data['firstName'] . ' ' . $data['lastName']; ?></h2>
                            <p class="profile-role">Administrator</p>
                            <span class="profile-id"><i class="fas fa-id-badge">&nbsp;</i>Admin ID: &nbsp; <?= $data['admin_id']; ?></span>
                        </div>
                    </div>

                    <div class="info-sections">
                        <div class="info-section">
                            <h3 class="section-title">
                                <i class="fas fa-user"></i> Personal Information
                            </h3>
                            <div class="info-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-venus-mars"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Gender</div>
                                        <div class="detail-value"><?= $data['gender']; ?></div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-birthday-cake"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Date of Birth</div>
                                        <div class="detail-value"><?= $data['dob']; ?></div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">NIC</div>
                                        <div class="detail-value"><?= $data['nic']; ?></div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">City</div>
                                        <div class="detail-value"><?= $data['city']; ?></div>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label" style="width: fit-content;">Work Experience (In Years)</div>
                                        <div class="detail-value"><?= $data['work_experience']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-section">
                            <h3 class="section-title">
                                <i class="fas fa-address-book"></i> Contact Information
                            </h3>
                            <div class="info-details">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Email Address</div>
                                        <div class="detail-value"><?= $data['email']; ?></div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Phone Number</div>
                                        <div class="detail-value"><?= $data['phoneNo']; ?></div>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-content">
                                        <div class="detail-label">Address</div>
                                        <div class="detail-value"><?= $data['address']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-footer">
                        <button class="edit-btn" onclick="window.location.href='<?= ROOT ?>/admin/C_editProfile';">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>