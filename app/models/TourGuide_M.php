<?php 

/**
 * TourGuide Model for handling tour guide signup and validation
 */
class TourGuide_M
{
	use Model;

	protected $table = 'tourguide';

	protected $allowedColumns = [
		'name',
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
		'profilePhoto'
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
	
	// public function updateProfilePhoto($guideId, $imageData)
    // {
    //     $query = "UPDATE " . $this->table . " SET profilePhoto = ? WHERE guide_id = ?";
    //     $stmt = $this->connect()->prepare($query);
    //     return $stmt->execute([$imageData, $guideId]);
    // }

	// public function updateProfile($guideId, $data)
	// {
		

	// 	try {
	// 		$fields = [];
	// 		$values = [];
			
	// 		foreach ($data as $key => $value) {
	// 			if (in_array($key, $this->allowedColumns)) {
	// 				$fields[] = "$key = ?";
	// 				$values[] = $value;
	// 			}
	// 		}
			
	// 		// Add guide_id to values array
	// 		$values[] = $guideId;
			
	// 		$query = "UPDATE " . $this->table . " SET " . implode(', ', $fields) . " WHERE guide_id = ?";
	// 		$stmt = $this->connect()->prepare($query);
			
	// 		return $stmt->execute($values);
	// 	} catch (Exception $e) {
	// 		// Log error if needed
	// 		return false;
	// 	}
	// }
}