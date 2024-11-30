<?php 

/**
 * Travellers User class
 */
class C_users_travellers
{
	use Controller;

	public function index()
	{

		$this->view('admin/users_travellers');
	}

}