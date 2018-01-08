<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library(array('mongo_db', 'generate_view', 'add_on'));
	}
	public function index() {
		$options['css'] = [
			'./css/custom/login.css'
		];
		$this->generate_view->view('Login', null, $options);
	}
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if ($email && $password) {

		}
		$this->add_on->set_error_message($this->lang->line('error_login'), 'danger');
		redirect(base_url());
	}
}

