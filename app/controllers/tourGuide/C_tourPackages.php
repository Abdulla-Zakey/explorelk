<?php

/**
 * Tour Packages class
 */
class C_tourPackages extends Controller
{


    public function index()
    {
        // Load the TourPackageModel
        $tourPackageModel = $this->loadModel('TourPackageModel');
        
        // Fetch all tour packages from the model
        $tourPackages = $tourPackageModel->getAll();

        // Pass the data to the view
        $this->view('tourGuide/tourPackages', ['tourPackages' => $tourPackages]);
    }

    public function deleteTour($id)
    {
        // Load the TourPackageModel
        $tourPackageModel = $this->loadModel('TourPackageModel');

        // Delete the tour
        $tourPackageModel->deleteTour($id);

        redirect('tourGuide/C_tourPackages');
    }

    public function editTour($id)
    {
        // Load the TourPackageModel
        $tourPackageModel = $this->loadModel('TourPackageModel');

        // Fetch the tour package details by ID
        $tourPackage = $tourPackageModel->getPackageById($id);

        // Debugging: Check if the data is being fetched properly
        // var_dump($tourPackage);
        // die();

        // Handle the case where the tour package does not exist
        if (!$tourPackage) {
            die("Tour Package not found or invalid ID.");
        }

        // Pass the tour package data to the view for editing
        $this->view('tourGuide/edit_tour', ['tourPackage' => $tourPackage]);
    }

    public function updateTour()
{
    // Collect POST data
    $data = [
        'id' => $_POST['id'] ?? '', // Include the tour ID
        'package_name' => $_POST['package-name'] ?? '',
        'description' => $_POST['description'] ?? '',
        'duration' => $_POST['duration'] ?? '',
        'number_of_people' => $_POST['number-of-people'] ?? '',
        'rate' => $_POST['rate'] ?? '',
        'image' => $_POST['image'] ?? '', // If image is being updated
    ];

    // Load the TourPackageModel
    $tourPackageModel = $this->loadModel('TourPackageModel');

    // Call the update method from the model
    $tourPackageModel->updateTour($data);

    // Redirect to the list of tour packages or a success page
    redirect('tourGuide/C_tourPackages');
}

}
