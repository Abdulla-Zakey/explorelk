<?php 

/**
 * Tour Guide Users class
 */
class C_users_tourGuides
{
	use Controller;

	public function index()
	{

		$this->view('admin/users_tourGuides');
	}

}