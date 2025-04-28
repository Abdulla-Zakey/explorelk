<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/hotel/guest.css?v=1.1">
    <title>Guests</title>
    <style>

    </style>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['guests'])): ?>
                <?php foreach ($data['guests'] as $guest): ?>
                <tr>
                    <td><?= esc($guest->guest_full_name) ?></td>
                    <td><?= esc($guest->guest_nic ?? 'N/A') ?></td>
                    <td><?= esc($guest->guest_email ?? 'N/A') ?></td>
                    <td><?= isset($guest->check_in) ? esc(date('Y-m-d', strtotime($guest->check_in))) : 'N/A' ?></td>
                    <td><?= isset($guest->check_out) ? esc(date('Y-m-d', strtotime($guest->check_out))) : 'N/A' ?></td>
                    <td><?= esc($guest->booking_status ?? 'N/A') ?></td>
                    <td>
                        <a href="#" class="action-link" onclick="showPopup(
                                    '<?= esc($guest->guest_full_name) ?>',
                                    '<?= esc($guest->guest_nic ?? 'N/A') ?>',
                                    '<?= esc($guest->guest_email ?? 'N/A') ?>',
                                    '<?= isset($guest->check_in) ? esc(date('Y-m-d', strtotime($guest->check_in))) : 'N/A' ?>',
                                    '<?= isset($guest->check_out) ? esc(date('Y-m-d', strtotime($guest->check_out))) : 'N/A' ?>',
                                    '<?= esc($guest->booking_status ?? 'N/A') ?>',
                                    '<?= esc($guest->room_booking_Id) ?>',
                                    '<?= esc($guest->total_rooms ?? 'N/A') ?>',
                                    '<?= esc($guest->total_amount ?? 'N/A') ?>'
                                )">View Details</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="7">No guest registrations found.</td>
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
            <div class="popup-actions">
                <button class="btn-download" onclick="downloadPDF()">Download PDF</button>
                <button class="btn-close" onclick="hidePopup()">Close</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
    // Search functionality
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

    // Show popup with guest details
    function showPopup(name, nic, email, arrival, departure, status, bookingId, totalRooms, totalAmount) {
        const popupContent = document.getElementById('popupContent');
        let content = `
                <p><strong>Name:</strong> <span>${name}</span></p>
                <p><strong>NIC Number:</strong> <span>${nic}</span></p>
                <p><strong>Email:</strong> <span>${email}</span></p>
                <p><strong>Arrival:</strong> <span>${arrival}</span></p>
                <p><strong>Departure:</strong> <span>${departure}</span></p>
                <p><strong>Booking Status:</strong> <span>${status}</span></p>
                <p><strong>Booking ID:</strong> <span>${bookingId}</span></p>
            `;

        if (totalRooms !== 'N/A') {
            content += `<p><strong>Total Rooms:</strong> <span>${totalRooms}</span></p>`;
        }

        if (totalAmount !== 'N/A') {
            content += `<p><strong>Total Amount:</strong> <span>${totalAmount}</span></p>`;
        }

        popupContent.innerHTML = content;
        document.getElementById('popup').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';

        // Store details for download
        window.currentGuestDetails = {
            name,
            nic,
            email,
            arrival,
            departure,
            status,
            bookingId,
            totalRooms,
            totalAmount
        };
    }

    // Hide popup
    function hidePopup() {
        document.getElementById('popup').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    // Download details as PDF
    function downloadPDF() {
        const element = document.getElementById('popupContent');
        const opt = {
            margin: 0.5,
            filename: `guest_${window.currentGuestDetails.bookingId}.pdf`,
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
</body>

</html>