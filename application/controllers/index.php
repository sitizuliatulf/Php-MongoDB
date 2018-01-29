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
		// $data = $this->mongo_db->get('mahasiswa');
		// //dibawah ini cara ngeload js dan cssnya
		// $options['css'] = ['./css/custom/custom.css'];
		// $this->generate_view->view('index', array('data' => $data), $options);
		echo 2;
	}

	public function registrasi($zuli) {
		echo 1;
		echo 2;
		echo $zuli;
		die;
		$this->generate_view->view('registrasi');
	}
}

