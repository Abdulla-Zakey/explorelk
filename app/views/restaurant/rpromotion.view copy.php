<?php
  include '../app/views/components/rnav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Promotions Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #002D40;
            --primary-hover: #004D60;
            --background: #f8f9fa;
            --card-bg: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border-color: #e0e0e0;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-primary);
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            margin-left: 265px;
            padding: 2rem;
        }

        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2rem;
            color: var(--text-primary);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            opacity: 0.9;
        }

        body.modal-open {
            overflow: hidden;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal-content {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            padding: 2rem;
            width: 90%;
            max-width: 600px;
            position: relative;
            margin: 2rem auto;
            transform: none;
            top: 0;
            left: 0;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-primary);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: var(--card-bg);
            color: var(--text-primary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .image-preview {
            width: 100%;
            max-height: 200px;
            border-radius: 0.5rem;
            overflow: hidden;
            margin-top: 1rem;
            display: none;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .food-items-container {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .food-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background-color: var(--background);
            padding: 1rem;
            border-radius: 0.5rem;
        }

        .remove-item {
            color: var(--danger-color);
            cursor: pointer;
        }

        .promotions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .promotion-card {
            background-color: var(--card-bg);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .promotion-card:hover {
            transform: translateY(-4px);
        }

        .promotion-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .promotion-content {
            padding: 1.5rem;
        }

        .promotion-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .promotion-details {
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .promotion-discount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--success-color);
            margin-bottom: 1rem;
        }

        .promotion-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .modal-content {
                margin: 1rem auto;
                padding: 1.5rem;
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Promotions Management</h1>
            <button class="btn btn-primary" id="addPromotionBtn">+ Add Promotion</button>
        </div>

        <div class="promotions-grid" id="promotionsGrid"></div>
    </div>

    <!-- Add/Edit Promotion Modal -->
    <div class="modal" id="promotionModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New Promotion</h2>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <form id="promotionForm">
                <input type="hidden" id="promotionId">
                <div class="form-group">
                    <label for="promotionType">Promotion Type</label>
                    <select class="form-control" id="promotionType" required>
                        <option value="">Select Type</option>
                        <option value="single">Single Item Discount</option>
                        <option value="combo">Combo Deal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="promotionImage">Promotion Image</label>
                    <input type="file" class="form-control" id="promotionImage" accept="image/*">
                    <div class="image-preview" id="imagePreview">
                        <img src="/placeholder.svg" alt="Preview">
                    </div>
                </div>

                <div class="form-group" id="foodItemsGroup">
                    <label>Food Items</label>
                    <div class="food-items-container" id="foodItemsContainer">
                        <div class="food-item">
                            <select class="form-control" required>
                                <option value="">Select Food Item</option>
                            </select>
                            <span class="remove-item">&times;</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addItemBtn" style="margin-top: 1rem;">
                        + Add Item
                    </button>
                </div>

                <div class="form-group">
                    <label for="discount">Discount Percentage</label>
                    <input type="number" class="form-control" id="discount" min="0" max="100" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="validUntil">Valid Until</label>
                    <input type="date" class="form-control" id="validUntil" required>
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn">Create Promotion</button>
            </form>
        </div>
    </div>

    <script>
        // Simulated API functions
        async function fetchFoodItems() {
            // Simulated API call
            return [
                { id: 1, name: 'Margherita Pizza', price: 12 },
                { id: 2, name: 'Chicken Burger', price: 8 },
                { id: 3, name: 'Caesar Salad', price: 6 },
                { id: 4, name: 'Pasta Carbonara', price: 10 },
                { id: 5, name: 'Fish & Chips', price: 15 }
            ];
        }

        async function fetchPromotions() {
            // Simulated API call
            return [
                {
                    id: '1',
                    type: 'combo',
                    image: 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500&q=80',
                    foodItems: [
                        { id: '1', name: 'Margherita Pizza - $12' },
                        { id: '2', name: 'Caesar Salad - $6' }
                    ],
                    discount: 25,
                    description: 'Pizza & Salad Combo! Perfect for a healthy and satisfying meal. Get our signature Margherita Pizza with a fresh Caesar Salad.',
                    validUntil: '2024-03-30'
                },
                {
                    id: '2',
                    type: 'single',
                    image: 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=500&q=80',
                    foodItems: [
                        { id: '2', name: 'Chicken Burger - $8' }
                    ],
                    discount: 15,
                    description: 'Burger Tuesday Special! Enjoy our signature Chicken Burger at a special discount every Tuesday.',
                    validUntil: '2024-03-31'
                },
                // ... (other promotions)
            ];
        }

        async function createPromotion(promotionData) {
            // Simulated API call
            console.log('Creating promotion:', promotionData);
            // In a real implementation, this would send a POST request to your backend
            return { ...promotionData, id: Date.now().toString() };
        }

        async function updatePromotion(id, promotionData) {
            // Simulated API call
            console.log('Updating promotion:', id, promotionData);
            // In a real implementation, this would send a PUT request to your backend
            return { ...promotionData, id };
        }

        async function deletePromotion(id) {
            // Simulated API call
            console.log('Deleting promotion:', id);
            // In a real implementation, this would send a DELETE request to your backend
            return true;
        }

        // State management
        let promotions = [];
        let foodItems = [];
        let isEditing = false;
        let editingId = null;

        // DOM Elements
        const modal = document.getElementById('promotionModal');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const addPromotionBtn = document.getElementById('addPromotionBtn');
        const closeModal = document.getElementById('closeModal');
        const promotionForm = document.getElementById('promotionForm');
        const promotionId = document.getElementById('promotionId');
        const promotionType = document.getElementById('promotionType');
        const promotionImage = document.getElementById('promotionImage');
        const imagePreview = document.getElementById('imagePreview');
        const foodItemsContainer = document.getElementById('foodItemsContainer');
        const addItemBtn = document.getElementById('addItemBtn');
        const promotionsGrid = document.getElementById('promotionsGrid');

        // Event Listeners
        addPromotionBtn.addEventListener('click', () => {
            isEditing = false;
            editingId = null;
            modalTitle.textContent = 'Add New Promotion';
            submitBtn.textContent = 'Create Promotion';
            promotionForm.reset();
            imagePreview.style.display = 'none';
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
            promotionForm.reset();
            imagePreview.style.display = 'none';
            isEditing = false;
            editingId = null;
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                promotionForm.reset();
                imagePreview.style.display = 'none';
                isEditing = false;
                editingId = null;
            }
        });

        promotionType.addEventListener('change', () => {
            const isCombo = promotionType.value === 'combo';
            addItemBtn.style.display = isCombo ? 'block' : 'none';
            
            // Clear food items if switching to single
            if (!isCombo) {
                while (foodItemsContainer.children.length > 1) {
                    foodItemsContainer.removeChild(foodItemsContainer.lastChild);
                }
            }
        });

        promotionImage.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.querySelector('img').src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        addItemBtn.addEventListener('click', () => {
            addFoodItemSelect();
        });

        promotionForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const foodItems = Array.from(foodItemsContainer.querySelectorAll('select'))
                .map(select => ({
                    id: select.value,
                    name: select.options[select.selectedIndex].text
                }));

            const promotionData = {
                type: promotionType.value,
                image: imagePreview.querySelector('img').src,
                foodItems: foodItems,
                discount: document.getElementById('discount').value,
                description: document.getElementById('description').value,
                validUntil: document.getElementById('validUntil').value
            };

            if (isEditing) {
                await updatePromotion(editingId, promotionData);
            } else {
                await createPromotion(promotionData);
            }

            await loadPromotions();
            renderPromotions();

            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
            promotionForm.reset();
            imagePreview.style.display = 'none';
            isEditing = false;
            editingId = null;
        });

        async function editPromotion(id) {
            const promotion = promotions.find(p => p.id === id);
            if (!promotion) return;

            isEditing = true;
            editingId = id;
            modalTitle.textContent = 'Edit Promotion';
            submitBtn.textContent = 'Update Promotion';

            // Fill form with promotion data
            promotionType.value = promotion.type;
            imagePreview.querySelector('img').src = promotion.image;
            imagePreview.style.display = 'block';
            document.getElementById('discount').value = promotion.discount;
            document.getElementById('description').value = promotion.description;
            document.getElementById('validUntil').value = promotion.validUntil;

            // Handle food items
            foodItemsContainer.innerHTML = '';
            promotion.foodItems.forEach(item => {
                addFoodItemSelect(item.id);
            });

            // Show/hide add item button based on promotion type
            addItemBtn.style.display = promotion.type === 'combo' ? 'block' : 'none';

            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function renderPromotions() {
            promotionsGrid.innerHTML = promotions.map(promotion => `
                <div class="promotion-card">
                    ${promotion.image ? `
                        <img src="${promotion.image}" alt="Promotion" class="promotion-image">
                    ` : ''}
                    <div class="promotion-content">
                        <div class="promotion-title">
                            ${promotion.type === 'combo' ? 'Combo Deal' : 'Single Item Discount'}
                        </div>
                        <div class="promotion-details">
                            ${promotion.foodItems.map(item => item.name).join(', ')}
                        </div>
                        <div class="promotion-discount">
                            ${promotion.discount}% OFF
                        </div>
                        <p>${promotion.description}</p>
                        <p>Valid until: ${new Date(promotion.validUntil).toLocaleDateString()}</p>
                        <div class="promotion-actions">
                            <button class="btn btn-primary" onclick="editPromotion('${promotion.id}')">
                                Edit
                            </button>
                            <button class="btn btn-danger" onclick="deletePromotionHandler('${promotion.id}')">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        async function deletePromotionHandler(id) {
            if (confirm('Are you sure you want to delete this promotion?')) {
                await deletePromotion(id);
                await loadPromotions();
                renderPromotions();
            }
        }

        function addFoodItemSelect(selectedId = '') {
            const foodItem = document.createElement('div');
            foodItem.className = 'food-item';
            foodItem.innerHTML = `
                <select class="form-control" required>
                    <option value="">Select Food Item</option>
                    ${foodItems.map(item => 
                        `<option value="${item.id}" ${item.id === parseInt(selectedId) ? 'selected' : ''}>
                            ${item.name} - $${item.price}
                        </option>`
                    ).join('')}
                </select>
                <span class="remove-item">&times;</span>
            `;
            
            foodItem.querySelector('.remove-item').addEventListener('click', () => {
                foodItem.remove();
            });

            foodItemsContainer.appendChild(foodItem);
        }

        async function loadFoodItems() {
            foodItems = await fetchFoodItems();
            // Populate the initial food item select
            const initialSelect = foodItemsContainer.querySelector('select');
            initialSelect.innerHTML = `
                <option value="">Select Food Item</option>
                ${foodItems.map(item => 
                    `<option value="${item.id}">${item.name} - $${item.price}</option>`
                ).join('')}
            `;
        }

        async function loadPromotions() {
            promotions = await fetchPromotions();
        }

        // Add cleanup on page unload
        window.addEventListener('beforeunload', () => {
            document.body.classList.remove('modal-open');
        });

        // Initialize
        async function init() {
            await loadFoodItems();
            await loadPromotions();
            renderPromotions();
        }

        init();
    </script>
</body>
</html>