<?php 

/**
 * Availability class
 */
class C_availability extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/availability');
	}

}