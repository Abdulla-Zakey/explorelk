<?php
class Signup extends Controller {
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
                'serviceProviderName' => $_POST['name'],
                'hotelEmail' => $_POST['email'],
                'hotelPassword' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Secure password hashing
                'hotelMobileNum' => $_POST['mobileNum'],
                'hotelAddress' => $_POST['address'],
                'district' => $_POST['district'],
                'province' => $_POST['province'],
                'hotelName' => $_POST['company_name'],
                'BRNum' => $_POST['BRNum'],
                'yearStarted' => $_POST['yearStarted']
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
                $sql = "INSERT INTO hotel (serviceProviderName, hotelEmail, hotelPassword, hotelMobileNum, hotelAddress, district, province, hotelName, BRNum, yearStarted)
                        VALUES (:serviceProviderName, :hotelEmail, :hotelPassword, :hotelMobileNum, :hotelAddress, :district, :province, :hotelName, :BRNum, :yearStarted)";
                $stmt = $pdo->prepare($sql);

                // Execute query
                if ($stmt->execute($insertData)) {
                    echo "Hotel registration successful.";
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
                $this->view('signup/signup', $data);
        }
    }
}
