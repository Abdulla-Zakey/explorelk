<?php 

/**
 * Hotels & Restaurants Earnings class
 */
class C_earnings_hotelsRestaurants
{
	use Controller;

	public function index()
	{

		$this->view('admin/earnings_hotelsRestaurants');
	}

}