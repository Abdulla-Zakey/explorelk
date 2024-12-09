<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/registeredUser.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/editProfile.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Edit Profile</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="mainContainer">

        <div class="leftPanel">
            <div class="logo">
                <img src="<?= IMAGES ?>/logos/logoWhite.svg" alt="Logo">
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

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/ViewProfile" class="linkItem"><i class="fa-solid fa-user"></i>View Profile</a>
            </div>

            <div id="activeLink" class="linkHolder">
                <a href="<?= ROOT ?>/traveler/EditProfile" class="linkItem" style="color:#002D40 ;"><i class="fa-solid fa-user-pen"></i></i>Edit
                    Profile</a>
            </div>

            <div class="linkHolder">
                <a href="<?= ROOT ?>/traveler/Login/logout" class="linkItem">
                    <i class="fas fa-sign-out-alt"></i>Logout
                </a>
            </div>

        </div>

        <div class="profileDetails-Container">

            <div class="header-container">

                <h1>
                    Edit Profile
                </h1>

                <button class="buttonStyle">
                    <a href = "<?= ROOT ?>/traveler/ViewProfile">
                        <i class="fa fa-bookmark"></i>Save Changes
                    </a>
                    
                </button>

            </div>

            <div class="editProfilePic">

                <div class="profilePicHolder">
                    <img src="<?= IMAGES ?>/travelers/messages/profilePic.jpeg" alt="profilePic" id = "profileImage">
                </div>

                <div class = "username-Conatiner">
                    <div class = "username">Jabir31</div>
                    Nihmath Jabir
                </div>

                <input type="file" id="fileInput" class="file-input">

                <!-- Custom label -->
                <label for="fileInput" class="custom-file-label">
                    Change Photo
                </label>

            </div>

            

            <div class = "editPersonalInfo">

                <h2>
                    Personal Information
                </h2>

                <div class = "row">

                    <div class = "row-Item">
                        <label for="firstName">First Name:</label>
                        <input type = "text" value = "Nihmath">
                    </div>

                    <div class = "row-Item">
                        <label for="firstName">Last Name:</label>
                        <input type = "text" value = "Jabir">
                    </div>

                </div>

                <div class = "row">
                    
                    <div class = "row-Item">
                        <label for="password">Password:</label>
                        <input type = "password" value = "password123">
                    </div>

                    <div class = "row-Item">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type = "password" value = "password123">
                    </div>

                </div>

                <div class = "row">
                    
                    <div class = "row-Item">
                        <label for="password">Email:</label>
                        <input type = "email" value = "mnnjabir@fakemail.com">
                    </div>

                    <div class = "row-Item">
                        <label for="confirmPassword">Mobile Number:</label>
                        <input type = "number" value = "0715770109">
                    </div>

                </div>

                
                <div class = "row" style="display: block;">         
                    <label for= "bio" style = "font-size: 1.8rem;">Bio:</label>           
                    <textarea name="bio" id="bioText">A passionate traveler exploring the wonders of Sri Lanka. Love hiking, photography, and finding hidden gems.</textarea>
                </div>

            </div>

            <div class = "editPaymentInfo">

                <h2>
                    Payment Information
                </h2>

                <div class = "row">

                    <div class = "row-Item">
                        <label for="acNumber">Account Number:</label>
                        <input type = "number" value = "200209102877">
                    </div>

                    <div class = "row-Item">
                        <label for="acNumber">Bank Name:</label>
                        <select required>
                            
                            <option value="Amana Bank">Amana Bank</option>
                            <option value="Bank of Ceylon">Bank of Ceylon</option>
                            <option value="Commercial Bank">Commercial Bank</option>
                            <option value="DFCC Bank">Commercial Bank</option>
                            <option value="" selected>Hatton National Bank</option>
                            <option value="National Development Bank">National Development Bank</option>
                            <option value="National Savings Bank">National Savings Bank</option>
                            <option value="Nation Trust Bank">Nation Trust Bank</option>
                            <option value="Peoples Bank">Peoples Bank</option>
                            <option value="Sampath Bank">Sampath Bank</option>
                            <option value="Seylan Bank">Seylan Bank</option>
                            
                        </select>
                    </div>

                    <div class = "row-Item">
                        <label for="bankBranch">Bank Branch:</label>
                        <input type = "text" value = "Maligawatte">
                    </div>
                </div>

            </div>

            <!-- <div class = "editProfilePic" style = "display: block; font-size: 1.6rem;">

                <h2><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Important Notice</h2>
                

                <div class = "point">
                    Account Number, Bank Name, and Branch Name must match your registered bank account information.
                </div>

                <div class = "point">
                    Incorrect details may result in delays or failure in refund processing, for which we cannot be held responsible.
                </div>
               
            </div> -->

            <div class="message">

                <div class="icon">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>

                Please ensure that the bank account details you provide are accurate and up-to-date. 
                These details will be used to process refunds if necessary. Incorrect details may result in delays or failure in refund processing, 
                for which we cannot be held responsible.
    
            </div>

        </div>

    </div>

    <script>

        const fileInput = document.getElementById('fileInput');
        const profileImage = document.getElementById('profileImage');

        // Event listener for file input change
        fileInput.addEventListener('change', function () {
            const file = fileInput.files[0]; // Get the selected file

            if (file) {
                const reader = new FileReader();

                // Load the file and update the image source
                reader.onload = function (e) {
                    profileImage.src = e.target.result; // Set the img src to the file's data URL
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });

    </script>

</body>

</html>