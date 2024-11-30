<?php 

/**
 * Dashboard class
 */
class C_dashboard
{
	use Controller;

	public function index()
	{

		$this->view('admin/dashboard');
	}

}