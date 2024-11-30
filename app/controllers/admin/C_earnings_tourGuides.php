<?php 

/**
 * Tour Guides Earnings class
 */
class C_earnings_tourGuides
{
	use Controller;

	public function index()
	{

		$this->view('admin/earnings_tourGuides');
	}

}