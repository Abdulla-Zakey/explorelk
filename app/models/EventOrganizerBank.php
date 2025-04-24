<?php
class EventOrganizerBank {
    use Model;

    protected $table = "event_organizer_bank";

    public function insertBankDetails($data) {
        return $this->insert($data);
    }

    public function getBankDetailsByOrganizerId($organizerId) {
        $query = "SELECT id, account_name, account_number, bank_name 
                  FROM event_organizer_bank 
                  WHERE organizer_id = :organizer_id";
        return $this->query($query, ['organizer_id' => $organizerId]);
    }

    public function updateBankDetails($id, $data) {
        return $this->update($id, $data, 'id');
    }

    public function deleteBankDetails($id) {
        return $this->delete($id, 'id');
    }
}