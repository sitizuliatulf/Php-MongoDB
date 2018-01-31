<?php

class Auth_model extends CI_Model
{
	public function __construct(){
		parent:: __construct();
	}

	public function get_user($collections, $where){
		// array('username' => 'username', 'password' => 'password');
		return $this->mongo_db->get_where($collections, $where);
	}

	public function insert_data($data) {
   		return $this->mongo_db->insert($this->collection, $data);
  }


}