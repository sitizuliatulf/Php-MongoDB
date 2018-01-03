<?php 

class Generate_view {
	public function view($view, $data) {
		$CI =& get_instance();
		$CI->load->view('base/header');
		$CI->load->view($view, $data);
		$CI->load->view('base/footer');
	}

}

?>