<?php 

/**
 * Content Management class
 */
class C_complaints extends Controller {
    private $tourGuideComplaintsModel;
    private $tourGuidesModel;

    public function __construct(){
        $this->tourGuideComplaintsModel = new TourGuideComplaints;
        $this->tourGuidesModel = new TourGuide_M;
    }

    public function index(){
        $pendingTourGuideComplaints = $this->tourGuideComplaintsModel->where(['status' => 'pending']);
        $resolvedTourGuideComplaints = $this->tourGuideComplaintsModel->where(['status' => 'resolved']);

        $tourGuides = $this->tourGuidesModel->selectAll();
        // show($tourGuides);

        $data = [
            'pendingTourGuideComplaints' => $pendingTourGuideComplaints,
            'resolvedTourGuideComplaints' => $resolvedTourGuideComplaints,
            'tourGuides' => $tourGuides,    
        ];

        $this->view('admin/complaints', $data);
    }

    public function resolve(){
        // show($_POST);
        $data = [
            'resolution_details' => $_POST['resolution_details'],
            'resolution_note' => $_POST['resolution_note'] ?? 'jjj',
            'date_resolved' => date('Y-m-d'),
            'status' => 'resolved',
        ];

        // show($data);
        $complaint_id = $_POST['complaint_id'];

        show($data);

        $isUpdated = $this->tourGuideComplaintsModel->update($complaint_id, $data, 'complaint_id');
        // show($isUpdated);
        redirect('admin/C_complaints');
    }
}