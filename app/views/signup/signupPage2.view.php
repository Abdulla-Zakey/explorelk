<html>
 <head>
  <title>
   Service Provider Information
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
        body, html  {
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
            height: 90%;
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
            width: 30px; /* Adjust the size of the circle */
            height: 30px; /* Adjust the size of the circle */
            border-radius: 50%; /* Makes it a circle */
            text-decoration: none; /* Remove underline */
            transition: all 0.2s ease; /* Smooth transition */
        }

        .arrow-link i {
            color:#002D40; /* Initial color of the arrow */
            font-size: 20px; /* Adjust the size of the arrow */
            transition: color 0.2s ease; /* Smooth color change */
        }

        /* Hover effect */
        .arrow-link:hover {
            background-color: #002D40; /
        }

        .arrow-link:hover i {
            color: #bbb; /*  arrow on hover */
        }

        .select-wrapper {
    margin: 20px 0;
}

/* .select-wrapper label {
    display: block;
    margin-bottom: 8px;
    color: #002D40;
    font-weight: 600;
    font-size: 16px;
} */

.select-wrapper select {
    width: 100%;
    padding: 12px;
    border: 2px solid #002D40;
    border-radius: 8px;
    background-color: white;
    font-size: 15px;
    color: #002D40;
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23002D40' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
}

.select-wrapper select:hover {
    border-color: #B3D9FF;
}

.select-wrapper select:focus {
    outline: none;
    border-color: #B3D9FF;
    box-shadow: 0 0 0 3px rgba(179, 217, 255, 0.3);
}

.select-wrapper select option {
    padding: 12px;
}


  </style>
 </head>
 <body>
  <div class="logo">
   <img alt="ExploreLK logo" height="200" src="<?=ROOT?>/assets/images/serviceProviders/logob.png" width="200"/>
  </div>
  <div class="container">
   <div class="form-container">
    <form>
     <h1>
      Business Information
     </h1>
     <label for="companyname">
     Company Name
     </label>
     <input id="companyname" name="companyname" type="text"/>
     <label for="bregnumber">
     Business Registration Number
     </label>
     <input id="bregnumber" name="bregnumber" type="text"/>

    
     <div class="select-wrapper">
    <label for="service-type">Service Type</label>
    <select id="service-type" name="service-type">
        <option value="hotels">Hotels</option>
        <option value="restaurants">Restaurants</option>
        <option value="travel-agent">Travel Agent</option>
        <option value="tour-guide">Tour Guide</option>
    </select>
    </div>
    <label for="servicedes">
     Description of Services
     </label>
     <input id="servicedes" name="servicedes" type="text"/>

     <label for="contact-number">
      Contact Number
     </label>
     <input id="contact-number" name="contact-number" type="text"/>
     <label for="address">
      Address
     </label>
     <input id="address" name="address" type="text"/>

     
     <!-- Pagination inside the form -->
     <div class="pagination">
     <a href="<?=ROOT?>/signup/SignupPage1" class="arrow-link">
        <i class="fas fa-arrow-left arrow"></i>
    </a>
      <span class="dot"></span>
      <span class="dot active"></span>
      <span class="dot"></span>
      <a href="<?=ROOT?>/signup/SignupPage3" class="arrow-link">
        <i class="fas fa-arrow-right arrow"></i>
    </a>

     </div>

    </form>
    <div class="image-container">
     <img alt="Cartoon image of a man and two children" height="400" src="<?=ROOT?>/assets/images/serviceProviders/sprovider.png" width="500"/>
    </div>
   </div>
  </div>
 </body>
</html>