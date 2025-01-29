<html lang="en">

</html>

<head>
    <title>ExploreLK Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin/admin.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
</head>

<body>
    <div class="flexContainer">

        <?php include_once APPROOT.'\views\inc\adminNavBar.php'; ?>

        <div class="body-container">
            <?php include_once APPROOT.'\views\inc\profileLink.php'; ?>

            <div>
                <h1 class="heading">Profile</h1>
                <h3><a href="<?= ROOT ?>/admin/C_profile" class="back-button">&larr; Back</a></h3>
                <h2 class="sub-heading">Edit Profile</h2>
            </div>

            <?php if (!empty($data['errors'])): ?>
                <div class="error-container">
                    <?php foreach ($data['errors'] as $field => $error): ?>
                        <p class="error-message"><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="traveler-details">
                <form action="<?= ROOT ?>/admin/C_editProfile/updateProfile" method="POST" enctype="multipart/form-data">
                    <div class="details-container">
                        <div class="profile-picture edit-profile-picture">
                            <img id="profile-image"
                                src="<?= ROOT ?>/assets/images/admin/adminProfilePhotos/<?= $data['profile_picture'] ?? 'profile.png' ?>"
                                alt="Profile Picture">
                            <label class="edit-change-photo-btn" for="file-input">Change Profile Photo</label>
                            <input type="file" id="file-input" name="profile-image" accept="image/*">
                        </div>
                        <div class="profile-fields">
                            <div class="field-group">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first-name" name="first-name" value="<?= $data['firstName'] ?>">
                            </div>
                            <div class="field-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" name="last-name" value="<?= $data['lastName'] ?>">
                            </div>
                            <div class="field-group">
                                <label for="admin-id">Admin ID</label>
                                <input type="text" id="admin-id" value="<?= $data['admin_id']?>" disabled>
                            </div>
                            <div class="field-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender">
                                    <option value="Male" <?= $data['gender'] === 'male' ? 'selected' : '' ?>>Male
                                    </option>
                                    <option value="Female" <?= $data['gender'] === 'female' ? 'selected' : '' ?>>Female
                                    </option>
                                </select>
                            </div>
                            <div class="field-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="<?= $data['email']?>" disabled>
                            </div>
                            <div class="field-group">
                                <label for="birth-date">Birth Date</label>
                                <input type="date" id="birth-date" name="birth-date" value="<?= $data['dob']?>">
                            </div>
                            <div class="field-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" value="<?= $data['city']?>">
                            </div>
                            <div class="field-group">
                                <label for="contact-no">Contact No.</label>
                                <input type="text" id="contact-no" name="contact-no" value="<?= $data['phoneNo']?>">
                            </div>
                            <div class="field-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" value="<?= $data['address']?>">
                            </div>
                            <div class="field-group">
                                <label for="nic">NIC</label>
                                <input type="text" id="nic" name="nic" value="<?= $data['nic']?>">
                            </div>
                            <div class="field-group">
                                <label for="password">New Password</label>
                                <input type="password" id="password" name="password"
                                    placeholder="Leave blank if no change">
                            </div>
                            <div class="field-group">
                                <label for="re-password">Re-Enter New Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                    placeholder="Leave blank if no change">
                            </div>
                        </div>
                    </div>

                    <div class="save-changes-btn">
                        <button type="submit">Save Changes</button>
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