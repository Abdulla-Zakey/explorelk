<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel = "stylesheet" href = "<?= ROOT ?>/assets/css/tourGuide/tourGuideSignUp.css">         <!--paths marked for incase of folder changes-->
    <link rel = "icon" href = "<?= ROOT ?>/assets/images/logos/Logo_Black.svg">            <!--paths marked for incase of folder changes-->
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Sign Up</title>
</head>
    
<body>
    
    <div class = "container">

        <div class = "leftContainer">
            <div class = "logoContainer">

            </div>

            <div class = "textContainer">

                    Let us take you on<br>
                    an unforgettable journey across<br>
                    stunning Sri Lanka  

            </div>

        </div>
        
        <div class = "rightContainer">

            <div class="forrm">
                <h1 class = "heading">
                    Create an Account 
                </h1>

                <form method="POST" name="signupForm" action="">

                    Username
                    <br>
                    <div class = "topInput-container">
                        <input type="text" name = "userName" class = "topInput">
                        <i class="fa-solid fa-user"></i>

                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['userName']?>
                            </div>
                        <?php endif;?>
                    </div>
                    
                    
                    
                    
                    Email Address
                    <br>
                    <div class = "topInput-container">
                        <input type="email" name = "email" class = "topInput">
                        <i class="fa-solid fa-envelope"></i>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['email']?>
                            </div>
                        <?php endif;?>
                    </div>
                    

                    <div class="splitInputFields">
                        <div class = "splitInputFields_left">
                            Password
                            <br>
                            <div class = "bottomInput-container">
                                <input type="password" name = "password" pattern="^\S+$" title="No spaces allowed">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['password']?>
                            </div>
                        <?php endif;?>
                            
                        </div>

                        <div class = "splitInputFields_right">
                            Confirm Password
                            <br>
                            <div class = "bottomInput-container">
                                <input type="password" name = "confirmPassword" pattern="^\S+$" title="No spaces allowed">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['confirmPassword']?>
                            </div>
                            <?php endif;?>
                            
                        </div>
                        
                    </div>
                    
                    

                    <input class = "btn" type="submit" name = "submit" value = "Create an Account">
                </form>

                <p>
                    Already have an account? <a href="<?= ROOT?>/tourGuide/C_tourGuideSignIn">Login here</a>               <!--paths marked for incase of folder changes-->
                </p>
            </div>
            
        </div>

    </div> 

    <script>
        function redirectToResults(event) {
            event.preventDefault();  // Prevent the form from submitting
            window.location.href = "userLogin.html";  // Redirect to the search result page
        }
    </script>

</body>
</html>
