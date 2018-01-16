<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	private $collection;
	private $fields = array();

	public function __construct() {
		parent::__construct();
		$this->collection = 'users';

		/* inisialisasi field pada header */
		$tmp = array();
		$tmp['name'] = 'username';
		$tmp['type'] = 'string';
		array_push($this->fields, $tmp);
		unset($tmp);
		
		$tmp = array();
		$tmp['name'] = 'email';
		$tmp['type'] = 'string';
		array_push($this->fields, $tmp);
		unset($tmp);
		
		$tmp = array();
		$tmp['name'] = 'lastLoggin';
		$tmp['type'] = 'date';
		array_push($this->fields, $tmp);
		unset($tmp);

		$tmp = array();
		$tmp['name'] = 'registerDate';
		$tmp['type'] = 'date';
		array_push($this->fields, $tmp);
		unset($tmp);

		$this->load->library(array('mongo_db', 'generate_view', 'add_on'));
	}

	public function index($offset = 0) {
        if ($this->add_on->user_is_login(true)) {
			// select options 
			$where = array('isDelete' => false); 
			$order_by = array('username' => 'ASC');
			$data = $this->generate_view->set_offset_and_limit(
				$this->collection,
				$offset,
				$this->fields,
				$order_by,
				$where
			);
			$this->generate_view->generate_table($data, $this->fields);
        } else {
            redirect(base_url());
        }
	}

}

