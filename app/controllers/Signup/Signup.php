<?php
class Signup extends Controller {

    public function index() {
        // Initialize an empty error array
        $data = [
            'errors' => []
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Sanitize and validate input data
            $data = [
                // Personal Information
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),

                // Business Information
                'company_name' => trim($_POST['company_name']),
                'BRNum' => trim($_POST['BRNum']),
                'servicetype' => trim($_POST['servicetype']),
                'mobileNum' => trim($_POST['mobileNum']),
                'address' => trim($_POST['address']),

                // Additional Information
                'district' => trim($_POST['district']),
                'province' => trim($_POST['province']),
                'yearStarted' => trim($_POST['yearStarted']),
                'errors' => []
            ];

            // Validate input data
            $data['errors'] = $this->validateSignup($data);

            // If no errors, proceed with registration
            if (empty($data['errors'])) {
                try {
                    // Hash the password
                    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                    $data['password'] = $hashedPassword;
                    
                    // Register based on service type
                    $registrationResult = $this->registerServiceProvider($data);
                    
                    if ($registrationResult) {
                        // Redirect to login or dashboard
                        
                        header('Location: ' . ROOT . '/Hotel/Hdashboard');
                        exit();
                    } else {
                        $data['errors']['registration'] = 'Registration failed. Please try again.';
                    }
                } catch (Exception $e) {
                    // Log the error
                    // var_dump($data);
                    error_log('Registration failed: ' . $e->getMessage());
                    $data['errors']['registration'] = 'An unexpected error occurred. Please try again.';
                }
            }
            $this->view('traveler/home', $data);
        } 
        else {
            // If not a POST request, load the signup form
            $this->view('signup/signup', $data);
        }
    }

    private function validateSignup($data) {
        $errors = [];

        // Personal Information Validation
        if (empty($data['name'])) {
            $errors['name'] = 'Please enter the Service Provider Name';
        } elseif (strlen($data['name']) < 5) {
            $errors['name'] = 'Service Provider Name must be at least 5 characters long';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Please enter an email address';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Please enter a password';
        } elseif (strlen($data['password']) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long';
        }

        if (empty($data['confirmPassword'])) {
            $errors['confirmPassword'] = 'Please confirm your password';
        } elseif ($data['password'] !== $data['confirmPassword']) {
            $errors['confirmPassword'] = 'Passwords do not match';
        }

        // Business Information Validation
        if (empty($data['company_name'])) {
            $errors['company_name'] = 'Please enter your company name';
        }

        if (empty($data['BRNum'])) {
            $errors['BRNum'] = 'Please enter your Business Registration Number';
        }

        if (empty($data['servicetype']) || $data['servicetype'] === 'none') {
            $errors['servicetype'] = 'Please select a service type';
        }

        if (empty($data['mobileNum'])) {
            $errors['mobileNum'] = 'Please enter a contact number';
        } elseif (!preg_match('/^[0-9]{10}$/', $data['mobileNum'])) {
            $errors['mobileNum'] = 'Invalid mobile number format';
        }

        if (empty($data['address'])) {
            $errors['address'] = 'Please enter your business address';
        }

        // Additional Information Validation
        if (empty($data['district'])) {
            $errors['district'] = 'Please enter your district';
        }

        if (empty($data['province'])) {
            $errors['province'] = 'Please enter your province';
        }

        if (empty($data['yearStarted'])) {
            $errors['yearStarted'] = 'Please enter the year you started your business';
        } elseif (!is_numeric($data['yearStarted']) || 
                  $data['yearStarted'] < 1900 || 
                  $data['yearStarted'] > date('Y')) {
            $errors['yearStarted'] = 'Invalid year format';
        }

        return $errors;
    }

    private function registerServiceProvider($data) {
        switch($data['servicetype']) {
            case 'accommodation':

                $user = new Hotel;
                
                $insertData = [
                    'serviceProviderName' => $data['name'],
                    'hotelEmail' => $data['email'],
                    'hotelPassword' => $data['password'],
                    'hotelMobileNum' => $data['mobileNum'],
                    'hotelAddress' => $data['address'],
                    'district' => $data['district'],
                    'province' => $data['province'],
                    'hotelName' => $data['company_name'],
                    'BRNum' => $data['BRNum'],
                    'yearStarted' => $data['yearStarted']
                ];

                $isInserted = $user->insert($insertData);

                if ($isInserted) {
                    
                    $newUser = $user->where(['hotelEmail' => $data['email']])[0];
                    if (!empty($newUser)) {
                        redirect('traveler/login');
                    }
                    else {
                        throw new Exception('Could not retrieve inserted user');
                    }
                } 
                else {
                    throw new Exception('Failed to insert accommodation provider');
                }
                break;

            case 'dining':
                $user = new Restaurant(); // Create this model
                $isInserted = $user->insert($data);
                if ($isInserted) {
                    // Add session and redirect logic
                } else {
                    throw new Exception('Failed to insert dining provider');
                }
                break;

            case 'travel':
                $user = new TravelProvider(); // Create this model
                $isInserted = $user->insert($data);
                if ($isInserted) {
                    // Add session and redirect logic
                } else {
                    throw new Exception('Failed to insert travel provider');
                }
                break;

            default:
                throw new Exception('Invalid service type');
        }
    }
}