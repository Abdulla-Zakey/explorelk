<?php 

/**
 * Content Management class
 */
class C_contentManagement
{
	use Controller;

	public function index()
	{

		$this->view('admin/contentManagement');
	}

}