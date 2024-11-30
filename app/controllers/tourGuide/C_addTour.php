<?php 

/**
 * Add Tour class
 */
class C_addTour
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/addTour');
	}

}