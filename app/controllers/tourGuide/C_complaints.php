<?php 

/**
 * Availability class
 */
class C_complaints extends Controller
{
    private $tourGuideComplaintsModel;

    public function __construct(){
        $this->tourGuidesComplaintsModel = new TourGuideComplaints;
    }

	public function index()
	{
        $pendingComplaints = $this->tourGuidesComplaintsModel->where(['guide_id' => $_SESSION['guide_id'], 'status' => 'Pending']);
        $resolvedComplaints = $this->tourGuidesComplaintsModel->where(['guide_id' => $_SESSION['guide_id'], 'status' => 'resolved']);
// show($pendingComplaints);
        $data = [
            'pendingComplaints' => $pendingComplaints,
            'resolvedComplaints' => $resolvedComplaints,
        ];

        $this->view('tourGuide/complaints', $data);
    }

    public function newComplaint(){
        // echo 'hi';
        $data = [
            'guide_id' => $_SESSION['guide_id'],
            'subject' => $_POST['subject'],
            'message' => $_POST['message'],
            'booking_id' => $_POST['booking_id'] ?? '',
            'date_submitted' => date('Y-m-d'),
        ];

        // show($data);
        $this->tourGuidesComplaintsModel->insert($data);

        redirect('tourGuide/C_complaints');
    }
}