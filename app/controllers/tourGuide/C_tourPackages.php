<?php

class C_tourPackages extends Controller {

    private $tourPackageModel;
    // private $tourPackageActivitiesModel;
    private $tourPackageImagesModel;
    // private $tourPackageItineraryModel;
    
    public function __construct() {
        $this->tourPackageModel = new TourPackages();
        // $this->tourPackageActivitiesModel = new TourPackageActivities();
        $this->tourPackageImagesModel = new TourPackageImages();
        // $this->tourPackageItineraryModel = new TourPackageItinerary();
    }

    public function index(){
        $tourPackages = $this->tourPackageModel->where(['guide_id' => $_SESSION['guide_id']]);
        $tourPackageImages = $this->tourPackageImagesModel->selectAll();
        // show($tourPackages);
        // show($tourPackageImages);

        $data = [
            'tourPackages' => $tourPackages,
            'tourPackageImages' => $tourPackageImages
        ];
        $this->view('tourGuide/tourPackages', $data);
    }
}