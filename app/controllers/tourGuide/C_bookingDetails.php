<?php 

/**
 * Booking Details class
 */
class C_bookingDetails extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/bookingDetails');
	}

}