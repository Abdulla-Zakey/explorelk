
<?php

class TRestaurant extends Controller
{
    protected $tableModel;
    protected $reservationModel;
    protected $menuModel;
    protected $restaurant_id;

    public function __construct()
    {
        // Initialize models
        $this->tableModel = new Table();
        $this->reservationModel = new Reservation();
        $this->menuModel = new Menu();
        // Set restaurant_id to 6
        $this->restaurant_id = 6;
        // Log timezone
        error_log("RestaurantController initialized with restaurant_id: {$this->restaurant_id}, Timezone: " . date_default_timezone_get());
    }

    public function index()
    {
        // Fetch tables
        error_log("Attempting to fetch tables for restaurant_id: {$this->restaurant_id}");
        $tables = $this->tableModel->getAllTables($this->restaurant_id);
        error_log("Raw tables result: " . json_encode($tables));
        if (empty($tables)) {
            error_log("ERROR: No tables found for restaurant_id {$this->restaurant_id}. Check database, Table model, or query.");
        } else {
            $tableIds = array_column($tables, 'id');
            error_log("Fetched " . count($tables) . " tables with IDs: " . implode(', ', $tableIds));
            foreach ($tables as $table) {
                error_log("Table details: ID={$table->id}, Number={$table->number}, Capacity={$table->capacity}, Location={$table->location}");
            }
        }

        // Fetch reservations for the selected date (default to today)
        $selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
        $reservations = $this->reservationModel->getReservationsByDate($selected_date, $this->restaurant_id);
        error_log("Fetched reservations for restaurant_id {$this->restaurant_id}, date {$selected_date}: " . json_encode($reservations));

        // Fetch menu items
        $menuItems = $this->menuModel->getAllMenuItems($this->restaurant_id);
        error_log("Fetched menu items for restaurant_id {$this->restaurant_id}: " . json_encode($menuItems));

        // Organize menu items by category
        $menuData = [
            'starters' => [],
            'mains' => [],
            'desserts' => [],
            'drinks' => []
        ];
        foreach ($menuItems as $item) {
            if ($item->is_active) {
                $category = strtolower($item->category);
                if (array_key_exists($category, $menuData)) {
                    $menuData[$category][] = [
                        'id' => $item->id,
                        'name' => $item->name,
                        'description' => $item->description,
                        'price' => $item->price,
                        'image' => $item->image,
                        'tags' => json_decode($item->availability, true) ?? []
                    ];
                }
            }
        }
        error_log("Organized menuData: " . json_encode($menuData));

        // Pass data to the view
        $data = [
            'tables' => $tables,
            'reservations' => $reservations,
            'menuData' => $menuData,
            'selected_date' => $selected_date,
            'success' => isset($_GET['success']) ? $_GET['success'] : null,
            'error' => isset($_GET['error']) ? $_GET['error'] : null
        ];

        error_log("Passing data to view: tables_count=" . count($tables) . ", reservations_count=" . count($reservations));
        $this->view('traveler/trestaurant', $data);
    }

    public function reserve()
    {
        error_log("Reserve method called with request method: {$_SERVER['REQUEST_METHOD']}");
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("Invalid request method for reserve: {$_SERVER['REQUEST_METHOD']}");
            header('Location: ' . ROOT . '/traveler/restaurant?error=Invalid request method');
            exit;
        }

        $data = [
            'table_id' => $_POST['table_id'] ?? '',
            'customer_name' => $_POST['customer_name'] ?? '',
            'date' => $_POST['date'] ?? '',
            'start_time' => $_POST['start_time'] ?? '',
            'end_time' => $_POST['end_time'] ?? '',
            'notes' => $_POST['notes'] ?? ''
        ];
        error_log("Reserve request data: " . json_encode($data));

        // Basic input validation
        $missingFields = [];
        if (empty($data['table_id'])) $missingFields[] = 'table_id';
        if (empty($data['customer_name'])) $missingFields[] = 'customer_name';
        if (empty($data['date'])) $missingFields[] = 'date';
        if (empty($data['start_time'])) $missingFields[] = 'start_time';
        if (empty($data['end_time'])) $missingFields[] = 'end_time';
        if (!empty($missingFields)) {
            error_log("Missing required fields: " . implode(', ', $missingFields));
            header('Location: ' . ROOT . '/traveler/trestaurant?date=' . urlencode($data['date']) . '&error=Missing required fields: ' . urlencode(implode(', ', $missingFields)));
            exit;
        }

