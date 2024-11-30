<?php 

/**
 * Tour Guide Sign In class
 */
class C_tourGuideSignIn
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/tourGuideSignIn');
	}

}