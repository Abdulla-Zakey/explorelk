<?php 

/**
 * Earnings class
 */
class C_earnings extends Controller
{
	private $tourBookingsModel;
	private $travelerModel;
	private $tourPackageModel;
	private $tourGuidesCommissionModel;

	public function __construct() {
        $this->tourBookingsModel = new TourBookings;
		$this->travelerModel = new Traveler;
		$this->tourPackageModel = new TourPackages;
		$this->tourGuidesCommissionModel = new TourGuideCommissions; 
	}

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$bookings = $this->tourBookingsModel->where(['guide_id' => $_SESSION['guide_id'], 'request_status' => 'accepted', 'payment_status' => 'paid']);
        $tourPackages = $this->tourPackageModel->selectAll();
        $travelers = $this->travelerModel->selectAll();
		$commissions = $this->tourGuidesCommissionModel->where(['guide_id' => $_SESSION['guide_id']]);
		$approvedCommissions = $this->tourGuidesCommissionModel->where(['guide_id' => $_SESSION['guide_id'], 'status' => 'approved']);
		$pendingCommissions = $this->tourGuidesCommissionModel->where(['guide_id' => $_SESSION['guide_id'], 'status' => 'pending']);
		$rejectedCommissions = $this->tourGuidesCommissionModel->where(['guide_id' => $_SESSION['guide_id'], 'status' => 'rejected']);
		// show($commissions);

		$data = [
            'bookings' => $bookings,
            'tourPackages' => $tourPackages,
            'travelers' => $travelers,
			'commissions' => $commissions,
			'approvedCommissions' => $approvedCommissions,
			'pendingCommissions' => $pendingCommissions,
			'rejectedCommissions' => $rejectedCommissions,
        ];

		$this->view('tourGuide/earnings', $data);
	}

	public function commissionPayment(){
		// show($_POST);
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
			// Collect form data
			$data = [
				'amount' => $_POST['amount'] ?? 0,
				'reference_number' => $_POST['reference_number'] ?? '',
				'payment_date' => $_POST['payment_date'] ?? date('Y-m-d'),
				'payment_receipt' => $_FILES['payment_receipt'],
				'notes' => $_POST['notes'] ?? '',
				'status' => 'pending', // New payments start as pending
				'errors' => [],
			];

			$valid = $this->tourGuidesCommissionModel->validate($data);
			// show($valid);
			if($valid) {
				

				$basePath = $_SERVER['DOCUMENT_ROOT'] . '/gitexplorelk/explorelk/public';
				$relativePath = '/assets/commissions/tourGuideCommissions/guide_id_' . $_SESSION['guide_id'] . '/';
				$uploadPath = $basePath . $relativePath;

				// Create directory if it doesn't exist
				if (!file_exists($uploadPath)) {
					mkdir($uploadPath, 0755, true);
				}
				
				$fileName = uniqid('receipt_') . '.' .  $_FILES['payment_receipt']['name'];
				$destination = $uploadPath . $fileName;
				$dbPath = $relativePath . $fileName;

				if (move_uploaded_file($_FILES['payment_receipt']['tmp_name'], $destination)) {
					echo 'success';
					$commissionData = [
						'guide_id' => $_SESSION['guide_id'],
						'amount' => $_POST['amount'] ?? 0,
						'reference_number' => $_POST['reference_number'] ?? '',
						'payment_date' => $_POST['payment_date'] ?? date('Y-m-d'),
						'receipt_path' => $dbPath,
						'notes' => $_POST['notes'] ?? '',
						'status' => 'pending',
					];

					$this->tourGuidesCommissionModel->insert($commissionData);

					redirect('tourGuide/C_earnings?tab=commission-payments');
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