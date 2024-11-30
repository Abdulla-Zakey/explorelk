<?php 

/**
 * Chats class
 */
class C_chats
{
	use Controller;

	public function index()
	{

		$this->view('tourGuide/chats');
	}

}