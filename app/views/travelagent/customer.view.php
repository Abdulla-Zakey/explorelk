<?php 
    include_once APPROOT.'/views/travelagent/nav.php';
    include_once APPROOT.'/views/travelagent/travelagenthead.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrations</title>
    <style>
        /* Ensure no changes in hotelhead or other primary layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* Main container for the registration table */
        .registration-wrapper {
            padding: 20px;
            border-radius: 10px;
            width: 110%;
            max-width: 1125px;
            position: absolute;
            /* Move the container independently */
            top: 150px;
            /* Adjust vertical placement */
            left: 0px;
            /* Adjust horizontal placement */
            margin-left: 280px;
            /* Fine-tune the alignment */
            margin-top: 70px;
            /* Fine-tune vertical space */
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .registration-wrapper h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .registration-wrapper .description {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
            color: #333;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .action-link {
            color: #002D40;
            text-decoration: none;
            font-weight: bold;
        }

        .action-link:hover {
            color: #B3D9FF;
            text-decoration: underline;
        }

        .popup {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            /* Adjusted width for better spacing */
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            padding: 20px;
            font-family: 'Arial', sans-serif;
        }

        .popup-header {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            /* Added margin for spacing */
        }

        .popup-content p {
            margin: 10px 0;
            /* Added margin between paragraphs */
            font-size: 16px;
            color: #444;
            line-height: 1.5;
        }

        .popup-content strong {
            font-weight: bold;
            color: #002D40;
        }

        .popup-close button {
            background-color: #002D40;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .popup-close button:hover {
            background-color: #B3D9FF;
        }

        .overlay {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 999;
        }
    </style>
</head>

<body>
    <div class="registration-wrapper">
        <h1>Registrations</h1>
        <p class="description">See all of your hotel's current registrations</p>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search by guest, company, or confirmation #">
        </div>
        <table id="registrationTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Vehicle</th>
                    <th>Arrival </th>
                    <th>Departure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Samantha Li</td>
                    <td>BFB 1234</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22','Paid')">View</a></td>
                </tr>
                <tr>
                    <td>Mary Johnson</td>
                    <td>CAA 3432</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link">View</a></td>
                </tr>
                <tr>
                    <td>David Kim</td>
                    <td>CAR 6754</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22', 'Paid')">View</a></td>
                </tr>
                <tr>
                    <td>Jennifer Smith</td>
                    <td>BEH 8907</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22', 'Paid')">View</a></td>
                </tr>
                <tr>
                    <td>Michael Lee</td>
                    <td>AAD 6789</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22', 'Paid')">View</a></td>
                </tr>
            </tbody>
        </table>

        <div class="overlay" id="overlay"></div>
        <div class="popup" id="popup">
            <div class="popup-header">Guest Details</div>
            <div class="popup-content" id="popupContent">
                <!-- Content will be inserted dynamically -->
            </div>
            <div class="popup-close">
                <button onclick="hidePopup()">Close</button>
            </div>
        </div>

    </div>

    <script>
        const searchInput = document.getElementById("search");
        const table = document.getElementById("registrationTable");
        const rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

        searchInput.addEventListener("input", function() {
            const filter = searchInput.value.toLowerCase();

            for (let row of rows) {
                const cells = row.getElementsByTagName("td");
                let match = false;

                for (let cell of cells) {
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }

                row.style.display = match ? "" : "none";
            }
        });

        function showPopup(name, room, arrival, departure, paymentStatus) {
            const popupContent = document.getElementById('popupContent');
            popupContent.innerHTML = `
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Room:</strong> ${room}</p>
        <p><strong>Arrival:</strong> ${arrival}</p>
        <p><strong>Departure:</strong> ${departure}</p>
        <p><strong>Payment Status:</strong> ${paymentStatus}</p>
    `;
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function hidePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>

</html>