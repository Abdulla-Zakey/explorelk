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

    <style>

        .error-container{
            color: red;
            font-size: 1.5rem;
        }

        /* Pop-up container (initially hidden) */
        .popup-container {
            font-size: 1.35rem;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6); /* Dark transparent overlay */
        display: none; /* Initially hidden */
        justify-content: center;
        align-items: center;
        z-index: 999; /* Above other content */
        }

        /* Pop-up content */
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            font-size: 16px;
        }

        /* Close button */
        .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        /* Blur background effect when pop-up is visible */
        .blur {
            filter: blur(5px);
            pointer-events: none;
        }
    </style>
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

            <form action="<?= ROOT ?>/traveler/EditProfile/updateProfile" method="POST" enctype="multipart/form-data" class = "form">

                <div class="header-container">

                    <h1>Edit Profile</h1>

                    <button type="submit" class="buttonStyle">
                        <i class="fa fa-bookmark"></i>Save Changes
                    </button>

                </div>

                <?php if (!empty($errors)): ?>
                    <div class="error-container">
                        <?php foreach ($errors as $field => $message): ?>
                            <div class="error-message"><?= $message ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="editProfilePic">

                    <div class="profilePicHolder">
                        <img id = "profileImage" src="<?= !empty($data['traveler']->profilePicture) 
                            ? ROOT . '/assets/images/Travelers/userProfilePics/' . $data['traveler']->profilePicture 
                            : ROOT . '/assets/images/Travelers/viewProfile/defaultUserIcon.png' ?>">
                    </div>

                    <div class="username-Conatiner">

                        <div class="username">
                            <?= htmlspecialchars($data['traveler']->username  ?? '') ?>
                        </div>

                        <?= htmlspecialchars($data['traveler']->fName . ' ' ?? '') ?><?= htmlspecialchars($data['traveler']->lName ?? '') ?>

                    </div>

                   

                    <input type="file" id="fileInput" name="profilePicture" class="file-input" accept="image/*">

                    <label for="fileInput" class="custom-file-label">
                        Change Photo
                    </label>
                </div>

                <div class="editPersonalInfo">
                    <h2>Personal Information</h2>

                    <div class="row">

                        <div class="row-Item">
                            <label for="firstName">First Name:</label>
                            <input type="text" id="firstName" name="firstName" 
                                   value="<?= htmlspecialchars($data['traveler']->fName ?? '') ?>" 
                                   maxlength="25">
                        </div>

                        <div class="row-Item">
                            <label for="lastName">Last Name:</label>
                            <input type="text" id="lastName" name="lastName" 
                                   value="<?= htmlspecialchars($data['traveler']->lName ?? '') ?>" 
                                   maxlength="25">
                        </div>

                    </div>

                    <div class="row">

                        <div class="row-Item">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" 
                                minlength="8" placeholder="Enter a new password if you want to change it">
                        </div>

                        <div class="row-Item">
                            <label for="confirmPassword">Confirm Password:</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" 
                                   minlength="8" placeholder="Confirm new password">
                        </div>

                    </div>

                    <div class="row">

                        <div class="row-Item">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" 
                                   value = "<?= htmlspecialchars($data['traveler']->travelerEmail ?? '') ?>"
                                   required>
                        </div>

                        <div class="row-Item">
                            <label for="mobileNumber">Mobile Number:</label>
                            <input type="tel" id="mobileNumber" name="mobileNumber" 
                                   value = "<?= htmlspecialchars($data['traveler']->travelerMobileNum ?? '') ?>"
                                   pattern="[0-9]{10}" title = "Please enter a valid mobile number (10 digits, can start with +94 or 0)">
                        </div>

                    </div>

                    <div class="row" style="display: block; font-size: 1.65rem;">
                        <label for="bio">Bio:</label>
                        <textarea id="bio" name="bio" maxlength="500"><?= htmlspecialchars($data['traveler']->bio ?? '') ?></textarea>
                    </div>
                </div>

                <div class="editPaymentInfo">
                    <h2>Payment Information</h2>

                    <div class="row">
                        <div class="row-Item">
                            <label for="accountNumber">Account Number:</label>
                            <input type="text" id="accountNumber" name="accountNumber" 
                                   value="<?= htmlspecialchars($data['accountDetails']->traveler_accountNum ?? '') ?>" 
                                   pattern="[0-9]+" title="Only numbers are allowed">
                        </div>

                        <div class="row-Item">
                            <label for="bankName">Bank Name:</label>
                            <select id="bankName" name="bankName" required>
                                <!-- Add all bank options, mark the selected one -->
                                <?php 
                                    $banks = [
                                        'Amana Bank', 'Bank of Ceylon', 'Commercial Bank', 
                                        'DFCC Bank', 'Hatton National Bank', 
                                        'National Development Bank', 'National Savings Bank', 
                                        'Nation Trust Bank', 'Peoples Bank', 
                                        'Sampath Bank', 'Seylan Bank'
                                    ];
                                    foreach ($banks as $bank):
                                ?>
                                <option value="<?= $bank ?>" 
                                    <?= ($data['accountDetails']->traveler_bankName ?? '') === $bank ? 'selected' : '' ?>>
                                    <?= $bank ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row-Item">
                            <label for="bankBranch">Bank Branch:</label>
                            <input type="text" id="bankBranch" name="bankBranch" 
                                   value="<?= htmlspecialchars($data['accountDetails']->traveler_bankBranch ?? '') ?>" >
                        </div>

                    </div>
                    
                </div>

                <div class="message">
                    <div class="icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    Please ensure that the bank account details you provide are accurate and up-to-date. 
                    These details will be used to process refunds if necessary. Incorrect details may result in delays or failure in refund processing, 
                    for which we cannot be held responsible.
                </div>
            </form>
        </div>

    </div>

    <!-- Pop-Up Message ------------------------------------------------------------------------------------>
    <div id="popup" class="popup-container">

        <div class="popup-content">
            <p id = "popup-text">Please fill in all required fields</p>
            <button id="closePopup">OK</button>
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

    <script>
        // Get form element
        const form = document.querySelector('form');

        // Add submit event listener to form
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting by default

            const email = document.getElementById('email');
            const mobileNumber = document.getElementById('mobileNumber');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirmPassword');

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value && !emailRegex.test(email.value)) {
                showPopup("Please enter a valid email address");
                return;
            }

            // Mobile number validation
            if (mobileNumber.value) {
                const cleanedNumber = mobileNumber.value.replace(/[+\s]/g, '');
                const mobileRegex = /^(?:94|0)?[0-9]{9}$/;
                if (!mobileRegex.test(cleanedNumber)) {
                    showPopup("Please enter a valid mobile number (10 digits, can start with +94 or 0)");
                    return;
                }
            }

            // Password validation
            if (password.value) {
                if (password.value.length < 8) {
                    showPopup("Password must be at least 8 characters long");
                    return;
                }

                if (password.value !== confirmPassword.value) {
                    showPopup("Password and Confirm Password do not match");
                    return;
                }
            }

            // If all validations pass, submit the form
            form.submit();
        });

        // Pop-up handling function
        function showPopup(message) {
            const popup = document.getElementById("popup");
            const popupText = document.getElementById("popup-text");
            const mainContainer = document.querySelector(".mainContainer");

            popupText.textContent = message;
            popup.style.display = "flex";
            mainContainer.classList.add("blur");

            // Close popup handler
            document.getElementById("closePopup").onclick = function() {
                popup.style.display = "none";
                mainContainer.classList.remove("blur");
            };
        }

    </script>


</body>

</html>