<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public $collection;
	public $url;
	private $model;
	public $default_order;
	
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('general_model');

		$this->collection = 'articles';
		$this->default_order = array('createdDate' => 'DESC');
		$this->url = $this->router->fetch_class();
		$this->model = $this->general_model;
	}

	public function index() {
		$data['data'] = $this->model->get_data();
		$options['css'] = ['./css/custom/article.css'];
		$this->generate_view->view('articles', $data, $options);
	}

	public function detail($id) {
		if (!empty($id)) {
			$where['_id'] = new MongoId($id);
			$data['data'] = $this->model->get_data($where);
			unset($where);
			
			$where['idArtikel'] = new MongoId($id);
			$order_by['dateTime'] = 'DESC';
			$data['commentars'] = $this->model->get_data_custom('commentars', $where, $order_by);
			unset($where, $order_by);

			if (is_array($data['data']) && count($data['data']) > 0) {
				$data['data'] = array_shift($data['data']);
			}
			$options['css'] = ['./css/custom/article_detail.css'];
			$this->generate_view->view('article_detail', $data, $options);
		}
	}

	public function get_image_from_db() {
		$image = '';
		if (isset($_GET['filename']) && !empty($_GET['filename'])) {
			$where['filename'] = $_GET['filename'];
			$get_image_from_db = $this->model->get_image_from_db($where);
			unset($where);
			$get_image_from_db = $get_image_from_db->getResource();
			while (!feof($get_image_from_db)) {
				$image .= fread($get_image_from_db, 8192);
			}
		}
		header('Content-type: image/png');
		echo $image;
	}

	public function save_commentar() {
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$name = 'anonymous'; 
			if (is_object($this->session->userdata('session_user_login_frontend'))) {
				$name = $this->session->userdata('session_user_login_frontend')->username;
			}
			$data = array(
				'idArtikel' => new MongoId($_GET['id']),
				'content' => $this->input->post('commentar'),
				'name' => $name,
				'dateTime' => date("Y-m-d h:i:sa")
			);
			$this->model->add_new_data('commentars', $data);
			unset($data);
			redirect(base_url('baca-artikel/'.$_GET['id']));
		}
		redirect(base_url());
	}

	public function login() {
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
					$this->session->set_userdata('session_user_login_frontend', $user);
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
			$this->session->unset_userdata('session_user_login_frontend');
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
