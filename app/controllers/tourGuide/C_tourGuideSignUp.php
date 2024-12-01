<?php 

/**
 * Tour Guide Sign Up class
 */
class C_tourGuideSignUp extends Controller
{

	public function index()
	{

        $data = [];
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
            if($_POST['password'] === $_POST['confirmPassword']){
                // $email = $_POST['email'];
                // $username = $_POST['userName'];
                // $password = $_POST['password'];
                // $confirmPassword = $_POST['confirmPassword'];

                $user = new TourGuide_M;
                $model = $user->findall();
                foreach($model as $ur){
                    if($ur->email === $_POST['email']){  
                        //$errors['email'] = "This email address is already registered.";
                        $data['error'] = "This email address is already registered.";
                    }
                }
                
                //var_dump($model[0]->email);

                if($user->validate($_POST))
                {
                    $result = $user->insert($_POST);
                    print_r($result);

                    //redirect('login');
                }

			    $data['errors'] = $user->errors;
            }else{
                echo "<script type='text/javascript'>alert('Password and Confirm Password do not match');</script>";
            }
						
		}

		$this->view('tourGuide/tourGuideSignUp', $data);
	}

    public function addUser(){

    }

}