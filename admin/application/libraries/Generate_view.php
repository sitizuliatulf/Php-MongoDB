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
			$tmp_fields = [];
			foreach($fields as $value) {
				array_push($tmp_fields, $value['name']);
			};
			$this->CI->mongo_db->select($tmp_fields);
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

	public function generate_header($offset) {
		$data = array();
		$this->CI->mongo_db->limit($this->CI->limit);
		$this->CI->mongo_db->offset($offset);
		if (count($this->CI->fields) > 0) {
			$fields = [];
			foreach($this->CI->fields as $f) {
				array_push($fields, $f->name);
			};
			$this->CI->mongo_db->select($fields);
			unset($fields);
		}
		if (count($this->CI->default_order_by) > 0) {
			$this->CI->mongo_db->order_by($this->CI->default_order_by);
		}
		$data['data'] = $this->CI->mongo_db->get($this->CI->collection);
		$this->set_pagination();
		$this->view('custom/header', $data);
	}
	
	private function set_pagination() {
		// set pagination di tabel ehader
		$config['base_url'] = base_url().$this->CI->url.'/view';
		$config['total_rows'] = 100;
		$config['per_page'] = $this->CI->limit;
		$config['uri_segment'] = 3;

		$config['first_link'] = '';
		$config['last_link'] = '';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['next_link'] = 'Selanjutnya';
		$config['next_tag_open'] = '<li class="paginate_button next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Sebelumnya';
		$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example2_previous">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button active"><a href="javascript:void(0)">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="paginate_button ">';
		$config['num_tag_close'] = '</li>';
		
		$this->CI->pagination->initialize($config);		
	}

}

?>