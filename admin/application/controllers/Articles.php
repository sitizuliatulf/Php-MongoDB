<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {
	
    public $collection = 'article_header';
    public $collection_detail = 'article_details';
	public $fields = array();
	public $limit = 10;
	public $default_order_by = array('createdDate' => 'ASC');
	public $custom_action = array();
	public $url = '';
	private $model;

	public function __construct() {
		parent::__construct();
		$this->load->model('article_model');
		$this->model = $this->article_model;
		$this->url = $this->router->fetch_class();
		$this->set_header();
		$this->set_custom_action();
	}
	
	private function set_header() {
		
		/* set kolom di tabel header */
		$tmp = new stdClass();
		$tmp->type = 'string';
		$tmp->name = 'title';
		array_push($this->fields, $tmp);
		unset($tmp);

		$tmp = new stdClass();
		$tmp->type = 'string';
		$tmp->name = 'createdDate';
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
			$this->session->unset_userdata('EDIT_ARTICLE');
            $this->session->unset_userdata('ADD_ARTICLE');
            $options['js'] = ['./js/custom/article.js'];
			$this->generate_view->view('pages/add_new_article', null, $options);
		}
	}

	public function edit($id) {
		if (isset($_POST['submit'])) {
			$this->do_edit($id);
		} else {
			$where['_id'] = new MongoId($id);
			$user = $this->model->get_data_where($where);
            unset($where);
            die;
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
        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('category', 'Kategori', 'required');
        $this->form_validation->set_rules('content', 'Isi Artikel', 'required');
        if ($this->form_validation->run() === true) {
            $main_image = new stdClass();
            if (isset($_FILES['main_image'])) {
                $ext = explode($_FILES['main_image']['type'], '/');
                $filename = sha1($_FILES['main_image']['name'].date("Y-m-d h:i:sa")).".$ext";
                $options = array(
                    'filename' => sha1($filename),
                    'type' => $_FILES['type']
                );
                $id_image = $this->model->upload_image_filestream('main_image', $options);
                
                $main_image->id = $id_image;
                $main_image->filename = sha1($filename);
                $main_image->type = $_FILES['main_image']['type'];
                unset($options, $id_image, $ext);
            }
            $data = array(
                'title' => $this->input->post('title'),
                'category' => $this->input->post('category'),
                'content' => $this->input->post('content'),
                'image' => $main_image,
                'createdDate' => date("Y-m-d h:i:sa"),
                'author' => $this->session->userdata('session_user_login')->username
            );
            $this->model->add_new_data($data);
            unset($data, $main_image);
            $this->add_on->set_error_message($this->lang->line('success_add'), 'success');
            redirect(base_url($this->url));
        } else {
            $data = array(
                'title' => $this->input->post('title'),
                'category' => $this->input->post('category'),
                'content' => $this->input->post('content')
            );
            $this->session->set_userdata('ADD_ARTICLE', $data);
            $this->add_on->set_error_message(validation_errors(), 'danger');
            $options['js'] = ['./js/custom/article.js'];
			$this->generate_view->view('pages/add_new_article', null, $options);
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

