<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	private $collection;

	public function __construct() {
		parent::__construct();
		$this->collection = 'users';
		$this->load->library(array('mongo_db', 'generate_view', 'add_on'));
	}

	public function index($offset = 0) {
        if ($this->add_on->user_is_login(true)) {
			// select options 
			$fields = array('username', 'email', 'lastLoggin', 'registerDate');
			$where = array('isDelete' => false); 
			$order_by = array('username' => 'ASC');
			$data = $this->generate_view->set_offset_and_limit(
				$this->collection,
				$offset,
				$fields,
				$order_by,
				$where
			);
			$this->generate_view->generate_table($data, $fields);
        } else {
            redirect(base_url());
        }
	}

}

