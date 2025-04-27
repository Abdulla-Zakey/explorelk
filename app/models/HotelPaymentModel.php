<?php 

class HotelPaymentModel {
    use Model;

    protected $table = 'room_bookings';

    protected $allowedColumns = [
        'booking_id',
        'guest_name',
        'room_number',
        'amount',
        'payment_date',
        'status',
        'hotel_id'
    ];

    public function getTotalRevenue($hotelId) {
        $query = "SELECT SUM(total_amount) AS total_revenue FROM $this->table WHERE hotel_id = :hotel_id AND status = 'Paid'";
        $data = [':hotel_id' => $hotelId];
        $result = $this->query($query, $data);
        
        if ($result && isset($result[0]->total_revenue)) {
            return $result[0]->total_revenue;
        }
        return 0;
    }

    public function getCurrentMonthRevenue($hotelId) {
        $query = "SELECT SUM(total_amount) AS month_revenue FROM $this->table 
                 WHERE hotel_id = :hotel_id 
                 AND status = 'Paid' 
                 AND MONTH(payment_date) = MONTH(CURRENT_DATE()) 
                 AND YEAR(payment_date) = YEAR(CURRENT_DATE())";
        
        $data = [':hotel_id' => $hotelId];
        $result = $this->query($query, $data);
        
        if ($result && isset($result[0]->month_revenue)) {
            return $result[0]->month_revenue;
        }
        return 0;
    }

    public function getRecentPayments($hotelId, $limit = 10) {
        $query = "SELECT * FROM $this->table 
                 WHERE hotel_id = :hotel_id 
                 ORDER BY payment_date DESC 
                 LIMIT :limit";
        
        $data = [
            ':hotel_id' => $hotelId, 
            ':limit' => $limit
        ];
        
        return $this->query($query, $data);
    }
}