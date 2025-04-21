<html lang="en">

</html>

<head>
    <title>ExploreLK Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    <script src="<?= ROOT ?>/assets/js/admin/admin.js?v=1.0"></script>

    <style>
    html {
        font-size: 10px;
    }
    </style>
</head>

<body>
    <div class="flexContainer">
        <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

        <div class="profileDetails-Container">
            <div class="header-container">
                <h1>
                    View Profile
                </h1>

                </a>
                <button class="buttonStyle" onclick="window.location.href='<?= ROOT ?>/tourGuide/C_editProfile'">
                    
                        <i class="fa-solid fa-user-pen"></i>Edit Profile
                    
                </button>
            </div>

            <div class="main-Container">
                <div class="profilePic-Holder">
                    <!-- <img src = "<?= ROOT ?>/assets/images/Travelers/viewProfile/defaultUserIcon.png"> -->
                    <img src="<?= !empty($data['userData'][0]->profilePhoto) 
                            ? ROOT . '/assets/images/tourGuide/tourGuideProfilePhotos/' . htmlspecialchars($data['userData'][0]->profilePhoto) 
                            : ROOT . '/assets/images/Travelers/viewProfile/defaultUserIcon.png' ?>">
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

                            <!-- <input type="text" name="firstName" value = "Nihmath" readonly> -->
                            <input type="text" name="firstName" value="<?= htmlspecialchars($data['userData'][0]->firstName); ?>"
                                readonly>
                        </div>

                        <div class="rightColumn">
                            <label>
                                Last Name:
                            </label>
                            <!-- <input type="text" name="lastName" value = "Jabir" readonly> -->
                            <input type="text" name="lastName"
                                value="<?= htmlspecialchars($data['userData'][0]->lastName ?? '') ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="leftColumn">
                            <label>
                                Username:
                            </label>

                            <!-- <input type = "email" name = "email"  value = "jabirmnn@fakemail.com" readonly> -->
                            <input type="text" name="username" value="<?= htmlspecialchars($data['userData'][0]->username ?? '') ?>"
                                readonly>
                        </div>

                        <div class="rightColumn">
                            <label>
                                Password:
                            </label>
                            <!-- <input type="number" name="mobile" value = "0715770109" readonly> -->
                            <input type="password" name="password" value="********"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="leftColumn">
                            <label>
                                Email:
                            </label>

                            <!-- <input type = "email" name = "email"  value = "jabirmnn@fakemail.com" readonly> -->
                            <input type="email" name="email" value="<?= htmlspecialchars($data['userData'][0]->email ?? '') ?>"
                                readonly>
                        </div>

                        <div class="rightColumn">
                            <label>
                                Mobile Number:
                            </label>
                            <!-- <input type="number" name="mobile" value = "0715770109" readonly> -->
                            <input type="text" name="mobileNum" value="<?= htmlspecialchars($data['userData'][0]->mobileNum ?? '') ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="leftColumn">
                            <label>
                                NIC:
                            </label>

                            <!-- <input type = "email" name = "email"  value = "jabirmnn@fakemail.com" readonly> -->
                            <input type="text" name="nic" value="<?= htmlspecialchars($data['userData'][0]->nic ?? '') ?>"
                                readonly>
                        </div>

                        <div class="rightColumn">
                            <label>
                                License No:
                            </label>
                            <!-- <input type="number" name="mobile" value = "0715770109" readonly> -->
                            <input type="text" name="licenseNum" value="<?= htmlspecialchars($data['userData'][0]->licenseNum ?? '') ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="leftColumn">
                            <label style="font-size: 1.5rem;">
                                Tour Frequency Per Month :
                            </label>

                            <!-- <input type = "email" name = "email"  value = "jabirmnn@fakemail.com" readonly> -->
                            <input type="text" name="tourFrequencyPerMonth"
                                value="<?= htmlspecialchars($data['userData'][0]->tourFrequencyPerMonth ?? '') ?>" readonly>
                        </div>

                        <div class="rightColumn">
                            <label>
                                Experience :
                            </label>
                            <!-- <input type="number" name="mobile" value = "0715770109" readonly> -->
                            <input type="text" name="experience" value="<?= htmlspecialchars($data['userData'][0]->experience ?? '') ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="row" style="display: block;">
                        <label>
                            Bio:
                        </label>
                        <!-- <textarea name="bio" readonly>A passionate traveler exploring the wonders of Sri Lanka. Love hiking, photography, and finding hidden gems.</textarea>-->
                        <textarea name="bio" readonly><?= htmlspecialchars($data['userData'][0]->guideBio ?? '') ?></textarea>
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
                        <!-- <input type = "number" name = "acNum" value = "200209102877" readonly> -->
                        <input type="text" name="tourGuide_accountNum"
                            value="<?= htmlspecialchars($data['bankDetailsData']['0']->tourGuide_accountNum ?? '') ?>"
                            readonly>
                    </div>

                    <div>
                        <label>
                            Bank Name:
                        </label>
                        <!-- <input type = "text" name = "bankName" value = "HNB" readonly> -->
                        <input type="text" name="tourGuide_bankName"
                            value="<?= htmlspecialchars($data['bankDetailsData']['0']->tourGuide_bankName ?? '') ?>" readonly>
                    </div>

                    <div>
                        <label>
                            Bank Branch:
                        </label>
                        <!-- <input type = "text" name = "branch" value = "Maligawatte" readonly> -->
                        <input type="text" name="tourGuide_bankBranch"
                            value="<?= htmlspecialchars($data['bankDetailsData']['0']->tourGuide_bankBranch ?? '') ?>"
                            readonly>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>