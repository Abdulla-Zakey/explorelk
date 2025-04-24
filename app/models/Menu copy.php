<?php
class Menu {
    use Model;

    protected $table = "menu_items";
    protected $allowedColumns = [
        'name',
        'description',
        'price',
        'category',
        'availability',
        'image',
        'is_active'
    ];

    public function getAllMenuItems() {
        error_log("Menu::getAllMenuItems called");
        $query = "SELECT * FROM {$this->table}";
        $result = $this->query($query);
        error_log("getAllMenuItems result: " . json_encode($result));
        return $result ?: [];
    }

    public function getMenuItemById($id) {
        error_log("Menu::getMenuItemById called for ID: $id");
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $result = $this->query($query, ['id' => $id]);
        error_log("getMenuItemById($id) result: " . json_encode($result));
        return $result ? $result[0] : null;
    }

    public function createMenuItem($data) {
        error_log("Menu::createMenuItem called with data: " . json_encode($data));
        try {
            $requiredFields = ['name', 'description', 'price', 'category', 'availability'];
            foreach ($requiredFields as $field) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    throw new Exception("Missing or empty required field: $field");
                }
            }

            $data['image'] = '/assets/images/restaurant/menu-item/default.jpg';
            if (!empty($data['image']) && is_array($data['image']) && $data['image']['size'] > 0) {
                $uploadDir = ROOT . '/assets/images/restaurant/menu-item/';
                error_log("Checking upload directory: $uploadDir");
                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0755, true)) {
                        throw new Exception("Failed to create upload directory: $uploadDir");
                    }
                    error_log("Created upload directory: $uploadDir");
                }
                $fileName = time() . '_' . basename($data['image']['name']);
                $targetPath = $uploadDir . $fileName;

                error_log("Attempting to upload image to: $targetPath");
                if (!move_uploaded_file($data['image']['tmp_name'], $targetPath)) {
                    error_log("Image upload failed with error code: " . $data['image']['error']);
                    throw new Exception("Failed to upload image: " . $data['image']['error']);
                }
                $data['image'] = '/assets/images/restaurant/menu-item/' . $fileName;
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
            return false;
        }
    }

    public function updateMenuItem($id, $data) {
        error_log("Menu::updateMenuItem called for ID: $id with data: " . json_encode($data));
        try {
            if (!empty($data['image']) && is_array($data['image']) && $data['image']['size'] > 0) {
                $uploadDir = ROOT . '/assets/images/restaurant/menu-item/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileName = time() . '_' . basename($data['image']['name']);
                $targetPath = $uploadDir . $fileName;

                if (move_uploaded_file($data['image']['tmp_name'], $targetPath)) {
                    $data['image'] = '/assets/images/restaurant/menu-item/' . $fileName;
                    $oldItem = $this->getMenuItemById($id);
                    if ($oldItem && $oldItem->image && file_exists(ROOT . $oldItem->image) && $oldItem->image !== '/assets/images/restaurant/menu-item/default.jpg') {
                        unlink(ROOT . $oldItem->image);
                    }
                } else {
                    throw new Exception("Failed to upload image");
                }
            } else {
                unset($data['image']);
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

    public function deleteMenuItem($id) {
        error_log("Menu::deleteMenuItem called for ID: $id");
        try {
            $item = $this->getMenuItemById($id);
            if ($item && $item->image && file_exists(ROOT . $item->image) && $item->image !== '/assets/images/restaurant/menu-item/default.jpg') {
                unlink(ROOT . $item->image);
            }
            $result = $this->delete($id, 'id');
            error_log("Menu::deleteMenuItem result: " . ($result ? 'success' : 'failed'));
            return $result;
        } catch (Exception $e) {
            error_log("Error deleting menu item: " . $e->getMessage());
            return false;
        }
    }

    public function toggleAvailability($id, $is_active) {
        error_log("Menu::toggleAvailability called for ID: $id, is_active: $is_active");
        try {
            $result = $this->update($id, ['is_active' => $is_active], 'id');
            error_log("Menu::toggleAvailability result: " . ($result ? 'success' : 'failed'));
            return $result;
        } catch (Exception $e) {
            error_log("Error toggling availability: " . $e->getMessage());
            return false;
        }
    }
}