<?php

/**
 * Tour Package Details Controller
 */
class C_tourPackageDetails extends Controller
{

    public function index($id = null)
    {
        if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        
        $tourPackageModel = $this->loadModel('TourPackageModel');
        
        // Check if ID is provided
        if ($id === null) {
            // Redirect or show an error
            header('Location: ' . ROOT . '/tourGuide/C_tourPackages');
            exit();
        }
        
        // Fetch the tour package details by ID
        $tourPackage = $tourPackageModel->getPackageById($id);

        // Check if package exists
        if ($tourPackage === null) {
            // Option 1: Show error page
            $this->view('404');
            
            // Option 2: Redirect to tour packages list
            // header('Location: ' . ROOT . '/tourGuide/C_tourPackages');
            // exit();
            
            return;
        }
        
        // Pass the tour package to the view
        $this->view('tourGuide/tourPackageDetails', ['tourPackage' => $tourPackage]);
    }
}