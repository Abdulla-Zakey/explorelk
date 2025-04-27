<?php
 include '../app/views/components/rnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #002D40;
            --secondary-color: #004D6D;
            --text-color: #333;
            --background-color: #f4f4f4;
            --white: #ffffff;
            --success-color: #28a745;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .container {
            max-width: 1200px;
            margin-left: 265px;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 2px solid var(--primary-color);
        }

        h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        #addItemBtn {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        #addItemBtn:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .menu-item {
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .menu-item-image {
            width: 200px;
            height: 150px;
            object-fit: cover;
            transition: all 0.3s ease;
            border-radius: 10px;
            margin-left: 10px;
        }

        .menu-item:hover .menu-item-image {
            transform: scale(1.05);
        }

        .menu-item-details {
            flex-grow: 1;
            padding: 20px;
        }

        .menu-item h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--primary-color);
        }

        .menu-item p {
            margin-bottom: 5px;
            color: #666;
        }

        .menu-item-actions {
            display: flex;
            align-items: center;
            padding: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--secondary-color);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .menu-options {
            margin-left: 20px;
            position: relative;
        }

        .menu-options-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .menu-options-btn:hover {
            transform: scale(1.1);
        }

        .menu-options-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: var(--white);
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .menu-options-content a {
            color: var(--text-color);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s ease;
        }

        .menu-options-content a:hover {
            background-color: #f1f1f1;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow:auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: var(--white);
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        form input, form textarea, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
        }

        form button {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        form button:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
            display: none;
        }

        .success-popup {
            display: none;
            position: fixed;
            z-index: 2;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }

        .success-popup-content {
            background-color: var(--white);
            margin: 20% auto;
            padding: 20px;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .success-popup-content p {
            color: var(--success-color);
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .success-popup-content button {
            background-color: var(--secondary-color);
            color: var(--white);
            border: none;
            padding: 8px 16px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .success-popup-content button:hover {
            background-color: var(--primary-color);
        }
    </style>
</head>
<body>
    
    <div class="container">
        <header>
            <h1>Restaurant Menu</h1>
            <button id="addItemBtn">Add New Item</button>
        </header>

        <div id="menuItems">
            <?php foreach ($data['menuItems'] as $item): ?>
                <div class="menu-item" data-id="<?php echo $item->id; ?>">
                    <?php
                        $imagePath = ROOT . $item->image;

                        // Log the image path to debug
                        error_log("Rendering image for item {$item->id}: {$imagePath}");
                    ?>
                    
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($item->name); ?>" class="menu-item-image" onerror="console.error('Failed to load image: <?php echo htmlspecialchars($imagePath); ?>')">
                    <div class="menu-item-details">
                        <h3><?php echo htmlspecialchars($item->name); ?></h3>
                        <p><?php echo htmlspecialchars($item->description); ?></p>
                        <p><strong>Price:</strong> $<?php echo number_format($item->price, 2); ?></p>
                        <p><strong>Category:</strong> <?php echo htmlspecialchars($item->category); ?></p>
                        <p><strong>Availability:</strong> <?php echo htmlspecialchars($item->availability); ?></p>
                    </div>
                    <div class="menu-item-actions">
                        <label class="switch">
                            <input type="checkbox" class="toggle-availability" <?php echo $item->is_active ? 'checked' : ''; ?>>
                            <span class="slider"></span>
                        </label>
                        <div class="menu-options">
                            <button class="menu-options-btn">⋮</button>
                            <div class="menu-options-content">
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="itemModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2 id="modalTitle">Add New Menu Item</h2>
            <div id="errorMessage" class="error-message"></div>
            <form id="itemForm" method="post" action="<?= ROOT ?>/restaurant/Rmenu/createMenuItem" enctype="multipart/form-data">
                <input type="hidden" id="itemId">
                <input type="text" id="itemName" name="name" placeholder="Item Name" required>
                <textarea id="itemDescription" name="description" placeholder="Description" required></textarea>
                <input type="number" id="itemPrice" name="price" placeholder="Price" step="0.01" required>
                <select id="itemCategory" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Main Course">Main Course</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Beverage">Beverage</option>
                </select>
                <select id="itemAvailability" name="availability" required>
                    <option value="">Select Availability</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                    <option value="alltime">All Time</option>
                </select>
                <input type="file" id="itemImage" name="image" accept="image/*">
                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <div id="successPopup" class="success-popup">
        <div class="success-popup-content">
            <p id="successMessage"></p>
            <button id="successPopupClose">OK</button>
        </div>
    </div>

    <!-- Keep the rest of your HTML and PHP code as is -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const baseUrl = '<?php echo defined("ROOT") ? ROOT : ""; ?>/restaurant/rmenu';

        // Modal handling
        const addItemBtn = document.getElementById('addItemBtn');
        const itemModal = document.getElementById('itemModal');
        const closeBtn = itemModal.querySelector('.close');

        // Toggle availability functionality
        document.querySelectorAll('.toggle-availability').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const menuItem = this.closest('.menu-item');
                const id = menuItem.dataset.id;
                const isActive = this.checked;

                fetch(`${baseUrl}/toggle/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ is_active: isActive })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        this.checked = !isActive;
                        alert('Failed to update availability');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !isActive;
                });
            });
        });

        // Open modal for new item
        addItemBtn.onclick = function() {
            itemModal.style.display = 'block';
        }

        // Close modal
        closeBtn.onclick = function() {
            itemModal.style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == itemModal) {
                itemModal.style.display = 'none';
            }
        }

        // Options menu toggle
        document.addEventListener('click', function(event) {
            if (event.target.matches('.menu-options-btn')) {
                const content = event.target.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            } else {
                const dropdowns = document.getElementsByClassName('menu-options-content');
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].style.display = 'none';
                }
            }
        });
    });
</script>
</body>
</html>