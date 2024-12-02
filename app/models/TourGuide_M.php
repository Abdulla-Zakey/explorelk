<?php 


/**
 * User class
 */
class TourGuide_M
{
	
	use Model;

	protected $table = 'tourguide';

	protected $allowedColumns = [

		'guide_Id',
		'guideName',
		'guideEmail',
		'guidePassword',
		'guideMobileNum',
		'guideAddress',
		'district',
		'province',
		'companyName',
		'guideBio',
		'BRNum',
		'guide_Bio',
		'languages_Spoken',
		'yearStarted'
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['email']))
		{
			$this->errors['email'] = "Email is required";
		}else
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}

		if(empty($data['userName']) )
		{
			$this->errors['userName'] = "User Name is required";
		}
		
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}

		if(empty($data['confirmPassword']))
		{
			$this->errors['confirmPassword'] = "Confirm Password is required";
		}
		
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	public function findall(){
		$query = "SELECT * FROM $this->table";
		$data = $this->query($query);
		return $data;
	}
}