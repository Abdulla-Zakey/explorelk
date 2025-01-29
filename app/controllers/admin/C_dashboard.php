<?php 

/**
 * Dashboard class
 */
class C_dashboard extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['admin_id'])) {
			redirect('admin/C_adminLogin');
		}

		$this->view('admin/dashboard');
	}

}