<?php
    // var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/registeredUser.css">
    <link rel = "stylesheet" href = "<?= CSS ?>/Traveler/viewProfile.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | View Profile</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class = "mainContainer">

        <div class = "leftPanel">
            <div class = "logo">
                <img src = "<?= IMAGES ?>/logos/logoWhite.svg" alt = "Logo">
                <h1>
                    ExploreLK
                </h1>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/RegisteredTravelerHome" class = "linkItem"><i class="fa-solid fa-house"></i>Home</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyTrips" class = "linkItem"><i class="fa-solid fa-person-walking-luggage"></i>My Trips</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/MyBookings" class = "linkItem"><i class="fa-solid fa-book-open"></i>My Bookings</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Messages" class = "linkItem" ><i class="fa-solid fa-message"></i>Messages</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/Notifications" class = "linkItem"><i class="fa-solid fa-bell"></i>Notifications</a>
            </div>

            <div id = "activeLink" class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/ViewProfile" class = "linkItem" style="color:#002D40 ;"><i class="fa-solid fa-user"></i>View Profile</a>
            </div>

            <div class = "linkHolder">
                <a href = "<?= ROOT ?>/traveler/EditProfile" class = "linkItem"><i class="fa-solid fa-user-pen"></i>Edit Profile</a>
            </div>

            <div class = "linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>
            
            
        </div>

        <div class = "profileDetails-Container">

            <div  class = "header-container">

                <h1>
                    View Profile
                </h1>

                
                    
                </a>
                <button class = "buttonStyle">
                    <a href = "<?= ROOT ?>/traveler/EditProfile">
                        <i class="fa-solid fa-user-pen"></i>Edit Profile
                    </a>
                   
                </button>

            </div>


            
                <div class = "main-Container">

                    <div class = "profilePic-Holder">
                        <!-- <img src = "<?= ROOT ?>/assets/images/Travelers/viewProfile/defaultUserIcon.png"> -->
                        <img src = "<?= !empty($data['traveler']->profilePicture) 
                            ? ROOT . '/assets/images/Travelers/userProfilePics/' . $data['traveler']->profilePicture 
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
                                <input type="text" name="firstName" value = "<?= htmlspecialchars($data['traveler']->fName ?? '') ?>" readonly>
                            </div>
            
                            <div class="rightColumn">
                                <label>
                                    Last Name:
                                </label>
                                <!-- <input type="text" name="lastName" value = "Jabir" readonly> -->
                                <input type="text" name="lasstName" value = "<?= htmlspecialchars($data['traveler']->lName ?? '') ?>" readonly>
                            </div>
            
                        </div>
            
                        <div class="row">
            
                            <div class="leftColumn">
                                Username:
                                <br>
                                <!-- <input type="text" name="username"  value = "Jabir31" readonly> -->
                                <input type="text" name="username" value = "<?= htmlspecialchars($data['traveler']->username ?? '') ?>" readonly>
        
                            </div>
            
                            <div class="rightColumn">
                                Password:
                                <br>
                                <!-- <input type="password" name="password" value = "user@123" readonly> -->
                                <input type="password" name="password" value = "********" readonly>
                            </div>
            
                        </div>

                        <div class="row">
            
                            <div class="leftColumn">
                                <label>
                                    Email:
                                </label>
                                
                                <!-- <input type = "email" name = "email"  value = "jabirmnn@fakemail.com" readonly> -->
                                <input type = "email" name = "email" value = "<?= htmlspecialchars($data['traveler']->travelerEmail ?? '') ?>" readonly>
        
                            </div>
            
                            <div class="rightColumn">
                                <label>
                                    Mobile Number:
                                </label>
                                <!-- <input type="number" name="mobile" value = "0715770109" readonly> -->
                                <input type="text" name="mobile" value = "<?= htmlspecialchars($data['traveler']->travelerMobileNum ?? '') ?>" readonly>
                            </div>
            
                        </div>

            
            
                        <div class="row" style="display: block;">
                            <label>
                                Bio:
                            </label>
                            
                            <!-- <textarea name="bio" readonly>A passionate traveler exploring the wonders of Sri Lanka. Love hiking, photography, and finding hidden gems.</textarea>-->
                            <textarea name="bio" readonly><?= htmlspecialchars($data['traveler']->bio ?? '') ?></textarea>
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
                            <input type = "text" name="acNum" value = "<?= htmlspecialchars($data['accountDetails']->traveler_accountNum ?? '') ?>" readonly>
                        </div>
    
                        <div>
                            <label>
                                Bank Name:
                            </label>
                            <!-- <input type = "text" name = "bankName" value = "HNB" readonly> -->
                            <input type = "text" name="bankName" value = "<?= htmlspecialchars($data['accountDetails']->traveler_bankName ?? '') ?>" readonly>
                             
                        </div>
    
                        <div>
                            <label>
                                Bank Branch:
                            </label>
                            <!-- <input type = "text" name = "branch" value = "Maligawatte" readonly> -->
                            <input type = "text" name="branch" value = "<?= htmlspecialchars($data['accountDetails']->traveler_bankBranch ?? '') ?>" readonly>
                        </div>
                    </div>
    
                </div>
    
            
            
        </div>

    </div>

    

</body>

</html>