<?php 

/**
 * Dashboard class
 */
class C_newRegistrations
{
	use Controller;

	public function index()
	{

		$this->view('admin/newRegistrations');
	}

}