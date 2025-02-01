<?php 

/**
 * Dashboard class
 */
class C_editTour extends Controller
{
	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/editTour');
	}

}