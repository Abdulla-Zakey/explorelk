<html lang="en">

<head>
    <title>ExploreLK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <style>
    html {
        font-size: 10px;
    }
    .error-container{
        color: red;
        font-size: 1.1rem;
    }
    </style>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

        <div class="profileDetails-Container">

            <form action="<?= ROOT ?>/tourGuide/C_editProfile/update" method="POST" enctype="multipart/form-data"
                class="form">
                <div class="header-container">
                    <h1>
                        Edit Profile
                    </h1>

                    </a>
                    <button class="buttonStyle" type="submit">
                        
                            <i class="fa-solid fa-user-pen"></i>Save Changes
                        
                    </button>
                </div>

                <?php
                 //if(!empty($data)){
                    // show($data);
                // }
                ?>

                <div class="main-Container">
                    <div class="profile-picture edit-profile-picture">
                        <img id="profile-image"
                            src="<?= ROOT ?>/assets/images/tourGuide/tourGuideProfilePhotos/<?= htmlspecialchars($data['userData'][0]->profilePhoto) ?>"
                            alt="Profile Picture">
                        <label class="edit-change-photo-btn" for="file-input">Change Profile Photo</label>
                        <input type="file" id="file-input" name="profile-image" accept="image/*">
                    </div>

                    <div class="personalInfo">
                        <h2>
                            Personal Information
                        </h2>

                        <div class="row">
                            <div class="leftColumn">
                                <label>
                                    First Name:
                                </label>

                                <?php if(!empty($data['guideErrors']['firstName'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['firstName'];?></div>
                                    <input type="text" name="firstName" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="firstName" value="<?= htmlspecialchars($data['userData'][0]->firstName); ?>">
                                <?php endif; ?>
                            </div>

                            <div class="rightColumn">
                                <label>
                                    Last Name:
                                </label>
                                <?php if(!empty($data['guideErrors']['lastName'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['lastName'];?></div>
                                    <input type="text" name="lastName" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="lastName"
                                    value="<?= htmlspecialchars($data['userData'][0]->lastName ?? '') ?>">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="leftColumn">
                                <label>
                                    Username:
                                </label>

                                <?php if(!empty($data['guideErrors']['username'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['username'];?></div>
                                    <input type="text" name="username" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="username"
                                    value="<?= htmlspecialchars($data['userData'][0]->username ?? '') ?>" readonly>
                                <?php endif; ?>
                            </div>

                            <div class="rightColumn">
                                <label>
                                    Gender:
                                </label>
                                <select id="gender" name="gender">
                                    <option value="Male">Male
                                    </option>
                                    <option value="Female">Female
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="leftColumn">
                                <label>
                                    Password :
                                </label>

                                <?php if(!empty($data['guideErrors']['password'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['password'];?></div>
                                    <input type="password" name="password" value="">
                                </div>
                                <?php else: ?>
                                <input type="password" name="password" placeholder="Leave blank if no changes" value="">
                                <?php endif; ?>
                            </div>

                            <div class="rightColumn">
                                <label>
                                    Confirm Password :
                                </label>

                                <?php if(!empty($data['guideErrors']['confirmPassword'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['confirmPassword'];?></div>
                                    <input type="password" name="confirmPassword" value="">
                                </div>
                                <?php else: ?>
                                <input type="password" name="confirmPassword" placeholder="Leave blank if no changes"
                                    value="">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="leftColumn">
                                <label>
                                    Email:
                                </label>

                                <?php if(!empty($data['guideErrors']['email'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['email'];?></div>
                                    <input type="email" name="email" value="">
                                </div>
                                <?php else: ?>
                                <input type="email" name="email"
                                    value="<?= htmlspecialchars($data['userData'][0]->email ?? '') ?>">
                                <?php endif; ?>
                            </div>

                            <div class="rightColumn">
                                <label>
                                    Mobile Number:
                                </label>

                                <?php if(!empty($data['guideErrors']['mobileNum'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['mobileNum'];?></div>
                                    <input type="text" name="mobileNum" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="mobileNum"
                                    value="<?= htmlspecialchars($data['userData'][0]->mobileNum ?? '') ?>">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="leftColumn">
                                <label>
                                    NIC:
                                </label>

                                <?php if(!empty($data['guideErrors']['nic'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['nic'];?></div>
                                    <input type="text" name="nic" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="nic"
                                    value="<?= htmlspecialchars($data['userData'][0]->nic ?? '') ?>">
                                <?php endif; ?>
                            </div>

                            <div class="rightColumn">
                                <label>
                                    License No:
                                </label>

                                <?php if(!empty($data['guideErrors']['licenseNum'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['licenseNum'];?></div>
                                    <input type="text" name="licenseNum" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="licenseNum"
                                    value="<?= htmlspecialchars($data['userData'][0]->licenseNum ?? '') ?>">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="leftColumn">
                                <label style="font-size: 1.5rem;">
                                    Tour Frequency Per Month :
                                </label>

                                <?php if(!empty($data['guideErrors']['tourFrequencyPerMonth'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['tourFrequencyPerMonth'];?></div>
                                    <input type="text" name="tourFrequencyPerMonth" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="tourFrequencyPerMonth"
                                    value="<?= htmlspecialchars($data['userData'][0]->tourFrequencyPerMonth ?? '') ?>">
                                <?php endif; ?>
                            </div>

                            <div class="rightColumn">
                                <label>
                                    Experience :
                                </label>

                                <?php if(!empty($data['guideErrors']['experience'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['experience'];?></div>
                                    <input type="text" name="experience" value="">
                                </div>
                                <?php else: ?>
                                <input type="text" name="experience"
                                    value="<?= htmlspecialchars($data['userData'][0]->experience ?? '') ?>">
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row" style="display: block;">
                            <label>
                                Bio:
                            </label>

                            <?php if(!empty($data['guideErrors']['bio'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['guideErrors']['bio'];?></div>
                                    <textarea name="guideBio" ></textarea>
                                </div>
                                <?php else: ?>
                            <textarea
                                name="guideBio"><?= htmlspecialchars($data['userData'][0]->guideBio ?? '') ?></textarea>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="contactInfo">
                        <h2>
                            Payment Information
                        </h2>

                        <div>
                            <label>
                                Account Number:
                            </label>

                            <?php if(!empty($data['bankErrors']['tourGuide_accountNum'])): ?>
                                <div class="error-container">
                                    <div class="error-message"><?= $data['bankErrors']['tourGuide_accountNum'];?></div>
                                    <input type="text" name="tourGuide_accountNum" value="">
                                </div>
                                <?php else: ?>
                            <input type="text" name="tourGuide_accountNum"
                                value="<?= htmlspecialchars($data['bankDetailsData']['0']->tourGuide_accountNum ?? '') ?>">
                            <?php endif; ?>
                        </div>

                        <div>
                            <label>
                                Bank Name:
                            </label>

                            <?php if(!empty($data['bankErrors']['tourGuide_bankName'])): ?>
                            <div class="error-container">
                                <div class="error-message"><?= $data['bankErrors']['tourGuide_bankName'];?></div>
                                <input type="text" name="tourGuide_bankName" value="">
                            </div>
                            <?php else: ?>
                            <input type="text" name="tourGuide_bankName"
                                value="<?= htmlspecialchars($data['bankDetailsData']['0']->tourGuide_bankName ?? '') ?>">
                            <?php endif; ?>
                        </div>

                        <div>
                            <label>
                                Bank Branch:
                            </label>

                            <?php if(!empty($data['bankErrors']['tourGuide_bankBranch'])): ?>
                            <div class="error-container">
                                <div class="error-message"><?= $data['bankErrors']['tourGuide_bankBranch'];?></div>
                                <input type="text" name="tourGuide_bankBranch" value="">
                            </div>
                            <?php else: ?>
                            <input type="text" name="tourGuide_bankBranch"
                                value="<?= htmlspecialchars($data['bankDetailsData']['0']->tourGuide_bankBranch ?? '') ?>">
                            <?php endif; ?>
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