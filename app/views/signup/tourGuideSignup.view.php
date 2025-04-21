<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="<?=ROOT?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Signup as a Tour Guide </title>
    <style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
        background-image: url("<?=ROOT?>/assets/images/tourguide/tgSignupBg.webp");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 25px;
        width: 500px;
        box-shadow: 0 0px 10px rgba(0, 0, 0, 0.5);
    }

    .error {
        color: red;
        font-size: 14px;
        margin-top: -15px;
        margin-bottom: 15px;
    }

    .headAndLogo {
        display: flex;
        width: 100%;
    }

    .headAndLogo h1 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-top: 45px;
    }

    .logo-container {
        width: 25%;
        height: 25%;
        margin-left: -30px;
    }

    .logo-container img {
        width: 100%;
    }

    .form-step {
        display: none;
        width: 100%;
    }

    .form-step.active {
        display: block;
    }

    .form-container label {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
        color: #333;
    }

    .form-container input, .form-container select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .buttons button {
        background: #002D40;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .buttons button:hover {
        background: #B3D9FF;
        color: #002D40;
    }

    .popup-container {
        font-size: 1.35rem;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

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

    .blur {
        filter: blur(5px);
        pointer-events: none;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <?php
                $name = ''; // Initialize as empty by default
            ?>

            <form id="multiStepForm" method="POST" action='<?= ROOT ?>/Signup/TourGuideSignup'>
                <!-- Global Error Display -->
                <?php if(!empty($errors['registration'])):?>
                    <div class="error" style="text-align: center; margin-bottom: 15px;">
                        <?=$errors['registration']?>
                    </div>
                <?php endif;?>

                <!-- Step 1: Personal Information -->
                <div class="form-step active">
                    <div class="headAndLogo">
                        <div class="logo-container">
                            <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                        </div>
                        <div>
                            <h1>Personal Information</h1>
                        </div>
                    </div>

                    <label for="name">Your Name</label>
                    <input id="name" name="name" type="text" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
                    <?php if(!empty($errors['name'])):?>
                        <div class="error">
                            <?=$errors['name']?>
                        </div>
                    <?php endif;?>

                    <label for="nic">National Identity Card Number</label>
                    <input id="nic" name="nic" type="text" required value="<?= isset($nic) ? htmlspecialchars($nic) : '' ?>">
                    <?php if(!empty($errors['nic'])):?>
                        <div class="error">
                            <?=$errors['nic']?>
                        </div>
                    <?php endif;?>

                    <label for="contact-number">Mobile Number</label>
                    <input id="contact-number" name="mobileNum" type="text" required value="<?= isset($mobileNum) ? htmlspecialchars($mobileNum) : '' ?>">
                    <?php if(!empty($errors['mobileNum'])):?>
                        <div class="error">
                            <?=$errors['mobileNum']?>
                        </div>
                    <?php endif;?>

                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                    <?php if(!empty($errors['email'])):?>
                        <div class="error">
                            <?=$errors['email']?>
                        </div>
                    <?php endif;?>
                </div>

                <!-- Step 2: Professional Information -->
                <div class="form-step">
                    <div class="headAndLogo">
                        <div class="logo-container">
                            <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                        </div>
                        <div>
                            <h1>Professional Information</h1>
                        </div>
                    </div>

                    <label for="licenseNum">SLTDA Guide License Number</label>
                    <input id="licenseNum" name="licenseNum" type="text" required value="<?= isset($licenseNum) ? htmlspecialchars($licenseNum) : '' ?>">
                    <?php if(!empty($errors['licenseNum'])):?>
                        <div class="error">
                            <?=$errors['licenseNum']?>
                        </div>
                    <?php endif;?>

                    <label for="experience">Years of Experience</label>
                    <input id="experience" name="experience" type="number" min="0" required value="<?= isset($experience) ? htmlspecialchars($experience) : '' ?>">
                    <?php if(!empty($errors['experience'])):?>
                        <div class="error">
                            <?=$errors['experience']?>
                        </div>
                    <?php endif;?>
   
                    <label for="fieldsOfExpertise">Fields of Expertise</label>
                    <select id="fieldsOfExpertise" name="fieldsOfExpertise" required>
                        <option value="" disabled selected>Choose an option</option>
                        <option value="Hiking">Hiking</option>
                        <option value="Wild Life">Wild Life</option>
                        <option value="Religious Pilgrimages">Religious Pilgrimages</option>
                        <option value="Water Sports and Adventure">Water Sports and Adventure</option>
                        <option value="Tea Plantation and Factory Visits">Tea Plantation and Factory Visits</option>
                    </select>
                    <?php if(!empty($errors['fieldsOfExpertise'])):?>
                        <div class="error">
                            <?=$errors['fieldsOfExpertise']?>
                        </div>
                    <?php endif;?>

                    <label for="tourFrequencyPerMonth">Tours Conducted per Month</label>
                    <input id="tourFrequencyPerMonth" name="tourFrequencyPerMonth" type="number" min="1" required value="<?= isset($tourFrequencyPerMonth) ? htmlspecialchars($tourFrequencyPerMonth) : '' ?>">
                    <?php if(!empty($errors['tourFrequencyPerMonth'])):?>
                        <div class="error">
                            <?=$errors['tourFrequencyPerMonth']?>
                        </div>
                    <?php endif;?>
                </div>

                <!-- Step 3: Login Credentials -->
                <div class="form-step">
                    <div class="headAndLogo">
                        <div class="logo-container">
                            <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                        </div>
                        <div>
                            <h1>Login Credentials</h1>
                        </div>
                    </div>
                    
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" required value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
                    <?php if(!empty($errors['username'])):?>
                        <div class="error">
                            <?=$errors['username']?>
                        </div>
                    <?php endif;?>

                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                    <?php if(!empty($errors['password'])):?>
                        <div class="error">
                            <?=$errors['password']?>
                        </div>
                    <?php endif;?>

                    <label for="confirm-password">Confirm Password</label>
                    <input id="confirm-password" name="confirmPassword" type="password" required>
                    <?php if(!empty($errors['confirmPassword'])):?>
                        <div class="error">
                            <?=$errors['confirmPassword']?>
                        </div>
                    <?php endif;?>

                    <div class="checkbox-container">
                        <div style="display:flex;">
                            <div><input type="checkbox" id="terms" required style="width: 20px; height: 20px;"></div>
                            <div style="margin-top: 5px; margin-left:10px">
                                <label for="terms">I agree to the Terms and Conditions.</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="buttons">
                    <a href="<?= ROOT ?>" style="text-decoration: none;">
                        <button type="button" id="backToHomeBtn">Back</button>
                    </a>
                    <button type="button" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="changeStep(1)">Next</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop-Up Message -->
    <div id="popup" class="popup-container">
        <div class="popup-content">
            <p id="popup-text">Please fill in all required fields</p>
            <button id="closePopup">OK</button>
        </div>
    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll(".form-step");

        function changeStep(step) {
            // Basic client-side validation before moving to next step
            let currentStepValid = step === -1 || validateCurrentStep();
    
            if (currentStepValid || step === -1) {
                steps[currentStep].classList.remove("active");
                currentStep += step;
        
                if (currentStep >= steps.length) {
                    document.getElementById("multiStepForm").submit();
                    return;
                }   
        
                steps[currentStep].classList.add("active");
                updateButtonVisibility();
            }
        }

        function validateCurrentStep() {
            let currentStepElement = steps[currentStep];
            let inputs = currentStepElement.querySelectorAll('input[required], select[required]');
            let isValid = true;
    
            // Check if all required fields are filled
            for (let input of inputs) {
                if (!input.value.trim()) {
                    showPopup("Please fill in all required fields");
                    input.focus();
                    isValid = false;
                    break;
                }
            }
    
            // Step 0 Validation (Personal Information)
            if (isValid && currentStep === 0) {
                let name = document.getElementById('name');
                let nic = document.getElementById('nic');
                let mobileNumber = document.getElementById('contact-number');
                let email = document.getElementById('email');
        
                // Name validation (at least two words)
                if (name.value.trim().split(/\s+/).length < 2) {
                    showPopup("Please enter your full name");
                    name.focus();
                    isValid = false;
                }

                // NIC validation (assume 12 digits or 9V format)
                let nicRegex = /^([0-9]{12}|[0-9]{9}[vV])$/;
                if (isValid && !nicRegex.test(nic.value.trim())) {
                    showPopup("Please enter a valid National Identity Card number");
                    nic.focus();
                    isValid = false;
                }

                // Mobile number validation
                let mobileRegex = /^(\+?94)?(0)?[0-9]{9}$/;
                if (isValid && !mobileRegex.test(mobileNumber.value.replace(/[^0-9]/g, ''))) {
                    showPopup("Please enter a valid mobile number (10 digits, can start with +94 or 0)");
                    mobileNumber.focus();
                    isValid = false;
                }

                // Email validation
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (isValid && !emailRegex.test(email.value)) {
                    showPopup("Please enter a valid email address");
                    email.focus();
                    isValid = false;
                }
            }

            // Step 1 Validation (Professional Information)
            if (isValid && currentStep === 1) {
                let licenseNum = document.getElementById('licenseNum');
                let experience = document.getElementById('experience');
                let fieldsOfExpertise = document.getElementById('fieldsOfExpertise');
                let tourFrequency = document.getElementById('tourFrequencyPerMonth');

                // License number validation (assuming some basic format)
                if (licenseNum.value.trim().length < 5) {
                    showPopup("Please enter a valid SLTDA Guide License Number");
                    licenseNum.focus();
                    isValid = false;
                }

                // Experience validation
                if (isValid && (experience.value < 0 || experience.value > 50)) {
                    showPopup("Please enter a valid number of years of experience (0-50)");
                    experience.focus();
                    isValid = false;
                }

                // Fields of Expertise validation
                if (isValid && fieldsOfExpertise.value === "") {
                    showPopup("Please select a field of expertise");
                    fieldsOfExpertise.focus();
                    isValid = false;
                }

                // Tour Frequency validation
                if (isValid && (tourFrequency.value < 1 || tourFrequency.value > 30)) {
                    showPopup("Please enter a valid number of tours per month");
                    tourFrequency.focus();
                    isValid = false;
                }
            }
            
            // Step 2 Validation (Login Credentials)
            if (isValid && currentStep === 2) {
                let username = document.getElementById('username');
                let password = document.getElementById('password');
                let confirmPassword = document.getElementById('confirm-password');
                let termsCheckbox = document.getElementById('terms');

                // Username validation
                if (username.value.trim().length < 4) {
                    showPopup("Username must be at least 4 characters long");
                    username.focus();
                    isValid = false;
                }

                // Password validation
                if (isValid && password.value.length < 8) {
                    showPopup("Password must be at least 8 characters long");
                    password.focus();
                    isValid = false;
                }

                // Confirm password validation
                if (isValid && password.value !== confirmPassword.value) {
                    showPopup("Password and Confirm Password do not match");
                    confirmPassword.focus();
                    isValid = false;
                }

                // Terms and conditions validation
                if (isValid && !termsCheckbox.checked) {
                    showPopup("Please agree to the Terms and Conditions");
                    termsCheckbox.focus();
                    isValid = false;
                }
            }
    
            return isValid;
        }

        function showPopup(message) {
            const popup = document.getElementById("popup");
            const popupText = document.getElementById("popup-text");
            const container = document.querySelector(".container");
    
            popupText.innerHTML = message;
    
            // Show the pop-up
            popup.style.display = "flex";
    
            // Blur the background
            container.classList.add("blur");
    
            // Remove any existing listeners to prevent multiple bindings
            const closePopup = document.getElementById("closePopup");

            closePopup.onclick = function() {
                // Hide the pop-up
                popup.style.display = "none";
        
                // Remove the blur effect
                container.classList.remove("blur");
            };
        }

        function updateButtonVisibility() {
            const backBtn = document.getElementById("backToHomeBtn");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");
    
            // Show back button only if on the first step
            backBtn.style.display = currentStep === 0 ? "block" : "none";

            // Show previous button only if not on the first step
            prevBtn.style.display = currentStep > 0 ? "block" : "none";
            
            // Update next/submit button text
            nextBtn.innerText = currentStep === steps.length - 1 ? "Submit" : "Next";
        }

        // Initialize button visibility
        updateButtonVisibility();
    </script>
</body>
</html>