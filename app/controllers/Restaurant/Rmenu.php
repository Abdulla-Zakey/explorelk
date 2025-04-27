<?php
class Rmenu extends Controller {
    private $menuModel;

    public function __construct() {
        error_log("Rmenu controller: Initializing");
        require_once '../app/models/Menu.php';
        $this->menuModel = new Menu();
        error_log("Rmenu controller: Menu model loaded");
    }

    public function index($a = '', $b = '', $c = '') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        
        error_log("Rmenu::index called with params: a=$a, b=$b, c=$c");
        $data = [
            'menuItems' => $this->menuModel->getAllMenuItems($_SESSION['restaurant_id']),
            'title' => 'Restaurant Menu Management'
        ];
        $this->view('restaurant/rmenu', $data);
        error_log("Rmenu::index rendered view");
    }

    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session.");
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit();
        }

        error_log("Rmenu::create called");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                error_log("POST data: " . json_encode($_POST));
                error_log("FILES data: " . json_encode($_FILES));
                $requiredFields = ['name', 'description', 'price', 'category', 'availability'];
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                        throw new Exception("Missing or empty required field: $field");
                    }
                }

                $data = [
                    'restaurant_id' => $_SESSION['restaurant_id'],
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description']),
                    'price' => floatval($_POST['price']),
                    'category' => trim($_POST['category']),
                    'availability' => trim($_POST['availability']),
                    'image_file' => isset($_FILES['image']) ? $_FILES['image'] : null
                ];

                if ($this->menuModel->createMenuItem($data)) {
                    error_log("Rmenu::create successful");
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Menu item created successfully']);
                } else {
                    throw new Exception('Failed to create menu item in database');
                }
            } catch (Exception $e) {
                error_log("Create menu item error: " . $e->getMessage());
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to create menu item: ' . $e->getMessage()
                ]);
            }
        } else {
            error_log("Invalid request method for create: " . $_SERVER['REQUEST_METHOD']);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }

    public function update($id = '') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session.");
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit();
        }

        error_log("Rmenu::update called for ID: $id");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $requiredFields = ['name', 'description', 'price', 'category', 'availability'];
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                        throw new Exception("Missing or empty required field: $field");
                    }
                }

                $data = [
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description']),
                    'price' => floatval($_POST['price']),
                    'category' => trim($_POST['category']),
                    'availability' => trim($_POST['availability']),
                    'image_file' => isset($_FILES['image']) && $_FILES['image']['size'] > 0 ? $_FILES['image'] : null
                ];

                if ($this->menuModel->updateMenuItem($id, $data, $_SESSION['restaurant_id'])) {
                    error_log("Rmenu::update successful");
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Menu item updated successfully']);
                } else {
                    throw new Exception('Failed to update menu item');
                }
            } catch (Exception $e) {
                error_log("Update menu item error: " . $e->getMessage());
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Failed to update menu item: ' . $e->getMessage()]);
            }
        } else {
            error_log("Invalid request method for update: " . $_SERVER['REQUEST_METHOD']);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }

    public function delete($id = '') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session.");
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit();
        }

        error_log("Rmenu::delete called for ID: $id");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (empty($id)) {
                    throw new Exception('No ID provided for deletion');
                }
                $item = $this->menuModel->getMenuItemById($id, $_SESSION['restaurant_id']);
                if (!$item) {
                    throw new Exception('Menu item not found with ID: ' . $id);
                }
                if ($this->menuModel->deleteMenuItem($id, $_SESSION['restaurant_id'])) {
                    error_log("Rmenu::delete successful for ID: $id");
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Menu item deleted successfully']);
                } else {
                    throw new Exception('Failed to delete menu item from database');
                }
            } catch (Exception $e) {
                error_log("Delete menu item error: " . $e->getMessage());
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'error' => 'Failed to delete menu item: ' . $e->getMessage()
                ]);
            }
        } else {
            error_log("Invalid request method for delete: " . $_SERVER['REQUEST_METHOD']);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }

    public function toggle($id = '') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session.");
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit();
        }

        ob_start();
        error_log("Rmenu::toggle called for ID: $id");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (empty($id)) {
                    throw new Exception('No ID provided for toggling availability');
                }
                $rawInput = file_get_contents('php://input');
                error_log("Raw toggle input: " . $rawInput);
                $inputData = json_decode($rawInput, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON input: ' . json_last_error_msg());
                }

                if (!isset($inputData['is_active'])) {
                    throw new Exception('is_active parameter missing');
                }

                $is_active = filter_var($inputData['is_active'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
                error_log("Toggling availability for ID: $id to: $is_active");

                $item = $this->menuModel->getMenuItemById($id, $_SESSION['restaurant_id']);
                if (!$item) {
                    throw new Exception('Menu item not found with ID: ' . $id);
                }

                if ($this->menuModel->toggleAvailability($id, $is_active, $_SESSION['restaurant_id'])) {
                    error_log("Rmenu::toggle successful for ID: $id");
                    ob_clean();
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'message' => 'Availability toggled successfully']);
                } else {
                    throw new Exception('Failed to toggle availability in database');
                }
            } catch (Exception $e) {
                error_log("Toggle availability error: " . $e->getMessage());
                ob_clean();
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        } else {
            error_log("Invalid request method for toggle: " . $_SERVER['REQUEST_METHOD']);
            ob_clean();
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
        ob_end_flush();
    }

    public function get($id = '') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session.");
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Unauthorized']);
            exit();
        }

        error_log("Rmenu::get called for ID: $id");
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                $item = $this->menuModel->getMenuItemById($id, $_SESSION['restaurant_id']);
                if ($item) {
                    error_log("Rmenu::get successful");
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'data' => $item]);
                } else {
                    throw new Exception('Menu item not found');
                }
            } catch (Exception $e) {
                error_log("Get menu item error: " . $e->getMessage());
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Failed to get menu item: ' . $e->getMessage()]);
            }
        } else {
            error_log("Invalid request method for get: " . $_SERVER['REQUEST_METHOD']);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }
    }
}