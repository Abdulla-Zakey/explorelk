<?php 
  include '../app/views/components/rnav.php';
  include '../app/views/components/rhotelhead.php';

?>

<html>
<head>

    <style>
        .menu-container {
            /* display: flex;
            border: 1px solid #ccc;
            width: 1190px;
            height: auto;
            margin-left: 275px;
            margin-top: 30px;
            background-color: aliceblue;
            border-radius: 8px; */

            width: 70%;
            margin: 215px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: absolute;
            top: 200;
            left: 330px;
            height: auto;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Menu Section */
        #menuSection {
            padding: 20px;
        }

        #menuSection h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        #addItemBtn {
            background-color: #002D40;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        #addItemBtn:hover {
            background-color: #004D60;
        }

        /* Pop-Up Overlay */
        .popup {
            display: none; /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
        }

        /* Pop-Up Content Box */
        .popup-content {
            background: #fff;
            padding: 20px;
            width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-family: Arial, sans-serif;
        }

        /* Form Elements */
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
            color: #333;
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

        /* Buttons */
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

        /* Added Items Section */
        #addedItems {
            margin-top: 20px;
            display: flex;
        }

        .card {
            background: #fff;

            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

        .card img {
            max-width: 100px;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Success and Error Messages */
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
            display: none;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
    
</head>
<body>
    <div class="menu-container">
    <div id="menuSection">
        <h1>Menu</h1>
        <button id="addItemBtn">Add Items</button>

        <!-- Added Items Section -->
        <div id="addedItems">
            <!-- Dynamically added items will appear here -->
        </div>
    </div>

    <!-- Pop-Up Modal -->
    <div id="addMenuItemPopup" class="popup">
        <div class="popup-content">
            <h2>Add Menu Item</h2>
            <div class="message error" id="errorMessage">Please fill out all fields!</div>
            <div class="message success" id="successMessage">Item added successfully!</div>
            <form id="menuItemForm">
                <label for="itemName">Item name</label>
                <input type="text" id="itemName" name="itemName" placeholder="Spicy Red Curry" required>

                <label for="itemDescription">Description</label>
                <textarea id="itemDescription" name="itemDescription" rows="3" placeholder="Savory red curry made with fresh local vegetables and coconut milk." required></textarea>

                <label for="itemPrice">Price</label>
                <input type="text" id="itemPrice" name="itemPrice" placeholder="Rs100.00" required>

                <label for="itemCategory">Category</label>
                <select id="itemCategory" name="itemCategory" required>
                    <option value="">Select Category</option>
                    <option value="Entree">Entree</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Beverage">Beverage</option>
                </select>

                <div class="form-buttons">
                    <button type="button" class="upload-button" id="submitItem">Add Item</button>
                    <button type="button" class="cancel-button" id="closePopup">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to handle the pop-up and add items
        document.addEventListener("DOMContentLoaded", () => {
            const addItemBtn = document.getElementById("addItemBtn");
            const popup = document.getElementById("addMenuItemPopup");
            const closePopup = document.getElementById("closePopup");
            const submitItem = document.getElementById("submitItem");
            const addedItems = document.getElementById("addedItems");
            const errorMessage = document.getElementById("errorMessage");
            const successMessage = document.getElementById("successMessage");

            // Show pop-up when clicking "Add Items"
            addItemBtn.addEventListener("click", () => {
                popup.style.display = "flex"; // Show the pop-up
            });

            // Close pop-up when clicking "Cancel"
            closePopup.addEventListener("click", () => {
                popup.style.display = "none"; // Hide the pop-up
                errorMessage.style.display = "none";
                successMessage.style.display = "none";
            });

            // Add item to the list with validation
            submitItem.addEventListener("click", () => {
                const itemName = document.getElementById("itemName").value.trim();
                const itemDescription = document.getElementById("itemDescription").value.trim();
                const itemPrice = document.getElementById("itemPrice").value.trim();
                const itemCategory = document.getElementById("itemCategory").value.trim();

                if (!itemName || !itemDescription || !itemPrice || !itemCategory) {
                    // Show error message
                    errorMessage.style.display = "block";
                    successMessage.style.display = "none";
                } else {
                    // Add item to the list
                    const card = document.createElement("div");
                    card.classList.add("card");
                    card.innerHTML = `
                        <h3>${itemName} (${itemCategory})</h3>
                        <p>${itemDescription}</p>
                        <p><strong>Price:</strong> ${itemPrice}</p>
                    `;
                    addedItems.appendChild(card);

                    // Reset form, close popup, and show success message
                    document.getElementById("menuItemForm").reset();
                    errorMessage.style.display = "none";
                    successMessage.style.display = "block";

                    setTimeout(() => {
                        popup.style.display = "none";
                        successMessage.style.display = "none";
                    }, 2000); // Auto-hide success message after 2 seconds
                }
            });
        });
    </script>
    </div>
</body>

</html> 


