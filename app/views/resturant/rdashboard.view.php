
<?php 
  include '../app/views/components/rnav.php';
  include '../app/views/components/rhotelhead.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Status</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .dashboard-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* max-width: 600px; */
            width: 750px;
            padding: 30px 20px;
            box-sizing: border-box;
            margin-left: 270px;
            margin-top: 160px;
            height: 450px;
        }


        h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #002D40;
            text-align: center;
        }

        p {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 20px;
            text-align: center;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #343a40;
        }

        .status-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .status-buttons button {
            padding: 12px 25px;
            border: 1px solid #ccc;
            border-radius: 30px;
            background-color: #f8f9fa;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .status-buttons button:hover {
            border-color: #002D40;
            color: #002D40;
        }

        .status-buttons button.active {
            background-color: #002D40;
            color: #ffffff;
            border-color: #002D40;
        }

        .time-inputs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .time-inputs div {
            flex: 1;
        }

        .time-inputs label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #495057;
        }

        .time-inputs input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            background-color: #f8f9fa;
        }

        .time-inputs input:focus {
            outline: none;
            border-color: #002D40;
            background-color: #ffffff;
        }

        .save-button {
            text-align: center;
            margin-top: 20px;
        }

        .save-button button {
            padding: 12px 40px;
            border: none;
            border-radius: 30px;
            background-color: #002D40;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-button button:hover {
            background-color: #B3D9FF;
            color: #002D40;
        }
        .calender{
            margin: 50px;
            height: 290px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Restaurant Status</h1>
        <p>Manage your restaurant's status and set specific opening and closing times.</p>
        <div class="section-title">Restaurant Status</div>
        <div class="status-buttons">
            <button id="open-btn" class="active">Open</button>
            <button id="closed-btn">Closed for the day</button>
        </div>
        <div class="section-title">Specific Open and Close Times</div>
        <div class="time-inputs">
            <div>
                <label for="opens-at">Opens At</label>
                <input type="text" id="opens-at" value="12:00 AM">
            </div>
            <div>
                <label for="closes-at">Closes At</label>
                <input type="text" id="closes-at" value="12:00 AM">
            </div>
        </div>
        <div class="save-button">
            <button>Save</button>
        </div>
    </div>
    <div class="calender">
        <div><?php include '../app/views/components/rcalender.php'; ?></div>
        
    </div>
    


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const openBtn = document.getElementById('open-btn');
            const closedBtn = document.getElementById('closed-btn');

            function toggleStatus(buttonToActivate, buttonToDeactivate) {
                buttonToActivate.classList.add('active');
                buttonToDeactivate.classList.remove('active');
            }

            openBtn.addEventListener('click', function() {
                toggleStatus(openBtn, closedBtn);
            });

            closedBtn.addEventListener('click', function() {
                toggleStatus(closedBtn, openBtn);
            });
        });
    </script>
</body>
</html>
