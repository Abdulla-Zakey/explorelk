<?php

class TravelAgentReviewModel
{
    use Model;

    protected $table = 'travelprovider_reviews';

    protected $allowedColumns = [
        'review_Id',
        'travelagent_Id',
        'traveler_Id',
        'vehicle_booking_Id',
        'rating',
        'review_text',
        'created_at',
    ];

    // Keep the same methods but rename them appropriately
    public function getReviewsByTravelAgentId($agentId)
    {
        if (!filter_var($agentId, FILTER_VALIDATE_INT) || $agentId <= 0) {
            error_log("TravelAgentReviewModel::getReviewsByTravelAgentId - Invalid agent ID: $agentId");
            throw new InvalidArgumentException("Invalid agent ID: $agentId");
        }

        // Use the where method from the Model trait
        $result = $this->where(
            ['travelagent_Id' => $agentId],
            [
                'order_by' => 'created_at',
                'order_type' => 'DESC'
            ]
        );

        // Fetch traveler details for each review
        $travelerModel = new Traveler(); // Assuming Traveler model exists
        foreach ($result as $review) {
            $traveler = $travelerModel->first(['id' => $review->traveler_Id]);
            if ($traveler) {
                $review->fname = $traveler->fname;
                $review->lname = $traveler->lname;
                $review->username = $traveler->username;
                $review->profilePicture = $traveler->profilePicture;
            } else {
                $review->fname = 'Unknown';
                $review->lname = '';
                $review->username = 'Unknown';
                $review->profilePicture = null;
            }
        }

        if ($result === false) {
            error_log("TravelAgentReviewModel::getReviewsByTravelAgentId - Query failed for travelagent_Id: $agentId");
            return [];
        }

        return $result;
    }

    public function getReviewStats($agentId)
    {
        if (!filter_var($agentId, FILTER_VALIDATE_INT) || $agentId <= 0) {
            error_log("TravelAgentReviewModel::getReviewStats - Invalid agent ID: $agentId");
            throw new InvalidArgumentException("Invalid agent ID: $agentId");
        }

        static $cache = [];
        if (isset($cache[$agentId])) {
            return $cache[$agentId];
        }

        $reviews = $this->getReviewsByTravelAgentId($agentId);
        $totalReviews = count($reviews);
        $averageRating = 0;

        if ($totalReviews > 0) {
            $totalRating = array_sum(array_column($reviews, 'rating'));
            $averageRating = round($totalRating / $totalReviews, 1);
        }

        $cache[$agentId] = [
            'total_reviews' => $totalReviews,
            'average_rating' => $averageRating
        ];

        return $cache[$agentId];
    }


// In your controller (likely TravelAgentController.php)
public function reviews() {
    $agentId = /* get the agent ID from session or request */;
    $reviewModel = new TravelAgentReviewModel();
    $stats = $reviewModel->getReviewStats($agentId);
    $reviews = $reviewModel->getReviewsByTravelAgentId($agentId);
    
    $this->view('travelagent/reviews', [
        'stats' => $stats,
        'reviews' => $reviews
    ]);
}
}