<?php 

/**
 * Service Provider details class
 */
class C_serviceProviderDetails
{
	use Controller;

	public function index()
	{

		$this->view('admin/serviceProviderDetails');
	}

}