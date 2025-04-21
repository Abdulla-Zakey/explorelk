<?php

class C_addTour extends Controller {

    private $tourPackageModel;
    private $tourPackageActivitiesModel;
    private $tourPackageImagesModel;
    private $tourPackageItineraryModel;
    
    public function __construct() {
        $this->tourPackageModel = new TourPackages();
        $this->tourPackageActivitiesModel = new TourPackageActivities();
        $this->tourPackageImagesModel = new TourPackageImages();
        $this->tourPackageItineraryModel = new TourPackageItinerary();
    }

    public function index()
    {
        // Check if user is logged in
        if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form submission
            try {
                // Extract and sanitize tour package data
                $data = [
                    'guide_id' => $_SESSION['guide_id'],
                    'name' => htmlspecialchars($_POST['name']),
                    'location' => htmlspecialchars($_POST['location']),
                    'duration_days' => (int)$_POST['duration_days'],
                    'group_size' => htmlspecialchars($_POST['group_size']),
                    'package_price' => (float)$_POST['package_price'],
                    'languages' => htmlspecialchars($_POST['languages']),
                    'description' => htmlspecialchars($_POST['description']),
                    'tags' => htmlspecialchars($_POST['tags']),
                    'inclusions' => htmlspecialchars($_POST['inclusions']),
                    'exclusions' => htmlspecialchars($_POST['exclusions']),
                ];

                // Insert tour package and get ID
                $isInserted = $this->tourPackageModel->insert($data);
                if (!$isInserted) {
                    throw new Exception("Failed to insert tour package data");
                }
                
                $insertedPackageId = $this->tourPackageModel->lastInsertId();

                // Handle image uploads
                $this->processImageUploads($insertedPackageId);
                
                // Process itinerary data
                $this->processItineraryData($insertedPackageId);

                // Redirect to success page
                header("Location: " . ROOT . "/tourGuide/C_tourPackages");
                exit();
                
            } catch (Exception $e) {
                // Log the error and show error page
                error_log("Error in tour package creation: " . $e->getMessage());
                // Redirect to error page or show error message
                header("Location: " . ROOT . "/tourGuide/C_addTour?error=1");
                exit();
            }
        } else {
            // Display the form
            $this->view('tourGuide/addTour');
        }        
    }
    
    private function processImageUploads($packageId) {
        if (!isset($_FILES['packageImages']) || empty($_FILES['packageImages']['name'][0])) {
            return;
        }
        
        // Define paths
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public';
        $relativePath = '/assets/images/tourGuide/tourPackagePics/package_id_' . $packageId . '/';
        $uploadPath = $basePath . $relativePath;
        
        // Create directory if it doesn't exist
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        if (is_array($_FILES['packageImages']['name'])) {
            for ($i = 0; $i < count($_FILES['packageImages']['name']); $i++) {
                if ($_FILES['packageImages']['error'][$i] == 0) {
                    // Generate unique filename
                    $fileName = uniqid() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '', $_FILES['packageImages']['name'][$i]);
                    $destination = $uploadPath . $fileName;
                    $dbPath = $relativePath . $fileName;
                    
                    if (move_uploaded_file($_FILES['packageImages']['tmp_name'][$i], $destination)) {
                        $imageData = [
                            'package_id' => $packageId,
                            'image_path' => $dbPath, // Store relative path in database
                        ];
                        $this->tourPackageImagesModel->insert($imageData);
                    }
                }
            }
        }
    }
    
    private function processItineraryData($packageId) {
        // Count the days from POST data
        $dayCount = 0;
        foreach ($_POST as $key => $value) {
            if (preg_match('/^day(\d+)_activity/', $key)) {
                $day = (int)preg_replace('/^day(\d+)_activity/', '$1', $key);
                $dayCount = max($dayCount, $day);
            }
        }
        
        // Process each day in the itinerary
        for ($day = 1; $day <= $dayCount; $day++) {
            // Check if this day exists in the POST data
            if (isset($_POST["day{$day}_activity"])) {
                // Get all activities for this day
                $activities = $_POST["day{$day}_activity"];
                $descriptions = isset($_POST["day{$day}_description"]) ? $_POST["day{$day}_description"] : [];
                $times = isset($_POST["day{$day}_time"]) ? $_POST["day{$day}_time"] : [];
                
                // Ensure arrays have same length
                $count = count($activities);
                if (count($descriptions) < $count) {
                    $descriptions = array_pad($descriptions, $count, '');
                }
                if (count($times) < $count) {
                    $times = array_pad($times, $count, '');
                }
                
                // Insert day itinerary
                $itineraryData = [
                    'package_id' => $packageId,
                    'day_number' => $day,
                ];
                
                $this->tourPackageItineraryModel->insert($itineraryData);
                $dayId = $this->tourPackageItineraryModel->lastInsertId();
                
                // Process each activity for this day
                for ($i = 0; $i < $count; $i++) {
                    $activity = trim($activities[$i]);
                    
                    // Skip empty activities
                    if (empty($activity)) {
                        continue;
                    }
                    
                    $activityData = [
                        'day_id' => $dayId,
                        'title' => htmlspecialchars($activity),
                        'description' => htmlspecialchars(isset($descriptions[$i]) ? trim($descriptions[$i]) : ''),
                        'activity_time' => htmlspecialchars(isset($times[$i]) ? trim($times[$i]) : ''),
                    ];
                    
                    $this->tourPackageActivitiesModel->insert($activityData);
                }
            }
        }
    }
}