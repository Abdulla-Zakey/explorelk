<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/whimsicalWonderfest.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/footer.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Events - Whimsical Wonderfest</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&libraries=places"></script>

    <style>
        .backToHome,
        .nav-links {
            font-size: 1.6rem;
        }

        .foot {
            font-size: 1.4rem;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Home</span>
                </a>
            </div>

        </nav>
    </header>

    <div class="event-banner">

        <img src = "<?= IMAGES ?>/events/whimsicalWonderfestWebBanner.png" alt="Whimsical Wonderfest Banner"
            class="banner-image">

        <div class="event-info">

            <div class="event-details">

                <h1>Whimsical Wonderfest</h1>

                <button id="bookNowButton" class="book-now-button">Book Now</button>

            </div>

            <hr>

            <div class="event-details">
                <div class="icon">
                    &#x1F4CD;</span> Arcade Independence Square, Colombo - 7</p>
                </div>

                <div class="icon">
                    &#x1F4C5;</span> 2024-12-18</p>
                </div>

                <div class="icon">
                    &#x23F3;</span> 6.00 pm onwards</p>
                </div>

            </div>

        </div>

    </div>

    <div class="aboutAndMap-Conatiner">

        <div class="about-event">
            <h1 style="text-align: left;">
                What is whimsical Wonderfest ?
            </h1>

            <span>
                Whimsical Wonderfest is a vibrant carnival filled with thrilling rides, dazzling light displays,
                live entertainment, and interactive games. Perfect for families and friends, it offers delicious treats,
                unique crafts, and magical experiences to create unforgettable memories. A celebration of joy, wonder,
                and togetherness!
            </span>

        </div>

        <div class="mapHolder">

            <h1>
                Find Your Way Here
            </h1>
            <iframe id="mapFrame" width="100%" height="100%" frameborder="0" style="border:0;" loading="lazy"
                allowfullscreen></iframe>

        </div>

    </div>

    <div class="tickets-info">
        <h1>
            Choose Your Tickets
        </h1>

        <div class="tickets-Container">

            <div class="ticket">

                <h2>
                    General Entrance Ticket
                </h2>

                <p>
                    Entry to the carnival for 1 adult
                </p>

                <span>
                    Rs. 250/=
                </span>

            </div>

            <div class="ticket">

                <h2>
                    Kids Entrance Ticket
                </h2>

                <p>
                    Entry to the carnival for a kid under 12
                </p>

                <span>
                    Rs. 150/=
                </span>

            </div>

            <div class="ticket">

                <h2>
                    Family Entrance Ticket
                </h2>

                <p>
                    Discounted entry for families of up to 5 members.
                </p>

                <span>
                    Rs. 999/=
                </span>

            </div>

        </div>

    </div>

    <div id="event-highlights">

        <h1>
            Highlights of the Event
        </h1>

        <div class="highlights-Conatiner">

            <div id="highlight1">

                <div class="highlight">
                    <i class="fa-solid fa-lightbulb"></i> Dazzling Light Displays:
                </div>

                <div class="description">
                    As night falls, the carnival transforms with stunning light displays, creating a magical and
                    enchanting environment.
                </div>

            </div>

            <div id="highlight2">

                <div class="highlight">
                    <i class="fa-solid fa-bolt"></i>Thrilling Rides:
                </div>

                <div class="description">
                    Begin your adventure with exciting roller coasters, classic Ferris wheels, and whimsical carousels
                    for a fun-filled experience.
                </div>

            </div>

            <div id="highlight3">

                <div class="highlight">
                    <i class="fa-solid fa-bullseye"></i>Interactive Games & Prizes:
                </div>

                <div class="description">
                    Test your skills with carnival games like ring toss, balloon darts, or basketball shoots, and win
                    fun prizes!
                </div>

            </div>

            <div id="highlight4">

                <div class="highlight">
                    <i class="fa-solid fa-microphone-alt"></i>Live Performances:
                </div>

                <div class="description">
                    Immerse yourself in the lively atmosphere with captivating music, dance acts, and acrobatic
                    performances that will leave you in awe.
                </div>

            </div>

            <div id="highlight5">

                <div class="highlight">
                    <i class="fa-solid fa-hamburger"></i>Delicious Street Food:
                </div>

                <div class="description">
                    Wrap up your visit by indulging in mouthwatering carnival treats, from classic cotton candy to local
                    delicacies and gourmet snacks.
                </div>


            </div>

        </div>

    </div>

    <div class="TandCPlusConatct-Conatiner">

        <div class="tAndC-Container">

            <h1>
                Terms and Conditions
            </h1>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa-solid fa-circle-dot"></i>
                </div>

                <div class="condition">
                    All ticket purchases are final and non-refundable unless the event is canceled or rescheduled by the
                    organizer.
                </div>

            </div>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa-solid fa-circle-dot"></i>
                </div>

                <div class="condition">
                    Attendees must present a valid ticket (printed or electronic) at the event entrance.
                </div>

            </div>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa-solid fa-circle-dot"></i>
                </div>

                <div class="condition">
                    Any individual engaging in inappropriate behavior, including disruption or violation of safety
                    guidelines, may be denied entry or removed from the event without a refund.
                </div>

            </div>

        </div>

        <!-- <div class="eventOrganizerContact-Container">

            <h1>
                Need Help? Contact the Organizer
            </h1>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa fa-globe"></i>
                </div>

                <div class="condition">

                    <a href="https://devent.lk/" target="_blank">
                        Visit Our Website
                    </a>

                </div>

            </div>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>

                <div class="condition">

                    <a href="https://wa.me/+94715770109" target="_blank" rel="noopener">
                        Contact Us on WhatsApp
                    </a>

                </div>

            </div>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="condition">

                    <a href="mailto:mnnjabir@gamil.com?subject=Inquiry">
                        Email Us
                    </a>

                </div>

            </div>

        </div> -->

    </div>

    <div class="foot">

        <h1>
            Need Help? Contact the Organizer
        </h1>

        <div class = "footer-Items">

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa fa-globe"></i>
                </div>
    
                <div class="condition">
    
                    <a href="https://devent.lk/" target="_blank">
                        Visit Our Website
                    </a>
    
                </div>
    
            </div>
    
            <div class="condition-Holder" style="margin-right: 7.5%;">
    
                <div class="icon-holder">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
    
                <div class="condition">
    
                    <a href="https://wa.me/+94715770109" target="_blank" rel="noopener">
                        Contact Us on WhatsApp
                    </a>
    
                </div>
    
            </div>
    
            <div class="condition-Holder" >
    
                <div class="icon-holder">
                    <i class="fa-solid fa-envelope"></i>
                </div>
    
                <div class="condition">
    
                    <a href="mailto:mnnjabir@gamil.com?subject=Inquiry">
                        Email Us
                    </a>
    
                </div>
    
            </div>

        </div>
        
    </div>


    <!-------------------------------- Popup for tickets purchasing------------------------------------------------------------------------>
    <div class="popup-overlay" id="popup">

        <div class="popup-content">

            <h2>Select your Category</h2>

            <div class="ticket-item">

                <div>
                    <strong>General Entrance Ticket</strong><br>
                    <span id="price1">LKR 250.00</span><br>
                    <small>Entry to the carnival for 1 adult</small>
                </div>

                <div class="btn-holder">
                    <button id="removeTicketButton1">-</button>
                    <button id="addTicketButton1">+</button>
                </div>

            </div>

            <div class="ticket-item">
                <div>
                    <strong>Kids Entrance Ticket</strong><br>
                    <span id="price2">LKR 150.00</span><br>
                    <small>Entry to the carnival for a kid under 12</small>
                </div>

                <div class="btn-holder">
                    <button id="removeTicketButton2">-</button>
                    <button id="addTicketButton2">+</button>
                </div>

            </div>

            <div class="ticket-item">
                <div>
                    <strong>Family Entrance Ticket</strong><br>
                    <span id="price3">LKR 999.00</span><br>
                    <small> Discounted entry for families of up to 5 members.</small>
                </div>

                <div class="btn-holder">
                    <button id="removeTicketButton3">-</button>
                    <button id="addTicketButton3">+</button>
                </div>

            </div>

            <div class="total">Total: LKR <span id="totalAmount">0</span></div>

            <div class="btn-holder">
                <button id="cancel" class="cancel">Cancel</button>
                <button id="proceed" class="proceed">Proceed</button>
            </div>

        </div>
    </div>


    <script>
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const mapFrame = document.querySelector('#mapFrame');
                mapFrame.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyBZgc6GQyFZJMGfChxxenQtMmcZyiwryM4&origin=${latitude},${longitude}&destination=Arcade+Independence+Square,+Colombo,+Sri+Lanka&mode=driving`;
            },
            (error) => {
                alert('Unable to retrieve your location. Please check your settings.');
            }
        );

    </script>

    <script>

        const bookNowButton = document.getElementById('bookNowButton');
        const popup = document.getElementById('popup');

        const addTicketButton1 = document.getElementById('addTicketButton1');
        const addTicketButton2 = document.getElementById('addTicketButton2');
        const addTicketButton3 = document.getElementById('addTicketButton3');

        const removeTicketButton1 = document.getElementById('removeTicketButton1');
        const removeTicketButton2 = document.getElementById('removeTicketButton2');
        const removeTicketButton3 = document.getElementById('removeTicketButton3');

        const totalAmount = document.getElementById('totalAmount');

        const proceedButton = document.querySelector('.proceed');
        const cancelButton = document.querySelector('.cancel');

        const priceText1 = document.getElementById('price1').innerText;
        const priceText2 = document.getElementById('price2').innerText;
        const priceText3 = document.getElementById('price3').innerText;

        const numericPrice1 = priceText1.replace('LKR', '').trim();
        const numericPrice2 = priceText2.replace('LKR', '').trim();
        const numericPrice3 = priceText3.replace('LKR', '').trim();

        const price1 = parseFloat(numericPrice1);
        const price2 = parseFloat(numericPrice2);
        const price3 = parseFloat(numericPrice3);

        let total = 0; // Initialize total amount

        // Show popup when "Book Now" button is clicked
        bookNowButton.addEventListener('click', () => {
            popup.style.display = 'flex';                                     // Show the popup 
        });


        addTicketButton1.addEventListener('click', () => {
            total += price1;                                                  // Add ticket price (LKR 250)
            totalAmount.textContent = total;                                  // Update total amount displayed
            proceedButton.style.backgroundColor = '#007BFF';                  // Enable Proceed button
            proceedButton.style.color = 'white';
            proceedButton.style.cursor = 'pointer';
        });

        addTicketButton2.addEventListener('click', () => {
            total += price2;                                                  // Add ticket price (LKR 150)
            totalAmount.textContent = total;                                  // Update total amount displayed
            proceedButton.style.backgroundColor = '#007BFF';                  // Enable Proceed button
            proceedButton.style.color = 'white';
            proceedButton.style.cursor = 'pointer';
        });

        addTicketButton3.addEventListener('click', () => {
            total += price3;                                                 // Add ticket price (LKR 999)
            totalAmount.textContent = total;                                 // Update total amount displayed
            proceedButton.style.backgroundColor = '#007BFF';                  // Enable Proceed button
            proceedButton.style.color = 'white';
            proceedButton.style.cursor = 'pointer';
        });

        removeTicketButton1.addEventListener('click', () => {
            if (total > 0) {
                total -= price1;                                          // Add ticket price (LKR 250)
                totalAmount.textContent = total;                          // Update total amount displayed
                if (total === 0) {
                    proceedButton.style.backgroundColor = '#d3d3d3';     // Disable Proceed button
                    proceedButton.style.color = '#888';
                    proceedButton.style.cursor = 'not-allowed';
                }
            }
        });

        removeTicketButton2.addEventListener('click', () => {
            if (total > 0) {
                total -= price2;                                        // Add ticket price (LKR 150)
                totalAmount.textContent = total;                        // Update total amount displayed
                if (total === 0) {
                    proceedButton.style.backgroundColor = '#d3d3d3';    // Disable Proceed button
                    proceedButton.style.color = '#888';
                    proceedButton.style.cursor = 'not-allowed';
                }
            }
        });

        removeTicketButton3.addEventListener('click', () => {
            if (total > 0) {
                total -= price3;                                       // Reduce ticket price (LKR 999)
                totalAmount.textContent = total;                      // Update total amount displayed
                if (total === 0) {
                    proceedButton.style.backgroundColor = '#d3d3d3'; // Disable Proceed button
                    proceedButton.style.color = '#888';
                    proceedButton.style.cursor = 'not-allowed';
                }
            }
        });

        // Close popup when user clicks the cancel btn
        cancelButton.addEventListener('click', () => {
            popup.style.display = 'none';                           // Hide popup
            total -= total;
            totalAmount.textContent = total;                        // Update total amount displayed
            proceedButton.style.backgroundColor = '#d3d3d3';        // Disable Proceed button
            proceedButton.style.color = '#888';
            proceedButton.style.cursor = 'not-allowed';

        });

        // Redirect to checkout on "Proceed" click
        proceedButton.addEventListener('click', () => {
            const total = parseFloat(totalAmount.innerText);
            if (total > 0) {
                // Redirect to the controller with total amount as a parameter
                const rootUrl = "<?= ROOT ?>"; // Get the root URL dynamically
                window.location.href = `${rootUrl}/traveler/Checkout?total=${total * 100}`;
            } else {
                alert('Please select at least one ticket before proceeding.');
            }
        });

    </script>


</body>

</html>