<html>
 <head>
  <title>Service Provider Information</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
        body, html  {
        background-image: url("<?php echo ROOT; ?>/assets/images/eo/eoSignupBg.webp");
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
        .content h1 {
            font-size: 60px;
            margin: 0;
            color: #333;
        }
        .content h2 {
            font-size: 46px;
            margin: 10px 0;
            color: #333;
        }
        .content p {
            font-size: 18px;
            color: #333;
        }
        .content a {
            color: #007BFF;
            text-decoration: none;
        }
        .content a:hover {
            text-decoration: underline;
        }
        .buttons {
            margin: 20px 0;
        }
        .buttons button {
            background-color: #001F3F;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #B3D9FF;
            color:#001F3F;
        }
        
        .footer {
            font-size: 14px;
            color: #333;
            margin-top: 20px;
        }
        .footer a {
            color: #333;
            text-decoration: none;
            margin: 0 10px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .logo {
            position: absolute;
            top: 15px;
            right: 280px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;
        }
        .pagination .dot {
            height: 10px;
            width: 10px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            margin: 0 5px;
        }
        .pagination .dot.active {
            background-color: #002D40;
        }
        .arrow-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .arrow-link i {
            color:#002D40;
            font-size: 20px;
            transition: color 0.2s ease;
        }
        .arrow-link:hover {
            background-color: #002D40;
        }
        .arrow-link:hover i {
            color: #bbb;
        }
        .checkbox-container {
        display: flex !important;
        justify-content: flex-start;
        align-items: center;
    }

    .checkbox-container input {
        margin-right: 8px;
    }
  </style>
 </head>
 <body>
  <div class="container">
   <div class="logo">
    <!-- <img alt="ExploreLK logo" height="200" src="loko.png" width="200"/> -->
   </div>
   <div class="form-container">
    <form>
        <div class="content">
            <h1>Get Started!!!</h1>
            <h2>Explore.LK</h2>
      
     <!--  <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" />
       -->
      <div class="checkbox-container">
        <input type="checkbox" id="terms" />
        <label for="terms">I agree to the Terms and Conditions.</label>
      </div>
      
      <div class="buttons">
        <!-- Register button that redirects to spinfo1.php -->
        <a href="Eosignup/signup">
          <button type="button">Register</button>
        </a>

        <!-- Login button (just a normal button for now) -->
        <a href="Eodashboard">
          <button type="button">Login</button>
        </a>
        <!-- Add a link to the "Forgot Password" page -->
         <a href="forgot_password.php">Forgot Password?</a>
      </div>
      
      <div class="footer">
        <a href="#">Privacy Policy</a> |
        <a href="#">Terms of Service</a> |
        <a href="#">Help Center</a>
      </div>
     </div>
    </form>
    <div class="image-container">
     <img alt="Cartoon image of a man and two children" height="400" src="<?php echo ROOT; ?>/assets/images/eo/Events-amico.png" width="500"/>
    </div>
   </div>
  </div>
 </body>
</html>
