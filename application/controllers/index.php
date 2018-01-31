<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->library(array('mongo_db', 'generate_view'));
	}
	public function index()
	{
		// $data = $this->mongo_db->get('mahasiswa');
		// //dibawah ini cara ngeload js dan cssnya
		$options['css'] = ['./css/custom/login.css'];
		
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$msg = '';
		if (!empty($email) && !empty($pass)) {
			$this->load->model('auth_model');
			$where = array('email' => $email, 'password' => $pass);
			$user = $this->auth_model->get_user('users', $where);
			// return dari auth model berupa array tinggal cek apakah arraynya ada isinya atau tidak
			if (count($user) > 0) {
				// jika memang usernya lebih dari 0 maka set sessionya
			//print_r($user);
				$userdata = array(
					//'id' => $user['user_id'],
					//'name' => $user['username'],
					//'group' => $user['usergroup_id'],
					'logged_in' => TRUE

				);

				$this->session->set_userdata('user', $userdata);
				redirect(base_url('index/home'));
			} else {
				$msg = "wrong username or password, please try again";
			}
		} else {
			$msg = "Username or password is empty, 
					please try again";
		}
		if (!empty($msg)) $this->session->set_flashdata('err_login', $msg);
		$this->generate_view->view('login');
	}

	public function logout() {
		if ($this->add_on->user_is_login()) {
			$this->session->unset_userdata('session_user_login');
		}
		redirect(base_url());
	}

	public function home() {
		if ($this->session->userdata('user')) {

			
			$this->generate_view->view('home');
			
		};
		
	}
}

