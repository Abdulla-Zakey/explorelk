<?php
class TestInsert extends Controller {
    public function index() {
        $data = [
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Debugging data
            var_dump($_POST);

            // Insert data
            $insertData = [
                'name' => trim($_POST['name']),
                'nic' => trim($_POST['nic']),
                'mobileNum' => trim($_POST['mobileNum']),
                'email' => trim($_POST['email']),
                'licenseNum' => trim($_POST['licenseNum']),
                'experience' => trim($_POST['experience']),
                'fieldsOfExpertise' => trim($_POST['fieldsOfExpertise']),
                'tourFrequencyPerMonth' => trim($_POST['tourFrequencyPerMonth']),
                'username' => trim($_POST['username']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Secure password hashing
                // 'confirmPassword' => $_POST['confirmPassword']
            ];

            // Database connection
            $dbHost = 'localhost'; // Update with your database host
            $dbUser = 'root'; // Update with your database username
            $dbPass = ''; // Update with your database password
            $dbName = 'explorelk_test'; // Update with your database name

            try {
                // Using PDO for secure and modern database access
                $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare SQL query
                $sql = "INSERT INTO tourguide (name, nic, mobileNum, email, licenseNum, experience, fieldsOfExpertise, tourFrequencyPerMonth, username, password)
                        VALUES (:name, :nic, :mobileNum, :email, :licenseNum, :experience, :fieldsOfExpertise, :tourFrequencyPerMonth, :username, :password)";
                $stmt = $pdo->prepare($sql);

                // Execute query
                if ($stmt->execute($insertData)) {
                    echo "Guide registration successful.";
                } else {
                    echo "Error during registration.";
                }
            } catch (PDOException $e) {
                // Handle database connection errors
                echo "Database error: " . $e->getMessage();
            }
        }
        else {
            // If not a POST request, load the signup form
                //$this->view('signup/signup', $data);
                $this->view('signup/tourGuideSignup', $data);
        }
    }
}
