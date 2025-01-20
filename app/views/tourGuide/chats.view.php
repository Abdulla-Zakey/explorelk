<!DOCTYPE html>
<html lang="en">
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
    
            <div class="body-container flexContainer">
                <div class="sidebar">
                    <div class="heading">
                        <h2>Messages</h2>
                    </div>
                    <div class="contact">
                        <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="James Bond">
                        <div class="contact-info">
                            <p class="name">James Bond</p>
                            <p class="preview">Thank you! That was very helpful!</p>
                        </div>
                    </div>
                    <div class="contact">
                        <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Kate Upton">
                        <div class="contact-info">
                            <p class="name">Kate Upton</p>
                            <p class="preview">See you at the location.</p>
                        </div>
                    </div>
                    <div class="contact active">
                        <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Beth Moonie">
                        <div class="contact-info">
                            <p class="name">Beth Moonie</p>
                            <p class="preview">And finish with a visit to the viewpoint for sunset.</p>
                        </div>
                    </div>
                    <div class="contact">
                        <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Will Jacks">
                        <div class="contact-info">
                            <p class="name">Will Jacks</p>
                            <p class="preview">We provide refunds, if you cancel prior 3 days to the event.</p>
                        </div>
                    </div>
                </div>
                <div class="chat">
                    <div class="chat-header">
                        <img src="<?=ROOT?>/assets/images/tourGuide/profile.png" alt="Beth Moonie">
                        <h3>Beth Moonie</h3>
                    </div>
                    <div class="chat-messages">
                        <div class="message">Hello</div>
                        <div class="message">Are you the tour guide for the city tour?</div>
                        <div class="message reply">Yes, that’s me! Welcome! Are you excited to explore the city?</div>
                        <div class="message">Absolutely! I heard there are some amazing spots there. Where will we be going?</div>
                        <div class="message reply">We’ll start with the historic old town.</div>
                        <div class="message reply">Then head to the main market for some local snacks.</div>
                        <div class="message reply">And finish with a visit to the viewpoint for sunset.</div>
                    </div>
                    <div class="chat-input">
                        <input type="text" placeholder="Message...">
                        <button>&#x27A4;</button>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
