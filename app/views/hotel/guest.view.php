<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/hotel/guest.css?v=1.0">
    <title>Guests</title>
</head>
<body>
    <div class="registration-wrapper">
        <h1>Registrations</h1>
        <p class="description">See all of your hotel's current registrations</p>
        
        <?php if (isset($data['error'])): ?>
            <div style="background: #fff0f0; padding: 10px; margin-bottom: 20px; border: 1px solid #ffcccc;">
                <p>Note: <?= $data['error'] ?></p>
            </div>
        <?php endif; ?>
        
        <?php if (isset($data['debug_structure'])): ?>
            <div style="background: #f8f8f8; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd;">
                <h3>Debug: Table Structure</h3>
                <pre><?php print_r($data['debug_structure']); ?></pre>
            </div>
        <?php endif; ?>
        
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search by guest, NIC, email">
        </div>
        <table id="registrationTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>NIC Number</th>
                    <th>Email</th>
                    <th>Arrival</th>
                    <th>Departure</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['guests'])): ?>
                    <?php foreach ($data['guests'] as $guest): ?>
                        <tr>
                            <td><?= esc($guest->guest_full_name) ?></td>
                            <td><?= esc($guest->guest_nic ?? 'N/A') ?></td>
                            <td>
                                <a href="#" class="action-link" onclick="showPopup(
                                    '<?= esc($guest->guest_full_name) ?>',
                                    '<?= esc($guest->guest_nic ?? 'N/A') ?>',
                                    '<?= esc($guest->guest_email ?? 'N/A') ?>',
                                    <?php if (isset($guest->check_in)): ?>
                                    '<?= esc(date('Y-m-d', strtotime($guest->check_in))) ?>',
                                    '<?= esc(date('Y-m-d', strtotime($guest->check_out))) ?>',
                                    '<?= esc($guest->booking_status ?? 'N/A') ?>',
                                    // <?php else: ?>
                                    // // 'N/A',
                                    // 'N/A',
                                    // 'N/A',
                                    // <?php endif; ?>
                                    '<?= esc($guest->room_booking_Id) ?>',
                                    '<?= esc($guest->total_rooms ?? 'N/A') ?>',
                                    '<?= esc($guest->total_amount ?? 'N/A') ?>'
                                )"><?= esc($guest->guest_email ?? 'N/A') ?></a>
                            </td>
                            <td><?= isset($guest->check_in) ? esc(date('Y-m-d', strtotime($guest->check_in))) : 'N/A' ?></td>
                            <td><?= isset($guest->check_out) ? esc(date('Y-m-d', strtotime($guest->check_out))) : 'N/A' ?></td>
                            <td><?= esc($guest->booking_status ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No guest registrations found.</td>
                    </tr>
                <?php endif; ?>
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

        function showPopup(name, nic, email, arrival, departure, status, bookingId, totalRooms, totalAmount) {
            const popupContent = document.getElementById('popupContent');
            let content = `
                <p><strong>Name:</strong> ${name}</p>
                <p><strong>NIC Number:</strong> ${nic}</p>
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Arrival:</strong> ${arrival}</p>
                <p><strong>Departure:</strong> ${departure}</p>
                <p><strong>Booking Status:</strong> ${status}</p>
                <p><strong>Booking ID:</strong> ${bookingId}</p>
            `;
            
            if (totalRooms !== 'N/A') {
                content += `<p><strong>Total Rooms:</strong> ${totalRooms}</p>`;
            }
            
            if (totalAmount !== 'N/A') {
                content += `<p><strong>Total Amount:</strong> ${totalAmount}</p>`;
            }
            
            popupContent.innerHTML = content;
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