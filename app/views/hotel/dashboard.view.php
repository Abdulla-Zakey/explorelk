<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>
<html>

<head>
<title>Dashboard</title>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/dashboard.css?v=1.0">
</head>

<body>
    <div class="rooms-container">
        <div class="rooms">
            <h2>Rooms</h2>
            <div class="room-list">
                <div class="room">
                    <h3>Single Sharing</h3>
                    <p>2/10</p>
                    <p class="price">Rs.2000/day</p>
                </div>
                <div class="room">
                    <h3>Double Sharing</h3>
                    <p>2/10</p>
                    <p class="price">Rs.2000/day</p>
                </div>
                <div class="room">
                    <h3>Triple Sharing</h3>
                    <p>2/10</p>
                    <p class="price">Rs.2000/day</p>
                </div>
                <div class="room">
                    <h3>VIP Suite</h3>
                    <p>2/10</p>
                    <p class="price">Rs.2000/day</p>
                </div>
            </div>
        </div>
        <button class="create-booking">Add Rooms</button>
    </div>

    <div class="stats-container">
        <div class="outer-container">
            <div class="container">
                <div class="card">
                    <h3>Confirmed Bookings</h3>
                    <div class="circle" data-percentage="89">
                        <canvas width="100" height="100"></canvas>
                        <div class="percentage">89%</div>
                    </div>
                </div>
                <div class="card">
                    <h3>Cancellations</h3>
                    <div class="circle" data-percentage="20">
                        <canvas width="100" height="100"></canvas>
                        <div class="percentage">20%</div>
                    </div>
                </div>
                <div class="card">
                    <h3>Room Availability Status</h3>
                    <div class="circle" data-percentage="60">
                        <canvas width="100" height="100"></canvas>
                        <div class="percentage">60%</div>
                    </div>
                </div>
                <div class="card">
                    <h3>Revenue</h3>
                    <div class="circle" data-percentage="90">
                        <canvas width="100" height="100"></canvas>
                        <div class="percentage">90%</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup-form">
            <div class="popup-content">
                <div class="form-container">
                    <a href="#" class="closebutton">×</a>

                    <h2>Type of the Room</h2>
                    <select>
                        <option value="single">Single</option>
                        <option value="double">Double</option>
                        <option value="suite">Suite</option>
                    </select>
                    <h2>Room No.</h2>
                    <input type="number" placeholder="Value" min="1">
                    <h2>Room Prize</h2>
                    <input type="number" placeholder="Value" min="1" step="0.50">
                    <h2>Room Description</h2>
                    <input type="text" placeholder="Text">
                    <h2>Room photo</h2>
                    <input type="file" placeholder="Upload Photos">
                    <button>Proceed</button>
                </div>
            </div>
        </div>

        <div class="calendar-container">
            <?php include_once APPROOT . '/views/components/calender.php'; ?>
        </div>

        <div class="blur-background"></div>

        <script>
            const popupForm = document.querySelector('.popup-form');
            const blurBackground = document.querySelector('.blur-background');
            const createBookingButton = document.querySelector('.create-booking');
            const closeButton = document.querySelector('.closebutton');

            createBookingButton.addEventListener('click', () => {
                popupForm.style.display = 'block';
                blurBackground.style.display = 'block';
            });

            closeButton.addEventListener('click', () => {
                popupForm.style.display = 'none';
                blurBackground.style.display = 'none';
            });

            function drawCircle(canvas, percentage) {
                const ctx = canvas.getContext('2d');
                const radius = canvas.width / 2;
                const lineWidth = 10;
                const startAngle = -0.5 * Math.PI;
                const endAngle = (percentage / 100) * 2 * Math.PI + startAngle;

                ctx.clearRect(0, 0, canvas.width, canvas.height);

                ctx.beginPath();
                ctx.arc(radius, radius, radius - lineWidth / 2, 0, 2 * Math.PI);
                ctx.lineWidth = lineWidth;
                ctx.strokeStyle = '#e0e0e0';
                ctx.stroke();

                ctx.beginPath();
                ctx.arc(radius, radius, radius - lineWidth / 2, startAngle, endAngle);
                ctx.lineWidth = lineWidth;
                ctx.strokeStyle = '#002D40';
                ctx.stroke();
            }

            document.querySelectorAll('.circle').forEach(circle => {
                const canvas = circle.querySelector('canvas');
                const percentage = circle.getAttribute('data-percentage');
                drawCircle(canvas, percentage);
            });
        </script>
</body>

</html>