<?php
class Event {
    use Model;

  protected $table = "event";

  protected $allowedColumns = [
      'event_Id',
      'organizer_Id',
      'eventWebBannerPath',
      'eventThumnailPic',
      'eventName',
      'aboutEvent',
      'eventType',
      'eventDate',
      'eventStartTime',
      'eventEndTime',
      'eventLocation',
      'eventStatus',
      'rejection_reason',
      'paymentStatus',
      'paymentAmount'
  ];

  public function insert_event($organizer_Id, $eventWebBannerPath, $eventName, $eventType ,$aboutEvent, $eventDate, $eventStartTime, $eventEndTime, $eventLocation, $eventStatus = "pending"){
    
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
    $data = $this->first(['event_Id' => $event_Id]);
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

    public function delete_event($id) {
        try {
            $result = $this->delete($id, "event_Id");
            if ($result === false) {
                error_log("Failed to delete event with event_Id: $id");
                return false;
            }
            return $result;
        } catch (Exception $e) {
            error_log("Error deleting event with event_Id: $id - " . $e->getMessage());
            return false;
        }
    }

    public function getUpcomingEvents() {
        return $this->where(
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
}