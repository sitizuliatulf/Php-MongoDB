<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->library(array('mongo_db', 'generate_view'));
	}
	public function index()
	{
		$data = $this->mongo_db->get('design');
		//dibawah ini cara ngeload js dan cssnya
		$options['css'] = ['./css/custom/custom.css'];
		$this->generate_view->view('index', array('data' => $data), $options);
	}
	public function design_layout() 
	{
		$options['css'] = ['./css/custom/customdesign.css'];
		$this->generate_view->view('design_layout',$options);

	}
}

