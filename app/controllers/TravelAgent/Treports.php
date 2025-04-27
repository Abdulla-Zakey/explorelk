<?php

class Treports extends Controller {
    protected $travelagentcomplaints;
    protected $travelagentId;

    public function __construct() {
        $this->travelagentcomplaints = new TravelagentComplaints();
        $this->travelagentId = isset($_SESSION['travelagent_Id']) ? $_SESSION['travelagent_Id'] : null;
    }

    public function index() {
        if (!$this->travelagentId) {
            error_log("Treports::index - No travelagent_Id in session");
            redirect('login');
        }

        $data = [
            'title' => 'Travel Agent Complaints',
            'travelagent_Id' => $this->travelagentId,
            'traveler_Id' => isset($_SESSION['traveler_Id']) ? $_SESSION['traveler_Id'] : null,
            'issues' => $this->travelagentcomplaints->selectAllByTravelagent($this->travelagentId),
            'errors' => [],
            'subject' => '',
            'booking_id' => '',
            'message' => ''
        ];

        error_log("Treports::index - Loaded issues: " . count($data['issues']));
        $this->view('travelagent/reports', $data);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            error_log("Treports::create - Invalid request method");
            redirect('travelagent/Treports');
        }

        if (!$this->travelagentId) {
            error_log("Treports::create - No travelagent_Id in session");
            redirect('login');
        }

        $data = [
            'traveler_Id' => $_POST['traveler_Id'] ?? null,
            'travelagent_Id' => $this->travelagentId,
            'subject' => $_POST['subject'] ?? '',
            'message' => $_POST['message'] ?? '',
            'booking_id' => !empty($_POST['booking_id']) ? $_POST['booking_id'] : null
        ];

        // Insert complaint
        $response = $this->travelagentcomplaints->insertIssue($data);

        if ($response['status'] === 'success') {
            // Using flash message for success
            flash('issue_success', 'Issue submitted successfully');
            redirect('travelagent/Treports');
        } else {
            // Prepare data for view with errors
            $viewData = [
                'title' => 'Travel Agent Complaints',
                'travelagent_Id' => $this->travelagentId,
                'traveler_Id' => $data['traveler_Id'],
                'issues' => $this->travelagentcomplaints->selectAllByTravelagent($this->travelagentId),
                'errors' => $response['errors'] ?? [],
                'subject' => $data['subject'],
                'booking_id' => $data['booking_id'],
                'message' => $data['message']
            ];
            
            error_log("Treports::create - Error: " . json_encode($response));
            $this->view('travelagent/reports', $viewData);
        }
    }
}