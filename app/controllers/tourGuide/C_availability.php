<?php 

/**
 * Availability class
 */
class C_availability extends Controller
{
	
	private $unavailabilityModel;

	public function __construct(){
		$this->unavailabilityModel = new TourGuideUnavailability();
	}

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$unavailability = $this->unavailabilityModel->where(['guide_id' => $_SESSION['guide_id']]);

		$data = [
			'unavailability' => $unavailability,
			'errors' => '',
		];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// show($_POST);
			// return;
			$unavailabilityData = [
				'guide_id' => $_SESSION['guide_id'],
				'start_date' => $_POST['start_date'],
				'end_date' => $_POST['end_date'],
				'reason' => $_POST['reason'],
			];

			$validation = $this->unavailabilityModel->validate($unavailabilityData);

			if($validation['valid']) {
				$this->unavailabilityModel->insert($unavailabilityData);
				redirect('tourGuide/C_availability');
			} else {
				$data ['errors'] = $validation['errors'];
			}
		}
		// show($data);

		$this->view('tourGuide/availability', $data);
	}

	public function delete() {
		// Verify this is an AJAX request
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			http_response_code(405);
			echo json_encode(['error' => 'Method not allowed']);
			exit;
		}
		
		$unavailability_id = $_POST['id'] ?? null; // Changed from $_GET to $_POST
		
		if (!$unavailability_id || !is_numeric($unavailability_id)) {
			http_response_code(400);
			echo json_encode(['error' => 'Invalid ID']);
			exit;
		}
	
		$success = $this->unavailabilityModel->delete($unavailability_id, 'unavailability_id');
	
		if ($success) {
			echo json_encode(['success' => true]);
		} else {
			http_response_code(500);
			echo json_encode(['error' => 'Failed to delete record']);
		}
		exit;
	}

}