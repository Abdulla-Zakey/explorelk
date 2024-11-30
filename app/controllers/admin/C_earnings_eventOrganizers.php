<?php 

/**
 * Event Organizers Earnings class
 */
class C_earnings_eventOrganizers
{
	use Controller;

	public function index()
	{

		$this->view('admin/earnings_eventOrganizers');
	}

}