<?php 

/**
 * Hotels & Restaurants Bookings class
 */
class C_bookings_hotels
{
	use Controller;

	public function index()
	{

		$this->view('admin/bookings_hotels');
	}

}