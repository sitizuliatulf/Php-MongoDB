<?php 

class Generate_view {
	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function view($view, $data=NULL, $options=[]) 
	{
		$css = $this->CI->config->config['css'];
		$js = $this->CI->config->config['js'];
		if (isset($options['css'])) {
			$css = array_merge($css, $options['css']);
		} 
		if (isset($options['js'])) {
			$js = array_merge($js, $options['js']);
		}
		$this->CI->load->view('base/header', array('css' => $css));
		$this->CI->load->view('base/aside');
		$this->CI->load->view($view, $data);
		$this->CI->load->view('base/footer', array('js' => $js));
	}

}

?>