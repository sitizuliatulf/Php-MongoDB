<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('auth_model');
	}
	public function index() {
		$options['css'] = ['./css/custom/login.css'];
		if (isset($_POST['login'])) {
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Kata Sandi', 'required');
			if ($this->form_validation->run() == FALSE) {
				redirect(base_url());
			} else {
				$email = $this->input->post('email');
				$pass = $this->input->post('password');
				$where = array('email' => $email, 'password' => sha1($pass));
				$user = $this->auth_model->get_user('users', $where);
				unset($where, $email, $pass);
				if (count($user) > 0) {
					// jangan simpan informasi password user
					unset($user['password']);
					// ubah data ke objek karena data yang dibalikan dari db berupa array
					$user = json_decode(json_encode(array_shift($user)), FALSE);
					$this->session->set_userdata('session_user_login', $user);
					redirect(base_url('index/home'));
				} else {
					$html_eror = '<div class="alert alert-danger">
									<h4>Gagal! </h4>
									<p>Username dan password tidak dapat ditemukan</p>
								</div>';
					$this->session->set_flashdata('err_login', $html_eror);
					redirect(base_url());
				}
			}
		} else {
			$this->generate_view->view('login', null, $options);
		}
	}

	public function logout() {
		if ($this->add_on->user_is_login()) {
			$this->session->unset_userdata('session_user_login');
		}
		redirect(base_url());
	}

	public function home() {
		if ($this->add_on->user_is_login()) {
			$this->generate_view->view('home');
		} else {
			echo 'anda belum login';
		}
	}
}

