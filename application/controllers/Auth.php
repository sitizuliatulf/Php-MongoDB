<?php

class Auth extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library(array('mongo_db', 'generate_view'));

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
			echo 'register berhasil';
			

			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if ($email && $password) {
				$where = array (
					'email' => $email,
					'password' => sha1($password),
					'isAdmin' => false

				);

			$data = $this->mongo_db->get_where('users',array('email==>$email'));
			if (count($data) > 0){
				//sudah terdaftar
				redirect(base_url('dashboard'));
			}
			}

			
		}
		//load view ke register
		$this->generate_view->view('register');
	}

}
	public function match_password_with_conf($password) {
		if ($this->input->post('confirmation_password') === $password) {
			return true;
		}
		$this->form_validation->set_message('match_password_with_conf', 'Kata sandi dan konfirmasi kata sandi tidak sesuai');
		return false;
	}
	
}