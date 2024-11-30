<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/Traveler/userLoginStyle.css">      
    <link rel = "icon" href = "<?= ROOT ?>/assets/images/logos/logoBlack.svg">        <!--paths marked for incase of folder changes-->
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Login</title>

</head>
    
<body>
    
    <div class = "container">

        <?php if (!empty($data['success'])): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($data['success']); ?>
            </div>
        <?php endif; ?>

        <div class = "leftContainer">
            <div class = "logoContainer">

            </div>

            <div class = "textContainer">
                Welcome Back!<br>
                Ready to Explore?
                
            </div>
        </div>
        
        <div class = "rightContainer">

            <div class="forrm">
                <h1 class = "heading">
                    Login to Your Account 
                </h1>

                <form method="POST" name="loginForm" action = "<?= ROOT ?>/traveler/Login">

                    <?php if (isset($_GET['error'])): ?>
                        <p class="error-message"><?= htmlspecialchars($_GET['error']) ?></p>
                    <?php endif; ?>

                    Email Address
                    <br>
                    <div class = "input-container">
                        <input type="email" name = "travelerEmail" required>
                        <i class = "fa-solid fa-envelope"></i>
                    </div>
                    
                    
                    Password
                    <br>
                    <div class = "input-container">
                        <input type="password" name = "travelerPassword" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    
    
                    User Role
                    <br>
                    <select required name = "userRole">
                        <option value="" disabled selected>Select Your Role</option>
                        <option value="traveler">Traveler</option>
                        <option value="tourGuide">Tour Guide</option>
                        <option value="eventOrganizer">Event Organizer</option>
                        <option value="travelSP">Travel Service Provider</option>
                        <option value="diningSP">Dining Service Provider</option>
                        <option value="accommodationSP">Accommodation Service Provider</option>
                        
                    </select>

                    <input class = "btn" type="submit" name = "submit" value = "Login">
                </form>

                <p>
                    Do not have an account? <a href="<?= ROOT ?>/traveler/Signup">SignUp here</a>    <!--paths marked for incase of folder changes-->
                </p>
            </div>
            
        </div>

    </div> 

    

</body>
</html>

