<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/emailVerification.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Verification Success</title>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .success-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        
        .success-card h1 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .success-card p {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .success-icon {
            font-size: 70px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        
        .login-button {
            display: inline-block;
            /* background-color: #4CAF50; */
            background-color: darkcyan;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .login-button:hover {
            /* background-color: #3e8e41; */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-card">
            <i class="fa-solid fa-circle-check success-icon"></i>
            <h1>Email Verified Successfully!</h1>
            <p>
                Congratulations! Your email has been verified successfully.
                Your account is now active and you can start exploring Sri Lanka with us.
            </p>
            <a href="<?= ROOT ?>/traveler/Login" class="login-button">
                Login to Your Account
            </a>
        </div>
    </div>
</body>
</html>