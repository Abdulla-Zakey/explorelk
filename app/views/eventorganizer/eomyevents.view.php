<?php
    $title = "ExploreLK | EO - My Events";
    include '../app/views/components/eonavbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Eventorganizer/eomyevents.css">
    <title><?= $title ?></title>
</head>
<body>
    
    
    <div class="container">
        <div>
            <h2 class="my-events-heading">My Events</h2>
        </div>
        <hr>
        <!-- Search Bar and Create Event Button -->
        <div class="search-bar-container">
            <input type="text" placeholder="Search Events" class="search-bar">
<!--             <button   class="create-event-btn">Create an Event</button>
 -->            <a href="Eocreateevent">
                 <button class="create-event-btn" type="button">Create An Event</button>
            </a>
        </div>

        <!-- Events List -->
        <section class="events">
            <div class="events-header">
                <span>Date</span>
                <span>Event</span>
                <span>Sold</span>
                <span>Income</span>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image.png" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <div class="event-item">
                <div class="date-box">
                    <span class="month">Dec</span>
                    <span class="day">10</span>
                </div>
                <div class="event-info">
                    <img src="<?php echo ROOT; ?>/assets/images/eo/event-image" alt="Event" class="event-image">
                    <div class="event-details">
                        <h3>Batch Welcome Event</h3>
                        <p>UCSC, Reid Avenue, Colombo 00700, Sri Lanka</p>
                        <p>Tuesday, December 10, 2024 at 10.00am to 12.00pm</p>
                    </div>
                </div>
                <div class="event-sold">10/400</div>
                <div class="event-income">Rs10,000</div>
                <div class="event-options">
                    <button class="options-btn">⋮</button>
                </div>
            </div>

            <!-- You can repeat the event-item div for more events -->

        </section>
    </div>
</body>
</html>
