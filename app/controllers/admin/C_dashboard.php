<?php 

/**
 * Dashboard class
 */
class C_dashboard extends Controller
{

	public function index()
	{

		$this->view('admin/dashboard');
	}

}