<?php 

/**
 * Bookings class
 */
class C_bookings
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/bookings');
	}

}