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
        top: 100px;
        right: 260px;
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

    .checkbox-container {
        margin: 20px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-container input[type="checkbox"] {
        width: auto;
        margin: 0;
    }

    .checkbox-container label {
        margin: 0;
        font-size: 14px;
        color: #002D40;
    }

    .buttons {
        margin: 20px 0;
    }

    .buttons button {
        background: #002D40;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .buttons button:hover {
        background: #B3D9FF;
        color: #002D40;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="logo">
            <img alt="ExploreLK logo" height="200" src="<?=ROOT?>/assets/images/serviceProviders/logob.png"
                width="200" />
        </div>
        <div class="form-container">
            <form>
                <h1>
                    Other Information
                </h1>
                <label for="city">
                    City
                </label>
                <input id="city" name="city" type="text" />
                <label for="yearestablish">
                    Year Started
                </label>
                <input id="yearstart" name="yearstart" type="text" />
                <label for="otherdetails">Other Details</label>
                <input id="otherdetails" name="otherdetails" type="text" />

                <div class="checkbox-container">
                    <input type="checkbox" id="terms" required />
                    <label for="terms">I agree to the Terms and Conditions.</label>
                </div>

                <div class="buttons">
                    <button type="submit">Register</button>
                </div>
                <!-- Pagination inside the form -->
                <div class="pagination">
                    <a href="<?=ROOT?>/signup/SignupPage2" class="arrow-link">
                        <i class="fas fa-arrow-left arrow"></i>
                    </a>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot active"></span>


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