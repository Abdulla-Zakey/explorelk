<html>
<head>
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel = "icon" href = "<?=ROOT?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Signup as an Event Organizer</title>
    <style>
        body, html  {
            font-family: 'Poppins', sans-serif;
            background-image: url("<?php echo ROOT; ?>/assets/images/eo/eoSignupBg.webp");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            overflow: hidden;
        } 
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 30px;
            width: 800px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            
        }

        .heading{
            width: 200%;
            
        }
        .form-container h1 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            
            
        }
        .form-container form {
            width: 50%;
        }
        .form-container form label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .form-container form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-bottom: 2px solid #333;
            font-size: 16px;
            color: #333;
            background: transparent;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 10px;
        }
        .logo {
            position: absolute;
            top: 15px;
            right: 280px;
        }
        button {
            align-items: center;
            background-color: #001F3F;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px 0px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }
        button:hover {
            background-color: #B3D9FF;
            color:#001F3F;
        }

         /* Pop-up container (initially hidden) */
        .popup-container {
            font-size: 1.35rem;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Dark transparent overlay */
            display: none; /* Initially hidden */
            justify-content: center;
            align-items: center;
            z-index: 999; /* Above other content */
        }

        /* Pop-up content */
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            font-size: 16px;
        }

        /* Close button */
        .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-content button:hover {
            background-color: #0056b3;
        }

        /* Blur background effect when pop-up is visible */
        .blur {
            filter: blur(5px);
            pointer-events: none;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="form-container">
            <form id="eventOrganizerForm" method="post" action="<?php echo ROOT; ?>/eventorganizer/Eosignup">
                <div class = "heading">
                    <h1>
                        Event Organizer Information
                    </h1>   
                </div>

                <?php if(!empty($error)): ?>
                    <div class="error-container">
                        <?php foreach($error as $field => $message): ?>
                            <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <label for="companyname">
                    Company Name
                </label>
                <input id="companyname" name="company_Name" type="text" required value="<?php echo htmlspecialchars($data['company_Name'] ?? ''); ?>"/>

                <label for="companyemail">
                    Company Email
                </label>
                <input id="companyemail" name="company_Email" type="email" required value="<?php echo htmlspecialchars($data['company_Email'] ?? ''); ?>"/>

                <label for="contact-number">
                    Contact Number
                </label>
                <input id="contact-number" name="company_MobileNum" type="text" required value="<?php echo htmlspecialchars($data['company_MobileNum'] ?? ''); ?>"/>

                <label for="companyaddress">
                    Company Address
                </label>
                <input id="companyaddress" name="company_Address" type="text" required value="<?php echo htmlspecialchars($data['company_Address'] ?? ''); ?>"/>

                <label for="password">
                    Password
                </label>
                <input id="password" name="company_Password" type="password" required minlength="8" />

                <label for="confirm-password">
                    Confirm Password
                </label>
                <input id="confirm-password" name="confirm_Password" type="password" required minlength="8"/>

                <button type="submit" onclick = "validate()">Register as Event Organizer</button>
            </form>
            <div class="image-container">
                <img alt="Cartoon image of a man and two children" height="400" src="<?php echo ROOT; ?>/assets/images/eo/Events-amico.png" width="500"/>
            </div>
        </div>
    </div>

    <!-- Pop-Up Message ------------------------------------------------------------------------------------>
    <div id="popup" class="popup-container">

        <div class="popup-content">
            <p id = "popup-text">Please fill in all required fields</p>
            <button id="closePopup">OK</button>
        </div>

    </div>



 </body>
</html>