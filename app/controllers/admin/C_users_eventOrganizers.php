<?php 

/**
 * Event Organizing Users class
 */
class C_users_eventOrganizers
{
	use Controller;

	public function index()
	{

		$this->view('admin/users_eventOrganizers');
	}

}