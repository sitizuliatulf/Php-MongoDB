<?php

class Auth extends CI_Controller
{

	public function login()
	{
		echo 'login page';
	}

	public function register()
	{

		if (isset($_POST['register']))
		{
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			
			

			//jika form validation true
			if ($this->form_validation->run() == TRUE) {
				echo 'form validated';
			// add user in database
			}
		}
		//load view ke register
		$this-> load->view('register');
	}
}