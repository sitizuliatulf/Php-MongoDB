<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->library(array('mongo_db', 'generate_view'));
	}
	public function index()
	{
		print_r($this->config);
		die;
		$data = $this->mongo_db->get('mahasiswa');
		$this->generate_view->view('welcome_message', array('data' => $data));
	}
}

