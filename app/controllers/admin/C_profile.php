<?php 

/**
 * Profile class
 */
class C_profile
{
	use Controller;

	public function index()
	{

		$this->view('admin/profile');
	}

}