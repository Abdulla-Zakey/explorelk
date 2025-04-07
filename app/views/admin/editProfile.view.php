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

            
            <?php
            // show($data);
            // if (!empty($data['errors']['firstName'])) {
            //     var_dump($data['errors']['firstName']);
            // }
            ?>
            <div class="traveler-details">
                <form action="<?= ROOT ?>/admin/C_editProfile/updateProfile" method="POST" enctype="multipart/form-data">
                    <div class="details-container">
                        <div class="profile-picture edit-profile-picture">
                            <img id="profile-image"
                                src="<?= ROOT ?>/assets/images/admin/adminProfilePhotos/<?= $data['userData']->profile_picture ?>"
                                alt="Profile Picture">
                            <label class="edit-change-photo-btn" for="file-input">Change Profile Photo</label>
                            <input type="file" id="file-input" name="profile-image" accept="image/*">
                        </div>
                        <div class="profile-fields">
                            <div class="field-group">
                                <label for="first-name">
                                    First Name
                                </label>

                                <?php if(!empty($data['errors']['firstName'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['firstName'];?></div>
                                    <input type="text" name="first-name" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" id="first-name" name="first-name" value="<?= $data['userData']->firstName ?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="last-name">
                                    Last Name
                                </label>

                                <?php if(!empty($data['errors']['lastName'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['lastName'];?></div>
                                    <input type="text" name="last-name" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" id="last-name" name="last-name" value="<?= $data['userData']->lastName ?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="admin-id">
                                    Admin ID
                                </label>
                                
                                <input type="text" id="admin-id" value="<?= $data['userData']->admin_id?>" disabled>
                            </div>
                            <div class="field-group">
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender">
                                    <option value="Male" <?= $data['userData']->gender === 'male' ? 'selected' : '' ?>>Male
                                    </option>
                                    <option value="Female" <?= $data['userData']->gender === 'female' ? 'selected' : '' ?>>Female
                                    </option>
                                </select>
                            </div>
                            <div class="field-group">
                                <label for="email">
                                    Email Address
                                </label>

                                <?php if(!empty($data['errors']['email'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['email'];?></div>
                                    <input type="email" name="email" value="">
                                </div>
                                <?php else: ?>
                                <input type="email" id="email" value="<?= $data['userData']->email?>" disabled>
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="birth-date">
                                    Birth Date
                                </label>

                                <?php if(!empty($data['errors']['dob'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['dob'];?></div>
                                    <input type="text" name="birth-date" value="">
                                </div>
                                <?php else: ?>
                                <input type="date" id="birth-date" name="birth-date" value="<?= $data['userData']->dob?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="city">
                                    City
                                </label>

                                <?php if(!empty($data['errors']['city'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['city'];?></div>
                                    <input type="text" name="city" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" id="city" name="city" value="<?= $data['userData']->city?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="contact-no">
                                    Contact No.
                                </label>

                                <?php if(!empty($data['errors']['contact-no'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['contact-no'];?></div>
                                    <input type="text" name="contact-no" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" id="contact-no" name="contact-no" value="<?= $data['userData']->phoneNo?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="address">
                                    Address
                                </label>

                                <?php if(!empty($data['errors']['address'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['address'];?></div>
                                    <input type="text" name="address" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" id="address" name="address" value="<?= $data['userData']->address?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="nic">
                                    NIC
                                </label>

                                <?php if(!empty($data['errors']['nic'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['nic'];?></div>
                                    <input type="text" name="nic" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" id="nic" name="nic" value="<?= $data['userData']->nic?>">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="password">
                                    New Password
                                </label>

                                <?php if(!empty($data['errors']['password'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['password'];?></div>
                                    <input type="password" name="password" value="">
                                </div>
                                <?php else: ?>
                                <input type="password" id="password" name="password"
                                    placeholder="Leave blank if no change">
                                <?php endif; ?>
                            </div>
                            <div class="field-group">
                                <label for="re-password">
                                    Re-Enter New Password
                                </label>

                                <?php if(!empty($data['errors']['confirmPassword'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['errors']['confirmPassword'];?></div>
                                    <input type="password" name="confirmPassword" value="">
                                </div>
                                <?php else: ?>
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                    placeholder="Leave blank if no change">
                                <?php endif; ?>
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