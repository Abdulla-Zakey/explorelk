<?php
class Rpromotion extends Controller {
    private $promotionModel;

    public function __construct() {
        require_once '../app/models/Rpromotion_model.php';
        $this->promotionModel = new Rpromotion_model();
    }

    public function index($a = '', $b = '', $c = '') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Debug - No restaurant_id in session, redirecting to Login");
            redirect('traveler/Login');
            exit();
        }

        // Default data
        $data = [
            'promotions' => $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']),
            'menu_items' => $this->promotionModel->getMenuItems($_SESSION['restaurant_id']),
            'errors' => [],
            'form_data' => [],
            'is_editing' => false,
            'editing_id' => null
        ];

        // Handle form submissions
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'create':
                    $data = $this->processFormSubmission($_POST, $_FILES);
                    break;
                case 'update':
                    $data = $this->processFormSubmission($_POST, $_FILES, $_POST['promotion_id']);
                    break;
                case 'delete':
                    $this->deletePromotion($_POST['promotion_id']);
                    $data['promotions'] = $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']);
                    break;
                case 'edit':
                    $data = $this->prepareEditForm($_POST['promotion_id']);
                    break;
            }
        }

        $this->view('restaurant/rpromotion', $data);
    }

    private function processFormSubmission($postData, $files, $promotionId = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = [
            'restaurant_id' => $_SESSION['restaurant_id'],
            'type' => $postData['promotionType'] ?? '',
            'food_items' => [],
            'discount' => $postData['discount'] ?? '',
            'description' => $postData['description'] ?? '',
            'valid_until' => $postData['validUntil'] ?? '',
            'image' => ''
        ];

        // Process menu items
        if (!empty($postData['menu_items'])) {
            $menuItems = $this->promotionModel->getMenuItems($_SESSION['restaurant_id']);
            $selectedItems = [];
            foreach ($postData['menu_items'] as $itemId) {
                foreach ($menuItems as $item) {
                    if ($item['id'] == $itemId) {
                        $selectedItems[] = ['id' => $itemId, 'name' => $item['name']];
                    }
                }
            }
            $data['food_items'] = json_encode($selectedItems);
        }

        // Handle image upload
        if (isset($files['promotionImage']) && $files['promotionImage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'Uploads/promotions/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileName = uniqid() . '-' . basename($files['promotionImage']['name']);
            $uploadPath = $uploadDir . $fileName;
            if (move_uploaded_file($files['promotionImage']['tmp_name'], $uploadPath)) {
                $data['image'] = '/' . $uploadPath;
            }
        } elseif ($promotionId) {
            $existing = $this->promotionModel->getPromotionById($promotionId, $_SESSION['restaurant_id']);
            $data['image'] = $existing['image'] ?? '';
        }

        // Validate data
        $errors = [];
        if (!$this->promotionModel->validate($data, $_SESSION['restaurant_id'], $promotionId)) {
            $errors = $this->promotionModel->errors;
        }

        if (empty($errors)) {
            if ($promotionId) {
                // Update promotion
                if ($this->promotionModel->update($data, ['id' => $promotionId, 'restaurant_id' => $_SESSION['restaurant_id']])) {
                    return [
                        'promotions' => $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']),
                        'menu_items' => $this->promotionModel->getMenuItems($_SESSION['restaurant_id']),
                        'errors' => [],
                        'form_data' => [],
                        'is_editing' => false,
                        'editing_id' => null
                    ];
                } else {
                    $errors['general'] = 'Failed to update promotion';
                }
            } else {
                // Create promotion
                if ($this->promotionModel->insert($data)) {
                    return [
                        'promotions' => $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']),
                        'menu_items' => $this->promotionModel->getMenuItems($_SESSION['restaurant_id']),
                        'errors' => [],
                        'form_data' => [],
                        'is_editing' => false,
                        'editing_id' => null
                    ];
                } else {
                    $errors['general'] = 'Failed to create promotion';
                }
            }
        }

        // Return form data with errors
        return [
            'promotions' => $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']),
            'menu_items' => $this->promotionModel->getMenuItems($_SESSION['restaurant_id']),
            'errors' => $errors,
            'form_data' => $postData,
            'is_editing' => $promotionId ? true : false,
            'editing_id' => $promotionId
        ];
    }

    private function prepareEditForm($promotionId) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $promotion = $this->promotionModel->getPromotionById($promotionId, $_SESSION['restaurant_id']);
        if (!$promotion) {
            return [
                'promotions' => $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']),
                'menu_items' => $this->promotionModel->getMenuItems($_SESSION['restaurant_id']),
                'errors' => ['general' => 'Promotion not found'],
                'form_data' => [],
                'is_editing' => false,
                'editing_id' => null
            ];
        }

        $formData = [
            'promotionType' => $promotion['type'],
            'discount' => $promotion['discount'],
            'description' => $promotion['description'],
            'validUntil' => $promotion['valid_until'],
            'menu_items' => array_column(json_decode($promotion['food_items'], true), 'id'),
            'image' => $promotion['image'] ?? ''
        ];

        return [
            'promotions' => $this->promotionModel->getAllPromotions($_SESSION['restaurant_id']),
            'menu_items' => $this->promotionModel->getMenuItems($_SESSION['restaurant_id']),
            'errors' => [],
            'form_data' => $formData,
            'is_editing' => true,
            'editing_id' => $promotionId
        ];
    }

    private function deletePromotion($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $existingPromotion = $this->promotionModel->getPromotionById($id, $_SESSION['restaurant_id']);
        if ($existingPromotion) {
            $this->promotionModel->delete(['id' => $id, 'restaurant_id' => $_SESSION['restaurant_id']]);
        }
    }
}
?>