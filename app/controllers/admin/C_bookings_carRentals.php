<?php 

/**
 * Car Rentals Bookings class
 */
class C_bookings_carRentals
{
	use Controller;

	public function index()
	{

		$this->view('admin/bookings_carRentals');
	}

}