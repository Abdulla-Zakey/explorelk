<?php 

/**
 * Car Rentals Earnings class
 */
class C_earnings_carRentals
{
	use Controller;

	public function index()
	{

		$this->view('admin/earnings_carRentals');
	}

}