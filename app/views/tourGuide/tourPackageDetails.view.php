<html>
    <head>
        <title>ExploreLK Tour Guide</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/tourGuide/tourGuide.css?v=1.0">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <script src="https://kit.fontawesome.com/d11f03c652.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="flexContainer">
            
            <?php include_once APPROOT.'\views\inc\tourGuideNavBar.php'; ?>

            <!-- Main Content -->
            <div class="body-container">
                <div class="sub-heading">
                    <a class="back_button" href="<?=ROOT?>/tourGuide/C_tourPackages">&larr; Back</a>
                </div>

                <div class="packageDetailHead">
                    <div>
                        <h1 id="heading">Explore Nuwara Eliya</h1>
                        <h2 id="sub-heading">Nuwara Eliya, Sri Lanka</h2>
                    </div>
                    <div class="package-save-btn">
                        <button>Edit</button>
                    </div>
    
                </div>
                
                <div class="image-gallery">
                  <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 1.png" alt="Tea fields">
                  <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 2.png" alt="Tea fields">
                  <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 3.png" alt="Tea fields">
                  <img src="<?=ROOT?>/assets/images/tourGuide/gartmore 4.png" alt="Tea fields">
                </div>
                
                <div class="package-details">
                  <p><strong>Duration:</strong> 2 Days</p>
                  <p><strong>Max people:</strong> 5</p>
                  <p><strong>Rate:</strong> Rs.15000</p>
                </div>
                
                <p class="description">
                  Nuwara Eliya is a city in the tea country hills of central Sri Lanka. The naturally landscaped Hakgala Botanical Gardens displays roses and tree ferns, and shelters monkeys and blue magpies. Nearby Seetha Amman Temple, a colorful Hindu shrine, is decorated with religious figures. The Gregory Lake sits at the center of the city. The city is known for producing Ceylon tea, and for its cool climate.
                </p>
                
                <div class="activities">
                  <li>&bull; Visit Hakgala Botanical Gardens</li>
                  <li>&bull; Explore Seetha Amman Temple</li>
                  <li>&bull; Relax at Gregory Lake</li>
                </div>
                
                <button class="delete-button">Delete package</button>
            </div>              
        </div>
    </body>
</html>