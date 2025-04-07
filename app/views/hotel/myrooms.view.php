<?php
include_once APPROOT . '/views/hotel/nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Hotel Room Types</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #fff;
        }

        .hotel-header {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .container {
            position: relative;
            z-index: 20; /* Higher than header */
            margin-top: 15%;
            margin-left: 250px;
            padding-bottom: 50px; /* Add some bottom padding */
        }

        table {
            width: 95%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 20px 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #cfe2f3;
            color: #000;
        }

        td {
            background-color: #fff;
        }

        .enhanced-button {
            background-color: #002D40;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .enhanced-button:hover {
            background-color: #B3D9FF;
            color: #002D40;
        }

        .add-type-btn {
            margin: 20px auto;
            display: block;
            width: 200px;
        }

        /* Modal styles */
        .custom-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .model-container {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            width: 80%;
            max-height: 80vh;
            overflow: auto;
            position: relative;
        }

        .form-group {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #002D40;
        }

        .editable-input, .editable-textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .editable-textarea {
            height: 100px;
            resize: none;
        }

        .closebutton {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            font-size: 24px;
            color: #FF0000;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="hotel-header">
        <?php include_once APPROOT . '/views/hotel/hotelhead.php'; ?>
    </div>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Description</th>
                    <th>No. of Rooms</th>
                    <th>Available Rooms</th>
                    <th>Max Occupancy</th>
                    <th>Price Per Night</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 0;
                    foreach($data['hotelRoomTypes'] as $type): ?>
                <tr>
                    <td><?= $data['hotelRoomTypesNames'][$i]->roomType_name ?></td>
                    <td><?= $type->customized_description ?? $type->standard_description ?></td>
                    <td>10</td>
                    <td>10</td>
                    <td><?= $type->max_occupancy ?></td>
                    <td>Rs.<?= number_format($type->pricePer_night, 2) ?></td>
                    <td>
                        <button class="enhanced-button" onclick="viewRooms(<?= $type->hotel_roomType_Id ?>)">Manage Rooms</button>
                    </td>
                </tr>
                <?php 
                    $i++;
                    endforeach; ?>
            </tbody>
        </table>

        <button class="enhanced-button add-type-btn" onclick="showAddTypeModal()">Add Room Type</button>
    </div>

    <!-- Room Management Modal -->
    <div class="custom-modal" id="roomsModal">
        <div class="model-container">
            <h2>Manage Rooms</h2>
            <button class="closebutton" onclick="closeModal('roomsModal')">×</button>
            <div id="roomsContent"></div>
        </div>
    </div>

    <!-- Add Room Type Modal -->
    <div class="custom-modal" id="addTypeModal">
        <div class="model-container">
            <h2>Add Room Type</h2>
            <button class="closebutton" onclick="closeModal('addTypeModal')">×</button>
            <form action="<?= ROOT ?>/Hotel/RoomTypes/add" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                <div class="input-group">
    <label>Room Type</label>
    <input type="text" name="roomType_Id" class="editable-input" required>
</div>


                    <div class="input-group">
                        <label>Room Type Image</label>
                        <input type="file" name="roomTypeImage" class="editable-input">
                    </div>

                    <div class="input-group">
                        <label>Custom Description</label>
                        <textarea name="customized_description" class="editable-textarea"></textarea>
                    </div>

                    <div class="input-group">
                        <label>Price Per Night</label>
                        <input type="number" name="pricePer_night" class="editable-input" required min="0" step="0.01">
                    </div>

                    <div class="input-group">
                        <label>Maximum Occupancy</label>
                        <input type="number" name="max_occupancy" class="editable-input" required min="1">
                    </div>

                    <button type="submit" class="enhanced-button">Proceed</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function viewRooms(typeId) {
            // Implement room management logic
            document.getElementById('roomsModal').style.display = 'flex';
        }

        function showAddTypeModal() {
            document.getElementById('addTypeModal').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('custom-modal')) {
                event.target.style.display = 'none';
            }
        }

        // Client-side validation for the form
        document.querySelector('form').addEventListener('submit', function(event) {
            let isValid = true;
            document.querySelectorAll('input, select, textarea').forEach(function(input) {
                if (input.required && !input.value) {
                    isValid = false;
                    input.style.borderColor = 'red';
                } else {
                    input.style.borderColor = '';
                }
            });

            if (!isValid) {
                event.preventDefault();
                alert('Please fill out all required fields.');
            }
        });
    </script>
</body>
</html>