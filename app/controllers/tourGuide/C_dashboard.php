<?php 

/**
 * Dashboard class
 */
class C_dashboard extends Controller
{
	public function index()
	{

		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$guide = new TourGuide_M;
        $results = $guide->where(['guide_id' => $_SESSION['guide_id']]);
		$user = $results[0];

		$this->view('tourGuide/dashboard');
	}

}