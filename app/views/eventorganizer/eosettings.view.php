<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK | EO - Settings</title>
    <style>
        :root {
            --primary-color: #002D40;
            --primary-light: #004D6D;
            --accent-color: #000000;
            --text-light: #FFFFFF;
            --text-dark: #333333;
            --background-light: #F4F4F4;
            --background-dark: #E0E0E0;
            --error-color: #D32F2F;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--background-light);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--primary-color);
            color: var(--text-light);
            padding: 15px;
            position: fixed;
            width: 250px;
            height: 100%;
            top: 0;
            left: 0;
        }

        .main-content {
            margin-left: 300px;
            padding: 20px;
            background-color: var(--text-light);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            min-height: 100vh;
        }

        h1 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 10px;
        }

        h2 {
            color: var(--primary-color);
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--background-dark);
        }

        .section {
            margin-bottom: 40px;
        }

        .profile-image-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: var(--background-dark);
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 3px solid var(--accent-color);
        }

        #profile-upload {
            display: none;
        }

        .upload-btn {
            background-color: var(--primary-color);
            color: var(--text-light);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .upload-btn:hover {
            background-color: var(--primary-light);
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--primary-color);
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--primary-light);
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .save-btn, .edit-btn {
            background-color: var(--accent-color);
            color: var(--text-light);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            margin-top: 10px;
        }

        .save-btn:hover, .edit-btn:hover {
            background-color: var(--primary-light);
        }

        .error {
            color: var(--error-color);
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .success {
            color: green;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .form-group input[readonly] {
            background-color: #f0f0f0;
            cursor: not-allowed;
        }

        .error-input {
            border-color: var(--error-color) !important;
        }

        @media screen and (max-width: 768px) {
            .navbar {
                position: static;
                width: 100%;
                height: auto;
                padding: 10px;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<?php include '../app/views/components/eonavbar.php'; ?>

<div class="main-content">
    <h1>Account Settings</h1>

    <?php if (!empty($success_message)): ?>
        <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
    <?php endif; ?>

    <div class="section" id="profile-section">
        <h2>Profile Information</h2>
        <form id="profile-form" method="POST" enctype="multipart/form-data" aria-label="Profile Settings Form">
            <input type="hidden" name="form_type" value="profile">
            <div class="profile-image-container">
                <img src="<?php echo !empty($data->company_logo) ? ROOT . '/' . htmlspecialchars($data->company_logo) : 'https://via.placeholder.com/150'; ?>" 
                     alt="Profile Image" class="profile-img" id="profile-img">
                <p>Add a profile image</p>
                <input type="file" id="profile-upload" name="profile_image" accept="image/jpeg,image/png,image/gif" aria-label="Upload Profile Image">
                <label for="profile-upload" class="upload-btn">Upload Image</label>
                <?php if (isset($errors['profile_image'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['profile_image']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="company-email">Company Email</label>
                <input type="email" id="company-email" name="company_email" 
                       value="<?php echo htmlspecialchars($data->company_Email ?? ''); ?>" readonly 
                       aria-readonly="true">
                <?php if (isset($errors['company_email'])): ?>
                    <p class="error"><?php echo htmlspecialchars($errors['company_email']); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="company-name">Company Name</label>
                <input type="text" id="company-name" name="company_name" required
                       value="<?php echo htmlspecialchars($data->company_Name ?? ''); ?>" readonly 
                       maxlength="100" aria-describedby="company-name-error">
                <?php if (isset($errors['company_name'])): ?>
                    <p class="error" id="company-name-error"><?php echo htmlspecialchars($errors['company_name']); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="company-mobile">Mobile Number</label>
                <input type="tel" id="company-mobile" name="company_mobile" 
                       value="<?php echo htmlspecialchars($data->company_MobileNum ?? ''); ?>" readonly 
                       pattern="0[0-9]{9}" maxlength="10" aria-describedby="company-mobile-error">
                <?php if (isset($errors['company_mobile'])): ?>
                    <p class="error" id="company-mobile-error"><?php echo htmlspecialchars($errors['company_mobile']); ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="company-address">Company Address</label>
                <input type="text" id="company-address" name="company_address" 
                       value="<?php echo htmlspecialchars($data->company_Address ?? ''); ?>" readonly 
                       maxlength="255" aria-describedby="company-address-error">
                <?php if (isset($errors['company_address'])): ?>
                    <p class="error" id="company-address-error"><?php echo htmlspecialchars($errors['company_address']); ?></p>
                <?php endif; ?>
            </div>

            <button type="button" class="edit-btn" id="edit-profile-btn" aria-label="Edit Profile">Edit Profile</button>
            <button type="submit" class="save-btn" id="save-profile-btn" style="display: none;" 
                    aria-label="Save Profile Changes">Save Changes</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editBtn = document.getElementById('edit-profile-btn');
    const saveBtn = document.getElementById('save-profile-btn');
    const inputs = document.querySelectorAll('#profile-form input:not([type="file"]):not([type="hidden"])');
    const profileUpload = document.getElementById('profile-upload');
    const profileImg = document.getElementById('profile-img');
    const profileForm = document.getElementById('profile-form');

    // Toggle edit mode
    editBtn.addEventListener('click', () => {
        inputs.forEach(input => {
            if (input.id !== 'company-email') {
                input.removeAttribute('readonly');
                input.style.backgroundColor = '#fff';
                input.style.cursor = 'text';
            }
        });
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
    });

    // Handle profile image preview
    profileUpload.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                profileImg.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Client-side validation
    profileForm.addEventListener('submit', (e) => {
        let hasErrors = false;
        const companyName = document.getElementById('company-name').value.trim();
        const companyMobile = document.getElementById('company-mobile').value.trim();
        const companyAddress = document.getElementById('company-address').value.trim();
        const cleanMobile = companyMobile.replace(/[\s-]+/g, '');
        const mobileRegex = /^0\d{9}$/;

        // Reset error styles and messages
        inputs.forEach(input => input.classList.remove('error-input'));
        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        if (!companyName) {
            hasErrors = true;
            document.getElementById('company-name').classList.add('error-input');
            document.getElementById('company-name-error').textContent = 'Company name is required.';
        }

        if (companyMobile && !mobileRegex.test(cleanMobile)) {
            hasErrors = true;
            document.getElementById('company-mobile').classList.add('error-input');
            document.getElementById('company-mobile-error').textContent = 'Mobile number must start with 0 and have 10 digits (e.g., 0771234567).';
        }

        if (!companyAddress) {
            hasErrors = true;
            document.getElementById('company-address').classList.add('error-input');
            document.getElementById('company-address-error').textContent = 'Company address is required.';
        }

        if (hasErrors) {
            e.preventDefault();
        } else {
            // Update mobile input with cleaned value
            document.getElementById('company-mobile').value = cleanMobile;
        }
    });
});
</script>
</body>
</html>