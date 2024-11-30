<?php 

/**
 * Tour Packages class
 */
class C_tourPackages
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/tourPackages');
	}

}