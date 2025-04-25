<?php

/**
 * Tour Package Details Controller
 */
class C_tourPackageDetails extends Controller
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

    public function index() {
        if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

        
        // echo 'hi';
        $packageId = $_GET['packageId'];
        $tourPackage = $this->tourPackageModel->where(['package_id' => $packageId]);

        $tourPackageImages = $this->tourPackageImagesModel->where(['package_id' => $packageId]);

        $tourPackageItinerary = $this->tourPackageItineraryModel->where(['package_id' => $packageId]);
        // show($tourPackageItinerary);

        // Get activities for each day
        $dayActivities = [];
        foreach ($tourPackageItinerary as $day) {
            $dayActivities[$day->day_id] = $this->tourPackageActivitiesModel->where(['day_id' => $day->day_id]);
        }
        // show($dayActivities);

        $data = [
            'tourPackage' => $tourPackage,
            'tourPackageImages' => $tourPackageImages,
            'tourPackageItinerary' => $tourPackageItinerary,
            'dayActivities' => $dayActivities,
        ];
        // show($data);
        $this->view('tourGuide/tourPackageDetails', $data);

    }

    public function deleteTourPackage()
	{
		// Check if user is logged in
		if (!isset($_SESSION['guide_id'])) {
			header("Location: " . ROOT . "/traveler/Login");
			exit();
		}

        $packageId = $_GET['package_id'];
        
        // Verify this package belongs to the logged-in guide
        $existingPackage = $this->tourPackageModel->where(['package_id' => $packageId, 'guide_id' => $_SESSION['guide_id']]);
        if (!$existingPackage) {
            // Package doesn't exist or doesn't belong to this guide
            header("Location: " . ROOT . "/tourGuide/C_tourPackages?error=unauthorized");
            exit();
        }
        
        // 1. Delete all package images (files and database records)
        $images = $this->tourPackageImagesModel->where(['package_id' => $packageId]);
        foreach ($images as $image) {
            // Delete the actual file from server
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public' . $image->image_path;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            // Delete database record
            $this->tourPackageImagesModel->delete($image->image_id, 'image_id');
        }
        
        // Try to remove the image directory if it exists
        $imageDir = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public/assets/images/tourGuide/tourPackagePics/package_id_' . $packageId;
        if (is_dir($imageDir)) {
            rmdir($imageDir);
        }
        
        // 2. Delete all itinerary data
        $this->tourPackageItineraryModel->delete($packageId, 'package_id');
        
        // 3. Finally, delete the tour package itself
        $deleteResult = $this->tourPackageModel->delete($packageId, 'package_id');
        
        if ($deleteResult) {
            // Success
            header("Location: " . ROOT . "/tourGuide/C_tourPackages?message=deleted");
        } else {
            // Failed to delete
            error_log("Failed to delete tour package ID: " . $packageId);
            header("Location: " . ROOT . "/tourGuide/C_tourPackages?error=delete_failed");
        }
        exit();
	}
}