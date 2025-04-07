<?php

class TopDistrictsModel {
    
    use Model;

    protected $table = 'top_districts';
    protected $allowedColumns = [
        'district_name',
        'about_the_district',
        'coverPic',
        'districtLatitude',
        'districtLongtitude'
    ];

    public function getDistrictByAttractionName($attractionName) {
        // Detailed query to get the district based on the attraction name
        $query = "SELECT * FROM top_districts 
                  JOIN attractions a ON a.district_id = top_districts.district_id 
                  WHERE a.attraction_name = ?";
    
        try {
            $result = $this->query($query, [$attractionName]);
            
            if ($result === false) {
                error_log("Query failed for attraction: " . $attractionName);
                return null;
            }
    
            // Check if any results were returned
            if (!empty($result)) {
                // If $result is an array, return the first district name
                return $result[0]->district_id;
            }
    
            // No district found for this attraction
            error_log("No district found for attraction: " . $attractionName);
            return null;
    
        } catch (Exception $e) {
            // Log any exceptions
            error_log("Exception in getDistrictByAttractionName: " . $e->getMessage());
            return null;
        }
    }
}
