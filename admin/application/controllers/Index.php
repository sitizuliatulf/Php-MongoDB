<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public $collection;
	private $model;

	public function __construct() {
		parent::__construct();
		$this->collection = 'users';
		$this->load->model('user_model');
		$this->model = $this->user_model;
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
				'isAdmin' => "1"
			);
			$data = $this->mongo_db->get_where($this->collection, $where);
			if (count($data) > 0) {
				//ubah dari array ke object
				$session_user_login = json_decode(json_encode(array_shift($data)), FALSE);
				
				$id_user = $session_user_login->_id->{'$id'};
				$where['_id'] = new MongoId($id_user);
				$data['lastLogin'] = date("Y-m-d h:i:sa");
				$this->model->update_user($data, $where);

				$this->session->set_userdata('session_user_login', $session_user_login);
				unset($session_user_login->password, $where, $data, $id_user);
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

