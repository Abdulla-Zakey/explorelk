<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="<?=ROOT?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Signup as an Event Organizer</title>
    <style>
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #1d4ed8;
            --secondary-color: #f97316;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --background-light: #f8fafc;
            --white: #ffffff;
            --error: #ef4444;
            --success: #10b981;
            --border-radius: 12px;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--background-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-image: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(249, 115, 22, 0.2) 100%);
        }

        .register-container {
            width: 100%;
            max-width: 1200px;
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: var(--shadow-lg);
        }

        .form-side {
            padding: 40px;
            position: relative;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .form-header h1 {
            font-size: 28px;
            color: var(--text-dark);
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-header p {
            color: var(--text-light);
            font-size: 16px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: var(--text-dark);
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            color: var(--text-dark);
            background-color: var(--white);
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .input-group input::placeholder {
            color: #a0aec0;
        }

        .error-container {
            background-color: rgba(239, 68, 68, 0.1);
            border-left: 4px solid var(--error);
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 24px;
        }

        .error-message {
            color: var(--error);
            font-size: 14px;
            margin-bottom: 4px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .image-side {
            background-color: var(--primary-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 40px;
            color: var(--white);
            text-align: center;
        }

        .image-side::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(circle at 20% 25%, rgba(29, 78, 216, 0.4) 0%, transparent 50%),
                              radial-gradient(circle at 80% 75%, rgba(249, 115, 22, 0.4) 0%, transparent 50%);
        }

        .image-side img {
            width: 80%;
            max-width: 400px;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 10px 8px rgba(0, 0, 0, 0.04)) drop-shadow(0 4px 3px rgba(0, 0, 0, 0.1));
            margin-bottom: 30px;
        }

        .image-side h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .image-side p {
            font-size: 16px;
            opacity: 0.9;
            max-width: 80%;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .feature-item i {
            font-size: 18px;
            color: #eee;
        }

        /* Popup styles */
        .popup-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
            backdrop-filter: blur(5px);
        }

        .popup-content {
            background: var(--white);
            padding: 30px;
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: var(--shadow-lg);
            max-width: 400px;
            width: 90%;
            animation: popupFadeIn 0.3s ease;
        }

        .popup-content.success {
            border-top: 4px solid var(--success);
        }

        .popup-content.error {
            border-top: 4px solid var(--error);
        }

        @keyframes popupFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .popup-content h2 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .popup-content.success h2 {
            color: var(--success);
        }

        .popup-content.error h2 {
            color: var(--error);
        }

        .popup-content p {
            font-size: 16px;
            margin-bottom: 20px;
            color: var(--text-dark);
        }

        .popup-btn {
            padding: 12px 24px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .popup-btn:hover {
            background: var(--primary-dark);
        }

        .back-home {
            display: inline-block;
            position: absolute;
            top: 25px;
            left: 25px;
            color: white;
            font-size: 14px;
            text-decoration: none;
            padding: 7px 15px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .back-home:hover {
            background-color: rgba(0, 0, 0, 0.5);
            text-decoration: none;
        }

        .back-home i {
            margin-right: 5px;
        }

        /* Responsive styles */
        @media (max-width: 900px) {
            .register-container {
                grid-template-columns: 1fr;
            }

            .image-side {
                display: none;
            }
        }

        @media (max-width: 600px) {
            .form-side {
                padding: 30px 20px;
            }

            .form-header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="image-side">
            <a href="<?= ROOT ?>" class="back-home">
                <i class="fa-solid fa-home"></i> Back to Home
            </a>
            <img src="<?php echo ROOT; ?>/assets/images/eo/Events-amico.png" alt="Event illustration">
            <h2>Organize Amazing Events</h2>
            <p>Join ExploreLK and showcase your events to thousands of potential attendees</p>
            <div class="features">
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Easy event management</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Reach wider audiences</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Analytics and insights</span>
                </div>
            </div>
        </div>
        <div class="form-side">
            <div class="form-header">
                <h1>Event Organizer Registration</h1>
                <p>Create your account to start hosting amazing events</p>
            </div>
            <form id="eventOrganizerForm" method="post" action="<?php echo ROOT; ?>/eventorganizer/Eosignup">
                <?php if (!empty($error)): ?>
                    <div class="error-container">
                        <?php foreach ($error as $field => $message): ?>
                            <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <label for="companyname">Company Name</label>
                    <input 
                        id="companyname" 
                        name="company_Name" 
                        type="text" 
                        required 
                        value="<?php echo htmlspecialchars($data['company_Name'] ?? ''); ?>"
                        placeholder="Enter your company name"
                    />
                </div>
                <div class="input-group">
                    <label for="companyemail">Company Email</label>
                    <input 
                        id="companyemail" 
                        name="company_Email" 
                        type="email" 
                        required 
                        value="<?php echo htmlspecialchars($data['company_Email'] ?? ''); ?>"
                        placeholder="Enter your company email"
                    />
                </div>
                <div class="input-group">
                    <label for="contact-number">Contact Number</label>
                    <input 
                        id="contact-number" 
                        name="company_MobileNum" 
                        type="text" 
                        required 
                        pattern="\d{10}"
                        value="<?php echo htmlspecialchars($data['company_MobileNum'] ?? ''); ?>"
                        placeholder="Enter your 10-digit mobile number"
                        title="Mobile number must be exactly 10 digits"
                    />
                </div>
                <div class="input-group">
                    <label for="companyaddress">Company Address</label>
                    <input 
                        id="companyaddress" 
                        name="company_Address" 
                        type="text" 
                        required 
                        value="<?php echo htmlspecialchars($data['company_Address'] ?? ''); ?>"
                        placeholder="Enter your company address"
                    />
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input 
                        id="password" 
                        name="company_Password" 
                        type="password" 
                        required 
                        minlength="8"
                        placeholder="Create a password (min. 8 characters)"
                    />
                </div>
                <div class="input-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input 
                        id="confirm-password" 
                        name="confirm_Password" 
                        type="password" 
                        required 
                        minlength="8"
                        placeholder="Confirm your password"
                    />
                </div>
                <button type="submit" class="submit-btn" onclick="return validate()">
                    <i class="fas fa-user-plus"></i> Register as an Event Organizer
                </button>
            </form>
        </div>
    </div>
    <!-- Pop-Up Message -->
    <div id="popup" class="popup-container">
        <div class="popup-content" id="popup-content">
            <h2 id="popup-title"></h2>
            <p id="popup-text"></p>
            <button id="closePopup" class="popup-btn">OK</button>
        </div>
    </div>
    <script>
        // Validation function
        function validate() {
            const form = document.getElementById('eventOrganizerForm');
            const inputs = form.querySelectorAll('input[required]');
            const mobileNumber = document.getElementById('contact-number');
            let isValid = true;

            // Check if all required fields are filled
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = '#ef4444';
                } else {
                    input.style.borderColor = '#e2e8f0';
                }
            });

            // Validate mobile number (exactly 10 digits)
            if (!/^\d{10}$/.test(mobileNumber.value.trim())) {
                isValid = false;
                mobileNumber.style.borderColor = '#ef4444';
                showPopup('Mobile number must be exactly 10 digits', 'Error', 'error');
                return false;
            }

            // Check if passwords match
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');
            if (password.value !== confirmPassword.value) {
                isValid = false;
                confirmPassword.style.borderColor = '#ef4444';
                showPopup('Passwords do not match', 'Error', 'error');
                return false;
            }

            if (!isValid) {
                showPopup('Please fill in all required fields correctly', 'Error', 'error');
                return false;
            }

            return true;
        }

        // Show popup function
        function showPopup(message, title = 'Error', type = 'error') {
            const popup = document.getElementById('popup');
            const popupContent = document.getElementById('popup-content');
            const popupTitle = document.getElementById('popup-title');
            const popupText = document.getElementById('popup-text');
            popupTitle.textContent = title;
            popupText.textContent = message;
            popupContent.className = `popup-content ${type}`;
            popup.style.display = 'flex';
        }

        // Close popup
        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

        // Check for success message from PHP
        <?php if (isset($success) && $success): ?>
            showPopup('Your account has been created successfully. Redirecting to dashboard...', 'Success', 'success');
            setTimeout(function() {
                window.location.href = '<?php echo ROOT; ?>/eventorganizer/eodashboard';
            }, 3000);
        <?php endif; ?>

        // Check for specific errors from PHP
        <?php if (isset($error['company_Email'])): ?>
            showPopup('<?php echo htmlspecialchars($error['company_Email']); ?>', 'Error', 'error');
        <?php elseif (isset($error['company_MobileNum'])): ?>
            showPopup('<?php echo htmlspecialchars($error['company_MobileNum']); ?>', 'Error', 'error');
        <?php elseif (!empty($error)): ?>
            showPopup('Please check your input and try again', 'Error', 'error');
        <?php endif; ?>
    </script>
</body>
</html>