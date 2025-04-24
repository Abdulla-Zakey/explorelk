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

    public function getEventsByOrganizerId() {
        return $this->where(['organizer_Id' => $_SESSION['organizer_id']]);
    }
    

    public function getAnEventByEventId($event_Id) {
        return $this->where(['event_Id' => $event_Id]);
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