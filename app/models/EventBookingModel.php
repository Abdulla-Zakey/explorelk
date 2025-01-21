<?php

class EventBookingModel{

    use Model;

    protected $table = "event_booking";
    
    public function insert_eventBooking($event_Id, $traveler_Id, $referenceNum, $purchasedDate, $totalAmount, $pathToQR, $bookingStatus){
    
        return $this->insert([
          'event_Id' => $event_Id,
          'traveler_Id' => $traveler_Id,
          'referenceNum' => $referenceNum,
          'purchasedDate' =>  $purchasedDate,
          'totalAmount' => $totalAmount,
          'pathToQR' => $pathToQR,
          'bookingStatus' => $bookingStatus
        ]);
    
      }
    
}