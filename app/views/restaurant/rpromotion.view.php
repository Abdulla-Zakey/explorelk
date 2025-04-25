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

        .modal.active {
            display: block;
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

        .error {
            color: var(--danger-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
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

        <?php if (!empty($data['errors']['general'])): ?>
            <p class="error"><?php echo htmlspecialchars($data['errors']['general']); ?></p>
        <?php endif; ?>

        <div class="promotions-grid" id="promotionsGrid">
            <?php foreach ($data['promotions'] as $promotion): ?>
                <?php $foodItems = json_decode($promotion['food_items'], true); ?>
                <div class="promotion-card">
                    <?php if (!empty($promotion['image'])): ?>
                        <img src="<?php echo htmlspecialchars($promotion['image']); ?>" alt="Promotion" class="promotion-image">
                    <?php endif; ?>
                    <div class="promotion-content">
                        <div class="promotion-title">
                            <?php echo $promotion['type'] === 'combo' ? 'Combo Deal' : 'Single Item Discount'; ?>
                        </div>
                        <div class="promotion-details">
                            <?php echo htmlspecialchars(implode(', ', array_column($foodItems, 'name'))); ?>
                        </div>
                        <div class="promotion-discount">
                            <?php echo htmlspecialchars($promotion['discount']); ?>% OFF
                        </div>
                        <p><?php echo htmlspecialchars($promotion['description']); ?></p>
                        <p>Valid until: <?php echo htmlspecialchars(date('m/d/Y', strtotime($promotion['valid_until']))); ?></p>
                        <div class="promotion-actions">
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="promotion_id" value="<?php echo htmlspecialchars($promotion['id']); ?>">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this promotion?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="promotion_id" value="<?php echo htmlspecialchars($promotion['id']); ?>">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Add/Edit Promotion Modal -->
    <div class="modal" id="promotionModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"><?php echo $data['is_editing'] ? 'Edit Promotion' : 'Add New Promotion'; ?></h2>
                <button class="close-modal" id="closeModal">×</button>
            </div>
            <form method="POST" enctype="multipart/form-data" id="promotionForm">
                <input type="hidden" name="action" id="formAction" value="<?php echo $data['is_editing'] ? 'update' : 'create'; ?>">
                <input type="hidden" name="promotion_id" id="promotionId" value="<?php echo htmlspecialchars($data['editing_id'] ?? ''); ?>">
                <div class="form-group">
                    <label for="promotionType">Promotion Type</label>
                    <select class="form-control" id="promotionType" name="promotionType" required>
                        <option value="">Select Type</option>
                        <option value="single" <?php echo ($data['form_data']['promotionType'] ?? '') === 'single' ? 'selected' : ''; ?>>Single Item Discount</option>
                        <option value="combo" <?php echo ($data['form_data']['promotionType'] ?? '') === 'combo' ? 'selected' : ''; ?>>Combo Deal</option>
                    </select>
                    <?php if (!empty($data['errors']['type'])): ?>
                        <p class="error"><?php echo htmlspecialchars($data['errors']['type']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="promotionImage">Promotion Image</label>
                    <input type="file" class="form-control" id="promotionImage" name="promotionImage" accept="image/*">
                    <div class="image-preview" id="imagePreview" <?php echo ($data['is_editing'] && !empty($data['form_data']['image'])) ? 'style="display: block;"' : ''; ?>>
                        <img src="<?php echo htmlspecialchars($data['form_data']['image'] ?? '/placeholder.svg'); ?>" alt="Preview">
                    </div>
                </div>

                <div class="form-group" id="foodItemsGroup">
                    <label>Menu Items</label>
                    <div class="food-items-container" id="foodItemsContainer">
                        <?php 
                        $selectedItems = $data['form_data']['menu_items'] ?? [];
                        $itemCount = max(count($selectedItems), 1);
                        for ($i = 0; $i < $itemCount; $i++): ?>
                            <div class="food-item">
                                <select class="form-control" name="menu_items[]" required>
                                    <option value="">Select Menu Item</option>
                                    <?php foreach ($data['menu_items'] as $item): ?>
                                        <option value="<?php echo htmlspecialchars($item['id']); ?>" 
                                            <?php echo (isset($selectedItems[$i]) && $selectedItems[$i] == $item['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($item['name'] . ' - $' . $item['price']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="remove-item">×</span>
                            </div>
                        <?php endfor; ?>
                    </div>
                    <button type="button" class="btn btn-primary" id="addItemBtn" style="margin-top: 1rem; <?php echo ($data['form_data']['promotionType'] ?? '') === 'single' ? 'display: none;' : ''; ?>">
                        + Add Item
                    </button>
                    <?php if (!empty($data['errors']['food_items'])): ?>
                        <p class="error"><?php echo htmlspecialchars($data['errors']['food_items']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="discount">Discount Percentage</label>
                    <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" 
                        value="<?php echo htmlspecialchars($data['form_data']['discount'] ?? ''); ?>" required>
                    <?php if (!empty($data['errors']['discount'])): ?>
                        <p class="error"><?php echo htmlspecialchars($data['errors']['discount']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($data['form_data']['description'] ?? ''); ?></textarea>
                    <?php if (!empty($data['errors']['description'])): ?>
                        <p class="error"><?php echo htmlspecialchars($data['errors']['description']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="validUntil">Valid Until</label>
                    <input type="date" class="form-control" id="validUntil" name="validUntil" 
                        value="<?php echo htmlspecialchars($data['form_data']['validUntil'] ?? ''); ?>" required>
                    <?php if (!empty($data['errors']['valid_until'])): ?>
                        <p class="error"><?php echo htmlspecialchars($data['errors']['valid_until']); ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn"><?php echo $data['is_editing'] ? 'Update Promotion' : 'Create Promotion'; ?></button>
            </form>
        </div>
    </div>

    <script>
        // State management
        let isEditing = <?php echo $data['is_editing'] ? 'true' : 'false'; ?>;
        let editingId = '<?php echo htmlspecialchars($data['editing_id'] ?? ''); ?>';

        // DOM Elements
        const modal = document.getElementById('promotionModal');
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const addPromotionBtn = document.getElementById('addPromotionBtn');
        const closeModal = document.getElementById('closeModal');
        const promotionForm = document.getElementById('promotionForm');
        const formAction = document.getElementById('formAction');
        const promotionId = document.getElementById('promotionId');
        const promotionType = document.getElementById('promotionType');
        const promotionImage = document.getElementById('promotionImage');
        const imagePreview = document.getElementById('imagePreview');
        const foodItemsContainer = document.getElementById('foodItemsContainer');
        const addItemBtn = document.getElementById('addItemBtn');

        // Event Listeners
        addPromotionBtn.addEventListener('click', () => {
            isEditing = false;
            editingId = null;
            modalTitle.textContent = 'Add New Promotion';
            submitBtn.textContent = 'Create Promotion';
            formAction.value = 'create';
            promotionId.value = '';
            promotionForm.reset();
            imagePreview.style.display = 'none';
            foodItemsContainer.innerHTML = `
                <div class="food-item">
                    <select class="form-control" name="menu_items[]" required>
                        <option value="">Select Menu Item</option>
                        <?php foreach ($data['menu_items'] as $item): ?>
                            <option value="<?php echo htmlspecialchars($item['id']); ?>">
                                <?php echo htmlspecialchars($item['name'] . ' - $' . $item['price']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="remove-item">×</span>
                </div>
            `;
            modal.classList.add('active');
            document.body.classList.add('modal-open');
        });

        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.classList.remove('modal-open');
            promotionForm.reset();
            imagePreview.style.display = 'none';
            isEditing = false;
            editingId = null;
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
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
            if (!isCombo && foodItemsContainer.children.length > 1) {
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
                };
                reader.readAsDataURL(file);
            }
        });

        addItemBtn.addEventListener('click', () => {
            addMenuItemSelect();
        });

        function addMenuItemSelect(selectedId = '') {
            const foodItem = document.createElement('div');
            foodItem.className = 'food-item';
            foodItem.innerHTML = `
                <select class="form-control" name="menu_items[]" required>
                    <option value="">Select Menu Item</option>
                    <?php foreach ($data['menu_items'] as $item): ?>
                        <option value="<?php echo htmlspecialchars($item['id']); ?>" ${selectedId === '<?php echo $item['id']; ?>' ? 'selected' : ''}>
                            <?php echo htmlspecialchars($item['name'] . ' - $' . $item['price']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="remove-item">×</span>
            `;
            foodItem.querySelector('.remove-item').addEventListener('click', () => {
                foodItem.remove();
            });
            foodItemsContainer.appendChild(foodItem);
        }

        // Auto-open modal for edit or error state
        <?php if (!empty($data['form_data']) || $data['is_editing']): ?>
            modal.classList.add('active');
            document.body.classList.add('modal-open');
        <?php endif; ?>
    </script>
</body>
</html>