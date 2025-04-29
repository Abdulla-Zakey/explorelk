<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/admin.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Admin/newRegistrations.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoWhite.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <style>
    .profile-card {
        background: white;
        border-radius: 1em;
        box-shadow: 0 0.25em 0.375em rgba(0, 0, 0, 0.05);
        padding: 2em;
        margin-bottom: 2%;
    }

    .profile-container {
        display: flex;
        flex-direction: column;
        gap: 2em;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 1.5em;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 0.25em 0.5em rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
        position: relative;
    }

    .profile-picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-picture-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        text-align: center;
        padding: 5px 0;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-picture-overlay:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .profile-picture input[type="file"] {
        display: none;
    }

    .profile-basic-info {
        flex-grow: 1;
    }

    .profile-name {
        font-size: 1em;
        margin-bottom: 0.3em;
        color: #212529;
        font-weight: 600;
    }

    .profile-role {
        font-size: 0.7em;
        color: #6c757d;
        margin-bottom: 1em;
    }

    .profile-id {
        display: inline-block;
        background-color: rgba(67, 97, 238, 0.1);
        color: #4361ee;
        padding: 0.4em 0.8em;
        border-radius: 1.25em;
        font-size: 0.5em;
    }

    .info-sections {
        display: flex;
        gap: 2em;
        flex-wrap: wrap;
    }

    .info-section {
        flex: 1;
        min-width: 300px;
    }

    .section-title {
        font-size: 1em;
        color: #4361ee;
        margin-bottom: 1em;
        padding-bottom: 0.5em;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 0.5em;
    }

    .info-details {
        display: flex;
        flex-direction: column;
        gap: 1em;
    }

    .detail-item {
        display: flex;
        gap: 1em;
        align-items: flex-start;
        padding: 0.7em;
        border-radius: 0.5em;
        background-color: #f8f9fa;
        transition: all 0.2s ease;
    }

    .detail-item:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .detail-icon {
        width: 16px;
        color: #6c757d;
        text-align: center;
    }

    .detail-content {
        flex: 1;
    }

    .detail-label {
        color: #6c757d;
        font-size: 0.8em;
        margin-bottom: 0.3em;
    }

    .detail-input {
        width: 100%;
        padding: 0.5em;
        border: 1px solid #ced4da;
        border-radius: 0.3em;
        color: #212529;
        transition: border-color 0.3s ease;
    }

    .detail-input:focus {
        border-color: #4361ee;
        outline: none;
    }

    .detail-input:disabled {
        background-color: #e9ecef;
        cursor: not-allowed;
    }

    .detail-select {
        width: 100%;
        padding: 0.5em;
        border: 1px solid #ced4da;
        border-radius: 0.3em;
        color: #212529;
        appearance: none;
        background-repeat: no-repeat;
        background-position: right 0.75em center;
        background-size: 12px;
    }

    .error-message {
        color: #f72585;
        font-size: 0.75em;
        margin-top: 0.3em;
    }

    .profile-footer {
        margin-top: 1em;
        display: flex;
        justify-content: flex-end;
    }

    .back-link {
        color: #6c757d;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5em;
        margin-bottom: 1em;
        transition: color 0.3s ease;
    }

    .back-link:hover {
        color: #4361ee;
    }

    .save-btn {
        background-color: #4361ee;
        color: white;
        padding: 0.7em 1.5em;
        border-radius: 0.3em;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5em;
    }

    .save-btn:hover {
        background-color: #3a56d3;
    }

    @media (max-width: 768px) {
        .profile-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            margin-bottom: 1em;
        }

        .info-sections {
            flex-direction: column;
        }
    }
    </style>
</head>

