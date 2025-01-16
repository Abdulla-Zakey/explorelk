<?php 

class Event{
  use Model;

  protected $table = "event";

  public function insert_event($organizer_Id, $eventWebBannerPath, $eventName, $aboutEvent, $eventDate, $eventStartTime, $eventEndTime, $eventLocation, $eventStatus = "pending"){
    
    return $this->insert([
      'organizer_Id' => $organizer_Id,
      'eventWebBannerPath' => $eventWebBannerPath,
      'eventName' => $eventName,
      'aboutEvent' => $aboutEvent,
      'eventDate' => $eventDate,
      'eventStartTime' => $eventStartTime,
      'eventEndTime' => $eventEndTime,
      'eventLocation' => $eventLocation,
      'eventStatus' => $eventStatus
    ]);

  }

  public function getEventsByOrganizerId(){
    $data = $this->where(['organizer_Id' => $_SESSION['organizer_id']]);
    return $data;
  }

  public function getAnEventByEventId($event_Id){
    $data = $this->where(['event_Id' => $event_Id]);
    return $data;
  }

  public function update_event($id,$eventName,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation,$ticketCount,$ticketPrice){
   $success=$this->update($id,[
    'eventName' => $eventName,
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

  public function getUpcomingEvents() {

    $result = $this->where(
      [
          'eventDate>=' => date('Y-m-d')
      ],
      [
          'order_by' => 'eventDate',
          'order_type' => 'ASC',
          'limit' => 3
      ]
  );
  
    return $result;
  }
  
}



