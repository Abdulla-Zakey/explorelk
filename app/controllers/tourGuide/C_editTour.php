<?php 

/**
 * Dashboard class
 */
class C_editTour extends Controller
{
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
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
		$packageId = $_GET['package_id'];
		$tourPackage = $this->tourPackageModel->where(['package_id' => $packageId]);

        $tourPackageImages = $this->tourPackageImagesModel->where(['package_id' => $packageId]);

        $tourPackageItinerary = $this->tourPackageItineraryModel->where(['package_id' => $packageId]);
        // show($tourPackageItinerary);

        // Get activities for each day
        $dayActivities = [];
        foreach ($tourPackageItinerary as $day) {
            $dayActivities[$day->day_id] = $this->tourPackageActivitiesModel->where(['day_id' => $day->day_id]);
        }

		$data = [
            'tourPackage' => $tourPackage,
            'tourPackageImages' => $tourPackageImages,
            'tourPackageItinerary' => $tourPackageItinerary,
            'dayActivities' => $dayActivities,
        ];

		// show($id);
		$this->view('tourGuide/editTour', $data);
	}

	public function updatePackage()
	{
		// Check if user is logged in
		if (!isset($_SESSION['guide_id'])) {
			header("Location: " . ROOT . "/traveler/Login");
			exit();
		}

		if (!isset($_POST['package_id']) || empty($_POST['package_id'])) {
			header("Location: " . ROOT . "/tourGuide/C_tourPackages?error=missing_id");
			exit();
		}

		$packageId = $_POST['package_id'];

		// Verify this package belongs to the logged-in guide
		$existingPackage = $this->tourPackageModel->where(['package_id' => $packageId, 'guide_id' => $_SESSION['guide_id']]);
		if (!$existingPackage) {
			header("Location: " . ROOT . "/tourGuide/C_tourPackages?error=unauthorized");
			exit();
		}

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Process form submission
				// Extract and sanitize tour package data
				$data = [
					'name' => htmlspecialchars($_POST['name']),
					'location' => htmlspecialchars($_POST['location']),
					'duration_days' => $_POST['duration_days'],
					'group_size' => htmlspecialchars($_POST['group_size']),
					'package_price' => $_POST['package_price'],
					'languages' => htmlspecialchars($_POST['languages']),
					'description' => htmlspecialchars($_POST['description']),
					'tags' => htmlspecialchars($_POST['tags']),
					'inclusions' => htmlspecialchars($_POST['inclusions']),
					'exclusions' => htmlspecialchars($_POST['exclusions']),
				];

				// Update tour package
				$isUpdated = $this->tourPackageModel->update($packageId, $data, 'package_id');
				if (!$isUpdated) {
					throw new Exception("Failed to update tour package data");
				}

				// Handle image uploads (new images)
				$this->processImageUploads($packageId);
				
				// Handle image deletions if any
				if (isset($_POST['delete_images']) && is_array($_POST['delete_images'])) {
					foreach ($_POST['delete_images'] as $imageId) {
						$this->deleteImage((int)$imageId);
					}
				}

				// Update itinerary - first delete existing data
				$this->deleteItineraryData($packageId);
				
				// Then add new itinerary data
				$this->processItineraryData($packageId);

				// Redirect to success page
				header("Location: " . ROOT . "/tourGuide/C_tourPackages?message=updated");
				exit();
				
			
		} else {
			// Redirect to edit page if accessed directly without POST
			header("Location: " . ROOT . "/tourGuide/C_editTour?package_id={$packageId}");
			exit();
		}
	}

	private function deleteImage($imageId) {
		// Get image data
		$image = $this->tourPackageImagesModel->where(['image_id' => $imageId]);
		
		if ($image) {
			// Delete the file from server
			$filePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public' . $image->image_path;
			if (file_exists($filePath)) {
				unlink($filePath);
			}
			
			// Delete from database
			$this->tourPackageImagesModel->delete($imageId, 'image_id');
		}
	}

	private function deleteItineraryData($packageId) {
		// Get all itinerary days for this package
		$days = $this->tourPackageItineraryModel->where(['package_id' => $packageId]);
		
		foreach ($days as $day) {
			// Delete all activities for this day
			$this->tourPackageActivitiesModel->delete($day->day_id, 'day_id');
			
			// Delete the day itself
			$this->tourPackageItineraryModel->delete($day->day_id, 'day_id');
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