<?php 
  include '../app/views/components/rnav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Hotel Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #002D40;
            --secondary-color: #B3D9FF;
            --background-color: #f0f2f5;
            --text-color: #333;
            --error-color: #ff4d4d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* .container {
            max-width: 800px;
            margin: 20px auto;
            margin-left: 265px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        } */
        .container {
            max-width: 900px;
            margin: 20px auto;
            margin-left: 440px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }


        h1 {
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary-color);
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border: 2px dashed #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .file-upload:hover {
            border-color: var(--primary-color);
        }

        .file-upload i {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 10px;
        }

        .file-upload span {
            font-size: 14px;
            color: #888;
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        button {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
        }

        button:active {
            transform: scale(0.98);
        }

        .update-profile {
            background-color: var(--primary-color);
            color: #fff;
        }

        .update-profile:hover {
            background-color: #00405c;
        }

        .reset {
            background-color: #f0f0f0;
            color: var(--text-color);
        }

        .reset:hover {
            background-color: #e0e0e0;
        }

        .error {
            color: var(--error-color);
            font-size: 14px;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Account</h1>
        <form id="accountForm">
            <div class="form-group">
                <label for="profile-photo">Profile Photo</label>
                <div class="file-upload" id="profile-photo-upload">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Click or drag to upload your profile photo</span>
                    <input type="file" id="profile-photo" name="profile-photo" accept="image/*" hidden>
                </div>
            </div>
            <div class="form-group">
                <label for="hotel-photos">Hotel Photos</label>
                <div class="file-upload" id="hotel-photos-upload">
                    <i class="fas fa-images"></i>
                    <span>Click or drag to upload hotel photos</span>
                    <input type="file" id="hotel-photos" name="hotel-photos[]" accept="image/*" multiple hidden>
                </div>
            </div>
            <div class="form-group">
                <label for="hotel-name">Hotel Name</label>
                <input type="text" id="hotel-name" name="hotel-name" placeholder="Enter your hotel name">
                <div class="error" id="hotel-name-error"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <div class="error" id="email-error"></div>
            </div>
            <div class="form-group">
                <label for="owner-name">Owner Name</label>
                <input type="text" id="owner-name" name="owner-name" placeholder="Enter owner's name">
                <div class="error" id="owner-name-error"></div>
            </div>
            <div class="form-group">
                <label for="phone-number">Phone Number</label>
                <input type="text" id="phone-number" name="phone-number" placeholder="+94 Enter your phone number">
                <div class="error" id="phone-number-error"></div>
            </div>
            <div class="form-group">
                <label for="district">District</label>
                <input type="text" id="district" name="district" placeholder="Enter your district">
                <div class="error" id="district-error"></div>
            </div>
            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" id="province" name="province" placeholder="Enter your province">
                <div class="error" id="province-error"></div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address-line-1" name="address-line-1" placeholder="Address Line 1">
                <input type="text" id="address-line-2" name="address-line-2" placeholder="Address Line 2">
                <div class="error" id="address-error"></div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Write about your business"></textarea>
                <div class="error" id="description-error"></div>
            </div>
            <div class="buttons">
                <button type="button" class="reset" id="resetBtn">Reset</button>
                <button type="submit" class="update-profile">Update Profile</button>
            </div>
        </form>
    </div>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('accountForm');
            const resetBtn = document.getElementById('resetBtn');
            const fileUploads = document.querySelectorAll('.file-upload');

            fileUploads.forEach(upload => {
                upload.addEventListener('click', () => {
                    upload.querySelector('input[type="file"]').click();
                });

                upload.querySelector('input[type="file"]').addEventListener('change', (e) => {
                    const fileName = e.target.files[0]?.name || 'No file selected';
                    upload.querySelector('span').textContent = fileName;
                });
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateForm()) {
                    // Here you would typically send the form data to the server
                    console.log('Form submitted successfully');
                    alert('Profile updated successfully!');
                }
            });

            resetBtn.addEventListener('click', function() {
                form.reset();
                clearErrors();
                fileUploads.forEach(upload => {
                    upload.querySelector('span').textContent = upload.querySelector('span').dataset.defaultText;
                });
            });

            function validateForm() {
                clearErrors();
                let isValid = true;

                const requiredFields = ['hotel-name', 'email', 'owner-name', 'phone-number', 'district', 'province', 'address-line-1', 'description'];
                requiredFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        showError(field, 'This field is required');
                        isValid = false;
                    }
                });

                const email = document.getElementById('email');
                if (email.value && !isValidEmail(email.value)) {
                    showError('email', 'Please enter a valid email address');
                    isValid = false;
                }

                const phoneNumber = document.getElementById('phone-number');
                if (phoneNumber.value && !isValidPhoneNumber(phoneNumber.value)) {
                    showError('phone-number', 'Please enter a valid phone number');
                    isValid = false;
                }

                return isValid;
            }

            function showError(fieldId, message) {
                const errorElement = document.getElementById(`${fieldId}-error`);
                errorElement.textContent = message;
            }

            function clearErrors() {
                const errorElements = document.querySelectorAll('.error');
                errorElements.forEach(element => element.textContent = '');
            }

            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function isValidPhoneNumber(phone) {
                const re = /^\+?[0-9]{10,14}$/;
                return re.test(phone);
            }
        });
    </script>
</body>
</html>