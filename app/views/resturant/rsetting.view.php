<?php 
  include '../app/views/components/rnav.php';
  include '../app/views/components/rhotelhead.php';

?>
<html>
<head>
    <style>
       main {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 40;
            padding: 20;
            display: flex;
            justify-content: space-between;
            height: 100vh;
           
        }
        .container {
            background-color: #e9ebf0;
            padding: 20px;
            border-radius: 10px;
            width: 200%;
            height: 95%;
            max-width: 800px;
            margin-left: 200px;
            margin-top: 20%;
            top: 150px;
            left: 20px;

            
            display: block;
        }
        .container h1 {
            font-size: 24px;
            padding: 10px;
            color: #333;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .form-group {
            display: flex;
            padding: 5px;
            justify-content: space-between;
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
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-group textarea {
            resize: none;
            height: 60px;
            width: 85%;
        }
        .form-group .half-width {
            width: 48%;
        }
        .upload-photo {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            height: 70px;
        }
        .upload-photo i {
            font-size: 24px;
            color: #888;
            margin-bottom: 10px;
        }
        .upload-photo span {
            color: #888;
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
            border-radius: 5px;
            color:#002D40 ;
        }
        .buttons .reset {
            background-color: #ccc;
            color: #333;
        }
        .buttons .reset:hover {
            background-color: #B3D9FF;
            border-radius: 5px;
            color:#002D40 ;
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
        <form id="accountForm" action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="profile-photo">Upload your photo</label>
                <input type="file" id="profile-photo" name="profile-photo" accept="image/*">
            </div>
            <div class="form-group">
                <label for="hotel-photos">Upload hotel photos</label>
                <input type="file" id="hotel-photos" name="hotel-photos[]" accept="image/*" multiple>
            </div>
            <div class="form-group">
                <div class="half-width">
                    <label for="hotel-name">Hotel name</label>
                    <input type="text" id="hotel-name" name="hotel-name" placeholder="Please enter your hotel name">
                    <div class="error" id="hotel-name-error"></div>
                </div>
                <div class="half-width">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Please enter your email">
                    <div class="error" id="email-error"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="half-width">
                    <label for="owner-name">Owner name</label>
                    <input type="text" id="owner-name" name="owner-name" placeholder="Please enter your name">
                    <div class="error" id="owner-name-error"></div>
                </div>
                <div class="half-width">
                    <label for="phone-number">Phone number</label>
                    <input type="text" id="phone-number" name="phone-number" placeholder="+94 Please enter your phone number">
                    <div class="error" id="phone-number-error"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="half-width">
                    <label for="district">District</label>
                    <input type="text" id="district" name="district" placeholder="Please enter your district">
                    <div class="error" id="district-error"></div>
                </div>
                <div class="half-width">
                    <label for="address-line-1">Address</label>
                    <input type="text" id="address-line-1" name="address-line-1" placeholder="Address Line 1">
                    <div class="error" id="address-line-1-error"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="half-width">
                    <label for="province">Province</label>
                    <input type="text" id="province" name="province" placeholder="Please enter your Province">
                    <div class="error" id="province-error"></div>
                </div>
                <div class="half-width">
                    <label for="address-line-2">&nbsp;</label>
                    <input type="text" id="address-line-2" name="address-line-2" placeholder="Address Line 2">
                    <div class="error" id="address-line-2-error"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label> 
                <br>
                <textarea id="description" name="description" placeholder="Write about your Business"></textarea>
                <div class="error" id="description-error"></div>
            </div>
            <div class="buttons">
                <button type="submit" class="update-profile">Update Profile</button>
                <button type="reset" class="reset">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
