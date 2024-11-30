<?php 

/**
 * Car Rental users class
 */
class C_users_carRentals
{
	use Controller;

	public function index()
	{

		$this->view('admin/users_carRentals');
	}

}