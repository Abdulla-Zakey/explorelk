<?php
include_once APPROOT.'/views/travelagent/nav.php';
include_once APPROOT.'/views/travelagent/travelagenthead.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/travelagent/settings.css">
    <title>My Account</title>
</head>
<body>
    <main>
        <div class="container">
            <h1>My Account</h1>

            <!-- Popup for messages -->
            <div id="popup" class="popup" style="display: none;">
                <div class="popup-content">
                    <span class="close-btn" id="close-popup">×</span>
                    <h2>Notification</h2>
                    <p id="popup-message"></p>
                    <button type="button" id="close-popup-btn" class="ok-btn">OK</button>
                </div>
            </div>

            <form id="accountForm" action="<?= ROOT ?>/TravelAgent/Tsettings/update" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile-photo">Upload logo</label>
                    <input type="file" id="profile-photo" name="profile-photo" accept="image/*">
                    <?php if (!empty($data['travelagentBasic']->profile_picture)): ?>
                        <div class="current-image">
                            <p>Current logo:</p>
                            <img src="<?= ROOT ?>/<?= htmlspecialchars($data['travelagentBasic']->profile_picture) ?>" alt="Current logo" style="max-width: 100px;">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="travelagent-photos">Upload travel agent photos</label>
                    <input type="file" id="travelagent-photos" name="travelagent-photos[]" accept="image/*" multiple>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="travelagent-name">Travel agent name</label>
                        <input type="text" id="travelagent-name" name="travelagent-name" placeholder="Enter travel agent name" value="<?= htmlspecialchars($data['travelagentBasic']->travelagentName ?? '') ?>" readonly>
                        <div class="error" id="travelagent-name-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars($data['travelagentBasic']->travelagentEmail ?? '') ?>" readonly>
                        <div class="error" id="email-error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="owner-name">Owner name</label>
                        <input type="text" id="owner-name" name="owner-name" placeholder="Enter owner name" value="<?= htmlspecialchars($data['travelagentBasic']->serviceProviderName ?? '') ?>" readonly>
                        <div class="error" id="owner-name-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="phone-number">Phone number</label>
                        <input type="text" id="phone-number" name="phone-number" placeholder="+94 Enter phone number" value="<?= htmlspecialchars($data['travelagentBasic']->travelagentMobileNum ?? '') ?>" readonly>
                        <div class="error" id="phone-number-error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address-line-1">Address</label>
                    <input type="text" id="address-line-1" name="address-line-1" placeholder="Enter address" value="<?= htmlspecialchars($data['travelagentBasic']->travelagentAddress ?? '') ?>" readonly>
                    <div class="error" id="address-line-1-error"></div>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="district">District</label>
                        <input type="text" id="district" name="district" placeholder="Enter district" value="<?= htmlspecialchars($data['travelagentBasic']->district ?? '') ?>" readonly>
                        <div class="error" id="district-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" placeholder="Enter province" value="<?= htmlspecialchars($data['travelagentBasic']->province ?? '') ?>" readonly>
                        <div class="error" id="province-error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description1" name="description[0]" placeholder="Write about your travel agent" readonly><?= htmlspecialchars($data['travelagentBasic']->description_para1 ?? '') ?></textarea>
                    <div class="error" id="description-error1"></div>
                    <!-- <textarea id="description2" name="description[1]" placeholder="Additional description (optional)" readonly><?= htmlspecialchars($data['travelagentBasic']->description_para2 ?? '') ?></textarea>
                    <div class="error" id="description-error2"></div>
                    <textarea id="description3" name="description[2]" placeholder="Additional description (optional)" readonly><?= htmlspecialchars($data['travelagentBasic']->description_para3 ?? '') ?></textarea>
                    <div class="error" id="description-error3"></div> -->
                </div>
                <div class="buttons">
                    <button type="button" id="edit-btn" class="update-profile" onclick="enableEditing()">Edit Profile</button>
                    <button type="submit" id="update-btn" class="update-profile" style="display: none;">Update Profile</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function enableEditing() {
            document.querySelectorAll("input:not([type='file']), textarea").forEach(input => {
                input.removeAttribute("readonly");
            });
            document.getElementById("update-btn").style.display = "inline-block";
            document.getElementById("edit-btn").style.display = "none";
        }

        document.getElementById('accountForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Validate travel agent name
            const travelagentName = document.getElementById('travelagent-name').value.trim();
            if (travelagentName === '') {
                document.getElementById('travelagent-name-error').textContent = 'Travel agent name is required';
                isValid = false;
            } else if (travelagentName.length < 2) {
                document.getElementById('travelagent-name-error').textContent = 'Name must be at least 2 characters';
                isValid = false;
            } else {
                document.getElementById('travelagent-name-error').textContent = '';
            }

            // Validate email
            const email = document.getElementById('email').value.trim();
            if (email === '') {
                document.getElementById('email-error').textContent = 'Email is required';
                isValid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                document.getElementById('email-error').textContent = 'Invalid email format';
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
            } else if (!/^\+?\d{10,15}$/.test(phoneNumber)) {
                document.getElementById('phone-number-error').textContent = 'Invalid phone number';
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

            // Validate description
            const description1 = document.getElementById('description1').value.trim();
            if (description1 === '') {
                document.getElementById('description-error1').textContent = 'First description is required';
                isValid = false;
            } else {
                document.getElementById('description-error1').textContent = '';
            }

            if (!isValid) {
                e.preventDefault();
            }
        });

        function showPopup(message) {
            document.getElementById("popup-message").innerText = message;
            document.getElementById("popup").style.display = "block";
        }

        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        document.getElementById("close-popup").addEventListener("click", closePopup);
        document.getElementById("close-popup-btn").addEventListener("click", closePopup);

        window.addEventListener("click", function(event) {
            if (event.target === document.getElementById("popup")) {
                closePopup();
            }
        });

        <?php if (isset($_SESSION['success'])): ?>
            showPopup("<?= htmlspecialchars($_SESSION['success']) ?>");
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            showPopup("<?= htmlspecialchars($_SESSION['error']) ?>");
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </script>
</body>
</html>