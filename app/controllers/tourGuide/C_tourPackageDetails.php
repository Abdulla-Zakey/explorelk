<?php 

/**
 * Tour Package Details class
 */
class C_tourPackageDetails
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/tourPackageDetails');
	}

}