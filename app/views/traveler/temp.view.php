<?php
// var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewParticularEvent.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Traveler/footer.css">
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

        /* Add these styles to your viewParticularEvent.css file */

        .purchaser-details {
            text-align: left;
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .purchaser-details h3 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.6rem;
        }

        .form-group {
            margin-bottom: 12px;
            font-size: 1.4rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007BFF;
        }

        .required {
            color: #e74c3c;
        }

        /* Make sure the popup is large enough for the additional content */
        .popup-content {
            max-height: 80vh;
            overflow-y: auto;
            width: 90%;
            max-width: 500px;
        }

        /* Add validation styling */
        .form-group input.invalid {
            border-color: #e74c3c;
            background-color: #fff6f6;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <?php
        // show($_SESSION['purchaser_details']);
        // exit();
    ?>

    <header>
        <nav class="navbar">
            <div class="backToHome">
                <a href="javascript:void(0);" onclick="window.history.back();">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back</span>
                </a>
            </div>
        </nav>
    </header>

    <div class="event-banner">

        <img src="<?= IMAGES ?>/events/eventWebBannerPics/<?php echo htmlspecialchars($data['eventDetails']->eventWebBannerPath); ?>"
            alt="Whimsical Wonderfest Banner" class="banner-image">

        <div class="event-info">

            <div class="event-details">

                <h1><?php echo htmlspecialchars($data['eventDetails']->eventName); ?></h1>

                <button id="bookNowButton" class="book-now-button">Book Now</button>

            </div>

            <hr>

            <div class="event-details">
                <div class="icon">
                    &#x1F4CD;</span><?php echo htmlspecialchars($data['eventDetails']->eventLocation); ?></span>
                </div>

                <!--To convert 24 hour time into 12 hour format-->
                <?php
                $startTime24 = htmlspecialchars($data['eventDetails']->eventStartTime);
                $endTime24 = htmlspecialchars($data['eventDetails']->eventEndTime);

                // Convert to 12-hour format with AM/PM
                $startTime12 = date("h:i A", strtotime($startTime24));
                $endTime12 = date("h:i A", strtotime($endTime24));

                ?>

                <div class="icon">
                    &#x1F4C5;</span> <?php echo htmlspecialchars($data['eventDetails']->eventDate); ?> </span>
                </div>

                <div class="icon">
                    &#x23F3;</span> From <?php echo $startTime12; ?> to <?php echo $endTime12; ?> </span>
                </div>

            </div>

        </div>

    </div>

    <div class="aboutAndMap-Conatiner">

        <div class="about-event">
            <h1 style="text-align: left;">
                What is <?php echo htmlspecialchars($data['eventDetails']->eventName); ?> ?
            </h1>

            <span>
                <?php echo htmlspecialchars($data['eventDetails']->aboutEvent); ?>
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

            <?php foreach ($data['ticketsDetails'] as $ticket): ?>

                <div class="ticket">

                    <h2>
                        <?php echo htmlspecialchars($ticket->ticketTypeName); ?>
                    </h2>

                    <p>
                        <?php echo htmlspecialchars($ticket->ticketTypeDescription); ?>
                    </p>

                    <span>
                        Rs. <?php echo htmlspecialchars($ticket->pricePerTicket); ?>/=
                    </span>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="TandCPlusConatct-Conatiner">

        <div class="tAndC-Container">

            <h1>Terms and Conditions</h1>

            <?php if (isset($data['termsAndConditions']) && is_array($data['termsAndConditions'])): ?>

                <?php foreach ($data['termsAndConditions'] as $term): ?>

                    <div class="condition-Holder">

                        <div class="icon-holder">
                            <i class="fa-solid fa-circle-dot"></i>
                        </div>

                        <div class="condition">
                            <?= htmlspecialchars($term->termAndCondition); ?>
                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>
                <p>No terms and conditions available at the moment.</p>
            <?php endif; ?>

        </div>

    </div>


    <div class="foot">

        <h1>
            Need Help? Contact the Organizer
        </h1>

        <div class="footer-Items">

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa fa-globe"></i>
                </div>

                <div class="condition">

                    <a href="https://devent.lk/" target="_blank">
                        Visit Their Website
                    </a>

                </div>

            </div>

            <div class="condition-Holder">

                <div class="icon-holder">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="condition">

                    <a href="mailto:mnnjabir@gamil.com?subject=Inquiry">
                        Send Them an Email
                    </a>

                </div>

            </div>

            <div class="condition-Holder" style="margin-right: 7.5%;">

                <div class="icon-holder">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>

                <div class="condition">

                    <a href="https://wa.me/+94715770109" target="_blank" rel="noopener">
                        Contact Them on WhatsApp
                    </a>

                </div>

            </div>

        </div>

    </div>


    <!-------------------------------- Popup for tickets purchasing------------------------------------------------------------------------>

    <div class="popup-overlay" id="popup">
        <div class="popup-content">
            <h2>Select your Category</h2>

            <?php foreach ($data['ticketsDetails'] as $index => $ticket): ?>
                <div class="ticket-item">
                    <div class="ticket-info">
                        <strong><?php echo htmlspecialchars($ticket->ticketTypeName); ?></strong><br>
                        <span id="price<?php echo $index; ?>">Rs.
                            <?php echo htmlspecialchars($ticket->pricePerTicket); ?>/=</span><br>
                        <small><?php echo htmlspecialchars($ticket->ticketTypeDescription); ?></small>
                    </div>

                    <div class="ticket-controls">
                        <button class="control-btn remove-ticket" data-index="<?php echo $index; ?>">-</button>
                        <span class="ticket-count" id="ticketCount<?php echo $index; ?>">0</span>
                        <button class="control-btn add-ticket" data-index="<?php echo $index; ?>">+</button>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="ticket-summary" id="ticketSummary">
                <h3>Your Selection</h3>
                <div class="summary-content" id="summaryContent">
                    <!-- Summary will be populated by JavaScript -->
                </div>
            </div>

            <div class="total">
                Total: Rs. <span id="totalAmount">0</span>/=
            </div>

            <!-- Purchaser details form -->
            <div class="purchaser-details" id="purchaserDetails">
                <h3>Purchaser Information</h3>
                <div class="form-group">
                    <label for="purchaserName">Full Name <span class="required">*</span></label>
                    <input type="text" id="purchaserName" name="purchaserName" required>
                </div>
                <div class="form-group">
                    <label for="purchaserNIC">NIC Number <span class="required">*</span></label>
                    <input type="text" id="purchaserNIC" name="purchaserNIC" required>
                </div>
                <div class="form-group">
                    <label for="purchaserEmail">Email <span class="required">*</span></label>
                    <input type="email" id="purchaserEmail" name="purchaserEmail" required>
                </div>
                <div class="form-group">
                    <label for="purchaserMobile">Mobile Number <span class="required">*</span></label>
                    <input type="tel" id="purchaserMobile" name="purchaserMobile" required>
                </div>

            </div>

            <div class="btn-holder">
                <button id="cancel" class="cancel">Cancel</button>
                <button id="proceed" class="proceed">Proceed</button>
            </div>
        </div>
    </div>

    <script>

        navigator.geolocation.getCurrentPosition(
            (position) => {
                const eventLocation = "<?php echo urlencode($data['eventDetails']->eventLocation); ?>";
                const latitude = position.coords.latitude;
                console.log(latitude);
                const longitude = position.coords.longitude;
                const mapFrame = document.querySelector('#mapFrame');
                mapFrame.src = `https://www.google.com/maps/embed/v1/directions?key=AIzaSyCFbprhDc_fKXUHl-oYEVGXKD1HciiAsz0&origin=${latitude},${longitude}&destination=${eventLocation}&mode=driving`;
            },
            (error) => {
                alert('Unable to retrieve your location. Please check your settings.');
            }
        );

    </script>

    <script>

        // Replace your existing JavaScript for tickets with this updated version
        document.addEventListener('DOMContentLoaded', function () {
            const bookNowButton = document.getElementById('bookNowButton');
            const popup = document.getElementById('popup');
            const totalAmount = document.getElementById('totalAmount');
            const proceedButton = document.querySelector('.proceed');
            const cancelButton = document.querySelector('.cancel');
            const summaryContent = document.getElementById('summaryContent');

            // Form input elements
            const purchaserName = document.getElementById('purchaserName');
            const purchaserEmail = document.getElementById('purchaserEmail');
            const purchaserMobile = document.getElementById('purchaserMobile');
            const purchaserNIC = document.getElementById('purchaserNIC');

            // Object to store ticket counts and prices
            let ticketData = {};

            // Initialize ticket data
            document.querySelectorAll('.ticket-item').forEach((item, index) => {
                const priceElement = document.getElementById(`price${index}`);
                const priceText = priceElement.innerText;

                // Extract only the number part and convert to proper price
                const price = parseFloat(priceText.match(/\d+\.?\d*/)[0]);
                const name = item.querySelector('strong').innerText;

                ticketData[index] = {
                    count: 0,
                    price: price,
                    name: name
                };
            });

            // Add event delegation for dynamically created buttons
            document.addEventListener('click', (e) => {
                if (e.target.classList.contains('add-ticket')) {
                    const index = e.target.dataset.index;
                    ticketData[index].count++;
                    updateDisplay(index);
                }

                if (e.target.classList.contains('remove-ticket')) {
                    const index = e.target.dataset.index;
                    if (ticketData[index].count > 0) {
                        ticketData[index].count--;
                        updateDisplay(index);
                    }
                }
            });

            function updateDisplay(index) {
                // Update count display
                const countElement = document.getElementById(`ticketCount${index}`);
                countElement.textContent = ticketData[index].count;

                // Update total and summary
                updateTotal();
                updateSummary();
            }

            function updateTotal() {
                let total = 0;
                for (const [index, data] of Object.entries(ticketData)) {
                    total += data.count * data.price;
                }

                totalAmount.textContent = total.toFixed(2);  // Format to 2 decimal places

                if (total > 0) {
                    proceedButton.style.backgroundColor = '#007BFF';
                    proceedButton.style.color = 'white';
                    proceedButton.style.cursor = 'pointer';
                } else {
                    proceedButton.style.backgroundColor = '#d3d3d3';
                    proceedButton.style.color = '#888';
                    proceedButton.style.cursor = 'not-allowed';
                }
            }

            function updateSummary() {
                summaryContent.innerHTML = '';
                let hasTickets = false;

                for (const [index, data] of Object.entries(ticketData)) {
                    if (data.count > 0) {
                        hasTickets = true;
                        const summaryItem = document.createElement('div');
                        summaryItem.className = 'summary-item';
                        summaryItem.innerHTML = `
                    <span>${data.name} × ${data.count}</span>
                    <span>Rs. ${(data.count * data.price).toFixed(2)}/=</span>
                `;
                        summaryContent.appendChild(summaryItem);
                    }
                }

                if (!hasTickets) {
                    summaryContent.innerHTML = '<div class="summary-item empty">No tickets selected</div>';
                }
            }

            // Form validation
            function validateForm() {
                let isValid = true;

                // Remove any existing error messages
                document.querySelectorAll('.error-message').forEach(el => el.remove());

                // Reset validation styles
                [purchaserName, purchaserEmail, purchaserMobile, purchaserNIC].forEach(input => {
                    input.classList.remove('invalid');
                });

                // Validate name
                if (!purchaserName.value.trim()) {
                    displayError(purchaserName, 'Name is required');
                    isValid = false;
                }

                // Validate email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(purchaserEmail.value.trim())) {
                    displayError(purchaserEmail, 'Please enter a valid email address');
                    isValid = false;
                }

                // Validate mobile (simple validation for demonstration)
                const mobileRegex = /^\d{10}$/;
                if (!mobileRegex.test(purchaserMobile.value.trim())) {
                    displayError(purchaserMobile, 'Please enter a valid 10-digit mobile number');
                    isValid = false;
                }

                // Validate NIC
                if (!purchaserNIC.value.trim()) {
                    displayError(purchaserNIC, 'NIC number is required');
                    isValid = false;
                }

                return isValid;
            }

            function displayError(input, message) {
                input.classList.add('invalid');
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.textContent = message;
                input.parentNode.appendChild(errorDiv);
            }

            // Show popup when "Book Now" button is clicked
            bookNowButton.addEventListener('click', () => {
                popup.style.display = 'flex';
                updateSummary();
            });

            // Close popup when user clicks the cancel btn
            cancelButton.addEventListener('click', () => {
                popup.style.display = 'none';
                // Reset all counts
                for (const index in ticketData) {
                    ticketData[index].count = 0;
                    document.getElementById(`ticketCount${index}`).textContent = '0';
                }

                // Clear the form fields
                purchaserName.value = '';
                purchaserEmail.value = '';
                purchaserMobile.value = '';
                purchaserNIC.value = '';

                // Remove any error messages
                document.querySelectorAll('.error-message').forEach(el => el.remove());

                // Reset validation styles
                [purchaserName, purchaserEmail, purchaserMobile, purchaserNIC].forEach(input => {
                    input.classList.remove('invalid');
                });

                updateTotal();
                updateSummary();
            });

            // Redirect to checkout on "Proceed" click
            proceedButton.addEventListener('click', () => {
                const total = parseFloat(totalAmount.innerText);
                if (total > 0) {
                    // Validate the form before proceeding
                    if (validateForm()) {
                        const rootUrl = "<?= ROOT ?>";

                        // Build the URL with ticket data and purchaser details
                        let checkoutUrl = `${rootUrl}/traveler/Checkout?total=${Math.round(total * 100)}`;

                        // Add ticket information from ticketData object
                        for (const [index, data] of Object.entries(ticketData)) {
                            if (data.count > 0) {
                                // Use encodeURIComponent to safely encode the ticket name
                                checkoutUrl += `&tickets[${encodeURIComponent(data.name)}]=${data.count}`;
                            }
                        }

                        // Add purchaser details
                        checkoutUrl += `&name=${encodeURIComponent(purchaserName.value.trim())}`;
                        checkoutUrl += `&email=${encodeURIComponent(purchaserEmail.value.trim())}`;
                        checkoutUrl += `&mobile=${encodeURIComponent(purchaserMobile.value.trim())}`;
                        checkoutUrl += `&nic=${encodeURIComponent(purchaserNIC.value.trim())}`;

                        // window.location.href = checkoutUrl;
                        window.open(checkoutUrl, '_blank');
                    }
                } else {
                    alert('Please select at least one ticket before proceeding.');
                }
            });
        });
    </script>

</body>

</html>