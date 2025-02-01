<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href = "<?= CSS ?>/Traveler/viewParticularTour.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
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

    </style>

</head>

<body>

    <header>
        <nav class="navbar">

            <div class="backToHome">
                <a href="<?= ROOT ?>/traveler/RegisteredTravelerHome">
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
                    Ella Adventure <!--Tour Name-->
                </div>

                <div class="tourDescription-container">
                    Immerse yourself in the breathtaking beauty of lush green hills,
                    cascading waterfalls, and serene tea plantations as you explore one of Sri Lanka’s most picturesque
                    destinations.
                    The Ella Adventure tour is designed for nature lovers, thrill-seekers, and anyone looking to escape
                    the ordinary.

                </div>

            </div>

            <div class="hero-right">
                <img src="<?= ROOT ?>/assets/images/travelers/dashboard/guidedNatureHikes.jpg" alt = "Tour Image">
            </div>

        </div>

        <div class="basic-info">
            <div>
                <i class="fa fa-usd" aria-hidden="true"></i>Price per Person: 7500 LKR
            </div>
            <div>
                <i class="fa fa-users" aria-hidden="true"></i> Group Size: 10 - 15 people
            </div>
            <div>
                <i class="fa-regular fa-clock"></i>Duration: 1 day
            </div>

            <button class="bookNow-btn">
                <i class="fas fa-shopping-cart"></i>Book Now
            </button>

        </div>

        <div class = "itenaryAndAvailableDates-container">

            <div class="itinerary-conatiner">

                <span class="topic">Tour Itinerary</span>
    
                <ul type="none" class="timeline">
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>6:00 AM</strong> - Pickup from Ella Railway Station
                            <p>Meet your guide and fellow travelers</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>6:30 AM</strong> - Little Adam's Peak Hike
                            <p>Begin your hike to enjoy stunning sunrise views from the top.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>8:30 AM</strong> - Refreshment Break
                            <p>Enjoy a light snack and bottled water provided by your guide.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>9:00 AM </strong> - Visit Nine Arches Bridge
                            <p>Walk to the iconic bridge, one of Sri Lanka's architectural marvels</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>11:30 AM</strong> - Ravana Falls
                            <p>Stop at this majestic waterfall for photos and exploration.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>12:30 PM</strong> - Local Lunch
                            <p>Savor traditional Sri Lankan dishes at a handpicked local restaurant.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>2:00 PM</strong> - Ella Rock Hike
                            <p>Embark on a guided hike to the summit of Ella Rock.</p>
                        </div>
                    </li>
    
                    <li class="timeline-item">
                        <div>
                            <i class="fa fa-clock"></i>
                        </div>
                        <div>
                            <strong>6:00 PM</strong> - Drop-off at Ella Railway Station
                            <p>End the adventure-packed day with a safe return and Say goodbye to your guide and fellow
                                travelers.</p>
                    </li>
                </ul>
    
            </div>

            <div class = "availableDates-container">

                <div class = "availableDates">
                    <span class="topic">Available Dates</span>

                    <ul type = "none">
                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-07" readonly>
                            </div>
                        </li>
                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-14" readonly>
                            </div>
                        </li>
                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-21" readonly>
                            </div>
                        </li>

                        <li>
                            <div class = "dateIconHolder">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class = "date">
                                <input type = "date" value = "2025-02-28" readonly>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class = "linkToGuideProfile-container">

                    <span class="topic">Other Tours from this Guide</span>

                    <p>
                        This experienced guide has curated a variety of immersive tours to showcase the best of Sri Lanka. 
                    </p>

                    <center>
                        <a href = "<?= ROOT ?>/traveler/ViewTourGuideProfile">
                            <button class = "bookNow-btn" style="width: 60%; margin: auto;">
                                <i class="fa fa-search"></i> View Guide Profile
                            </button>
                        </a>
    
                    </center>
                    
                </div>
            </div>

        </div>

        <div class="inclusionAndexclusion-container">
            <div class='inclusions'>
                <span class="topic">
                    What is Included
                </span>
                <br>

                <ul type="none">
                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Pickup and drop-off from Ella Railway Station in an air-conditioned vehicle.
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Guided hike to Ella Rock, Little Adam’s Peak, Nine Arches Bridge, and Ravana Falls
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Complimentary breakfast/snacks, bottled water, and lunch at a local restaurant
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-check-square" aria-hidden="true"></i>
                        </div>
                        <div>
                            Sinhala, Tamil and English speaking guide to ensure a seamless and informative experience
                        </div>
                    </li>

                </ul>

            </div>

            <div class="exclusions">
                <span class="topic">
                    What is Excluded
                </span>
                <br>

                <ul type="none">

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Dinner & Alcoholic Beverages are not included
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Optional Activities: Ziplining at Flying Ravana Adventure Park or similar activities.
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Personal Expenses: Souvenirs, additional snacks, or purchases during the tour.
                        </div>
                    </li>

                    <li>
                        <div>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div>
                            Insurance: Travel or medical insurance is not provided
                        </div>
                    </li>

                </ul>


            </div>

        </div>

    </div>

    <!--Popup container to place booking request-->
    <div id = "bookingPopup" class = "popup-overlay">

        <div class = "popup-content">

            <div class = "popup-header">
                <h2>Secure Your Spot Now</h2>
                <span class = "close-btn">&times;</span>
            </div>

            <form id = "bookingForm" method = "POST">

                <div class = "form-group">
                    <label for = "tourDate">Select Tour Date:</label>
                    <select id = "tourDate" name = "tourDate" required>
                        <option value="" disabled selected>Choose a date</option>
                        <option value="2025-02-07">February 7, 2025</option>
                        <option value="2025-02-14">February 14, 2025</option>
                        <option value="2025-02-21">February 21, 2025</option>
                        <option value="2025-02-28">February 28, 2025</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="numberOfPeople">Number of People:</label>
                    <input type = "number" id = "numberOfPeople" name = "numberOfPeople" placeholder = "Group size: 10-15 people" min = "1" max = "15" required>
                </div>

                <div class = "form-group">
                    <label for = "specialRequests">Special Requests:</label>
                    <textarea id = "specialRequests" name = "specialRequests" rows = "5" placeholder = "Any dietary requirements or special needs?"></textarea>
                </div>

                <div class="price-summary">
                    <div class="price-row">
                        <span>Price per person:</span>
                        <span>7500 LKR</span>
                    </div>

                    <div class="price-row" id="totalPrice">
                        <span>Total Price:</span>
                        <span>0 LKR</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="submit-btn">Submit Booking Request</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookNowBtn = document.querySelector('.bookNow-btn');
            const popup = document.getElementById('bookingPopup');
            const closeBtn = document.querySelector('.close-btn');
            const cancelBtn = document.querySelector('.cancel-btn');
            const bookingForm = document.getElementById('bookingForm');
            const numberOfPeople = document.getElementById('numberOfPeople');
            const totalPriceElement = document.getElementById('totalPrice').lastElementChild;

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

            // Calculate total price
            numberOfPeople.addEventListener('input', function () {
                const people = this.value;
                const pricePerPerson = 7500;
                const total = people * pricePerPerson;
                totalPriceElement.textContent = `${total.toLocaleString()} LKR`;
            });

            // Form submission
            bookingForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Get form values
                const formData = {
                    tourDate: document.getElementById('tourDate').value,
                    numberOfPeople: document.getElementById('numberOfPeople').value,
                    specialRequests: document.getElementById('specialRequests').value,
                    totalPrice: totalPriceElement.textContent
                };

                // Here you would typically send this data to your server
                console.log('Booking Request:', formData);

                // Show success message
                alert('Booking request submitted successfully! The tour guide will review your request.');

                // Close popup
                closePopup();
            });
        });
    </script>


</body>

</html>