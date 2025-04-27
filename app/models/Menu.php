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
                if (!isset($data[$field]) || empty(trim($data[$field]))) {
                    throw new Exception("Missing or empty required field: $field");
                }
            }

            // Handle image upload
            $data['image'] = '/uploads/menuItems/default.jpg'; // Default image
            if (!empty($data['image_file']) && is_array($data['image_file']) && $data['image_file']['size'] > 0) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Uploads/menuItems/';
                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0755, true)) {
                        throw new Exception("Failed to create upload directory: $uploadDir");
                    }
                    error_log("Created upload directory: $uploadDir");
                }

                $originalFileName = basename($data['image_file']['name']);
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $fileName = uniqid('', true) . '.' . $fileExtension;
                $targetPath = $uploadDir . $fileName;

                error_log("Attempting to upload image to: $targetPath");
                if (!move_uploaded_file($data['image_file']['tmp_name'], $targetPath)) {
                    throw new Exception("Failed to upload image: " . $data['image_file']['error']);
                }
                $data['image'] = '/Uploads/menuItems/' . $fileName;
                error_log("Image uploaded successfully: " . $data['image']);
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
            throw $e; // Re-throw to handle in controller
        }
    }

    public function updateMenuItem($id, $data, $restaurant_id) {
        error_log("Menu::updateMenuItem called for ID: $id, restaurant_id: $restaurant_id with data: " . json_encode($data));
        try {
            $existingItem = $this->getMenuItemById($id, $restaurant_id);
            if (!$existingItem) {
                throw new Exception("Menu item not found or does not belong to restaurant_id: $restaurant_id");
            }

            if (!empty($data['image_file']) && is_array($data['image_file']) && $data['image_file']['size'] > 0) {
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Uploads/menuItems/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $originalFileName = basename($data['image_file']['name']);
                $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $fileName = uniqid('menu_', true) . '.' . $fileExtension;
                $targetPath = $uploadDir . $fileName;

                error_log("Attempting to upload new image to: $targetPath");
                if (move_uploaded_file($data['image_file']['tmp_name'], $targetPath)) {
                    $data['image'] = '/Uploads/menuItems/' . $fileName;
                    if ($existingItem->image && file_exists($_SERVER['DOCUMENT_ROOT'] . $existingItem->image) && $existingItem->image !== '/Uploads/menuItems/default.jpg') {
                        error_log("Deleting old image: " . $_SERVER['DOCUMENT_ROOT'] . $existingItem->image);
                        unlink($_SERVER['DOCUMENT_ROOT'] . $existingItem->image);
                    }
                    error_log("New image uploaded successfully: " . $data['image']);
                } else {
                    throw new Exception("Failed to upload image");
                }
            } else {
                unset($data['image']);
                unset($data['image_file']);
                error_log("No new image uploaded for item ID: $id");
            }

            $filteredData = array_intersect_key($data, array_flip($this->allowedColumns));
            error_log("Updating menu item ($id): " . json_encode($filteredData));
            $result = $this->update($id, $filteredData, 'id');
            error_log("Menu::updateMenuItem result: " . ($result ? 'success' : 'failed'));
            return $result;
        } catch (Exception $e) {
            error_log("Error updating menu item: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteMenuItem($id, $restaurant_id) {
        error_log("Menu::deleteMenuItem called for ID: $id, restaurant_id: $restaurant_id");
        try {
            $item = $this->getMenuItemById($id, $restaurant_id);
            if (!$item) {
                throw new Exception("Menu item not found with ID: $id for restaurant_id: $restaurant_id");
            }
            if ($item->image && file_exists($_SERVER['DOCUMENT_ROOT'] . $item->image) && $item->image !== '/Uploads/menuItems/default.jpg') {
                error_log("Attempting to delete image: " . $_SERVER['DOCUMENT_ROOT'] . $item->image);
                if (!unlink($_SERVER['DOCUMENT_ROOT'] . $item->image)) {
                    error_log("Failed to delete image file: " . $_SERVER['DOCUMENT_ROOT'] . $item->image);
                } else {
                    error_log("Image deleted successfully: " . $_SERVER['DOCUMENT_ROOT'] . $item->image);
                }
            }
            $query = "DELETE FROM {$this->table} WHERE id = :id AND restaurant_id = :restaurant_id";
            $result = $this->query($query, ['id' => $id, 'restaurant_id' => $restaurant_id]);
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
            throw $e;
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
            $updatedItem = $this->getMenuItemById($id, $restaurant_id);
            if ($updatedItem && $updatedItem->is_active == $is_active) {
                error_log("Menu::toggleAvailability successful for ID: $id");
                return true;
            } else {
                throw new Exception("Failed to update is_active for ID: $id");
            }
        } catch (Exception $e) {
            error_log("Error toggling availability: " . $e->getMessage());
            throw $e;
        }
    }
}