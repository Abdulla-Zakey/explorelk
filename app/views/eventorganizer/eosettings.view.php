<<?php 
  include '../app/views/components/eonavbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExploreLK - Account Information</title>
    <link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/Eventorganizer/eosettings.css">
</head>
<body>

    

    <!-- Main Content -->
    <div class="main-content">
        

        <!-- Account Information Section -->
        <div class="account-section">
            <h2>Account Information</h2>
            
            <!-- Profile Image Upload -->
            <div class="profile-image-container">
                <img src="<?php echo ROOT; ?>/assets/images/eo/profile-placeholder.png" alt="Profile Image" class="profile-img">
                <p>Add a profile image</p>
                <span>Drag and drop or choose a file to upload</span>
            </div>

            <!-- Contact Information Section -->
            <h3>Contact Information</h3>
            <div class="form-container">
                
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="home-phone">Home Phone</label>
                    <input type="text" id="home-phone" placeholder="Home Phone">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" placeholder="address">
                </div>
                <div class="form-group">
                    <label for="job-title">Job Title (optional)</label>
                    <input type="text" id="job-title" placeholder="Job Title (optional)">
                </div>
                <div class="form-group">
                    <label for="company">Company / Organization (optional)</label>
                    <input type="text" id="company" placeholder="Company / Organization (optional)">
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" id="website" placeholder="Website">
                </div>
                <div class="form-group">
                    <label for="blog">Blog</label>
                    <input type="text" id="blog" placeholder="Blog">
                </div>
            </div>
            <h3>Professional Information</h3>
            <div class="form-container">

                <div class="form-group">
                    <label for="company-name">Company/Organization Name (optional)</label>
                    <input type="text" id="company-name" placeholder="Company/Organization Name (optional)">
                </div>
                <div class="form-group">
                    <label for="business-phone">Business Phone (optional)</label>
                    <input type="text" id="business-phone" placeholder="Business Phone (optional)">
                </div>
                <div class="form-group">
                    <label for="business-address">Business Address (optional)</label>
                    <input type="text" id="business-address" placeholder="Business Address (optional)">
                </div>
                <div class="form-group">
                    <label for="website">Website (optional)</label>
                    <input type="text" id="website" placeholder="Website (optional)">
                </div>
                <div class="form-group">
                    <label for="event-type">Type of Events Organized (optional)</label>
                    <input type="text" id="event-type" placeholder="Type of Events Organized (optional)">
                </div>
                <div class="form-group">
                    <label for="experience">Years of Experience (optional)</label>
                    <input type="number" id="experience" placeholder="Years of Experience (optional)">
                </div>
            </div>
            <h3>Change Password</h3>
            <div class="form-container-password">

                <div class="form-group">
                    <label for="current-password">Current Password</label>
                    <input type="password" id="current-password" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" id="new-password" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password</label>
                    <input type="password" id="confirm-password" placeholder="Confirm New Password">
                </div>
                
            </div>


        </div>
    </div>

</body>
</html>
