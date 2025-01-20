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

                <div class="save-btn">
                    <button>save</button>
                </div>

                <div class="flexContainer">
                    <div class="profile-photo">
                        <div>
                            <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Profile Photo">
                        </div>

                        <div class="profile-name">
                            <h3>Ramesh</h3>
                            <span><p>Colombo, Western Province</p></span>
                        </div>
                    </div>

                    <div class="profile-info">
                        <div class="lable-div">
                            <div class="lable">
                                <p>Full Name</p>
                            </div>

                            <div>
                                <input type="text" id="name" name="name" placeholder="Ramesh Kepetiyagama">
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Email</p>
                            </div>

                            <div class="light-text">
                                <p>ramesh32@gmail.com</p>
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Phone Number</p>
                            </div>
                            
                            <div class="light-text">
                                <input type="number" id="phone" name="phone" placeholder="0712345678">
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Location</p>
                            </div>
                            
                            <div class="light-text">
                                <input type="text" id="location" name="location" placeholder="Colombo, Western Province">
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Bio</p>
                            </div>
                            
                            <div class="light-text">
                                <textarea name="bio" id="bio" rows="5" cols="70" placeholder="Write a brief introduction about you"></textarea>
                            </div>
                        </div>

                        <div class="lable-div">
                            <div class="lable">
                                <p>Languages Spoken</p>
                            </div>
                            
                            <div class="languages">
                                <p>Sinhala</p><input type="checkbox" name="sinhala" value="sinhala">
                                <p>English</p><input type="checkbox" name="english" value="english">
                                <p>Tamil</p><input type="checkbox" name="tamil" value="tamil">
                            </div>
                        </div>

                        <div class="lable-div">
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
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </body>
</html>
