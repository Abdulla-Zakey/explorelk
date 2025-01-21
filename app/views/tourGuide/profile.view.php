<html>

<head>
    <title>ExploreLK Tour Guide</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="flexContainer">

        <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

        <div class="body-container">
            <div class="heading">
                <h1>Personal Information</h1>
            </div>

            <form method="post" action="<?=ROOT?>/tourGuide/C_profile/updateProfile">
                <div class="save-btn">
                    <button type="submit">save</button>
                </div>

                <?php foreach ($data['userData'] as $data): ?>

                <div class="flexContainer">
                    <div class="profile-photo">
                        <div class="photo-container">
                            <img src="<?=ROOT?>/tourGuide/C_profile/getProfileImage?t=<?=time()?>" alt="Profile Photo"
                                id="preview-image">

                            <div class="upload-overlay">
                                <form method="post" action="<?=ROOT?>/tourGuide/C_profile/updatePhoto" enctype="multipart/form-data"
                                    id="photo-form">
                                    <label for="profile-photo-input" class="upload-btn">
                                        <i class="fa-solid fa-camera"></i>
                                        <span>Change Photo</span>
                                    </label>
                                    <input type="file" id="profile-photo-input" name="profile_photo"
                                        accept="image/jpeg,image/png,image/jpg" style="display: none;"
                                        onchange="submitForm()">
                                </form>
                            </div>
                        </div>

                        <div class="profile-name">
                            <h3><?= htmlspecialchars($data->name) ?></h3>
                            <span>
                                <p><?= htmlspecialchars($data->guideLocation) ?></p>
                            </span>
                        </div>
                    </div>


                    <div class="profile-info">
                        <div class="lable-div">
                            <div class="lable">
                                <p>Full Name</p>
                            </div>

                            <div>
                                <input type="text" id="name" name="name" value="<?= htmlspecialchars($data->name) ?>">
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Email</p>
                            </div>

                            <div class="light-text">
                                <p><?= htmlspecialchars($data->email) ?></p>
                            </div>
                        </div>

                        <div class="flexContainer" style="gap:2%; width: 100%; height: auto">
                            <div class="lable-div" style="width: 100%">
                                <div class="lable">
                                    <p>Phone Number</p>
                                </div>

                                <div class="light-text">
                                    <input type="number" id="phone" name="phone"
                                        value="<?= htmlspecialchars($data->mobileNum) ?>">
                                </div>
                            </div>

                            <div class="lable-div" style="width: 100%;">
                                <div class="lable">
                                    <p>Location</p>
                                </div>

                                <div class="light-text">
                                    <input type="" id="location" name="location"
                                        value="<?= htmlspecialchars($data->guideLocation) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="flexContainer" style="gap:2%; width: 100%">
                            <div class="lable-div" style="width: 100%">
                                <div class="lable">
                                    <p>NIC Number</p>
                                </div>

                                <div class="light-text">
                                    <input type="number" id="nic" name="nic"
                                        value="<?= htmlspecialchars($data->nic) ?>">
                                </div>
                            </div>
                            <div class="lable-div" style="width: 100%">
                                <div class="lable">
                                    <p>License Number</p>
                                </div>

                                <div class="light-text">
                                    <input type="" id="license" name="license"
                                        value=<?= htmlspecialchars($data->licenseNum) ?>>
                                </div>
                            </div>
                        </div>



                        <div class="lable-div">
                            <div class="lable">
                                <p>Bio</p>
                            </div>

                            <div class="light-text">
                                <textarea name="bio" id="bio" rows="5"
                                    cols="70"><?= htmlspecialchars($data->guideBio) ?></textarea>
                            </div>
                        </div>

                        <div class="flexContainer" style="gap:2%; width: 100%">
                            <div class="lable-div" style="width: 100%">
                                <div class="lable">
                                    <p>Experience (In Years)</p>
                                </div>

                                <div class="light-text">
                                    <input type="number" id="experience" name="experience"
                                        value="<?= htmlspecialchars($data->experience) ?>">
                                </div>
                            </div>
                            <div class="lable-div" style="width: 100%">
                                <div class="lable">
                                    <p>Tour Frequency Per Month</p>
                                </div>

                                <div class="light-text">
                                    <input type="" id="tourFrequency" name="tourFrequency"
                                        value=<?= htmlspecialchars($data->tourFrequencyPerMonth) ?>>
                                </div>
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Languages Spoken</p>
                            </div>

                            <?php
                                $languages = isset($data->languages_spoken) ? json_decode($data->languages_spoken, true) : [];
                            ?>
                            <div class="languages">
                                <p>Sinhala</p><input type="checkbox" name="sinhala" value="1"
                                    <?= isset($languages['sinhala']) && $languages['sinhala'] ? 'checked' : '' ?>>
                                <p>English</p><input type="checkbox" name="english" value="1"
                                    <?= isset($languages['english']) && $languages['english'] ? 'checked' : '' ?>>
                                <p>Tamil</p><input type="checkbox" name="tamil" value="1"
                                    <?= isset($languages['tamil']) && $languages['tamil'] ? 'checked' : '' ?>>
                            </div>
                        </div>

                        <!-- <div class="lable-div">
                            <div class="lable">
                                <p>Social Media</p>
                            </div>

                            <div class="light-text" id="flex-display">
                                <div class="profile-icon">
                                    <i class="fa-brands fa-facebook fa-2x"></i>
                                    <a href="facebook.com">Facebook</a>
                                </div>

                                <div class="profile-icon">
                                    <i class="fa-brands fa-instagram fa-2x"></i>
                                    <a href="instagram.com">Instagram</a>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </form>
            <?php endforeach; ?>

        </div>

    </div>
</body>

<script>
function handlePhotoUpload(input) {
    if (input.files && input.files[0]) {
        // Show loading state
        const preview = document.getElementById('preview-image');
        preview.style.opacity = '0.5';

        const form = document.getElementById('photo-form');
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Force reload the image by updating src with new timestamp
                    const timestamp = new Date().getTime();
                    preview.src = `<?=ROOT?>/tourGuide/C_profile/getProfileImage?t=${timestamp}`;

                    // Reset opacity after new image loads
                    preview.onload = function() {
                        preview.style.opacity = '1';
                    };
                } else {
                    alert(data.message || 'Error uploading photo');
                    preview.style.opacity = '1';
                }
            })
            .catch(error => {
                console.error('Upload error:', error);
                alert('Error uploading photo');
                preview.style.opacity = '1';
            });
    }
}

// Add this to preview the image before upload (optional)
document.getElementById('profile-photo-input').onchange = function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};
</script>

</html>