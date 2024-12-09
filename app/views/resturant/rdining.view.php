<?php 
  include '../app/views/components/rnav.php';
  include '../app/views/components/rhotelhead.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dining Table Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .dining-container {
           /*  margin: 30px auto;
            width: 1190px;
            background-color: aliceblue;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-left: 275px;
            margin-top: 30px; */

            width: 70%;
            margin: 215px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: absolute;
            top: 200;
            left: 330px;
            height: auto;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        #addTableBtn {
            background-color: #002D40;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        #addTableBtn:hover {
            background-color: #004D60;
        }

        /* Popup Styling */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: #fff;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background: #f8f8f8;
        }

        form textarea {
            resize: none;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
        }

        .upload-button {
            background-color: #002D40;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .cancel-button {
            background-color: #ccc;
            color: #333;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .upload-button:hover {
            background-color: #004D60;
        }

        .cancel-button:hover {
            background-color: #aaa;
        }

        #diningTables {
            margin-top: px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card {
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 250px;
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
        }

        .card p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }
        .chart-container {
            position: absolute;
            top: 390px;
            left: 330px;
            width: 1032px;
            height: 675px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="dining-container">
        <h1>Dining Table Management</h1>
        <button id="addTableBtn">Add Table</button>

        <div id="diningTables">
            <!-- Dynamically added tables will appear here -->
        </div>
    </div>
    <div class="chart-container">
        <?php include '../app/views/components/chart.php'; ?>
    </div>

    <!-- Add Table Popup -->
    <div id="addTablePopup" class="popup">
        <div class="popup-content">
            <h2>Add Dining Table</h2>
            <form id="tableForm">
                <label for="tableNumber">Table Number</label>
                <input type="text" id="tableNumber" name="tableNumber" placeholder="Enter table number" required>

                <label for="numChairs">Number of Chairs</label>
                <input type="number" id="numChairs" name="numChairs" placeholder="Enter number of chairs" required>

                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Main Dining Area">Main Dining Area</option>
                    <option value="Private Dining">Private Dining</option>
                    <option value="Outdoor Seating">Outdoor Seating</option>
                    <option value="Bar Area">Bar Area</option>
                </select>

                <label for="features">Features</label>
                <textarea id="features" name="features" rows="3" placeholder="Enter table features"></textarea>

                <label for="price">Price</label>
                <input type="text" id="price" name="price" placeholder="Enter price" required>

                <div class="form-buttons">
                    <button type="button" class="upload-button" id="submitTable">Add Table</button>
                    <button type="button" class="cancel-button" id="closePopup">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addTableBtn = document.getElementById("addTableBtn");
            const popup = document.getElementById("addTablePopup");
            const closePopup = document.getElementById("closePopup");
            const submitTable = document.getElementById("submitTable");
            const diningTables = document.getElementById("diningTables");

            // Show popup
            addTableBtn.addEventListener("click", () => {
                popup.style.display = "flex";
            });

            // Close popup
            closePopup.addEventListener("click", () => {
                popup.style.display = "none";
                document.getElementById("tableForm").reset();
            });

            // Add table
            submitTable.addEventListener("click", () => {
                const tableNumber = document.getElementById("tableNumber").value.trim();
                const numChairs = document.getElementById("numChairs").value.trim();
                const category = document.getElementById("category").value.trim();
                const features = document.getElementById("features").value.trim();
                const price = document.getElementById("price").value.trim();

                if (tableNumber && numChairs && category && price) {
                    const card = document.createElement("div");
                    card.classList.add("card");
                    card.innerHTML = `
                        <h3>Table ${tableNumber}</h3>
                        <p><strong>Chairs:</strong> ${numChairs}</p>
                        <p><strong>Category:</strong> ${category}</p>
                        <p><strong>Features:</strong> ${features}</p>
                        <p><strong>Price:</strong> ${price}</p>
                    `;
                    diningTables.appendChild(card);

                    popup.style.display = "none";
                    document.getElementById("tableForm").reset();
                }
            });
        });
    </script>
</body>
</html>

