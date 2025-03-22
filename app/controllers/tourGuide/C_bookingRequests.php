<?php 

/**
 * Booking Requests class
 */
class C_bookingRequests extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/bookingRequests');
	}

}