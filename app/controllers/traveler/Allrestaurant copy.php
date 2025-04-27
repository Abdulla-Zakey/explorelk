<?php
class Allrestaurant extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
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