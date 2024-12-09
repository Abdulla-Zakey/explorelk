<?php 

class Event{
  use Model;

  protected $table = "event";

  public function insert_event($organizer_id=1,$eventName,$eventDescription,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation,$ticketCount,$ticketPrice,$eventStatus="pending"){
    
    echo $eventDate;
    $data = $this->insert([
      'organizer_Id' => $organizer_id,
      'eventName' => $eventName,
      'eventDescription' => $eventDescription,
      'aboutEvent' => $aboutEvent,
      'eventDate' => $eventDate,
      'eventStartTime' => $eventStartTime,
      'eventEndTime' => $eventEndTime,
      'eventLocation' => $eventLocation,
      'ticketCount' => $ticketCount,
      'eventStatus' => $eventStatus,
      'ticketPrice' => $ticketPrice
    ]);
  }

  public function get_event(){
    $data = $this->selectALL();
    return $data;
  }

  public function update_event($id,$eventName,$eventDescription,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation,$ticketCount,$ticketPrice){
   $success=$this->update($id,[
    'eventName' => $eventName,
    'eventDescription' => $eventDescription,
    'aboutEvent' => $aboutEvent,
    'eventDate' => $eventDate,
    'eventStartTime' => $eventStartTime,
    'eventEndTime' => $eventEndTime,
    'eventLocation' => $eventLocation,
    'ticketCount' => $ticketCount,
    'ticketPrice' => $ticketPrice
   ]);
   return $success;
  }

  public function delete_event($id){
    
    $succes = $this->delete($id,"id");
    return $succes;
}
  
}

