<?php 
    include_once APPROOT.'/views/travelagent/nav.php';
    include_once APPROOT.'/views/travelagent/travelagenthead.php';
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
        th, td {
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
        th, td {
            border: 1px solid #ddd;
        }
        .edit-icon {
            color: #000;
            cursor: pointer;
        }
        .add-rooms-btn {
            display: block;
            width: 200px;
            bottom:300px;
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
            color:#002D40
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
            font-size: 16px ;
            cursor: pointer;
        }
        .form-container button:hover{
            background-color: #B3D9FF;
            color:#002D40
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
            color: #ff0000; /* Change the color on hover for better UX */
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
            color:#002D40
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

        .custom-modal-content {
            background-color: #fff;
            padding: 5px;
            border-radius: 8px;
            max-width: 100%;
            overflow: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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

        .custom-th, .custom-td {
            padding: 10px;
            text-align: left;
        }
       
        .custom-th {
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
        }

        .custom-td {
            border-top: 1px solid #e0e0e0;
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
            background-color: #002D40; /* Primary blue color */
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
                color:#002D40;
                transform: translateY(-2px); /* Slight lift on hover */
            
            }

            .enhanced-button:active {
                background-color: #B3D9FF;
                color:#002D40;
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



    </style>
</head>
<body>
    <div class="block-container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Type of the Vechicle</th>
                    <!-- <th>No. of Vechicle</th>
                    <th>Available Vechicle</th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Motor Bicycle</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>

                </tr>
                <tr>
                    <td>02</td>
                    <td>Tuks</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>
                </tr>
                <tr>
                    <td>03</td>
                    <td>Cars</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>
                </tr>
                <tr>
                    <td>04</td>
                    <td>Vans</td>
                    <!-- <td>06</td>
                    <td>06</td> -->
                    <td><button class="enhanced-button" onclick="showModal(); return false;">View</button></td>
                </tr>
            </tbody>
        </table>


    <div class="custom-modal" id="tableModal">
        <div class="custom-modal-content">
       
            <table class="custom-table">
            <button class="custom-close-btn" onclick="closeModal()">&times;</button>
                <thead>
                    <tr>
                        <th class="custom-th">Vechicle No.</th>
                        <th class="custom-th">Amount</th>
                        <th class="custom-th">Description</th>
                        <!-- <th class="custom-th">Photos</th> -->
                        <th class="custom-th">Action</th>                         
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="custom-td">BIG 1234</td>
                        <td class="custom-td">Rs 2000.00</td>
                        <td class="custom-td">Well maintained</td>
                         <!-- <td class="custom-td"><button class="enhanced-button" onclick="viewPhotos()"> -->
                            <i class="fas fa-image custom-icon"></i>View Photos</button></td> 
                        <td class="custom-td">
                        <button class="enhanced-button" onclick="editRow(this)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="enhanced-button delete-btn" onclick="deleteRow(this)">
                        <i class="fas fa-trash"></i>
                        </button>
                        </td>                     
                    </tr>
                    <tr>
                        <td class="custom-td">BFB 2345</td>
                        <td class="custom-td">Rs 3000.00</td>
                        <td class="custom-td">Well maintained</td>
                        <!-- <td class="custom-td"><button class="enhanced-button" onclick="viewPhotos()"> -->
                        <i class="fas fa-image custom-icon"></i>View Photos</button></td>
                        <td class="custom-td">
                            <button class="enhanced-button">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="enhanced-button delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        </tr>
                    <tr>
                        <td class="custom-td">BfZ 3456</td>
                        <td class="custom-td">Rs 3000.00</td>
                        <td class="custom-td">Brand New</td>
                        <!-- <td class="custom-td"><button class="enhanced-button" onclick="viewPhotos()"> -->
                            <i class="fas fa-image custom-icon"></i>View Photos</button></td>
                        <td class="custom-td">
                            <button class="enhanced-button">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="enhanced-button delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
        
        </tbody>
            </table>
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
                    <h2>Type of the Room</h2>
                    <select>
                        <option value="single">Single Sharing</option>
                        <option value="double">Double Sharing</option>
                        <option value="double">Triple Sharing</option>
                        <option value="suite">VIP Suite</option>
                    </select>
                    
                    <h2>Room No.</h2>
                    <input type="number" placeholder="Value" min="1">
                    
                    <h2>Room Prize</h2>
                    <input type="number" placeholder="Value"min="1" step="0.50">
                    
                    <h2>Room Discription</h2>
                    <input type="text" placeholder="Text">
                    
                    <h2>Room photo</h2>
                    <input type="file" placeholder="Upload Photos">
                    
                    <button>Proceed</button>
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

function editRow(button) {
    const row = button.closest('tr');
    const cells = row.getElementsByTagName('td');
    
    for (let i = 0; i < cells.length - 1; i++) {
        const cell = cells[i];
        const currentValue = cell.textContent;
        cell.innerHTML = `<input type="text" class="edit-input" value="${currentValue}">`;
    }
    
    button.innerHTML = '<i class="fas fa-save"></i>';
    button.onclick = () => saveRow(button);
}

function saveRow(button) {
    const row = button.closest('tr');
    const inputs = row.getElementsByClassName('edit-input');
    
    for (let input of inputs) {
        const cell = input.parentElement;
        cell.textContent = input.value;
    }
    
    button.innerHTML = '<i class="fas fa-edit"></i>';
    button.onclick = () => editRow(button);
}
function editRow(button) {
    const row = button.closest('tr');
    const cells = row.getElementsByTagName('td');
    
    // Get column headers to identify which cells to skip
    const headers = Array.from(row.closest('table').querySelectorAll('th')).map(th => th.textContent.toLowerCase());
    
    for (let i = 0; i < cells.length - 1; i++) {
        // Skip room number and photos columns
        if (headers[i].includes('room') || headers[i].includes('photo')) {
            continue;
        }
        
        const cell = cells[i];
        const currentValue = cell.textContent;
        cell.innerHTML = `<input type="text" class="edit-input" value="${currentValue}">`;
    }
    
    // Change edit button to save button
    button.innerHTML = '<i class="fas fa-save"></i>';
    button.onclick = () => saveRow(button);
}
function deleteRow(button) {
    const row = button.closest('tr');
    
    // Add confirmation dialog for safety
    if (confirm('Are you sure you want to delete this row?')) {
        row.remove();
    }
}

 // Add this JavaScript after your existing script

function saveRoom(formData) {
    fetch('/room/create', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            closeModal();
            refreshTable();
        }
    });
}

function updateRoom(roomNo, data) {
    fetch(`/room/update/${roomNo}`, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            refreshTable();
        }
    });
}

