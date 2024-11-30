<?php 

/**
 * Travellers Bookings class
 */
class C_bookings_travellers
{
	use Controller;

	public function index()
	{

		$this->view('admin/bookings_travellers');
	}

}