<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	private $collection;

	public function __construct() {
		parent::__construct();
		$this->collection = 'users';
		$this->load->library(array('mongo_db', 'generate_view', 'add_on'));
	}
	public function index() {
		$options['css'] = [
			'./css/custom/login.css'
		];
		if ($this->add_on->initial_project()) {
			if (!$this->add_on->user_is_login(true)) {
				$this->generate_view->view('login', null, $options);
			} else {
				redirect(base_url('dashboard'));
			}
		}
	}
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if ($email && $password) {
			$where = array (
				'email' => $email,
				'password' => sha1($password),
				'isDelete' => false,
				'isAdmin' => true
			);
			$data = $this->mongo_db->get_where($this->collection, $where);
			if (count($data) > 0) {
				//ubah dari array ke object
				$session_user_login = json_decode(json_encode(array_shift($data)), FALSE);
				unset($session_user_login->password);
				$this->session->set_userdata('session_user_login', $session_user_login);
				redirect(base_url('dashboard'));
			}
		}
		$this->add_on->set_error_message($this->lang->line('error_login'), 'danger');
		redirect(base_url());
	}

	public function logout() {
		if ($this->add_on->user_is_login()) {
			$this->session->unset_userdata('session_user_login');
		}
		redirect(base_url());
	}
}

