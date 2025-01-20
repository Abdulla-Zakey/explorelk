<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        .calendar-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 380px;
            height: 450px;
            overflow: hidden;
            margin-right: -30px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #002D40;
            color: #fff;
        }

        .calendar-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .nav-button {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }

        .calendar-days{
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            margin: 10px;
            
        }

        .calendar-dates{
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            margin: 10px;
            height: 360px;
        }

        .calendar-days div {
            font-weight: bold;
            color: #555;
        }

        .calendar-dates div {
            padding: 10px;
            margin: 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .calendar-dates div:hover {
            background-color: #3280e7;
            color: #fff;
        }

        .calendar-dates div.inactive {
            color: #ccc;
            pointer-events: none;
        }

        .calendar-dates div.active {
            background-color: #002D40;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <button id="prev-month" class="nav-button">&lt;</button>
            <h2 id="month-year"></h2>
            <button id="next-month" class="nav-button">&gt;</button>
        </div>
        <div class="calendar-days">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div id="calendar-dates" class="calendar-dates"></div>
    </div>

    <script>
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        let currentDate = new Date();

        function renderCalendar() {
            const monthYearElement = document.getElementById("month-year");
            const calendarDatesElement = document.getElementById("calendar-dates");

            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            monthYearElement.textContent = `${monthNames[month]} ${year}`;

            // Clear previous dates
            calendarDatesElement.innerHTML = "";

            // First day of the month
            const firstDay = new Date(year, month, 1).getDay();

            // Days in the current month
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Days in the previous month
            const daysInPrevMonth = new Date(year, month, 0).getDate();

            // Add previous month's dates
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = document.createElement("div");
                day.textContent = daysInPrevMonth - i;
                day.classList.add("inactive");
                calendarDatesElement.appendChild(day);
            }

            // Add current month's dates
            for (let i = 1; i <= daysInMonth; i++) {
                const day = document.createElement("div");
                day.textContent = i;
                if (
                    i === currentDate.getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear()
                ) {
                    day.classList.add("active");
                }
                calendarDatesElement.appendChild(day);
            }

            // Add next month's dates to fill the row
            const totalCells = calendarDatesElement.childElementCount;
            const remainingCells = 7 - (totalCells % 7);

            for (let i = 1; i <= remainingCells && remainingCells < 7; i++) {
                const day = document.createElement("div");
                day.textContent = i;
                day.classList.add("inactive");
                calendarDatesElement.appendChild(day);
            }
        }

        document.getElementById("prev-month").addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById("next-month").addEventListener("click", () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    </script>
</body>
</html>
