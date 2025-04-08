<?php 
    include_once APPROOT.'/views/hotel/nav.php';
    include_once APPROOT.'/views/hotel/hotelhead.php';
// ?>
<?php
    // var_dump($data);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>My Account</title>
    <style>
       main {
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 100vh;
        }
        body {
            font-family: 'poppins';
            background-color: #f0f2f5;
            justify-content: center;
            align-items: center;
            padding-bottom: 10px;
            
        }
        .container {
            background-color: #e9ebf0;
            padding: 20px;
            border-radius: 10px;
            width: 150%;
            /* height: auto; */
            max-width: 1000px;
            margin-left: 07%;
            margin-top: -43.25%;
            top: 150px;
            left: 20px;
        }
        .container h1 {
            font-size: 24px;
            padding: 10px;
            color: #333;
            margin: 0 0 20px;
            text-align: center;
        }
        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .form-group .half-width {
            width: 48%;
        }
        .buttons {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }
        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .buttons .update-profile {
            background-color: #002D40;
            color: #fff;
        }
        .buttons .update-profile:hover {
            background-color: #B3D9FF;
            color: #002D40;
        }
        .buttons .reset {
            background-color: #ccc;
            color: #333;
        }
        .buttons .reset:hover {
            background-color: #B3D9FF;
            color: #002D40;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
        
    </style>
</head>
<body>
   
    <main>
        <div class="container">
            <h1>My Account</h1>
            <form id="accountForm" action="update_profile.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="profile-photo">Upload logo</label>
                    <input type="file" id="profile-photo" name="profile-photo" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="hotel-photos">Upload hotel photos</label>
                    <input type="file" id="hotel-photos" name="hotel-photos[]" accept="image/*" multiple>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="hotel-name">Hotel name</label>
                        <input type="text" id="hotel-name" name="hotel-name" placeholder="Please enter your hotel name" value="<?= $data['hotelBasic']->hotelName ?>" readonly>
                        <div class="error" id="hotel-name-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Please enter your email" value="<?= $data['hotelBasic']->hotelEmail ?>" readonly>
                        <div class="error" id="email-error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="half-width">
                        <label for="owner-name">Owner name</label>
                        <input type="text" id="owner-name" name="owner-name" placeholder="Please enter your name" value="<?= $data['hotelBasic']->serviceProviderName ?>" readonly>
                        <div class="error" id="owner-name-error"></div>
                    </div>
                    <div class="half-width">
                        <label for="phone-number">Phone number</label>
                        <input type="text" id="phone-number" name="phone-number" placeholder="+94 Please enter your phone number" value="<?= $data['hotelBasic']->hotelMobileNum ?>" readonly>
                        <div class="error" id="phone-number-error"></div>
                    </div>
                    
                        <label for="address-line-1">Address</label>
                        <input type="text" id="address-line-1" name="address-line-1" placeholder="Address Line 1" value="<?= $data['hotelBasic']->hotelAddress ?>" readonly>
                        <div class="error" id="address-line-1-error"></div>
                    
                </div>
                
                <div class="form-group">
                    <div class="half-width">
                        <label for="district">District</label>
                        <input type="text" id="district" name="district" placeholder="Please enter your district" value="<?= $data['hotelBasic']->district ?>" readonly>
                        <div class="error" id="district-error"></div>
                    </div>
                   
                
                    <div class="half-width">
                        <label for="province">Province</label>
                        <input type="text" id="province" name="province" placeholder="Please enter your Province" value="<?= $data['hotelBasic']->province ?>" readonly>
                        <div class="error" id="province-error"></div>
                    </div>
                    <!-- <div class="half-width">
                        <label for="address-line-2">Address Line 2</label>
                        <input type="text" id="address-line-2" name="address-line-2" placeholder="Address Line 2">
                        <div class="error" id="address-line-2-error"></div>
                    </div> -->
                </div>
                <div class="form-group">
                    <label for="description">Description</label> 
                    <textarea id="description" name="description" placeholder="Write about your Hotel" readonly><?= htmlspecialchars($data['hotelBasic']->description_para1) ?></textarea>
                    <div class="error" id="description-error"></div>
                    <textarea id="description" name="description" placeholder="Write about your Hotel" readonly><?= htmlspecialchars($data['hotelBasic']->description_para2) ?></textarea>
                    <div class="error" id="description-error"></div>
                    <textarea id="description" name="description" placeholder="Write about your Hotel" readonly><?= htmlspecialchars($data['hotelBasic']->description_para3) ?></textarea>
                    <div class="error" id="description-error"></div>
                </div>
                <div class="buttons">
                    <button type="button" id="edit-btn" class="update-profile" onclick="enableEditing()">Edit Profile</button>
                    <button type="submit" id="update-btn" class="update-profile" style="display: none;">Update Profile</button>
                    <!-- <button type="reset" class="reset">Reset</button> -->
                </div>
            </form>
        </div>

        
    </main>

</body>

<script>
    function enableEditing() {
        let inputs = document.querySelectorAll("input, textarea");
        inputs.forEach(input => {
            input.removeAttribute("readonly");
        });
        document.getElementById("update-btn").style.display = "inline-block"; // Show Update button
        document.getElementById("edit-btn").style.display = "none"; // Hide Edit button
    }
</script>

</html>
