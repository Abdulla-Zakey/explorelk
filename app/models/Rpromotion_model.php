<?php
class Rpromotion_model
{
    use Model;

    protected $table = 'promotions';

    protected $allowedColumns = [
        'restaurant_id',
        'type',
        'image',
        'food_items',
        'discount',
        'description',
        'valid_until',
        'created_at'
    ];

    public function validate($data, $restaurant_id, $existingPromotionId = null)
    {
        $this->errors = [];

        // Validate restaurant_id
        if (empty($data['restaurant_id'])) {
            $this->errors['restaurant_id'] = "Restaurant ID is required.";
        }

        // Validate type
        if (empty($data['type'])) {
            $this->errors['type'] = "Promotion type is required.";
        } elseif (!in_array($data['type'], ['single', 'combo'])) {
            $this->errors['type'] = "Invalid promotion type.";
        }

        // Validate food_items
        if (empty($data['food_items'])) {
            $this->errors['food_items'] = "At least one menu item is required.";
        } else {
            $food_items = json_decode($data['food_items'], true);
            if (!is_array($food_items) || empty($food_items)) {
                $this->errors['food_items'] = "Invalid menu items format.";
            } else {
                foreach ($food_items as $item) {
                    if (empty($item['id']) || empty($item['name'])) {
                        $this->errors['food_items'] = "Menu items must have valid ID and name.";
                        break;
                    }
                    // Verify menu item exists and belongs to restaurant
                    $menuItem = $this->query("SELECT id FROM menu_items WHERE id = :id AND restaurant_id = :restaurant_id AND is_active = 1", [
                        'id' => $item['id'],
                        'restaurant_id' => $restaurant_id
                    ]);
                    if (empty($menuItem)) {
                        $this->errors['food_items'] = "Selected menu item does not exist or is not active.";
                        break;
                    }
                }
                if ($data['type'] === 'single' && count($food_items) > 1) {
                    $this->errors['food_items'] = "Single item promotions can only have one menu item.";
                }
            }
        }

        // Validate discount
        if (empty($data['discount'])) {
            $this->errors['discount'] = "Discount percentage is required.";
        } elseif (!is_numeric($data['discount']) || $data['discount'] < 0 || $data['discount'] > 100) {
            $this->errors['discount'] = "Discount must be a number between 0 and 100.";
        }

        // Validate description
        if (empty($data['description'])) {
            $this->errors['description'] = "Description is required.";
        }

        // Validate valid_until
        if (empty($data['valid_until'])) {
            $this->errors['valid_until'] = "Valid until date is required.";
        } elseif (strtotime($data['valid_until']) < strtotime(date('Y-m-d'))) {
            $this->errors['valid_until'] = "Valid until date must be in the future.";
        }

        if (!empty($this->errors)) {
            error_log('Promotion validation failed: ' . json_encode($this->errors));
        }

        return empty($this->errors);
    }

    public function getMenuItems($restaurant_id)
    {
        return $this->query("SELECT id, name, price FROM menu_items WHERE restaurant_id = :restaurant_id AND is_active = 1", [
            'restaurant_id' => $restaurant_id
        ]);
    }

    public function getAllPromotions($restaurant_id)
    {
        return $this->where(['restaurant_id' => $restaurant_id]);
    }

    public function getPromotionById($id, $restaurant_id)
    {
        return $this->first(['id' => $id, 'restaurant_id' => $restaurant_id]);
    }
}
?>