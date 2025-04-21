<?php 
    include_once APPROOT.'/views/travelagent/nav.php';
    include_once APPROOT.'/views/travelagent/travelagentHead.php';
?>
<html>
<head>
    <style>
        body {
            font-family: 'poppins';
            margin: 40;
            padding: 20;
            background-color: #FFFFFF;
        }
       
        .rooms-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #ffffff;
    padding: 15px;
    margin: 220px;
    border-radius: 10px;
    position: absolute;
    top: 0;
    left: 55px;
    height: 30vh;
    width: calc(100% - 300px);
    border: 1px solid #ccc;
}

.rooms {
    flex-grow: 1;
}

.rooms h2 {
    margin: 0;
    padding-bottom: 10px;
    font-size: 24px;
    color: #002D40;
}

.room-list {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

.room {
    background-color: white;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px;
    width: calc(25% - 20px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
}

.room:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.room h3 {
    margin: 0;
    font-size: 18px;
    color: #002D40;
}

.room p {
    margin: 5px 0;
    font-size: 14px;
    color: #666;
}

.room .price {
    font-size: 16px;
    color: #002D40;
    font-weight: bold;
}

.create-booking {
    background-color: #002D40;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    position: absolute;
    top: 20px;
    right: 20px;
    transition: all 0.3s ease;
}

.create-booking:hover {
    background-color: #B3D9FF;
    color: #002D40;
}
 

        .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        
        .popup-content {
            max-width: 400px;
            margin: 20px auto;
        }
        
        .blur-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
        
        .form-container h2 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333333;
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="file"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            color: #999999;
            box-sizing: border-box;
        }

        .form-container input[type="file"]::file-selector-button {
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            background-color: #ffffff;
            color: #999999;
            cursor: pointer;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #12283a;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #B3D9FF;
            color:#002D40;
        }

        .closebutton {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            color: #333;
            cursor: pointer;
        }

        .closebutton:hover {
            color: #ff0000;
        }
        
        .calendar-container {
            position: fixed;
            bottom: 10px;
            left: 1155px;
            width: 100%;
            padding: 10px;
            text-align: center;
        }

        .stats-container {
            margin-top: 450px;
            margin-left: 0px;
            margin-right: 40px;
            width:59%;
        }

        .outer-container {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .card {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: 30%;
            text-align: center;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0 10px;
        }

        .card h3 {
            font-size: 14px;
            color: #002D40;
            margin-bottom: 20px;
        }

        .card .circle {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
        }

        .card .circle canvas {
            position: absolute;
            top: 0;
            left: 0;
        }

        .card .percentage {
            font-size: 24px;
            font-weight: bold;
            line-height: 100px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="rooms-container">
        <div class="rooms">
            <h2>Vechicles</h2>
            <div class="room-list">
                <div class="room">
                    <h3>Motor Bicycle</h3>
                    <p>2/10</p>
                    <p class="price">Rs.2000/day</p>
                </div>
                <div class="room">
                    <h3>Tuks</h3>
                    <p>2/10</p>
                    <p class="price">Rs.3000/day</p>
                </div>
                <div class="room">
                    <h3>Cars</h3>
                    <p>2/10</p>
                    <p class="price">Rs.5000/day</p>
                </div>
                <div class="room">
                    <h3>Vans</h3>
                    <p>2/10</p>
                    <p class="price">Rs.10000/day</p>
                </div>
            </div>
        </div>
        <button class="create-booking">Add Vechicle</button>
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
                    <h3>Vechicle Availability Status</h3>
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

                <h2>Type of the Vechicle</h2>
                <select>
                    <option value="single">Tuks</option>
                    <option value="double">Cars</option>
                    <option value="suite">Vans</option>
                </select>
                <h2>Vechicle No.</h2>
                <input type="number" placeholder="Value" min="1">
                <h2>VechiclePrize</h2>
                <input type="number" placeholder="Value" min="1" step="0.50">
                <h2>Vechicle Description</h2>
                <input type="text" placeholder="Text">
                <h2>Vechicle photo</h2>
                <input type="file" placeholder="Upload Photos">
                <button>Proceed</button>
            </div>
        </div>
    </div>

    <div class="calendar-container">
        <?php include_once APPROOT.'/views/components/calender.php'; ?>
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
