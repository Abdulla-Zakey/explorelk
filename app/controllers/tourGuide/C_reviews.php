<?php 

/**
 * Review class
 */
class C_reviews
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/reviews');
	}

}