<body>
    <div class="admin-container">
        <?php include_once APPROOT . "/views/inc/adminNavBar.php"; ?>

        <div class="main-content">
            <h1>Edit Profile</h1>
            <a href="<?= ROOT ?>/admin/C_profile" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Profile
            </a>

            <form action="<?= ROOT ?>/admin/C_editProfile/updateProfile" method="POST" enctype="multipart/form-data">
                <div class="profile-card">
                    <div class="profile-container">
                        <div class="profile-header">
                            <div class="profile-picture">
                                <img id="profile-image"
                                    src="<?= ROOT ?>/assets/images/admin/adminProfilePhotos/<?= $data['userData']->profile_picture ?>"
                                    alt="Profile Picture">
                                <label for="file-input" class="profile-picture-overlay">
                                    <i class="fas fa-camera"></i> Change Photo
                                </label>
                                <input type="file" id="file-input" name="profile-image" accept="image/*">
                            </div>
                            <div class="profile-basic-info">
                                <h2 class="profile-name">
                                    <?= $data['userData']->firstName . ' ' . $data['userData']->lastName ?></h2>
                                <p class="profile-role">Administrator</p>
                                <span class="profile-id"><i class="fas fa-id-badge">&nbsp;</i>Admin ID: &nbsp;
                                    <?= $data['userData']->admin_id ?></span>
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
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">First Name</div>
                                            <?php if(!empty($data['errors']['firstName'])): ?>
                                            <input type="text" class="detail-input" name="first-name" value="">
                                            <div class="error-message"><?= $data['errors']['firstName'] ?></div>
                                            <?php else: ?>
                                            <input type="text" class="detail-input" name="first-name"
                                                value="<?= $data['userData']->firstName ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Last Name</div>
                                            <?php if(!empty($data['errors']['lastName'])): ?>
                                            <input type="text" class="detail-input" name="last-name" value="">
                                            <div class="error-message"><?= $data['errors']['lastName'] ?></div>
                                            <?php else: ?>
                                            <input type="text" class="detail-input" name="last-name"
                                                value="<?= $data['userData']->lastName ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-id-badge"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Admin ID</div>
                                            <input type="text" class="detail-input"
                                                value="<?= $data['userData']->admin_id ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-venus-mars"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Gender</div>
                                            <select class="detail-select" name="gender">
                                                <option value="Male"
                                                    <?= $data['userData']->gender === 'male' ? 'selected' : '' ?>>Male
                                                </option>
                                                <option value="Female"
                                                    <?= $data['userData']->gender === 'female' ? 'selected' : '' ?>>
                                                    Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-birthday-cake"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Date of Birth</div>
                                            <?php if(!empty($data['errors']['dob'])): ?>
                                            <input type="date" class="detail-input" name="birth-date" value="">
                                            <div class="error-message"><?= $data['errors']['dob'] ?></div>
                                            <?php else: ?>
                                            <input type="date" class="detail-input" name="birth-date"
                                                value="<?= $data['userData']->dob ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">NIC</div>
                                            <?php if(!empty($data['errors']['nic'])): ?>
                                            <input type="number" class="detail-input" name="nic" value="">
                                            <div class="error-message"><?= $data['errors']['nic'] ?></div>
                                            <?php else: ?>
                                            <input type="number" class="detail-input" name="nic"
                                                value="<?= $data['userData']->nic ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-city"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">City</div>
                                            <?php if(!empty($data['errors']['city'])): ?>
                                            <input type="text" class="detail-input" name="city" value="">
                                            <div class="error-message"><?= $data['errors']['city'] ?></div>
                                            <?php else: ?>
                                            <input type="text" class="detail-input" name="city"
                                                value="<?= $data['userData']->city ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-passport"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label" style="width: fit-content;">Work Experience (In Years)</div>
                                            <?php if(!empty($data['errors']['work_experience'])): ?>
                                            <input type="number" class="detail-input" name="work_experience" value="">
                                            <div class="error-message"><?= $data['errors']['work_experience'] ?></div>
                                            <?php else: ?>
                                            <input type="number" class="detail-input" name="work_experience"
                                                value="<?= $data['userData']->work_experience; ?>">
                                            <?php endif; ?>
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
                                            <input type="email" class="detail-input"
                                                value="<?= $data['userData']->email ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Phone Number</div>
                                            <?php if(!empty($data['errors']['contact-no'])): ?>
                                            <input type="text" class="detail-input" name="contact-no" value="">
                                            <div class="error-message"><?= $data['errors']['contact-no'] ?></div>
                                            <?php else: ?>
                                            <input type="text" class="detail-input" name="contact-no"
                                                value="<?= $data['userData']->phoneNo ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Address</div>
                                            <?php if(!empty($data['errors']['address'])): ?>
                                            <input type="text" class="detail-input" name="address" value="">
                                            <div class="error-message"><?= $data['errors']['address'] ?></div>
                                            <?php else: ?>
                                            <input type="text" class="detail-input" name="address"
                                                value="<?= $data['userData']->address ?>">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">New Password</div>
                                            <?php if(!empty($data['errors']['password'])): ?>
                                            <input type="password" class="detail-input" name="password" value="">
                                            <div class="error-message"><?= $data['errors']['password'] ?></div>
                                            <?php else: ?>
                                            <input type="password" class="detail-input" name="password"
                                                placeholder="Leave blank if no change">
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="detail-item">
                                        <div class="detail-icon">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div class="detail-content">
                                            <div class="detail-label">Confirm New Password</div>
                                            <?php if(!empty($data['errors']['confirmPassword'])): ?>
                                            <input type="password" class="detail-input" name="confirmPassword" value="">
                                            <div class="error-message"><?= $data['errors']['confirmPassword'] ?></div>
                                            <?php else: ?>
                                            <input type="password" class="detail-input" name="confirmPassword"
                                                placeholder="Leave blank if no change">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="profile-footer">
                            <button type="submit" class="save-btn">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('file-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const profileImage = document.getElementById('profile-image');
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>