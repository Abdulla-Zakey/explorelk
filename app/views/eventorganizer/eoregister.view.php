<html>
 <head>
  <title>
   Service Provider Information
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
        body, html  {
        background-image: url("<?php echo ROOT; ?>/assets/images/eo/event-backround.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        } 
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            width: 800px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-container h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .form-container form {
            width: 50%;
        }
        .form-container form label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .form-container form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-bottom: 2px solid #333;
            font-size: 16px;
            color: #333;
            background: transparent;
        }
        .form-container .image-container {
            width: 40%;
            text-align: center;
        }
        .form-container .image-container img {
            width: 100%;
        }
        .logo {
            position: absolute;
            top: 15px;
            right: 280px;
        }
        button{
            align-items: center;
            background-color: #001F3F;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 65px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #B3D9FF;
            color:#001F3F;
        }
  </style>
 </head>
 <body>
  <div class="logo">
    <!-- <img alt="ExploreLK logo" height="200" src="../../../public/images/logob.png" width="200"/> -->
  </div>
  <div class="container">
   <div class="form-container">
    <form id="eventOrganizerForm" onsubmit="return validateForm()">
     <h1>
      Event Organizer Information
     </h1>
     <label for="companyname">
      Company Name
     </label>
     <input id="companyname" name="companyname" type="text" required/>

     <label for="companyemail">
     Company Email
     </label>
     <input id="companyemail" name="companyemail" type="email" required/>

     <label for="contact-number">
      Contact Number
     </label>
     <input id="contact-number" name="contact-number" type="text" required/>

     <label for="companyaddress">
     Company Address
     </label>
     <input id="companyaddress" name="companyaddress" type="text" required/>

     <label for="password">
      Password
     </label>
     <input id="password" name="password" type="password" required minlength="6" />

     <label for="confirm-password">
      Confirm Password
     </label>
     <input id="confirm-password" name="confirm-password" type="password" required/>

     <a href="/ExploreLKWithMVC/public/traveler/Login">
          <button type="submit">Register as Event Organizer</button>
    </a>
    </form>
    <div class="image-container">
     <img alt="Cartoon image of a man and two children" height="400" src="<?php echo ROOT; ?>/assets/images/eo/Events-amico.png" width="500"/>
    </div>
   </div>
  </div>

  <script>
    function validateForm() {
        // Get form field values
        var email = document.getElementById("companyemail").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;

        // Validate email format
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!email.match(emailPattern)) {
            alert("Please enter a valid email address.");
            return false;
        }

        // Check if passwords match
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        // All checks passed, form is valid
        return true;
    }
  </script>
 </body>
</html>
