<?php 

/**
 * Admin Users class
 */
class C_users extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['admin_id'])) {
			redirect('admin/C_adminLogin');
		}

		$traveler = new Traveler();
        $tourGuide = new TourGuide_M();
		$hotel = new Hotel();
		$eventOrganizer = new EventOrganizer();
        
        // Fetch user data
        $data = [
            'travelers' => $traveler->selectAll(),
            'tourGuides' => $tourGuide->selectAll(),
            'hotels' => $hotel->selectAll(),
            'organizers' => $eventOrganizer->selectAll()
        ];
// show($data);

		$this->view('admin/users',$data);
	}

	public function disableUser($id, $role)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/C_adminLogin');
        }
		// show($role);

		$data = [
			'status' => 'disabled',
		];
		// show($data);
		// show($id);

		$model = NULL;
		$idColumn = NULL;

		switch ($role) {
			case 'guide':
				$model = new TourGuide_M();
				$idColumn = 'guide_Id';
				break;
			case 'traveler':
				$model = new Traveler();
				$idColumn = 'traveler_Id';
				break;
			case 'hotel':
				$model = new Hotel();
				$idColumn = 'hotel_Id';
				break;
			case 'eventOrganizer':
				$model = new EventOrganizer();
				$idColumn = 'organizer_Id';
				break;
			default:
				echo 'Invalid user role';
				break;
		}
	        
		$result = $model->update($id, $data, $idColumn);
		if ($result) {
			$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
			redirect('admin/C_users?tab=' . $activeTab);
		} else {
			echo 'Error updating user status';
		}
    }

	public function enableUser($id, $role)
    {
        if (!isset($_SESSION['admin_id'])) {
            redirect('admin/C_adminLogin');
        }

		$data = [
			'status' => 'enabled',
		];

		$model = NULL;
		$idColumn = NULL;

		switch ($role) {
			case 'guide':
				$model = new TourGuide_M();
				$idColumn = 'guide_Id';
				break;
			case 'traveler':
				$model = new Traveler();
				$idColumn = 'traveler_Id';
				break;
			case 'hotel':
				$model = new Hotel();
				$idColumn = 'hotel_Id';
				break;
			case 'eventOrganizer':
				$model = new EventOrganizer();
				$idColumn = 'organizer_Id';
				break;
			default:
				echo 'Invalid user role';
				break;
		}
	        
		$result = $model->update($id, $data, $idColumn);
		if ($result) {
			$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'all';
			redirect('admin/C_users?tab=' . $activeTab);
		} else {
			echo 'Error updating user status';
		}
    }
}