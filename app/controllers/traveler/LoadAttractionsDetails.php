<?php

    class LoadAttractionsDetails extends Controller {
    
        public function index($attractionName = null){

            // URL decode the attraction name to handle encoded spaces or special characters
            $attractionName = urldecode($attractionName);
    
            // Check if attraction name is provided
            if (!$attractionName) {
                // Redirect or show error if no attraction name is given
                $this->view('error/404');
                return;
            }
    
            // Initialize models
            $topDistrictsModel = new TopDistrictsModel();
            $attractionsModel = new AttractionsModel();
            $attractionPicsModel = new AttractionPicsModel();
            $thingsToDoModel = new ThingsToDoModel();
    
            // Get the district for the current attraction
            $district_id = $topDistrictsModel->getDistrictByAttractionName($attractionName);
    
            if (!$district_id) {
                // Log the error for debugging
                error_log("No district found for attraction: " . $attractionName);
                
                // Show 404 or error view
                $this->view('error/404', [
                    'message' => 'District not found for attraction: ' . htmlspecialchars($attractionName)
                ]);
                return;
            }
    
            // Get the attraction details
            $attraction = $attractionsModel->getAttractionByNameAndDistrict($attractionName, $district_id);
    
            if (!$attraction) {
                // Log the error for debugging
                error_log("No attraction found: " . $attractionName . " in district ID: " . $district->district_id);
                
                // Show 404 or error view
                $this->view('error/404', [
                    'message' => 'Attraction not found: ' . htmlspecialchars($attractionName)
                ]);
                return;
            }
    
            // Get attraction pictures
            $attractionPictures = $attractionPicsModel->getPicturesForAttraction($attraction->attraction_id);
    
            // Get things to do
            $thingsToDo = $thingsToDoModel->getThingsToDo($attraction->attraction_id);

            // Prepare data to pass to the view
            $data = [
                'district_id' => $district_id,
                'attraction' => $attraction,
                'attractionPictures' => $attractionPictures,
                'thingsToDo' => $thingsToDo
            ];

            // Pass data to the view
            $this->view('traveler/viewAttractionsDetails', $data);
        }
    }
    