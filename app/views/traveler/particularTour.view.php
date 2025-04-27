<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewParticularTour.css">
    <link rel="icon" href="<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Tour Name</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

    <style>
        .backToHome,
        .nav-links {
            font-size: 1.6rem;
        }

        .foot {
            font-size: 1.4rem;
        }

        /* styles for the image carousal */

        .gallery-container {
            width: 100%;
            padding: 2rem 2.5% 2rem 2.5%;
            margin-top: 0%;
            margin-right: 5%;
            /* border: 1px solid black; */
            /* box-sizing: border-box; */

        }

        .slider-wrapper {
            position: relative;
            max-width: 48rem;
            margin: auto;
        }

        .slider {
            display: flex;
            aspect-ratio: 16/9;
            overflow-x: scroll;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            /* box-shadow: 0 1.5rem 3rem -0.75rem hsla(0, 0, 0, 0.25); */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 1);
            border-radius: 0.5rem;
            scrollbar-width: hidden;
        }

        /* Hide scrollbar on Webkit browsers (Chrome, Safari) */
        .slider::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar on Firefox */
        .slider {
            scrollbar-width: none;
        }

        .slider img {
            flex: 1 0 100%;
            scroll-snap-align: start;
            object-fit: cover;
            max-width: 100%;
        }

        .slider-nav {
            display: flex;
            column-gap: 1rem;
            position: absolute;
            bottom: 1.25rem;
            left: 50%;
            transform: translate(-50%);
            z-index: 100;
        }

        .slider-nav a {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: white;
            opacity: 0.5;
            transition: opacity ease 250ms;
        }

        .slider-nav a:hover {
            opacity: 1;
        }


        /*Styles for the popup */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 3rem;
            border-radius: 1rem;
            width: 90%;
            max-width: 50rem;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .popup-header h2 {
            margin: 0;
            font-size: 2.4rem;
            color: #333;
        }

        .close-btn {
            font-size: 2.25rem;
            cursor: pointer;
            color: #666;
            transition: color 0.3s;
        }

        .close-btn:hover {
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1.4rem;
            color: #444;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            box-sizing: border-box;
            border: 1px solid #d3d3d3;
            border-radius: 1rem;
            font-size: 1.4rem;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group small {
            display: block;
            margin-top: 0.5rem;
            color: #666;
            font-size: 1.2rem;
        }

        .price-summary {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 1rem;
            margin: 2rem 0;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 1.4rem;
        }

        .price-row:last-child {
            margin-bottom: 0;
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 0.5rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .submit-btn,
        .cancel-btn {
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 1rem;
            font-size: 1.4rem;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'poppins';
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #da190b;
        }


        /* Styles for the day tabs */

        .itinerary-container {
            width: 80%;
            margin-top: 1.25%;
            padding: 2.5%;
            box-sizing: border-box;
            border-radius: 1rem;
            background-color: rgba(255, 255, 255, 0.8);

        }

        .topic {
            margin-bottom: 2.5rem;
            font-size: 2.4rem;
            font-weight: 700;
        }

        .day-tabs {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
        }

        .day-tab {
            padding: 1rem 2rem;
            border: none;
            border-radius: 0.8rem;
            background-color: #f1f1f1;
            color: darkcyan;
            font-size: 1.6rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'poppins';
        }

        .day-tab:hover {
            background-color: #e0e0e0;
        }

        .day-tab.active {
            background-color: darkcyan;
            color: white;
        }


        .timeline {
            margin-top: 2.5rem;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 5rem;
            color: #333;
            font-size: 1.7rem;
        }

        .timeline-item i {
            color: darkcyan;
            margin-right: 1.5rem;
            font-size: 1.6rem;
            margin-top: 0.35rem;
        }

        .timeline-item p {
            margin-top: 0.5rem;
            color: #666;
            font-size: 1.5rem;
        }

        .timeline-item strong {
            font-size: 1.7rem;
            color: darkcyan;
        }


        /* Styles for day content */
        .day-content {
            display: none;
        }

        .day-content.active {
            display: block;
        }

        .availability-status {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }

        .availability-status i {
            font-size: 2rem;
            margin-right: 1rem;
        }

        .availability-status.available {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }

        .availability-status.unavailable {
            background-color: rgba(255, 152, 0, 0.1);
            color: #FF9800;
        }

        .unavailable-dates {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
        }

        .date-badge {
            background-color: #f1f1f1;
            color: #f44336;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
        }

        .date-badge i {
            margin-right: 0.5rem;
        }

        .note {
            font-size: 1.3rem;
            color: #666;
            margin-top: 1.5rem;
        }
    </style>

</head>

<body>

    <?php
    // show($data);
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


    <div class="main-container">

        <div class="hero">

            <div class="hero-left">

                <div class="tourName-conatiner">
                    <?= $data['tourData']->name ?> <!--Tour Name-->
                </div>

                <div class="tourDescription-container">
                    <?= $data['tourData']->description ?>
                </div>

            </div>

            <div class="hero-right">

                <div class="gallery-container">
                    <div class="slider-wrapper">
                        <div class="slider">
                            <?php foreach ($data['tourImages'] as $index => $pic): ?>
                                <img id="slide<?= $index + 1 ?>" src="<?= ROOT . $pic->image_path ?>" alt="District Image">

                            <?php endforeach; ?>

                            <div class="slider-nav">
                                <?php foreach ($data['tourImages'] as $index => $pic): ?>
                                    <a href="#slide<?= $index + 1 ?>"></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="basic-info">
            <div>
                <i class="fa fa-usd" aria-hidden="true"></i>Price per Person: <?= $data['tourData']->package_price ?>
                LKR
            </div>
            <div>
                <i class="fa fa-users" aria-hidden="true"></i> Group Size: <?= $data['tourData']->group_size ?> people
            </div>
            <div>
                <i class="fa-regular fa-clock"></i>
                Duration: <?= $data['tourData']->duration_days > 1 ?
                    $data['tourData']->duration_days . ' days' : $data['tourData']->duration_days . ' day' ?>
            </div>

            <button class="bookNow-btn">
                <i class="fas fa-shopping-cart"></i>Book Now
            </button>

        </div>

        <div class="itenaryAndAvailableDates-container">

            <div class="itinerary-container">
                <span class="topic">Tour Itinerary</span>

                <!-- Day tabs for multi-day itineraries -->
                <?php if ($data['totalDays'] > 1): ?>
                    <div class="day-tabs">
                        <?php foreach ($data['itineraryDays'] as $index => $day): ?>
                            <button class="day-tab <?= $index === 0 ? 'active' : '' ?>" data-day="<?= $day->day_number ?>">
                                Day <?= $day->day_number ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Itinerary content for each day -->
                <?php foreach ($data['itineraryData'] as $dayNumber => $dayData): ?>
                    <div id="day-<?= $dayNumber ?>" class="day-content <?= $dayNumber === 1 ? 'active' : '' ?>">
                        <ul type="none" class="timeline">
                            <?php foreach ($dayData['activities'] as $activity): ?>
                                <li class="timeline-item">
                                    <div>
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <div>
                                        <strong><?= $activity->activity_time ?></strong> - <?= $activity->title ?>
                                        <p><?= $activity->description ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="availableDates-container">
                <div class="availableDates">
                    <span class="topic">Guide Availability</span>

                    <?php if (empty($data['unavailableDates'])): ?>
                        <div class="availability-status available">
                            <i class="fa fa-check-circle"></i>
                            <p>Guide is available all days this month (<?= $data['currentMonth'] ?>)</p>
                        </div>
                    <?php else: ?>
                        <div class="availability-status unavailable">
                            <i class="fa fa-info-circle"></i>
                            <p>The guide is not available on the following dates:</p>
                        </div>

                        <div class="unavailable-dates">
                            <?php foreach ($data['unavailableDates'] as $date): ?>
                                <div class="date-badge">
                                    <i class="fa fa-calendar-times-o"></i>
                                    <?= date('M j, Y (D)', strtotime($date)) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <p class="note">
                        <i class="fa fa-info-circle"></i> Showing availability for the current month only.
                    </p>
                </div>

                <div class="linkToGuideProfile-container">

                    <span class="topic">Other Tours from this Guide</span>

                    <p>
                        This experienced guide has curated a variety of immersive tours to showcase the best of Sri
                        Lanka.
                    </p>

                    <center>
                        <a href="<?= ROOT ?>/traveler/ViewTourGuideProfile/index/<?= $data['tourData']->guide_id ?>">
                            <button class="bookNow-btn" style="width: 60%; margin: auto;">
                                <i class="fa fa-search"></i> View Guide Profile
                            </button>
                        </a>

                    </center>

                </div>
            </div>

        </div>

        <?php if (!empty($data['inclusion']) || !empty($data['exclusion'])): ?>
            <div class="inclusionAndexclusion-container">

                <?php if (!empty($data['inclusion'])): ?>
                    <div class='inclusions'>
                        <span class="topic">What is Included</span>
                        <br>
                        <ul type="none">
                            <?php
                            $inclusions = array_filter(array_map('trim', explode('.', $data['inclusion'])));
                            foreach ($inclusions as $item):
                                ?>
                                <li>

                                    <div><i class="fa fa-check-square" aria-hidden="true"></i></div>
                                    <div><?= htmlspecialchars($item) ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($data['exclusion'])): ?>
                    <div class='exclusions'>
                        <span class="topic">What is Not Included</span>
                        <br>
                        <ul type="none">
                            <?php
                            $exclusions = array_filter(array_map('trim', explode('.', $data['exclusion'])));
                            foreach ($exclusions as $item):
                                ?>
                                <li>
                                    <div><i class="fa fa-times-circle" aria-hidden="true"></i></div>
                                    <div><?= htmlspecialchars($item) ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>


    </div>

    <!--Popup container to place booking request-->
    <div id="bookingPopup" class="popup-overlay">

        <div class="popup-content">

            <div class="popup-header">
                <h2>Secure Your Spot Now</h2>
                <span class="close-btn">&times;</span>
            </div>

            <form id="bookingForm" method="POST"
                action="<?= ROOT ?>/traveler/viewParticularTour/createBookingRequest/<?= $data['tourData']->package_id ?>">

                <div class="form-group">
                    <label for="tourDate">Select Tour Date:</label>
                    <input type="date" id="tourDate" name="tourDate" required>
                    <small id="dateHelp" class="form-text">Please select an available date for your tour.</small>
                </div>

                <div class="form-group">
                    <label for="numberOfPeople">Number of People:</label>
                    <input type="number" id="numberOfPeople" name="numberOfPeople"
                        placeholder="Group size: 10-15 people" min="1" max="15" required>
                </div>

                <div class="form-group">
                    <label for="specialRequests">Special Requests:</label>
                    <textarea id="specialRequests" name="specialRequests" rows="5"
                        placeholder="Any dietary requirements or special needs?"></textarea>
                </div>

                <div class="price-summary">
                    <div class="price-row">
                        <span>Price per person:</span>
                        <span><?= $data['tourData']->package_price ?> LKR</span>
                    </div>

                    <div class="price-row" id="totalPrice">
                        <span>Total Price:</span>
                        <span id="spanElementTotalAmount">0 </span>
                    </div>
                </div>

                <!-- Hidden input fields to pass relevant booking data -->
                <input type="hidden" name="guide_id" value="<?= $data['tourData']->guide_id ?>">
                <input type="hidden" id="hiddenTotalAmount" name="totalAmount" value="">

                <div class="form-actions">
                    <button type="submit" class="submit-btn">Submit Booking
                        Request</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>

            </form>

        </div>

    </div>

    <!-- <script>
        function proceedToBooking() {
            let totalAmountText = document.getElementById('spanElementTotalAmount').textContent.trim();

            // Remove "LKR" and any spaces
            let numericAmount = totalAmountText.replace('LKR', '').trim();

            // Set the cleaned value to the hidden input
            document.getElementById('hiddenTotalAmount').value = numericAmount;

            // Submit the form
            document.getElementById('bookingForm').submit();
        }
    </script> -->


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Tab switching functionality
            const dayTabs = document.querySelectorAll('.day-tab');

            if (dayTabs.length > 0) {
                dayTabs.forEach(tab => {
                    tab.addEventListener('click', function () {
                        // Remove active class from all tabs and content
                        document.querySelectorAll('.day-tab').forEach(t => t.classList.remove('active'));
                        document.querySelectorAll('.day-content').forEach(c => c.classList.remove('active'));

                        // Add active class to clicked tab
                        this.classList.add('active');

                        // Show corresponding content
                        const dayNumber = this.getAttribute('data-day');
                        const dayContent = document.getElementById(`day-${dayNumber}`);
                        if (dayContent) {
                            dayContent.classList.add('active');
                        }
                    });
                });
            }

            // Booking popup functionality
            const bookNowBtn = document.querySelector('.bookNow-btn');
            const popup = document.getElementById('bookingPopup');
            const closeBtn = document.querySelector('.close-btn');
            const cancelBtn = document.querySelector('.cancel-btn');
            const bookingForm = document.getElementById('bookingForm');
            const numberOfPeople = document.getElementById('numberOfPeople');
            const totalPriceElement = document.getElementById('totalPrice').lastElementChild;
            const tourDateInput = document.getElementById('tourDate');

            // Get unavailable dates from PHP
            const unavailableDates = <?= json_encode($data['unavailableDates']) ?>;

            // Set min date to today and max date to end of next month
            const today = new Date();
            const maxDate = new Date();
            maxDate.setMonth(maxDate.getMonth() + 2, 0); // End of next month

            tourDateInput.min = today.toISOString().split('T')[0];
            tourDateInput.max = maxDate.toISOString().split('T')[0];

            // Disable unavailable dates when the input is clicked
            tourDateInput.addEventListener('input', function () {
                const selectedDate = this.value;

                if (unavailableDates.includes(selectedDate)) {
                    document.getElementById('dateHelp').textContent = 'Sorry, this date is not available. Please select another date.';
                    document.getElementById('dateHelp').style.color = '#f44336';
                    this.value = ''; // Clear the selection
                } else {
                    document.getElementById('dateHelp').textContent = 'Date selected!';
                    document.getElementById('dateHelp').style.color = '#4CAF50';
                }
            });

            // Show popup
            bookNowBtn.addEventListener('click', function () {
                popup.style.display = 'flex';
            });

            // Close popup functions
            function closePopup() {
                popup.style.display = 'none';
                bookingForm.reset();
                totalPriceElement.textContent = `0 LKR`;
            }

            closeBtn.addEventListener('click', closePopup);
            cancelBtn.addEventListener('click', closePopup);

            // Close when clicking outside
            popup.addEventListener('click', function (e) {
                if (e.target === popup) {
                    closePopup();
                }
            });

            const pricePerPerson = <?= $data['tourData']->package_price ?>; // Get actual package price

            // Calculate total price
            numberOfPeople.addEventListener('input', function () {
                const people = this.value;
                const total = people * pricePerPerson;
                totalPriceElement.textContent = `${total.toLocaleString()} LKR`;
                document.getElementById('hiddenTotalAmount').value = total; // Update hidden input value
            });

            
           
        });
    </script>

</body>

</html>