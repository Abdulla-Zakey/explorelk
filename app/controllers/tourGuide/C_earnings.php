<?php 

/**
 * Earnings class
 */
class C_earnings extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/earnings');
	}

}