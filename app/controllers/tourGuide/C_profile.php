<?php 

/**
 * Profile class
 */
class C_profile extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
			header("Location: " . ROOT . "/traveler/login");
			exit();
		}
		$guide = new TourGuide_M;
		$userData = $guide->where(['guide_id' => $_SESSION['guide_id']]);

		$guideBankDetails = new GuideBankAccount;
		$bankDetailsData = $guideBankDetails->where(['guide_id' => $_SESSION['guide_id']]);

		
		//var_dump($userData[0]->name);
		$data = [
            'userData' => $userData ?? [],
			'bankDetailsData' => $bankDetailsData ?? []
        ];
		
		$this->view('tourGuide/profile',$data);
	}

}