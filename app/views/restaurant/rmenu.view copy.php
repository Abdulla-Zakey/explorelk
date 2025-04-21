<?php
  include '../app/views/components/rnav.php';

// Simulating database data
$menuItems = [
    ['id' => 1, 'name' => 'Spicy Chicken Curry', 'description' => 'Tender chicken in a spicy curry sauce', 'price' => 12.99, 'category' => 'Main Course', 'availability' => 'alltime', 'image' => ROOT .'/assets/images/resturant/menu-item/menu1.jpg'],
    ['id' => 2, 'name' => 'Vegetable Stir Fry', 'description' => 'Fresh vegetables stir-fried in a savory sauce', 'price' => 9.99, 'category' => 'Main Course', 'availability' => 'lunch,dinner', 'image' => ROOT . '/assets/images/resturant/menu-item/menu2.jpg'],
    ['id' => 3, 'name' => 'Chocolate Lava Cake', 'description' => 'Warm chocolate cake with a gooey center', 'price' => 6.99, 'category' => 'Dessert', 'availability' => 'dinner', 'image' => ROOT . '/assets/images/resturant/menu-item/menu3.jpg'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #002D40;
            --secondary-color: #004D6D;
            --text-color: #333;
            --background-color: #f4f4f4;
            --white: #ffffff;
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
            overflow: auto;
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
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Restaurant Menu</h1>
            <button id="addItemBtn">Add New Item</button>
        </header>

        <div id="menuItems">
            <?php foreach ($menuItems as $item): ?>
                <div class="menu-item" data-id="<?php echo $item['id']; ?>">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="menu-item-image">
                    <div class="menu-item-details">
                        <h3><?php echo $item['name']; ?></h3>
                        <p><?php echo $item['description']; ?></p>
                        <p><strong>Price:</strong> $<?php echo number_format($item['price'], 2); ?></p>
                        <p><strong>Category:</strong> <?php echo $item['category']; ?></p>
                        <p><strong>Availability:</strong> <?php echo $item['availability']; ?></p>
                    </div>
                    <div class="menu-item-actions">
                        <label class="switch">
                            <input type="checkbox" <?php echo $item['availability'] === 'alltime' ? 'checked' : ''; ?>>
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

    <div id="addItemModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add New Menu Item</h2>
            <form id="addItemForm">
                <input type="text" id="itemName" placeholder="Item Name" required>
                <textarea id="itemDescription" placeholder="Description" required></textarea>
                <input type="number" id="itemPrice" placeholder="Price" step="0.01" required>
                <select id="itemCategory" required>
                    <option value="">Select Category</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Main Course">Main Course</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Beverage">Beverage</option>
                </select>
                <select id="itemAvailability" required>
                    <option value="">Select Availability</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                    <option value="alltime">All Time</option>
                </select>
                <input type="file" id="itemImage" accept="image/*">
                <button type="submit">Add Item</button>
            </form>
        </div>
    </div>

    <script>
        // The JavaScript remains the same as in the previous version
        document.addEventListener('DOMContentLoaded', function() {
            const addItemBtn = document.getElementById('addItemBtn');
            const addItemModal = document.getElementById('addItemModal');
            const closeBtn = addItemModal.querySelector('.close');
            const addItemForm = document.getElementById('addItemForm');
            const menuItemsContainer = document.getElementById('menuItems');

            addItemBtn.onclick = function() {
                addItemModal.style.display = "block";
            }

            closeBtn.onclick = function() {
                addItemModal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == addItemModal) {
                    addItemModal.style.display = "none";
                }
            }

            addItemForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const newItem = {
                    id: Date.now(),
                    name: document.getElementById('itemName').value,
                    description: document.getElementById('itemDescription').value,
                    price: parseFloat(document.getElementById('itemPrice').value),
                    category: document.getElementById('itemCategory').value,
                    availability: document.getElementById('itemAvailability').value,
                    image: document.getElementById('itemImage').files[0] ? URL.createObjectURL(document.getElementById('itemImage').files[0]) : 'https://via.placeholder.com/300x200.png?text=New+Item'
                };
                addMenuItemToDOM(newItem);
                addItemForm.reset();
                addItemModal.style.display = "none";
            });

            menuItemsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('menu-options-btn')) {
                    const content = e.target.nextElementSibling;
                    content.style.display = content.style.display === "block" ? "none" : "block";
                } else if (e.target.classList.contains('edit-btn')) {
                    console.log('Edit item', e.target.closest('.menu-item').dataset.id);
                    // Implement edit functionality
                } else if (e.target.classList.contains('delete-btn')) {
                    e.target.closest('.menu-item').remove();
                    // Here you would typically send a delete request to the server
                }
            });

            // Close the dropdown if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.menu-options-btn')) {
                    var dropdowns = document.getElementsByClassName("menu-options-content");
                    for (var i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.style.display === "block") {
                            openDropdown.style.display = "none";
                        }
                    }
                }
            }

            function addMenuItemToDOM(item) {
                const itemElement = document.createElement('div');
                itemElement.className = 'menu-item';
                itemElement.dataset.id = item.id;
                itemElement.innerHTML = `
                    <img src="${item.image}" alt="${item.name}" class="menu-item-image">
                    <div class="menu-item-details">
                        <h3>${item.name}</h3>
                        <p>${item.description}</p>
                        <p><strong>Price:</strong> $${item.price.toFixed(2)}</p>
                        <p><strong>Category:</strong>$${item.price.toFixed(2)}</p>
                        <p><strong>Category:</strong> ${item.category}</p>
                        <p><strong>Availability:</strong> ${item.availability}</p>
                    </div>
                    <div class="menu-item-actions">
                        <label class="switch">
                            <input type="checkbox" ${item.availability === 'alltime' ? 'checked' : ''}>
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
                `;
                menuItemsContainer.appendChild(itemElement);
            }
        });
    </script>
</body>
</html>