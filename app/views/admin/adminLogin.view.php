<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/userLoginStyle.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/logos/logoBlack.svg">
    <!--paths marked for incase of folder changes-->
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Login</title>

</head>

<body>

    <div class="container">

        <?php if (!empty($data['success'])): ?>
        <div class="success-message">
            <?php echo htmlspecialchars($data['success']); ?>
        </div>
        <?php endif; ?>

        <div class="leftContainer">
            <div class="logoContainer">

            </div>

            <div class="textContainer">
                ExploreLK<br>
                Administration Portal


            </div>
        </div>

        <div class="rightContainer">

            <div class="forrm">
                <h1 class="heading">
                    Login As an Admin
                </h1>

                <form method="POST" name="loginForm" action="<?= ROOT ?>/admin/C_adminLogin">

                    <?php if (isset($_GET['error'])): ?>
                    <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
                    <?php endif; ?>

                    Email Address
                    <?php if(isset($error['email'])): ?>
                    <br>
                    <span class="error-message">
                        <?= isset($error['email']) ? "*" . $error['email'] : ''; ?>
                    </span>
                    <?php endif; ?>
                    <br>
                    <div class="input-container">
                        <input type="email" name="adminEmail" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>


                    Password
                    <?php if(isset($error['password'])): ?>
                    <br>
                    <span class="error-message">
                        <?= isset($error['password']) ? "*" . $error['password'] : ''; ?>
                    </span>
                    <?php endif; ?>
                    <br>

                    <div class="input-container">
                        <input type="password" name="adminPassword" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>



                    <input class="btn" type="submit" name="submit" value="Login">
                </form>
            </div>

        </div>

    </div>



</body>

</html>