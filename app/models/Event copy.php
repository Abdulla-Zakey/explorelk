<?php 

class Event{
  use Model;

  protected $table = "event";

  public function insert_event($organizer_Id, $eventWebBannerPath, $eventName, $eventType , $aboutEvent, $eventDate, $eventStartTime, $eventEndTime, $eventLocation, $eventStatus = "pending"){
    
    return $this->insert([
      'organizer_Id' => $organizer_Id,
      'eventWebBannerPath' => $eventWebBannerPath,
      'eventName' => $eventName,
      'eventType' => $eventType,
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

  public function update_event($id,$eventName,$eventType,$aboutEvent,$eventDate,$eventStartTime,$eventEndTime,$eventLocation,$ticketCount,$ticketPrice){
   $success=$this->update($id,[
    'eventName' => $eventName,
    'eventType' => $eventType,
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
          'eventDate>=' => date('Y-m-d'),
          'eventStatus' => 'approved'
      ],
      [
          'order_by' => 'eventDate',
          'order_type' => 'ASC',
          'limit' => 3
      ]
    );
  
    return $result;
  }

  public function getAllAprovedEvents(){
    $result = $this->where(
      [ 
        'eventDate>=' => date('Y-m-d'),
        'eventStatus' => 'approved'
      ]
    );
    return $result;
  }

  public function getFormattedEventsByOrganizerId() {
      $events = $this->getEventsByOrganizerId();
      return array_map(function($event) {
          return [
              'id' => $event->event_Id,
              'date' => [
                  'month' => date('M', strtotime($event->eventDate)),
                  'day' => date('d', strtotime($event->eventDate))
              ],
              'title' => $event->eventName,
              'location' => $event->eventLocation,
              'datetime' => date('l, F j, Y', strtotime($event->eventDate)) . ' at ' . 
                            date('g:ia', strtotime($event->eventStartTime)) . ' to ' . 
                            date('g:ia', strtotime($event->eventEndTime)),
              'sold' => $event->ticketsSold ?? 0, // Assuming you have a ticketsSold field
              'total' => $event->ticketCount,
              'income' => 'Rs' . number_format(($event->ticketsSold ?? 0) * $event->ticketPrice, 2),
              'image' => $event->eventWebBannerPath
          ];
      }, $events);
  }
  
}



