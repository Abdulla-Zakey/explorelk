<!DOCTYPE html>
<html lang="en">
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
            <div class="sub-heading">
                <a class="back_button" href="<?= ROOT?>/tourGuide/C_bookings">&larr; Back</a>
            </div>

            <div class="booking-info">
                <div class="profile-image">
                    <div>
                        <img src="<?= ROOT ?>/assets/images/tourGuide/profile.png" alt="Profile Photo">
                    </div>

                    <div class="profile-name">
                        <h3 style="padding-top: 5%;">Ramesh</h3>
                        <span><p>Colombo, Western Province</p></span>
                    </div>
                </div>

                <div class="details">
                    <div class="heading">
                        <h2>Booking Details</h2>
                    </div>

                    <div class="light-text">
                        <p>Tourist Information</p>
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
                        <p style="color: black;">I'm allergic to peanuts. Please don't include peanuts in the meals.</p>
                    </div>

                    <div class="sub-heading">
                        <h3>Tour Information</h3>
                    </div>

                    <div class="tourist-details">
                        <div class="tourist-info">
                            <h4>Tour Name:</h6>
                            <p>Gartmore Falls</p>
                        </div>

                        <div class="tourist-info">
                            <h4>Date:</h6>
                            <p>24.01.2024</p>
                        </div>
        
                        <div class="tourist-info">
                            <h4>Time:</h6>
                            <p>8.30 A.M</p>
                        </div>

                        <div class="tourist-info">
                            <h4>Duration:</h6>
                            <p>1 Day</p>
                        </div>

                        <div class="tourist-info">
                            <h4>Meetup Location:</h6>
                            <p>Hatton</p>
                        </div>

                        <div class="tourist-info">
                            <h4>Guide:</h6>
                            <p>Lalithra</p>
                        </div>
                    </div>

                    <div class="button-container">
                        <button class="contact-button">Contact tourist</button>
                        <button class="cancel-button">Cancel tour</button>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
</body>
</html>
