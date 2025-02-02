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
            </div>
            <div class="traveler-details">
                <div class="details-container">
                    <div class="profile-picture">
                        <img src="<?= ROOT ?>/assets/images/admin/adminProfilePhotos/<?= $data['profile_picture'] ?? 'profile.png' ?>" alt="Profile Picture">
                    </div>
                    <div class="profile-fields">
                        <div class="field-group flexContainer">
                            <h4>First Name :</h4>&nbsp; <?= $data['firstName']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Last Name :</h4>&nbsp; <?= $data['lastName']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Admin ID :</h4>&nbsp; <?= $data['admin_id']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Gender :</h4>&nbsp; <?= $data['gender']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Email Address :</h4>&nbsp; <?= $data['email']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Birth Date :</h4>&nbsp; <?= $data['dob']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>City :</h4>&nbsp; <?= $data['city']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Contact No : </h4>&nbsp; <?= $data['phoneNo']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>Address :</h4>&nbsp; <?= $data['address']; ?>
                        </div>
                        <div class="field-group flexContainer">
                            <h4>NIC :</h4>&nbsp; <?= $data['nic']; ?>
                        </div>

                    </div>
                </div>

                <div class="save-changes-btn">
                    <button onclick="window.location.href='<?= ROOT ?>/admin/C_editProfile';">Edit Profile</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>