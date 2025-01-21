<?php
    // var_dump($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/navbar.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/viewAllEvents.css">
    <link rel="stylesheet" href="<?= CSS ?>/Traveler/currentlyNoEvents.css">
    <link rel = "icon" href = "<?= IMAGES ?>/logos/logoBlack.svg">
    <title>ExploreLK | Upcoming Events</title>
    <script src="https://kit.fontawesome.com/f35c1c7a11.js" crossorigin="anonymous"></script>

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

    <div class = "main-container">

        <span class="heading">Upcoming Events</span>
        
        <span class = "subHeading">Join exclusive experiences organized just for you by local experts</span>

        <div class="search-bar">
            
            <i class="fa fa-search" aria-hidden="true"></i>
            <input  type="text" id="search" placeholder="Search Events">
                
        </div>

        <div class="category-filters">
            <button class="category-btn active">All Events</button>
            <button class="category-btn">Carnivals</button>
            <button class="category-btn">Magic Shows</button>
            <button class="category-btn">Music Concerts</button>
            <button class="category-btn">Sports</button>
            <button class="category-btn">Other</button>
        </div>

        <?php 

            if(!empty($data['eventDetails'])){
                $counter = 0;

                foreach($data['eventDetails'] as $event){
                    if($counter % 3 == 0){
                        echo "<div class = 'events-grid'>";
                    }

                    $animationDelay = ($counter % 3) * 0.2;

                        echo "<div class='event-container new-event' style = 'animation-delay: {$animationDelay}s;'>";
                    
        ?>
                    
                        <div class="event-banner">
                                <img src="<?= IMAGES ?>/events/eventThumbnailPics/<?= htmlspecialchars($event->eventThumnailPic) ?>" alt = "<?= htmlspecialchars($event->eventName) ?>">
                        </div>

                        <div class="event-name"><?= htmlspecialchars($event->eventName) ?></div>

                        <div class="dateAndLocation-container">

                            <div class="eventLocation-container">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($event->eventLocation) ?></span>
                            </div>

                            <div class="eventDate-container">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($event->eventDate) ?></span>
                            </div>

                        </div>

                        <div class="btn-container">
                            <a href = "<?= ROOT ?>/traveler/ViewParticularEvent/index/<?= htmlspecialchars($event->event_Id) ?>">
                                <button class="btn">View Details</button>
                            </a>
                        </div>
        
        <?php
                    echo '</div>';  // Close event-container

                    $counter++;
                
                    if($counter % 3 == 0 || $counter == count($data['eventDetails'])){
                        echo '</div>'; // Close event-grid
                    }
                        
                }

            }

            /*The below part is not necessary, because if there is no upcoming events, we dont show the see more button in the homepage. 
            But we are giving view upcoming events button in the particular district view as well as particular attractons view. 
            So for that if there is no upcoming events registered with us. We need this. So dont remove this*/

            else{
                echo '<div class="no-events-container">';

                    echo '<div class="no-events-content">';

                        echo '<div class="calendar-icon">';
                            echo '<div class="calendar-top"></div>';
                            echo '<div class="calendar-body">';
                                echo '<div class="cross">×</div>';
                            echo '</div>';
                        echo '</div>';

                        echo '<h3>Currently No Upcoming Events</h3>';
                        echo '<p class = "para">We are working on bringing exciting new experiences your way. Check back soon!</p>';

                    echo '</div>';

                echo '</div>';
            }

        ?>

    </div>

    <!--search functionality-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const mainContainer = document.querySelector('.main-container');
    
            // Function to perform search
            const performSearch = () => {
                const searchTerm = searchInput.value.trim();
        
                // Only search if there's text
                if (searchTerm) {
                    const formData = new FormData();
                    formData.append('search', searchTerm);

                    // Show loading state if needed
                    // mainContainer.classList.add('loading');

                    fetch('<?= ROOT ?>/traveler/ViewAllEvents/search', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        const eventsContainer = mainContainer.querySelector('.events-grid')?.parentElement;
                        if (eventsContainer) {
                            eventsContainer.innerHTML = data.html;
                            observeElements();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        // Remove loading state if implemented
                        // mainContainer.classList.remove('loading');
                    });
                }
            };

            // Listen for Enter key press
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Prevent form submission if within a form
                    performSearch();
                }
            });
        });
    </script>

    <script>
        // Category filter functionality
        const categoryBtns = document.querySelectorAll('.category-btn');
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                categoryBtns.forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                btn.classList.add('active');
            });
        });

        // Smooth animation for elements entering viewport
        const observeElements = () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('new-event');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.event-container').forEach(event => {
                observer.observe(event);
            });
        };

        observeElements();
    </script>
</body>
</html>