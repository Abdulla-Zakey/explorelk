<?php 

/**
 * Content Management class
 */
class C_newRegistrations extends Controller {

    private $tourGuideModel;
    private $hotelModel;
    private $eventOraganizerModel;
    private $restaurantsModels;

    public function __construct(){
        $this->tourGuideModel = new TourGuide_M;
        $this->hotelModel = new Hotel;
        $this->eventOrganizerModel = new EventOrganizer;
        // $this->restaurantModel = new
    }

    public function index(){
        $newGuides = $this->tourGuideModel->where(['approved' => 'no']);
        $newHotels = $this->hotelModel->where(['approved' => 'no']);
        $newEventOrganizers = $this->eventOrganizerModel->where(['approved' => 'no']);
        // show($newHotels);

        $data = [
            'newGuides' => $newGuides,
            'newHotels' => $newHotels,
            'newEventOrganizers' => $newEventOrganizers,
        ];

        $this->view('admin/newRegistrations', $data);
    }

    public function approve(){
        // echo $id;
        $id = $_GET['id'];
        $provider = $_GET['provider'];

        $data = [
            'approved' => 'yes',
        ];

        // echo $id . $provider;
        $isUpdated = false;

        if ($provider == 'tourGuide') {
            $isUpdated = $this->tourGuideModel->update($id, $data, 'guide_Id');
        }

        if ($isUpdated) {
            redirect('admin/C_newRegistrations');
        }
    }

    public function reject() {
        $id = $_GET['id'];
        $provider = $_GET['provider'];
        $reason = $_GET['reason'] ?? '';
    
        $data = [
            'approved' => 'rejected',
            'rejectionReason' => $reason // Make sure this column exists
        ];
    
        $isUpdated = false;
    
        if ($provider == 'tourGuide') {
            $isUpdated = $this->tourGuideModel->update($id, $data, 'guide_Id');
        }
    
        if ($isUpdated) {
            redirect('admin/C_newRegistrations');
        }
    }    
}