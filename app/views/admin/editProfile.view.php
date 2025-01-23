<html lang="en"></html>
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
            <div class="traveler-details">
                <form>
                    <div class="details-container">
                        <div class="profile-picture">
                            <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Profile Picture">
                        </div>
                        <div class="profile-fields">
                            <div class="field-group">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first-name" value="Andrew">
                            </div>
                            <div class="field-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" value="Star">
                            </div>
                            <div class="field-group">
                                <label for="admin-id">Admin ID</label>
                                <input type="text" id="admin-id" value="A 052" disabled>
                            </div>
                            <div class="field-group">
                                <label for="gender">Gender</label>
                                <input type="text" id="gender" value="Male">
                            </div>
                            <div class="field-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" value="andrewtate568@gmail.com" disabled>
                            </div>
                            <div class="field-group">
                                <label for="birth-date">Birth Date</label>
                                <input type="text" id="birth-date" value="05/02/2000">
                            </div>
                            <div class="field-group">
                                <label for="city">City</label>
                                <input type="text" id="city" value="Kandy">
                            </div>
                            <div class="field-group">
                                <label for="contact-no">Contact No.</label>
                                <input type="text" id="contact-no" value="+94 76 14 85 466">
                            </div>
                            <div class="field-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" value="2A/1, Wellawatta">
                            </div>
                            <div class="field-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" value="**********">
                            </div>
                            <div class="field-group">
                                <label for="re-password">Re-Enter Password</label>
                                <input type="password" id="re-password" value="**********">
                            </div>
                        </div>
                    </div>

                    <div class="save-changes-btn">
                        <button type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>