<?php
class Event {
    use Model;

    protected $table = "event";

    public function insert_event($organizer_Id, $eventWebBannerPath, $eventName, $eventType, $aboutEvent, $eventDate, $eventStartTime, $eventEndTime, $eventLocation, $ticketCount = null, $ticketPrice = null, $eventStatus = "pending") {
        $data = [
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
        ];
        if ($ticketCount !== null) {
            $data['ticketCount'] = $ticketCount;
        }
        if ($ticketPrice !== null) {
            $data['ticketPrice'] = $ticketPrice;
        }
        return $this->insert($data);
    }

    // public function getEventsByOrganizerId() {
    //     return $this->where(['organizer_Id' => $_SESSION['organizer_id']]);
    // }

    public function getEventsByOrganizerId() {
      // Start session if not already started
      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      }

      // Debug: Check if organizer_id is set
      if (!isset($_SESSION['organizer_id'])) {
          error_log("Session Error in Model: organizer_id not set.");
          return [];
      }

      $organizerId = $_SESSION['organizer_id'];
      error_log("Debug - Model: Fetching events for organizer ID: " . $organizerId);

      // Fetch events using a raw query
      $query = "SELECT * FROM event WHERE organizer_Id = :organizer_Id";
      $params = ['organizer_Id' => $organizerId];
      $result = $this->query($query, $params);

      if ($result === false) {
          error_log("Database query failed for organizer ID: " . $organizerId);
          return [];
      }

      error_log("Debug - Model: Raw query result for organizer ID " . $organizerId . ": " . json_encode($result));
      return $result;
  }
    
    

    // public function getAnEventByEventId($event_Id) {
    //     return $this->where(['event_Id' => $event_Id]);
    // // }
    // public function getAnEventByEventId($event_id) {
    //     $query = "SELECT event_Id, eventDate, eventName, eventLocation, eventStartTime, eventEndTime, ticketCount, eventWebBannerPath, aboutEvent, eventType, ticketPrice 
    //               FROM event 
    //               WHERE event_Id = :event_Id";
    //     $params = ['event_Id' => $event_id];
    //     $result = $this->query($query, $params);
    
    //     if ($result === false) {
    //         error_log("Database query failed for event_id: " . $event_id);
    //         return [];
    //     }
    
    //     error_log("Debug - Model: Event fetched for event_id " . $event_id . ": " . json_encode($result));
    //     return $result;
    // }

    public function getAnEventByEventId($event_id) {
        $query = "SELECT event_Id, eventDate, eventName, eventLocation, eventStartTime, eventEndTime, ticketCount, eventWebBannerPath, aboutEvent, eventType, ticketPrice 
                  FROM event 
                  WHERE event_Id = :event_Id 
                  LIMIT 1";
        $params = ['event_Id' => $event_id];
        $result = $this->query($query, $params);
    
        if ($result === false) {
            error_log("Database query failed for event_id: " . $event_id);
            return null;
        }
    
        // If $result is an array with one element, return the first element
        if (is_array($result) && !empty($result)) {
            $result = $result[0];
        }
    
        error_log("Debug - Model: Event fetched for event_id " . $event_id . ": " . json_encode($result));
        return $result;
    }

    public function update_event($id, $eventName, $eventType, $aboutEvent, $eventDate, $eventStartTime, $eventEndTime, $eventLocation, $ticketCount = null, $ticketPrice = null) {
        $data = [
            'eventName' => $eventName,
            'eventType' => $eventType,
            'aboutEvent' => $aboutEvent,
            'eventDate' => $eventDate,
            'eventStartTime' => $eventStartTime,
            'eventEndTime' => $eventEndTime,
            'eventLocation' => $eventLocation
        ];
        if ($ticketCount !== null) {
            $data['ticketCount'] = $ticketCount;
        }
        if ($ticketPrice !== null) {
            $data['ticketPrice'] = $ticketPrice;
        }
        return $this->update($id, $data, 'event_Id');
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

    public function getAllApprovedEvents() {
        return $this->where([
            'eventDate>=' => date('Y-m-d'),
            'eventStatus' => 'approved'
        ]);
    }
}