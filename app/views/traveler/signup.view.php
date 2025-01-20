<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/userSignupStyle.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Sign Up</title>

    <style>

        .error-message {
            color: red;
            font-size: 13px;
            padding: 0;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 1);
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="leftContainer">
            <div class="logoContainer"></div>
            <div class="textContainer">
                Let us take you on<br>
                an unforgettable journey across<br>
                stunning Sri Lanka
            </div>
        </div>

        <div class="rightContainer">
            <div class="forrm">

                <h1 class="heading">
                    Create an Account
                </h1>

                <form method="POST" action='<?= ROOT ?>/traveler/Signup' name="travelerSignupForm">
                    <!-- First Name -->
                    <!-- <br> -->
                    <div class="topInput-container" style="display: none;">
                        <input type="text" name="firstName" class="topInput" value = "">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <!-- Last Name
                    <br> -->
                    <div class="topInput-container" style="display: none;">
                        <input type="text" name="lastName" class="topInput" value = "">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <!--This is to display username related error messages -->
                    <label for="travelerUserName">
                        Username 
                        <span class="error-message">
                            <?= isset($error['username']) ? "*" . htmlspecialchars($error['username']) : ''; ?>
                        </span>
                    </label>
                    <br>
                    <div class="topInput-container">
                        <input type="text" name="travelerUserName" class="topInput" required>
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <!--This is to display email related error messages -->
                    <label for="travelerEmail">
                        Email Address
                        <span class="error-message">
                            <?= isset($error['travelerEmail']) ? "*" . $error['travelerEmail'] : ''; ?>
                        </span>
                    </label>
                    <br>
                    <div class="topInput-container">
                        <input type="email" name="travelerEmail" class="topInput" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <!-- Home District
                    <br> -->
                    <div class="topInput-container" style="display: none;">
                        <input type="text" name="homeDistrict" class="topInput" value = "null">
                        <i class="fa-solid fa-map-marker-alt"></i>
                    </div>

                    <!-- Travel Preferences
                    <br> -->
                    <div class="topInput-container" style="display: none;">
                        <input type="text" name="travelPreferences" class="topInput" value = "null">
                        <i class="fa-solid fa-compass"></i>
                    </div>

                    <!--This is to display password related error messages -->
                    <span class="error-message">
                            <?= isset($error['travelerPassword']) ? "*" . $error['travelerPassword'] : ''; ?>
                    </span>
                    
                    <!--This is to display confirm password related error messages -->
                    <span class="error-message">
                            <?= isset($error['confirmPassword']) ? "*" . $error['confirmPassword'] : ''; ?>
                    </span>

                    <div class="splitInputFields">
                        <div class="splitInputFields_left">
                            Password
                            <br>
                            <div class="bottomInput-container">
                                <input type="password" name="travelerPassword" required>
                                <i class="fa-solid fa-lock"></i>
                            </div>
                        </div>

                        <div class="splitInputFields_right">
                            Confirm Password
                            <br>
                            <div class="bottomInput-container">
                                <input type="password" name="confirmTravelerPassword" required>
                                <i class="fa-solid fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <input class="btn" type="submit" name="travelerSignupButton" value="Create an Account">
                </form>

                <p>
                    Already have an account? <a href="<?= ROOT ?>/traveler/Login">Login here</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>