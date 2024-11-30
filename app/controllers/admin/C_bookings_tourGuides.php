<?php 

/**
 * Tour Guides Bookings class
 */
class C_bookings_tourGuides
{
	use Controller;

	public function index()
	{

		$this->view('admin/bookings_tourGuides');
	}

}