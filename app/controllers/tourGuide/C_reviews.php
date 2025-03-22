<?php 

/**
 * Review class
 */
class C_reviews extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/reviews');
	}

}