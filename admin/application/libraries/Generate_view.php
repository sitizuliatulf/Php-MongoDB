<?php 

class Generate_view {
	private $CI;

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function set_offset_and_limit($collection_name, $offset=0, $fields=[], $order_by=[], $where=[]) {
		// load session offset dan limit 
		$this->CI->load->library('mongo_db');
		// set limit and offset ketika get data dari db
		$this->CI->mongo_db->limit(10);
		$this->CI->mongo_db->offset($offset);
		if (count($fields) > 0) {
			$this->CI->mongo_db->select($fields);
		}
		if (count($order_by) > 0) {
			$this->CI->mongo_db->order_by($order_by);
		}
		if (count($where) > 0) {
			$this->CI->mongo_db->where($where);
		}
		$data_collection = $this->CI->mongo_db->get($collection_name);
		return array(
			'data' => $data_collection,
			'count' => count($data_collection),
			'offset' => $offset,
			'limit' => 10
		);
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

	public function generate_table($data, $column=[], $custom_action=[]) {
		/* 
		action value = ['edit', 'delete']
		jika kosong maka kedua button tersebut tidak ditampilkan
		*/
		$this->CI->load->view('base/header', array('css' => $this->CI->config->config['css']));
		$this->CI->load->view('base/aside');
		// data dibawah ini digunakan untuk mengkostumisasi table
		if (count($custom_action) < 1) {
			// edit
			$tmp = new stdClass();
			$tmp->name = $this->CI->lang->line('edit');
			$tmp->link = 'edit';
			$tmp->button_style = 'warning';
			array_push($custom_action, $tmp);
			unset ($tmp);

			// delete
			$tmp = new stdClass();
			$tmp->name = $this->CI->lang->line('delete');
			$tmp->link = 'delete';
			$tmp->button_style = 'danger';
			array_push($custom_action, $tmp);
			unset ($tmp);
		}
		$data = array(
			'data' => $data, 
			'column' => $column, 
			'custom_action' => $custom_action,
		);
		$this->CI->load->view('custom/table', $data);
		$this->CI->load->view('base/footer', array('js' => $this->CI->config->config['js']));
	}

}

?>