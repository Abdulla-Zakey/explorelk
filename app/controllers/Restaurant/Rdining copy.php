<?php

class Rdining extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check if user is logged in
        if (!isset($_SESSION['restaurant_id'])) {
            error_log("Session Error: restaurant_id not set in session. Redirecting to login.");
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        try {
            // Load models
            $tableModel = new Table();
            $reservationModel = new Reservation();
            $restaurant_id = $_SESSION['restaurant_id'];

            // Get selected date and tab (from query parameters or defaults)
            $selectedDate = $_GET['date'] ?? date('Y-m-d');
            $tab = $_GET['tab'] ?? 'tables';

            // Get all tables for the restaurant
            $tables = $tableModel->getAllTables($restaurant_id);

            // Add reservations to each table for the selected date
            foreach ($tables as &$table) {
                $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
            }

            // Get reservations for the Reservations tab and add table details
            $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
            foreach ($reservations as &$reservation) {
                $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                $reservation->table_number = $table ? $table->number : 'Unknown';
                $reservation->table_location = $table ? $table->location : 'Unknown';
            }

            // Initialize errors and form data
            $errors = [];
            $editReservation = null;
            $addReservationForm = null;
            $updateTableForm = null;
            $successMessage = null;

            // Handle table addition
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_table'])) {
                $data = [
                    'restaurant_id' => $restaurant_id,
                    'number' => $_POST['number'] ?? '',
                    'capacity' => $_POST['capacity'] ?? '',
                    'location' => $_POST['location'] ?? ''
                ];

                error_log('Received addTable request: ' . json_encode($data));

                if ($tableModel->validate($data, $restaurant_id)) {
                    $result = $tableModel->insert($data);
                    if ($result) {
                        error_log('Table added successfully: ' . json_encode($data));
                        $successMessage = 'Table added successfully';
                        // Refresh tables and reservations
                        $tables = $tableModel->getAllTables($restaurant_id);
                        foreach ($tables as &$table) {
                            $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
                        }
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    } else {
                        error_log('Table insert failed: ' . json_encode($tableModel->errors));
                        $errors['table'] = $tableModel->errors;
                    }
                } else {
                    error_log('Table validation failed: ' . json_encode($tableModel->errors));
                    $errors['table'] = $tableModel->errors;
                }
            }

            // Handle show add reservation form
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_add_reservation'])) {
                $tableId = $_POST['table_id'] ?? '';
                $table = $tableModel->getTableById($tableId, $restaurant_id);
                if ($table) {
                    $addReservationForm = [
                        'table_id' => $table->id,
                        'table_number' => $table->number
                    ];
                } else {
                    $errors['reservation'] = ['general' => 'Table not found or does not belong to this restaurant'];
                }
            }

            // Handle reservation addition
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_reservation'])) {
                $data = [
                    'table_id' => $_POST['table_id'] ?? '',
                    'customer_name' => $_POST['customer_name'] ?? '',
                    'date' => $_POST['date'] ?? $selectedDate,
                    'start_time' => $_POST['start_time'] ?? '',
                    'end_time' => $_POST['end_time'] ?? '',
                    'notes' => $_POST['notes'] ?? ''
                ];

                error_log('Received addReservation request: ' . json_encode($data));

                if ($reservationModel->validate($data, $restaurant_id)) {
                    $result = $reservationModel->insert($data);
                    if ($result) {
                        error_log('Reservation added successfully: ' . json_encode($data));
                        $successMessage = 'Table reserved successfully';
                        $table = $tableModel->getTableById($data['table_id'], $restaurant_id);
                        $addReservationForm = [
                            'table_id' => $data['table_id'],
                            'table_number' => $table ? $table->number : 'Unknown'
                        ];
                        // Refresh tables and reservations
                        $tables = $tableModel->getAllTables($restaurant_id);
                        foreach ($tables as &$table) {
                            $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
                        }
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    } else {
                        error_log('Reservation insert failed: ' . json_encode($reservationModel->errors));
                        $errors['reservation'] = $reservationModel->errors;
                        $table = $tableModel->getTableById($data['table_id'], $restaurant_id);
                        $addReservationForm = [
                            'table_id' => $data['table_id'],
                            'table_number' => $table ? $table->number : 'Unknown'
                        ];
                    }
                } else {
                    error_log('Reservation validation failed: ' . json_encode($reservationModel->errors));
                    $errors['reservation'] = $reservationModel->errors;
                    $table = $tableModel->getTableById($data['table_id'], $restaurant_id);
                    $addReservationForm = [
                        'table_id' => $data['table_id'],
                        'table_number' => $table ? $table->number : 'Unknown'
                    ];
                }
            }

            // Handle show update table form
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_update_table'])) {
                $tableId = $_POST['table_id'] ?? '';
                $table = $tableModel->getTableById($tableId, $restaurant_id);
                if ($table) {
                    $updateTableForm = [
                        'id' => $table->id,
                        'number' => $table->number,
                        'capacity' => $table->capacity,
                        'location' => $table->location
                    ];
                } else {
                    $errors['table'] = ['general' => 'Table not found or does not belong to this restaurant'];
                }
            }

            // Handle table update
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_table'])) {
                $data = [
                    'id' => $_POST['table_id'] ?? '',
                    'restaurant_id' => $restaurant_id,
                    'number' => $_POST['number'] ?? '',
                    'capacity' => $_POST['capacity'] ?? '',
                    'location' => $_POST['location'] ?? ''
                ];

                error_log('Received updateTable request: ' . json_encode($data));

                if ($tableModel->validate($data, $restaurant_id, $data['id'])) {
                    $result = $tableModel->update($data['id'], [
                        'number' => $data['number'],
                        'capacity' => $data['capacity'],
                        'location' => $data['location']
                    ]);
                    if ($result) {
                        error_log('Table updated successfully: ' . json_encode($data));
                        $successMessage = 'Table updated successfully';
                        $table = $tableModel->getTableById($data['id'], $restaurant_id);
                        $updateTableForm = [
                            'id' => $table->id,
                            'number' => $table->number,
                            'capacity' => $table->capacity,
                            'location' => $table->location
                        ];
                        // Refresh tables and reservations
                        $tables = $tableModel->getAllTables($restaurant_id);
                        foreach ($tables as &$table) {
                            $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
                        }
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    } else {
                        error_log('Table update failed');
                        $errors['table'] = ['database' => 'Failed to update table'];
                        $table = $tableModel->getTableById($data['id'], $restaurant_id);
                        $updateTableForm = [
                            'id' => $data['id'],
                            'number' => $data['number'],
                            'capacity' => $data['capacity'],
                            'location' => $data['location']
                        ];
                    }
                } else {
                    error_log('Table validation failed: ' . json_encode($tableModel->errors));
                    $errors['table'] = $tableModel->errors;
                    $table = $tableModel->getTableById($data['id'], $restaurant_id);
                    $updateTableForm = [
                        'id' => $data['id'],
                        'number' => $data['number'],
                        'capacity' => $data['capacity'],
                        'location' => $data['location']
                    ];
                }
            }

            // Handle table deletion
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_table'])) {
                $tableId = $_POST['table_id'] ?? '';
                error_log('Received deleteTable request: ID=' . $tableId);
                $table = $tableModel->getTableById($tableId, $restaurant_id);
                if ($table) {
                    $result = $tableModel->delete($tableId);
                    if ($result) {
                        error_log('Table deleted successfully: ID=' . $tableId);
                        $successMessage = 'Table deleted successfully';
                        // Refresh tables and reservations
                        $tables = $tableModel->getAllTables($restaurant_id);
                        foreach ($tables as &$table) {
                            $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
                        }
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    } else {
                        error_log('Table deletion failed: ID=' . $tableId);
                        $errors['table'] = ['database' => 'Failed to delete table'];
                    }
                } else {
                    $errors['table'] = ['general' => 'Table not found or does not belong to this restaurant'];
                }
            }

            // Handle reservation edit request (show edit form)
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_reservation'])) {
                $reservationId = $_POST['reservation_id'] ?? '';
                $tableId = $_POST['table_id'] ?? '';
                $reservation = $reservationModel->getReservationById($reservationId, $restaurant_id);
                if ($reservation) {
                    $table = $tableModel->getTableById($tableId, $restaurant_id);
                    $editReservation = [
                        'id' => $reservation->id,
                        'table_id' => $reservation->table_id,
                        'table_number' => $table ? $table->number : 'Unknown',
                        'customer_name' => $reservation->customer_name,
                        'date' => $reservation->date,
                        'start_time' => $reservation->start_time,
                        'end_time' => $reservation->end_time,
                        'notes' => $reservation->notes
                    ];
                    // Refresh reservations to avoid undefined property errors
                    $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                    foreach ($reservations as &$reservation) {
                        $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                        $reservation->table_number = $table ? $table->number : 'Unknown';
                        $reservation->table_location = $table ? $table->location : 'Unknown';
                    }
                } else {
                    $errors['reservation'] = ['general' => 'Reservation not found or does not belong to this restaurant'];
                }
            }

            // Handle reservation update
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_reservation'])) {
                $data = [
                    'id' => $_POST['reservation_id'] ?? '',
                    'table_id' => $_POST['table_id'] ?? '',
                    'customer_name' => $_POST['customer_name'] ?? '',
                    'date' => $_POST['date'] ?? $selectedDate,
                    'start_time' => $_POST['start_time'] ?? '',
                    'end_time' => $_POST['end_time'] ?? '',
                    'notes' => $_POST['notes'] ?? ''
                ];

                error_log('Received updateReservation request: ' . json_encode($data));

                if ($reservationModel->validate($data, $restaurant_id)) {
                    $result = $reservationModel->update($data['id'], $data);
                    if ($result) {
                        error_log('Reservation updated successfully: ' . json_encode($data));
                        $successMessage = 'Reservation updated successfully';
                        // Refresh tables and reservations
                        $tables = $tableModel->getAllTables($restaurant_id);
                        foreach ($tables as &$table) {
                            $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
                        }
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    } else {
                        error_log('Reservation update failed');
                        $errors['reservation'] = ['database' => 'Failed to update reservation'];
                        $reservation = $reservationModel->getReservationById($data['id'], $restaurant_id);
                        $table = $tableModel->getTableById($data['table_id'], $restaurant_id);
                        $editReservation = [
                            'id' => $reservation->id,
                            'table_id' => $reservation->table_id,
                            'table_number' => $table ? $table->number : 'Unknown',
                            'customer_name' => $data['customer_name'],
                            'date' => $data['date'],
                            'start_time' => $data['start_time'],
                            'end_time' => $data['end_time'],
                            'notes' => $data['notes']
                        ];
                        // Refresh reservations to avoid undefined property errors
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    }
                } else {
                    error_log('Reservation validation failed: ' . json_encode($reservationModel->errors));
                    $errors['reservation'] = $reservationModel->errors;
                    $reservation = $reservationModel->getReservationById($data['id'], $restaurant_id);
                    $table = $tableModel->getTableById($data['table_id'], $restaurant_id);
                    $editReservation = [
                        'id' => $reservation->id,
                        'table_id' => $reservation->table_id,
                        'table_number' => $table ? $table->number : 'Unknown',
                        'customer_name' => $data['customer_name'],
                        'date' => $data['date'],
                        'start_time' => $data['start_time'],
                        'end_time' => $data['end_time'],
                        'notes' => $data['notes']
                    ];
                    // Refresh reservations to avoid undefined property errors
                    $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                    foreach ($reservations as &$reservation) {
                        $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                        $reservation->table_number = $table ? $table->number : 'Unknown';
                        $reservation->table_location = $table ? $table->location : 'Unknown';
                    }
                }
            }

            // Handle reservation cancellation
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_reservation'])) {
                $reservationId = $_POST['reservation_id'] ?? '';
                error_log('Received cancelReservation request: ID=' . $reservationId);
                $reservation = $reservationModel->getReservationById($reservationId, $restaurant_id);
                if ($reservation) {
                    $result = $reservationModel->delete($reservationId);
                    if ($result) {
                        error_log('Reservation cancelled successfully: ID=' . $reservationId);
                        $successMessage = 'Reservation cancelled successfully';
                        // Refresh tables and reservations
                        $tables = $tableModel->getAllTables($restaurant_id);
                        foreach ($tables as &$table) {
                            $table->reservations = $reservationModel->getReservationsByTableAndDate($table->id, $selectedDate, $restaurant_id);
                        }
                        $reservations = $reservationModel->getReservationsByDate($selectedDate, $restaurant_id);
                        foreach ($reservations as &$reservation) {
                            $table = $tableModel->getTableById($reservation->table_id, $restaurant_id);
                            $reservation->table_number = $table ? $table->number : 'Unknown';
                            $reservation->table_location = $table ? $table->location : 'Unknown';
                        }
                    } else {
                        error_log('Reservation cancellation failed: ID=' . $reservationId);
                        $errors['reservation'] = ['database' => 'Failed to cancel reservation'];
                    }
                } else {
                    $errors['reservation'] = ['general' => 'Reservation not found or does not belong to this restaurant'];
                }
            }

            // Pass data to view
            $data = [
                'tables' => $tables,
                'selectedDate' => $selectedDate,
                'reservations' => $reservations,
                'tab' => $tab,
                'errors' => $errors,
                'edit_reservation' => $editReservation,
                'add_reservation_form' => $addReservationForm,
                'update_table_form' => $updateTableForm,
                'success_message' => $successMessage
            ];

            $this->view('restaurant/rdining', $data);
        } catch (Exception $e) {
            error_log('Index error: ' . $e->getMessage());
            $this->view('restaurant/rdining', ['error' => 'Server error']);
        }
    }
}