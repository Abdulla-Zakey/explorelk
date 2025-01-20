<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
          
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .calendar {
            width: 250px;
            background-color: #B3D9FF;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            padding: 10px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            font-weight: bold;
            color: #002D40;
        }

        .nav-button {
            background: none;
            border: none;
            color: #002D40;
            font-size: 16px;
            cursor: pointer;
        }

        .calendar-body {
            text-align: center;
        }

        .day-names {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            font-size: 12px;
            color: #002D40;
            margin-bottom: 5px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            font-size: 12px;
        }

        .day {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30px;
            cursor: pointer;
            border-radius: 5px;
            color: #002D40;
        }

        .day:hover {
            background-color: #FFFFFF;
        }

        .selected {
            background-color: #002D40;
            color: #fff;
        }
        .selected:hover {
            background-color: #FFFFFF;
            color: #002D40;
        }

        
     
 
    </style>
</head>
<body>
    <div class="calendar">
        <div class="calendar-header">
            <button id="prev" class="nav-button">&lt;</button>
            <div id="monthYear"></div>
            <button id="next" class="nav-button">&gt;</button>
        </div>
        <div class="calendar-body">
            <div class="day-names">
                <span>Sun</span>
                <span>Mon</span>
                <span>Tue</span>
                <span>Wed</span>
                <span>Thu</span>
                <span>Fri</span>
                <span>Sat</span>
            </div>
            <div id="days" class="days"></div>
        </div>
        
    </div>
    <script>
        const monthYear = document.getElementById("monthYear");
        const daysContainer = document.getElementById("days");
        const prevButton = document.getElementById("prev");
        const nextButton = document.getElementById("next");

        let currentDate = new Date();

        function renderCalendar() {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();

        // Set month and year in header
        monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;

        // Get the first day of the month
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        // Clear previous dates
        daysContainer.innerHTML = "";

        // Add empty slots for days of previous month
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement("div");
            emptyCell.classList.add("day");
            daysContainer.appendChild(emptyCell);
            }

        // Add day cells for current month
        for (let day = 1; day <= lastDate; day++) {
            const dayCell = document.createElement("div");
            dayCell.classList.add("day");
            dayCell.textContent = day;
            dayCell.addEventListener("click", () => selectDate(dayCell));
                
        // Highlight today's date
        if (
            day === currentDate.getDate() &&
            month === new Date().getMonth() &&
            year === new Date().getFullYear()
            ) {
                dayCell.classList.add("selected");
                }
                
            daysContainer.appendChild(dayCell);
            }
        }

        function selectDate(dayCell) {
        // Remove 'selected' class from previously selected date
        document.querySelectorAll(".day").forEach(day => day.classList.remove("selected"));
        // Add 'selected' class to clicked date
        dayCell.classList.add("selected");
        }

        prevButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
        });

        nextButton.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
        });

        // Initial render
        renderCalendar();

    </script>
</body>
</html>
