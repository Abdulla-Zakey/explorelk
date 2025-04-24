<?php 

/**
 * TourGuide Model for handling tour guide signup and validation
 */
class TourGuide_M
{
	use Model;

	protected $table = 'tourguide';

	protected $allowedColumns = [
		'firstName',
		'lastName',
		'guide_Id',
		'nic',
		'email',
		'mobileNum',
		'username',
		'password',
		'licenseNum',
		'experience',
		'fieldsOfExpertise',
		'tourFrequencyPerMonth',
		'guideLocation',
		'guideBio',
		'profilePhoto',
		'gender',
		'status',
		'approved',
	];

	public function validate($data)
	{
		$this->errors = [];

		// Name validation
		if(empty($data['name']) || str_word_count($data['name']) < 2)
		{
			$this->errors['name'] = "Please enter your full name";
		}

		// NIC validation
		$nicRegex = '/^([0-9]{12}|[0-9]{9}[vV])$/';
		if(empty($data['nic']) || !preg_match($nicRegex, $data['nic']))
		{
			$this->errors['nic'] = "Invalid National Identity Card number";
		}

		// Mobile number validation
		$mobileRegex = '/^(\+?94)?(0)?[0-9]{9}$/';
		if(empty($data['mobileNum']) || !preg_match($mobileRegex, preg_replace('/[^0-9]/', '', $data['mobileNum'])))
		{
			$this->errors['mobileNum'] = "Invalid mobile number";
		}

		// Email validation
		if(empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Invalid email address";
		}

		// License number validation
		if(empty($data['licenseNum']) || strlen($data['licenseNum']) < 5)
		{
			$this->errors['licenseNum'] = "Invalid SLTDA Guide License Number";
		}

		// Experience validation
		if(!isset($data['experience']) || $data['experience'] < 0 || $data['experience'] > 50)
		{
			$this->errors['experience'] = "Invalid years of experience";
		}

		// Fields of Expertise validation
		$validExpertise = [
			'Hiking', 
			'Wild Life', 
			'Religious Pilgrimages', 
			'Water Sports and Adventure', 
			'Tea Plantation and Factory Visits'
		];
		if(empty($data['fieldsOfExpertise']) || !in_array($data['fieldsOfExpertise'], $validExpertise))
		{
			$this->errors['fieldsOfExpertise'] = "Invalid field of expertise";
		}

		// Tour Frequency validation
		if(!isset($data['tourFrequencyPerMonth']) || $data['tourFrequencyPerMonth'] < 1 || $data['tourFrequencyPerMonth'] > 30)
		{
			$this->errors['tourFrequencyPerMonth'] = "Invalid number of tours per month";
		}

		// Username validation
		if(empty($data['username']) || strlen($data['username']) < 4)
		{
			$this->errors['username'] = "Username must be at least 4 characters long";
		}

		// Password validation
		if(empty($data['password']) || strlen($data['password']) < 8)
		{
			$this->errors['password'] = "Password must be at least 8 characters long";
		}

		// Confirm password validation
		if($data['password'] !== $data['confirmPassword'])
		{
			$this->errors['confirmPassword'] = "Passwords do not match";
		}

		// Check if username already exists
		$existingUser = $this->first(['username' => $data['username']]);
		if($existingUser)
		{
			$this->errors['username'] = "Username already exists";
		}

		// Check if email already exists
		$existingEmail = $this->first(['email' => $data['email']]);
		if($existingEmail)
		{
			$this->errors['email'] = "Email already registered";
		}

		// Return validation result
		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	public function profileValidate($data) {
		$this->errors = [];
		
		// Name validation
		if(empty($data['firstName']))
		{
			$this->errors['firstName'] = "Please enter your first name";
		}

		if(empty($data['lastName']))
		{
			$this->errors['lastName'] = "Please enter your last name";
		}

		if(empty($data['gender']))
		{
			$this->errors['gender'] = "Please select your gender";
		}

		if(empty($data['password']))
		{
			$this->errors['password'] = "Please enter a password";
		}

		if(empty($data['email']))
		{
			$this->errors['email'] = "Please enter your email";
		}

		if(empty($data['mobileNum']))
		{
			$this->errors['mobileNum'] = "Please enter your mobile number";
		}

		if(empty($data['licenseNum']))
		{
			$this->errors['licenseNum'] = "Please enter your license number";
		}

		if(empty($data['nic']))
		{
			$this->errors['nic'] = "Please enter your NIC number";
		}

		if(empty($data['tourFrequencyPerMonth']))
		{
			$this->errors['tourFrequencyPerMonth'] = "Please enter your tour frequency per month";
		}

		if(empty($data['experience']))
		{
			$this->errors['experience'] = "Please enter your experience in years";
		}

		if(empty($data['guideBio']))
		{
			$this->errors['guideBio'] = "Please enter bio";
		}

		if(empty($data['profilePhoto']))
		{
			$this->errors['profilePhoto'] = "Please add a profile photo";
		}

		return empty($this->errors);
	}

	public function findUserById($id){
        $query = "SELECT * FROM $this->table WHERE guide_id = :id";
        $params = [':id' => $id];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }

	// Hash password before inserting
	public function hashPassword($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}

	// Prepare data for insertion
	public function prepareSignupData($data)
	{
		// Hash the password
		$data['password'] = $this->hashPassword($data['password']);

		// Remove confirm password field
		unset($data['confirmPassword']);

		return $data;
	}
	
}