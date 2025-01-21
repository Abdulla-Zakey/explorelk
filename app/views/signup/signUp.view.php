<!DOCTYPE html>
<html>
<head>
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel = "icon" href = "<?=ROOT?>/assets/images/logos/logoBlack.svg">
    <title>ExploreLK | Signup as a Service Provider </title>
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
        background-image: url("<?=ROOT?>/assets/images/serviceProviders/spSignupBg2.webp");
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

            <?php
                $name = ''; // Initialize as empty by default
            ?>

            <form id="multiStepForm" method="POST" action='<?= ROOT ?>/Signup/Signup'>
                <!-- Global Error Display -->
                <?php if(!empty($errors['registration'])):?>
                    <div class="error" style="text-align: center; margin-bottom: 15px;">
                        <?=$errors['registration']?>
                    </div>
                <?php endif;?>

                <!-- Step 1 -->
                <div class="form-step active">
                    <div class="headAndLogo">
                        <div class="logo-container">
                            <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                        </div>
                        <div>
                            <h1>Service Provider Information</h1>
                        </div>
                    </div>

                    <label for="name">Your Name</label>
                    <input id="name" name="name" type="text" required value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
                    <?php if(!empty($errors['name'])):?>
                        <div class="error">
                            <?=$errors['name']?>
                        </div>
                    <?php endif;?>

                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                    <?php if(!empty($errors['email'])):?>
                        <div class="error">
                            <?=$errors['email']?>
                        </div>
                    <?php endif;?>

                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                    <?php if(!empty($errors['password'])):?>
                        <div class="error">
                            <?=$errors['password']?>
                        </div>
                    <?php endif;?>

                    <label for="confirmPassword">Confirm Password</label>
                    <input id="confirm-password" name="confirmPassword" type="password" required>
                    <?php if(!empty($errors['confirmPassword'])):?>
                        <div class="error">
                            <?=$errors['confirmPassword']?>
                        </div>
                    <?php endif;?>

                </div>

                <!-- Step 2 -->
                <div class="form-step">
                    <div class="headAndLogo">
                        <div class="logo-container">
                            <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                        </div>
                        <div>
                            <h1>Business Information</h1>
                        </div>
                    </div>

                    <label for="companyName">Company Name</label>
                    <input id="companyname" name="company_name" type="text" required value="<?= isset($company_name) ? htmlspecialchars($company_name) : '' ?>">
                    <?php if(!empty($errors['company_name'])):?>
                        <div class="error">
                            <?=$errors['company_name']?>
                        </div>
                    <?php endif;?>

                    <label for="BRNumber">Business Registration Number</label>
                    <input id="bregnumber" name="BRNum" type="text" required value="<?= isset($BRNum) ? htmlspecialchars($BRNum) : '' ?>">
                    <?php if(!empty($errors['BRNum'])):?>
                        <div class="error">
                            <?=$errors['BRNum']?>
                        </div>
                    <?php endif;?>

                    <label for="serviceType">Service Type</label>
                    <select id="service-type" name="servicetype" required>
                        <option value="none" disabled selected>Choose an option</option>
                        <option value="accommodation">Accommodation Service Provider</option>
                        <option value="dining">Dining Service Provider</option>
                        <option value="travel">Travel Service Provider</option>
                    </select>
                    <?php if(!empty($errors['servicetype'])):?>
                        <div class="error">
                            <?=$errors['servicetype']?>
                        </div>
                    <?php endif;?>

                    <label for="contactNumber">Contact Number</label>
                    <input id="contact-number" name="mobileNum" type="text" required value="<?= isset($mobileNum) ? htmlspecialchars($mobileNum) : '' ?>">
                    <?php if(!empty($errors['mobileNum'])):?>
                        <div class="error">
                            <?=$errors['mobileNum']?>
                        </div>
                    <?php endif;?>

                    <label for="address">Address</label>
                    <input id="address" name="address" type="text" required value="<?= isset($address) ? htmlspecialchars($address) : '' ?>">
                    <?php if(!empty($errors['address'])):?>
                        <div class="error">
                            <?=$errors['address']?>
                        </div>
                    <?php endif;?>
                </div>

                <!-- Step 3 -->
                <div class="form-step">
                    <div class="headAndLogo">
                        <div class="logo-container">
                            <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                        </div>
                        <div>
                            <h1>Additional Information</h1>
                        </div>
                    </div>
                    
                    <label for="district">District</label>
                    <input id="city" name="district" type="text" required value="<?= isset($district) ? htmlspecialchars($district) : '' ?>">
                    <?php if(!empty($errors['district'])):?>
                        <div class="error">
                            <?=$errors['district']?>
                        </div>
                    <?php endif;?>

                    <label for="province">Province</label>
                    <input id="province" name="province" type="text" required value="<?= isset($province) ? htmlspecialchars($province) : '' ?>">
                    <?php if(!empty($errors['province'])):?>
                        <div class="error">
                            <?=$errors['province']?>
                        </div>
                    <?php endif;?>
                        
                    <label for="year-started">Year Started</label>
                    <input id="year-started" name="yearStarted" type="text" required value="<?= isset($yearStarted) ? htmlspecialchars($yearStarted) : '' ?>">
                    <?php if(!empty($errors['yearStarted'])):?>
                        <div class="error">
                            <?=$errors['yearStarted']?>
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
                    <a href = "<?= ROOT ?>/traveler/Home" style = "text-decoration: none;">
                        <button type="button" id="backToHomeBtn" >Back</button>
                    </a>
                    <button type="button" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="changeStep(1)">Next</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pop-Up Message ------------------------------------------------------------------------------------>
    <div id="popup" class="popup-container">

        <div class="popup-content">
            <p id = "popup-text">Please fill in all required fields</p>
            <button id="closePopup">OK</button>
        </div>

    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll(".form-step");

        function changeStep(step) {
            // Basic client-side validation before moving to next step
            // let currentStepValid = validateCurrentStep();
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
                    isValid = false;
                    break;
                }
            }
    
            // If all fields are filled, do step-specific validations
            if (isValid && currentStep === 0) {
                let email = document.getElementById('email');
                let password = document.getElementById('password');
                let confirmPassword = document.getElementById('confirm-password');
        
                // Email validation
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email.value)) {
                    showPopup("Please enter a valid email address");
                    isValid = false;
                }
        
                // Password validation
                if (isValid && password.value.length < 8) {
                    showPopup("Password must be at least 8 characters long");
                    isValid = false;
                }
        
                // Confirm password validation
                if (isValid && password.value !== confirmPassword.value) {
                    showPopup("Password and Confirm Password do not match");
                    isValid = false;
                }
            }

            // Step 1 Validation (Business Information)
            if (isValid && currentStep === 1) {
                let mobileNumber = document.getElementById('contact-number');
                let serviceType = document.getElementById('service-type');

                // Mobile number validation
                // Remove any non-digit characters except +
                let cleanedNumber = mobileNumber.value.replace(/[^0-9+]/g, '');

                // Validate mobile number format
                let mobileRegex = /^(\+?94)?(0)?[0-9]{9}$/;
                if (!mobileRegex.test(cleanedNumber)) {
                    showPopup("Please enter a valid mobile number (10 digits, can start with +94 or 0)");
                    isValid = false;
                }
        
                // Service type validation
                if (serviceType.value === 'none') {
                    showPopup("Please select a service type");
                    isValid = false;
                }
            } 
            
            // Step 2 Validation (Additional Information)
            if (isValid && currentStep === 2) {
                let termsCheckbox = document.getElementById('terms');
        
                // Check if terms checkbox is checked
                if (!termsCheckbox.checked) {
                    showPopup("Please agree to the Terms and Conditions");
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
    
            // Show back button only if not on the first step
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