<?php

class Auth extends CI_Controller
{ 

	public function __construct() {
		parent::__construct();
		$this->load->library(array('generate_view'));
	}

	public function login()
	
	{
			
			$email = $this->input->post('email');
			$pass = $this->input->post('password');
			
			$this->session->unset_userdata('user');
			if (!empty($email) && !empty($pass))
			{
				$this->load->model('auth_model');
				$where = array('email' => $email, 'password' => $pass);
				$user = $this->auth_model->get_user('users', $where);
				// $user => [{id: 1, name: semok}] kalau dia ketemu
				// $user => []
				// if (count($user))
				if ($user['password'] == $pass)
				{
					$userdata = array(
					'id' => $user['user_id'],
					'name' => $user['username'],
					'group' => $user['usergroup_id'],
					'logged_in' => TRUE
					);
					$this->session->set_userdata
					('user', base64_encode
					(serialize($userdata))
					);
				} 
				else 
				{
					 $msg = "Username and password didn't match,
					        please try again";
				}
			} 
			else 
			{
				$msg = "Username or password is empty, 
						please try again";
			}
			$this->session->set_flashdata('err_login', $msg);
			header("Location: $this->url");

			$this->generate_view->view('login');
		
		}
		
		function out()
		{
			$this->session->sess_destroy();
			header("Location: $this->url");
		}

	

	
	
	

	public function index()
	{
		echo 1;
	}

	public function register()
	{

		if (isset($_POST['register']))
		{
			// refrensi bisa baca di https://www.codeigniter.com/userguide3/libraries/form_validation.html
			$this->form_validation->set_rules('username', 'Username wajib di isi', 'required');
			$this->form_validation->set_rules(
				'email', null, 'required|valid_email', 
				array(
					'required' => 'Email wajib diisi',
					'valid_email' => 'Format email tidak sesuai'
				)
			);
			$this->form_validation->set_rules('password', 'Kata sandi tidak sesuai', 'required|callback_match_password_with_conf');

			//jika form validation true
			if ($this->form_validation->run() == TRUE) {
				echo 'form validated';
			// add user in database
			}
		}
		//load view ke register
		$this->generate_view->view('register');
	}

	public function match_password_with_conf($password) {
		if ($this->input->post('confirmation_password') === $password) {
			return true;
		}
		$this->form_validation->set_message('match_password_with_conf', 'Kata sandi dan konfirmasi kata sandi tidak sesuai');
		return false;
	}
	
}