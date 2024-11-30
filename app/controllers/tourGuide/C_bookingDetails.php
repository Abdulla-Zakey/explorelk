<?php 

/**
 * Booking Details class
 */
class C_bookingDetails
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/bookingDetails');
	}

}