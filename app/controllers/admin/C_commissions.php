<?php 

/**
 * Content Management class
 */
class C_commissions extends Controller {
    private $commission_ratesModel;
	private $tourGuideCommissionModel;
    private $eventTicketTypeModel;
    private $eventOrganizerModel;
    private $eventModel;
    private $eventCommissionsModel;

    public function __construct(){
        $this->commission_ratesModel = new Commission_rates();
		$this->tourGuideCommissionModel = new TourGuideCommissions; 
        $this->eventModel = new Event;
        $this->eventTicketTypeModel = new EventTicketType;
        $this->eventOrganizerModel = new Eventorganizer;
        $this->eventCommissionsModel = new EventCommissions;
    }

    public function index() {
        $commission_rates = $this->commission_ratesModel->selectAll();

        $tourGuideCommissions = $this->tourGuideCommissionModel->where(['status' => 'pending']);
        $eventCommissions = $this->eventCommissionsModel->selectAll();

        $completedEvents = $this->eventModel->where(['eventStatus' => 'completed']);

        $eventTicketTypes = $this->eventTicketTypeModel->SelectAll();

        $eventOrganizers = $this->eventOrganizerModel->selectAll();
        // show($commission_rates);

        $data = [
            'commission_rates' => $commission_rates,
            'tourGuideCommissions' => $tourGuideCommissions,
            'completedEvents' => $completedEvents,
            'eventOrganizers' => $eventOrganizers,
            'eventTicketTypes' =>$eventTicketTypes,
            'eventCommissions' => $eventCommissions,
        ];

        $this->view('admin/commissions', $data);
    }

    public function approve(){
        // echo 'hi';
        $commission_id = $_GET['commission_id'];
        $user = $_GET['user'];
        // echo $user;
        // $this->tourGuideCommission
        if ($user == 'tourGuide') {
            // echo 'tour';
            $data = [
                'status' => 'approved',
            ];
            $this->tourGuideCommissionModel->update($commission_id, $data, 'commission_id');
        }

        $current_tab = $_GET['current_tab'] ?? 'commission';
        $service_tab = $_GET['service_tab'] ?? 'tour-guide';
        
        // Redirect back with the tab parameters
        redirect("admin/C_commissions?tab=$current_tab&service=$service_tab");
    }

    public function eventPayment(){
        // show($_POST);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $event_Id = $_POST['event_id'];
			// Collect form data
			$data = [
				'amount' => $_POST['amount'] ?? 0,
				'reference_number' => $_POST['reference_number'] ?? '',
				'payment_date' => $_POST['payment_date'] ?? date('Y-m-d'),
				'payment_receipt' => $_FILES['payment_receipt'],
				'notes' => $_POST['notes'] ?? '',
				'errors' => [],
			];

			$valid = $this->eventCommissionsModel->validate($data);
			// show($valid);
			if($valid) {
				

				$basePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public';
				$relativePath = '/assets/commissions/eventCommissions/';
				$uploadPath = $basePath . $relativePath;

				// Create directory if it doesn't exist
				if (!file_exists($uploadPath)) {
					mkdir($uploadPath, 0755, true);
				}
				
				$fileName = uniqid('receipt_') . '.' .  $_FILES['payment_receipt']['name'];
				$destination = $uploadPath . $fileName;
				$dbPath = $relativePath . $fileName;

				if (move_uploaded_file($_FILES['payment_receipt']['tmp_name'], $destination)) {
					// echo 'success';
					$commissionData = [
						'amount' => $_POST['amount'] ?? 0,
						'reference_number' => $_POST['reference_number'] ?? '',
						'payment_date' => $_POST['payment_date'] ?? date('Y-m-d'),
						'receipt_path' => $dbPath,
						'notes' => $_POST['notes'] ?? '',
					];

                    $eventDataUpdate = [
                        'paymentStatus' => 'paid',
                        'paymentAmount' => $_POST['amount'],
                    ];
                    // show($eventDataUpdate);
                    // show($event_Id);
					$this->eventCommissionsModel->insert($commissionData);
                    show($this->eventModel->update($event_Id, $eventDataUpdate, 'event_Id'));

					redirect('admin/C_commissions');
				} else {
					echo 'common error';
				}

				// $this->tourGuidesCommissionModel->insert($data);
			} else {
				echo 'bye';
			}
		}
    }
}