<?php 

/**
 * Evenet Organizers Bookings class
 */
class C_bookings_eventOrganizers
{
	use Controller;

	public function index()
	{

		$this->view('admin/bookings_eventOrganizers');
	}

}