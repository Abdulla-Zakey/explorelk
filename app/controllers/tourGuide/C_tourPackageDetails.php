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
}