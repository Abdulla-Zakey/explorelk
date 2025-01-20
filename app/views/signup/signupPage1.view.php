<html>

<head>
    <title>
        Service Provider Information
    </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
    body,
    html {
        background-image: url("<?=ROOT?>/assets/images/serviceProviders/spbg.jpg");
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
        padding: 25px;
        width: 800px;
        height: 90%;
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

    /* Styling the link and icon */
    .arrow-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        /* Adjust the size of the circle */
        height: 30px;
        /* Adjust the size of the circle */
        border-radius: 50%;
        /* Makes it a circle */
        text-decoration: none;
        /* Remove underline */
        transition: all 0.2s ease;
        /* Smooth transition */
    }

    .arrow-link i {
        color: #002D40;
        /* Initial color of the arrow */
        font-size: 20px;
        /* Adjust the size of the arrow */
        transition: color 0.2s ease;
        /* Smooth color change */
    }

    /* Hover effect */
    .arrow-link:hover {
        background-color: #002D40;/
    }

    .arrow-link:hover i {
        color: #bbb;
        /*  arrow on hover */
    }
    </style>
</head>

<body>
    <div class="logo">
        <img alt="ExploreLK logo" height="200" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" width="200" />
    </div>
    <div class="container">
        <div class="form-container">
            <form method="POST" name="signupForm1" action="">
                <h1>
                    Service Provider Information
                </h1>
                <label for="name">
                    Name
                </label>
                <input id="name" name="name" type="text" />
                <label for="email">
                    Email
                </label>
                <input id="email" name="email" type="email" />
                <label for="password">
                    Password
                </label>
                <input id="password" name="password" type="password" />
                <label for="confirm-password">
                    Confirm Password
                </label>
                <input id="confirm-password" name="confirm-password" type="password" />
                <label for="contact-number">
                    Contact Number
                </label>
                <input id="contact-number" name="contact-number" type="text" />
                <label for="address">
                    Address
                </label>
                <input id="address" name="address" type="text" />

                <!-- Pagination inside the form -->
                <div class="pagination">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <a href="<?=ROOT?>/signup/SignupPage2" class="arrow-link">
                        <i class="fas fa-arrow-right arrow"></i>
                    </a>

                </div>
            </form>
            <div class="image-container">
                <img alt="Cartoon image of a man and two children" height="400"
                    src="<?=ROOT?>/assets/images/serviceProviders/sprovider.png" width="500" />
            </div>
        </div>
    </div>
</body>

</html>