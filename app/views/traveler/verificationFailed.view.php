<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/emailVerification.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Verification Failed</title>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .failed-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        
        .failed-card h1 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .failed-card p {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .error-icon {
            font-size: 70px;
            color: #F44336;
            margin-bottom: 20px;
        }
        
        .error-message {
            color: #F44336;
            font-weight: 500;
            margin-bottom: 25px;
        }
        
        .resend-link {
            display: inline-block;
            margin-right: 15px;
            background-color: #2196F3;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .resend-link:hover {
            background-color: #0b7dda;
        }
        
        .signup-link {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .signup-link:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="failed-card">
            <i class="fa-solid fa-circle-exclamation error-icon"></i>
            <h1>Verification Failed</h1>
            <p class="error-message">
                <?= $message ?? 'There was a problem verifying your email address.' ?>
            </p>
            <p>
                This could be because your verification link has expired or is invalid.
            </p>
            <div>
                <a href="<?= ROOT ?>/traveler/VerifyEmail/resend" class="resend-link">
                    Resend Verification
                </a>
                <a href="<?= ROOT ?>/traveler/Signup" class="signup-link">
                    Sign Up Again
                </a>
            </div>
        </div>
    </div>
</body>
</html>