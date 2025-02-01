<?php 

/**
 * Chats class
 */
class C_chats extends Controller
{

	public function index()
	{
		if (!isset($_SESSION['guide_id'])) {
            header("Location: " . ROOT . "/traveler/Login");
            exit();
        }

		$this->view('tourGuide/chats');
	}

}