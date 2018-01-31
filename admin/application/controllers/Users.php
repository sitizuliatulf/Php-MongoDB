<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public $collection = 'users';
	public $fields = array();
	public $limit = 10;
	public $default_order_by = array('username' => 'ASC');
	public $custom_action = array();
	public $url = '';
	private $model;

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->model = $this->user_model;
		$this->url = $this->router->fetch_class();
		$this->set_header();
		$this->set_custom_action();
	}
	
	private function set_header() {
		
		/* set kolom di tabel header */
		$tmp = new stdClass();
		$tmp->type = 'string';
		$tmp->name = 'username';
		array_push($this->fields, $tmp);
		unset($tmp);

		$tmp = new stdClass();
		$tmp->type = 'string';
		$tmp->name = 'email';
		array_push($this->fields, $tmp);
		unset($tmp);

	}

	private function set_custom_action() {
		/* set button di tabel header */
		$tmp = new stdClass();
		$tmp->name = 'Ubah';
		$tmp->function_name = 'edit';
		$tmp->button_style = 'info';
		$tmp->icon_name = 'fa fa-edit';
		array_push($this->custom_action, $tmp);
		unset($tmp);
		
		$tmp = new stdClass();
		$tmp->name = 'Hapus';
		$tmp->function_name = 'delete';
		$tmp->button_style = 'danger';
		$tmp->icon_name = 'fa fa-trash-o';
		array_push($this->custom_action, $tmp);
		unset($tmp);
	}

	public function index() {
        if ($this->add_on->user_is_login(true)) {
			$this->view();
        } else {
            redirect(base_url());
        }
	}
	
	public function view($offset = 0) {
		$this->generate_view->generate_header($offset);
	}

	public function add_new() {
		if (isset($_POST['submit'])) {
			$this->do_add_new();
		} else {
			$this->session->unset_userdata('EDIT_USER');
			$this->session->unset_userdata('ADD_USER');
			$data['is_admin_model'] = $this->model->data_is_admin();
			$this->generate_view->view('pages/add_new_user', $data);
		}
	}

	public function edit($id) {
		if (isset($_POST['submit'])) {
			$this->do_edit($id);
		} else {
			$where['_id'] = new MongoId($id);
			$user = $this->model->get_data_where($where);
			unset($where);
			if (is_array($user) && count($user) > 0) {
				$this->session->set_userdata('EDIT_USER', $user);
				$data['is_admin_model'] = $this->model->data_is_admin();
				$this->generate_view->view('pages/add_new_user', $data);
			} else {
				redirect(base_url());
			}
		}
	}

	private function do_add_new() {
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_already_exist');
		$this->form_validation->set_rules('password', 'Kata Sandi', 'required|callback_match_pass');
		$this->form_validation->set_rules('is_admin', 'Akses Admin', 'required');
		if ($this->form_validation->run() === true) {
			$data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'isAdmin' => $this->input->post('is_admin'),
				'password' => sha1($this->input->post('password')),
				'lastLogin' => '',
				'registerDate' => date("Y-m-d h:i:sa"),
			);
			$this->model->add_new_data($data);
			unset($data);
			$this->add_on->set_error_message($this->lang->line('success_add'), 'success');
			redirect(base_url($this->url));
		} else {
			$session_add_new = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'is_admin' => $this->input->post('is_admin'),
				'password' => $this->input->post('password'),
				'confirmation_password' => $this->input->post('confirmation_password'),
			);
			$this->session->set_userdata('ADD_USER', $session_add_new);
			unset($session_add_new);
			$data['is_admin_model'] = $this->model->data_is_admin();
			$this->add_on->set_error_message(validation_errors(), 'danger');
			$this->generate_view->view('pages/add_new_user', $data);
		}
	}

	public function email_already_exist($email) {
		$where['email'] = $email;
		$is_exist = $this->model->get_data_where($where);
		if (is_array($is_exist) && count($is_exist) > 0) {
			$this->form_validation->set_message('callback_email_already_exist', 'Email sudah terdaftar');
			return false;
		} else {
			return true;
		}
	}

	public function match_pass($password) {
		if ($password == $this->input->post('confirmation_password')) {
			return true;
		} else {
			$this->form_validation->set_message('callback_email_already_exist', 'Kata sandi tidak sesuai');
			return false;
		}
	}

	private function do_edit($id) {
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('is_admin', 'Akses Admin', 'required');
		if ($this->form_validation->run() === true) {
			$data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'isAdmin' => $this->input->post('is_admin')
			);
			$where['_id'] = new MongoId($id);
			$this->model->update_user($data, $where);
			unset($data, $where);
			$this->add_on->set_error_message($this->lang->line('success_edit'), 'success');
			redirect(base_url($this->url));
		} else {
			unset($_POST['submit']);
			$this->edit($id);
		}
	}

	public function delete($id = '') {
		if (empty($id)) {
			$delete_all = $this->input->post('delete_all');
			if (is_array($delete_all) && count($delete_all) > 0) {
				$this->model->remove_batch_user($delete_all, '_id');
			}
		} else {
			$where['_id'] = new MongoId($v);
			$this->mongo_db->where($where)->delete($this->collection);
			unset($where);
		}
		redirect(base_url($this->url));
	}

}

