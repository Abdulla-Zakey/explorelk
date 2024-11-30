<?php 

/**
 * Hotels and Restaurant users class
 */
class C_users_hotelsRestaurants
{
	use Controller;

	public function index()
	{

		$this->view('admin/users_hotelsRestaurants');
	}

}