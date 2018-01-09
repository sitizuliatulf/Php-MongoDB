<?php 

class Generate_view {
	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function view($view, $data=NULL, $options=[]) {
		$css = $this->CI->config->config['css'];
		$js = $this->CI->config->config['js'];
		if (isset($options['css'])) {
			$css = array_merge($css, $options['css']);
		} 
		if (isset($options['js'])) {
			$js = array_merge($js, $options['js']);
		}
		$session_user_login = $this->CI->session->userdata('session_user_login');
		if (is_object($session_user_login)) {
			$this->CI->load->view('base/header', array('css' => $css));
			$this->CI->load->view('base/aside');
			$this->CI->load->view($view, $data);
			$this->CI->load->view('base/footer', array('js' => $js));
		} else {
			$this->CI->load->view('base/header', array('css' => $css));
			$this->CI->load->view($view, $data);
			$this->CI->load->view('base/footer', array('js' => $js));
		}
	}

	public function generate_table($data, $column=[], $action=[]) {
		/* 
		action value = ['edit', 'delete']
		jika kosong maka kedua button tersebut tidak ditampilkan
		*/
		$this->CI->load->view('base/header', array('css' => $this->CI->config->config['css']));
		$this->CI->load->view('base/aside');
		$this->CI->load->view('custom/table');
		$this->CI->load->view('base/footer', array('js' => $this->CI->config->config['js']));
	}

}

?>