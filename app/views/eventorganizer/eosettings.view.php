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
            --primary-dark: #001F2D;
            --accent-color: #000000;
            --text-light: #FFFFFF;
            --text-dark: #333333;
            --background-light: #F4F4F4;
            --background-dark: #E0E0E0;
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
            transition: 0.3s;
            margin-top: 10px;
            display: inline-block;
        }
        
        .upload-btn:hover {
            background-color: var(--primary-light);
        }
        
        .form-group {
            margin-bottom: 15px;
            width: 1160px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--primary-color);
        }
        
        input[type="text"],
        input[type="tel"],
        input[type="url"],
        input[type="number"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--primary-light);
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="url"]:focus,
        input[type="number"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            border-color: var(--accent-color);
            outline: none;
        }
        
        .save-btn {
            background-color: var(--accent-color);
            color: var(--text-light);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .save-btn:hover {
            background-color: #004D6D;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            margin-bottom: 10px;
        }

        /* Responsive styles */
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

    <?php if (!empty($data->success_message)): ?>
        <p class="success"><?php echo htmlspecialchars($data->success_message); ?></p>
    <?php endif; ?>

    <?php if (!empty($data->errors)): ?>
        <ul class="error">
            <?php foreach ($data->errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="section" id="personal-section">
        <h2>Personal Information</h2>
        <form id="personal-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="personal">
            <div class="profile-image-container">
                <img src="<?php echo !empty($data->profile_Image) ? ROOT . '/' . htmlspecialchars($data->profile_Image) : 'https://via.placeholder.com/150'; ?>" alt="Profile Image" class="profile-img" id="profile-img">
                <p>Add a profile image</p>
                <span>Drag and drop or choose a file to upload</span>
                <input type="file" id="profile-upload" name="profile_image" accept="image/*">
                <label for="profile-upload" class="upload-btn">Upload Image</label>
            </div>
            <div class="form-group">
                <label for="organizer-id">Organizer ID </label>
                <input type="text" id="organizer-id" name="organizer_id" value="<?php echo htmlspecialchars($data->organizer_Id ?? ''); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first_name" value="<?php echo htmlspecialchars($data->first_Name ?? ''); ?>" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last_name" value="<?php echo htmlspecialchars($data->last_Name ?? ''); ?>" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="company-email">Company Email</label>
                <input type="email" id="company-email" name="company_email" value="<?php echo htmlspecialchars($data->company_Email ?? ''); ?>" placeholder="Company Email" readonly>
            </div>
            <div class="form-group">
                <label for="company-mobile">Mobile Number</label>
                <input type="tel" id="company-mobile" name="company_mobile" value="<?php echo htmlspecialchars($data->company_MobileNum ?? ''); ?>" placeholder="Mobile Number">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($data->company_Address ?? ''); ?>" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="url" id="website" name="website" value="<?php echo htmlspecialchars($data->website ?? ''); ?>" placeholder="Website">
            </div>
            <div class="form-group">
                <label for="blog">Blog</label>
                <input type="url" id="blog" name="blog" value="<?php echo htmlspecialchars($data->blog ?? ''); ?>" placeholder="Blog">
            </div>
            <button type="submit" class="save-btn">Save Personal Info</button>
        </form>
    </div>

    <div class="section" id="professional-section">
        <h2>Professional Information</h2>
        <form id="professional-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="form_type" value="professional">
            <div class="form-group">
                <label for="company-name">Company/Organization Name</label>
                <input type="text" id="company-name" name="company_name" value="<?php echo htmlspecialchars($data->company_Name ?? ''); ?>" placeholder="Company/Organization Name">
            </div>
            <div class="form-group">
                <label for="job-title">Job Title</label>
                <input type="text" id="job-title" name="job_title" value="<?php echo htmlspecialchars($data->job_Title ?? ''); ?>" placeholder="Job Title">
            </div>
            <div class="form-group">
                <label for="company-address">Company Address</label>
                <input type="text" id="company-address" name="company_address" value="<?php echo htmlspecialchars($data->company_Address ?? ''); ?>" placeholder="Company Address">
            </div>
            <div class="form-group">
                <label for="event-type">Type of Events Organized</label>
                <input type="text" id="event-type" name="event_type" value="<?php echo htmlspecialchars($data->event_Type ?? ''); ?>" placeholder="Type of Events Organized">
            </div>
            <div class="form-group">
                <label for="experience">Years of Experience</label>
                <input type="number" id="experience" name="experience" value="<?php echo htmlspecialchars($data->experience ?? ''); ?>" placeholder="Years of Experience">
            </div>
            <button type="submit" class="save-btn">Save Professional Info</button>
        </form>
    </div>
</div>

<script>
    // Handle profile image preview
    document.addEventListener('DOMContentLoaded', function() {
        const profileUpload = document.getElementById('profile-upload');
        if (profileUpload) {
            profileUpload.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('profile-img').src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
</body>
</html>