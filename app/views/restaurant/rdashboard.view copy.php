<?php
include '../app/views/components/rnav.php';

// Simulating database connection and query
function getDummyRestaurantData() {
    $restaurants = [
        ['id' => 1, 'name' => 'Royal Bakery', 'open_time' => '09:00', 'close_time' => '22:00'],
        ['id' => 2, 'name' => 'Gourmet Cafe', 'open_time' => '08:00', 'close_time' => '20:00'],
        ['id' => 3, 'name' => 'Seaside Restaurant', 'open_time' => '11:00', 'close_time' => '23:00'],
    ];
    return $restaurants[array_rand($restaurants)];
}

$restaurantData = getDummyRestaurantData();
$restaurantName = $restaurantData['name'];
$defaultOpenTime = $restaurantData['open_time'];
$defaultCloseTime = $restaurantData['close_time'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($restaurantName); ?> Dashboard</title>
    <style>
        :root {
            --primary-color: #002D40;
            --secondary-color: #005F73;
            --accent-color: #0A9396;
            --text-color: #333;
            --background-color: #E9ECEF;
            --card-bg: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            margin-top: 80px;
            margin-left: 250px;
        }


        .dashboard-container, .calendar-container {
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: var(--shadow);
            padding: 30px;
            margin: 10px;
            flex: 1;
            min-width: 300px;
            transition: transform 0.3s ease;
        }

        .dashboard-container:hover, .calendar-container:hover {
            transform: translateY(-5px);
        }

        h1, h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 20px;
        }

        .status-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .status-button {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease;
            background-color: #E0E0E0;
            color: var(--text-color);
        }

        .status-button.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .time-inputs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .time-input {
            display: flex;
            flex-direction: column;
            width: 45%;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            color: var(--primary-color);
        }

        input[type="time"] {
            padding: 10px;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="time"]:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .save-button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.1s;
        }

        .save-button:hover {
            background-color: var(--accent-color);
            transform: scale(1.02);
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-nav {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--primary-color);
            transition: color 0.3s;
        }

        .calendar-nav:hover {
            color: var(--accent-color);
        }

        .calendar-day {
            height: 45px;
            width: 45px;
            text-align: center;
            padding: 10px;
            background-color: #F0F0F0;
            border-radius: 50%;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

        .calendar-day:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .calendar-day.today {
            background-color: var(--primary-color);
            color: white;
        }

        /* .restaurant-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        } */
        .restaurant-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 15px;

        }

        .restaurant-header h1 {
            margin: 0;
            color: white;
            font-size: 28px;
        }

        .promotions {
            width: 100%;
            overflow: hidden;
            position: relative;
            height: 200px;
            margin-bottom: 20px;
        }

        .promotions-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .promotion {
            min-width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .promotion img {
            width: 100%;
            /* height: 100%; */
            object-fit: cover;
        }

        .promotion-info {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            cursor: pointer;
        }

        .promotion-menu {
            position: absolute;
            bottom: 40px;
            right: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            display: none;
        }

        .promotion-menu-item {
            padding: 10px;
            cursor: pointer;
        }

        .promotion-menu-item:hover {
            background-color: #f0f0f0;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header class="restaurant-header">
        <h1><?php echo htmlspecialchars($restaurantName); ?></h1>
    </header>
          
    <div class="container">
        <div class="promotions">
            <div class="promotions-container" id="promotionsContainer">
                <!-- Promotion items will be dynamically added here -->
            </div>
        </div>
        
        <div class="dashboard-container">
            <h2>Restaurant Status</h2>
            <div class="status-buttons">
                <button id="openButton" class="status-button active">Open</button>
                <button id="closedButton" class="status-button">Closed</button>
            </div>
            <div class="time-inputs">
                <div class="time-input">
                    <label for="openTime">Opens At</label>
                    <input type="time" id="openTime" value="<?php echo $defaultOpenTime; ?>">
                </div>
                <div class="time-input">
                    <label for="closeTime">Closes At</label>
                    <input type="time" id="closeTime" value="<?php echo $defaultCloseTime; ?>">
                </div>
            </div>
            <button class="save-button" id="saveButton">Save Changes</button>
        </div>
        <div class="calendar-container">
            <h2>Calendar</h2>
            <div class="calendar-header">
                <button class="calendar-nav" id="prevMonth">&#10094;</button>
                <span id="currentMonth"></span>
                <button class="calendar-nav" id="nextMonth">&#10095;</button>
            </div>
            <div class="calendar" id="calendar"></div>
        </div>
    </div>

    <script>
        // Simulated promotions data (replace with actual data from backend in the future)
        const promotionsData = [
            { image: "<?php echo ROOT; ?>/assets/images/resturant/ads/prom2.jpg", info: "50% off on weekends" },
            { image: "<?php echo ROOT; ?>/assets/images/resturant/ads/prom2.jpg", info: "New menu items" },
            { image: "<?php echo ROOT; ?>/assets/images/resturant/ads/prom2.jpg", info: "Happy hour specials" }
        ];

        // Promotions logic
        const promotionsContainer = document.getElementById('promotionsContainer');
        let currentPromotion = 0;

        function createPromotionElement(promotion, index) {
            const promotionDiv = document.createElement('div');
            promotionDiv.className = 'promotion';
            promotionDiv.innerHTML = `
                <img src="${promotion.image}" alt="Promotion ${index + 1}">
                <div class="promotion-info">&#8942;</div>
                <div class="promotion-menu">
                    <div class="promotion-menu-item">About Promotion</div>
                </div>
            `;
            
            const infoButton = promotionDiv.querySelector('.promotion-info');
            const menu = promotionDiv.querySelector('.promotion-menu');
            
            infoButton.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
            
            promotionDiv.querySelector('.promotion-menu-item').addEventListener('click', () => {
                alert(promotion.info);
                menu.style.display = 'none';
            });
            
            document.addEventListener('click', () => {
                menu.style.display = 'none';
            });

            return promotionDiv;
        }

        promotionsData.forEach((promotion, index) => {
            promotionsContainer.appendChild(createPromotionElement(promotion, index));
        });

        function rotatePromotions() {
            currentPromotion = (currentPromotion + 1) % promotionsData.length;
            promotionsContainer.style.transform = `translateX(-${currentPromotion * 100}%)`;
        }

        setInterval(rotatePromotions, 5000);

        // Restaurant Status Logic
        const openButton = document.getElementById('openButton');
        const closedButton = document.getElementById('closedButton');
        const saveButton = document.getElementById('saveButton');

        openButton.addEventListener('click', () => {
            openButton.classList.add('active');
            closedButton.classList.remove('active');
        });

        closedButton.addEventListener('click', () => {
            closedButton.classList.add('active');
            openButton.classList.remove('active');
        });

        saveButton.addEventListener('click', () => {
            const status = openButton.classList.contains('active') ? 'Open' : 'Closed';
            const openTime = document.getElementById('openTime').value;
            const closeTime = document.getElementById('closeTime').value;
            
            console.log(`Status: ${status}, Opens: ${openTime}, Closes: ${closeTime}`);
            alert('Changes saved successfully!');

            // In the future, you would send this data to the server using AJAX
            // For now, we'll just log it to the console
        });

        // Calendar Logic
        const calendar = document.getElementById('calendar');
        const currentMonthSpan = document.getElementById('currentMonth');
        const prevMonthButton = document.getElementById('prevMonth');
        const nextMonthButton = document.getElementById('nextMonth');

        let currentDate = new Date();

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            currentMonthSpan.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;

            calendar.innerHTML = '';

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Add day names
            const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
            dayNames.forEach(day => {
                const dayNameElement = document.createElement('div');
                dayNameElement.textContent = day;
                dayNameElement.classList.add('calendar-day', 'day-name');
                calendar.appendChild(dayNameElement);
            });

            for (let i = 0; i < firstDay; i++) {
                calendar.appendChild(document.createElement('div'));
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                dayElement.classList.add('calendar-day');

                if (day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
                    dayElement.classList.add('today');
                }

                calendar.appendChild(dayElement);
            }
        }

        prevMonthButton.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthButton.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    </script>
</body>
</html>