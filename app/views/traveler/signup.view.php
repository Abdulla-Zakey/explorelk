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
        .error-messages {
            color: red;
            list-style-type: none;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 5px;
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

                <?php if (!empty($error)): ?>
                    <ul class="error-messages">
                        <?php foreach ($error as $field => $message): ?>
                            <li><?= htmlspecialchars($message) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <form method="POST" action='<?= ROOT ?>/traveler/Signup' name="travelerSignupForm">
                    <!-- First Name -->
                    <!-- <br> -->
                    <div class="topInput-container" style="display: none;">
                        <input type="text" name="firstName" class="topInput" value = "null">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <!-- Last Name
                    <br> -->
                    <div class="topInput-container" style="display: none;">
                        <input type="text" name="lastName" class="topInput" value = "null">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    Username
                    <br>
                    <div class="topInput-container">
                        <input type="text" name="travelerUserName" class="topInput" required>
                        <i class="fa-solid fa-user"></i>
                    </div>

                    Email Address
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