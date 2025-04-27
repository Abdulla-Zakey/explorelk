<?php
class HotelCommissionsModel {
    use Model;

    protected $table = 'hotel_commissions';

    protected $allowedColumns = [
        'commission_Id',
        'room_booking_Id',
        'hotel_Id',
        'batch_Id',
        'total_amount',
        'commission_rate',
        'commission_amount',
        'is_applicable_for_commission',
        'if_not_applicable_reason',
        'created_at'
    ];

    /**
     * Get total revenue for a specific hotel
     * @param int $hotelId
     * @return float
     */
    public function getTotalRevenue($hotelId) {
        $query = "SELECT SUM(total_amount) as total FROM $this->table WHERE hotel_Id = :hotel_id";
        $data = $this->query($query, ['hotel_id' => $hotelId]);
        return !empty($data) && isset($data[0]->total) ? floatval($data[0]->total) : 0;
    }

    /**
     * Get current month revenue for a specific hotel
     * @param int $hotelId
     * @return float
     */
    public function getCurrentMonthRevenue($hotelId) {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $query = "SELECT SUM(total_amount) as total FROM $this->table 
                 WHERE hotel_Id = :hotel_id 
                 AND MONTH(created_at) = :month 
                 AND YEAR(created_at) = :year";
        $data = $this->query($query, [
            'hotel_id' => $hotelId,
            'month' => $currentMonth,
            'year' => $currentYear
        ]);
        return !empty($data) && isset($data[0]->total) ? floatval($data[0]->total) : 0;
    }

    /**
     * Get current month commission for a specific hotel
     * @param int $hotelId
     * @return float
     */
    public function getCurrentMonthCommission($hotelId) {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $query = "SELECT SUM(commission_amount) as total FROM $this->table 
                 WHERE hotel_Id = :hotel_id 
                 AND is_applicable_for_commission = 1
                 AND MONTH(created_at) = :month 
                 AND YEAR(created_at) = :year";
        $data = $this->query($query, [
            'hotel_id' => $hotelId,
            'month' => $currentMonth,
            'year' => $currentYear
        ]);
        return !empty($data) && isset($data[0]->total) ? floatval($data[0]->total) : 0;
    }

    /**
     * Get payment history for a specific hotel
     * @param int $hotelId
     * @return array
     */
    public function getPaymentHistory($hotelId) {
        $query = "SELECT * FROM $this->table WHERE hotel_Id = :hotel_id ORDER BY created_at DESC";
        return $this->query($query, ['hotel_id' => $hotelId]);
    }

    /**
     * Get filtered payment history for a specific hotel
     * @param int $hotelId
     * @param string $month
     * @param string $year
     * @return array
     */
    public function getFilteredPaymentHistory($hotelId, $month = null, $year = null) {
        $params = ['hotel_id' => $hotelId];
        $whereClause = "WHERE hotel_Id = :hotel_id";
        if ($month && $year) {
            $whereClause .= " AND MONTH(created_at) = :month AND YEAR(created_at) = :year";
            $params['month'] = $month;
            $params['year'] = $year;
        }
        $query = "SELECT * FROM $this->table $whereClause ORDER BY created_at DESC";
        return $this->query($query, $params);
    }

    /**
     * Get paginated payment history
     * @param int $hotelId
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getPaginatedPaymentHistory($hotelId, $page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM $this->table 
                WHERE hotel_Id = :hotel_id 
                ORDER BY created_at DESC
                LIMIT :offset, :per_page";
        return $this->query($query, [
            'hotel_id' => $hotelId,
            'offset' => $offset,
            'per_page' => $perPage
        ]);
    }

    /**
     * Get total count of payment records
     * @param int $hotelId
     * @return int
     */
    public function getTotalRecords($hotelId) {
        $query = "SELECT COUNT(*) as total FROM $this->table WHERE hotel_Id = :hotel_id";
        $data = $this->query($query, ['hotel_id' => $hotelId]);
        return !empty($data) && isset($data[0]->total) ? intval($data[0]->total) : 0;
    }

    /**
     * Get detailed information for a specific booking
     * @param int $bookingId
     * @return object|null
     */
    public function getBookingDetails($bookingId) {
        $query = "SELECT hc.*, rb.*, hg.guest_full_name, hg.guest_email, hg.guest_mobile_num,
                         DATEDIFF(rb.check_out, rb.check_in) as stay_duration
                  FROM $this->table hc
                  JOIN room_bookings_final rb ON hc.room_booking_Id = rb.room_booking_Id
                  LEFT JOIN hotel_guests hg ON rb.room_booking_Id = hg.room_booking_Id
                  WHERE hc.room_booking_Id = :booking_id";
        $data = $this->query($query, ['booking_id' => $bookingId]);
        return !empty($data) ? $data[0] : null;
    }

    /**
     * Cancel a booking by updating its status
     * @param int $bookingId
     * @param int $hotelId
     * @return bool
     */
    public function cancelBooking($bookingId, $hotelId) {
        $query = "UPDATE room_bookings_final 
                  SET booking_status = 'Cancelled'
                  WHERE room_booking_Id = :booking_id 
                  AND hotel_Id = :hotel_id";
        $result = $this->query($query, [
            'booking_id' => $bookingId,
            'hotel_id' => $hotelId
        ]);
        return $result !== false;
    }

    /**
     * Get monthly revenue and commission data for the past X months
     * @param int $hotelId
     * @param int $months Number of months to look back
     * @return array
     */
    public function getMonthlyData($hotelId, $months = 6) {
        $result = [];
        $currentMonth = date('m');
        $currentYear = date('Y');
        for ($i = 0; $i < $months; $i++) {
            $targetMonth = date('m', strtotime("-$i months"));
            $targetYear = date('Y', strtotime("-$i months"));
            $monthName = date('M Y', strtotime("$targetYear-$targetMonth-01"));
            $revenueQuery = "SELECT COALESCE(SUM(total_amount), 0) as total FROM $this->table 
                            WHERE hotel_Id = :hotel_id 
                            AND MONTH(created_at) = :month 
                            AND YEAR(created_at) = :year";
            $revenueData = $this->query($revenueQuery, [
                'hotel_id' => $hotelId,
                'month' => $targetMonth,
                'year' => $targetYear
            ]);
            $commissionQuery = "SELECT COALESCE(SUM(commission_amount), 0) as total FROM $this->table 
                               WHERE hotel_Id = :hotel_id 
                               AND is_applicable_for_commission = 1
                               AND MONTH(created_at) = :month 
                               AND YEAR(created_at) = :year";
            $commissionData = $this->query($commissionQuery, [
                'hotel_id' => $hotelId,
                'month' => $targetMonth,
                'year' => $targetYear
            ]);
            $result[] = [
                'month' => $monthName,
                'revenue' => floatval($revenueData[0]->total ?? 0),
                'commission' => floatval($commissionData[0]->total ?? 0)
            ];
        }
        return array_reverse($result);
    }
}