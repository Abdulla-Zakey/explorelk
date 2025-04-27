<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/settings.css">
    <title>My Account</title>

</head>

<body>

    <main>
        <div class="container">
            <h1>My Account</h1>
            <form id="accountForm" action="<?= ROOT ?>/Hotel/Hsettings/update" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profilePicture">Upload logo</label>
                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="hotel-photos">Upload hotel photos</label>
                    <input type="file" id="hotel-photos" name="hotel-photos[]" accept="image/*" multiple>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="hotel-name">Hotel name</label>
                        <input type="text" id="hotel-name" name="hotel-name" placeholder="Please enter your hotel name"
                            value="<?= $data['hotelBasic']->hotelName ?>" readonly>
                        <div class="error" id="hotel-name-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Please enter your email"
                            value="<?= $data['hotelBasic']->hotelEmail ?>" readonly>
                        <div class="error" id="email-error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="owner-name">Owner name</label>
                        <input type="text" id="owner-name" name="owner-name" placeholder="Please enter your name"
                            value="<?= $data['hotelBasic']->serviceProviderName ?>" readonly>
                        <div class="error" id="owner-name-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="phone-number">Phone number</label>
                        <input type="text" id="phone-number" name="phone-number"
                            placeholder="+94 Please enter your phone number"
                            value="<?= $data['hotelBasic']->hotelMobileNum ?>" readonly>
                        <div class="error" id="phone-number-error"></div>
                    </div>

                    <label for="address-line-1">Address</label>
                    <input type="text" id="address-line-1" name="address-line-1" placeholder="Address Line 1"
                        value="<?= $data['hotelBasic']->hotelAddress ?>" readonly>
                    <div class="error" id="address-line-1-error"></div>
                </div>

                <div class="form-group">
                    <div class="half-width">
                        <label for="district">District</label>
                        <input type="text" id="district" name="district" placeholder="Please enter your district"
                            value="<?= $data['hotelBasic']->district ?>" readonly>
                        <div class="error" id="district-error"></div>
                    </div>

                    <div class="half-width">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" placeholder="Please enter your Province"
                            value="<?= $data['hotelBasic']->province ?>" readonly>
                        <div class="error" id="province-error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description1" name="description[0]" placeholder="Write about your Hotel"
                        readonly><?= htmlspecialchars($data['hotelBasic']->description_para1) ?></textarea>
                    <div class="error" id="description-error1"></div>
                    <textarea id="description2" name="description[1]" placeholder="Write about your Hotel"
                        readonly><?= htmlspecialchars($data['hotelBasic']->description_para2) ?></textarea>
                    <div class="error" id="description-error2"></div>
                    <textarea id="description3" name="description[2]" placeholder="Write about your Hotel"
                        readonly><?= htmlspecialchars($data['hotelBasic']->description_para3) ?></textarea>
                    <div class="error" id="description-error3"></div>
                </div>
                <div class="buttons">
                    <button type="button" id="edit-btn" class="update-profile" onclick="enableEditing()">Edit
                        Profile</button>

                    <button type="submit" id="update-btn" class="update-profile" style="display: none;">Update
                        Profile</button>

                </div>
            </form>
        </div>
        <!-- Popup container -->
        <!-- <div id="popup" class="popup">
  <div class="popup-content">
    <span class="close-btn" id="close-popup">&times;</span>
    <h2>Profile Updated</h2>
    <p>Your profile has been updated successfully!</p>
    <button type="button" id="close-popup-btn" class="ok-btn">OK</button>
  </div>
