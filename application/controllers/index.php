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
		
		$data = $this->mongo_db->get('index');
		//dibawah ini cara ngeload js dan cssnya
		$options['css'] = ['./css/custom/custom.css'];
		$this->generate_view->view('login', array('data' => $data), $options);
	}
	public function registrasi($rara) 
	{
		echo 1;
		echo 2;
		echo $rara;
		die;

	}

}

