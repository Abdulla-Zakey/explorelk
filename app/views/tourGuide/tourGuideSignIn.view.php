<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/tourGuide/tourGuideSignIn.css">      <!--paths marked for incase of folder changes-->
    <link rel = "icon" href = "<?= ROOT ?>/assets/images/logos/Logo_Black.svg">        <!--paths marked for incase of folder changes-->
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Login</title>
</head>
    
<body>
    
    <div class = "container">

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

                <form method="POST" name="loginForm" action="">
                    Email Address
                    <br>
                    <div class = "input-container">
                        <input type="text" name = "email" required>
                        <i class = "fa-solid fa-envelope"></i>
                    </div>
                    
                    
                    Password
                    <br>
                    <div class = "input-container">
                        <input type="password" name = "password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <input class = "btn" type="submit" name = "submit" value = "Login">
                </form>

                <p>
                    Do not have an account? <a href="<?= ROOT ?>/tourGuide/C_tourGuideSignUp">SignUp here</a>    <!--paths marked for incase of folder changes-->
                </p>
            </div>
            
        </div>

    </div> 

    <script>
        function redirectToResults(event) {
            event.preventDefault();  // Prevent the form from submitting
            window.location.href = "regiteredUser.html";  // Redirect to the search result page
        }
    </script>

</body>
</html>

