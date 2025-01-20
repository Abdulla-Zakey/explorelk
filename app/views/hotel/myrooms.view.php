<?php
include_once APPROOT . '/views/hotel/nav.php';
include_once APPROOT . '/views/hotel/hotelhead.php';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<html>

<head>
    <style>
        /* Your existing CSS styles */
        body {
            font-family: 'Poppins';
            margin: 40;
            padding: 20;
            background-color: #f5f5f5;
        }

        table {
            width: 55%;
            border-collapse: collapse;
            margin-bottom: 20px;
            padding: 10px;
            margin: 220px;
            margin-right: 10px;
            position: absolute;
            top: 0;
            left: 100px;
            height: 30vh;

        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #cfe2f3;
            color: #000;
        }

        td {
            background-color: #e7eaf3;
            color: #000;
        }

        th,
        td {
            border: 1px solid #ddd;
        }

        .edit-icon {
            color: #000;
            cursor: pointer;
        }

        .add-rooms-btn {
            display: block;
            width: 200px;
            bottom: 300px;
            padding: 30px;
            margin: 550px;
            position: absolute;
            text-align: center;
            background-color: #002D40;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .add-rooms-btn:hover {
            background-color: #B3D9FF;
            color: #002D40
        }

        /* Add styles for the popup form and blur background */
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

        /* Add styles for the form */

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
            color: #002D40
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
            /* Change the color on hover for better UX */
        }

        .calendar-container {
            position: fixed;
            top: 220px;
            left: 1150px;
            width: 100%;
            padding: 10px;
            text-align: center;
        }

        .create-booking {
            background-color: #002D40;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            top: 100px;
            position: relative;
            right: 20px;
        }

        .create-booking:hover {
            background-color: #B3D9FF;
            color: #002D40
        }

        .block-container {
            display: flex;
            flex-direction: row;
            margin-top: 20%;
            margin-left: 5%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* Modal styles */
        .custom-modal {
            display: none;
            position: fixed;
            top: 0px;
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
            padding: 5px;
            border-radius: 8px;
            max-width: 100%;
            overflow: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            height: 80vh;
            padding: 25px;
            position: relative;
        }

        .model-container h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .custom-close-btn {
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .custom-close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #FF0000;
            cursor: pointer;
            border: none;
            background: none;
        }

        .custom-table {
            width: 60%;
            border-collapse: collapse;
            background-color: #f7f7fc;
        }

        .custom-th,
        .custom-td {
            padding: 10px;
            text-align: left;
        }

        .custom-th {
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
        }



        .custom-icon {
            margin-right: 10px;
        }

        .custom-status {
            padding: 5px 10px;
            border-radius: 10px;
            cursor: pointer;
        }

        .status-green {
            background-color: #e6f4ea;
            color: #28a745;
        }

        .status-orange {
            background-color: #fff3e0;
            color: #ff9800;
        }

        .status-red {
            background-color: #fdecea;
            color: #dc3545;
        }

        /* Scrollable content inside modal */
        .custom-modal-content {
            max-height: 100vh;
        }

        .enhanced-button {
            background-color: #002D40;
            /* Primary blue color */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .enhanced-button:hover {
            background-color: #B3D9FF;
            color: #002D40;
            transform: translateY(-2px);
            /* Slight lift on hover */

        }

        .enhanced-button:active {
            background-color: #B3D9FF;
            color: #002D40;
        }

        .custom-td {
            /* display: flex; */
            gap: 8px;
        }

        .enhanced-button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #ff4444;
            color: white;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }

        .edit-input {
            width: 100%;
            padding: 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        .delete-confirm {
            background-color: #ff4444;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-cancel {
            background-color: #666;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-confirm:hover {
            background-color: #cc0000;
        }

        .delete-cancel:hover {
            background-color: #555;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0px;
            padding: 5px;
            margin-bottom: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .formcontainer {
            display: flex;
            flex: 1;
            gap: 20px;
            padding: 15px;
        }

        .input-group {
            flex: 1;
            min-width: 200px;
            padding: 10px;
        }

        .input-group label {
            color: #002D40;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .editable-input {
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            width: 100%;
            margin-top: 5px;
        }

        .editable-textarea {
            height: 60px;
            resize: none;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            width: 100%;
            margin-top: 5px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            padding: 15px;
            align-items: center;
        }

        .enhanced-button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 100px;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="block-container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Type of the Room</th>
                    <!-- <th>No. of Rooms</th>
                    <th>Available Rooms</th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Single Sharing</td>
                    <!-- <td>06</td> -->
                    <!-- <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>

                </tr>
                <tr>
                    <td>02</td>
                    <td>Double Sharing</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>
                </tr>
                <tr>
                    <td>03</td>
                    <td>Triple Sharing</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>
                </tr>
                <tr>
                    <td>04</td>
                    <td>VIP Suite</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>
                </tr>
            </tbody>
        </table>


        <div class="custom-modal" id="tableModal">
            <div class="model-container">
                <h2>Available rooms</h2>
                <cbutton class="closebutton" onclick="closeModal()" style="font-size: large;">×</cbutton>
                <div class="custom-modal-content" id="custom-model">
                </div>
            </div>
        </div>


        <div>
            <button class="create-booking">
                Add Rooms
            </button>
        </div>
    </div>


    <!-- Add a div for the popup form -->
    <div class="blur-background"></div>
    <div class="popup-form">
        <div class="popup-content">
            <cbutton class="closebutton">×</cbutton>

            <div class="form-container">
                <form action="http://localhost/gitexplorelk/explorelk/public/Hotel/Hmyrooms/create_room" method="post">
                    <h2>Type of the Room</h2>
                    <select name="roomType">
                        <option value="single">Single Sharing</option>
                        <option value="double">Double Sharing</option>
                        <option value="double">Triple Sharing</option>
                        <option value="suite">VIP Suite</option>
                    </select>

                    <h2>Room No.</h2>
                    <input name="roomNumber" type="number" placeholder="Value" min="1">

                    <h2>Room Prize</h2>
                    <input name="roomPrice" type="number" placeholder="Value" min="1" step="0.50">

                    <h2>Room Description</h2>
                    <input name="roomDescription" type="text" placeholder="Text">

                    <!-- <h2>Room photo</h2>
                    <input type="file" placeholder="Upload Photos"> -->

                    <button type="submit">Proceed</button>
                </form>
            </div>
        </div>
    </div>
    <div class="popup-table" id="popupTable">

        </table>
        <a href="#" class="close-btn" onclick="hidePopup()">Close</a>
    </div>
    <!--  Calender -->
    <div class="calendar-container">
        <?php include_once APPROOT . '/views/components/calender.php'; ?>
    </div>

    <!-- Add this after your edit modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Delete</h2>
            <p>Are you sure you want to delete this row?</p>
            <div class="modal-buttons">
                <button onclick="confirmDelete()" class="delete-confirm">Delete</button>
                <button onclick="closeDeleteModal()" class="delete-cancel">Cancel</button>
            </div>
        </div>
    </div>



    <script>
        // Get the popup form and blur background elements
        const popupForm = document.querySelector('.popup-form');
        const blurBackground = document.querySelector('.blur-background');
        const createBookingButton = document.querySelector('.create-booking');
        const closeButton = document.querySelector('.closebutton');

        // Add an event listener to the "Create Booking" button
        createBookingButton.addEventListener('click', () => {
            popupForm.style.display = 'block';
            blurBackground.style.display = 'block';
        });

        // Add an event listener to the close button
        closeButton.addEventListener('click', () => {
            popupForm.style.display = 'none';
            blurBackground.style.display = 'none';
        });

        function showModal() {
            document.getElementById('tableModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('tableModal').style.display = 'none';
        }

        function viewRow(button) {
            const row = button.closest('tr');
            const cells = row.getElementsByTagName('td');
            const rowData = {};

            // Collect data from the row
            for (let i = 0; i < cells.length - 1; i++) {
                const headerText = document.querySelector('table thead th:nth-child(' + (i + 1) + ')').textContent;
                rowData[headerText] = cells[i].textContent;
            }

            // Display data in modal
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = '';

            for (const [key, value] of Object.entries(rowData)) {
                modalContent.innerHTML += `<p><strong>${key}:</strong> ${value}</p>`;
            }

            showModal();
        }



        const roomData = <?php echo json_encode($room); ?>;

        function loadTable() {
            const container = document.getElementById('custom-model');
            container.innerHTML = ''; // Clear any previous data

            roomData.forEach((room, index) => {
                const form = `
        <div id="form-${index}" class="form-group">
            <form class ="formcontainer" method="post" action="http://localhost/gitexplorelk/explorelk/public/Hotel/Hmyrooms/update_room">
                
                <input type="hidden" value="${room.id}" name="id" id="editRoomNo-${index}" readonly class="editable-input">
                
                <div class="input-group">
                    <label for="editRoomType-${index}">Room Number</label>
                    <input type="text" value="${room.roomNumber}" name="roomNumber" id="editRoomType-${index}" readonly class="editable-input">
                </div>
                
                <div class="input-group">
                    <label for="editAmount-${index}">Room Price</label>
                    <input type="text" value="${room.roomPrice}" name="roomPrice" id="editAmount-${index}" class="editable-input" disabled>
                </div>
                
                <div class="input-group">
                    <label for="editDescription-${index}">Room Description</label>
                    <textarea id="editDescription-${index}" name="roomDescription" class="editable-textarea" disabled>${room.roomDescription}</textarea>
                </div>
                
                <div class="button-group">
                    <button type="button" class="enhanced-button" onclick="toggleEdit(${index})">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button type="submit" class="enhanced-button save-btn" style="display:none;">
                        <i class="fas fa-save"></i> Save
                    </button>
                    
                </div>
               </form>
                   <form method="post" action = "http://localhost/gitexplorelk/explorelk/public/Hotel/Hmyrooms/delete_room">
                      <div class="button-group">
                     <input type="hidden" value="${room.id}" name="id" id="editRoomNo-${index}" readonly class="editable-input">
                    <button type="submit" class="enhanced-button delete-btn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                    
                </div>
                </form>
           
        </div>`;

                container.innerHTML += form;
            });
        }

        // Call the function to load the data
        loadTable();

        // Function to toggle editing
        function toggleEdit(index) {
            // Enable inputs for editing
            document.getElementById(`editAmount-${index}`).disabled = false;
            document.getElementById(`editDescription-${index}`).disabled = false;

            // Show Save button and hide Edit button
            const editButton = document.querySelector(`#form-${index} .enhanced-button`);
            const saveButton = document.querySelector(`#form-${index} .save-btn`);

            editButton.style.display = 'none';
            saveButton.style.display = 'inline-block';
        }





        // Listen for Save button click to submit form using JavaScript
        // Assuming saveButton is defined in your toggleEdit function








        function deleteRow(index) {
            deleteRowIndex = index;
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.style.display = 'block';
        }

        function closeDeleteModal() {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.style.display = 'none';
        }

        // function confirmDelete() {
        //     const row = document.querySelector(`tr[data-index="${deleteRowIndex}"]`);
        //     if (row) {
        //         row.remove();
        //         // If you're using any data array, remove the item here as well
        //         // dataArray.splice(deleteRowIndex, 1);
        //     }
        //     closeDeleteModal();
        // }

        // // Update the window click handler to include both modals
        // window.onclick = function(event) {
        //     const editModal = document.getElementById('editModal');
        //     const deleteModal = document.getElementById('deleteModal');

        //     if (event.target === editModal) {
        //         editModal.style.display = 'none';
        //     }
        //     if (event.target === deleteModal) {
        //         deleteModal.style.display = 'none';
        //     }
        // }
    </script>
</body>

</html>