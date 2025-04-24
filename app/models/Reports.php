<?php

class Reports {
    use Model;

    protected $table = 'reports';
    protected $primaryKey = 'report_id';
    protected $db;

    protected $allowedColumns = [
        'category',
        'subject',
        'description',
        'email',
        'priority',
        'status',
        'word_count',
        'char_count',
        'created_at',
        'updated_at',
        'hotel_id'
    ];

    public function __construct() {
        $this->db = $this->connect();
    }

    protected function connect() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=explorelk_test", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed");
        }
    }

    public function validate($data): bool {
        $this->errors = [];

        if (empty($data['category'])) {
            $this->errors['category'] = "Category is required";
        } elseif (!in_array($data['category'], ['technical', 'payment', 'booking', 'feedback', 'other'])) {
            $this->errors['category'] = "Invalid category selected";
        }

        if (empty($data['subject'])) {
            $this->errors['subject'] = "Subject is required";
        }

        if (empty($data['description'])) {
            $this->errors['description'] = "Description is required";
        }

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format";
        }

        if (empty($data['priority'])) {
            $this->errors['priority'] = "Priority is required";
        } elseif (!in_array($data['priority'], ['low', 'medium', 'high'])) {
            $this->errors['priority'] = "Invalid priority selected";
        }

        if (empty($data['hotel_id'])) {
            $this->errors['hotel_id'] = "Hotel ID is required";
        }

        if (empty($data['status'])) {
            $data['status'] = 'pending';
        } elseif (!in_array($data['status'], ['pending', 'open', 'closed'])) {
            $this->errors['status'] = "Invalid status";
        }

        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function beforeSave(&$data): void {
        if (empty($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
    }

    public function insert($data) {
        $filteredData = array_intersect_key($data, array_flip($this->allowedColumns));
        $this->beforeSave($filteredData);

        try {
            $columns = implode(', ', array_keys($filteredData));
            $placeholders = implode(', ', array_fill(0, count($filteredData), '?'));
            $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
            
            error_log("Executing SQL: $sql | Data: " . print_r(array_values($filteredData), true));

            $stmt = $this->db->prepare($sql);
            $stmt->execute(array_values($filteredData));
            
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Insert error: " . $e->getMessage() . " | Data: " . print_r($filteredData, true));
            return false;
        }
    }
}