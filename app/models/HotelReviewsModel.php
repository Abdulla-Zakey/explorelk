<?php
class HotelReviewsModel {
    use Model;
    protected $table = 'hotel_reviews';
    
    protected $allowedColumns = [
        'review_Id',
        'hotel_Id',
        'traveler_Id',
        'room_booking_Id',
        'rating',
        'review_text',
        'created_at',
    ];

    public function getReviewsByHotelId($hotelId) {
        if (!filter_var($hotelId, FILTER_VALIDATE_INT) || $hotelId <= 0) {
            error_log("HotelReviewsModel::getReviewsByHotelId - Invalid hotel ID: $hotelId");
            throw new InvalidArgumentException("Invalid hotel ID: $hotelId");
        }

        // Updated query to include traveler username and profile picture
        $query = "SELECT hr.*, t.fname, t.lname, t.username, t.profilePicture 
                  FROM {$this->table} hr
                  LEFT JOIN traveler t ON hr.traveler_Id = t.traveler_Id
                  WHERE hr.hotel_Id = :hotel_Id
                  ORDER BY hr.created_at DESC";
        
        $params = ['hotel_Id' => $hotelId];
        
        $result = $this->query($query, $params);
        if ($result === false) {
            error_log("HotelReviewsModel::getReviewsByHotelId - Query failed for hotel_Id: $hotelId");
            return [];
        }
        
        return $result;
    }

    public function getReviewStats($hotelId) {
        if (!filter_var($hotelId, FILTER_VALIDATE_INT) || $hotelId <= 0) {
            error_log("HotelReviewsModel::getReviewStats - Invalid hotel ID: $hotelId");
            throw new InvalidArgumentException("Invalid hotel ID: $hotelId");
        }

        static $cache = [];
        if (isset($cache[$hotelId])) {
            return $cache[$hotelId];
        }

        $reviews = $this->getReviewsByHotelId($hotelId);
        $totalReviews = count($reviews);
        $averageRating = 0;

        if ($totalReviews > 0) {
            $totalRating = array_sum(array_column($reviews, 'rating'));
            $averageRating = round($totalRating / $totalReviews, 1);
        }

        $cache[$hotelId] = [
            'total_reviews' => $totalReviews,
            'average_rating' => $averageRating
        ];

        return $cache[$hotelId];
    }
}