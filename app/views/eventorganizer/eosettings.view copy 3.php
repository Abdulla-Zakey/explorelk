<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK | EO - Settings</title>
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eosettings.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include '../app/views/components/eonavbar.php'; ?>

    <div class="main-content">
        <h1>Account Settings</h1>
        
        <div class="tabs">
            <button class="tab-button active" data-tab="personal">Personal Info</button>
            <button class="tab-button" data-tab="professional">Professional Info</button>
            <button class="tab-button" data-tab="security">Security</button>
        </div>

        <div class="tab-content active" id="personal">
            <h2>Personal Information</h2>
            <div class="profile-image-container">
                <img src="/assets/images/eo/profile-placeholder.png" alt="Profile Image" class="profile-img" id="profile-img">
                <p>Add a profile image</p>
                <span>Drag and drop or choose a file to upload</span>
                <input type="file" id="profile-upload" accept="image/*" style="display: none;">
                <button id="upload-btn">Upload Image</button>
            </div>
            <form id="personal-form">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="home-phone">Home Phone</label>
                    <input type="tel" id="home-phone" name="home_phone" placeholder="Home Phone">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="website" placeholder="Website">
                </div>
                <div class="form-group">
                    <label for="blog">Blog</label>
                    <input type="url" id="blog" name="blog" placeholder="Blog">
                </div>
                <button type="submit" class="save-btn">Save Personal Info</button>
            </form>
        </div>

        <div class="tab-content" id="professional">
            <h2>Professional Information</h2>
            <form id="professional-form">
                <div class="form-group">
                    <label for="company-name">Company/Organization Name</label>
                    <input type="text" id="company-name" name="company_name" placeholder="Company/Organization Name">
                </div>
                <div class="form-group">
                    <label for="job-title">Job Title</label>
                    <input type="text" id="job-title" name="job_title" placeholder="Job Title">
                </div>
                <div class="form-group">
                    <label for="business-phone">Business Phone</label>
                    <input type="tel" id="business-phone" name="business_phone" placeholder="Business Phone">
                </div>
                <div class="form-group">
                    <label for="business-address">Business Address</label>
                    <input type="text" id="business-address" name="business_address" placeholder="Business Address">
                </div>
                <div class="form-group">
                    <label for="event-type">Type of Events Organized</label>
                    <input type="text" id="event-type" name="event_type" placeholder="Type of Events Organized">
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience</label>
                    <input type="number" id="experience" name="experience" placeholder="Years of Experience">
                </div>
                <button type="submit" class="save-btn">Save Professional Info</button>
            </form>
        </div>

        <div class="tab-content" id="security">
            <h2>Change Password</h2>
            <form id="security-form">
                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" name="current_password" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" name="new_password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm New Password">
                </div>
                <button type="submit" class="save-btn">Update Password</button>
            </form>
        </div>
    </div>

    <script>
        // eosettings.js
$(document).ready(function() {
    // Tab functionality
    $('.tab-button').click(function() {
        $('.tab-button').removeClass('active');
        $('.tab-content').removeClass('active');
        $(this).addClass('active');
        $('#' + $(this).data('tab')).addClass('active');
    });

    // Profile image upload
    $('#upload-btn').click(function() {
        $('#profile-upload').click();
    });

    $('#profile-upload').change(function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            $('#profile-img').attr('src', event.target.result);
        };
        reader.readAsDataURL(file);
    });

    // Form submissions
    $('#personal-form').submit(function(e) {
        e.preventDefault();
        // Here you would typically send an AJAX request to update the personal info
        console.log('Personal info submitted');
        alert('Personal information saved successfully!');
    });

    $('#professional-form').submit(function(e) {
        e.preventDefault();
        // Here you would typically send an AJAX request to update the professional info
        console.log('Professional info submitted');
        alert('Professional information saved successfully!');
    });

    $('#security-form').submit(function(e) {
        e.preventDefault();
        // Here you would typically send an AJAX request to update the password
        console.log('Password change submitted');
        alert('Password updated successfully!');
    });
});
    </script>
</body>
</html>
