<?php
class Signup extends Controller {

    private $travelProvider;

    public function __construct() {
        $this->travelProvider = new TravelAgent();
    }
    public function index() {
        // Initialize an empty error array
        $data = [
            'errors' => []
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // show($_POST);
            // exit();
            
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
            // show($data['errors']);
            // If no errors, proceed with registration
            if (empty($data['errors'])) {
                try {
                    // Hash the password
                    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                    $data['password'] = $hashedPassword;
                    // echo 'ho';
                    // Register based on service type
                    $registrationResult = $this->registerServiceProvider($data);
                    
                    if ($registrationResult) {
                        // Redirect to login or dashboard
                        
                        // header('Location: ' . ROOT . '/Hotel/Hdashboard');
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
                  $data['yearStarted'] < 1800 || 
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
                    'hotelName' => $data['company_name'],
                    'serviceProviderName' => $data['name'],
                    'hotelEmail' => $data['email'],
                    'hotelPassword' => $data['password'],
                    'hotelMobileNum' => $data['mobileNum'],
                    'hotelAddress' => $data['address'],
                    'district' => $data['district'],
                    'province' => $data['province'],
                    'BRNum' => $data['BRNum'],
                    'yearStarted' => $data['yearStarted']
                ];

                $isInserted = $user->insert($insertData);

                if ($isInserted) {
                    
                    $newUser = $user->first(['hotelEmail' => $data['email']]);
                    if (!empty($newUser)) {
                        redirect('traveler/Login');
                        exit();
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
                $user = new Restaurant();
                $insertData = [
                    'restaurantName' => $data['company_name'],
                    'ownerName' => $data['name'],
                    'restaurantEmail' => $data['email'],
                    'restaurantPassword' => $data['password'],
                    'restaurantMobileNum' => $data['mobileNum'],
                    'restaurantAddress' => $data['address'],
                    'district' => $data['district'],
                    'province' => $data['province'],
                    'BRNum' => $data['BRNum'],
                    'yearStarted' => $data['yearStarted']
                ];

                show($insertData);
                // echo 'hi';
                // exit();

                $isInserted = $user->insert($insertData);

                if ($isInserted) {
                    redirect('traveler/Login?success=profile_created');
                    exit();
                    } else {
                        throw new Exception('Failed to insert dining provider');
                    }
                break;

            case 'travel':
                // $user = new TravelProvider(); // Create this model
                
                $insertData = [
                    'travelagentName' => $data['company_name'],
                    'serviceProviderName' => $data['name'],
                    'travelagentEmail' => $data['email'],
                    'travelagentPassword' => $data['password'],
                    'travelagentMobileNum' => $data['mobileNum'],
                    'travelagentAddress' => $data['address'],
                    'district' => $data['district'],
                    'province' => $data['province'],
                    'BRNum' => $data['BRNum'],
                    'yearStarted' => $data['yearStarted']
                ];
                // show($insertData);
                // exit();

                $travelagent_Id= $this->travelProvider->insert($insertData);
                
                if ($travelagent_Id) {
                    redirect('traveler/Login?success=profile_created');
                    exit();
                } else {
                    throw new Exception('Failed to insert travel provider');
                }
                break;

            default:
                throw new Exception('Invalid service type');
        }
    }
}