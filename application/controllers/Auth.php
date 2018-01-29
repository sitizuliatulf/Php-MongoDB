<?php

class Auth extends CI_Controller {
	public $collection;

	public function __construct() {
		parent::__construct();
		$this->collection = 'users';
		$this->load->model('auth_model');
		$this->load->library('form_validation');
	}

	public function register() {
		if (isset($_POST['register'])) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|callback_email_already_exist');
			$this->form_validation->set_rules('password', 'Kata sand', 'required|callback_match_password_with_conf');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'username' => $this->input->post('username'),
					'isAdmin' => false,
					'lastLogin' => '',
					'registerDate' => date("Y-m-d h:i:sa"),
					'isDelete' => false
				);
				$this->auth_model->insert_data($data);
				unset($data);
				redirect(base_url());
			} else {
				redirect(base_url('auth/register'));
			}
		} else {
			$this->generate_view->view('register');
		}
	}

	public function email_already_exist($email) {
		$where = array('email' => $email);
		$email_exist = $this->auth_model->get_user($where);
		unset($where);
		if (count($email_exist) > 0) {
			$this->form_validation->set_message('email_already_exist', 'Email sudah terdaftar');
			return false;
		} else {
			return true;
		}
	}

    public function match_password_with_conf($password) {
		if ($this->input->post('confirmation_password') != $password) {
			$this->form_validation->set_message('match_password_with_conf', 'Kata sandi dan konfirmasi kata sandi tidak sesuai');
			return false;
		} else {
			return true;
		}
	}
	
}