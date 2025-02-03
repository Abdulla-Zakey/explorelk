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
        <h1>My Events</h1>
        <div class="header">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search Events">
                <span class="search-icon">🔍</span>
            </div>
            <button class="create-btn">Create An Event</button>
        </div>
        <div class="event-header">
            <div>Date</div>
            <div>Event</div>
            <div>Sold</div>
            <div>Income</div>
            <div></div>
        </div>
        <div id="eventsList"></div>
    </div>

</body>

<script>
        const eventData = [
            {
                id: 1,
                date: { month: 'Dec', day: '10' },
                title: 'Batch Welcome Event',
                location: 'UCSC, Reid Avenue, Colombo 00700, Sri Lanka',
                datetime: 'Tuesday, December 10, 2024 at 10.00am to 12.00pm',
                sold: '10/400',
                income: 'Rs10,000',
                image: 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-02-02%20153835-Q8BvbhezERC6BCNqfpgG3mE3mS7eVu.png'
            },
            {
                id: 2,
                date: { month: 'Dec', day: '15' },
                title: 'Tech Conference 2024',
                location: 'Bandaranaike Memorial International Conference Hall, Colombo',
                datetime: 'Sunday, December 15, 2024 at 9.00am to 5.00pm',
                sold: '250/500',
                income: 'Rs50,000',
                image: 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-02-02%20153835-Q8BvbhezERC6BCNqfpgG3mE3mS7eVu.png'
            },
            {
                id: 3,
                date: { month: 'Jan', day: '05' },
                title: 'New Year Networking Mixer',
                location: 'Cinnamon Grand Hotel, Colombo 03',
                datetime: 'Friday, January 5, 2025 at 7.00pm to 10.00pm',
                sold: '75/150',
                income: 'Rs15,000',
                image: 'https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%202025-02-02%20153835-Q8BvbhezERC6BCNqfpgG3mE3mS7eVu.png'
            }
        ];

        function renderEvents(events) {
            const eventsListElement = document.getElementById('eventsList');
            eventsListElement.innerHTML = '';

            events.forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'event-card';
                eventElement.innerHTML = `
                    <div class="date">
                        <div class="month">${event.date.month}</div>
                        <div class="day">${event.date.day}</div>
                    </div>
                    <div class="event-details">
                        <img src="${event.image}" alt="${event.title}">
                        <div class="event-info">
                            <h3>${event.title}</h3>
                            <p>${event.location}</p>
                            <p>${event.datetime}</p>
                        </div>
                    </div>
                    <div class="sold">${event.sold}</div>
                    <div class="income">${event.income}</div>
                    <button class="more-btn">⋮</button>
                `;
                eventsListElement.appendChild(eventElement);
            });
        }

        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase();
                const filteredEvents = eventData.filter(event => 
                    event.title.toLowerCase().includes(searchTerm) || 
                    event.location.toLowerCase().includes(searchTerm)
                );
                renderEvents(filteredEvents);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderEvents(eventData);
            setupSearch();
        });
    </script>
</html>
