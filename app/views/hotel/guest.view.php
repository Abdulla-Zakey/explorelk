<?php
 include_once APPROOT.'/views/hotel/nav.php';
 include_once APPROOT.'/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/hotel/guest.css?v=1.0">
    <title>Guests</title>
    
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
                    <th>Room</th>
                    <th>Arrival</th>
                    <th>Departure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Samantha Li</td>
                    <td>S001</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22','Paid')">View</a></td>
                </tr>
                <tr>
                    <td>Mary Johnson</td>
                    <td>S002</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link">View</a></td>
                </tr>
                <tr>
                    <td>David Kim</td>
                    <td>S003</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22', 'Paid')">View</a></td>
                </tr>
                <tr>
                    <td>Jennifer Smith</td>
                    <td>S004</td>
                    <td>10/13/25</td>
                    <td>10/17/25</td>
                    <td><a href="#" class="action-link" onclick="showPopup('Samantha Li', 'Room 210', '10/13/22', '10/17/22', 'Paid')">View</a></td>
                </tr>
                <tr>
                    <td>Michael Lee</td>
                    <td>S005</td>
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