</div> -->
    </main>

    <script>
    function enableEditing() {
        // Enable all inputs and textareas except file inputs
        let inputs = document.querySelectorAll("input:not([type='file']), textarea");
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });

        // Enable file inputs
        let fileInputs = document.querySelectorAll("input[type='file']");
        fileInputs.forEach(input => {
            input.disabled = false;
        });

        // Show Update button and hide Edit button
        document.getElementById("update-btn").style.display = "inline-block";
        document.getElementById("edit-btn").style.display = "none";
    }

    // Form validation
    document.getElementById('accountForm').addEventListener('submit', function(e) {
        let isValid = true;

        // Validate hotel name
        const hotelName = document.getElementById('hotel-name').value.trim();
        if (hotelName === '') {
            document.getElementById('hotel-name-error').textContent = 'Hotel name is required';
            isValid = false;
        } else {
            document.getElementById('hotel-name-error').textContent = '';
        }

        // Validate email
        const email = document.getElementById('email').value.trim();
        if (email === '') {
            document.getElementById('email-error').textContent = 'Email is required';
            isValid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            document.getElementById('email-error').textContent = 'Please enter a valid email';
            isValid = false;
        } else {
            document.getElementById('email-error').textContent = '';
        }

        // Validate owner name
        const ownerName = document.getElementById('owner-name').value.trim();
        if (ownerName === '') {
            document.getElementById('owner-name-error').textContent = 'Owner name is required';
            isValid = false;
        } else {
            document.getElementById('owner-name-error').textContent = '';
        }

        // Validate phone number
        const phoneNumber = document.getElementById('phone-number').value.trim();
        if (phoneNumber === '') {
            document.getElementById('phone-number-error').textContent = 'Phone number is required';
            isValid = false;
        } else {
            document.getElementById('phone-number-error').textContent = '';
        }

        // Validate address
        const address = document.getElementById('address-line-1').value.trim();
        if (address === '') {
            document.getElementById('address-line-1-error').textContent = 'Address is required';
            isValid = false;
        } else {
            document.getElementById('address-line-1-error').textContent = '';
        }

        // Validate district
        const district = document.getElementById('district').value.trim();
        if (district === '') {
            document.getElementById('district-error').textContent = 'District is required';
            isValid = false;
        } else {
            document.getElementById('district-error').textContent = '';
        }

        // Validate province
        const province = document.getElementById('province').value.trim();
        if (province === '') {
            document.getElementById('province-error').textContent = 'Province is required';
            isValid = false;
        } else {
            document.getElementById('province-error').textContent = '';
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function enableEditing() {
        // Enable all inputs and textareas except file inputs
        let inputs = document.querySelectorAll("input:not([type='file']), textarea");
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });

        // Show Update button and hide Edit button
        document.getElementById("update-btn").style.display = "inline-block";
        document.getElementById("edit-btn").style.display = "none";
    }

    function showPopup(message) {
        document.getElementById("popup-message").innerText = message;
        document.getElementById("popup").style.display = "block";
    }

    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }

    // Add this to debug if session messages are being received
    console.log("Success message: <?= isset($_SESSION['success']) ? $_SESSION['success'] : 'None' ?>");
    console.log("Error message: <?= isset($_SESSION['error']) ? $_SESSION['error'] : 'None' ?>");

    // Display saved popup messages
    <?php if(isset($_SESSION['success'])): ?>
    showPopup("<?= $_SESSION['success'] ?>");
    <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
    showPopup("<?= $_SESSION['error'] ?>");
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    //     document.getElementById("update-btn").addEventListener("click", function(event) {
    //     event.preventDefault();
    //     document.getElementById("popup").style.display = "block";
    //   });

    //   document.getElementById("close-popup").addEventListener("click", function() {
    //     document.getElementById("popup").style.display = "none";
    //   });

    //   document.getElementById("close-popup-btn").addEventListener("click", function() {
    //   document.getElementById("popup").style.display = "none";
    // });

    //   // Optional: close popup if clicking outside the popup-content
    //   window.addEventListener("click", function(event) {
    //     const popup = document.getElementById("popup");
    //     if (event.target === popup) {
    //       popup.style.display = "none";
    //     }
    //   });
    </script>


</body>

</html>