        // Validate using model
        if ($this->reservationModel->validate($data, $this->restaurant_id)) {
            // Check if getAllowedColumns exists
            if (!method_exists($this->reservationModel, 'getAllowedColumns')) {
                error_log("Error: getAllowedColumns method not defined in Reservation model");
                header('Location: ' . ROOT . '/traveler/trestaurant?date=' . urlencode($data['date']) . '&error=Internal server error: Reservation model misconfigured');
                exit;
            }

            $filteredData = array_intersect_key($data, array_flip($this->reservationModel->getAllowedColumns()));
            $filteredData['created_at'] = date('Y-m-d H:i:s');
            $filteredData['updated_at'] = date('Y-m-d H:i:s');
            error_log("Prepared data for insertion: " . json_encode($filteredData));

            // Attempt insertion
            try {
                $result = $this->reservationModel->insert($filteredData);
                if ($result) {
                    error_log("Reservation inserted successfully for table_id {$data['table_id']}");
                    header('Location: ' . ROOT . '/traveler/trestaurant?date=' . urlencode($data['date']) . '&success=Reservation created successfully');
                    exit;
                } else {
                    error_log("Failed to insert reservation: " . json_encode($filteredData));
                    header('Location: ' . ROOT . '/traveler/trestaurant?date=' . urlencode($data['date']) . '&error=Failed to create reservation');
                    exit;
                }
            } catch (Exception $e) {
                error_log("Database insertion error: " . $e->getMessage());
                header('Location: ' . ROOT . '/traveler/trestaurant?date=' . urlencode($data['date']) . '&error=Database error: ' . urlencode($e->getMessage()));
                exit;
            }
        } else {
            error_log("Validation failed with errors: " . json_encode($this->reservationModel->errors));
            header('Location: ' . ROOT . '/traveler/trestaurant?date=' . urlencode($data['date']) . '&error=' . urlencode(json_encode($this->reservationModel->errors)));
            exit;
        }
    }

    public function cancelReservation()
    {
        error_log("CancelReservation method called with request method: {$_SERVER['REQUEST_METHOD']}");
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("Invalid request method for cancelReservation: {$_SERVER['REQUEST_METHOD']}");
            header('Location: ' . ROOT . '/traveler/trestaurant?error=Invalid request method');
            exit;
        }

        $reservation_id = $_POST['reservation_id'] ?? '';
        error_log("Cancel reservation request for ID: {$reservation_id}");
        if (empty($reservation_id)) {
            error_log("Missing reservation_id");
            header('Location: ' . ROOT . '/traveler/trestaurant?error=Missing reservation ID');
            exit;
        }

        $reservation = $this->reservationModel->getReservationById($reservation_id, $this->restaurant_id);
        if ($reservation) {
            error_log("Reservation found: " . json_encode($reservation));
            $query = "DELETE FROM reservations WHERE id = :id AND table_id IN (SELECT id FROM tables WHERE restaurant_id = :restaurant_id)";
            try {
                $result = $this->reservationModel->query($query, [
                    'id' => $reservation_id,
                    'restaurant_id' => $this->restaurant_id
                ]);
                if ($result !== false) {
                    error_log("Reservation ID {$reservation_id} cancelled successfully");
                    header('Location: ' . ROOT . '/traveler/trestaurant?success=Reservation cancelled successfully');
                    exit;
                } else {
                    error_log("Failed to cancel reservation ID: {$reservation_id}");
                    header('Location: ' . ROOT . '/traveler/trestaurant?error=Failed to cancel reservation');
                    exit;
                }
            } catch (Exception $e) {
                error_log("Database deletion error: " . $e->getMessage());
                header('Location: ' . ROOT . '/traveler/trestaurant?error=Database error: ' . urlencode($e->getMessage()));
                exit;
            }
        } else {
            error_log("Reservation not found or does not belong to restaurant: {$reservation_id}");
            header('Location: ' . ROOT . '/traveler/trestaurant?error=Invalid reservation');
            exit;
        }
    }
}
