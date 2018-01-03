<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->library(array('mongo_db', 'generate_view'));
	}
	public function index()
	{
		$data = $this->mongo_db->get('mahasiswa');
		//dibawah ini cara ngeload js dan cssnya
		$options['css'] = ['./css/custom/custom.css'];
		$this->generate_view->view('index', array('data' => $data), $options);
	}
	public function add_or_update($params) 
	{
		//dibawah ini cara ngeload js dan cssnya
		$options['js'] = ['./js/custom/custom.js'];
		$options['css'] = ['./css/custom/custom.css'];
		if ($params === 'tambah') {
			$this->generate_view->view('form_mahasiswa', null, $options);
		} else if ($params === 'ubah') {

		} else {
			die;
		}
	}
}

