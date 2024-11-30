<html>
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
    
                <div class="booking-info">
                    <div class="profile-image">
                        <div>
                            <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Profile Photo">
                        </div>
    
                        <div class="profile-name">
                            <h3 style="padding-top: 5%;">Ramesh</h3>
                            <span><p>Colombo, Western Province</p></span>
                        </div>
                    </div>
    
                    <div class="details">
                        <div class="heading">
                            <h2>Service Provider Details</h2>
                        </div>
    
                        <div class="tourist-details">
                            <div class="tourist-info">
                                <h4>Name:</h6>
                                <p>Alice Smith</p>
                            </div>
    
                            <div class="tourist-info">
                                <h4>Email:</h6>
                                <p>alicesmith@gmail.com</p>
                            </div>
                
                            <div class="tourist-info">
                                <h4>Phone:</h6>
                                <p>0772030722</p>
                            </div>
    
                            <div class="tourist-info">
                                <h4>Language:</h6>
                                <p>Sinhala</p>
                            </div>
                        </div>
    
                        <div class="sub-heading">
                            <h3>Special Instructions</h3>
                        </div>
    
                        <div class="light-text">
                            <p style="color: black;">Please ensure my hotel profile highlights key amenities, location advantages, and unique offerings to attract guests effectively</p>
                        </div>
    
                        <div class="sub-heading">
                            <h3>Service Information</h3>
                        </div>
    
                        <div class="tourist-details">
                            <div class="tourist-info">
                                <h4>Service Type:</h6>
                                <p>Hotels and Restaurants</p>
                            </div>
    
                            <div class="tourist-info">
                                <h4>Location:</h6>
                                <p>Wellawatte, Galle Road</p>
                            </div>
            
                            <div class="tourist-info">
                                <h4>Established Year:</h6>
                                <p>2020</p>
                            </div>
    
                            <div class="tourist-info">
                                <h4>No. Of Rooms:</h6>
                                <p>25 Rooms</p>
                            </div>
                        </div>
    
                        <div class="button-container">
                            <button class="confirm-button">Confirm Request</button>
                            <button class="cancel-button">Cancel Request</button>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>