function deleteRoomHandler(roomNo) {
    if(confirm('Are you sure you want to delete this room?')) {
        fetch(`/room/delete/${roomNo}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                refreshTable();
            }
        });
    }
}

function refreshTable() {
    fetch('/room/list')
    .then(response => response.json())
    .then(rooms => {
        const tbody = document.querySelector('.custom-table tbody');
        tbody.innerHTML = rooms.map(room => `
            <tr>
                <td class="custom-td">${room.room_no}</td>
                <td class="custom-td">${room.amount}</td>
                <td class="custom-td">${room.description}</td>
                <td class="custom-td">
                    <button class="enhanced-button" onclick="viewPhotos('${room.photo_url}')">
                        <i class="fas fa-image custom-icon"></i>View Photos
                    </button>
                </td>
                <td class="custom-td">
                    <button class="enhanced-button" onclick="editRow(this)">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="enhanced-button delete-btn" onclick="deleteRoomHandler('${room.room_no}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `).join('');
    });
}

document.querySelector('.form-container button').addEventListener('click', (e) => {
    e.preventDefault();
    const formData = new FormData();
    
    // Get form values
    const roomType = document.querySelector('select').value;
    const roomNo = document.querySelector('input[type="number"]').value;
    const amount = document.querySelector('input[placeholder="Value"]').value;
    const description = document.querySelector('input[placeholder="Text"]').value;
    const photoFile = document.querySelector('input[type="file"]').files[0];
    
    // Append to FormData
    formData.append('room_type', roomType);
    formData.append('room_no', roomNo);
    formData.append('amount', amount);
    formData.append('description', description);
    formData.append('photo', photoFile);
    
    saveRoom(formData);
});


    </script>
</body>

</html>
