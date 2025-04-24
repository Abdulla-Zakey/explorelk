<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/emailVerification.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Email Verification</title>

    <style>
       

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .verification-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .verification-card h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .verification-card p {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .email-icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .resend-link {
            display: inline-block;
            margin-top: 20px;
            color: #2196F3;
            text-decoration: none;
        }

        .resend-link:hover {
            text-decoration: underline;
        }

        .login-link {
            display: block;
            margin-top: 30px;
            color: #666;
        }

        .login-link a {
            color: #2196F3;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="verification-card">
            <i class="fa-solid fa-envelope-circle-check email-icon"></i>
            <h1>Verify Your Email</h1>
            <p>
                Thank you for signing up! We've sent a verification link to your email address.
                Please check your inbox and click on the link to verify your account.
            </p>
            <p>
                If you don't see the email, please check your spam folder.
            </p>
            <a href="<?= ROOT ?>/traveler/VerifyEmail/resend" class="resend-link">
                Didn't receive an email? Resend verification link
            </a>
            <p class="login-link">
                Already verified? <a href="<?= ROOT ?>/traveler/Login">Login here</a>
            </p>
        </div>
    </div>
</body>

</html>