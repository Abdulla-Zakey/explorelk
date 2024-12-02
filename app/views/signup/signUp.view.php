<!DOCTYPE html>
<html>

<head>
    <title>Service Provider Information</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
        background-image: url("<?=ROOT?>/assets/images/serviceProviders/spbg.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        width: 100%;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 25px;
        width: 500px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .form-container h1 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px; /* Adds spacing between the logo and the text */
    }

    .form-container h1 .logo {
        width: 100px; /* Adjust the width as needed */
        height: 100px; /* Adjust the height as needed */
        object-fit: contain; /* Ensures the logo maintains its aspect ratio */
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

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
    }

    .pagination .dot {
        height: 10px;
        width: 10px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        margin: 0 5px;
    }

    .pagination .dot.active {
        background-color: #002D40;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form id="multiStepForm" method="POST" action="<?=ROOT?>/Signup/SignUp/submit">
                <!-- Step 1 -->
                <div class="form-step active">
                    <h1>
                        Service Provider Informations
                        <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                    </h1>

                    <label for="name">Your Name</label>
                    <div>
                        <input id="name" name="name" type="text" required>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['name']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="email">Email</label>
                    <div>
                        <input id="email" name="email" type="email" required>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['email']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="password">Password</label>
                    <div>
                        <input id="password" name="password" type="password" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['password']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="confirmPassword">Confirm Password</label>
                    <div>
                        <input id="confirm-password" name="confirmPassword" type="password" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['confirmPassword']?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="form-step">
                    <h1>
                        Business Informations
                        <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                    </h1>

                    <label for="companyName">Company Name</label>
                    <div>
                        <input id="companyname" name="company_name" type="text" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['company_name']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="BRNumber">Business Registration Number</label>
                    <div>
                        <input id="bregnumber" name="BRNum" type="text" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['BRNum']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="serviceType">Service Type</label>
                    <div>
                        <select id="service-type" name="servicetype" required>
                            <option value="none" disabled selected>Choose an option</option>
                            <option value="hotels">Hotels</option>
                            <option value="restaurants">Restaurants</option>
                            <option value="travelagent">Travel Agent</option>
                            <option value="tourguide">Tour Guide</option>
                        </select>

                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['serviceType']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="contactNumber">Contact Number</label>
                    <div>
                        <input id="contact-number" name="mobileNum" type="text" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['mobileNum']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="address">Address</label>
                    <div>
                        <input id="address" name="address" type="text" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['address']?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="form-step">
                    <h1>
                        Other Informations
                        <img alt="ExploreLK logo" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" class="logo"/>
                    </h1>
                    
                    <label for="district">District</label>
                    <div>
                        <input id="city" name="district" type="text" required/>
                        <?php if(!empty($errors)):?>
                            <div>
                                <?=$errors['district']?>
                            </div>
                        <?php endif;?>
                    </div>

                    <label for="province">Province</label>
                    <div>
                        <input id="province" name="province" type="text" required/>
                    </div>
                        
                    <label for="year-started">Year Started</label>
                    <div>
                        <input id="year-started" name="yearStarted" type="text" required/>
                    </div>

                    <div class="checkbox-container">
                        <div style="display:flex;">
                            <div style="margin-top:2.5px"><input type="checkbox" id="terms" required /></div>
                            <div style="margin-left:10px"><label for="terms">I agree to the Terms and Conditions.</label></div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="buttons">
                    <button type="button" id="prevBtn" onclick="changeStep(-1)">Previous</button>
                    <button type="submit" id="nextBtn" onclick="changeStep(1)">Next</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let currentStep = 0;
    const steps = document.querySelectorAll(".form-step");

    function changeStep(step) {
        steps[currentStep].classList.remove("active");
        currentStep += step;
        if (currentStep >= steps.length) {
            document.getElementById("multiStepForm").submit();
            return;
        }
        steps[currentStep].classList.add("active");
    }

    // Initialize step buttons
    document.getElementById("prevBtn").style.display = "none";
    document.addEventListener("click", () => {
        document.getElementById("prevBtn").style.display = currentStep > 0 ? "block" : "none";
        document.getElementById("nextBtn").innerText = currentStep === steps.length - 1 ? "Submit" : "Next";
    });
    </script>
</body>

</html>