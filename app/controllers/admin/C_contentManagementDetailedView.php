<?php 

/**
 * Content Management Detailed View class
 */
class C_contentManagementDetailedView
{
	use Controller;

	public function index()
	{

		$this->view('admin/contentManagementDetailedView');
	}

}