<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	private $collection;

	public function __construct() {
		parent::__construct();
		$this->collection = 'users';
		$this->load->library(array('mongo_db', 'generate_view', 'add_on'));
	}
	public function index() {
        if ($this->add_on->user_is_login(true)) {
            $this->generate_view->generate_table(['test']);
        } else {
            redirect(base_url());
        }
	}
}

