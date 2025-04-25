<?php
class Menu {
    use Model;

    protected $table = "menu_items";
    protected $allowedColumns = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'category',
        'availability',
        'image',
        'is_active'
    ];

    public function getAllMenuItems($restaurant_id) {
        error_log("Menu::getAllMenuItems called for restaurant_id: $restaurant_id");
        $query = "SELECT * FROM {$this->table} WHERE restaurant_id = :restaurant_id";
        $result = $this->query($query, ['restaurant_id' => $restaurant_id]);
        error_log("getAllMenuItems result: " . json_encode($result));
        return $result ?: [];
    }

    public function getMenuItemById($id, $restaurant_id) {
        error_log("Menu::getMenuItemById called for ID: $id, restaurant_id: $restaurant_id");
        $query = "SELECT * FROM {$this->table} WHERE id = :id AND restaurant_id = :restaurant_id LIMIT 1";
        $result = $this->query($query, ['id' => $id, 'restaurant_id' => $restaurant_id]);
        error_log("getMenuItemById($id) result: " . json_encode($result));
        return $result ? $result[0] : null;
    }

    public function createMenuItem($data) {
        error_log("Menu::createMenuItem called with data: " . json_encode($data));
        try {
            $requiredFields = ['restaurant_id', 'name', 'description', 'price', 'category', 'availability'];
            foreach ($requiredFields as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    throw new Exception("Missing or empty required field: $field");
                }
            }

            // Initialize image path to null
            $data['image'] = null;
            if (!empty($data['image']) && is_array($data['image']) && $data['image']['size'] > 0) {
                $uploadDir = ROOT . '/assets/images/restaurant/menu-item/';
                error_log("Checking upload directory: $uploadDir");
                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0755, true)) {
                        throw new Exception("Failed to create upload directory: $uploadDir");
                    }
                    error_log("Created upload directory: $uploadDir");
                }

                // Use the original filename, handle conflicts
                $originalFileName = basename($data['image']['name']);
                $fileName = $originalFileName;
                $targetPath = $uploadDir . $fileName;
                $counter = 1;

                // Check for filename conflicts and append a suffix if needed
                while (file_exists($targetPath)) {
                    $fileInfo = pathinfo($originalFileName);
                    $fileName = $fileInfo['filename'] . '_' . $counter . '.' . $fileInfo['extension'];
                    $targetPath = $uploadDir . $fileName;
                    $counter++;
                    error_log("Filename conflict detected, trying new name: $fileName");
                }

                error_log("Attempting to upload image to: $targetPath");
                if (!move_uploaded_file($data['image']['tmp_name'], $targetPath)) {
                    error_log("Image upload failed with error code: " . $data['image']['error']);
                    throw new Exception("Failed to upload image: " . $data['image']['error']);
                }
                $data['image'] = '/assets/images/restaurant/menu-item/' . $fileName;
                error_log("Image uploaded successfully: " . $data['image']);
            }

            // Set default image only if no image was uploaded
            if (empty($data['image'])) {
                $data['image'] = '/assets/images/restaurant/menu-item/default.jpg';
                error_log("No image uploaded, using default: " . $data['image']);
            }

            $data['is_active'] = 1;
            $filteredData = array_intersect_key($data, array_flip($this->allowedColumns));
            error_log("Inserting menu item: " . json_encode($filteredData));

            $result = $this->insert($filteredData);
            if ($result === false) {
                throw new Exception("Database insert failed");
            }
            error_log("Menu::createMenuItem successful");
            return $result;
        } catch (Exception $e) {
            error_log("Error creating menu item: " . $e->getMessage());
            return false;
        }
    }

    public function updateMenuItem($id, $data, $restaurant_id) {
        error_log("Menu::updateMenuItem called for ID: $id, restaurant_id: $restaurant_id with data: " . json_encode($data));
        try {
            // Verify the item belongs to the restaurant
            $existingItem = $this->getMenuItemById($id, $restaurant_id);
            if (!$existingItem) {
                throw new Exception("Menu item not found or does not belong to restaurant_id: $restaurant_id");
            }

            if (!empty($data['image']) && is_array($data['image']) && $data['image']['size'] > 0) {
                $uploadDir = ROOT . '/assets/images/restaurant/menu-item/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Use the original filename, handle conflicts
                $originalFileName = basename($data['image']['name']);
                $fileName = $originalFileName;
                $targetPath = $uploadDir . $fileName;
                $counter = 1;

                while (file_exists($targetPath)) {
                    $fileInfo = pathinfo($originalFileName);
                    $fileName = $fileInfo['filename'] . '_' . $counter . '.' . $fileInfo['extension'];
                    $targetPath = $uploadDir . $fileName;
                    $counter++;
                    error_log("Filename conflict detected, trying new name: $fileName");
                }

                error_log("Attempting to upload new image to: $targetPath");
                if (move_uploaded_file($data['image']['tmp_name'], $targetPath)) {
                    $data['image'] = '/assets/images/restaurant/menu-item/' . $fileName;
                    if ($existingItem->image && file_exists(ROOT . $existingItem->image) && $existingItem->image !== '/assets/images/restaurant/menu-item/default.jpg') {
                        error_log("Deleting old image: " . ROOT . $existingItem->image);
                        unlink(ROOT . $existingItem->image);
                    }
                    error_log("New image uploaded successfully: " . $data['image']);
                } else {
                    error_log("Image upload failed with error code: " . $data['image']['error']);
                    throw new Exception("Failed to upload image");
                }
            } else {
                // If no new image is uploaded, keep the existing image
                unset($data['image']);
                error_log("No new image uploaded for item ID: $id");
            }

            $filteredData = array_intersect_key($data, array_flip($this->allowedColumns));
            error_log("Updating menu item ($id): " . json_encode($filteredData));
            $result = $this->update($id, $filteredData, 'id');
            error_log("Menu::updateMenuItem result: " . ($result ? 'success' : 'failed'));
            return $result;
        } catch (Exception $e) {
            error_log("Error updating menu item: " . $e->getMessage());
            return false;
        }
    }

    public function deleteMenuItem($id, $restaurant_id) {
        error_log("Menu::deleteMenuItem called for ID: $id, restaurant_id: $restaurant_id");
        try {
            $item = $this->getMenuItemById($id, $restaurant_id);
            if (!$item) {
                throw new Exception("Menu item not found with ID: $id for restaurant_id: $restaurant_id");
            }
            if ($item->image && file_exists(ROOT . $item->image) && $item->image !== '/assets/images/restaurant/menu-item/default.jpg') {
                error_log("Attempting to delete image: " . ROOT . $item->image);
                if (!unlink(ROOT . $item->image)) {
                    error_log("Failed to delete image file: " . ROOT . $item->image);
                } else {
                    error_log("Image deleted successfully: " . ROOT . $item->image);
                }
            } else {
                error_log("No image to delete or image is default: " . ($item->image ?? 'none'));
            }
            error_log("Executing database delete for ID: $id");
            $query = "DELETE FROM {$this->table} WHERE id = :id AND restaurant_id = :restaurant_id";
            $result = $this->query($query, ['id' => $id, 'restaurant_id' => $restaurant_id]);
            error_log("Raw delete result: " . json_encode($result));
            $checkQuery = "SELECT COUNT(*) as count FROM {$this->table} WHERE id = :id AND restaurant_id = :restaurant_id";
            $checkResult = $this->query($checkQuery, ['id' => $id, 'restaurant_id' => $restaurant_id]);
            $count = $checkResult[0]->count ?? 1;
            if ($count > 0) {
                throw new Exception("Database deletion failed for ID: $id");
            }
            error_log("Menu::deleteMenuItem successful for ID: $id");
            return true;
        } catch (Exception $e) {
            error_log("Error deleting menu item: " . $e->getMessage());
            return false;
        }
    }

    public function toggleAvailability($id, $is_active, $restaurant_id) {
        error_log("Menu::toggleAvailability called for ID: $id, is_active: $is_active, restaurant_id: $restaurant_id");
        try {
            $item = $this->getMenuItemById($id, $restaurant_id);
            if (!$item) {
                throw new Exception("Menu item not found with ID: $id for restaurant_id: $restaurant_id");
            }
            $data = ['is_active' => $is_active];
            error_log("Updating is_active for ID: $id to: $is_active");
            $result = $this->update($id, $data, 'id');
            error_log("Raw update result: " . json_encode($result));
            $updatedItem = $this->getMenuItemById($id, $restaurant_id);
            if ($updatedItem && $updatedItem->is_active == $is_active) {
                error_log("Menu::toggleAvailability successful for ID: $id");
                return true;
            } else {
                throw new Exception("Failed to update is_active for ID: $id");
            }
        } catch (Exception $e) {
            error_log("Error toggling availability: " . $e->getMessage());
            return false;
        }
    }
}