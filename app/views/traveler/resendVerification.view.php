<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/emailVerification.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <title>ExploreLK | Resend Verification</title>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .resend-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        
        .resend-card h1 {
            color: #333;
            margin-bottom: 30px;
        }
        
        .resend-card p {
            color: #555;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .email-input {
            margin: 1rem auto;
            width: 90%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
        }
        
        .email-input:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 5px rgba(33, 150, 243, 0.3);
        }
        
        .submit-btn {
            margin: 1rem auto 0.5rem auto;
            background-color: darkcyan;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Poppins';
        }
        
        .submit-btn:hover {
            /* background-color: #0b7dda; */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        
        .back-link {
            display: block;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        
        .back-link a {
            /* color: #2196F3; */
            color: darkcyan;
            text-decoration: none;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: #F44336;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 20px;
            text-align: left;
            padding-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="resend-card">
            <h1>Resend Verification Email</h1>
            <p>
                Enter your email address below and we'll send you a new verification link.
            </p>
            
            <form method="POST" action="<?= ROOT ?>/traveler/VerifyEmail/resend">
                <input type="email" name="email" class="email-input" placeholder="Your email address" required>
                <?php if (isset($error['email'])): ?>
                    <div class="error-message">* <?= $error['email'] ?></div>
                <?php endif; ?>
                
                <button type="submit" class="submit-btn">Send Verification Link</button>
            </form>
            
            <p class="back-link">
                <a href="<?= ROOT ?>/traveler/Login">Back to Login</a>
            </p>
        </div>
    </div>
</body>
</html>