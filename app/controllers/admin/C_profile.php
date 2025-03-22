<?php 

/**
 * Profile class
 */
class C_profile extends Controller
{

	public function index()
	{
		$user = new Admin;
		$id = $_SESSION['admin_id'];

		$data = $user->findUserById($id);
		// var_dump($id);

		$this->view('admin/profile', $data);
	}

}