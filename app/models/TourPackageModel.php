<?php

class TourPackageModel
{
    use Model;

    protected $table = 'tour_packages';

    public function index($id)
    {
    $tourPackageModel = $this->loadModel('TourPackageModel');
    $tourPackage = $tourPackageModel->getPackageById($id);

    // Check if $tourPackage is not null
    if ($tourPackage === null) {
        // Redirect or show an error
        header('Location: ' . ROOT . '/tourGuide/C_tourPackages');
        exit();
    }

    $this->view('tourGuide/tourPackageDetails', ['tourPackage' => $tourPackage]);
    }

    // Save a new tour package
    public function save($data)
    {
        $query = "INSERT INTO {$this->table} 
                  (package_name, tour_location, duration, number_of_people, rate, description, activity_name, images)
                  VALUES 
                  (:package_name, :tour_location, :duration, :number_of_people, :rate, :description, :activity_name, :images)";

        $params = [
            'package_name' => $data['package_name'],
            'tour_location' => $data['tour_location'],
            'duration' => $data['duration'],
            'number_of_people' => $data['number_of_people'],
            'rate' => $data['rate'],
            'description' => $data['description'],
            'activity_name' => $data['activity_name'],
            'images' => $data['images'], // Store comma-separated file paths
        ];

        return $this->query($query, $params);
    }

    // Get all tour packages
    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}";
        return $this->query($query);
    }

    public function getPackageById($id)
    {
        // Validate input
        if (!is_numeric($id) || $id <= 0) {
            return null;
        }
    
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $params = ['id' => $id];
    
        $result = $this->query($query, $params);
    
        // Return null if no package is found
        if (empty($result)) {
            return null;
        }
    
        // Process images and activities into arrays
        $tourPackage = $result[0];
    
        // Safely handle image processing
        $tourPackage->images = !empty($tourPackage->images)
        ? explode(',', $tourPackage->images)
        : [];

    // Process activities
    $tourPackage->activities = !empty($tourPackage->activity_name)
        ? explode(',', $tourPackage->activity_name)
        : [];

    return $tourPackage;
    }


    public function updateTour($data)
    {
        $query = "UPDATE {$this->table} 
                  SET 
                      package_name = :package_name,
                      tour_location = :tour_location,
                      duration = :duration,
                      number_of_people = :number_of_people,
                      rate = :rate,
                      description = :description,
                      activity_name = :activity_name,
                      images = :images
                  WHERE id = :id";

        $params = [
            'package_name' => $data['package_name'],
            'tour_location' => $data['tour_location'],
            'duration' => $data['duration'],
            'number_of_people' => $data['number_of_people'],
            'rate' => $data['rate'],
            'description' => $data['description'],
            'activity_name' => $data['activity_name'],
            'images' => $data['images'], // Store comma-separated file paths
            'id' => $data['id'], // Ensure ID is passed
        ];

        return $this->query($query, $params);
    }
        public function deleteTour($id)
        {
            $query = "DELETE FROM $this->table WHERE id = :id";
            $params = ['id' => $id];
            return $this->query($query, $params);
        }
}