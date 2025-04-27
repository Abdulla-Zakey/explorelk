<?php
class Allrestaurant extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {

        // Check if user is logged in
        if (!isset($_SESSION['traveler_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }
        
        // Instantiate the Restaurant model
        $restaurantModel = new Restaurant();
        
        // Fetch all restaurants
        $restaurants = $restaurantModel->findAll(); // Assuming findAll() retrieves all records
        
        // Pass the restaurants data to the view
        $data = [
            'restaurants' => $restaurants
        ];
        
        // Load the view with the data
        $this->view('traveler/allrestaurant', $data);
    }
}