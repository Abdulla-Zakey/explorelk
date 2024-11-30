<?php 

/**
 * New Registration Details class
 */
class C_newRegistrationDetails
{
	use Controller;

	public function index()
	{

		$this->view('admin/newRegistrationDetails');
	}

}