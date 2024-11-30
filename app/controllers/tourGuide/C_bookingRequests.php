<?php 

/**
 * Booking Requests class
 */
class C_bookingRequests
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/bookingRequests');
	}

}